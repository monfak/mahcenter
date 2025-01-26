
    <select style="width: 100%;text-align: right;" class="col-md-12 form-control m-input m-input--air js-example-basic-multiple" name="validet" >
        <option value="{{Modules\Order\Entities\Order::PENDING}}">در حال ارسال</option>
        <option value="{{Modules\Order\Entities\Order::SENT}}">ارسال شده</option>
        <option value="{{Modules\Order\Entities\Order::EXPIRED}}">کنسل شده</option>
        <option value="{{Modules\Order\Entities\Order::COMPLETED}}">کامل شده</option>
    </select>





@extends('frontend.layouts.app')

@section('title')
   پیگیری سفارش
@endsection

@section('content')
    <div class="container-fluid slide gap-col-mob">
        <div class="container section1-1 gap-top gap-col-mob">
            @unless(!$order)
                <div class="row ">
                    <div id="content" class="col-sm-12 mt-4">
                        <h1> پیگیری سفارش</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td class="text-center">کد سفارش</td>
                                    <td class="text-right">آدرس</td>
                                    <td class="text-right">موبایل</td>
                                    <td class="text-right">وضعیت</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-right">
                                         {{ $order->tracking_code }}
                                        </td>
                                        <td class="text-left">
                                            {{ $order->address }}
                                        </td>
                                        <td class="text-left">
                                            {{ $order->mobile }}
                                        </td>
                                        <td class="text-center">
                                            {{ $order->status }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4 mb-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div id="content" class="col-sm-12"><h1>   پیگیری سفارش</h1>
                                <p>این سفارش را ثبت نکرده‌اید.</p>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <a href="{{ route('home') }}" class="btn btn-primary">ادامه</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
@endsection