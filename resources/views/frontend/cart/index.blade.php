@extends('frontend.layouts.app')
@section('title', 'سبد خرید')
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
    .txt-18{
        font-size:18px;
    }
    .txt-15{
        font-size: 15px;
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
</style>
@endsection
@section('content')
<main>
    @if($products)
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="fa fa-home me-1"></i>صفحه اصلی</a></li>
              <li class="breadcrumb-item text-nowrap"><a href="{{ route('products') }}">محصولات</a>
              </li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">سبد خرید</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
          <h1 class="h3 text-light mb-0">سبد خرید</h1>
        </div>
      </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
        <!-- List of items-->
        <section class="col-lg-8">
            <div class="steps steps-light pt-2 pb-3 mb-5">
                <a class="step-item active current" href="{{ route('cart') }}">
                    <div class="step-progress">
                        <span class="step-count">1</span>
                    </div>
                    <div class="step-label">
                        <i class="ci-cart"></i>سبد خرید
                    </div>
                </a>
                <a class="step-item" href="{{ route('frontend.details.index') }}">
                    <div class="step-progress">
                        <span class="step-count">2</span>
                    </div>
                    <div class="step-label">
                        <i class="ci-user-circle"></i>اطلاعات ارسال
                    </div>
                </a>
                <a class="step-item" href="{{ route('checkout') }}">
                    <div class="step-progress">
                        <span class="step-count">3</span>
                    </div>
                    <div class="step-label">
                        <i class="ci-check-circle"></i>تسویه حساب
                    </div>
                </a>
            </div>
            @include('frontend.layouts.partials.input-errors')
          @foreach($products as $product)
          <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
              <img src="{{ $product['image'] }}" width="160" height="160" alt="{{ $product['name'] }}">
              <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center w-100 ms-sm-4">
                <div class="text-section">
                  <h3 class="product-title fs-base mb-2 text-start">
                    <a class="txt-18 text-dark" href="{{ route('products.show', $product['slug']) }}">{{ $product['name'] }}</a>
                  </h3>
                  <div class="fs-sm mb-2 text-start txt-15">
                    <i class="fas fa-cube txt-gray"></i> 
                    <span class="text-muted ms-2">مدل:</span>
                    {{ $product['model'] }}
                  </div>
                  @if($product['warranty'])
                  <div class="fs-sm mb-2 text-start txt-15">
                    <i class="fas fa-shield-alt txt-gray"></i> 
                    <span class="text-muted ms-2">گارانتی:</span>
                    {{ $product['warranty'] }}
                  </div>
                  @endif
                  @if($product['variety_label'] == 'رنگ')
                    <div class="fs-sm mb-1 text-start txt-15">
                        <i class="fas fa-palette txt-gray"></i>
                        <span class="text-muted ms-2">رنگ:</span>
                        {{ $product['variety_value'] }}
                    </div>
                  @elseif($product['variety_label'] == 'سایز')
                    <div class="fs-sm mb-1 text-start txt-15">
                        <i class="fas fa-palette txt-gray"></i>
                        <span class="text-muted ms-2">رنگ:</span>
                        {{ $product['variety_value'] }}
                    </div>
                  @else
                    <div class="fs-sm mb-1 text-start txt-15">
                        <i class="fas fa-palette txt-gray"></i>
                        <span class="text-muted ms-2">{{ $product['variety_label'] }}:</span>
                        {{ $product['variety_value'] }}
                    </div>
                  @endif
                  <div class="fs-lg text-accent pt-2 text-start txt-15">
                    <i class="fas fa-money-check-alt txt-gray"></i>
                    <span class="text-muted ms-2">قیمت:</span> 
                    {{ number_format($product['totalPrice'], 0) }} <small>تومان</small>
                  </div>
                <div class="action-section pt-2 d-flex flex-column flex-sm-row  mt-sm-0 text-sm-end" style="min-width: 9rem;">
                  <form method="post" action="{{ route('cart.update', $product['id']) }}" class="frm d-flex align-items-center mb-3 mb-sm-0">
                    @csrf
                    @method('PATCH')
                    <label class="form-label me-2" for="quantity{{ $product['id'] }}">تعداد</label>
                    <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" id="quantity{{ $product['id'] }}" class="form-control text-center" style="width: 80px;">
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <button type="submit" class="btn btn-link btn-sm shadow-none ms-2">
                      <i class="fas fa-sync"></i>
                    </button>
                  </form>
                  <form method="post" action="{{ route('cart.delete', $product['id']) }}" class="ms-3">
                    @csrf
                    @method('delete')
                    <button class="btn btn-link px-0 text-danger shadow-none" type="submit">
                      <i class="far fa-times-circle me-2"></i><span class="fs-sm">حذف</span>
                    </button>
                  </form>
                </div>
                </div>
              </div>
            </div>
          @endforeach
          {{--<button class="btn btn-outline-accent d-block w-100 mt-4" type="button"><i class="fa fa-sync fs-base ms-2"></i>بروزرسانی سبد خرید</button>--}}
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4">
                <div class="py-2 px-xl-2">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1">جمع کل</h2>
                        <h3 class="fw-normal">{{ number_format($totalSum, 0) }} <small>تومان</small></h3>
                    </div>
                    @if(auth()->check() OR ($cart && $cart->mobile !== null && $cart->first_name !== null && $cart->last_name !== null))
                        <div class="mb-4">
                            <small class="text-muted">
                            هزینه‌ی ارسال در ادامه بر اساس آدرس، زمان و نحوه‌ی ارسال انتخابی شما محاسبه و به این مبلغ اضافه خواهد شد.
                            </small>
                        </div>
                        <a class="btn btn-danger btn-shadow d-block w-100 mt-4" href="{{ route('frontend.details.index') }}">
                            <i class="fas fa-credit-card fs-lg ms-2"></i> ادامه فرآیند خرید
                        </a>
                    @else
                        <form class="needs-validation" action="{{ route('cart.guest') }}" method="post" novalidate="">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">نام</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="نام خود را وارد کنید" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی خود را وارد کنید" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">شماره موبایل</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" dir="ltr" placeholder="شماره موبایل خود را وارد کنید" required>
                            </div>
                            <p class="small text-muted">
                                ثبت نام در مه سنتر اجباری نیست و خرید شما در حالت مهمان ثبت می‌گردد.
                                با وارد کردن اطلاعات فوق،به مرحله بعدی یعنی ثبت آدرس خواهید رفت.
                            </p>
                            <div class="mb-4">
                                <small class="text-muted">
                                هزینه‌ی ارسال در ادامه بر اساس آدرس، زمان و نحوه‌ی ارسال انتخابی شما محاسبه و به این مبلغ اضافه خواهد شد.
                                </small>
                            </div>
                            <button type="submit" class="btn btn-danger btn-shadow d-block w-100 mt-4">
                              <i class="fas fa-credit-card fs-lg ms-2"></i> ادامه فرآیند خرید
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="py-3 px-xl-2">
              <div class="mb-4">
                <p>
                    کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.
                </p>
              </div>
            </div>
        </aside>
      </div>
    </div>
    @else
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12 empty-cart-cls text-center">
                    <img src="{{ asset('images/cart-empty.png') }}" width="100" height="100" class="img-fluid mb-4 mr-3" alt="سبد خرید">
                    <h1>سبد خرید</h1>
                    <p>هیچ محصولی در سبد خرید شما وجود ندارد.</p>
                    <p>
                        پیش از ادامه برای پرداخت، باید حداقل یک محصول به سبد خرید خود اضافه کنید. محصولات ما را می‌توانید در صفحه محصولات و از طریق دکمه زیر مشاهده کنید.
                    </p>
                    <a href="{{ route('products') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">
                        محصولات
                        <span class="fa fa-angle-double-left"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</main>
@endsection