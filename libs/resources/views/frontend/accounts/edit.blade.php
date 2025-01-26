@extends('frontend.layouts.app')
@section('title', 'ویرایش پروفایل')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
                <div class="card crd-info">
                 <div class="text-h5">ویرایش پروفایل من</div>
                    <div class="d-block mt-1 mb-1">
                        <span class="red-line"></span>
                    </div>
                    @unless($authUser->first_name && $authUser->last_name)
                    <div class="alert alert-danger">
                        لطفا برای استفاده صحیح از امکانات سایت حتما نام و نام خانوادگی خود را وارد کنید و تغییرات را ذخیره کنید.
                    </div>
                    @endunless
                    <form action="{{ route('panel.update') }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <fieldset>
                            @include('frontend.layouts.partials.input-errors')
                            <div class="form-group mt-3 mt-3 required">
                                <label class="col-12 control-label" for="first_name">نام </label>
                                <div class="col-12">
                                    <input type="text" name="first_name" value="{{ old('first_name', $authUser->first_name) }}" placeholder="نام" id="first_name" class="form-control">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3 required">
                                <label class="col-12 control-label" for="last_name">نام خانوادگی</label>
                                <div class="col-12">
                                    <input type="text" name="last_name" value="{{ old('last_name', $authUser->last_name) }}" placeholder="نام خانوادگی" id="last_name" class="form-control">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3 required">
                                <label class="col-12 control-label" for="email">ایمیل</label>
                                <div class="col-12">
                                    <input type="email" name="email" value="{{ old('email', $authUser->email) }}" placeholder="ایمیل" id="email" class="form-control" dir="ltr">
                                    @if ($errors->has('email'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3 required">
                                <label class="col-12 control-label" for="mobile">موبایل</label>
                                <div class="col-12">
                                    <input type="text" name="mobile" value="{{ old('mobile', $authUser->mobile) }}" readonly placeholder="تلفن" id="mobile" class="form-control" dir="ltr">
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3 mt-3 required">
                                <label class="col-12 control-label" for="national_code">کدملی</label>
                                <div class="col-12">
                                    <input type="text" name="national_code" value="{{ old('national_code', $authUser->national_code) }}" dir="ltr" placeholder="کدملی" id="national_code" class="form-control"{{ $authUser->national_code ? ' readonly' : '' }}>
                                    @if ($errors->has('national_code'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('national_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="row form-group mt-5 mb-4">
                            <div class="col-6">
                                <a href="{{ route('panel.index') }}" class="btn btn-outline-light text-dark form-control" style="line-height: 2;">بازگشت</a
                                ></div>
                            <div class="col-6">
                                <input type="submit" value="ذخیره تغییرات" class="btn btn-primary form-control" style="line-height: 2;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
