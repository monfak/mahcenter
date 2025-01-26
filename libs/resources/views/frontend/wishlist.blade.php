@extends('frontend.layouts.app')
@section('title', 'علاقه‌مندی‌ها')
@section('content')
    <div class="container-fluid slide gap-col-mob my-5">
        <div class="container section1-1 gap-top gap-col-mob">
            @empty(!$products)
                <div class="row ">
                    <div id="content" class="col-sm-12">
                        <h1>علاقه‌مندی‌ها</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td class="text-center">تصویر</td>
                                        <td class="text-right">نام کالا</td>
                                        <td class="text-right">مدل</td>
                                        <td class="text-right">قیمت واحد</td>
                                        <td class="text-right">عملیات</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{ url('products/' . $product->slug) }}">
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="img-thumbnail" style="width:47px;height:47px">
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ url('products/' . $product->slug) }}">{{ $product->name }}</a>
                                            @unless($product->stock)
                                                <div class="text-danger font-12">
                                                    موجودی این محصول به اتمام رسیده است.
                                                </div>
                                            @endunless
                                        </td>
                                        <td class="text-left">{{ $product->model }}</td>
                                        <td class="text-right">{{ number_format($product->special ?? $product->price, 0) }} تومان</td>
                                        <td class="text-center">
                                            <div class="input-group btn-block" style="max-width: 200px;">
                                                @if($product->stock)
                                                <div class="btn-sale ajax-form">
                                                    <input type="hidden" class="productId" value="{{ $product->id }}">
                                                    <input type="hidden" class="quantity" value="1">
                                                    <button type="button" class="add-to-card addToCart form-control">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                </div>
                                                @endif
                                                <form method="post" action="{{ route('wishlist.delete', ['id' => $product->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-del">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4 mb-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div id="content" class="col-sm-12"><h1>علاقه‌مندی‌ها</h1>
                                <p>هیچ کالایی را به علاقه‌مندی‌های خود اضافه نکرده‌اید.</p>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <a href="{{ route('home') }}" class="btn btn-primary">ادامه</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </div>
@endsection
