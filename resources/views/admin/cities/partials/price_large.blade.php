@if($city->price_large)
    {{ number_format($city->price_large, 0) }} تومان
@else
    مشخص نشده
@endif