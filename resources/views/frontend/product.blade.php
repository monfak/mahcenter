@extends('frontend.layouts.app')
@section('title', $product->title ?? $product->name)
@section('description', $product->meta_description)
@section('image', asset($product->image))
@section('twitter_title', $product->twitter_title ?? $product->title ?? $product->name)
@section('twitter_description', $product->twitter_description ?? $product->meta_description)
@section('image', asset($product->image))
@section('og_image', asset($product->og_image ?? $product->image))
@section('twitter_image', asset($product->twitter_image ?? $product->image))
@section('canonical', $product->canonical ?? url()->current())
@section('seo')
@if($product->is_noindex && $product->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($product->is_noindex)
    <meta name="robots" content="noindex">
@elseif($product->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('styles')
<style>
    .col-12.no-product-box {
        min-height: 188px;
    }

    .no-product {
        width: 100%;
        float: right;
        display: block;
        height: 22px;
        position: relative;
    }

    .no-product .val {
        position: absolute;
        right: 0;
        left: 0;
        margin: auto;
        display: inline-block;
        width: 92px !important;
        text-align: center;
        background-color: #f5f5f5;
        z-index: 1;
        color: #969696;
        font-size: 16px;
        top: -2px;
        font-weight: 700;
    }


    .addToNotifications {
        width: 100%;
        border-width: 0;
        background: red;
        color: #fff;
        border-radius: 8px;
        text-align: center;
        font-size: 1rem;
        cursor: pointer;
        display: block;
        list-style: none;
        padding: 16px 25px 16px 18px;
        margin-top: 10px;
    }

    .red {
        background-color: #7a7a7a;
    }

    .c-gallery__options li.addToNotifications {
        padding: 2px 5px !important;
    }
    .modal-content {
      border-radius: 7px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
      border-bottom: none;
      padding: 1rem 1.5rem;
      border-radius: 7px;
    }

    .header-divider {
      border-bottom: 1px solid #ddd;
      margin: 0 1.5rem;
    }

    .modal-body {
      padding: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .modal-footer {
      border-top: none;
      padding: 0.75rem 1.5rem;
    }

    .modal-body img {
      border-radius: 7px;
    }

    .modal-title {
      font-size: 1.25rem;
      font-weight: bold;
      padding: 0 1rem;
    }

    .modal-footer .btn {
      padding: 0.75rem;
      border-radius: 10px;
    }

    .fas.fa-check-circle {
      font-size: 1.2rem;
    }
</style>
<link href="/css/mCustomScrollbar.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery.fancybox.min.css" rel="stylesheet">
@endsection
@section('scripts')
<script src="/js/jquery.fancybox.min.js"></script>
<script src="/js/zoom.js"></script>
<script>
    var viewportWidth = $(window).width();
    if( viewportWidth > 767 ){
        $("#zoom_01").elevateZoom({
           scrollZoom: true,
                zoomWindowPosition: 11
        });
    }
</script>
<script>
    $(document).ready(function () {
        // assign captions from title-attributes:
        $("[data-fancybox]").each(function () {
            $(this).attr("data-caption", $(this).attr("title"));
        });
        // start fancybox on all elements with attribute 'data-fancybox':
        $("[data-fancybox]").fancybox();
    });
</script>
<script>
    $("body").delegate(".c-product .thumbnail", "click", function (event) {
            event.preventDefault();
            var selected = $(this);

            new_html = '<a onclick="return false;" class="thumbnail first_thumbnail" href="' + selected.attr('href') + '" title="{{ $product->alt }}">';
            new_html += '<img id="zoom_01" src="' + selected.attr('href') + '" alt="{{ $product->alt }}" data-zoom-image="' + selected.attr('big_image') + '"/>';
            new_html += '</a>';

            $(".first_thumbnail").parent().html(new_html);
            $(".zoomContainer").remove();

            var viewportWidth = $(window).width();
            if( viewportWidth > 767 ){
                $('#zoom_01').elevateZoom({
                    scrollZoom: true,
                    zoomWindowPosition: 11
                });
            } else if( viewportWidth < 768 ) {
                $('#zoom_01').elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair"
                });
            }
        });
</script>
<script>

   $('.owl-related').owlCarousel({
            //loop: true,
            // autoplay: true,
            autoplayTimeout:4000,

            autoplayHoverPause: true,
            smartSpeed:450,
            rtl:true,

            navText: ["<i class='fas fa-angle-left'></i>","<i class='fas fa-angle-right'></i>"],
            lazyLoad: true,
            responsive:{
                0:{
                      margin:10,
                     stagePadding: 20,
                    items:2,
                    dots:false,
                    nav:false
                },
                500:{
                      margin:10,
                     stagePadding: 10,
                    items:3,
                    dots:true,
                    nav:false
                },
                768:{
                    margin:10,
                    items:4,
                    dots:true,
                    nav:false

                },
                1200:{
                      margin:20,
                    items:5,
                    dots:true,
                    nav:false
                }
            }
        });

    $("[data-toggle=popover]").each(function(i, obj) {
        $(this).popover({
            html: true,
            content: function() {
                var id = $(this).attr('id')
                return $('#popover-content-' + id).html();
            }
        });
    });

    function getSelectedOptions() {
        var selectedOptions = {};

        $(".selectOptions").each(function () {
            var optionValue = $(this).val();
            selectedOptions[$(this).attr("name")] = optionValue;
        });

        if ($(".productOptionInput:checked").length > 1) {
            selectedOptions.values = [];
            $(".productOptionInput:checked").each(function () {
                selectedOptions.values.push($(this).val());
            });
        } else if ($(".productOptionInput:checked").length === 1) {
            selectedOptions[$(".productOptionInput:checked")[0].name] = $(".productOptionInput:checked").val();
        }

        return selectedOptions;
    }

$(".warrantyPrice").on("change", function () {
    var warrantyPrice = $(this).attr("data-price");
    var warrantyName = $(this).attr("data-name");
    $('#warranty-name').html(warrantyName);
    $('#productPrice').html(warrantyPrice);
});

$(document).ready(function () {
    $('.addToCart').on('click', function() {
        var warrantyId = null;
        if ($(".warrantyPrice:checked").length >= 1) {
            var warrantyId = $(".warrantyPrice:checked").val();
        }
        var productId = $(this).closest('.ajax-form').find('.productId').val();
        var quantity  = $(this).closest('.ajax-form').find('.quantity').val();
        var productSlug = $(this).closest('.ajax-form').find('.productSlug').val();
        addToCart(productId, quantity, warrantyId, productSlug);
    });
    $('[data-fancybox="mygallery"]').fancybox({
      afterLoad : function(instance, current) {
        current.$image.attr('alt', current.opts.$orig.find('img').attr('alt') );
      }
    });
});

/**
 * Adds a product with its quantity to the cart using ajax.
 *
 * @param product_id
 * @param quantity
 * @param option selected option of product
 */
 function addToCart(product_id, quantity, warrantyId,productSlug) {
    if (quantity === undefined) {
        quantity = 1;
    }
   $.ajax({
        type: 'POST',
        url: "/cart/add/" + product_id,
        data: {
            quantity: quantity,
            warranty_id: warrantyId,
            _method: "POST"
        },
         success: function(response) {
             if(response.status == 'success') {
                /*iziToast.success({
                    message: response.body,
                    'position': 'center'
                });*/
                showAddToCartModal();
                $('.itemsInBasket').html(response.itemsInBasket['quantity']);
                $('.mini-cart').html(response.itemsInBasket['items']);
            } else {
                iziToast.error({
                    message: response.body,
                    'position': 'center'
                });
            }
        },
        error: function(e) {
              Toast.fire({
                icon: 'error',
                title: 'متاسفانه مشکلی در افزودن محصول به سبد خرید پیش آمد.'
              })
        }
    });
}
if (matchMedia('only screen and (min-width:992px)').matches) {
    $(function(){
        var owl = $('.thumb-product3');
        owl.owlCarousel({
            rtl:true,
            margin:10,
            loop:false,
            nav:false,
            dots:false,
            autoplay:false,
            items:4,
            touchDrag: false,
            mouseDrag: false,
            navText:['<i class="fa fa-angle-left fa-2x fa-fw" aria-hidden="true"></i>','<i class="fa fa-angle-right fa-2x fa-fw" aria-hidden="true"></i>']
        });
    });
}
if (matchMedia('only screen and (max-width:991.99px)').matches) {
    $(function(){
        var owl = $('.thumb-product3');
        owl.owlCarousel({
            rtl:true,
            margin:0,
            loop:false,
            nav:false,
            dots:true,
            autoplay:false,
            items:1,
            navText:['<i class="fa fa-angle-left fa-2x fa-fw" aria-hidden="true"></i>','<i class="fa fa-angle-right fa-2x fa-fw" aria-hidden="true"></i>']
        });
    });
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ asset($product->image) }}",
  "description": "{{ $product->meta_description }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $product->manufacturer?->name }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url('products/' . $product->slug) }}",
    "priceCurrency": "IRR",
    "price": "{{ $product->special ?? $product->price}}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "150"
  }
}
</script>
<script>
function showAddToCartModal() {
  var addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'), {
    keyboard: false
  });
  addToCartModal.show();
  setTimeout(function() {
    addToCartModal.hide();
  }, 5000);
}
</script>
@endsection
@section('content')

<!--content-start-->
<div class="container-fluid  gap-col-mob content-page pb-4">
    <div class="row">
        <div class="breadcrumb col-12 gap-col gap-col-mob mt-4 p-0">
            <ul class="breadcrumbs m-0 w-100 bg-white border rounded p-2">
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/') }}">صفحه اصلی</a></li>
                <li class="float-left">/</li>
                {{--<li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/products') }}">تمام محصولات </a></li>
                <li class="float-left">/</li>--}}
                @foreach($productCategories as $productCategory)
                    <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ $productCategory->parent_id === null ? route('category.desc', $productCategory->slug) : route('category.show', $productCategory->slug) }}">{{ $productCategory->name }}</a></li>
                    <li class="float-left">/</li>
                @endforeach
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/products/' . $product->slug) }}">{{ $product->name }}</a></li>
            </ul>
          </div>
    </div>
</div>
@unless($product->stock)
<div class="container-fluid suggested-products-section">
    <div id="related-products">
        <div class="row">
            <div class="col-12 col-sm-12 mt-2">
                <h5 class="line-after">محصولات مرتبط</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 p-0">
                <div class="owl-carousel owl-theme owl-related">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="item">
                            <div class="item-img">
                                <div class="row">
                                    <div class="col-12 p-0 pt-3 text-center">
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                           class="img-pro-wnd" target="_blank">
                                          <img class="img-fluid" alt="{{ $relatedProduct->alt }}" src="{{ asset(image_resize($relatedProduct->image , ['width' => 233, 'height' => 220])) }}" >
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-left pro-name">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                </div>
                            </div>
                            <div class="row mt-2 align-items-end">
                                <div class="col-12 cost text-right pr-3">
                                    @if($relatedProduct->special)
                                    <span class="old-cost">{{ number_format($relatedProduct->price) }}</span>
                                    <span class="offer-mob"><span class="off">% {{ $relatedProduct->discount }}</span></span>
                                    <br>
                                    @endif
                                    <span class="cost-total">{{ number_format($relatedProduct->special ?? $relatedProduct->price) }}</span>
                                    <span class="unit">تومان</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endunless
<div class="container-fluid">
    <div class="row c-product">
        <div class="col-sm-4 col-12 position-relative">
            <ul class="c-gallery__options ps-0">
                <li class="addToWishlist" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="اضافه به لیست علاقه مندی">
                    <input type="hidden" class="productId" value="{{ $product->id }}">
                    <i class="fal fa-heart"></i>
                </li>
                {{--<li data-toggle="modal" data-target="#modal-share" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="اشتراک گذاری">
                    <i class="fal fa-share-alt"></i>
                </li>--}}
                <li class="addToCompare" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="اضافه به لیست مقایسه">
                    <input type="hidden" class="productId" value="{{ $product->id }}">
                    <i class="fal fa-balance-scale"></i>
                </li>
                @unless($product->stock)
                <li class="addToNotifications" data-bs-toggle="tooltip" data-bs-placement="right" title="مرا آگاه کن">
                    <input type="hidden" class="productId" value="{{ $product->id }}">
                    @if(auth()->check() && auth()->user()->notifications()->where('id', $product->id)->first())
                    <input type="hidden" class="nofity-status" value="yes">
                    <i class="fa fa-bell-slash" id="bell"></i>
                    @else
                    <input type="hidden" class="nofity-status" value="no">
                    <i class="fa fa-bell" id="bell"></i>
                    @endif
                </li>
                @endunless
            </ul>
            <ul class="thumbnails">
                <li style="position: relative;" class="big-images">
                    <a data-fancybox="mygallery" class="thumbnail first_thumbnail" href="{{ asset($product->image) }}">
                        <img id="zoom_01" src="{{ asset($product->image) }}" alt="{{ $product->alt }}" class="img-fluid" data-zoom-image="{{ asset($product->image) }}" />
                    </a>
                </li>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slide-image2 ">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="owl-carousel owl-theme thumb-product3">
                                <div class="item">
                                    <a data-fancybox="mygallery" class="thumbnail" big_image="{{ asset($product->image) }}"
                                        href="{{ asset($product->image) }}">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->alt }}" />
                                    </a>
                                </div>
                                @foreach($product->images as $image)
                                <div class="item">
                                    <a data-fancybox="mygallery" class="thumbnail" big_image="{{ asset($image->image) }}"
                                        href="{{ asset($image->image) }}">
                                        <img src="{{ asset($image->image) }}" alt="{{ $image->alt }}" />
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
        <div class="col-sm-8 col-12">
            <div class="row row-pro-name">
                <div class="col-sm-8 col-12">
                    <h1 class="c-product__title">
                        {{ $product->name }}
                        <span>{{ $product->model }}</span>
                    </h1>
                </div>
                <div class="col-sm-4 col-12 rate-box gap-col">
                    {{--<p class="class="rate"">
                    <span >
                        <i class="fa{{ ($product->approvedReviews->avg('star') == 5 ? 's' : 'r') }} fa-star"></i>
                        <i class="fa{{ ($product->approvedReviews->avg('star') >= 4 ? 's' : 'r') }} fa-star"></i>
                        <i class="fa{{ ($product->approvedReviews->avg('star') >= 3 ? 's' : 'r') }} fa-star"></i>
                        <i class="fa{{ ($product->approvedReviews->avg('star') >= 2 ? 's' : 'r') }} fa-star"></i>
                        <i class="fa{{ ($product->approvedReviews->avg('star') >= 1 ? 's' : 'r') }} fa-star"></i>
                        <a href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">{{ $product->approvedReviews->count() }}
                            نظر</a> /
                        <a href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">نوشتن
                            نظر</a>
                    </span>
                    <span>از {{ $product->approvedReviews->count() }} رای</span>
                    </p>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-12">
                    <ul class="c-product__directory ps-0">
                        @if($product->manufacturer)
                        <li>
                            <span><b>برند</b></span> :
                            <a href="{{ route('manufacturers.show', [$product->manufacturer->slug]) }}"
                                class="btn-link-spoiler product-brand-title">{{ $product->manufacturer?->name }}</a>
                        </li>
                        @endif
                        <li>
                            <span><b>دسته‌بندی</b></span> :
                            @foreach($productCategories as $productCategory)
                                <a href="{{ $productCategory->parent_id === null ? route('category.desc', $productCategory->slug) : route('category.show', $productCategory->slug) }}" class="btn-link-spoiler">{{
                                    $productCategory->name }}
                                </a>
                                @if(!$loop->last)
                                -
                                @endif
                            @endforeach
                        </li>
                    </ul>

                    <input type="hidden" id="productid" value="{{ $product->id }}">
                   {{-- @foreach($product->options as $option)--}}
                    <div class="c-product__variants">
                        {{--<input type="hidden" id="optioId" data-opt="{{$option->id}}">--}}
                        <style>
                            .bobx5 {
                                width: 100%;
                            }
                        </style>
                        <ul>
                        @if($product->warranties_count)
                            <li class="lbl-obtion">گارانتی</li>
                            @foreach($product->warranties as $warranty)
                            <li class="js-c-ui-variant optionWrapper">
                                <label class="c-ui-variant c-ui-variant--color" data-code="#212121">
                                    @if($warranty->image)
                                    <img src="{{ asset(image_resize($warranty->image, ['width' => 17, 'height' => 17])) }}" alt="{{ $warranty->name }}">
                                    @endif
                                    <input type="radio" value="{{ $warranty->id }}" data-name="{{ $warranty->name }}" data-price="{{ number_format(($product->special ?? $product->price) + $warranty->price, 0, '.', ',')}}" data-opt="{{ $warranty->id }}" data-operation="{{ $product->id }}" name="warranty_id" class="js-variant-selector productOptionInput warrantyPrice"{{ $loop->last ? ' checked' : '' }}>
                                    <span class="c-ui-variant__check">{{ $warranty->name }}</span>
                                </label>
                            </li>
                            @endforeach
                            <br>
                        @endif
                        {{--@foreach($option->optionValues as $optionValue)
                        @if($loop->first)
                        <li class="lbl-obtion">رنگ کالا</li>
                        @endif
                        <li class="js-c-ui-variant optionWrapper">
                            <label class="c-ui-variant c-ui-variant--color" data-code="#212121">
                                @if($optionValue->image)
                                <img src="{{ asset(image_resize($optionValue->image, ['width' => 17, 'height' => 17])) }}"
                                    alt="{{ $optionValue->name }}">
                                @endif
                                @if(is_null($optionValue->pivot->price))
                                <input type="hidden" class="optionPrice" value="0">
                                @elseif($optionValue->pivot->surplus_price)
                                <input type="hidden" class="optionPrice"
                                    value="{{ number_format(($special ?? $product->price) + $optionValue->pivot->price, 0, '.', ',')}}">
                                @else
                                <input type="hidden" class="optionPrice"
                                    value="{{ number_format(($special ?? $product->price) - $optionValue->pivot->price, 0, '.', ',')}}">
                                @endif
                                <input type="radio" value="{{ $optionValue->id }}"
                                    data-price="{{ $optionValue->pivot->price ?? 0 }}" data-opt="{{$option->id}}"
                                    data-operation="{{ $product->id }}" name="optionValue[{{ $option->id }}]"
                                    class="js-variant-selector productOptionInput"{{ $loop->first ? ' checked' : '' }}>
                                <span class="c-ui-variant__check">{{ $optionValue->name }}</span>
                            </label>
                        </li>
                        @endforeach--}}
                        @if(count($product->relatedProducts) > 0)
                            <br>
                            <li class="lbl-obtion">سایر رنگ‌ها</li>
                            @foreach($product->relatedProducts as $pro)
                            <li>
                                <label>
                                    <a href="{{route('products.show', $pro->slug)}}">
                                        <span class="c-ui-variant__check">{{ $pro->label ?? $pro->name }}</span>
                                    </a>
                                </label>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                    </div>
                    {{--@endforeach--}}
                    <div class="detail my-4">
                        @if($highlightAttributes)
                        <p>ویژگی‌های محصول</p>
                        <ul class="product-detail mt-3">
                            @foreach($highlightAttributes as $name => $value)
                           <li>
                              <div class="t-attrib"> {{ $name }} </div>
                             <div class="v-attrib">  {{ $value }} </div>
                          </li>
                            @endforeach
                        </ul>
                        <div id="showmenu" class="mt-2 text-center">
                            <a href="#attributes">
                             مشاهده همه ویژگی‌ها
                                <i class="fal fa-chevron-left"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                        @if($product->catalogue)
                         <a class="btn btn-dark " href="{{ asset($product->catalogue ) }}"
                            download="{{asset($product->catalogue ) }}">
                            <i class="mr-1 fa fa-download"></i>
                            {{$product->catalogue_name ?? 'دانلود کاتالوگ'}}
                        </a>
                        @endif
                </div>
                <div class="col-sm-4 col-12 pe-md-0 ps-md-0">
                  <div class="card crd-price">
                      <div class="card-body text-center">
                        @if($product->variety_label && $product->variety_value)
                        <div class="c-product__guarantee">
                            <span class="c-product__guarantee-text js-guarantee-text">
                                <i class="fas fa-palette icon-gray"></i>
                                <span><b>{{ $product->variety_label }}: {{ $product->variety_value }}</b></span>
                            </span>
                        </div>
                        @endif
                        @foreach($product->warranties as $warranty)
                        @unless($loop->last) @continue @endunless
                        <div class="c-product__guarantee">
                            <span class="c-product__guarantee-text js-guarantee-text">
                                <i class="fas fa-shield-alt icon-gray"></i>
                                <span><b id="warranty-name">{{ $warranty->name }}</b></span>
                            </span>
                        </div>
                        @endforeach
                        @if($product->giftcard)
                        <div class="c-product__guarantee">
                            <span class="c-product__guarantee-text js-guarantee-text">
                                <i class="fas fa-credit-card icon-gray"></i>
                                <span><b>{{ $product->giftcard }}</b></span>
                            </span>
                        </div>
                        @endif
                        <div class="c-product__delivery">
                            <div class="c-product__delivery-seller">
                                <i class="fas fa-store icon-gray"></i>
                                @if($product->stock)
                                <b>موجود در فروشگاه اصلی</b>
                                @else
                                <b> ناموجود</b>
                                @endif
                            </div>
                            {{--<div class="c-product__delivery-warehouse js-warehouse-status ">--}}
                                {{--<i class="fas fa-truck-moving"></i>--}}
                                {{--<span class="js-lead-time-prefix ">آماده</span>--}}
                                {{--ارسال--}}
                                {{--<span class="js-variant-lead-time"> از--}}
                                    {{--<span class="js-variant-lead-time-value">۲</span> روز آینده--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                        </div>
                        @if($product->stock)
                        @if($product->hide_price)
                            <div class="c-add-to-card ajax-form text-center mt-2">
                                <a href="tel:{{ str_replace(' ', '', str_replace('-', '', $site_settings['mobile'])) }}"
                                   class="btn-add-to-cart js-add-to-cart js-btn-add-to-cart text-light text-center w-100">
                                    <span class="btn-add-to-cart__txt">تماس بگیرید</span>
                                </a>
                            </div>
                        @else
                        @if($product->special)
                        <del class=" price_value" id="productPriceDefault">{{ number_format($product->price, 0) }}
                            تومان</del><br>
                        @endif
                        <ins class="text-danger price_value">
                            <span class="c-price__currency" id="productPrice">@if($product->special) {{ number_format($product->special, 0) }}
                                @else {{ number_format($product->price, 0) }} @endif</span>
                            <span class="c-price__currency">تومان</span>
                        </ins>
                        @endif
                        @unless($product->hide_price)
                        <div class="c-add-to-card ajax-form text-center mt-2">
                            <input type="hidden" class="productId" value="{{ $product->id }}">
                            <input type="hidden" class="quantity" value="1">
                            <button class="btn-add-to-cart js-add-to-cart js-btn-add-to-cart addToCart text-light text-center w-100">
                                <span class="btn-add-to-cart__txt">افــزودن به سبــد خریــد</span>
                            </button>
                        </div>
                        @endunless
                        @if($product->stock < 3 ) <p class="text-danger">
                            از این کالا تنها {{$product->stock}} عدد در انبار موجود است
                            </p>
                            @endif

                            @else

                            <div class="row m-2">
                                <div class="col-12">
                                    <span class="text-not-exist">
                                        متاسفانه این کالا در حال حاضر موجود نیست، می توانید از لیست محصولات مرتبط دیدن
                                        فرمایید.
                                    </span>
                                </div>
                                <div class="col-12 col-md-12 no-product-box">

                                    <span class="btn-not-exist">
                                        @unless($product->stock)
                                        <li
                                            class="addToNotifications {{ (auth()->check() && auth()->user()->notifications()->where('id', $product->id)->first()) ? 'red' : '' }}">
                                            <input type="hidden" class="productId" value="{{ $product->id }}">
                                            @if(auth()->check() && auth()->user()->notifications()->where('product_id',
                                            $product->id)->first())
                                            <input type="hidden" class="nofity-status" value="yes">
                                            <i class="fa fa-bell-slash" id="test" title="اطلاع‌رسانی"></i>

                                            @else
                                            <input type="hidden" class="nofity-status" value="no">
                                            <i class="fa fa-bell" id="test" title="اطلاع‌رسانی"></i>
                                            @endif
                                            <span class="notify_message">موجود شد اطلاع بده</span>

                                        </li>
                                        @endunless
                                    </span>
                                </div>
                            </div>
                            @endif
                      </div>
                  </div>
                </div>
            </div>

        </div>
    </div>
       @isset($deliveryFeatures)
            <div class="row row-feature">
                @foreach($deliveryFeatures->orderedItems as $item)
                <div class="c-product__feature-col">
                    <a href="{{ $item->url }}" target="_blank"
                        class="c-product__feature-item c-product__feature-item--1" title="{!! $item->title !!}">
                        <span class="icon"><img src="{{ asset($item->image) }}" alt="{!! $item->title !!}"></span>
                        <span>{!! $item->title !!}</span>
                    </a>
                </div>
                @endforeach
            </div>
            @endisset
    <div id="product-details" class="row row-tab">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#content">توضیحات</a></li>
            <li role="presentation"><a href="#attributes">مشخصات</a></li>
            <li role="presentation"><a href="#suggested-products">پیشنهاد ما</a></li>
            <li role="presentation"><a href="#reviews">نقد کاربران</a></li>
            <li role="presentation"><a href="#questions">پرسش‌ها</a></li>
        </ul>
        <div class="active my-5" id="content">
            <div class="description">
                <div class="d-block about-me c-desc-wrapper shaodow position-relative">
                  <div class="about-company c-desc">
                    {!! $product->description !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-12 more-view-info p-0">
                    <button class="c-more-info more more-desc-info">
                      <span class="mores">مشاهده بیشتر <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="less"> بستن </span>
                    </button>
                  </div>
                </div>
            </div>
            @if($product->src)
            <br>
            <a href="{{ $product->src }}" class="text-success" target="_blank">
                <span class="fa fa-external-link"></span>
            </a>
            @endif
        </div>
        <div id="attributes">
            <article>
                <section>
                    @foreach($attributes as $attribute)
                    <div class="d-block mt-3">
                        <h3 class="c-params__title d-block">{{ $attribute['group'] }}</h3>
                    </div>
                    <ul class="c-params__list">
                        @foreach($attribute['attributes'] as $name => $value)
                        @if($value === null) @continue @endif
                        <li>
                            <div class="c-params__list-key">
                                <span class="block">{{ $name }}</span>
                            </div>
                            <div class="c-params__list-value">
                                <span class="block">{!! nl2br($value) !!}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                </section>
            </article>
        </div>
    </div>
</div>
<div class="container-fluid suggested-products-section">
    <div id="suggested-products">
            <div class="row mt-5">
                <div class="col-12 col-sm-12">
                    <h5 class="line-after">محصولات پیشنهادی</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 p-0">
                    <div class="owl-carousel owl-theme owl-related">
                        @foreach($suggestedProducts as $suggestedProduct)
                            <div class="item">
                                <div class="item-img">
                                    <div class="row">
                                        <div class="col-12 p-0 pt-3 text-center">
                                            <a href="{{ route('products.show', $suggestedProduct->slug) }}"
                                               class="img-pro-wnd" target="_blank">
                                              <img class="img-fluid" alt="{{ $suggestedProduct->name }}" src="{{ asset(image_resize($suggestedProduct->image , ['width' => 233, 'height' => 220])) }}" >
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-left pro-name">
                                        <a href="{{ route('products.show', $suggestedProduct->slug) }}">{{ $suggestedProduct->name }}</a>
                                    </div>
                                </div>
                                <div class="row mt-2 align-items-end">
                                    <div class="col-12 cost text-right pr-3">
                                        @if($suggestedProduct->special)
                                        <span class="old-cost">{{ number_format($suggestedProduct->price) }}</span>
                                        <span class="offer-mob"><span class="off">% {{ $suggestedProduct->discount }}</span></span>
                                        <br>
                                        @endif
                                        <span class="cost-total">{{ number_format($suggestedProduct->special ?? $suggestedProduct->price) }}</span>
                                        <span class="unit">تومان</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="container-fluid reviews-section pt-3 pb-4">
     <div id="reviews">
            <div class="row">
                @foreach($product->approvedReviews as $review)
                <div class="col-12 col-sm-12">
                    <div class="card-body thumb-user">
                        <div class="gap-icon"></div>
                        <div class="icon-thumbnail">
                            <img src="{{ $review->avatar }}" alt="{{ $review->name }}"
                                class="rounded-circle">
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9 col-name">
                                <p class="user-name">{{ $review->name ?? $review->user?->name }}</p>
                            </div>
                            <div class="col-12 col-sm-3 gap-col col-date">
                                <p class="date-review color">{{ jdate($review->created_at)->format('d M Y')
                                    }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 content-review">
                                <p>{{ $review->content }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <p class="replay">
                                    <a href="#section6">
                                        <i class="fas fa-reply-all"></i>
                                        <span>پاسخ</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @unless($product->approvedReviews)
                <p>هیچ نظری برای این کالا وجود ندارد.</p>
                @endunless
            </div>
            <div class="row row-message">
                <div class=" col-md-8 mx-auto col-12 col-sm-12">
                    <p class="caption-sec">ثبت نظر </p>
                    <p class="title-review"> ( نظر خود درباره این محصول را ثبت نمایید ) </p>
                    <form method="post" action="{{ route('review.store') }}" class="form-horizontal"
                        id="form-review">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group group-comment">
                                    <label class="control-label">امتیاز</label>
                                    <span class="txt-comment">بد</span>
                                    <input type="radio" name="rating" value="1" {{ (old('rating')==1
                                        ? ' selected' : '' ) }} id="star-rating-1">
                                        <label class="star-rating__ico far fa-star" for="star-rating-1"></label>
                                    <input type="radio" name="rating" value="2" {{ (old('rating')==2
                                        ? ' selected' : '' ) }} id="star-rating-2">
                                         <label class="star-rating__ico far fa-star" for="star-rating-2"></label>
                                    <input type="radio" name="rating" value="3" {{ (old('rating')==3
                                        ? ' selected' : '' ) }} id="star-rating-3">
                                         <label class="star-rating__ico far fa-star" for="star-rating-3"></label>
                                    <input type="radio" name="rating" value="4" {{ (old('rating')==4
                                        ? ' selected' : '' ) }} id="star-rating-4">
                                         <label class="star-rating__ico far fa-star" for="star-rating-4"></label>
                                    <input type="radio" name="rating" value="5" {{ (old('rating')==5
                                        ? ' selected' : '' ) }} id="star-rating-5">
                                         <label class="star-rating__ico far fa-star" for="star-rating-5"></label>
                                    <span class="txt-comment">خوب</span>
                                    @if ($errors->has('rating'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col">
                                <div class="form-group mt-3">
                                    <input type="text" name="name" id="name" class="form-control input-sm"
                                        placeholder="نام شما"
                                        value="{{ old('name', (auth()->check() ? auth()->user()?->name : '')) }}"
                                        {{ auth()->check() ? ' readonly' : '' }}>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                 <div class="form-group mt-3">
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', (auth()->check() ? auth()->user()->email : '')) }}"
                                        id="input-name" class="form-control input-sm" {{ (auth()->check() ? ' readonly' : '' ) }} placeholder="ایمیل">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                 <div class="form-group mt-3">
                                    <input type="text" name="title" id="suject" value="{{ old('title') }}"
                                        id="title" class="form-control input-sm" placeholder="موضوع">
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col">
                               <div class="form-group mt-3">
                                    <textarea name="content" id="content"
                                        class="form-control  message-box-review" cols="5" rows="5"
                                        placeholder="متن پیام">{{ old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mx-auto col-12 col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-comment form-control">ارسال پیام</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<div class="container-fluid questions-section">
    <div id="questions">
        <div class="col-12 col-sm-12">
            <h5 class="line-after">پرسش و پاسخ</h5>
        </div>
        @forelse($product->questions as $question)
            <div class="col-12 col-sm-12 mb-3">
                <div class="card d-block">
                    <div class="card-header">
                        <div class="d-inline-block">
                            <span>{{ $question->title }}</span>
                        </div>
                        <div class="d-inline-block float-left">
                            <span class="fa fa-user"></span>
                            <span>{{ $question->user?->name }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse($question->answers as $answer)
                        <p class="card-text">
                            <span class="text-muted">پاسخ:</span>
                            {!! $answer->content !!}
                        </p>
                        @empty
                        <p class="card-text">هنوز پاسخی به این پرسش ثبت نشده است.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
        <div id="comments" class="col-12 col-sm-12 mb-3">
            <p class="my-3">اولین سوال برای این محصول را شما ثبت کنید.</p>
        </div>
        @endforelse
    </div>
</div>
<div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">

                <div id="frmSocialShare" class="sharing-panel" aria-labelledby="SocialShare">

                    <div class="sharing-socials clearfix">
                        <span class="sharing-socials-label">اشتراک گذاری</span>
                        <ul class="item-share">
                            <li><a href="" onclick="" data-network="#" data-title="" data-image="" data-url=""
                                    class="icon icon-facebook" title="به اشتراک گذاری در فیس بوک">facebook</a></li>
                            <li><a href="" onclick="" data-network="#&quot;" data-title="" data-image=""
                                    class="icon icon-twitter" title="به اشتراک گذاری در توییتر">twitter</a></li>
                            <li><a href="" onclick="" data-network="https://plus.google.com/share?url=[>URL<]"
                                    data-title="#" data-image="" data-url="" class="icon icon-googleplus"
                                    title="به اشتراک گذاری در گوگل پلاس">googleplus</a></li>
                            <li><a href="" class="icon icon-telegram" title="" rel="nofollow">telegram</a></li>
                        </ul>
                    </div>
                    <div class="sharing-shortlink clearfix">
                        <label for="shortlink">آدرس صفحه</label>
                        <input name="ShareUrl" value="/index.php?route=product/product&amp;path=25_36&amp;product_id=51"
                            readonly="readonly" style="direction: ltr; text-align: left;" type="text">
                    </div>
                    <div class="sharing-friends clearfix">
                        <label for="sharetofriend">معرفی به دوستان</label>
                        <input id="frmTbxFriendEmail" style="direction: ltr;"
                            placeholder="yourfriend@email.com : ایمیل دوستتان" type="text">
                    </div>
                    <div class="sharing-captcha">
                        <div>
                            <img src="/images/chapcha.png">
                        </div>
                        <div class="inputContainer">
                            <input id="TbxEmailSendCaptcha" type="text">
                        </div>
                    </div>
                    <div class="dk-sharing-submit clearfix">
                        <div id="SendToEMailMessages" class="message-container"></div>
                        <div class="button-container small">
                            <a id="AncSendToEMail" target="_blank" class="button blue" href="#">
                                <i class="button-icon dk-button-icon-cart"></i>
                                <div class="button-label clearfix">
                                    <div class="button-labelname">ارسال</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header align-items-center position-relative" style="background-color: #fff; border-bottom: none;">
        <div class="me-2">
          <i class="fas fa-check-circle" style="color: #28a745; font-size: 1.2rem;"></i>
        </div>
        <h5 class="modal-title" id="addToCartModalLabel" style="color: #28a745; padding: 0 1rem;">این کالا به سبد خرید اضافه شد!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
      </div>
      <div class="header-divider" style="border-bottom: 1px solid #ddd; margin: 0 1.5rem;"></div>
      <div class="modal-body d-flex align-items-center">
        <div class="flex-grow-1">
          <p class="mb-0">{{ $product->name }}</p>
        </div>
        <img src="{{ asset(image_resize($product->image, ['width' => 80, 'height' => 80])) }}" alt="{{ $product->alt }}" class="img-fluid" style="max-width: 80px; border-radius: 8px;">
      </div>
      <div class="modal-footer">
        <a href="{{ route('cart') }}" class="btn btn-danger w-100">برو به سبد خرید</a>
      </div>
    </div>
  </div>
</div>

<!--content-end-->
@endsection
