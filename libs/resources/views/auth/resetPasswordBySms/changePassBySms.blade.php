@extends('frontend.layouts.app')
@section('content')
    <div class="container-fluid body-section login-register">
        <div class="container gap-col-mob">
            <!-- Under development -->
            <div id="content" class="col-sm-12  col-xs-12 cont-reg gap-col-mob">
                <div class="row">
                    <div class="col-sm-12  col-xs-12 gap-col-mob" >
                        <div class="thumbanil thum-reg-log">
                            <div class="login-box">
                                <!--<h4>مشتريان فروشگاه</h4>-->
                                <p class="title-page-login  text-center">بازیابی رمز عبور</p>
                                <form method="POST" action="{{ route('reset.password.send.sms.change.store') }}"  class="login-form">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="usericon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="تلفن" id="input-phone" class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="usericon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                            <input id="code" type="number" class="style-input form-control" name="code" value="{{ old('code') }}"  placeholder="کد را وارد کنید">
                                            @if ($errors->has('code'))
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="usericon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                            <input id="password" type="password" name="password" class="style-input form-control" placeholder="رمز عبور خود را وارد کنید">
                                            @if ($errors->has('password'))
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="usericon"><i class="fa fa-lock" aria-hidden="true"></i></span>

                                            <input id="password_confirmation" type="password" name="password_confirmation" class="style-input form-control" placeholder="تکرار رمز عبور را وارد نمایید">

                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btn-reg form-control">
                                            <i class="icon-login"></i>
                                            <span class="txt-btn-reg">ارسال</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Under development -->
        </div>
    </div>
@endsection

