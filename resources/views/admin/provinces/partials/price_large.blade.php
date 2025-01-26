@if($province->price_large)
    {{ number_format($province->price_large, 0) }} تومان
@else
    مشخص نشده
@endif