<ul class="list-search mt-3 ps-0">
    @forelse($products as $product)
        <li>
            <a href="{{ route('products.show', $product->slug) }}">
                <i class="fal fa-search ms-1"></i>
                {{ $product->name }} @unless($product->stock) (ناموجود) @endunless
            </a>
        </li>
    @empty
        <li>موردی یافت نشد!</li>
    @endforelse
</ul>