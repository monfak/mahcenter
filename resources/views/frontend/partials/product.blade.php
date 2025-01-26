<div class="product-thumb list-view product-main-categori">
    <li>
        <div class="card">
            <div class="card-body">
                <div class="img-box box14">
                    <img src="{{ asset(\App\ImageManager::resize($product->image, ['width' => 331, 'height' => 355])) }}" class="img-fluid" alt="{{ $product->alt }}">
                    <a href="{{ route('products.show', [$product->slug]) }}" class="box-content">
                        <h3 class="title">{{ $product->name }}</h3>
                        <span class="post">مشاهده جزئیات محصول</span>

                    </a>
                </div>
                <p class="product-name">
                    {{ $product->name }}
                </p>
                <div class="row row-middel-box">
                    <div class="col-sm-3 gap-col">
                        <span class="rate">
                            <i class="fa{{ ($product->approvedReviews->avg('star') == 5 ? 's' : 'r') }} fa-star"></i>
                            <i class="fa{{ ($product->approvedReviews->avg('star') >= 4 ? 's' : 'r') }} fa-star"></i>
                            <i class="fa{{ ($product->approvedReviews->avg('star') >= 3 ? 's' : 'r') }} fa-star"></i>
                            <i class="fa{{ ($product->approvedReviews->avg('star') >= 2 ? 's' : 'r') }} fa-star"></i>
                            <i class="fa{{ ($product->approvedReviews->avg('star') >= 1 ? 's' : 'r') }} fa-star"></i>
                        </span>
                    </div>
                    <div class="col-sm-9 cost-product">
                        @if($product->hide_price)
                            <span class="new-pro">تماس بگیرید</span>
                        @else
                            @if($product->special)
                                <span class="old-pro">
                                   <span class="unit"> ت</span> {{ number_format($product->price, 0) }}
                                </span>
                            @endif
                            <span class="new-pro">
                               <span class="unit"> ت</span> {{ number_format($product->special ?? $product->price, 0) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-9 gap-col gap-col-mob">
                        <ul class="item-view">
                            <li>
                                <button data-toggle="tooltip" data-placement="top" title="" data-original-title="اضافه به لیست علاقه مندی" class="btn addToWishlist" onClick="">
                                    <input type="hidden" class="productId" value="{{ $product->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </li>
                            <li>
                                <button data-toggle="tooltip" data-placement="top" title="" data-original-title="مقایسه محصول" class="btn addToCompare" onClick="">
                                    <input type="hidden" class="productId" value="{{ $product->id }}">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                            </li>
                            <li>
                                <a href="{{ route('products.show', [$product->slug]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="مشاهده جزئیات محصول" class="btn" onClick="">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-3 gap-col gap-col-mob ajax-form">
                        <input type="hidden" class="productId" value="{{ $product->id }}">
                        <input type="hidden" class="quantity" value="1">
                        <button class="btn form-control btn-sale addToCart" onClick="">
                            <i class="fas fa-cart-plus"></i>
                            <span class="d-none d-md-block">خرید کنید</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </li>
</div>
