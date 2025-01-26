@if($district->price_small)
    {{ number_format($district->price_small, 0) }} تومان
@else
    مشخص نشده
@endif