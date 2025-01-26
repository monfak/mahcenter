@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('کد فعال سازی به ایمیل شما ارسال شد') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('کد فعال سازی جدید به ایمیل شما ارسال شد') }}
                        </div>
                    @endif

                        {{ __('اگرایمیل دریافت نکردید برای ارسال مجدد') }} <a  class="text-danger" href="{{ route('verification.resend') }}">{{ __('کد فعالسازی') }}</a>
                    {{(' کلیک کنید')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
