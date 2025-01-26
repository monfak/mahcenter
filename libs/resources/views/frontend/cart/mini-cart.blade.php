<div class="mini-cart-header">
    <span class="mini-cart-products-count fa-num"><span class="itemsInBasket">{{ $itemsInBasket['quantity'] }}</span> کالا</span>
    <a href="{{ route('cart') }}" class="btn btn-link px-0">مشاهده سبد خرید </a>
</div>
<div class="mini-cart-products do-simplebar">
    <div class="simplebar-wrapper" style="margin:0px">
        <div class="simplebar-mask">
            <div class="simplebar-offset">
                <div class="simplebar-content-wrapper">
                    <div class="simplebar-content">
                        @foreach($itemsInBasket['products'] as $product)
                        <div class="mini-cart-product">
                            <div class="mini-cart-product-thumbnail">
                                <a href="{{ route('products.show', $product['slug']) }}">
                                    <img src="{{ asset(image_resize($product['image'], ['width' => 50, 'height' => 50])) }}" alt="{{ $product['name'] }}" />
                                </a>
                            </div>
                            <div class="mini-cart-product-detail">
                                <div class="mini-cart-product-brand">
                                    <a href="{{ route('products.show', $product['slug']) }}">{{ $product['name'] }}</a>
                                </div>
                                <div class="mini-cart-product-title">
                                    <a href="{{ route('products.show', $product['slug']) }}">{{ $product['model'] }}</a>
                                </div>
                                <div class="mini-cart-purchase-info">
                                    <div class="mini-cart-product-meta">
                                        <span class="fa-num">{{ $product['quantity'] }} عدد</span>
                                    </div>
                                    <div class="mini-cart-product-price fa-num">
                                        {{ number_format($product['totalPrice'], 0) }}
                                        <span class="currency">تومان</span>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('cart.delete', $product['id']) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="mini-cart-product-remove">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mini-cart-footer">
  <div class="mini-cart-total">
    <span class="mini-cart-total-label">مبلغ قابل پرداخت:</span>
    <span class="mini-cart-total-value fa-num">
        {{ number_format($itemsInBasket['totalPrice'], 0) }}
        <span class="currency">تومان</span>
    </span>
  </div>
  <a href="{{ route('cart') }}" class="btn btn-primary">ثبت سفارش</a>
</div>