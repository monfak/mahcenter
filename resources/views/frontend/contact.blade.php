@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>تماس با دیجی‌کالا</h1>
                <p>کاربر گرامی، لطفاً در صورت وجود هرگونه سوال یا ابهامی، پیش از ارسال ایمیل یا تماس تلفنی با دیجی‌کالا، بخش پرسش‏های متداول را ملاحظه فرمایید و در صورتی که پاسخ خود را نیافتید، با ما تماس بگیرید.</p>
                <p>مشتری گرامی برای پیگیری یا سوال درباره سفارش بهتر است از فرم زیر استفاده کنید. اما اگر تمایل به ارسال مستقیم ایمیل دارید، جهت تسریع در پاسخ‌گویی لطفاً شماره سفارش (پیگیری) را در ایمیل خود ذکر کنید.
                    لطفاً در صورت امکان اطلاعات را به فارسی وارد نمایید.</p>
                <form action="" method="" class="form-horizontal" style="margin: 20px">
                    @csrf
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">نام و نام خانوادگی *</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">آدرس ایمیل *</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">تلفن تماس *</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">موضوع *</label>

                        <div class="col-md-6">
                            <select name="" id="" class="form-control">
                                <option value="">انتخاب کنید</option>
                                <option value="">پیشنهاد</option>
                                <option value="">انتقاد یا شکایت</option>
                                <option value="">پیگیری سفارش</option>
                                <option value="">خدمات پس از فروش</option>
                                <option value="">حسابداری و امور مالی</option>
                                <option value="">همکاری در فروش</option>
                                <option value="">خرید کارت هدیه</option>
                                <option value="">می خواهم در سایت شما فروشنده کالای خود باشم</option>
                                <option value="">استعلام گارانتی</option>
                                <option value="">مدیریت</option>
                                <option value="">سایر موضوعات</option>
                            </select>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">شماره سفارش</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">متن پیام</label>

                        <div class="col-md-6">
                            <textarea id="first_name" type="text" rows="5" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus></textarea>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-primary" disabled title="تا زمان تخصیص دامنه امکان تماس وجود ندارد">ارسال فرم</button>
                </form>
            </div>
        </div>
    </div>
@endsection
