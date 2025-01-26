@extends('frontend.layouts.app')
@section('title', 'از خرید شما متشکریم')
@section('scripts')
<script>
    $(document).ready(function() {
        $('#cash').click(function() {
            $('#gateway').removeClass('d-none');
        });
        $('#delivery').click(function() {
            $('#gateway').addClass('d-none');
        });
    });
</script>
@endsection
@section('styles')
<style>
    .page-title-overlap {
        padding-bottom: 6.375rem;
    }
    @media (max-width: 767.98px) {
        .page-title-overlap {
            padding-bottom: 5.5rem;
        }
    }
    .breadcrumb-item+.breadcrumb-item {
        padding-left: unset;
        padding-right: .5rem;
    }
    .breadcrumb-item+.breadcrumb-item::before {
        float: right;
        padding-left: .5rem;
        padding-right: unset;
    }
    .page-title-overlap+* {
        margin-top: -4.875rem;
    }
    .breadcrumb-light .breadcrumb-item>a {
        color: #fff;
    }
    .breadcrumb-light .breadcrumb-item.active {
        color: rgba(255,255,255,0.6);
    }
    .steps {
        display: flex;
        width: 100%;
    }
    .steps-light .step-item {
        color: rgba(255,255,255,0.55);
    }
    .step-item {
        flex-basis: 0;
        flex-grow: 1;
        transition: color 0.25s ease-in-out;
        text-align: center;
        text-decoration: none !important;
    }
    
    .steps-light .step-item.active .step-count, .steps-light .step-item.active .step-progress {
        color: #fff;
        background-color: #fe696a;
    }
    .step-item:first-child .step-progress {
        border-radius: .125rem;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .steps-light .step-count, .steps-light .step-progress {
        color: #fff;
        background-color: #485268;
    }
    .step-progress {
        position: relative;
        width: 100%;
        height: .25rem;
    }
    
    .steps-light .step-item.active .step-count, .steps-light .step-item.active .step-progress {
        color: #fff;
        background-color: #fe696a;
    }
    .steps-light .step-count, .steps-light .step-progress {
        color: #fff;
        background-color: #485268;
    }
    .step-count {
        position: absolute;
        top: -.75rem;
        left: 50%;
        width: 1.625rem;
        height: 1.625rem;
        margin-left: -.8125rem;
        border-radius: 50%;
        font-size: .875rem;
        line-height: 1.625rem;
    }
    
    .step-label {
        padding-top: 1.5625rem;
    }
    
    .step-label>i {
        margin-top: -.25rem;
        margin-right: .425rem;
        font-size: 1.2em;
        vertical-align: middle;
    }
    [class^='ci-'], [class*=' ci-'] {
        display: inline-block;
        font-family: "cartzilla-icons" !important;
        speak: never;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
    }
    
    .steps-light .step-item.active.current {
        color: #fff;
        pointer-events: none;
    }
    .cart-btn {
        display: inline-block;
        font-weight: normal;
        line-height: 1.5;
        color: #4b566b;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .625rem 1.375rem;
        font-size: .9375rem;
        border-radius: .3125rem;
        transition: color 0.25s ease-in-out,background-color 0.25s ease-in-out,border-color 0.25s ease-in-out,box-shadow 0.2s ease-in-out;
    }
    .btn-proceed {
        color: #fff !important;
    }
    .btn-back, .btn-back:hover {
        color: #4b566b !important;
        border-color: transparent;
    }
    
    .btn-back:hover, .btn-back:active, .btn-back:focus, .btn-back.active, .btn-back.show {
        border-color: #d1d9e8;
        background-color: #d1d9e8;
    }
    .btn-proceed {
        color: #000;
        background-color: #fe696a;
        border-color: #fe696a;
        box-shadow: unset;
    }
    .btn-proceed:hover, .btn-proceed:active, .btn-proceed:focus, .btn-proceed.active, .btn-proceed.show {
        border-color: #fe3638;
        background-color: #fe3638;
    }
    .accordion-button::after {
        margin-left: unset;
        margin-right: auto;
    }
    .bg-body-tertiary {
        background-color: rgba(245, 247, 250, 1) !important;
    }
    .rounded-5 {
        border-radius: var(calc(0.5rem*2)) !important;
    }
    figure, img {
        height: auto;
        vertical-align: middle;
    }
    figure, img, svg {
        max-width: 100%;
    }
    .ratio {
        position: relative;
        width: 100%;
    }
    .ratio:before {
        content: "";
        display: block;
        padding-top: calc(240/258*100%);
    }
    .bg-danger {
        background-color: rgba(240, 61, 61, 1) !important;
    }
    .fs-sm {
        font-size: .875rem !important;
    }
    .fw-medium {
        font-weight: 500 !important;
    }
    .animate-underline .animate-target, .animate-underline.animate-target {
        position: relative;
        text-decoration: none;
    }
    .animate-underline .animate-target:after, .animate-underline.animate-target:after {
        background-color: currentcolor;
        bottom: 0;
        content: "";
        height: var(--cz-underline-thickness);
        left: 0;
        position: absolute;
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform .3s ease-out;
        width: 100%;
    }
    .h1 a, .h2 a, .h3 a, .h4 a, .h5 a, .h6 a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
        color: #181d25;
        text-decoration: none;
    }
    .bg-success {
        background-color: rgba(51, 179, 107, 0.2) !important;
    }
    .bg-danger {
        background-color: rgba(240, 61, 61, 0.2) !important;
    }
</style>
@endsection
@section('content')
<main>
    <div class="row row-cols-1 row-cols-lg-2 g-0 mx-auto" style="max-width: 1920px">

        <!-- Tank you content column -->
        <div class="col d-flex flex-column justify-content-center py-5 px-xl-4 px-xxl-5">
          <div class="w-100 pt-sm-2 pt-md-3 pt-lg-4 pb-lg-4 pb-xl-5 px-3 px-sm-4 pe-lg-0 ps-lg-5 mx-auto ms-lg-auto me-lg-4" style="max-width: 740px">
            <div class="d-flex align-items-sm-center border-bottom pb-4 pb-md-5">
              <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle flex-shrink-0" style="width: 3rem; height: 3rem; margin-top: -.125rem">
                <i class="ci-check fs-4"></i>
              </div>
              <div class="w-100 ps-3">
                <div class="fs-sm mb-1">سفارش شماره #{{ $order->id }}</div>
                <div class="d-sm-flex align-items-center">
                    @if(in_array($order->status, [0, 1]))
                    <h1 class="h4 mb-0 me-3">متاسفانه مشکلی در ثبت سفارش شما رخ داد!</h1>
                    @else
                    <h1 class="h4 mb-0 me-3">از خرید شما متشکریم!</h1>
                    @endif
                    <div class="nav mt-2 mt-sm-0 ms-auto">
                        @if(auth()->check())
                            <a class="nav-link text-decoration-underline p-0" href="{{ route('frontend.orders.show', $order->id) }}">پیگیری سفارش</a>
                        @else
                            <a class="nav-link text-decoration-underline p-0" href="{{ route('register') }}">ثبت‌نام کنید</a>
                        @endif
                    </div>
                </div>
              </div>
            </div>
            <div class="d-flex flex-column gap-4 pt-3 pb-5 mt-3">
              <div>
                <h3 class="h6 mb-2">آدرس</h3>
                <p class="fs-sm mb-0">{{ $order->address->address }}</p>
              </div>
              <div>
                <h3 class="h6 mb-2">زمان ثبت سفارش</h3>
                <p class="fs-sm mb-0">{{ jdate($order->created_at)->format('d F Y ساعت H:i') }}</p>
              </div>
              <div>
                <h3 class="h6 mb-2">گیرنده</h3>
                <p class="fs-sm mb-0">
                    {{ $order->user?->name ?? $order->name }}
                </p>
              </div>
            </div>
            @if(in_array($order->status, [0, 1]))
            <div class="bg-danger rounded px-4 py-4 ">
              <div class="py-3">
                <h2 class="h4 text-center pb-2 mb-1">متاسفانه ثبت سفارش شما شکست خورد!</h2>
                <p class="fs-sm text-center mb-4">بزودی کارشناسان ما با شما تماس خواهند گرفت!</p>
                {{--<div class="d-flex gap-2 mx-auto" style="max-width: 500px">
                  <input type="text" class="form-control border-white border-opacity-10 w-100" id="couponCode" value="30%SALEOFF" readonly="">
                  <button type="button" class="btn btn-dark" data-copy-text-from="#couponCode">Copy coupon</button>
                </div>--}}
              </div>
            </div>
            @else
            <div class="bg-success rounded px-4 py-4" style="--cz-bg-opacity: .2">
              <div class="py-3">
                <h2 class="h4 text-center pb-2 mb-1">🎉 تبریک! سفارش شما ثبت شد!</h2>
                <p class="fs-sm text-center mb-4">بزودی کارشناسان ما با شما تماس خواهند گرفت!</p>
                {{--<div class="d-flex gap-2 mx-auto" style="max-width: 500px">
                  <input type="text" class="form-control border-white border-opacity-10 w-100" id="couponCode" value="30%SALEOFF" readonly="">
                  <button type="button" class="btn btn-dark" data-copy-text-from="#couponCode">Copy coupon</button>
                </div>--}}
              </div>
            </div>
            @endif
            <p class="fs-sm pt-4 pt-md-5 mt-2 mt-sm-3 mt-md-0 mb-0">
                به مشاوره خرید نیاز دارید؟
                <a class="fw-medium ms-2" href="{{ route('page.show', 'contact') }}">تماس با ما</a>
            </p>
          </div>
        </div>

        <!-- Related products -->
        <div class="col pt-sm-3 p-md-5 ps-lg-5 py-lg-4 pe-lg-4 p-xxl-5">
          <div class="position-relative d-flex align-items-center h-100 py-5 px-3 px-sm-4 px-xl-5">
            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary rounded-5 d-none d-md-block"></span>
            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary d-md-none"></span>
            <div class="position-relative w-100 z-2 mx-auto pb-2 pb-sm-3 pb-md-0" style="max-width: 636px">
              <h2 class="h4 text-center pb-3">محصولاتی که احتمالا دوست دارید</h2>
              <div class="row row-cols-2 g-3 g-sm-4 mb-4">
                @foreach($recommendedProducts as $product)
                <!-- Item -->
                <div class="col">
                  <div class="product-card animate-underline hover-effect-opacity bg-body rounded shadow-none">
                    <div class="position-relative">
                      <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
                        <div class="d-flex flex-column gap-2">
                          <button type="button" class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex" aria-label="Add to Wishlist">
                            <i class="ci-heart fs-base animate-target"></i>
                          </button>
                          <button type="button" class="btn btn-icon btn-secondary animate-rotate d-none d-lg-inline-flex" aria-label="Compare">
                            <i class="ci-refresh-cw fs-base animate-target"></i>
                          </button>
                        </div>
                      </div>
                      <div class="dropdown d-lg-none position-absolute top-0 end-0 z-2 mt-2 me-2">
                        <button type="button" class="btn btn-icon btn-sm btn-secondary bg-body" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More actions">
                          <i class="ci-more-vertical fs-lg"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end fs-xs p-2" style="min-width: auto">
                          <li>
                            <a class="dropdown-item" href="#!">
                              <i class="ci-heart fs-sm ms-n1 me-2"></i>
                              افزودن به علاقه مندی‌ها
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="#!">
                              <i class="ci-refresh-cw fs-sm ms-n1 me-2"></i>
                              مقایسه
                            </a>
                          </li>
                        </ul>
                      </div>
                      <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('products.show', $product->slug) }}">
                        {{--<span class="badge bg-danger position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3">-21%</span>--}}
                        <div class="ratio" style="--cz-aspect-ratio: calc(240 / 258 * 100%)">
                          <img src="{{ asset($product->image) }}" alt="{{ $product->alt }}">
                        </div>
                      </a>
                    </div>
                    <div class="w-100 min-w-0 px-2 pb-2 px-sm-3 pb-sm-3">
                      <h3 class="pb-1 mb-2">
                        <a class="d-block fs-sm fw-medium text-truncate" href="{{ route('products.show', $product->slug) }}">
                          <span class="animate-target">{{ $product->name }}</span>
                        </a>
                      </h3>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="h5 lh-1 mb-0">
                            @if($product->special)
                                {{ number_format($product->price, 0) }}
                                تومان
                                <del class="text-body-tertiary fs-sm fw-normal">
                                    {{ number_format($product->price, 0) }}
                                    تومان
                                </del>
                            @else
                                {{ number_format($product->price, 0) }}
                                تومان
                            @endif
                        </div>
                        <button type="button" class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2" aria-label="Add to Cart">
                          <i class="ci-shopping-cart fs-base animate-target"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>

              <a class="btn btn-lg btn-primary w-100" href="{{ route('products') }}">
                ادامه خرید
                <i class="fa fa-chevron-left fa-sm me-1 me-n1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
</main>
@endsection