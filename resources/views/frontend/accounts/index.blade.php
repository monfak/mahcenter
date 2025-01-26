@extends('frontend.layouts.app')
@section('title', 'داشبورد')
@section('content')
<div class="container pt-5 pb-4">
    <div class="row">
        @include('frontend.layouts.sidebar')
        <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
            <div class="card crd-info">
                <div class="d-block">
                     <div class="d-flex justify-between items-center">
                         <div class="text-h5">
                             سفارش‌های من
                         </div>
                         <div>
                            <a href="">
                                مشاهده همه
                           <svg style="width: 18px; height: 18px; fill:#19bfd3;">
                               <use xlink:href="#chevronLeft">
                                   <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path></symbol>
                               </use>
                               </svg> 
                            </a> 
                         </div>
                     </div>
                     <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
                     <div class="d-flex flex-row justify-evenly items-center my-2  w-100 rw-link">
                         <a class="d-flex flex-col top-link" href="{{ url('panel/order') }}">
                            <div class="relative">
                              <div style="width: 64px; height: 64px; line-height: 0;">
                                <img class="w-full inline-block" src="{{asset('images/status-processing.svg')}}" width="64" height="64" style="object-fit: contain;" alt="icon" title="">
                              </div>
                            </div> 
                            <div class="flex flex-col justify-between">
                              <div class="text-neutral-700 text-subtitle-strong">{{ $activeOrdersCount }} سفارش</div>
                              <span class="text-body2-strong text-neutral-700">جاری</span>
                            </div>
                         </a>
                         <a class="d-flex flex-col top-link" href="{{ url('panel/order') }}">
                            <div class="relative">
                              <div style="width: 64px; height: 64px; line-height: 0;">
                                <img class="w-full inline-block" src="{{asset('images/status-delivered.svg')}}" width="64" height="64" style="object-fit: contain;" alt="icon" title="">
                              </div>
                            </div> 
                            <div class="flex flex-col justify-between">
                              <div class="text-neutral-700 text-subtitle-strong">{{ $deliveredOrdersCount }} سفارش</div>
                              <span class="text-body2-strong text-neutral-700">تحویل شده</span>
                            </div>
                         </a>
                           <a class="d-flex flex-col top-link" href="{{ url('panel/order') }}">
                            <div class="relative">
                              <div style="width: 64px; height: 64px; line-height: 0;">
                                <img class="w-full inline-block" src="{{asset('images/status-returned.svg')}}" width="64" height="64" style="object-fit: contain;" alt="icon" title="">
                              </div>
                            </div> 
                            <div class="flex flex-col justify-between">
                              <div class="text-neutral-700 text-subtitle-strong">{{ $failedOrdersCount }} سفارش</div>
                              <span class="text-body2-strong text-neutral-700">ناموفق</span>
                            </div>
                         </a>
                     </div>
                </div>
            </div>
            @if(count($products))
            <div class="d-block mt-3">
                <div class="card crd-info">
                    <div class="d-flex justify-between items-center">
                         <div class="text-h5">
                            از علاقه مندی‌های شما
                         </div>
                         <div>
                            <a href="{{ route('wishlist') }}">
                                مشاهده همه
                                <svg style="width: 18px; height: 18px; fill:#19bfd3;">
                                   <use xlink:href="#chevronLeft">
                                       <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path></symbol>
                                   </use>
                               </svg> 
                            </a> 
                         </div>
                     </div>
                     <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
                     <div class="d-block mt-3">
                         <div class="owl-carousel owl-theme owl-list">
                            @foreach($products as $product)
                             <div class="item item-pro position-relative">
                                @if($product->discount)
                                <span class="text-danger lbl-sale">فروش ویژه</span>
                                @endif
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="position-relative">
                                        <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </div>
                                <div class="text-danger font-12">
                                    @if($product->stock)
                                    تنها {{ numberToPersianWords($product->stock) }} عدد در انبار باقی مانده است
                                    @else
                                    موجودی این محصول به اتمام رسیده است.
                                    @endif
                                </div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                @unless(is_null($product->special))
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                    <div class="d-block">
                                        <span class="old-cost me-2">
                                            {{ number_format($product->price) }}
                                            <span class="unit">تومان</span>
                                        </span>
                                        <span class="offer">
                                          <span class="off">{{ $product->discount }} %</span>
                                        </span>
                                    </div>
                                    <div class="d-block mt-1">
                                        <span class="cost-total">{{ number_format($product->special) }}</span>
                                        <span class="unit">تومان</span>
                                    </div>
                                </div>
                                @else
                                    <div>
                                        <span class="cost-total">{{ number_format($product->special ?? $product->price, 0) }} </span>
                                        <span class="unit">تومان</span>
                                    </div>
                                @endunless
                                <div class="col-12 p-0">
                                  <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    مشاهده محصول
                                  </a>
                                </div>
                              </div>
                            </div>
                            @endforeach
                         </div>
                     </div>
                </div>
            </div>
            @endif
            {{--<div class="d-block mt-3">
                <div class="card crd-info">
                    <div class="d-flex justify-between items-center">
                         <div class="text-h5">
                          خرید های پر تکرار شما
                         </div>
                         <div>
                            <a href="">
                                مشاهده همه
                           <svg style="width: 18px; height: 18px; fill:#19bfd3;">
                               <use xlink:href="#chevronLeft">
                                   <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path></symbol>
                               </use>
                               </svg> 
                            </a> 
                         </div>
                     </div>
                     <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
                     <div class="d-block mt-3">
                         <div class="owl-carousel owl-theme owl-list">
                             <div class="item item-pro position-relative">
                                 <span class="text-danger lbl-sale">فروش ویژه</span>
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="https://mahcenter.com/products/maxs" target="_blank" class="position-relative">
                                        <img src="https://mahcenter.com/storage/images/products/2021/12/tEIxNJInQDYFWLMzw92sJ2a6AClOwgqV5GBGINzgtesWjRpeAGXis7nGynzucXJm-h130.jpeg" class="img-fluid" alt="یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="https://mahcenter.com/products/maxs">یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور</a>
                                </div>
                                <div class="text-danger font-12">تنها یک عدد در انبار باقی مانده است</div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                            <div class="d-block">
                                    <span class="old-cost me-2">5,600,000 <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">14 %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">4,800,000</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                                <div class="col-12 p-0">
                                  <a href="" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    اضافه به سبد خرید
                                  </a>
                                </div>
                              </div>
                            </div>
                             <div class="item item-pro position-relative">
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="https://mahcenter.com/products/maxs" target="_blank" class="position-relative">
                                        <img src="https://mahcenter.com/storage/images/products/2021/12/tEIxNJInQDYFWLMzw92sJ2a6AClOwgqV5GBGINzgtesWjRpeAGXis7nGynzucXJm-h130.jpeg" class="img-fluid" alt="یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="https://mahcenter.com/products/maxs">یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور</a>
                                </div>
                                <div class="text-danger font-12">تنها یک عدد در انبار باقی مانده است</div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                            <div class="d-block">
                                    <span class="old-cost me-2">5,600,000 <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">14 %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">4,800,000</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                                <div class="col-12 p-0">
                                  <a href="" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    اضافه به سبد خرید
                                  </a>
                                </div>
                              </div>
                            </div>
                             <div class="item item-pro position-relative">
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="https://mahcenter.com/products/maxs" target="_blank" class="position-relative">
                                        <img src="https://mahcenter.com/storage/images/products/2021/12/tEIxNJInQDYFWLMzw92sJ2a6AClOwgqV5GBGINzgtesWjRpeAGXis7nGynzucXJm-h130.jpeg" class="img-fluid" alt="یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="https://mahcenter.com/products/maxs">یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور</a>
                                </div>
                                <div class="text-danger font-12">تنها یک عدد در انبار باقی مانده است</div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                            <div class="d-block">
                                    <span class="old-cost me-2">5,600,000 <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">14 %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">4,800,000</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                                <div class="col-12 p-0">
                                  <a href="" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    اضافه به سبد خرید
                                  </a>
                                </div>
                              </div>
                            </div>
                             <div class="item item-pro position-relative">
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="https://mahcenter.com/products/maxs" target="_blank" class="position-relative">
                                        <img src="https://mahcenter.com/storage/images/products/2021/12/tEIxNJInQDYFWLMzw92sJ2a6AClOwgqV5GBGINzgtesWjRpeAGXis7nGynzucXJm-h130.jpeg" class="img-fluid" alt="یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="https://mahcenter.com/products/maxs">یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور</a>
                                </div>
                                <div class="text-danger font-12">تنها یک عدد در انبار باقی مانده است</div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                            <div class="d-block">
                                    <span class="old-cost me-2">5,600,000 <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">14 %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">4,800,000</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                                <div class="col-12 p-0">
                                  <a href="" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    اضافه به سبد خرید
                                  </a>
                                </div>
                              </div>
                            </div>
                             <div class="item item-pro position-relative">
                              <div class="item-img">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="img-pro position-relative">
                                      <a href="https://mahcenter.com/products/maxs" target="_blank" class="position-relative">
                                        <img src="https://mahcenter.com/storage/images/products/2021/12/tEIxNJInQDYFWLMzw92sJ2a6AClOwgqV5GBGINzgtesWjRpeAGXis7nGynzucXJm-h130.jpeg" class="img-fluid" alt="یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور">
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row name-col mt-1">
                                <div class="col-12 pro-name-special position-relative">
                                  <a class="d-block pro-name" href="https://mahcenter.com/products/maxs">یخچال فریزر دوقلو دیپوینت MAX.D SILVER- سیلور</a>
                                </div>
                                <div class="text-danger font-12">تنها یک عدد در انبار باقی مانده است</div>
                              </div>
                              <div class="row mt-3 align-items-flex-end cost-col">
                                <div class="col-12 cost text-end p-0 off-pro mb-2 mt-2">
                                            <div class="d-block">
                                    <span class="old-cost me-2">5,600,000 <span class="unit">تومان</span>
                                    </span>
                                    <span class="offer">
                                      <span class="off">14 %</span>
                                    </span>
                                  </div>
                                  <div class="d-block mt-1">
                                    <span class="cost-total">4,800,000</span>
                                    <span class="unit">تومان</span>
                                  </div>
                                </div>
                                <div class="col-12 p-0">
                                  <a href="" class="btn btn-outline-danger d-block font-12">
                                   <svg class="svg-icon" style="width: 24px; height: 24px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M851.209481 1024M940.809481 172.790519l-742.4 0C185.609481 115.2 179.2 76.8 179.2 70.409481c0-32.009481-19.190519-51.2-38.4-64C121.609481 0 108.790519 0 102.4 0l0 0L32.009481 0C12.8 0 0 12.8 0 32.009481 0 51.2 12.8 64 32.009481 64L102.4 64l6.390519 0c0 0 6.409481 0 6.409481 12.8 6.409481 38.4 102.4 646.390519 108.790519 684.809481 0 6.390519 6.409481 19.209481 12.8 38.4 19.209481 19.190519 38.4 38.4 83.190519 38.4l595.209481 0c19.209481 0 32.009481-12.8 32.009481-31.990519s-12.8-32.009481-32.009481-32.009481L320 774.409481c-6.409481 0-19.190519 0-25.6-6.409481l-6.409481-6.390519 0-6.409481c0 0-6.390519-25.6-12.8-64l588.8 0c51.2 0 83.209481-25.6 96.009481-70.409481l0 0L1024 256l0-6.409481C1024 211.209481 985.6 172.790519 940.809481 172.790519L940.809481 172.790519 940.809481 172.790519zM902.409481 607.990519c-6.409481 12.8-12.8 25.6-32.009481 25.6L268.8 633.590519C256 518.390519 223.990519 358.4 204.8 236.809481l736.009481 0c6.409481 0 12.8 6.390519 19.190519 12.8L902.409481 607.990519 902.409481 607.990519 902.409481 607.990519zM902.409481 607.990519M855.22963 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C921.6 920.974222 891.885037 891.259259 855.22963 891.259259zM324.039111 891.259259c-36.655407 0-66.37037 29.714963-66.37037 66.37037 0 36.655407 29.714963 66.37037 66.37037 66.37037 36.655407 0 66.37037-29.714963 66.37037-66.37037C390.409481 920.974222 360.694519 891.259259 324.039111 891.259259z"  /></svg>
                                    اضافه به سبد خرید
                                  </a>
                                </div>
                              </div>
                            </div>
                         </div>
                     </div>
                </div>
            </div>--}}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    if ($(".owl-list").length) {
  var heroSlider = $(".owl-list");
  var owlCarouselTimeout = 3500;
  $(".owl-list").owlCarousel({
    // autoplay: true,
    // loop: true,
    //autoplayHoverPause: true,
    smartSpeed: 450,
    rtl: true,
    dots: false,
    margin: 20,
    lazyLoad: true,
    responsive: {
      0: {
        nav: false,
        items: 1
      },
      400: {
        nav: false,
        items: 1
      },
      440: {
        nav: false,
        items: 2,
        stagePadding: 20,
      },
      768: {
        nav: false,
        items: 2,
        stagePadding: 30,
      },
      992: {
        nav: false,
        items: 4,
        stagePadding: 10,
      },
      1200: {
        nav: true,
        items: 4,
      },
    },
  });
}
</script>
@endsection
