@extends('frontend.layouts.app')
@section('title', $site_settings['products_title'])
@section('description', $site_settings['products_description'])
@section('content')
    <div class="container container-pro">
        <div class="row mt-4 mb-4">
            <div class="col-12 p-0">
                 <h1 class="title-section text-center">{{ $site_settings['products_heading'] }}</h1>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div id="content" class="col-sm-12">
               <div class="row row-sort-top">
                <div class="col-sm-9 ps-md-0 d-none d-md-block">
                    <div class="btn-filter">
                        <label class="icon-sort" >
                            <span class="me-2">
                                <svg style="width: 24px; height: 24px; fill: #4d515a;">
                                    <use xlink:href="#sort">
                                      <symbol id="sort" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M6 15.793L3.707 13.5l-1.414 1.414 4 4a1 1 0 001.414 0l4-4-1.414-1.414L8 15.793V5H6v10.793zM22 5H10v2h12V5zm0 4H12v2h10V9zm0 4h-8v2h8v-2zm-6 4h6v2h-6v-2z" clip-rule="evenodd"></path></symbol>  
                                    </use>
                                    </svg>
                            </span>مرتب سازی
                        </label>
                        <label class="sort_label">
                            <input class="button_radio filter" value="most_viewed" name="filter_sort" type="radio">
                            <span>پربازديد ترين</span>
                        </label>
                        <label class="sort_label">
                            <input class="button_radio filter" value="latest" name="filter_sort" type="radio">
                            <span>جديدترين‌ها</span>
                        </label>
                        <label class="sort_label">
                            <input class="button_radio filter" value="price_desc" name="filter_sort" type="radio">
                            <span>قيمت نزولی</span>
                        </label>
                        <label class="sort_label">
                            <input class="button_radio filter" value="price_asc" name="filter_sort" type="radio">
                            <span>قيمت صعودی</span>
                        </label>

                    </div>
                </div>
                <div class="col-6 d-xl-none d-lg-none d-md-none">
                    <div class="sort-option border-none">
                        <div class="center">
                            <button  data-bs-toggle="modal" data-bs-target="#sortModal"  class="btn btn-sort">
                                <i class="fas fa-sort-amount-down ms-2"></i>مرتب سازی</button>
                            </div>
                        <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p class="sort-caption">مرتب سازی</p>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty"> پر بازدید ترین ها</span>
                                                <input id="sort-1" name="radio-talar" value=" پر بازدید ترین ها" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty">  جدید ترین ها</span>
                                                <input id="sort-2" name="radio-talar" value=" جدید ترین ها" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty">محبوب ترین ها</span>
                                                <input id="sort-3" name="radio-talar" value=" محبوب ترین ها" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty">  پرفروش ترین ها</span>
                                                <input id="sort-4" name="radio-talar" value=" پرفروش ترین ها" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty"> قیمت نزولی</span>
                                                <input id="sort-5" name="radio-talar" value=" قیمت نزولی" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label class="checkbox-icon customradio">
                                                <span class="radiotextsty"> قیمت صعودی</span>
                                                <input id="sort-6" name="radio-talar" value=" قیمت صعودی" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                            <div class="btn-group btn-delete " role="group">
                                                <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-bs-dismiss="modal" role="button">اعمال</button>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default" data-bs-dismiss="modal" role="button">انصراف</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-6 gap-col sort-icon text-end ">
                    <div class="btn-group btn-grid">
                        <span class="text-page">
                           <label class="control-label" for="input-limit">نمايش:</label>
                        </span>
                        <span class="drop-page">
                           <select id="input-limit" class="form-control filter">
                               <option value="16" selected="selected">16</option>
                               <option value="32">32</option>
                               <option value="48">48</option>
                               <option value="96">96</option>
                               <option value="120">120</option>
                           </select>
                        </span>
                    </div>
                </div>
            </div>
                <div class="row mt-3">
                    @foreach($products as $product)
                        <div class="product-layout product-grid item  grid-group-item col-lg-3 col-md-4   col-12">
                            <div class="product-thumb list-view product-main-categori">
                                <div class="image">
                                    <a href="{{ url('products/' . $product->slug) }}">
                                        <img src="{{ asset(image_resize($product->image, ['width' => 228, 'height' => 228])) }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="d-block">
                                    <div class="img-brand">
                                    @if($product->manufacturer?->logo)
                                        <img src="{{ asset($product->manufacturer?->logo) }}" alt="{{ $product->manufacturer?->name }}" title="{{ $product->manufacturer?->name }}" class="img-fluid" style="width: 100px">
                                    @endif
                                    </div>
                                <h3 class="name-category" style="font-size:13px">
                                    <a href="{{ url('products/' . $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                @unless($product->stock)
                                    <p class="price-product">
                                        <strong class="text-muted">ناموجود</strong>
                                    </p>
                                @else
                                    <div class="price__product mb-2 mt-2">
                                        @if($product->hide_price)
                                        <p>تماس بگیرید</p>
                                        @else
                                            @unless(is_null($product->special))
                                                <div class="col-12 cost text-center ps-0 off-pro ">
                                                  <div class="d-block">
                                                    <span class="old-cost me-2">{{ number_format($product->price) }} <span class="unit">تومان</span>
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
                                                <p>
                                                    <span class="cost-total">{{ number_format($product->special ?? $product->price, 0) }} </span>
                                                    <span class="unit">تومان</span>
                                                </p>
                                            @endunless
                                        @endif
                                    </div>
                                @endunless
                                    <div class="badge-container">
                                        @if($product->is_festival && $site_settings['is_festival_active'])
                                            <p class="badge badge-festival"><span>{{ $site_settings['festival_badge_heading'] }}</span></p>
                                        @else
                                            @unless(is_null($product->special))
                                                <p class="badge badge-off"><span>فروش ویژه</span></p>
                                            @endunless
                                        @endif
                                        @unless(is_null($product->badge))
                                            <p class="badge badge-blue"><span>{{ $product->badge }}</span></p>
                                        @endunless
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
               <div class="row mt-4">
                    <div class="col-12 text-center">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
