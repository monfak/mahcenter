<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaid;
use App\Events\OrderPlaced;
use Exception;
use Gateway;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Larabookir\Gateway\Exceptions\InvalidRequestException;
use Larabookir\Gateway\Exceptions\NotFoundTransactionException;
use Larabookir\Gateway\Exceptions\PortNotFoundException;
use Larabookir\Gateway\Exceptions\RetryException;
use App\Models\Cart;
use App\Models\Code;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use SoapClient;
use Sms;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function request(Request $request, Order $order, $gateway = 'mellat')
    {

        Log::info('Starting payment request for Order ID: ' . $order->id);
        //$user = auth()->user();
        //abort_unless($order->user_id == $user->id, 403, 'شما اجازه انجام این عملیات را ندارید.');
        $price = ini_set ( "soap.wsdl_cache_enabled", "0" );

    	$PIN = 'UFOc6wo66R72CFq8owTX';
    	$wsdl_url = "https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?WSDL";
    	$site_call_back_url = route('payments.callback');

    	$amount = number_format($order->total_price, 0, '', '') * 10;
    	$order_id = $order->id;

        Log::info("Calculated amount for Order ID: {$order->id} - Amount: $amount");

    	$params = array (
    			"LoginAccount" => $PIN,
    			"Amount" => $amount,
    			"OrderId" => $order_id,
    			"CallBackUrl" => $site_call_back_url
    	);

    	$client = new SoapClient ( $wsdl_url );

    	try {
    	    Log::info('Sending SalePaymentRequest for Order ID: ' . $order->id);
    		$result = $client->SalePaymentRequest([
    			"requestData" => $params
    		]);
    		Log::info('SalePaymentRequest result for Order ID: ' . $order->id . ' - Status: ' . $result->SalePaymentRequestResult->Status);
            $paymentData = [
                'order_id'          => $order->id,
                'amount'            => number_format($order->total_price, 0, '', '') ,
                'system_trace_no'   => '',
                'status'            => Payment::STATUS_UNPAID,
                'port'              => '',
            ];
            if(auth()->check()) {
                $paymentData['user_id'] = auth()->id();
                $paymentData['tracking_code'] = uniqid(auth()->id());
                $paymentData['ref_id'] = uniqid(auth()->id());
                $paymentData['is_guest'] = false;
            } else {
                $paymentData['tracking_code'] = uniqid(rand(100000, 999999));
                $paymentData['ref_id'] = uniqid(rand(100000, 999999));
            }

    		$payment = Payment::create($paymentData);
            Log::info('Payment record created for Order ID: ' . $order->id . ' - Payment ID: ' . $payment->id);
    		if ($result->SalePaymentRequestResult->Token && $result->SalePaymentRequestResult->Status === 0) {
    		    Log::info('Redirecting to payment gateway for Order ID: ' . $order->id . ' - Token: ' . $result->SalePaymentRequestResult->Token);
    			header ( "Location: https://pec.shaparak.ir/NewIPG/?Token=" . $result->SalePaymentRequestResult->Token ); /* Redirect browser */
    			exit ();
    		}
    		elseif ( $result->SalePaymentRequestResult->Status  != '0') {
        Log::error('Payment request failed for Order ID: ' . $order->id . ' - Error Message: ' . $result->SalePaymentRequestResult->Message);
                return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' =>  $result->SalePaymentRequestResult->Message]);
    		}
    	} catch ( Exception $ex ) {
    	    Log::error('Exception during payment request for Order ID: ' . $order->id . ' - Exception Message: ' . $ex->getMessage());
    	    return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' =>   $ex->getMessage()]);
    	}
    }

    public function callback(Request $request)
    {
        Log::info('Received payment callback - Token: ' . $request->Token . ' - Order ID: ' . $request->OrderId);
    	$PIN = 'UFOc6wo66R72CFq8owTX';
    	$wsdl_url = "https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL";

    	$Token = $request->Token;
    	$status = $request->status;
    	$OrderId = $request->OrderId;
    	$TerminalNo = $request->TerminalNo;
    	$Amount = $request->Amount;
    	$RRN = $request->RRN;
    	//$user = auth()->user();

        $order = Order::find($OrderId);
        if (!$order) {
            Log::error('Order not found for Order ID: ' . $request->OrderId);
            return redirect()->route('checkout')->withErrors(['paymentError' => 'سفارش یافت نشد']);
        }

        $findOrder = Payment::where('order_id', $OrderId)->first();
        if (!$findOrder) {
            Log::error('Payment record not found for Order ID: ' . $order->id);
            return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => 'رکورد پرداخت یافت نشد']);
        }

        if (!auth()->check()) {
            session(['order_id' => $order->id]);
        }

    	if ($RRN > 0 && $status == 0) {

    		$params = [
				"LoginAccount" => $PIN,
				"Token" => $Token
    		];

    		$client = new SoapClient ( $wsdl_url );

    		try {
    		    Log::info('Sending ConfirmPayment request for Order ID: ' . $order->id);
    			$result = $client->ConfirmPayment([
    				"requestData" => $params
    			]);
    			if ($result->ConfirmPaymentResult->Status != '0') {
    			    Log::error('ConfirmPayment failed for Order ID: ' . $order->id . ' - Error Message: ' . $result->ConfirmPaymentResult->Message);
    			    return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => "  خطا : $result->ConfirmPaymentResult->Message "]);
    				$err_msg = "(<strong> کد خطا : " . $result->ConfirmPaymentResult->Status . "</strong>) " .
    		 		$result->ConfirmPaymentResult->Message ;
    			}
                Log::info('Payment confirmed for Order ID: ' . $order->id);
    		    $findOrder->update(['status' => Payment::STATUS_PAID]);

    		    $instance = \Illuminate\Support\Facades\DB::table('order_products')->where('order_id', $order->id)->get();
                foreach ($instance as $ints) {
                    $product = Product::where('id',$ints->product_id)->first();
                    $stock = $product->stock - $ints->quantity;
                    $product->stock=$stock;
                    $product->save();
                }

                $order->status=Order::STATUS_SENDING;
                $order->save();

               OrderPlaced::dispatch($order);

                session()->flash('msg',[
                    'status'=>'success',
                    'title'=>'',
                    'message'=>'پرداخت شما موفقیت آمیز بود.',
                ]);
                if ($order->mobile)
                {
                    try
                    {
                        send_sms($order->mobile, ['user' => $user->name ?? 'بدون نام', 'ordercode' => $order->id], 636222);
                    } catch (\Exception $exception)
                    {
                        Log::info('Error sending otp: ' . $exception);
                    }
                }

                return redirect()->route('thankyou', $order->id);
    		} catch (Exception $ex) {
    		    Log::error('Exception during ConfirmPayment for Order ID: ' . $order->id . ' - Exception Message: ' . $ex->getMessage());
		        return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => $ex->getMessage() ?? '']);
    			$err_msg =  $ex->getMessage()  ;
    		}
    	} elseif($status) {
    	    Log::warning('Failed transaction for Order ID: ' . $order->id . ' - Status: ' . $request->status);
            return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.']);
            return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => "کد خطای ارسال شده از طرف بانک $status"]);
    		$err_msg = "کد خطای ارسال شده از طرف بانک $status " . "";
    	} else {
            return redirect()->route('thankyou', $order->id)->withErrors(['paymentError' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.']);
    		$err_msg = "پاسخی از سمت بانک ارسال نشد " ;
    	}
    }

    public function mellatCallback(Request $request)
    {
        try {
            $gateway        = \Gateway::verify(); // auto exception
            $trackingCode   = $gateway->trackingCode();
            $refId          = $gateway->refId();
            $cardNumber     = $gateway->cardNumber(); // Null in some gateways
            $payment        = Payment::with('order')->whereRefId($refId)->firstOrFail();
            $payment->update(['status' =>Payment::STATUS_PAID]);
            $payment->order->update(['status' =>Order::STATUS_COMPLETED]);
            session()->forget('cart.products');
            if($id = session('discountId')) {
                $discountId = Discount::where('id', $id)->first();
                $code = Code::where('id', session('codeId'));
                if($discountId)
                    $code->update(['used' => true]);
                session()->forget('discountId');
                session()->forget('codeId');
            }
            Cart::whereUserId(auth()->user())->delete();
            success('پرداخت شما با موفقیت انجام شد. سفارش شما در مرحله پردازش برای ارسال قرار گرفته است.');

            event(new OrderPaid($payment->order));
            //$this->sms($payment);
            return redirect()->route('orders.index');
        } catch (RetryException $exception)
        {
            return redirect()->route('panel.orders.index')->withErrors(['paymentError' => $exception->getMessage()]);
        } catch (PortNotFoundException $exception)
        {
            return redirect()->route('panel.orders.index')->withErrors(['paymentError' => $exception->getMessage()]);
        } catch (InvalidRequestException $exception)
        {
            return redirect()->route('panel.orders.index')->withErrors(['paymentError' => $exception->getMessage()]);
        } catch (NotFoundTransactionException $exception)
        {
            return redirect()->route('panel.orders.index')->withErrors(['paymentError' => $exception->getMessage()]);
        } catch (Exception $exception)
        {
            return redirect()->route('panel.orders.index')->withErrors(['paymentError' => $exception->getMessage()]);
        }
    }

    private function sms($payment)
    {

        $user = $payment->order->user;
        $order = $payment = Order::find($payment->order_id);
        $message = 'سفارش شما با شماره پیگیری ' . $order->tracking_code . ' با موفقیت در مه سنتر ثبت شد.
                سپاس از اعتماد و خرید شما
                همکاران ما در اسرع وقت جهت ارسال کالا با شما تماس خواهند گرفت.
                جهت اطلاع از فروش ویژه ی محصولات،ما را در اینستاگرام همراهی فرمایید:
                https://www.instagram.com/mahcenter98/';
        if($user->mobile) {
            // Sms::send($message, $user->mobile);
              Sms::ultraFastSend(['user'=>$user->name,'OrderCode'=> $order->tracking_code],78969,$user->mobile);
        }
        $orderMessage = 'سفارش جدید در سایت مه سنتر ثبت شد.';
        Sms::send($orderMessage, '09122109737');
        Sms::send($orderMessage, '09912796726');
    }

}
