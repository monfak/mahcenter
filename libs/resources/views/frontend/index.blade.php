@extends('frontend.layouts.app')
@section('title', $site_settings['title'])
@section('description', $site_settings['description'])
@section('styles')
@if($site_settings['is_festival_active'])
<style>
    .festival {
        background: {{ $site_settings['festival_color'] }};
        color: {{ $site_settings['festival_complementary_color'] }};
    }
    .festival .btn-add {
        background: {{ $site_settings['festival_color'] }};
        color: {{ $site_settings['festival_complementary_color'] }};
    }
    .festival .offer {
        background: {{ $site_settings['festival_color'] }};
        color: {{ $site_settings['festival_complementary_color'] }};
    }
</style>
@endif
@endsection
@section('scripts')
    <script>
      $("#time1").soon().create({
        due: "{{ date('j F, Y', $site_settings['special_ended_at']) }}",
        separator: ":",
        layout: "group",
      });
      @if($site_settings['is_festival_active'])
      $("#time2").soon().create({
        due: "{{ date('j F, Y', $site_settings['festival_ended_at']) }}",
        separator: ":",
        layout: "group",
      });
      @endif
    </script>
@endsection
@section('content')
      <div class="c-navi-categories__overlay js-navi-overlay"></div>
      <section class="container-fluid slider p-0">
        <div class="row">
          <div class="col-12 p-0 slide-col position-relative">
            <div class="owl-carousel owl-theme owl-slider">
                @foreach($slider as $slide)
                        <a class="item img-pro-banner" href="{{ $slide->url }}">
                          <img width="1343" height="280" src="{{ asset($slide->image) }}" class="d-none d-md-block" alt="{{ $slide->heading }}"><!--عکس مناسب دسکتاپ-->
                          <img width="1343" height="280" src="{{ asset($slide->image) }}" class="d-xl-none d-lg-none d-md-none" alt="{{ $slide->heading }}"><!--عکس مناسب گوشی-->
                        </a>
                @endforeach
            </div>
          </div>
        </div>
      </section>
      <section class="contaner-fluid pt-3 pb-3">
        <div class="container">
          <div class="row">
            <div class="col-lg-11 mx-auto col-12 p-0">
              <div class="owl-carousel owl-theme owl-category">
                @foreach($featuredCategories->orderedItems as $item)
                    <div class="item">
                      <a class="main-img-category position-relative text-center" href="{{ $item->url }}">
                        <div class="logo-category-image">
                          <img width="144" height="103" src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}" />
                        </div>
                        <div class="layer-category mt-2 mb-2">{{ $item->title }}</div>
                      </a>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
    <h1 class="headingnone" style="display:none">{{ $site_settings['heading'] }}</h1>
    @if($site_settings['is_festival_active'])
    <section class="container-fluid pe-2 ps-2 mb-4">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 wnd festival">
              <div class="row align-items-center">
                <div class="col-md-2 col-5">
                  <div class="row">
                    <div class="col-12 p-0 text-center">
                      <img src="{{ asset($site_settings['festival_home_title_image']) }}" class="img-fluid" />
                    </div>
                    <div class="col-12 p-0 text-center">
                      <img src="{{ asset($site_settings['festival_home_image']) }}" class="img-fluid" width="120"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="timer text-center">
                      <span class="soon" id="time2" data-format="d,h,m,s" data-face="slot doctor glow" data-visual="ring color-light width-thin glow-progress"></span>
                      </div>
                      <div class="d-block text-center mb-3">
                        <a href="{{ url('special-sale') }}" class="more-wnd">
                          مشاهده همه <i class="fas fa-chevron-left"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-10 p-0 col-7">
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="owl-carousel owl-theme owl-wnd">
                        @foreach($specialSales as $product)
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div class="d-block favo-link mb-2 text-end pe-1 pt-1">
                              {{--<button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>--}}
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="position-relative">
                                    <img width="185" height="130" src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->alt }}"/>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div class="col-12 pro-name-special position-relative">
                              <a class="d-block pro-name" href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2 pe-0">
                              <a href="{{ route('products.show', $product->slug) }}" class="btn-add">
                                <svg xmlns="http://www.w3.org/2000/svg') }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" aria-hidden="true" class="absolute-center ts-white h-7 w-7">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                              </a>
                            </div>
                            <div class="col-10 cost text-end ps-0 off-pro mb-2 mt-2">
                              @if($product->special)
                              <div class="d-block">
                                <span class="old-cost me-2">{{ number_format($product->price) }} <span class="unit">تومان</span></span>
                                <span class="offer">
                                  <span class="off">{{ $product->discount }} %</span>
                                </span>
                              </div>
                              @else
                              <div class="d-block" style="min-height: 14px"></div>
                              @endif
                              <div class="d-block mt-1">
                                <span class="cost-total">{{ number_format($product->special ?? $product->price) }}</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
    @if(count($specialOffers))
    <section class="container-fluid pe-2 ps-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 wnd">
              <div class="row align-items-center">
                <div class="col-md-2 col-5">
                  <div class="row">
                    <div class="col-12 p-0 text-center">
                      <img src="{{ asset('new-theme/images/Amazings.svg') }}" class="img-fluid" />
                    </div>
                    <div class="col-12 p-0 text-center">
                      <img src="{{ asset('images/amazing.png') }}" class="img-fluid" width="120"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="timer text-center">
                      <span
                          class="soon"

                          id="time1"
                          data-format="d,h,m,s"
                          data-face="slot doctor glow"
                          data-visual="ring color-light width-thin glow-progress"
                        ></span>
                      </div>
                      <div class="d-block text-center mb-3">
                        <a href="{{ url('amazing') }}" class="more-wnd">
                          مشاهده همه <i class="fas fa-chevron-left"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-10 p-0 col-7">
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="owl-carousel owl-theme owl-wnd">
                        @foreach($specialOffers as $product)
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div class="d-block favo-link mb-2 text-end pe-1 pt-1">
                              {{--<button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>--}}
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="position-relative">
                                    <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->alt }}"/>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div class="col-12 pro-name-special position-relative">
                              <a class="d-block pro-name" href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2 pe-0">
                              <a href="{{ route('products.show', $product->slug) }}" class="btn-add">
                                <svg xmlns="http://www.w3.org/2000/svg') }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" aria-hidden="true" class="absolute-center ts-white h-7 w-7">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                              </a>
                            </div>
                            <div class="col-10 cost text-end ps-0 off-pro mb-2 mt-2">
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
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
    <section class="container-fluid pe-2 ps-2 mt-3">
        <div class="container ps-0 pe-0" style="background: url('images/warranty.jpg') no-repeat">
          <div class="row">
            <div class="col-lg-12 mx-auto col-12 p-2">
              <div class="row align-items-center">
                <div class="col-md-6 col-12 ps-md-0">
                  <div class="d-md-flex flex-item">
                    <div class="d-flex align-items-center">
                      <div>
                        <img src="{{ asset('images/fresh.png?v=0.0.1') }}" class="img-fluid" width="66" height="64" />
                      </div>
                      <div class="ms-2 me-2">
                        <img width="237" height="24" src="{{ asset('images/warranties-heading.png?v=0.0.1') }}" class="img-fluid" style="width:40%"/>
                      </div>
                    </div>
                    {{--<div>
                      <a href="" class="link-item">تا ۶۲٪ تخفیف</a>
                    </div>--}}
                  </div>
                </div>
                <div class="col-md-6 col-12 pe-md-0 text-md-end mt-xs-15">
                  <div class="d-flex flex-link">
                    <div class="d-flex flex-pro">
                        @foreach($warranties as $warranty)
                        <a href="{{ route('frontend.warranties.show', $warranty->slug) }}">
                            <img width="58" height="58" src="{{ asset($warranty->logo) }}" class="img-fluid" alt="{{ $warranty->name }}" />
                            {{--<span class="price-discount-percent">62%</span>--}}
                        </a>
                        @endforeach
                    </div>
                    <div>
                      <a href="{{ route('frontend.warranties.index') }}" class="all-pro">
                        <span>مشاهده گارانتی‌ها</span>
                        <i class="fal fa-arrow-left"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    @if($belowSupermarket->status)
    <section class="container-fluid banner-section pt-3 pb-3 pe-0 ps-0">
        <div class="container p-0">
            <div class="row">
                @foreach($belowSupermarket->orderedItems as $item)
                    <div class="col-md-3 col-6 mt-xs-15 ps-2 pe-2">
                        <a href="{{ $item->url }}" class="d-block text-center">
                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <section class="container-fluid logo-section pt-4 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 text-center">
              <h4 class="title-section">آخرین محصولات</h4>
            </div>
          </div>
          <div class="row mt-2 mb-3 brand-section">
            <div class="col-12 ps-0 pe-0 pt-3 pb-3">
              <div class="owl-carousel owl-theme owl-logo">
                @foreach($latestProducts as $product)
                <div class="item">
                  <a class="inline-bllock" href="{{ route('products.show', $product->slug) }}" title="{{ $product->name }}">
                    {{--<img src="{{ asset(image_aspect($product->image, ['height' => 100])) }}" class="img-fluid" alt="{{ $product->name }}" />--}}
                    <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->alt }}" />
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
    @if($belowProducts->status)
    <section class="container-fluid banner-section pe-2 ps-2 pt-md-4 pb-md-2">
        <div class="container p-0">
            @foreach($belowProducts->orderedItems->chunk(2) as $items)
            <div class="row">
                @foreach($items as $item)
                <div class="col-md-6 col-12 ps-2 pe-2 mb-3">
                    <a href="{{ $item->url }}" class="d-block">
                        <img src="{{ asset($item->image) }}" class="img-fluid w-100" alt="{{ $item->title }}">
                    </a>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>
    @endif
    @if(count($categoriesHasSlider))
    <section class="container-fluid category-section pe-2 ps-2 pt-4 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0">
              <div class="gird row-category">
                @foreach($categoriesHasSlider as $lane)
                <div class="d-flex flex-col">
                  <h4 class="title-section">{{ $lane['category']->name }}</h4>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                        @foreach($lane['products'] as $product)
                        <a href="{{ route('products.show', $product->slug) }}" target="_blank">
                            <img class="img-fluid mx-auto" alt="{{ $product->alt }}" src="{{ asset($product->image) }}" >
                        </a>
                        @endforeach
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="{{ route($lane['category']->parent_id == null ? 'category.desc' : 'category.show', $lane['category']->slug) }}" class="more">
                      مشاهده <i class="fas fa-chevron-left ms-1"></i>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
    @if($manufacturers->count())
    <section class="container-fluid logo-section pt-4 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 text-center">
              <h4 class="title-section">برندهای پیشنهادی</h4>
            </div>
          </div>
          <div class="row mt-2 mb-3 brand-section">
            <div class="col-12 ps-0 pe-0 pt-3 pb-3">
              <div class="owl-carousel owl-theme owl-logo">
                @foreach($manufacturers as $manufacturer)
                <div class="item">
                  <a class="inline-bllock" href="{{ route('manufacturers.show', $manufacturer->slug) }}" title="{{ $manufacturer->name }}">
                    <img src="{{ asset($manufacturer->logo) }}" class="img-fluid" alt="{{ $manufacturer->name }}"/>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
    @endif
    <section class="container-fluid best-saler-section pe-2 ps-2 pt-4 pb-2">
        <div class="container">
          <div class="row mt-2">
            <div class="col-12 p-0 text-center title-section">
              پرفروش‌ترین کالاها
            </div>
          </div>
          <div class="mt-3 mb-2">
            <div class="col-12">
              <div class="owl-carousel owl-theme owl-best-pro">
                @foreach($mostSalesProducts->chunk(3) as $products)
                <div class="item">
                    @foreach($products as $product)
                    <a class="d-flex" href="{{ route('products.show', $product->slug) }}" target="_blank">
                        <div class="flex-img">
                            <img src="{{ asset($product->image ) }}" class="img-fluid" alt="{{ $product->alt }}"/>
                        </div>
                        <span class="counter-item">{{ $loop->iteration + ($loop->parent->index * 3) }}</span>
                        <div class="flex-pro position-relative">
                            <p>{{ $product->name }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
    @if($recommendedCategories)
    <section class="container-fluid category-section pe-2 ps-2 pt-4 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0">
              <div class="gird row-category">
                @foreach($recommendedCategories as $recommend)
                <div class="d-flex flex-col">
                  <h4 class="title-section">{{ $recommend['category']->name }}</h4>
                  <p class="text-caption">بر اساس بازدیدهای شما</p>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                        @foreach($recommend['products'] as $product)
                        <a href="{{ route('products.show', $product->slug) }}" target="_blank">
                            <img class="img-fluid mx-auto" src="{{ asset($product->image) }}" alt="{{ $product->alt }}">
                        </a>
                        @endforeach
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="{{ route($recommend['category']->parent_id === null ? 'category.desc' : 'category.show', $recommend['category']->slug) }}" class="more">
                      مشاهده <i class="fas fa-chevron-left ms-1"></i>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
    @endif
    <section class="container-fluid news-section pe-2 ps-2 pt-4 pb-2">
        <div class="container p-0">
          <div class="row align-items-center">
            <div class="col-md-6 col-8 ps-0">
              <h4 class="title-section">وبلاگ</h4>
            </div>
            <div class="col-md-6 col-4 pe-0 text-end">
              <a href="{{ route('blog.index') }}" class="more-product">
                مشاهده همه <i class="fal fa-long-arrow-left"></i>
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 p-0">
              <div class="owl-carousel owl-theme owl-news">
                @foreach($articles as $article)
                <div class="item position-relative">
                  <div class="item-img position-relative">
                    <div class="d-block img-special">
                      <img src="{{ asset(image_resize($article->image, ['width' => 404, 'height' => 224])) }}" alt="{{ $article->title }}" />
                    </div>
                    <a href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}" class="layer-item" target="_blank">
                      <div class="item-layer">
                        <div class="short-desc-blog mt-2">
                          {{ $article->title }}
                          <i class="fal fa-chevron-left"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection
