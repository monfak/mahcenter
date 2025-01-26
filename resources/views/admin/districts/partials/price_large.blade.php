@if($district->price_large)
    {{ number_format($district->price_large, 0) }} تومان
@else
    مشخص نشده
@endif