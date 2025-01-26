@extends('frontend.layouts.app')
@section('title', 'سفارشات')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
               <div class="card crd-info">
                    <div class="text-h5">سفارشات شما</div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
                
                <div class="table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">شماره سفارش</th>
                                <th class="text-center">کد پیگیری</th>
                                <th class="text-center">موبایل</th>
                                <th class="text-center">جمع</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->tracking_code }}</td>
                                <td class="text-center">{{ $order->mobile }}</td>
                                <td class="text-center">{{ number_format($order->total_price, 0) }}</td>
                                <td class="text-center">{{ ['منقضی شده', 'منتظر پرداخت', 'در حال آماده‌سازی', 'ارسال شده', 'بازگشت خورده', 'کامل شده'][$order->status] }}</td>
                                <td class="text-center">
                                    <a href="{{ route('frontend.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                        <span class="fa fa-eye"></span> مشاهده
                                    </a>
                                    @if($order->status == 1 && false)
                                    <a href="{{ route('payments.request', $order->id) }}" class="btn btn-success btn-sm">
                                        <span class="fa fa-money"></span> پرداخت
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">شما تاکنون هیچ سفارشی نداده‌اید.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
                   </div>
               </div>
          
        </div>
    </div>
@endsection
