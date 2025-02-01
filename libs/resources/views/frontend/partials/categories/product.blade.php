<div class="row products_container">
    @foreach($products as $product)
        <div class="product-layout product-grid item col-lg-4 grid-group-item col-12 col-sm-6 col-md-6 col-xl-3  ">
            <div class="product-thumb list-view product-main-categori">
                <div class="image">
                    <a href="{{ url('products/' . $product->slug) }}">
                        <img src="{{ asset(image_resize($product->image, ['width' => 228, 'height' => 228])) }}"
                             alt="{{ $product->alt }}"
                             class="img-fluid img-primary">

                        {{--                            <img src="{{ asset(image_resize($product->second_image?:$product->image, ['width' => 228, 'height' => 228])) }}"--}}
                        {{--                                 alt="{{ $product->alt }} - دوم"--}}
                        {{--                                 class="img-fluid img-secondary">--}}
                    </a>
                </div>
                <div class="d-block">
                    <div class="img-brand">
                        @if($product->manufacturer?->logo)
                            <img src="{{ asset($product->manufacturer->logo) }}" alt="{{ $product->manufacturer->name }}" title="{{ $product->manufacturer->name }}" class="img-fluid" style="width:70px">
                        @endif
                    </div>
                <h3 class="name-category" style="font-size:13px">
                    <a href="{{ url('products/' . $product->slug) }}">{{ $product->name }}</a>
                </h3>

                @unless($product->stock)
                    <p class="price__product mb-2 mt-2">
                        <strong class="text-muted">ناموجود</strong>
                    </p>
                @else
                    <div class="price__product mb-2 mt-2">
                        @if($product->hide_price)
                            <span class="price-product">تماس بگیرید</span>
                        @else
                            @unless(is_null($product->special))
                                <div class="col-12 cost text-center ps-0 off-pro">
                                  <div class="d-block">
                                    <span class="old-cost me-2">{{ number_format($product->price) }} <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">{{ $product->discount }} %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">{{ number_format($product->special) }}</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                            @else
                                <p>
                                    <span class="cost-total">{{ number_format($product->special ?? $product->price, 0) }} </span>
                                    <span class="unit">تومان</span>
                                </p>
                            @endunless
                        @endif
                    </div>
                @endunless
                    <div class="badge-container">
                        @if($product->is_festival && $site_settings['is_festival_active'])
                            <p class="badge badge-festival"><span>{{ $site_settings['festival_badge_heading'] }}</span></p>
                        @else
                            @unless(is_null($product->special))
                                <p class="badge badge-off"><span>فروش ویژه</span></p>
                            @endunless
                        @endif
                        @unless(is_null($product->badge))
                            <p class="badge badge-blue"><span>{{ $product->badge }}</span></p>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row mt-4 mb-4">
    <div class="col-12 text-center">{{ $products->links() }}</div>
</div>
