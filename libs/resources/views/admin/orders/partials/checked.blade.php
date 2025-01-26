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
@if($order->cash_on_delivery)
    <span class="label label-info">پرداخت در محل</span>
@endif
<span class="label label-{{ $order->checked ? 'success' : 'info' }}">
    {{ $order->checked ? 'بررسی شده' : 'جدید' }}
</span>
