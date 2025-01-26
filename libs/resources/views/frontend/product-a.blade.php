@extends('frontend.layouts.app')
@section('title', $product->name)
@section('description', $product->meta_description)
@section('seo')
<meta name="keywords" content="{{ $product->meta_keywords }}">
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
</style>
<link href="/css/mCustomScrollbar.css" rel="stylesheet" type="text/css" />
<link href="/css/font-awesome.min.css" rel="stylesheet">
<link href="/css/fotorama.css" rel="stylesheet">
<link href="/css/foundation.css" rel="stylesheet">
<link href="/css/product.css?v=01" rel="stylesheet">
@endsection
@section('scripts')
<script src="/js/foundation.min.js"></script>
<script src="/js/fotorama.js"></script>
<script src="/js/zoom.js"></script>
<script>
    $('#showmenu').click(function() {
            $('.menu-item').show();
            $('#showmenu').hide();
            $('.close-box').show();
        });
        $('.close-box').click(function() {
            $('.menu-item').hide();
            $('#showmenu').show();
            $('.close-box').hide();
        });
</script>
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
</script>
<script>
    $(function() {
            var $modal = $('#myModal3');
            var fotoramaOptions = {
                nav: 'thumbs',
                width: '100%',
                maxheight: '80%',
                //transition: 'crossfade',
                keyboard: true,
                allowfullscreen: true
            }

            $('[data-reveal]').on('click', revealModal)

            $('.close-reveal-modal').on('click', function() {
                $modal.foundation('reveal', 'close');
            })

            function revealModal() {
                $modal.foundation('reveal', 'open');
            }

            $modal.bind('opened', function() {
                $('#fotorama').fotorama(fotoramaOptions);
            })
        });


        $(document).ready(function() {
            var pw = $('.fotorama__nav--thumbs').innerWidth();
            var cw = $('.fotorama__nav__shaft').innerWidth();
            var offset = pw -cw;
            var negOffset = (-1 * offset) / 2;
            var totalOffset = negOffset + 'px';
            if (pw > cw) {
                $('.fotorama__nav__shaft').css('transform', 'translate3d(' + totalOffset + ', 0, 0)');
            }
            $('.fotorama__nav__frame--thumb, .fotorama__arr, .fotorama__stage__frame, .fotorama__img, .fotorama__stage__shaft').click(function() {
                if (pw > cw) {
                    $('.fotorama__nav__shaft').css('transform', 'translate3d(' + totalOffset + ', 0, 0)');
                }
            });
        });
</script>
<script>
    $("body").delegate(".c-product .thumbnail", "click", function (event) {
            event.preventDefault();
            var selected = $(this);

            new_html = '<a onclick="return false;" class="thumbnail first_thumbnail" href="' + selected.attr('href') + '" title="آرد ذرت (جعبه)گلها 200 گرمی">';
            new_html += '<img id="zoom_01" src="' + selected.attr('href') + '" alt="آرد ذرت (جعبه)گلها 200 گرمی" data-zoom-image="' + selected.attr('big_image') + '"/>';
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
    var heroSlider = $('.owl-related');
        var owlCarouselTimeout = 1000;
        heroSlider.on('initialize.owl.carousel initialized.owl.carousel ' +
            'initialize.owl.carousel initialize.owl.carousel ' +
            'resize.owl.carousel resized.owl.carousel ' +
            'refresh.owl.carousel refreshed.owl.carousel ' +
            'update.owl.carousel updated.owl.carousel ' +
            'drag.owl.carousel dragged.owl.carousel ' +
            'translate.owl.carousel translated.owl.carousel ' +
            'to.owl.carousel changed.owl.carousel',
            function(e) {
                $('.' + e.type)
                    .removeClass('secondary')
                    .addClass('success');
                window.setTimeout(function() {
                    $('.' + e.type)
                        .removeClass('success')
                        .addClass('secondary');
                }, 500);
            });
        $('.owl-related').owlCarousel({
            loop: true,
             autoplay: true,
            autoplayTimeout:4000,

            autoplayHoverPause: true,
            smartSpeed:450,
            rtl:true,
            margin:20,
            navText: ["<i class='fas fa-angle-left'></i>","<i class='fas fa-angle-right'></i>"],
            lazyLoad: true,
            responsive:{
                0:{
                    items:1,
                    dots:false,
                    nav:true
                },
                500:{
                    items:3,
                    dots:true,
                    nav:false
                },
                768:{
                    items:4,
                    dots:true,
                    nav:false

                },
                1200:{
                    items:5,
                    dots:true,
                    nav:false

                }

            }
        });
        heroSlider.on('mouseleave',function(){
            heroSlider.trigger('stop.owl.autoplay');
            heroSlider.trigger('play.owl.autoplay', [owlCarouselTimeout]);
        })

</script>
<script>
    var heroSlider = $('.owl-sugest');
        var owlCarouselTimeout = 1000;
        heroSlider.on('initialize.owl.carousel initialized.owl.carousel ' +
            'initialize.owl.carousel initialize.owl.carousel ' +
            'resize.owl.carousel resized.owl.carousel ' +
            'refresh.owl.carousel refreshed.owl.carousel ' +
            'update.owl.carousel updated.owl.carousel ' +
            'drag.owl.carousel dragged.owl.carousel ' +
            'translate.owl.carousel translated.owl.carousel ' +
            'to.owl.carousel changed.owl.carousel',
            function(e) {
                $('.' + e.type)
                    .removeClass('secondary')
                    .addClass('success');
                window.setTimeout(function() {
                    $('.' + e.type)
                        .removeClass('success')
                        .addClass('secondary');
                }, 500);
            });
        $('.owl-sugest').owlCarousel({
              loop: true,
             autoplay: true,
            autoplayTimeout:4000,
            autoplayHoverPause: true,
            smartSpeed:450,
            rtl:true,
            margin:20,
            navText: ["<i class='fas fa-angle-left'></i>","<i class='fas fa-angle-right'></i>"],
            lazyLoad: true,
            responsive:{
                0:{
                    items:1,
                    dots:false,
                    nav:true
                },
                500:{
                    items:2,
                    dots:true,
                    nav:false
                },
                768:{
                    items:4,
                    dots:true,
                    nav:false

                },
                1200:{
                    items:5,
                    dots:true,
                    nav:false
                }
            }
        });
        heroSlider.on('mouseleave',function(){
            heroSlider.trigger('stop.owl.autoplay');
            heroSlider.trigger('play.owl.autoplay', [owlCarouselTimeout]);
        })

</script>
<script>
    $("[data-toggle=popover]").each(function(i, obj) {
            $(this).popover({
                html: true,
                content: function() {
                    var id = $(this).attr('id')
                    return $('#popover-content-' + id).html();
                }
            });
        });


</script>


<script>
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


function updateProductPrice(productId, optionName, operation, selectPrice, lastPrice, lastProductId, options) {
    var optionsJSON = JSON.stringify(options);
    var currentPrice = $("#productPrice").html();

    $("#lastPrice").html(currentPrice);
    $("#lastPrice").val(currentPrice);

    console.log(productId)

    $.ajax({
        type: "post",
        url: "/cart/display",
        data: {
            productId: productId,
            optionName: optionName,
            operation: operation,
            selectprice: selectPrice,
            last_price: lastPrice,
            productid: lastProductId,
            lastPrice: currentPrice,
            options: optionsJSON,

        },
        beforeSend: function () {
            $("#loading").show();
        },
        success: function (response) {
            $(".addToCart-new").attr("disabled", response.disabledBtn);
            $("#productStock").html(response.productStock);
            $("#productStock").prepend("موجودی:");
            $("#delPrice").html(response.delPrice);
            $("#productPrice").html(response.price);
            $("#productPriceDefault").html(response.productPriceDefault);
        },
        complete: function () {
            $("#loading").hide();
        },
        error: function () { }
    });
}

$(".productOptionInput").on("click", function () {
    var basePrice = parseInt($("#productPrice").attr("data-price"));
    var productId = $("#productid").attr("value");
    var optionName = $(this).attr("name");
    var selectedValue = $(this).val();
    var operation = $(this).data("operation");
    var price = $(this).data("price");

    var selectedOptions = getSelectedOptions();
    updateProductPrice(productId, optionName, operation, price, basePrice, productId, selectedOptions);
});

$(".productOption").on("change", function () {
    var productId = $("#productid").attr("value");
    var optionName = $(this).attr("name");
    var selectedValue = $(this).val();
    var operation = $(this).find(":selected").data("operation");
    var price = $(this).find(":selected").data("price");
    var basePrice = parseInt($("#productPrice").attr("data-price"));

    var selectedOptions = getSelectedOptions();
    updateProductPrice(selectedValue, optionName, operation, price, basePrice, productId, selectedOptions);
});

</script>





<script>
    $(document).ready(function () {
    $('.addToCart-new').on('click', function() {



         var options = getSelectedOptions();


        var productId = $(this).closest('.ajax-form').find('.productId').val();
        var quantity  = $(this).closest('.ajax-form').find('.quantity').val();
        var productSlug = $(this).closest('.ajax-form').find('.productSlug').val();


        addToCart(productId, quantity, options,productSlug);
    });
});



    /**
 * Adds a product with its quantity to the cart using ajax.
 *
 * @param product_id
 * @param quantity
 * @param option selected option of product
 */



 function addToCart(product_id, quantity, options,productSlug) {
        var newOptions=JSON.stringify(options);

    if (quantity === undefined) {
        quantity = 1;
    }
   $.ajax({
        type: 'POST',
        url: "/cart/add/" + product_id,
        data: {
            quantity: quantity,
            options: newOptions,
            _method: "POST"
        },
         success: function(message) {

             console.log(message.body)
             if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                $('.itemsInBasket').html(message.itemsInBasket);
                $(window).scrollTop(0);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
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
</script>
@endsection
@section('content')

<!--content-start-->
<div class="container-fluid">
    <div class="row">
        <div class="breadcrumb col-12 gap-col gap-col-mob mt-4 p-0">
            <ul class="breadcrumbs m-0 w-100 bg-white border rounded p-2">
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/') }}">صفحه اصلی</a>
                </li>
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/products') }}">تمام
                        محصولات</a></li>
                <li class="float-left"><a class="link text-dark p-2" itemprop="item"
                        href="{{ url('/products/' . $product->slug) }}">{{ $product->name }}</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row c-product">
        <div class="col-sm-4 col-12">
            <ul class="c-gallery__options">
                <li class="addToWishlist" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="اضافه به لیست علاقه مندی">
                    <input type="hidden" class="productId" value="{{ $product->id }}">
                    <i class="fa fa-heart"></i>
                </li>
                <li data-toggle="modal" data-target="#modal-share" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="اشتراک گذاری">
                    <i class="fa fa-share-alt"></i>
                </li>
                <li class="addToCompare" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="اضافه به لیست مقایسه">
                    <input type="hidden" class="productId" value="{{ $product->id }}">
                    <i class="fa fa-balance-scale"></i>
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
                    <!--<a class="thumbnail first_thumbnail" href="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}">-->
                    <!--    <img id="zoom_01" src="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}" alt="{{ $product->name }}" class="img-fluid"-->
                    <!--    data-zoom-image="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}"/>-->
                    <!--</a>-->


                    <a class="thumbnail first_thumbnail" href="{{ asset($product->image) }}">
                        <img id="zoom_01" src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                            class="img-fluid" data-zoom-image="{{ asset($product->image) }}" />
                    </a>

                </li>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slide-image2 ">
                    <!--<div class="row">-->
                    <!--    <div class="col-sm-12 col-xs-12">-->
                    <!--        <div class="owl-carousel owl-theme thumb-product3">-->
                    <!--            <div class="item">-->
                    <!--                <div class="thumbnail2">-->
                    <!--                    <button type="button" class="show-gallery icon-gallery" data-reveal>-->
                    <!--                        <i class="fas fa-ellipsis-h"></i>-->
                    <!--                    </button>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="item">-->
                    <!--                <a class="thumbnail" big_image="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}" href="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}" title="">-->
                    <!--                    <img src="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}" title="" alt="{{ $product->name }}"/>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--            @foreach($product->images as $image)-->
                    <!--                <div class="item">-->
                    <!--                    <a class="thumbnail" big_image="{{ asset(\App\ImageManager::resize($image->image, ['width' => 1200, 'height' => 1000])) }}" href="{{ asset(\App\ImageManager::resize($image->image, ['width' => 280, 'height' => 251])) }}" title="">-->
                    <!--                        <img src="{{ asset(\App\ImageManager::resize($image->image, ['width' => 1200, 'height' => 1000])) }}" title="" alt="{{ $product->name }}"/>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--            @endforeach-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div id="myModal3" class="reveal-modal reveal-modal--gallery">-->
                    <!--    <div id="fotorama" class="fotorama " data-auto="false" data-navposition="bottom" data-ratio="15/6">-->
                    <!--        <a big_image="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}" href="" title="">-->
                    <!--            <img itemprop="image" src="{{ asset(\App\ImageManager::resize($product->image, ['width' => '', 'height' => ''])) }}" title="" alt="" data-zoom-image="{{ asset(\App\ImageManager::resize($product->image, ['width' => 1200, 'height' => 1000])) }}"/>-->
                    <!--        </a>-->
                    <!--        @foreach($product->images as $image)-->
                    <!--            <a big_image="{{ asset(\App\ImageManager::resize($image->image, ['width' => 1200, 'height' => 1000])) }}" href="" title="">-->
                    <!--                <img itemprop="image" src="{{ asset(\App\ImageManager::resize($image->image, ['width' => '1200', 'height' => '1000'])) }}" title="" alt="" data-zoom-image="{{ asset(\App\ImageManager::resize($image->image, ['width' => 1200, 'height' => 1000])) }}"/>-->
                    <!--            </a>-->
                    <!--        @endforeach-->
                    <!--    </div>-->
                    <!--    <a class="close-reveal-modal">&#215;</a>-->
                    <!--</div>-->











                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="owl-carousel owl-theme thumb-product3">
                                <div class="item">
                                    <div class="thumbnail2">
                                        <button type="button" class="show-gallery icon-gallery" data-reveal>
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="item">
                                    <a class="thumbnail" big_image="{{ asset($product->image) }}"
                                        href="{{ asset($product->image) }}" title="">
                                        <img src="{{ asset($product->image) }}" title="" alt="{{ $product->name }}" />
                                    </a>
                                </div>
                                @foreach($product->images as $image)
                                <div class="item">
                                    <a class="thumbnail" big_image="{{ asset($image->image) }}"
                                        href="{{ asset($image->image) }}" title="">
                                        <img src="{{ asset($image->image) }}" title="" alt="{{ $product->name }}" />
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="myModal3" class="reveal-modal reveal-modal--gallery">
                        <div id="fotorama" class="fotorama " data-auto="false" data-navposition="bottom"
                            data-ratio="15/6">
                            <a big_image="{{ asset($product->image) }}" href="" title="">
                                <img itemprop="image" src="{{ asset($product->image) }}" title="" alt=""
                                    data-zoom-image="{{ asset($product->image) }}" />
                            </a>
                            @foreach($product->images as $image)
                            <a big_image="{{ asset($image->image) }}" href="" title="">
                                <img itemprop="image" src="{{ asset($image->image) }}" title="" alt=""
                                    data-zoom-image="{{ asset($image->image) }}" />
                            </a>
                            @endforeach
                        </div>
                        <a class="close-reveal-modal">&#215;</a>
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
                    <!--<p class="class="rate"">-->
                    <!--<span >-->
                    <!--    <i class="fa{{ ($product->approvedReviews->avg('star') == 5 ? 's' : 'r') }} fa-star"></i>-->
                    <!--    <i class="fa{{ ($product->approvedReviews->avg('star') >= 4 ? 's' : 'r') }} fa-star"></i>-->
                    <!--    <i class="fa{{ ($product->approvedReviews->avg('star') >= 3 ? 's' : 'r') }} fa-star"></i>-->
                    <!--    <i class="fa{{ ($product->approvedReviews->avg('star') >= 2 ? 's' : 'r') }} fa-star"></i>-->
                    <!--    <i class="fa{{ ($product->approvedReviews->avg('star') >= 1 ? 's' : 'r') }} fa-star"></i>-->
                    <!--    <a href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">{{ $product->approvedReviews->count() }}-->
                    <!--        نظر</a> /-->
                    <!--    <a href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">نوشتن-->
                    <!--        نظر</a>-->
                    <!--</span>-->
                    <!--<span>از {{ $product->approvedReviews->count() }} رای</span>-->
                    <!--</p>-->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-12">
                    <ul class="c-product__directory">
                        <li>
                            <span><b>برند</b></span> :
                            <a href="{{ route('manufacturers.show', [$product->manufacturer->slug]) }}"
                                class="btn-link-spoiler product-brand-title">{{ $product->manufacturer->name }}</a>
                        </li>
                        <li>
                            <span><b>دسته‌بندی</b></span> :
                            @foreach($productCategories as $productCategory)
                            <a href="{{ route('category.show', [$productCategory->slug]) }}" class="btn-link-spoiler">{{
                                $productCategory->name }}</a>
                            @endforeach
                        </li>
                    </ul>
                    <input type="hidden" id="productid" value="{{ $product->id }}">
                    @foreach($product->options as $option)
                    <div class="c-product__variants">
                        <input type="hidden" id="optioId" data-opt="{{$option->id}}">
                        <style>
                            .bobx5 {
                                width: 100%;
                            }
                        </style>

                        @foreach($option->optionValues as $optionValue)
                        <li class="js-c-ui-variant optionWrapper">
                            <label class="c-ui-variant c-ui-variant--color" data-code="#212121">
                                @if($optionValue->image)
                                <img src="{{ asset(\App\ImageManager::resize($optionValue->image, ['width' => 17, 'height' => 17])) }}"
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
                                    class="js-variant-selector productOptionInput">
                                <span class="c-ui-variant__check">{{ $optionValue->name }}</span>
                            </label>
                        </li>
                        @endforeach


                        </ul>
                    </div>
                    @endforeach

                    @if($product->warranty)
                    <div class="c-product__guarantee">
                        <span class="c-product__guarantee-text js-guarantee-text">
                            <i class="fas fa-shield-alt"></i>
                            <span><b>{{ $product->warranty }}</b></span>
                        </span>
                    </div>
                    @endif
                    @if($product->giftcard)
                    <div class="c-product__guarantee">
                        <span class="c-product__guarantee-text js-guarantee-text">
                            <i class="fas fa-credit-card"></i>
                            <span><b>{{ $product->giftcard }}</b></span>
                        </span>
                    </div>
                    @endif
                    <div class="c-product__delivery">
                        <div class="c-product__delivery-seller">
                            <i class="fas fa-store"></i>
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
                    <span>تماس بگیرید</span>
                    @else
                    @if($product->special)
                    <del class=" price_value" id="productPriceDefault">{{ number_format($product->price, 0) }}
                        تومان</del><br>
                    @endif
                    <ins class="text-danger price_value">
                        <span class="c-price__currency" id="productPrice">@if($product->special) {{ $product->special }}
                            @else {{ number_format($product->price, 0) }} @endif</span>
                        <span class="c-price__currency">تومان</span>
                    </ins>
                    @endif
                    @unless($product->hide_price)
                    <div class="c-add-to-card ajax-form">
                        <input type="hidden" class="productId" value="{{ $product->id }}">
                        <input type="hidden" class="quantity" value="1">
                        <button class="btn-add-to-cart js-add-to-cart js-btn-add-to-cart addToCart-new text-light">
                            <span class="icon"><i class="fa fa-cart-plus"></i></span>
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
                            <div class="col-12 col-md-12 col-lg-6 no-product-box">

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
                <div class="col-sm-4 col-12">
                    <div class="detail">
                        @if($highlightAttributes)
                        <ul class="product-detail">
                            <p>ویژگی‌های محصول</p>
                            @foreach($showAttributes as $name => $value)
                            <li>
                                <span><b>{{ $name }}:</b></span>
                                <span><b>{{ $value }}</b></span>
                            </li>
                            @endforeach
                        </ul>
                        <div id="showmenu">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            موارد بیشتر
                        </div>
                        <div class="menu-item" style="display: none;">
                            <ul>
                                @foreach($hideAttributes as $name => $value)
                                <li>
                                    <span><b>{{ $name }}:</b> </span>
                                    <span><b>{{ $value }}</b></span>
                                </li>
                                @endforeach
                                <p>
                                    <span class="close-box">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                        بستن</span>
                                </p>
                            </ul>
                        </div>
                        @endif
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
        </div>
    </div>
    <div class="row row-tab">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#tab1default" data-toggle="tab">توضیحات</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#tab5default" data-toggle="tab">مشخصات فنی</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab2default" data-toggle="tab">محصولات مرتبط</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#tab3default" data-toggle="tab">پیشنهاد ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab4default" data-toggle="tab">نقد کاربران</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane show in active" id="tab1default">
                        <div class="description">
                            {!! $product->description !!}
                        </div>
                        @if($product->src)
                        <br>
                        <a href="{{ $product->src }}" class="text-success" target="_blank">
                            <span class="fa fa-external-link"></span>
                        </a>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab5default">
                        <article>
                            <h2 class="c-params__headline">
                                مشخصات فنی <span>{{ $product->name }}</span>
                            </h2>
                            <section>
                                @foreach($attributes as $attribute)

                                <h3 class="c-params__title">{{ $attribute['group'] }}</h3>
                                <ul class="c-params__list">
                                    @foreach($attribute['attributes'] as $name => $value)
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
                    <div class="tab-pane fade" id="tab2default">
                        <div class="row">
                            <div class="col-12 col-sm-12 gap-col">
                                <div class="owl-carousel owl-theme  owl-related">
                                    @foreach($relatedProducts as $relatedProduct)
                                    <div class="item">
                                        <a href="{{route('products.show',$relatedProduct->slug)}}" class="text-dark">
                                            <div class="card-body product-main-categori"
                                                href="{{ route('products.show', ['slug' => $relatedProduct->slug]) }}">
                                                <div class="img-pro text-center">
                                                    <img src="{{ asset(\App\ImageManager::resize($relatedProduct->image, ['width' => 233, 'height' => 220])) }}"
                                                        class="img-fluid">
                                                </div>
                                                <ul class="desc-pro">
                                                    <li>
                                                        <p class="product-name">
                                                            {{ $relatedProduct->name }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="model-product">
                                                            {{ $relatedProduct->model }}
                                                        </p>
                                                    </li>
                                                </ul>
                                                <!--<ul class="icon">-->
                                                <!--    @unless($relatedProduct->hide_price)-->
                                                <!--	 <li class="add-to-card ajax-form">-->
                                                <!--		<input type="hidden" class="productId" value="{{ $relatedProduct->id }}">-->
                                                <!--		<input type="hidden" class="quantity" value="1">-->
                                                <!--		<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="اضافه به سبد خرید" class="addToCart-new">-->
                                                <!--		<i class="fa fa-cart-plus"></i>-->
                                                <!--		</a>-->
                                                <!--	</li>-->
                                                <!--	@endunless-->
                                                <!--	<li class="compare-list addToCompare">-->
                                                <!--		<input type="hidden" class="productId" value="{{ $relatedProduct->id }}">-->
                                                <!--		<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="مقایسه محصول">-->
                                                <!--		<i class="fa fa-balance-scale"></i>-->
                                                <!--		</a>-->
                                                <!--	</li>-->
                                                <!--	<li class="wish-list addToWishlist">-->
                                                <!--		<input type="hidden" class="productId" value="{{ $relatedProduct->id }}">-->
                                                <!--		<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="اضافه به لیست علاقه مندی">-->
                                                <!--		<i class="fa fa-heart"></i>-->
                                                <!--		</a>-->
                                                <!--	</li>-->
                                                <!--	<li class="view">-->
                                                <!--	 <a href="{{ route('products.show', ['product' => $relatedProduct->slug]) }}" data-toggle="tooltip" data-placement="top" title="" class="red-tooltip" data-original-title="مشاهده جزئیات محصول">-->

                                                <!--	 <i class="fa fa-eye"></i>-->
                                                <!--	 </a>-->
                                                <!--	</li>-->
                                                <!--</ul>-->

                                            </div>
                                        </a>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3default">
                        <div class="row">
                            <div class="col-12 col-sm-12 gap-col">
                                <div class="owl-carousel owl-theme  owl-sugest">
                                    @foreach($suggestedProducts as $suggestedProduct)
                                    <div class="item">
                                        <a href="{{route('products.show',$suggestedProduct->slug)}}" class="text-dark">
                                            <div class="card-body product-main-categori">
                                                <div class="img-pro text-center">
                                                    <img src="{{ asset(\App\ImageManager::resize($suggestedProduct->image, ['width' =>  233, 'height' => 220])) }}"
                                                        class="img-fluid">
                                                </div>
                                                <ul class="desc-pro">
                                                    <li>
                                                        <p class="product-name">
                                                            {{ $suggestedProduct->name }}
                                                        </p>
                                                    </li>

                                                </ul>
                                                <!--                                 <div class="box-content">-->
                                                <!--	<ul class="icon">-->
                                                <!--	    @unless($suggestedProduct->hide_price)-->
                                                <!--		<li class="add-to-card ajax-form">-->
                                                <!--			<input type="hidden" class="productId" value="{{ $product->id }}">-->
                                                <!--			<input type="hidden" class="quantity" value="1">-->
                                                <!--			<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="اضافه به سبد خرید" class="addToCart-new">-->
                                                <!--			<i class="fas fa-cart-plus"></i>-->
                                                <!--			</a>-->
                                                <!--		</li>-->
                                                <!--		@endunless-->
                                                <!--		<li class="compare-list addToCompare">-->
                                                <!--			<input type="hidden" class="productId" value="{{ $product->id }}">-->
                                                <!--			<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="مقایسه محصول">-->
                                                <!--			<i class="fas fa-balance-scale"></i>-->
                                                <!--			</a>-->
                                                <!--		</li>-->
                                                <!--		<li class="wish-list addToWishlist">-->
                                                <!--			<input type="hidden" class="productId" value="{{ $product->id }}">-->
                                                <!--			<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="اضافه به لیست علاقه مندی">-->
                                                <!--			<i class="fas fa-heart"></i>-->
                                                <!--			</a>-->
                                                <!--		</li>-->
                                                <!--		<li class="view">-->
                                                <!--		 <a href="{{ route('products.show', ['product' => $product->slug]) }}" data-toggle="tooltip" data-placement="top" title="" class="red-tooltip" data-original-title="مشاهده جزئیات محصول">-->

                                                <!--		 <i class="far fa-eye"></i>-->
                                                <!--		 </a>-->
                                                <!--		</li>-->
                                                <!--	</ul>-->
                                                <!--</div>-->
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4default">
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
                                            <p class="user-name">{{ $review->name ?? $review->user->name }}</p>
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
                            <div class="col-12 col-sm-12">
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
                                                    ? ' selected' : '' ) }}>
                                                <input type="radio" name="rating" value="2" {{ (old('rating')==2
                                                    ? ' selected' : '' ) }}>
                                                <input type="radio" name="rating" value="3" {{ (old('rating')==3
                                                    ? ' selected' : '' ) }}>
                                                <input type="radio" name="rating" value="4" {{ (old('rating')==4
                                                    ? ' selected' : '' ) }}>
                                                <input type="radio" name="rating" value="5" {{ (old('rating')==5
                                                    ? ' selected' : '' ) }}>
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
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control input-sm"
                                                    placeholder="نام شما"
                                                    value="{{ old('name', ($authUser ? $authUser->name : '')) }}"
                                                    {{ ($authUser ? ' readonly' : '' ) }}>
                                                @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 col">
                                            <div class="form-group">
                                                <input type="email" id="email" name="email"
                                                    value="{{ old('email', ($authUser ? $authUser->email : '')) }}"
                                                    id="input-name" class="form-control input-sm" {{ ($authUser
                                                    ? ' readonly' : '' ) }} placeholder="ایمیل">
                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col">
                                            <div class="form-group">
                                                <input type="text" name="title" id="suject" value="{{ old('title') }}"
                                                    id="title" class="form-control input-sm" placeholder="موضوع">
                                                @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12  col">
                                            <div class="form-group">
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
                                    <div class="row">
                                        <div class="col-sm-12 col-12 col">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-comment">ارسال پیام</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>

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
<!--content-end-->
@endsection
