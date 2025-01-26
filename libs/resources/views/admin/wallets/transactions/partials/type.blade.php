@switch($paymentMethod->type)
    @case(1)
        درگاه
        @break
    @case(2)
        کیف پول
        @break
    @case(3)
        ثبت با رسید
        @break
    @case(4)
        ثبت سریع
        @break
    @default
    تعریف نشده
@endswitch