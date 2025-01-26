@extends('frontend.layouts.app')
@section('title', $site_settings['installment_title'])
@section('description', $site_settings['installment_description'])
@section('styles')
<style>
    .mypercent:disabled + label {
        color: gray;
        opacity: 0.6;
    }
</style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            const persianToEnglish = (str) => {
                const persianDigits = '۰۱۲۳۴۵۶۷۸۹';
                const englishDigits = '0123456789';
                return str.replace(/[۰-۹]/g, (w) => englishDigits[persianDigits.indexOf(w)]);
            };

            const formatNumberWithCommas = (num) => {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            };

            (function($, undefined) {
                "use strict";
                $(function() {
                    var $totalAmountMask    = $("#total_amount_mask");
                    var $totalAmount        = $("#total_amount");

                    $totalAmountMask.on("keyup", function(event) {
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }

                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }

                        var $this = $(this);

                        var input = $this.val();

                        input = persianToEnglish(input);

                        input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt(input, 10) : 0;

                        $this.val(function() {
                            return (input === 0) ? "" : formatNumberWithCommas(input);
                        });

                        var withoutCommas = $totalAmountMask.val().replace(/,/g, '');
                        $totalAmount.val(withoutCommas);
                    });
                });
            })(jQuery);

            $(".select").select2({});

            $(document).on('change keydown keyup', '#total_amount_mask', function () {
                installment();
            });

            $("input[type='radio'][name='percent_price']").on('change', function () {
                if ($('#total_amount').val() != "") {
                    installment();
                }
            });

            $("input[type='radio'][name='month']").on('change', function () {
                if ($('#total_amount').val() != "") {
                    installment();
                }
            });

            function installment() {
                let totalAmount = $('#total_amount').val();
                let percent = $('input[name="percent_price"]:checked').val();
                let month = $('input[name="month"]:checked').val();

                totalAmount = parseFloat(totalAmount);

                let prepayment = totalAmount * (percent / 100);
                let balance = totalAmount - prepayment;
                let profit = balance * (month / 2) * (6 / 100);
                let total = profit + balance;
                let installment = total / month;

                prepayment = formatNumberWithCommas(prepayment.toFixed(0));
                installment = formatNumberWithCommas(installment.toFixed(0));

                if(prepayment.length == 0 || (isNaN(prepayment) && prepayment.length == 3)) {
                    $("#total").html('');
                    $("#installment").html('');
                } else {
                    $("#total").html(prepayment + ' تومان ');
                    $("#installment").html(installment + ' تومان ');
                }
            }
        });
    </script>
@endsection
@section('content')
    <h1 class="headingnone" style="display:none">{{ $site_settings['installment_heading'] }}</h1>
    <div class="container-fluid banner-inner1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 p-xs-0">
                    <div class="row">
                        <div class="col-md-10 p-xs-0">
                            <h2 class="elementor-heading-title">{{ $site_settings['installment_subheading'] }}</h2>
                            <h2 class="elementor-heading-title elementor-size-xl">{{ $site_settings['installment_heading'] }}</h2>
                            <h5 class="elementor-heading-title elementor-size-large mt-5 mb-5">- {{ $site_settings['installment_secondheading'] }}</h5>
                            <div class="row mt-4 row-link">
                                <div class="col-6 ps-0">
                                    <a href="#crd-elementor" class="btn btn-light form-control text-w">ثبت نام خرید
                                        قسطی</a>
                                </div>
                                <div class="col-6 pe-0">
                                    <a href="#installment-form" class="btn btn-outline-light form-control">محاسبه‌گر
                                        اقساط </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-xs-15">
                    @if($site_settings['installment_image'])
                        <img src="{{ asset($site_settings['installment_image']) }}" class="img-fluid" alt="{{ $site_settings['installment_heading'] }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-gray">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-11 mx-auto widget-wrap">
                    <div class="d-block text-body">
                        {!! nl2br($site_settings['installment_content']) !!}
                        <br>
                        @if(!empty($middleBanner))
                            <h2 class="elementor-heading text-center">{{ $middleBanner->name }}</h2>
                        @endif
                        <div class="row mt-3">
                            @if(!empty($middleBanner) && count($middleBanner->items))
                                @foreach($middleBanner->items as $item)
                                    <div class="col-md-4 col-12 mt-3 text-center elementor-box">
                                        <div class="d-block elementor-icon">
                                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $middleBanner->title }}">
                                        </div>
                                        <h3 class="elementor-title mt-3">{{ $item->title }}</h3>
                                        <div class="elementor-body mt-3 ps-md-4 pe-md-4">{!! $item->content !!}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-5 pb-5 ps-0 pe-0">
            <div class="row">
                <div class="col-12 p-0">
                    @if(!empty($secondBanner))
                        <h2 class="elementor-heading text-center">{{ $secondBanner->name }}</h2>
                    @endif
                    <div class="row mt-5">
                        @if(!empty($secondBanner) && count($secondBanner->items))
                            @foreach($secondBanner->items as $item)
                                <div class="col-md-2 ps-2 pe-2 col-6  text-center mb-2">
                                    <a class="main-img-category position-relative text-center" href="{{ $item->url }}">
                                        <div class="logo-category-image">
                                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}">
                                        </div>
                                        <div class="layer-category mt-4 mb-4">{{ $item->title }}</div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5 pb-5">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 p-0">
                    <h2 class="text-dark mb-8 text-center text-2xl font-bold">{{ $site_settings['installment_products_heading'] }}</h2>
                    <div class="d-block mt-5">
                        <div class="gird row-category">
                            @foreach($products as $product)
                                <div class="d-flex flex-col">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <div class="d-block img-grid">
                                            <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                        </div>
                                        <div class="d-block pro-name mt-3" href="">{{ $product->name }}</div>
                                        {{--<div class="d-block text-center pro-payment"> 12 قسط 340,000 تومانی ( 1,320,000 پیش
                                            پرداخت)
                                        </div>--}}
                                        <div class="d-block mt-1 text-center">
                                            <span class="cost-total">{{ number_format($product->special ?? $product->price) }}</span>
                                            <span class="unit">تومان</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5 pb-5 bg-gray">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 p-0">
                    @if(!empty($validationBanner))
                        <h2 class="elementor-heading text-center">{{ $validationBanner->name }}</h2>
                    @endif
                    <div class="d-block text-center text-gray"> هرچقدر مدارک شما کامل‌تر باشد، سقف اعتبار بالاتری برای
                        شما تعیین می‌شود.
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                @if(!empty($validationBanner) && count($validationBanner->items))
                    @foreach($validationBanner->items as $item)
                        <div class="col-md-3 col-6 ps-2 pe-2 text-center mb-3 b-elementor">
                            <div class="img-elementor">
                                <img src=" {{asset($item->image)}}" class="img-fluid" alt="{{ $item->title }}">
                            </div>
                            <h3 class="title-elementor mt-3">{{ $item->title }}</h3>
                            <div class="text-elementor">{!! $item->content !!}</div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row mt-5">
                <div class="col-lg-7 mx-auto col-md-8 col-12 p-xs-0">
                    <div class="card crd-form" id="installment-form">
                        <div class="card-body">
                            <h2 class="elementor-heading text-center">{{ $site_settings['installment_calculation_heading'] }}</h2>
                            <div class="form-group mt-4 total">
                                <input type="text" id="total_amount_mask" class="form-control" placeholder="مبلغ حدودی درخواستی را وارد کنید ..." aria-invalid="false">
                                <input type="hidden" name="total_amount" id="total_amount" class="price">
                            </div>
                            <div class="form-group mt-3">
                                <div class="d-flex align-items-center">
                                    @foreach($months as $month_item)
                                        <div class="gchoice">
                                            <input class="gfield-choice-input{{ $month_item->is_active ? '': ' text-muted' }}" name="month" type="radio" value="{{ $month_item->month }}" id="month_{{ $month_item->id }}" {{ $loop->first ? "checked" : "" }} {{ $month_item->is_active ? '': 'disabled' }}>
                                            <label for="month_{{ $month_item->id }}">{{ $month_item->month }}
                                                ماهه
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="lbl"> انتخاب میزان پیش‌پرداخت </label>
                                <div class="d-flex align-items-center mt-2">
                                    @foreach($percents as $percent_item)
                                        <div class="gchoice">
                                            <input class="gfield-choice-input mypercent{{ $percent_item->is_active ? '' : ' text-muted' }}" name="percent_price" type="radio" value="{{ $percent_item->percent }}" id="percent_{{ $percent_item->id }}" {{ $percent_item->is_active ? '' : 'disabled' }} {{ $percent_item->is_active && $loop->last ? ' checked' : '' }}>
                                            <label for="percent_{{ $percent_item->id }}">
                                                @if($percent_item->percent === 0)
                                                    بدون پیش پرداخت
                                                @else
                                                    {{$percent_item->percent}} درصد
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="col-md-12 ps-md-0 mt-3">
                                    <label class="lbl">میزان پیش‌پرداخت:</label>
                                    <strong class="form-group" id="total"></strong>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="lbl">مبلغ اقساط ماهانه:</label>
                                <strong class="form-group" id="installment"></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-10 mx-auto col-12 p-0">
                    <div class="row align-items-center h-md-100">
                        <div class="col-lg-9 col-md-8 mx-auto col-12 ps-md-0 h-md-100 p-xs-0">
                            <div class="card crd-form" id="crd-elementor">
                                <div class="card-body">
                                    <h2 class="elementor-heading text-center">{{ $site_settings['installment_application_heading'] }}</h2>
                                    <div class="d-block text-center text-gray mt-3">{{ $site_settings['installment_application_subheading'] }}</div>
                                    <div class="d-block mt-3">
                                        <form action="{{ route('frontend.installments.applications.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 ps-md-0 mt-3">
                                                        <label class="lbl" for="name">
                                                            نام و نام خانوادگی <span class="text-danger ms-1">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" name="name" id="name" required placeholder="">
                                                    </div>
                                                    <div class="col-md-6 pe-md-0 mt-3">
                                                        <label class="lbl" for="mobile">
                                                            شماره موبایل <span class="text-danger ms-1">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" name="mobile" id="mobile" required placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 ps-md-0 pe-md-0 mt-3">
                                                        <label class="lbl d-block" for="plan_id"> انتخاب طرح </label>
                                                        <select class="select" name="plan_id" id="plan_id">
                                                            @foreach($plans as $planId => $name)
                                                                <option value="{{ $planId }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 ps-md-0 pe-md-0 mt-3">
                                                        <label class="lbl" for="content"> توضیحات </label>
                                                        <textarea class="form-control" name="content" id="content" required placeholder="نام کالاهای مد نظر، محل سکونت و از این قبیل اطلاعات را اینجا وارد کرده که بررسی درخواست شما سریع‌تر صورت گیرد."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="form-group"> چک به نام شما یا اقوام درجه یک باید باشد.</div>--}}
                                            <div class="form-group mt-3">
                                                <button class="btn btn-primary" type="submit">ثبت درخواست</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 pe-md-0 text-center h-md-100 mt-xs-15">
                            <div class="card crd-contact h-md-100">
                                <div class="d-flex flex-contact">
                                    <div class="d-block text-center">
                                        <img src="{{asset('images/support-light-icon.png')}}" class="img-fluid">
                                    </div>
                                    <p class="mt-3">{{ $site_settings['installment_sidebar_content'] }}</p>
                                    <div class="d-block mt-3">
                                        <a href="tel:{{ str_replace('-', '', str_replace(' ', '', $site_settings['installment_sidebar_tel'])) }}" class="num">{{ $site_settings['installment_sidebar_tel'] }}</a>
                                    </div>
                                    {{--<div class="d-block"> (بـــدون پیـش‌شـماره)</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="message">
            </div>
        </div>
    </div>
@endsection