<div class="col-12 gap-col gap-col-mob">
    <ul class="box-categori">
        @foreach($products as $product)
            @include('frontend.partials.product', compact('product'))
        @endforeach
    </ul>
</div>