<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Code;
use App\Models\Discount;
use App\Http\Requests\StoreDiscount;
use App\Http\Requests\UpdateDiscount;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Manufacturer;
use App\Models\Product;
use Rap2hpoutre\FastExcel\FastExcel;
use Sms;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:discounts-manage');
    }

    public function index()
    {
        $discounts = Discount::latest()->paginate();

        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $products = Product::whereStatus(true)
            ->latest('products.created_at')
            ->select('id', 'name', 'manufacturer_id')
            ->get();
        $product_ids = $products->pluck('id')->toArray();

        $manufacturer_ids = $products->pluck('manufacturer_id')->toArray();

        $category_ids = DB::table('category_product')
            ->whereIn('product_id', $product_ids)
            ->pluck('category_id')
            ->toArray();

        $manufacturers = Manufacturer::whereIn('id', $manufacturer_ids)
            ->select('id', 'name')
            ->get();

        $categories = Category::whereIn('id', $category_ids)
            ->select('id', 'name')
            ->get();

        $users = User::select('id', 'first_name', 'last_name', 'mobile')->latest()->get();

        if(count($products) == 0) {
            doneMessage('شما هیچ کالای فعالی در فروشگاه ندارید!', 'error');
            return back();
        }

        return view('admin.discounts.create',
            compact('products', 'manufacturers', 'categories', 'users'));
    }

    public function store(StoreDiscount $request)
    {
        $products = Product::whereStatus(true);

        switch ($request->input('type')) {
            case 1 :
                $product_ids = $products->whereIn('id', $request->input('product_id'))
                    ->pluck('id')
                    ->toArray();
                break;
            case 2 :
                $product_ids = $products->join('category_product as cp', 'products.id', '=', 'cp.product_id')
                    ->whereIn('cp.category_id', request('category_id'))
                    ->pluck('products.id')->toArray();
                break;
            case 3 :
                $product_ids = $products->whereIn('manufacturer_id', $request->input('manufacturer_id'))
                    ->pluck('products.id')
                    ->toArray();
                break;
            default :
                $product_ids = $products->pluck('id')->toArray();
        }
        if(count($product_ids) == 0) {
            doneMessage('هیچ محصولی برای ارائه تخفیف یافت نشد!', 'error');
            return back();
        }
        $data = $request->only('title', 'value', 'start_date', 'end_date', 'content', 'type');
        $data['user_id'] = auth()->id();
        $discount = Discount::create($data);
        $discount->products()->sync($product_ids);
        if($request->input('customer_id')) {
            $users = User::whereIn('id', request('customer_id'))->get();
        } else {
            $users = User::latest()->get();
        }
        $codes = [];
        $data_codes = [];

        for ($i = 0; $i < count($users); $i++) {
            $codes[$i] = $this->createCode();
            $data_codes[$i] = [
                'discount_id' => $discount->id,
                'used'=>0,
                'user_id'=>$users[$i]->id,
                'code' => $codes[$i],
                'created_at' => now(),
                'updated_at' => now()
            ];

            $insert_code=new Code($data_codes[$i]);
            $insert_code->save();
        }

        $j = 0;
        $url = url(route('discounts.show', $discount));
        foreach ($users as $user) {
            // کد مربوط به ارسال پیامک برای کاربران انتخابی
              $content=strip_tags($discount->content);
                Sms::ultraFastSend(['user'=>$user->name, 'dis'=>$discount->value,'content'=>$content,'code'=>$codes[$j],'end'=>jdate($discount->end_date)->format('d-m-Y'),'link'=>$url],61290,$user->mobile);

            $j++;
        }
        success('کدهای تخفیف با موفقیت به کاربران ارسال شد.');

        return redirect()->route('admin.discounts.index');
    }


    public function edit(Discount $discount)
    {
        $users = User::select('id', 'first_name', 'last_name', 'mobile')->latest()->get();

       $select_user=Code::where('discount_id',$discount->id)->pluck('user_id')->toArray();

        return view('admin.discounts.edit',compact('discount','users','select_user'));
    }

    public function update(Request $request,Discount $discount)
    {
        if(auth()->user()->hasRole('sales') && $discount->user_id != auth()->id())
            abort(403);

        $discount->content=$request->input('content');
        $discount->start_date=$request->input('start_date');
        $discount->end_date=$request->input('end_date');
        $discount->value=$request->input('value');
        $discount->save();
        success('کدهای تخفیف با موفقیت به ویرایش شد.');
        return redirect()->route('admin.discounts.index');
    }


    public function destroy(Discount $discount)
    {
        if(auth()->user()->hasRole('sales') && $discount->user_id != auth()->id())
            abort(403);

        $discount->delete();
        success();

        return redirect()->route('admin.discounts.index');
    }

    protected function createCode()
    {
        do {
            $code = Str::random(6);
        } while(Code::where('code', $code)->where('used', false)->count() != 0);

        return $code;
    }

    public function export(Discount $discount)
    {
        return (new FastExcel($discount->codes()->orderBy('used')->get()))->download('codes.xlsx', function ($code) {
            return [
                'کد تخفیف' => $code->code,
                'وضعیت' => $code->used ? 'استفاده شده' : 'قابل استفاده',
                'نام' => $code->user->first_name,
                'نام خانوادگی' => $code->user->last_name,
                'شماره تماس' => $code->user->mobile,
                'نام مصرف کننده کد' => $code->consumer_id ? $code->consumer->first_name : '-',
                'نام خانوادگی مصرف کننده کد' => $code->consumer ? $code->consumer->last_name : '-',
                'شماره تماس مصرف کننده کد' => $code->consumer ? $code->consumer->mobile : '-',
            ];
        });
    }
}
