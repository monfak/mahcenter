@extends('frontend.layouts.app')
@section('title', $manufacturer->title ?? $manufacturer->name)
@section('description', $manufacturer->meta_description)
@section('image', asset($manufacturer->logo))
@section('twitter_title', $manufacturer->twitter_title ?? $manufacturer->title ?? $manufacturer->name)
@section('twitter_description', $manufacturer->twitter_description ?? $manufacturer->meta_description)
@section('og_image', asset($manufacturer->og_image ?? $manufacturer->logo))
@section('twitter_image', asset($manufacturer->twitter_image ?? $manufacturer->logo))
@section('canonical', $manufacturer->canonical ?? url()->current())
@section('seo')
@if($manufacturer->is_noindex && $manufacturer->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($manufacturer->is_noindex)
    <meta name="robots" content="noindex">
@elseif($manufacturer->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('scripts')
    <script src="/js/nouislider.min.js"></script>
    <script src="/js/wNumb.js"></script>
    <script src="/js/jquery.twbsPagination.js"></script>
     <script src="/js/theia-sticky-sidebar.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*$(document).on('click', '.page-link', function (e) {
               e.preventDefault();
                 filter($(this).html());
            });*/
            function filter(page = 1) {
                var manufacturers = [];
                $('.manufacturer:checked').each(function () {
                    manufacturers.push($(this).val());
                });
    
                var filters = [];
                $('.filter_checkbox:checked').each(function() {
                    filters.push($(this).val());
                });
    
                var filterLimit = $('#input-limit').val();
    
                var filterOrder = false;
                $('.button_radio.filter').each(function () {
                    if( $(this).is(":checked") ) {
                        filterOrder = $(this).val();
                    }
                });
    
                if($('#stock_status-param-1').prop('checked') == true){
                    var stockStatus = 1;
                }
    
                $.ajax({
                    type: 'POST',
                      url: "{{ route('category.filter', ['category' => $manufacturer->slug]) }}" + '?page=' + page,
                    data: {
                        'filters': filters,
                        'limit': filterLimit,
                        'order': filterOrder,
                        'stockStatus': stockStatus,
                        'manufacturers': manufacturers,
                        'minPrice': $(".min-value").val(),
                        'maxPrice': $(".max-value").val(),
                    },
                    success: function(products) {
                        console.log(products);
                        $('#products_wrapper').html(products);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
    
            /*$('.filter').change(function () {
                filter();
            });
    
            $('.filter-btn').click(function(){
                filter();
            });*/

            var slider = document.getElementById('filter_price_slider');

            var min = 0;
           {{-- var max = {{ number_format($mostExpensiveProduct->price, 0, '', '') }}; --}}
            if(min == max)
                // max = min +1;
            noUiSlider.create(slider, {
                {{--start: [0, {{ number_format($mostExpensiveProduct->price, 0, '', '') }}],--}}
                connect: true,
                tooltips: [true, wNumb({ decimals: 0 })],
                format: wNumb({
                    decimals: 0
                }),
                range: {
                    'min': min,
                    'max': max
                }
            });

            var inputNumber = document.getElementById('input-number');

            slider.noUiSlider.on('update', function( values, handle ) {
                var value = values[handle];
                if ( handle ) {
                    $(".txt_price_max").val(value);
                } else {
                    $(".txt_price_min").val(Math.round(value));
                }
            });

            $("body").delegate(".txt_price_min",'change', function(){
                slider.noUiSlider.set([null,this.value]);
            });

            $("body").delegate(".txt_price_max",'change', function(){
                slider.noUiSlider.set([this.value,null]);
            });

            var min_filter_price = 0;
            {{--var max_filter_price = {{ number_format($mostExpensiveProduct->price, 0, '', '') }};--}}
            slider.noUiSlider.on('change', function( values, handle ) {
                min_filter_price = values[0];
                max_filter_price = values[1];
                filter();
            });
        });
    
    </script>
    <script>

        if (matchMedia('only screen and (min-width:768px)').matches) {
            $('#collapseTwo').addClass('show');
        }
        if (matchMedia('only screen and (max-width:767px)').matches) {
            $('#collapseTwo').removeClass('show');
        }
        
        
        ///اسکریپت نمایش بیشتر در لیست نام مجموعه ها///
        $('.c-catalog__list--depth').each(function(){
            var LiN = $(this).find('li').length;
            if( LiN > 5){
                $('li', this).eq(4).nextAll().hide().addClass('toggleable');
                $(this).append('<li class="more">مشاهده همه دسته‌بندی‌ها</li>');

            }
        });
        $('.c-catalog__list--depth').on('click','.more', function(){
            if( $(this).hasClass('less') ){
                $(this).text('مشاهده همه دسته‌بندی‌ها').removeClass('less');
            }else{
                $(this).text('بستن').addClass('less');
            }
            $(this).siblings('li.toggleable').slideToggle();
        });
        <!---->




        ///اسکریپت مربوط به صفحه بندی///
        $('#pagination-categori').twbsPagination({
            totalPages: 4,
// the current page that show on start
            startPage: 1,

// maximum visible pages
            visiblePages: 2,

            initiateStartPageClick: true,

// template for pagination links
            href: false,

// variable name in href template for page number
            {{--hrefVariable: '{{number}}',--}}

            // Text labels
            prev: 'قبلی',
            next: 'بعدی',
            last:'آخری',
            first:'اولی',

// carousel-style pagination
            loop: false,

// callback function
            onPageClick: function (event, page) {
                $('.page-active').removeClass('page-active');
                $('#page'+page).addClass('page-active');
            },

// pagination Classes
            paginationClass: 'pagination',
            nextClass: 'بعدی',
            prevClass: 'قبلی',
            pageClass: 'page',
            activeClass: 'active',
            disabledClass: 'disabled'

        });
        <!---->

        ///اسکریپت نمایش اسکرول قیمت///
        ;(function(){

            var doubleHandleSlider = document.querySelector('.double-handle-slider');
            var minValInput = document.querySelector('.min-value');
            var maxValInput = document.querySelector('.max-value');


            noUiSlider.create(doubleHandleSlider, {
                start: [0, {{ number_format($mostExpensiveProduct->price ?? 0, 0, '', '') }}],
                connect: true,
                tooltips: true,
                step: 1,
                range: {
                    'min': [ 0 ],
                    'max': [ {{ number_format($mostExpensiveProduct->price ?? 0, 0, '', '') }} ]
                },
                tooltips: [true, wNumb({ decimals: 0 })],
                format: wNumb({
                    decimals: 0
                }),

            });

            doubleHandleSlider.noUiSlider.on('change', function( values, handle ) {

                // This version updates both inputs.
                var rangeValues = values;
                minValInput.value = rangeValues[0];
                maxValInput.value = rangeValues[1];

            });

            minValInput.addEventListener('change', function(){
                doubleHandleSlider.noUiSlider.set([this.value, null]);
            });

            maxValInput.addEventListener('change', function(){
                doubleHandleSlider.noUiSlider.set([null, this.value]);
            });

        })();

        $(".close-flter").on("click", function() {
            $("#collapseTwo").collapse('hide');
        });
function sticky_sidebar() {
            $('.sticky_column')
                .theiaStickySidebar({
                    additionalMarginTop: 100
                });
        }

        jQuery(document).ready(function () {
            sticky_sidebar()
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/mCustomScrollbar.css"/>
    <link href="/css/nouislider.min.css" rel="stylesheet">
    <style>
        .card--shadow {
            box-shadow: 0 0.375rem 0.75rem rgba(140,152,164,.075);
        }
        .seller-banner {
            position: relative;
            background-image: url('/images/gray-pattern.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
        }
        .seller-banner:before {
            content: "";
            display: block;
            padding-top: 30.83%;
        }
        .card {
            display: flex;
            flex-direction: column;
            position: relative;
            border: .0625rem solid rgba(231, 234, 243, .7);
            border-radius: .5rem;
            overflow: hidden;
            padding-left: 0;
            padding-right: 0;
        }
        .card__body, .card__img-top {
            padding: .8rem;
        }
        .flex {
            display: flex;
        }
        .flex-col {
            flex-direction: column;
        }
        .text-primary {
            --tw-text-opacity: 1;
            color: rgb(201 64 100 / var(--tw-text-opacity));
        }
        .hover\:ts-shadow-sm:hover, .ts-shadow-sm {
            box-shadow: 0 .375rem .75rem rgba(140,152,164,.075)!important;
        }
        .items-center {
            align-items: center;
        }
        .text-sm {
            font-size: .875rem;
            line-height: 2;
        }
        .w-4 {
            width: 1rem;
        }
        
        .h-4 {
            height: 1rem;
        }
        .relative {
            position: relative;
        }
        .z-10 {
            z-index: 10;
        }
        .-mt-9 {
            margin-top: -2.25rem;
        }
        .w-fit {
            width: -moz-fit-content;
            width: fit-content;
        }
        .w-18 {
            width: 4.5rem;
        }
        .h-18 {
            height: 4.5rem;
        }
        h1 {
            font-size: 1rem;
        }
    </style>
@endsection
@section('content')
    <!--content-start-->
    <div class="container-fliud cont-categori ">
            <div class="row">
                <div class="col-sm-12 col-xs-12 ">
                    <ul class="filter-category ps-0">
                        <li class="filter-item sticky_column">
                            <div class="row filter-box mb-3">
                                <div class="card card--shadow">
                                    <div class="seller-banner"></div>
                                    <div class="card__body">
                                        <div class="seller">
                                            <div class="flex flex-col">
                                                <div class="flex-shrink-0">
                                                    <div class="ts-shadow-sm svg-icon svg-icon-sm relative z-10 -mt-9 rounded bg-white p-2 text-primary w-fit">
                                                        <img src="{{ asset(image_resize($manufacturer->logo, ['width' => 200, 'height' => 120])) }}" class="h-18 w-18" alt="{{ $manufacturer->name }}">
                                                    </div>
                                                </div>
                                                <div class="flex-grow pr-2">
                                                    <span class="mb-1 flex items-center">
                                                        <span class="text-md font-bold mt-2 mb-0 h6">{{ $manufacturer->name }}</span>
                                                    </span>
                                                    <span class="text-sm">نمایندگی فروش محصولات برند {{ $manufacturer->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-box">
                                <div class="panel-group accordion-section" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading ">
                                            <div class="panel-title">
                                                <ul class="ps-0">
                                                    <li>
                                                        <a data-bs-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                            <button class="btn btn-filter filter-btn">
                                                                <i class="fas fa-filter"></i>
                                                                <span>فیلتر محصولات</span>
                                                                <i class="fas fa-check-circle"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                    <li class="sort-option">
                                                        <div class="center">
                                                            <button  data-bs-toggle="modal" data-bs-target="#sortModal"  class="btn btn-sort">
                                                                <i class="fas fa-sort-amount-down ms-2"></i>مرتب سازی</button>
                                                            </div>
                                                        <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <p class="sort-caption">مرتب سازی</p>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty"> پر بازدید ترین ها</span>
                                                                                <input id="sort-1" name="radio-talar" value=" پر بازدید ترین ها" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty">  جدید ترین ها</span>
                                                                                <input id="sort-2" name="radio-talar" value=" جدید ترین ها" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty">محبوب ترین ها</span>
                                                                                <input id="sort-3" name="radio-talar" value=" محبوب ترین ها" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty">  پرفروش ترین ها</span>
                                                                                <input id="sort-4" name="radio-talar" value=" پرفروش ترین ها" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty"> قیمت نزولی</span>
                                                                                <input id="sort-5" name="radio-talar" value=" قیمت نزولی" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-primary">
                                                                            <label class="checkbox-icon customradio">
                                                                                <span class="radiotextsty"> قیمت صعودی</span>
                                                                                <input id="sort-6" name="radio-talar" value=" قیمت صعودی" type="radio">
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                                            <div class="btn-group btn-delete " role="group">
                                                                                <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-bs-dismiss="modal" role="button">اعمال</button>
                                                                            </div>
                                                                            <div class="btn-group" role="group">
                                                                                <button type="button" class="btn btn-default" data-bs-dismiss="modal" role="button">انصراف</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="row filter-top d-lg-none d-md-none  d-sm-none">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-2 gap-col-mob   close-flter">
                                                            <span class="action-button "><i class="fas fa-times"></i></span>
                                                        </div>
                                                        <div class="col-5 action-filter-box">
                                                            <span class="form-control action-filter">
                                                                <a href="#" class="action-button ">فیلتر</a>
                                                            </span>
                                                        </div>
                                                        <div class="col-5 clear-filter-box">
                                                            <span class="clear-filter form-control">
                                                                <a href="#" class="action-button">پاک کردن</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="panel panel-default filter_pannel">
                                                    <ul class="ps-0">
                                                       {{-- <li class="block cat-filter">
                                                            <p class="cat-filter-name">دسته بندی محصولات</p>
                                                            <ol class="ps-0">
                                                                <li class="main-categori">
                                                                    @foreach($categories as $theCategory)
                                                                        @if(count($theCategory->activeChildren) > 0)
                                                                            <div class="categori-name">
                                                                                <ul class="ps-0">
                                                                                    <li>
                                                                                        <a href="{{ route('category.show', ['category' => $theCategory->slug]) }}"><i class="fas fa-chevron-down"></i>{{ $theCategory->name }}</a>
                                                                                        <ul class="ps-0 c-catalog__list--depth">
                                                                                            @foreach($theCategory->activeChildren as $child)
                                                                                            <li>
                                                                                                <a href="{{ route('category.show', ['category' => $child->slug]) }}">{{ $child->name }}</a>
                                                                                            </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @else
                                                                            <a href="{{ route('category.show', ['category' => $theCategory->slug]) }}"><i class="fas fa-chevron-left"></i>{{ $theCategory->name }}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </li>
                                                            </ol>
                                                        </li>--}}
                                                        @if($manufacturer->categories && count($manufacturer->categories))
                                                           <li class="block cat-filter scroll">
                                                            <input type="checkbox" name="item" id="off_filter_part" >
                                                            <i></i>
                                                            <label class="filter-cation" for="off_filter_part">جستجو بر اساس دسته بندی</label>
                                                         
                                                            <div class="options">
                                                                <ul class="li-item ps-0">
                                                                    @foreach($manufacturer->categories as $category)
                                                                    <li>
                                                                        <label class="checkbox-icon customradio">
                                                                            <span class="name-factur">{{ $category->name }}</span>
                                                                            <input id="off-1" name="" class="filter category cmb_filter_category" value="{{ $category->id }}" type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        @endif
                                                        <li class="block cat-filter">
                                                            <label class="c-ui-statusswitcher">
                                                                <input type="checkbox" name="stock" class="filter" value="1" id="stock_status-param-1">
                                                                <span class="c-ui-statusswitcher__slider">
                                                                    <span class="c-ui-statusswitcher__slider__toggle"></span>
                                                                </span>
                                                            </label>
                                                            <span class="status">  فقط کالاهای موجود</span>
                                                        </li>
                                                        {{--<li class="block cat-filter">
                                                            <input type="checkbox" name="item" id="cost_filter_part" >
                                                            <i></i>
                                                            <label class="filter-cation" for="cost_filter_part">جستجو بر اساس قیمت محصول</label>
                                                            <div class="options">
                                                                <div class="double-handle-slider"></div>
                                                                <ul class="cost-rang">
                                                                    <li>
                                                                        <p class="lbl-prise"> از</p>
                                                                        <input type="number" class="min-value" value="0">
                                                                        <p>تومان</p>
                                                                    </li>
                                                                    <li>
                                                                        <p class="lbl-prise">تا</p>
                                                                        <input type="number" class="max-value" value="{{ number_format($mostExpensiveProduct->price ?? 0, 0, '', '') }}">
                                                                        <p>تومان</p>
                                                                    </li>
                                                                </ul>
                                                                <p class="btn-action">
                                                                    <button class="btn btn-filter-cost btn-filter filter-btn">
                                                                        <i class="fas fa-filter"></i>
                                                                        <span>اعمال محدوه قیمت</span>
                                                                    </button>
                                                                </p>
                                                            </div>
                                                        </li>--}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="category-container">
                            <div id="products" class="row">
                                <h1 class="filter-caption form-control">{{ $manufacturer->name }}</h1>
                                <div class="col-sm-12 d-none d-md-block gap-col">
                                    <div class="row row-sort-top">
                                        <div class="col-sm-9">
                                            <div class="btn-filter">
                                                <label class="icon-sort" >
                                                    <span>
                                                        <svg style="width: 24px; height: 24px; fill: #4d515a;">
                                                            <use xlink:href="#sort">
                                                              <symbol id="sort" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M6 15.793L3.707 13.5l-1.414 1.414 4 4a1 1 0 001.414 0l4-4-1.414-1.414L8 15.793V5H6v10.793zM22 5H10v2h12V5zm0 4H12v2h10V9zm0 4h-8v2h8v-2zm-6 4h6v2h-6v-2z" clip-rule="evenodd"></path></symbol>  
                                                            </use>
                                                        </svg>
                                                    </span>مرتب سازی
                                                </label>
                                                <label class="sort_label">
                                                    <input class="button_radio filter" value="most_viewed" name="filter_sort" type="radio">
                                                    <span>پربازديد ترين</span>
                                                </label>
                                                <label class="sort_label">
                                                    <input class="button_radio filter" value="latest" name="filter_sort" type="radio">
                                                    <span>جديدترين‌ها</span>
                                                </label>
                                                <label class="sort_label">
                                                    <input class="button_radio filter" value="price_desc" name="filter_sort" type="radio">
                                                    <span>قيمت نزولی</span>
                                                </label>
                                                <label class="sort_label">
                                                    <input class="button_radio filter" value="price_asc" name="filter_sort" type="radio">
                                                    <span>قيمت صعودی</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 gap-col sort-icon text-end">
                                            <div class="btn-group btn-grid">
                                                <span class="text-page">
                                                   <label class="control-label" for="input-limit">نمايش:</label>
                                                </span>
                                                <span class="drop-page">
                                                   <select id="input-limit" class="form-control filter">
                                                       <option value="16" selected="selected">16</option>
                                                       <option value="32">32</option>
                                                       <option value="48">48</option>
                                                       <option value="96">96</option>
                                                       <option value="120">120</option>
                                                   </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="page p-0" id="products_wrapper">
                                    @php $highlightAttributes = []; @endphp
                                    @include('frontend.partials.categories.product', compact('products', 'highlightAttributes'))
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 p-xs-0 py-5">
                                    <div class="d-block about-me c-desc-wrapper shaodow position-relative">
                                      <div class="about-company c-desc">
                                        {!! $manufacturer->description!!}
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
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
       
    </div>
    <!--content-end-->
@endsection

