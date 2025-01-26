@foreach($cart->items as $item)
<a href="{{ route('admin.products.edit', $item->product->slug) }}" class="btn btn-default btn-xs">
    {{ $item->product->name }}
    @if($item->product->variety_label)
        (
        {{ $item->product->variety_label }}: {{ $item->product->variety_value }}
        - 
        {{ $item->quantity }} عدد)
    @endif
</a>
@endforeach
