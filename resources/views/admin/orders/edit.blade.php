@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">جزئیات سفارش</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm">لیست سفارش‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-success">
                        <strong>کد پیگیری:</strong>
                        {{ $order->tracking_code }}
                    </div>
                    <hr>
                    <table class="table table-hover table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>نام کاربر</th>
                            <th>موبایل</th>
                            <th>ایمیل</th>
                            <th>کد ملی</th>
                            <th>تاریخ ثبت</th>
                            <th>پرداخت</th>
                            <th>وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    @if($order->user_id)
                                        {{ $order->user->name ?? $order->name }}
                                    @else
                                        {{ $order->name }}
                                        <span class="label label-info">کاربر مهمان</span>
                                    @endif
                                </td>
                                <td>{{ $order->user->mobile ?? $order->mobile }}</td>
                                <td>{{ $order->user->email ?? null }}</td>
                                <td>{{ $order->user->national_code ?? null }}</td>
                                <td>{{ jdate($order->created_at)->format('d F Y ساعت H:i') }}</td>
                                <td>{{ $order->cash_on_delivery ? 'پرداخت در محل تهران' : 'پرداخت آنلاین' }}</td>
                                <td>
                                    @switch($order->status)
                                        @case(0)
                                            <span class="label label-danger">منقضی شده</span>
                                            @break
                                        @case(1)
                                            <span class="label label-warning">منتظر پرداخت</span>
                                            @break
                                        @case(2)
                                            <span class="label label-success">پرداخت شده</span>
                                            @break
                                        @case(3)
                                            <span class="label label-primary">ارسال شده</span>
                                            @break
                                        @case(4)
                                            <span class="label label-warning">بازگشت خورده</span>
                                            @break
                                        @case(5)
                                            <span class="label label-success">کامل شده</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h4>لیست محصولات</h4>
                    <table class="table table-hover table-condensed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center r-tblle">ردیف</th>
                                <th class="text-center r-tblle">نام محصول</th>
                                <th class="text-center r-tblle">تعداد</th>
                                <th class="text-center r-tblle">گارانتی</th>
                                <th class="text-center r-tblle">قیمت اصلی </th>
                                <th class="text-center">تخفیف</th>
                                <th class="text-center">قیمت بعد از تخفیف</th>
                                <th class="text-center r-tblle">قیمت کل </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                            @php $instance = \Illuminate\Support\Facades\DB::table('order_products')->where('order_id', $order->id)->where('product_id', $product->id)->get(); @endphp
                            @foreach(\Illuminate\Support\Facades\DB::table('order_product_options')->where('order_product_id',
                            $instance[0]->id)->get() as $detail)
                            <tr>
                                <td class="text-center ta-ba"> {{$loop->parent->iteration}}</td>
                                <td class="text-center ta-ba"> {{ $product->name }}
                                    @if($detail->value)
                                    <?php $det = explode('~', $detail->option); ?>
                                    @foreach(explode('~', $detail->value) as $val)
                                    @if($val){{ '('.$det[$loop->index].' :'.$val.')' }}@endif
                                    @endforeach
                                    @endif
                                </td>
                                <td class="text-center ta-ba"> {{ $detail->quantity }} عدد</td>
                                <td class="text-center ta-ba"> {{ $detail->warranty?->name ?? 'ندارد' }}</td>
                                <td class="text-center ta-ba"> {{ number_format($product->price , 0) }}</td>
                                <td class="text-center ta-ba"> {{ number_format(($product->price)-($detail->price) , 0) }} تومان</td>
                                <td class="text-center ta-ba"> {{ number_format($detail->price , 0) }} تومان</td>
                                <td class="text-center ta-ba"> {{ number_format(($detail->price *
                                    $detail->quantity)+($product->price_taxation*
                                    $detail->quantity ), 0) }} تومان
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @foreach($order->products as $product)
                            <tr>
                                <td class="text-center ta-ba">{{$loop->iteration}}</td>
                                <td class="text-center ta-ba">
                                    {{ $product->name }}
                                    @if($product->variety_label)
                                        ({{ $product->variety_label }}: {{ $product->variety_value }})
                                    @endif
                                </td>
                                <td class="text-center ta-ba">{{ $product->pivot->quantity }} عدد</td>
                                <td class="text-center ta-ba">
                                @forelse($product->warranties as $warranty)
                                    @if($warranty->id === $product->pivot->warranty_id) {{ $warranty->name }} @endif
                                @empty
                                    ندارد
                                @endforelse
                                </td>
                                <td class="text-center ta-ba">{{ number_format($product->pivot->price , 0) }}</td>
                                <td class="text-center ta-ba">{{ number_format($product->pivot->discount, 0) }} تومان</td>
                                <td class="text-center ta-ba">0 تومان</td>
                                <td class="text-center ta-ba">
                                    {{ number_format($product->pivot->total_price, 0) }}
                                    تومان
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="ta-ba" rowspan="3" colspan="7">
                                    <!--<h5 class="title-tb">هزینه ارسال </h5>-->
                                    @if($order->delivery_price > 0)
                                     <p class="hzx">هزینه ارسال </p>
                                    <div class="prdkht"></div>
                                    @endif
                                    <!--<h5 class="title-tb"> مبلغ قابل پرداخت </h5>-->
                                    <p class="hzx">مبلغ قابل پرداخت </p>
                                </td>
                                  @if($order->delivery_price > 0)
                                     <td class="text-center ta-ba"> {{ number_format($order->delivery_price, 0) }} تومان </td>
                                 @endif
                            </tr>
                            <tr>
                                <td class="text-center ta-ba"> {{ number_format($order->total_price, 0) }} تومان </td>
                            </tr>
                        </tbody>
                    </table>
                
                    @if(count($order->payments) >0)
                        <hr>
                        <h4>لیست پرداخت‌ها</h4>
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کد پیگیری سفارش</th>
                                <th>کد پیگیری پرداخت</th>
                                <th>تاریخ ایجاد</th>
                        
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->tracking_code }}</td>
                                    <td>{{ $payment->ref_id }}</td>
                                    <td>{{ jdate($payment->created_at)->format('d F Y ساعت H:i') }}</td>
                          
                                    <td>
                                        @if($payment->status)
                                            <span class="label bg-green">پرداخت موفق</span>
                                        @else
                                            <span class="label bg-red">پرداخت ناموفق</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(count($order->sadadPayments) > 0)
                     <hr>
                        <h4>لیست پرداخت‌ها</h4>
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                               <th class="text-center">#</th>
                                <th class="text-center">کد پیگیری پرداخت</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->sadadPayments as $payment)
                               <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $payment->reference_id }}</td>
                                    <td class="text-center">{{ jdate($payment->created_at)->format('d F Y ساعت H:i') }}</td>
                                    <td class="text-center">
                                        @if($payment->status)
                                            <span class="label bg-green">پرداخت موفق</span>
                                        @else
                                            <span class="label bg-red">پرداخت ناموفق</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    
                    @endif
                    <hr>
                    <div class="well">
                        <h4>آدرس:</h4>
                        <p>
                            <strong>استان:</strong>
                            <span>{{$address && $address->city ?  $address->city->province->name : '' }}</span>
                            <br>
                            <strong>شهر:</strong>
                            <span>{{ $address && $address->city ? $address->city->name : '' }}</span>
                            <br>
                            
                           
                            <strong>کد پستی:</strong>
                            <span>{{ $address ? $address->post_code : '' }}</span>
                             <br>
                            <strong>آدرس:</strong>
                            <span>{{ $address ?  $address->address : '' }}</span>
                            <br>
                            <strong>تلفن:</strong>
                            <span>{{ $address ? $address->phone : '' }}</span>
                        </p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">وضعیت سفارش</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="{{ route('admin.orders.update', [$order->id]) }}" role="form" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="status" class="form-control">
                                            <option value="0"{{ ($order->status == 0 ? ' selected' : '') }}>منقضی شده</option>
                                            <option value="1"{{ ($order->status == 1 ? ' selected' : '') }}>در حال بررسی (منتظر پرداخت)</option>
                                            <option value="2"{{ ($order->status == 2 ? ' selected' : '') }}>پرداخت شده (در حال ارسال)</option>
                                            <option value="3"{{ ($order->status == 3 ? ' selected' : '') }}>ارسال شده</option>
                                            <option value="4"{{ ($order->status == 4 ? ' selected' : '') }}>بازگشت خورده</option>
                                            <option value="5"{{ ($order->status == 5 ? ' selected' : '') }}>کامل شده</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-primary" value="ذخیره تغییرات">
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">توضیحات سفارش</h3>
                </div>
                <div class="box-body">
                    <strong>یادداشت کاربر:</strong>
                    <p>{{ $order->description }}</p>
                </div>
                <div class="box-footer box-comments">
                    @foreach($order->notes as $note)
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ avatar($note->user->email) }}" alt="{{ $note->user->name }}">
                        <div class="comment-text">
                            <span class="username">
                                {{ $note->user->name }}
                                <span class="text-muted pull-right">{{ jdate($note->created_at)->format('d F Y ساعت H:i') }}</span>
                            </span>
                            {{ $note->content }}
                            @if($note->attachment)
                            <hr>
                            <a href="{{ url($note->attachment) }}">ضمیمه</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.orders.note', $order->id) }}" method="post">
                        @csrf
                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }} attachment">
                            <label for="attachment" class="control-label">فایل ضمیمه</label>
                            <input type="file" class="form-control" name="attachment" multiple>
                            @if ($errors->has('attachment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('attachment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="content" class="control-label">یادداشت</label>
                            <textarea id="content" name="content" class="form-control" rows="3" spellcheck="false" placeholder="متن یادداشت..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            افزودن یادداشت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
