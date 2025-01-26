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
                                <p class="title-page-login  text-center">فراموشی رمز عبور</p>
                                <form method="POST" action="{{ route('password.reset.sms') }}"  class="login-form">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="usericon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="شماره موبایل خود را وارد کنید" id="input-phone" class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
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
