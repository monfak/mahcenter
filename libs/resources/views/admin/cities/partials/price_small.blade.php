@if($city->price_small)
    {{ number_format($city->price_small, 0) }} تومان
@else
    مشخص نشده
@endif