@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-bcart">
                    <h3 class="box-title">جزئیات سبد</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.carts.index') }}" class="btn btn-default btn-sm">لیست سبدهای خرید
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-condensed table-bcarted table-striped">
                        <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>نام کاربر</th>
                            <th>موبایل</th>
                            <th>ایمیل</th>
                            <th>تاریخ ثبت</th>
                            <th>سشن</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $cart->id }}</td>
                                <td>{{ ($cart->user?->name) }}</td>
                                <td>{{ $cart->user?->mobile }}</td>
                                <td>{{ $cart->user?->email }}</td>
                                <td>{{ jdate($cart->created_at)->format('d F Y ساعت H:i') }}</td>
                                <td>{{ $cart->session_id }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h4>لیست محصولات</h4>
                    <table class="table table-hover table-condensed table-bcarted table-striped">
                        <thead>
                            <tr>
                                <th class="text-center r-tblle">ردیف</th>
                                <th class="text-center r-tblle">نام محصول</th>
                                <th class="text-center r-tblle">تعداد</th>
                                <th class="text-center r-tblle">قیمت اصلی </th>
                                <th class="text-center">قیمت دارای تخفیف</th>
                                <th class="text-center r-tblle">قیمت کل </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                            <tr>
                                <td class="text-center ta-ba">{{$loop->iteration}}</td>
                                <td class="text-center ta-ba">
                                    {{ $item->product->name }}
                                    @if($item->product->variety_label)
                                        ({{ $item->product->variety_label }}: {{ $item->product->variety_value }})
                                    @endif
                                </td>
                                <td class="text-center ta-ba">{{ $item->quantity }} عدد</td>
                                <td class="text-center ta-ba">{{ number_format($item->price, 0) }}</td>
                                <td class="text-center ta-ba">{{ $item->special ? number_format($item->special, 0) : 'ندارد' }}</td>
                                <td class="text-center ta-ba">
                                    {{ number_format(($item->special ?? $item->price) * $item->quantity, 0) }}
                                    تومان
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="well">
                        <h4>آدرس:</h4>
                        <p>
                            <strong>استان:</strong>
                            <span>{{$cart->address && $cart->address?->city ?  $cart->address?->city?->province?->name : '' }}</span>
                            <br>
                            <strong>شهر:</strong>
                            <span>{{ $cart->address && $cart->address?->city ? $cart->address?->city?->name : '' }}</span>
                            <br>
                            <strong>کد پستی:</strong>
                            <span>{{ $cart->address ? $cart->address?->post_code : '' }}</span>
                            <br>
                            <strong>آدرس:</strong>
                            <span>{{ $cart->address ?  $cart->address?->address : '' }}</span>
                            <br>
                            <strong>تلفن:</strong>
                            <span>{{ $cart->address ? $cart->address?->phone : '' }}</span>
                        </p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@endsection
