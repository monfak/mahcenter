<?php
$user = auth()->user();
$basket = $user->orders()->latest()->where('paid', 0)->first();
$products=$basket->products;
?>
@if($user)
    @if($basket)
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="k1">
                                <span class="number1">  سبد خرید </span>
                                <span class="num-b"> {{$basket->products()->sum('quantity')}} </span>
                                <i class="fa fa-shopping-cart"></i>
                            </span>

        </button>
        <ul class="dropdown-menu">
            @foreach($products as $product)
            <li>
                <img class="img-rounded" src="{{ asset(\App\ImageManager::getResizeName($product->image, ['height' => 40, 'width' => 40]))}}">
                <a href="{{ url('products/' . $product->slug) }}">{{$product->name}} </a>
                <span>{{number_format($product->actual_price)}}&nbsp;  تومان</span> |
                <span>تعداد : &nbsp;</span><span class="label label-info">{{$products->find($product->id)->pivot->quantity}}</span>
            </li>
                <hr>

                @endforeach
                <li class="left">
                   <span>جمع کل  : &nbsp;</span><span class="label label-success">{{number_format($basket->products()->sum('total_price'))}}</span>
                </li>
                <li><a href="{{route('orders.basket')}}"> سبد خرید </a></li>

        </ul>
        @else
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="k1">
                                <span class="number1">  سبد خرید </span>
                                <span class="num-b"> 0 </span>
                                <i class="fa fa-shopping-cart"></i>
                            </span>

        </button>
        <ul class="dropdown-menu">
            <li>سبد شما خالیست .</li>
        </ul>
    @endif
@endif