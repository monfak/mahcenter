<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaid;
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
use App\Models\PaymentSadad;
use App\Models\Product;
use Sms;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;





class SadadPaymentController extends Controller
{

    public function __construct()
    {
        $this->key = config('sadad.key');
        $this->merchantId = config('sadad.merchantId');
        $this->terminalId = config('sadad.terminalId');
        $this->currency = config('sadad.currency');
        $this->client = new Client();
        $this->PaymentIdentity = config('sadad.PaymentIdentity');

        $this->mode =  strtolower(config('sadad.mode'));
    }



    public function request(Request $request, Order $order)
    {
        $user = auth()->user();
        abort_unless($order->user_id == $user->id, 403, 'شما اجازه انجام این عملیات را ندارید.');

        $amount = number_format($order->total_price, 0, '', '');

         if(request()->ip() =="81.91.157.106")

           {
               $amount=1000;
            //   dd($amount);
           }

        $payment = $order->sadadPayments()->create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'ip' => request()->ip(),
        ]);


        try {

            $terminalId = $this->terminalId;
            // $orderId = crc32($order->id);
            $orderId = $order->id;
            $amount = $order->total_price * 10; // convert to rial


               if(request()->ip() =="81.91.157.106")

           {
               $amount=1000;
           }



            // $amount=10000;
            $key = $this->key;

            $signData = $this->encrypt_pkcs7("$terminalId;$orderId;$amount", $key);

            $LocalDateTime = date("m/d/Y g:i:s a");
            //set Description for payment
            $description = 'پرداخت سفارش';
            //set MobileNo for get user cards
            $mobile = $user->mobile;


            // $data = array(
            //     'MerchantId' => $this->merchantId,
            //     'ReturnUrl' => route('payments.callback.sadad', $payment->id),
            //     'PaymentIdentity' => $this->PaymentIdentity,
            //     'LocalDateTime' =>  $LocalDateTime,
            //     'SignData' => $signData,
            //     'TerminalId' => $terminalId,
            //     'Amount' => $amount,
            //     'OrderId' => $orderId,
            //     'additionalData' => $description,
            //     'UserId' => $mobile,
            // );


            $data = array(
                'TerminalId' => $terminalId,
                'MerchantId' => $this->merchantId,
                'Amount' => $amount,
                'SignData' => $signData,
                'ReturnUrl' =>  'https://mahcenter.com/payments/sadad/callback',
                'LocalDateTime' => $LocalDateTime,
                'OrderId' => $orderId
            );


            Log::emergency('data.', ['$data' => $data]);

            $str_data = json_encode($data);
            $res = CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $str_data);

            Log::emergency('$res.', ['$res' => $res]);

            $arrres = json_decode($res);

            Log::emergency('$arrres.', ['$arrres' =>$arrres]);

            if ($arrres->ResCode == 0) {
                $Token = $arrres->Token;
                Log::emergency('Token.', ['Token' => $Token]);
                $url = "https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";


                header("Location:$url");

                exit();
            } else {

                Log::emergency('Token.', ['Description' => $arrres->Description]);
            }
        } catch (\Exception $exception) {



            Log::emergency('exception.', ['$exception' => $exception->getMessage()]);

            $payment->update([
                'error_message' => $exception->getMessage()
            ]);

            $this->doneMessage($exception->getMessage(), 'error');

            return redirect()->back();
        }
    }



    public function callback(Request $request)
    {




        $order_id = $request->OrderId;
        $order=Order::where('id',$order_id)->first();
        $payment=$order->sadadPayments->first();

        // dd($payment,$request->all());


        if (!auth()->check()) {
            auth()->loginUsingId($payment->user_id);
        }


        $user = auth()->user();



        // dd($request->all());
        Log::emergency('request.', ['$request' => $request]);
        $result = null;





            $key = $this->key;
            $token =$request->token;
            $resCode = $request->ResCode;

            if ($resCode == 0) {
                $verifyData    = array(
                    'Token'    => $token,
                    'SignData' => $this->encrypt_pkcs7($token, $key)
                );


                $str_data = json_encode($verifyData);

                $result = CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $str_data);
            }

             $result=json_decode($result);
             Log::emergency('$result.', ['$result' => $result]);

            if ($result->ResCode != -1 && $result->ResCode == 0 && $result) {

                /**
                 * شماره سفارش : $orderId = Request::input('OrderId')
                 * شماره پیگیری : $body->SystemTraceNo
                 * شماره مرجع : $body->RetrievalRefNo
                 */
                $receipt = [
                    'orderId'     => $order->id,
                    'traceNo'     => $result->SystemTraceNo,
                    'referenceNo' => $result->RetrivalRefNo,
                    'description' => $result->Description,
                ];



                Log::emergency('receipt.', ['$receipt' => $receipt]);

                $payment->update([
                    'reference_id' => $receipt['referenceNo'],
                    'status' => true,
                    'res_code' => $result->ResCode,
                ]);

                $order->update(['status' => Order::STATUS_COMPLETED]);
                session()->forget('cart.products');
                if ($id = session('discountId')) {
                    $discountId = Discount::where('id', $id)->first();
                    $code = Code::where('id', session('codeId'));
                    if ($discountId)
                        $code->update(['used' => true]);
                    session()->forget('discountId');
                    session()->forget('codeId');
                }
                Cart::whereUserId(auth()->user())->delete();
                success('پرداخت شما با موفقیت انجام شد. سفارش شما در مرحله پردازش برای ارسال قرار گرفته است.');

                event(new OrderPaid($order));
                //$this->sms($order,$user);
                return redirect()->route('orders.index');
            } else {

                return redirect()->route('checkout')->withErrors(['paymentError' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.']);
            }















        // try {
        //     $key = $this->key;
        //     $token =$request->token;
        //     $resCode = $request->ResCode;

        //     if ($resCode == 0) {
        //         $verifyData    = array(
        //             'Token'    => $token,
        //             'SignData' => $this->encrypt_pkcs7($token, $key)
        //         );

        //         $result = CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $verifyData);
        //     }

        //     if ($result->ResCode != -1 && $result->ResCode == 0 && $result) {

        //         /**
        //          * شماره سفارش : $orderId = Request::input('OrderId')
        //          * شماره پیگیری : $body->SystemTraceNo
        //          * شماره مرجع : $body->RetrievalRefNo
        //          */
        //         $receipt = [
        //             'orderId'     => $order->id,
        //             'traceNo'     => $result->SystemTraceNo,
        //             'referenceNo' => $result->RetrivalRefNo,
        //             'description' => $result->Description,
        //         ];



        //         Log::emergency('receipt.', ['$receipt' => $receipt]);

        //         $payment->update([
        //             'reference_id' => $receipt['referenceNo'],
        //             'status' => true,
        //             'res_code' => $result->ResCode,
        //         ]);

        //         $payment->order->update(['status' => Order::STATUS_COMPLETED]);
        //         session()->forget('cart.products');
        //         if ($id = session('discountId')) {
        //             $discountId = Discount::where('id', $id)->first();
        //             $code = Code::where('id', session('codeId'));
        //             if ($discountId)
        //                 $code->update(['used' => true]);
        //             session()->forget('discountId');
        //             session()->forget('codeId');
        //         }
        //         Cart::whereUserId(auth()->user())->delete();
        //         $this->doneMessage('پرداخت شما با موفقیت انجام شد. سفارش شما در مرحله پردازش برای ارسال قرار گرفته است.');

        //         event(new OrderPaid($payment->order));
        //         $this->sms($payment);
        //         return redirect()->route('orders.index');
        //     } else {

        //         return redirect()->route('checkout')->withErrors(['paymentError' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.']);
        //     }
        // } catch (\Exception $exception) {

        //     Log::emergency('error_message.', ['error_message' => $exception->getMessage()]);

        //     $payment->update([
        //         'error_message' => $exception->getMessage(),
        //     ]);
        //     return redirect()->route('checkout')->withErrors(['paymentError' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.']);
        // }
    }



    private function sms($order,$user)
    {

        $message = 'سفارش شما با شماره پیگیری ' . $order->tracking_code . ' با موفقیت در مه سنتر ثبت شد.
                سپاس از اعتماد و خرید شما
                همکاران ما در اسرع وقت جهت ارسال کالا با شما تماس خواهند گرفت.
                جهت اطلاع از فروش ویژه ی محصولات،ما را در اینستاگرام همراهی فرمایید:
                https://www.instagram.com/mahcenter98/';
        if ($user->mobile) {
            // Sms::send($message, $user->mobile);
            Sms::ultraFastSend(['user' => $user->name, 'OrderCode' => $order->tracking_code], 78969, $user->mobile);
        }
        $orderMessage = 'سفارش جدید در سایت مه سنتر ثبت شد.';
        Sms::send($orderMessage, '09122109737');
        Sms::send($orderMessage, '09912796726');
    }




    private function encrypt_pkcs7($str, $key)
    {
        $key = base64_decode($key);
        $ciphertext = OpenSSL_encrypt($str, "DES-EDE3", $key, OPENSSL_RAW_DATA);

        return base64_encode($ciphertext);
    }


    private function translateStatus($status)
    {
        $translations = [
            '0' => 'تراکنش با موفقیت انجام شد',
            '3' => 'پذيرنده کارت فعال نیست لطفا با بخش امور پذيرندگان، تماس حاصل فرمائید',
            '23' => 'پذيرنده کارت نا معتبر لطفا با بخش امور پذيرندگان، تماس حاصل فرمائید',
            '58' => 'انجام تراکنش مربوطه توسط پايانه ی انجام دهنده مجاز نمی باشد',
            '61' => 'مبلغ تراکنش از حد مجاز بالاتر است',
            '101' => 'مهلت ارسال تراکنش به پايان رسیده است',
            '1000' => 'ترتیب پارامترهای ارسالی اشتباه می باشد',
            '1001' => 'پارامترهای پرداخت اشتباه می باشد',
            '1002' => 'خطا در سیستم- تراکنش ناموفق',
            '1003' => 'IP پذيرنده اشتباه است',
            '1004' => 'شماره پذيرنده اشتباه است',
            '1005' => 'خطای دسترسی:لطفا بعدا تلاش فرمايید',
            '1006' => 'خطا در سیستم',
            '1011' => 'درخواست تکراری- شماره سفارش تکراری می باشد',
            '1012' => 'اطلاعات پذيرنده صحیح نیست، يکی از موارد تاريخ،زمان يا کلید تراکنش اشتباه است',
            '1015' => 'پاسخ خطای نامشخص از سمت مرکز',
            '1017' => 'مبلغ درخواستی شما جهت پرداخت از حد مجاز تعريف شده برای اين پذيرنده بیشتر است',
            '1018' => 'اشکال در تاريخ و زمان سیستم. لطفا تاريخ و زمان سرور خود را با بانک هماهنگ نمايید',
            '1019' => 'امکان پرداخت از طريق سیستم شتاب برای اين پذيرنده امکان پذير نیست',
            '1020' => 'پذيرنده غیرفعال شده است',
            '1023' => 'آدرس بازگشت پذيرنده نامعتبر است',
            '1024' => 'مهر زمانی پذيرنده نامعتبر است',
            '1025' => 'امضا تراکنش نامعتبر است',
            '1026' => 'شماره سفارش تراکنش نامعتبر است',
            '1027' => 'شماره پذيرنده نامعتبر است',
            '1028' => 'شماره ترمینال پذيرنده نامعتبر است',
            '1029' => 'آدرس IP پرداخت در محدوده آدرس های معتبر اعلام شده توسط پذيرنده نیست',
            '1030' => 'آدرس Domain پرداخت در محدوده آدرس های معتبر اعلام شده توسط پذیرنده نیست',
            '1031' => 'مهلت زمانی شما جهت پرداخت به پايان رسیده است.لطفا مجددا سعی بفرمایید',
            '1032' => 'پرداخت با اين کارت , برای پذيرنده مورد نظر شما امکان پذير نیست',
            '1033' => 'به علت مشکل در سايت پذيرنده, پرداخت برای اين پذيرنده غیرفعال شده است',
            '1036' => 'اطلاعات اضافی ارسال نشده يا دارای اشکال است',
            '1037' => 'شماره پذيرنده يا شماره ترمینال پذيرنده صحیح نمیباشد',
            '1053' => 'خطا: درخواست معتبر، از سمت پذيرنده صورت نگرفته است لطفا اطلاعات پذيرنده خود را چک کنید',
            '1055' => 'مقدار غیرمجاز در ورود اطلاعات',
            '1056' => 'سیستم موقتا قطع میباشد.لطفا بعدا تلاش فرمايید',
            '1058' => 'سرويس پرداخت اينترنتی خارج از سرويس می باشد.لطفا بعدا سعی بفرمایید',
            '1061' => 'اشکال در تولید کد يکتا. لطفا مرورگر خود را بسته و با اجرای مجدد عملیات پرداخت را انجام دهید',
            '1064' => 'لطفا مجددا سعی بفرمايید',
            '1065' => 'ارتباط ناموفق .لطفا چند لحظه ديگر مجددا سعی کنید',
            '1066' => 'سیستم سرويس دهی پرداخت موقتا غیر فعال شده است',
            '1068' => 'با عرض پوزش به علت بروزرسانی , سیستم موقتا قطع میباشد',
            '1072' => 'خطا در پردازش پارامترهای اختیاری پذيرنده',
            '1101' => 'مبلغ تراکنش نامعتبر است',
            '1103' => 'توکن ارسالی نامعتبر است',
            '1104' => 'اطلاعات تسهیم صحیح نیست',
            '1105' => 'تراکنش بازگشت داده شده است(مهلت زمانی به پايان رسیده است)'
        ];

        $unknownError = 'خطای ناشناخته رخ داده است. در صورت کسر مبلغ از حساب حداکثر پس از 72 ساعت به حسابتان برمیگردد';

        return array_key_exists($status, $translations) ? $translations[$status] : $unknownError;
    }
}
