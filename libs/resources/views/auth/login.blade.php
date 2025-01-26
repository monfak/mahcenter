@extends('frontend.layouts.app')
@section('title', 'ورود')
@section('styles')
   <style>
       .icon-login
       {
           margin-right: 11px!important;
       }
   </style>
@endsection
@section('content')
<div class="container-fluid body-section">
 <div class="container gap-col-mob">
    <!-- Under development -->
    <div id="content" class="col-sm-12  col-xs-12 cont-reg gap-col-mob">
        <div class="row">
        <div class="col-sm-12  col-xs-12 gap-col-mob" >
            <div class="row">
                <div class="thumbanil thum-reg-log">
                    <div class="login-box">
                        <!--<h4>مشتريان فروشگاه</h4>-->
                        <p class="title-page-login  text-center">ورود به سایت</p>
                        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="login-form">
                            @csrf
                            <div class="form-group m-3">
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
                            <div class="form-group m-3">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="usericon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="password" value="" placeholder="رمز عبور" id="input-password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-3">
                                <div class="form-check checkbox">
								    <label class="form-check-label checkbox-icon">
                                     <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin: -8px -12px 8px 8px;">
                                        <span class="c-ui-checkbox__check"></span>
									 
                                    </label>
									<label class="form-check-label checkbox-txt" for="remember">
									  مرا به خاطر بسپار
                               
								   </label>
							    </div>
                            </div>
                            <div class="form-group m-3">
                                <button type="submit" class="btn btn-default btn-reg form-control">
                                    <i class="icon-login"></i>
                                    <span class="txt-btn-reg">ورود به سایت</span>
                                </button>
                            </div>
                        </form>

                        <div class="form-group">
                            <a href="{{ route('password.request') }}">رمز عبور را فراموش کرده ام</a>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="col-sm-12 col-xs-12">
                                    <span class="txt-register">کاربر جدید هستید؟</span>
                                    <span class="link-register">
                                        <a target="_blank" href="{{ route('register') }}">ثبت نام در سایت</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Under development -->

</div>
</div>
@endsection
