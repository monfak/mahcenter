@switch($log->log_name)
    @case('product')
        محصول
        @break
    @case('category')
        دسته بندی
        @break
    @case('manufacturer')
        تولیدکننده
        @break
    @case('warranty')
        گارانتی
        @break
    @case('page')
        صفحه
        @break
    @case('default')
        پیش فرض
        @break
    @default
        {{ $log->log_name }}
@endswitch
