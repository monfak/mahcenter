@extends('frontend.layouts.app')
@section('title', 'اطلاعات ارسال')
@section('styles')
<link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
    .select2-selection__choice {
        color: #666 !important;
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-search__field {
        width: 100% !important;
    }
    .page-title-overlap {
        padding-bottom: 6.375rem;
    }
    @media (max-width: 767.98px) {
        .page-title-overlap {
            padding-bottom: 5.5rem;
        }
    }
    .breadcrumb {
        background-color: unset;
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
</style>
@endsection
@section('scripts')
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#city_id').select2({
                placeholder : 'شهر را انتخاب کنید',
            });
            $('.toggle').addClass('pull-right');
        });
    </script>
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">اطلاعات ارسال</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
          <h1 class="h3 text-light mb-0">اطلاعات ارسال</h1>
        </div>
      </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
        <!-- List of items-->
        <section class="col-lg-8">
            <form action="{{ route('frontend.details.guest') }}" method="post" class="form-horizontal">
            @csrf
                <div class="steps steps-light pt-2 pb-3 mb-5">
                    <a class="step-item active" href="{{ route('cart') }}">
                        <div class="step-progress">
                            <span class="step-count">1</span>
                        </div>
                        <div class="step-label">
                            <i class="ci-cart"></i>سبد خرید
                        </div>
                    </a>
                    <a class="step-item active current" href="{{ route('frontend.details.index') }}">
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
                @auth()
                <h2 class="h6 pb-3 mb-2">آدرس خود را انتخاب کنید</h2>
                <div class="table-responsive">
                    <table class="table table-hover fs-sm border-top">
                        <thead>
                            <tr>
                                <th class="align-middle"></th>
                                <th class="align-middle">آدرس</th>
                                <th class="align-middle">شهر</th>
                                <th class="align-middle">تلفن</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $address)
                            <tr>
                                <td>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input shipping_address" type="radio" id="shipping_address{{ $address->id }}" name="shipping_address"{{ $address->id == $cartAddress ? ' checked' : '' }} value="{{ $address->id }}">
                                        <label class="form-check-label" for="shipping_address{{ $address->id }}"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark fw-medium">{{ $address->name }}</span>
                                    <br>
                                    <span class="text-muted">{{ $address->address }}</span>
                                </td>
                                <td class="align-middle">
                                    استان
                                    {{ $address->city->name }}،
                                    شهر
                                    {{ $address->city->province->name }}
                                </td>
                                <td class="align-middle">{{ $address->phone }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('panel.addresses.index') }}">
                        <span class="fa fa-pen"></span>
                        افزودن آدرس
                    </a>
                </div>
                @else
                <h2 class="h6 pb-3 mb-2">آدرس خود را وارد کنید</h2>
                <div class="table-responsive">
                    <div class="mb-3">
                        <label for="city_id" class="form-label">شهر</label>
                        <select name="city_id" id="city_id" class="form-control">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}"{{ (old('city', ($cart?->address?->city_id ?? null)) == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">تلفن</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', $cart?->address?->phone) }}" dir="auto" placeholder="ترجیحا شماره ثابت ‌(02133132373) یا موبایل">
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">آدرس کامل</label>
                        <textarea id="address" class="form-control" name="address" rows="3">{{ old('address', $cart?->address?->address) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="post_code" class="form-label">کدپستی</label>
                        <input id="post_code" type="text" class="form-control" name="post_code" value="{{ old('post_code', $cart?->address?->post_code) }}" dir="ltr">
                    </div>
                </div>
                @endauth
                <h3>روش‌های ارسال</h3>
                <div class="table-responsive">
                    <table class="table table-hover fs-sm border-top">
                        <thead>
                            <tr>
                                <th class="align-middle"></th>
                                <th class="align-middle">روش ارسال</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deliveryMethods as $deliveryMethod)
                            <tr>
                                <td>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input delivery_method_id" type="radio" id="delivery_method_id{{ $deliveryMethod->id }}" name="delivery_method_id"{{ $deliveryMethod->id == $cart->delivery_method_id ? ' checked' : '' }} value="{{ $deliveryMethod->id }}">
                                        <label class="form-check-label" for="delivery_method_id{{ $deliveryMethod->id }}"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark fw-medium">{{ $deliveryMethod->name }}</span>
                                    <br>
                                    <span class="text-muted">{{ $deliveryMethod->content }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Navigation (desktop)-->
                <div class=" d-flex pt-4">
                    <div class="w-50 ps-3">
                        <a class="cart-btn btn-back d-block w-100" href="{{ route('cart') }}">
                            <i class="ci-arrow-left mt-sm-0 me-1"></i>
                            <span class="d-none d-sm-inline">بازگشت به سبد خرید</span>
                            <span class="d-inline d-sm-none">بازگشت</span>
                        </a>
                    </div>
                    <div class="w-50 pe-2">
                        @auth()
                        <a class="cart-btn btn-proceed d-block w-100" href="{{ route('checkout') }}">
                            <span class="d-none d-sm-inline">ادامه فرآیند خرید</span>
                            <span class="d-inline d-sm-none">پیشرفت</span>
                            <i class="ci-arrow-right mt-sm-0 ms-1"></i>
                        </a>
                        @else
                        <button type="submit" class="cart-btn btn-proceed d-block w-100">
                            <span class="d-none d-sm-inline">ادامه فرآیند خرید</span>
                            <span class="d-inline d-sm-none">پیشرفت</span>
                            <i class="ci-arrow-right mt-sm-0 ms-1"></i>
                        </button>
                        @endauth
                    </div>
                </div>
            </form>
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                <div class="py-2 px-xl-2">
                    <div class="widget mb-3">
                        <h2 class="widget-title text-center pb-2 bold txt-20">سفارشات</h2>
                        @foreach($products as $product)
                        <div class="d-flex align-items-center pb-2 border-bottom">
                            <a class="d-block flex-shrink-0" href="{{ route('products.show', $product['slug']) }}">
                                <img src="{{ $product['image'] }}" width="64" alt="{{ $product['name'] }}">
                            </a>
                            <div class="pe-2">
                                <a class="widget-product-title me-3" href="{{ route('products.show', $product['slug']) }}" style="font-size:0.9rem;color:#333">{{ $product['name'] }}</a>
                                <div class="widget-product-meta me-3 d-flex justify-content-between">
                                    <div>
                                        <span class="text-accent">مدل:</span>
                                        <span class="text-muted">{{ $product['model'] }}</span>   
                                    </div>
                                </div>
                                <div class="widget-product-meta me-3 d-flex justify-content-between">
                                    <span class="text-muted">{{ $product['quantity'] }} عدد</span>
                                    <span class="text-accent">{{ number_format($product['totalPrice'], 0) }} تومان</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <ul class="list-unstyled fs-sm pb-2 border-bottom p-0">
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">جمع کل:</span>
                            <span class="text-end">{{ number_format($totalSum, 0) }} <small>تومان</small</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">هزینه حمل و نقل:</span>
                            <span class="text-end">
                                پس کرایه
                                
                            </span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">مالیات:</span>
                            <span class="text-end">0</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="me-2">تخفیف:</span>
                            <span class="text-end">{{ number_format($totalDiscount, 0) }}</span>
                        </li>
                    </ul>
                    <h3 class="fw-normal text-center my-4">{{ number_format($totalSum, 0) }} <small>تومان</small</h3>
                </div>
            </div>
            <div class="py-3 px-xl-2">
              <div class="mb-4">
                <p>
                    کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.
                </p>
                <p>
                    هزینه ارسال به صورت خودکار و با انتخاب آدرس و روش ارسال مشخص می‌شود. همچنین می‌توانید برای
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" onclick="event.preventDefault();">
                        مشاهده تعرفه هزینه ارسال
                    </a>    
                    کلیک کنید.
                </p>
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
