@switch($attr)
    @case('user_id')
        {{ $log->subject }}
        @break
    {{--@case()
    
        @break
    @case()
    
        @break
    @case()
    
        @break
    @case()
    
        @break
    @case()
    
        @break
    @case()
    
        @break
        --}}
    @default
        {{ $value }}
@endswitch