@extends('frontend.layouts.app')
@section('title', 'پرداخت')
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#cash').click(function () {
                $('#gateway').removeClass('d-none');
            });
            $('#delivery').click(function () {
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

        .breadcrumb-item + .breadcrumb-item {
            padding-left: unset;
            padding-right: .5rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            float: right;
            padding-left: .5rem;
            padding-right: unset;
        }

        .page-title-overlap + * {
            margin-top: -4.875rem;
        }

        .breadcrumb-light .breadcrumb-item > a {
            color: #fff;
        }

        .breadcrumb-light .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.6);
        }

        .steps {
            display: flex;
            width: 100%;
        }

        .steps-light .step-item {
            color: rgba(255, 255, 255, 0.55);
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

        .step-label > i {
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
            transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out, box-shadow 0.2s ease-in-out;
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
                                <li class="breadcrumb-item text-nowrap"><a href="{{ route('products') }}">محصولات</a></li>
                                <li class="breadcrumb-item text-nowrap"><a href="{{ route('cart') }}">سبد خرید</a></li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">تسویه حساب</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h1 class="h3 text-light mb-0">تسویه حساب</h1>
                    </div>
                </div>
            </div>
            <form method="Post" action="{{ route('orders.store') }}">
                @csrf
                <div class="container pb-5 mb-2 mb-md-4">
                    <div class="row">
                        <!-- List of items-->
                        <section class="col-lg-8">
                            <div class="steps steps-light pt-2 pb-3 mb-5">
                                <a class="step-item active" href="{{ route('cart') }}">
                                    <div class="step-progress">
                                        <span class="step-count">1</span>
                                    </div>
                                    <div class="step-label">
                                        <i class="ci-cart"></i>سبد خرید
                                    </div>
                                </a>
                                <a class="step-item active" href="{{ route('frontend.details.index') }}">
                                    <div class="step-progress">
                                        <span class="step-count">2</span>
                                    </div>
                                    <div class="step-label">
                                        <i class="ci-user-circle"></i>اطلاعات ارسال
                                    </div>
                                </a>
                                <a class="step-item active current" href="{{ route('checkout') }}">
                                    <div class="step-progress">
                                        <span class="step-count">3</span>
                                    </div>
                                    <div class="step-label">
                                        <i class="ci-check-circle"></i>تسویه حساب
                                    </div>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    @auth()
                                        @unless(auth()->user()->first_name)
                                            <div class="form-group my-2">
                                                <label class="col-12 control-label" for="first_name">نام *</label>
                                                <div class="col-12">
                                                    <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" placeholder="نام" id="first_name" class="form-control" required>
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endunless
                                        @unless(auth()->user()->last_name)
                                            <div class="form-group my-2">
                                                <label class="col-12 control-label" for="last_name">نام خانوادگی *</label>
                                                <div class="col-12">
                                                    <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="نام خانوادگی" id="last_name" class="form-control" required>
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endunless
                                        @unless(auth()->user()->national_code)
                                            <div class="form-group my-2">
                                                <label class="col-12 control-label" for="national_code">کدملی</label>
                                                <div class="col-12">
                                                    <input type="text" name="national_code" value="{{ old('national_code', auth()->user()->national_code) }}" dir="ltr" placeholder="کدملی" id="national_code" class="form-control">
                                                    @if ($requiresNationalId)
                                                        <span class="text-danger" role="alert">
                                                            <strong>برای فعالسازی گارانتی محصول : {{ $requiresNationalIdProducts }} پر کردن کدملی اجباری است !</strong>
                                                        </span>
                                                    @endif
                                                    @if ($errors->has('national_code'))
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $errors->first('national_code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endunless
                                    @endauth
                                    <div class="form-group my-2">
                                        <label class="col-12 control-label" for="description">توضیحات</label>
                                        <div class="col-12">
                                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="در صورت نیاز، پیام‌تان در رابطه با سفارش را برای ما بنویسید">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="h6 pb-3 mb-2">شیوه پرداخت</h2>
                            @if($errors->any())
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-ban"></i> خطا!</h4>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover fs-sm border-top">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check mb-4">
                                                <input class="form-check-input shipping_address" type="radio" id="cash" value="cash" name="paymethod" checked>
                                                <label class="form-check-label" for="cash"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark fw-medium">پرداخت اینترنتی</span>
                                            <br>
                                            <span class="text-muted">آنلاین با تمام کارت‌های بانکی</span>
                                        </td>
                                    </tr>
                                    @if(auth()->check() && auth()->user()->id == 2 && false)
                                        <tr>
                                            <td>
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input shipping_address" type="radio" id="sadad" value="sadad" name="paymethod">
                                                    <label class="form-check-label" for="sadad"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark fw-medium">پرداخت اینترنتی</span>
                                                <br>
                                                <span class="text-muted">آنلاین با تمام کارت‌های بانکی</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($address->city->name == 'تهران')
                                        <tr>
                                            <td>
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input shipping_address" type="radio" id="paymethod" name="paymethod" id="delivery" value="delivery">
                                                    <label class="form-check-label" for="delivery"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark fw-medium">پرداخت درب محل</span>
                                                <br>
                                                <span class="text-muted">پرداخت وجه درب محل تهران</span>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-white rounded-3 shadow-lg px-4 pt-4 pb-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="h6">آدرس:</h4>
                                        <ul class="list-unstyled fs-sm">
                                            <li>
                                                <span class="text-muted">استان:</span>
                                                {{ $address->city->province->name }}
                                            </li>
                                            <li>
                                                <span class="text-muted">شهر:</span>
                                                {{ $address->city->name }}
                                            </li>
                                            <li>
                                                <span class="text-muted">آدرس:</span>
                                                {{ $address->address }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h6">{{ $address->name }}</h4>
                                        <ul class="list-unstyled fs-sm">
                                            <li>
                                                <span class="text-muted">تلفن:</span>
                                                {{ $address->phone }}
                                            </li>
                                            <li>
                                                <span class="text-muted">کد پستی:</span>
                                                {{ $address->postal_code }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion accordion-flush bg-white my-4" id="checkoutSummary">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cartSummary" aria-expanded="true" aria-controls="cartSummary">
                                            خلاصه سفارش
                                        </button>
                                    </h2>
                                    <div id="cartSummary" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#checkoutSummary">
                                        <div class="accordion-body">
                                            @foreach($products as $product)
                                                <!-- Item-->
                                                <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                                                    <div class="d-block d-sm-flex align-items-center text-center text-sm-end">
                                                        <a class="d-inline-block flex-shrink-0 mx-auto ms-sm-4" href="{{ route('products.show', $product['slug']) }}">
                                                            <img src="{{ $product['image'] }}" width="140" height="140" alt="{{ $product['name'] }}">
                                                        </a>
                                                        <div class="pt-2">
                                                            <h5 class="product-title fs-base mb-2 text-start">
                                                                <a href="{{ route('products.show', $product['slug']) }}">{{ $product['name'] }}</a>
                                                            </h5>
                                                            <div class="fs-sm mb-2 text-start">
                                                                <i class="fas fa-cube txt-gray"> </i> <span class="text-muted ms-2">مدل:</span>
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
                                                                <div class="fs-sm mb-1 text-start">
                                                                    <i class="fas fa-palette txt-gray"></i>
                                                                    <span class="text-muted ms-2">رنگ:</span>
                                                                    {{ $product['variety_value'] }}
                                                                </div>
                                                            @elseif($product['variety_label'] == 'سایز')
                                                                <div class="fs-sm mb-1 text-start">
                                                                    <i class="fas fa-palette txt-gray"></i>
                                                                    <span class="text-muted ms-2">رنگ:</span>
                                                                    {{ $product['variety_value'] }}
                                                                </div>
                                                            @else
                                                                <div class="fs-sm mb-1 text-start">
                                                                    <i class="fas fa-palette txt-gray"></i>
                                                                    <span class="text-muted ms-2">{{ $product['variety_label'] }}:</span>
                                                                    {{ $product['variety_value'] }}
                                                                </div>
                                                            @endif
                                                            <div class="fs-lg text-accent pt-2 text-start">
                                                                <i class="fas fa-money-check-alt txt-gray"></i>
                                                                <span class="text-muted ms-2">قیمت:</span>
                                                                {{ number_format($product['totalPrice'], 0) }} <small>تومان</small>
                                                            </div>
                                                            <div class="pt-2 pt-sm-0 text-start" style="max-width: 9rem;">
                                                                <p class="mb-0">
                                                                    <i class="fa-solid fa-boxes-stacked txt-gray"></i>
                                                                    <span class="text-muted fs-sm">تعداد:</span>
                                                                    <span>{{ $product['quantity'] }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Sidebar-->
                        <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                            <div class="bg-white rounded-3 shadow-lg p-4">
                                <div class="py-2 px-xl-2">
                                    <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="me-2">جمع:</span>
                                            <span class="text-end">{{ number_format($totalPriceProduct, 0) }} <small>تومان</small></span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="me-2">حمل و نقل:</span>
                                            <span class="text-end">
                                    پس کرایه
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" onclick="event.preventDefault();">
                                        مشاهده تعرفه هزینه ارسال
                                    </a>
                                    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered modal-md modal-fullscreen-sm-down">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="cartModalLabel">تعرفه ها</h5>
                                            <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            {!! str_replace(['<h2>', '</h2>'], ['<p>', '</p>'], $shippingPricePage->content) !!}
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بازگشت به سبد خرید</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="me-2">مالیات:</span>
                                            <span class="text-end">0</span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="me-2">تخفیف اعمال شده:</span>
                                            <span class="text-end">
                                                @if($totalDiscount)
                                                    {{ number_format($totalDiscount, 0) }}
                                                    <small>تومان</small>
                                                @else
                                                    0
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                    <h3 class="fw-normal text-center my-4">{{ number_format($totalSum, 0) }} <small>تومان</small</h3>
                                    <button type="submit" class="btn btn-danger btn-shadow d-block w-100 mt-4">
                                        <i class="fas fa-credit-card fs-lg ms-2"></i> پرداخت و ثبت نهایی سفارش
                                    </button>
                                </div>
                            </div>
                            <div class="py-3 px-xl-2">
                                <div class="mb-4">
                                    <p>
                                        کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش دکمه پرداخت و ثبت سفارش را بزنید.
                                    </p>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
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
                            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">
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
