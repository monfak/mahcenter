@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
    <link rel="stylesheet" href="/css/cartStyle.css">
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/owl.theme.default.min.css"/>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    {{--@if(auth()->check())--}}
        <div class="container-fluid">
        <form method="Post" action="{{route('orders.store')}}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <p class="title-section">آدرس تحویل سفارش</p>
                </div>
                <div class="row wrapper-section row-one">
                    <div class="col-sm-12 col-xs-12 gap-col">
                        <div class="row">
                            <div class="col-sm-8 col-xs-12 gap-col">
                                <span>گیرنده:</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 gap-col">
                                <ul class="cal-user">
                                    @if($errors->any())
                                        <div class="box-body">
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
                                        </div>
                                    @endif
                                    <li>
                                        <div class="form-group">
                                            <label for="group_name" class="col-md-12 control-label">شماره تماس:</label>
                                            <div class="col-md-12">
                                                <input type="number" name="mobile" id="mobile" class="form-control">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="group_name" class="col-md-12 control-label">کد پستی :</label>
                                            <div class="col-md-12">
                                                <input type="number" name="postal_code" id="post_cod" class="form-control">
                                            </div>
                                        </div>
                                    </li>
                                    <br/>
                                    <li>
                                        <div class="form-group">
                                            <label for="group_name" class="col-md-12 control-label">آدرس:</label>
                                            <div class="col-md-12">
                                                <textarea id="address" type="text" class="form-control tinymce" name="address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-sm-8 col-xs-12">
                    <div class="row ">
                        <div class="col-sm-12 col-xs-12">
                                <p class="title-section"><span>مرسوله</span></p>
                        </div>
                    </div>
                    <div class="row wrapper-section row-two ">
                        <div class="col-sm-12 col-xs-12 gap-col">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="table-responsive">

                                        <table class="table  tbl-costum ">
                                            @if($cartProducts)
                                                @foreach($cartProducts as $value)
                                                    <tr>
                                                        <td style="margin:0 auto"><img src="{{ asset($value->image)}}" class="img-responsive" width="100" height="100"></td>
                                                        <td style="padding-top:60px">{{ $value->name }}    مدل : {{ $value->model}}</td>
                                                        <td style="padding-top:60px"> {{ $value->quantity   }}عدد</td>
                                                        <td style="padding-top:60px"> {{ number_format($value->price )  }}قیمت واحد</td>
                                                        <td style="padding-top:60px"> {{ $value->totalPrice   }}قیمت کل</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                            {{--<div class="row select-times">--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}
                            {{--<p class="title-bar">لطفا  نوع و زمان ارسال را انتخاب بفرمایید:</p>--}}
                            {{--<ul class="subtitle-bar">--}}
                            {{--<li>--}}
                            {{--<input type="radio" name="type_order" value="send-one "> ارسال رایگان از ‌روز آینده  </input>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="radio"  name="type_order" value="send-today">ارسال سریع از سه ساعت اینده  </input>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--<br/>--}}
                            {{--<div class="row">--}}


                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="row rw-lnk">
                        <div class="col-sm-6 col-xs-12 gap-col back-to">
                            <a href="#" class="btn-link-spoiler" >
                                « بازگشت به سبد خرید
                            </a>
                        </div>
                        <div class="col-sm-6 col-xs-12 gap-col next-to">
                            <button type="button" class="btn-link-spoiler" >تایید  ثبت سفارش »
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 gap-col wrapper-section">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 gap-col r-tbl-cart">
                                    <span>مبلغ کل</span>
                                </div>
                                <div class="col-sm-6 col-xs-6 gap-col l-tbl-cart">
                                    <span>  {{ number_format($cartProducts->sum('totalPrice'), 0) }}</span>

                                    <span>تومان</span>
                                </div>
                            </div>
                            <div class="gap-row"></div>
                            <p class="psummary-price-title">مبلغ قابل پرداخت:</p>
                            <div class="checkout-summary-price-value">
                                {{ number_format($cartProducts->sum('totalPrice'), 0) }} تومان
                            </div>
                            <p >
                                <div  class="selenium-next-step-shipping ">
                                    <button class="btn-checkout" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                        تائید و ادامه ثبت سفارش</button>
                                </div>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </form>
        </div>

    {{--@else--}}
        {{--<div class="panel alert box">--}}
            {{--<h6  class="color"> کاربر محترم شما باید--}}
               {{--<a  href=" {{ route('register') }}">ثبت نام </a> کنید--}}
                    {{--یاعملیات <a  href=" {{ route('login') }}">ورود</a>  را انجام دهید--}}
            {{--</h6>--}}



        {{--</div>--}}

    {{--@endif--}}


@endsection