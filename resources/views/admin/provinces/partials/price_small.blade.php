@if($province->price_small)
    {{ number_format($province->price_small, 0) }} تومان
@else
    مشخص نشده
@endif