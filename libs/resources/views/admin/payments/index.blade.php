@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست پرداخت‌ها</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>سفارش</th>
                            <th>مبلغ</th>
                            <th>کد پیگیری</th>
                            <th>Ref Id</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($payment->user_id)
                                <a href="{{ route('admin.users.edit', $payment->user_id) }}">{{ $payment->user->name }}</a>
                                @else
                                {{ $payment->order->name }}
                                @endif
                            </td>
                            <td><a href="{{ route('admin.orders.edit', $payment->order_id) }}">{{ $payment->order_id }}</a></td>
                            <td>
                                {{ number_format($payment->amount, 0) }}
                                تومان
                            </td>
                            <td>{{ $payment->tracking_code }}</td>
                            <td>{{ $payment->ref_id }}</td>
                            <td>{{ jdate($payment->created_at)->format('d F Y ساعت H:i') }}</td>
                            <td>
                                <span class="label label-{{ ($payment->status ? 'success' : 'warning') }}">{{ $payment->status ? 'پرداخت  شده' : 'پرداخت نشده' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="5">هیچ پرداختی یافت نشد!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $payments->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
