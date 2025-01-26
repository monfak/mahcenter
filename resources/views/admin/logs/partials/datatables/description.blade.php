@switch($log->description)
    @case('updated')
        بروزرسانی
        @break
    @case('created')
        ایجاد
        @break
    @case('deleted')
        حذف
        @break
    @default
        {{ $log->description }}
@endswitch