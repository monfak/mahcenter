@extends('frontend.layouts.app')
@section('title', 'جزئیات سفارش')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
               <div class="card crd-info">
                 <div class="text-h5">جزئیات سفارش</div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>

                <div class="alert alert-success">
                    <strong>کد پیگیری:</strong>
                    {{ $order->tracking_code }}
                </div>
                <hr>
                 <div class="table-responsive">
                      <table class="table table-hover table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">شماره سفارش</th>
                            <th class="text-center">نام کاربر</th>
                            <th class="text-center">موبایل</th>
                            <th class="text-center">ایمیل</th>
                            <th class="text-center">تاریخ ثبت</th>
                            <th class="text-center">وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center">{{ ($order->user->name ?? 'کاربر مهمان') }}</td>
                            <td class="text-center">{{ $order->mobile ?? $order->user->mobile }}</td>
                            <td class="text-center">{{ $order->user->email }}</td>
                            <td class="text-center">{{ jdate($order->created_at)->format('d F Y ساعت H:i') }}</td>
                            <td class="text-center">{{ ['منقضی شده', 'در حال بررسی (منتظر پرداخت)', 'پرداخت شده (در حال ارسال)', 'ارسال شده', 'بازگشت خورده', 'کامل شده'][$order->status] }}</td>
                        </tr>
                    </tbody>
                </table>
                 </div>
                <hr>
                <h4>لیست محصولات</h4>
                <div class="table-responsive">
                      <table class="table table-hover table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center r-tblle">ردیف</th>
                            <th class="text-center r-tblle">نام محصول</th>
                            <th class="text-center r-tblle">تعداد</th>
                            <th class="text-center r-tblle">گارانتی</th>
                            <th class="text-center r-tblle">قیمت اصلی </th>
                            <th class="text-center">تخفیف</th>
                            <th class="text-center r-tblle">قیمت کل </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $product)
                        <tr>
                            <td class="text-center ta-ba">{{$loop->iteration}}</td>
                            <td class="text-center ta-ba">
                                {{ $product->name }}
                                @if($product->variety_label)
                                    ({{ $product->variety_label }}: {{ $product->variety_value }})
                                @endif
                            </td>
                            <td class="text-center ta-ba">
                                {{ $product->pivot->quantity }}
                                عدد
                            </td>
                            <td class="text-center ta-ba">
                                @forelse($product->warranties as $warranty)
                                    @if($warranty->id === $product->pivot->warranty_id) {{ $warranty->name }} @endif
                                @empty
                                    ندارد
                                @endforelse
                            </td>
                            <td class="text-center ta-ba">
                                {{ number_format($product->pivot->price , 0) }}
                                تومان
                            </td>
                            <td class="text-center ta-ba">
                                {{ number_format($product->pivot->discount, 0) }}
                                تومان
                            </td>
                            <td class="text-center ta-ba">
                                {{ number_format($product->pivot->total_price, 0) }}
                                تومان
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="ta-ba" rowspan="3" colspan="5">
                                @if($order->delivery_price > 0)
                                 <p class="hzx">هزینه ارسال </p>
                                <div class="prdkht"></div>
                                @endif
                                <p class="hzx">مبلغ قابل پرداخت </p>
                            </td>
                              @if($order->delivery_price > 0)
                                 <td class="text-center ta-ba"> {{ number_format($order->delivery_price, 0) }} تومان </td>
                             @endif
                        </tr>
                        <tr>
                            <td class="text-center ta-ba"> {{ number_format($order->total_price, 0) }} تومان </td>
                        </tr>
                    </tfoot>
                </table>
                </div>

                @if(count($order->payments) > 0)
                <hr>
                <h4>لیست پرداخت‌ها</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">کد پیگیری سفارش</th>
                        <th class="text-center">کد پیگیری پرداخت</th>
                        <th class="text-center">تاریخ ایجاد</th>
                        <th class="text-center">وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->payments as $payment)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $payment->tracking_code }}</td>
                            <td class="text-center">{{ $payment->ref_id }}</td>
                            <td class="text-center">{{ jdate($payment->created_at)->format('d F Y ساعت H:i') }}</td>
                            <td class="text-center">
                                @if($payment->status)
                                    <span class="label label-success">پرداخت موفق</span>
                                @else
                                    <span class="label label-danger">پرداخت ناموفق</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                @endif
                @if(count($order->sadadPayments) > 0)
                <hr>
                <h4>لیست پرداخت‌ها</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">کد پیگیری پرداخت</th>
                        <th class="text-center">تاریخ ایجاد</th>
                        <th class="text-center">وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->sadadPayments as $payment)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $payment->reference_id }}</td>
                            <td class="text-center">{{ jdate($payment->created_at)->format('d F Y ساعت H:i') }}</td>
                            <td class="text-center">
                                @if($payment->status)
                                    <span class="label bg-green">پرداخت موفق</span>
                                @else
                                    <span class="label bg-red">پرداخت ناموفق</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                @endif
                <hr>
                <div class="alert alert-info">
                    <h4>آدرس:</h4>
                    <p>
                        <strong>استان:</strong>
                        <span>{{ $address->city->province->name }}</span>
                        <br>
                        <strong>شهر:</strong>
                        <span>{{ $address->city->name }}</span>
                        <br>
                        <strong>آدرس:</strong>
                        <span>{{ $address->address }}</span>
                        <br>
                        <strong>تلفن:</strong>
                        <span>{{ $address->phone }}</span>
                    </p>
                </div>
                   </div>
               </div>
            </div>
    </div>
    @foreach($order->products as $product)
        <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form method="post" action="{{ route('review.store') }}" class="form-horizontal" id="form-review">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">ثبت نظر برای {{ $product->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group group-comment">
                                <label class="control-label">امتیاز</label>
                                <span class="txt-comment">بد</span>
                                <input type="radio" name="rating"
                                       value="1"{{ (old('rating') == 1 ? ' selected' : '') }}>
                                <input type="radio" name="rating"
                                       value="2"{{ (old('rating') == 2 ? ' selected' : '') }}>
                                <input type="radio" name="rating"
                                       value="3"{{ (old('rating') == 3 ? ' selected' : '') }}>
                                <input type="radio" name="rating"
                                       value="4"{{ (old('rating') == 4 ? ' selected' : '') }}>
                                <input type="radio" name="rating"
                                       value="5"{{ (old('rating') == 5 ? ' selected' : '') }}>
                                <span class="txt-comment">خوب</span>
                                @if ($errors->has('rating'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control input-sm" placeholder="نام شما" value="{{ old('name', ($authUser ? $authUser->name : '')) }}"{{ ($authUser ? ' readonly' : '') }}>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col">
                            <div class="form-group">
                                <input type="email" id="email" name="email" value="{{ old('email', ($authUser ? $authUser->email : '')) }}" id="input-name" class="form-control input-sm"{{ ($authUser ? ' readonly' : '') }} placeholder="ایمیل">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col">
                            <div class="form-group">
                                <input type="text" name="title" id="suject" value="{{ old('title') }}" id="title" class="form-control input-sm" placeholder="موضوع">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12  col">
                            <div class="form-group">
                                <textarea name="content" id="content" class="form-control  message-box-review" cols="5" rows="5" placeholder="متن پیام">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary mr-auto">ثبت نظر</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    @endforeach
@endsection
