@extends('frontend.layouts.app')

@section('content')
    <div class="alert-success col-md-8 " style="size: 10px;text-align: center;padding: 15px 30px;margin:60px auto;line-height:50px">
        <span>سفارش شما با موفقیت ثبت شد </span>
        <span>کد پیگیری شما : </span>
        <p>{{$order->tracking_code}}</p>
    </div>
    <br/>
    <div class="panel alert box">
        <h6  class="color"> کاربر محترم در صورت تمایل
            <a class="text-success" href=" {{ route('register') }}">ثبت نام </a> کنید
            یاعملیات <a  class="text-success" href=" {{ route('login') }}">ورود</a>  را انجام دهید
        </h6>



    </div>
@endsection
