@extends('frontend.layouts.app')
@section('title', 'ثبت‌نام')
@section('styles')
    <link rel="stylesheet" href="/vendor/select2/select2.min.css">
    <style>
    .flag {
    color: #f40606;
}
        .select2-selection__choice {
            color: #666 !important;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-search__field {
            width: 100% !important;
        }
        
        
        .thumb-register, .thumbanil.thum-reg-log {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
            -webkit-box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
            -moz-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1);
            -ms-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1);
            border: 1px solid #ebeced;
            padding: 20px !important;
            margin: 25px auto;
        }
        
        
        .btn-reg::before, .btn-register::before {
            width: 95px;
            height: 95px;
            position: absolute;
            right: -15px;
            background: hsla(0, 0%, 100%, .21);
            content: "";
            border-radius: 50%;
            top: -23px;
            transition: all .3s ease-in-out;
        }
        
        .icon-reg {
            background-position: -1306px -76px !important;
            height: 49px;
            line-height: 38px;
            width: 65px;
            float: right;
            background:url(../images/them/slices-inner.png) no-repeat #6e6e6e;
        }
        .txt-btn-reg {
            font-size: 18px;
        }
        
        .btn-reg.form-control, .btn-register {
            padding: 0 !important;
            -webkit-transition: background-color 150ms ease 0s;
            -ms-transition: background-color 150ms ease 0s;
            -moz-transition: background-color 150ms ease 0s;
            -o-transition: background-color 150ms ease 0s;
            transition: background-color 150ms ease 0s;
            background-color:#6e6e6e !important;
            color: #fff !important;
            height: 50px;
            line-height: 50px;
            text-align: right;
            position: relative;
            overflow: hidden;
            box-shadow: none !important;
        }
        @media screen and (min-width: 768px)
        .thumbanil.thum-reg-log {
            width: 40% !important;
            margin: auto !important;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid body-section">
<div class="container gap-col-mob">
    <div class="thumbnail thumb-register">
        <div class="row">
            <div id="content" class="col-sm-12 col-12">
                <h3 class="text-center">ايجاد حساب کاربری</h3>
                <p class="text-center">اگر شما قبلا ثبت نام کرده ايد، لطفا وارد شويد<a href="{{ route('login') }}"> صفحه ورود </a>.</p>
                <hr>
                <form id="account" method="POST" action="{{ route('register') }}" class="form-horizontal" class="reg-form" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mr-md-auto ml-md-auto col-sm-12 col-12 gap-col-mob">
                            <fieldset id="account">
                                <p>اطلاعات شخصی شما</p>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                             <span class="flag">*</span>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="نام" id="first_name" class="form-control" />
                                        </div>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                             <span class="flag">*</span>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="نام خانوادگی" id="last_name" class="form-control" />
                                        </div>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-mobile-alt"></i></span>
                                             <span class="flag">*</span>
                                            <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="موبایل" id="mobile" class="form-control" />
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                            <input type="email"  autocomplete="false" name="email" value="{{ old('email') }}" placeholder="ایمیل" id="email" class="form-control" />
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mr-md-auto ml-md-auto col-sm-12 col-12 gap-col-mob">
                            <fieldset>
                                <p>رمز عبور شما</p>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" name="password" value="" placeholder="رمز عبور" id="input-password" class="form-control" />
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12 gap-col-mob">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" name="password_confirmation" value="" placeholder="تکرار رمز عبور" id="password_confirmation" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="buttons">
                                    <button type="submit" class="btn btn-default btn-register form-control">
                                        <i class="icon-reg"></i>
                                        <span class="txt-btn-reg">
                    					ثبت نام در سایت
                    					</span>
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
