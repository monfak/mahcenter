@extends('frontend.layouts.app')

@section('content')

    <div id="main2">
        <div style="padding: 125px;background-color: rgba(249,245,245,0.62)">
            @if(auth()->user())
                <?php
                $basket = $user->orders()->latest()->where('paid', 0)->first();
                $products = $basket->products;
                ?>
            @if($user)
                @if($basket)
                    <ul style="    box-shadow: 0 0 7px;  padding: 20px;line-height: 3.2;">
                        @foreach($products as $product)
                            <li>
                                <img class="img-rounded"
                                     src="{{ asset(\App\ImageManager::getResizeName($product->image, ['height' => 40, 'width' => 40]))}}">
                                <a href="{{ url('products/' . $product->slug) }}">{{$product->name}} </a>
                                <span>{{number_format($product->actual_price)}}&nbsp;  تومان</span> |
                                <span>تعداد : &nbsp;</span><span
                                        class="label label-info">{{$products->find($product->id)->pivot->quantity}}</span>
                            </li>
                            <hr>

                        @endforeach
                        <li class="left">
                            <span>جمع کل  : &nbsp;</span><span
                                    class="label label-success">{{number_format($basket->products()->sum('total_price'))}}</span>
                        </li>
                        <li><a href=""> ادامه </a></li>

                    </ul>
                @else


                @endif

            @endif
            @else
                <h3>شما باید برای خرید وارد سایت شوید .</h3>
            @endif
        </div>
    </div>


@endsection



