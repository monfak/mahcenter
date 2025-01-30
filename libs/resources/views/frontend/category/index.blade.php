@extends('frontend.layouts.app')
@section('title', $category->title)
@section('description', $category->meta_description)
@section('image', asset($category->image))
@section('twitter_title', $category->twitter_title ?? $category->title ?? $category->name)
@section('twitter_description', $category->twitter_description ?? $category->meta_description)
@section('image', asset($category->image))
@section('og_image', asset($category->og_image ?? $category->image))
@section('twitter_image', asset($category->twitter_image ?? $category->image))
@section('canonical', $category->canonical ?? url()->current())
@section('seo')
@if($category->is_noindex && $category->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($category->is_noindex)
    <meta name="robots" content="noindex">
@elseif($category->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('scripts')
<script>
$(document).ready(function() {
	$('.owl-related').owlCarousel({
		rtl:true,
		autoplay:true,
		autoplayTimeout:5000,
		smartSpeed:3000,
		lazyLoad: true,
		loop: true,
		nav: false,
		dots:true,
		margin: 0,
		items: 1,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			500: {
				items: 2
			},
			600: {
				items: 3
			},
			1000: {
				items: 4
			}
		}

	})
});
</script>
@endsection
@section('content')
<div class="content-body question-01">
    <div class="container py-5">
         <h1 class="title-page position-relative text-center mb-4 pb-2">{{$category->name}}</h1>
	    <div class="main-data">
	        @if($category->children->count() && $category->parent_id == null)
    	        <div class="row all-category">
    	            @foreach($category->children as $child)
    	                 <div class="col-lg-3 col-md-4 col-sm-6 p-2">
    	                     <a class="bg-white Bx-03" href="{{ route('category.show', $child->slug) }}">
    	                         <div class="Bx-03-img">
    	                              <img class="pc-categr mw-100 rounded" src="{{ asset($child->image) }}" alt="{{ $child->name }}" />
    	                         </div>
    	                               <div class="text-center text-category mt-3 mb-3">{{ $child->name }}
    	                         </div>
        	                  </a>
    	                 </div>
    	            @endforeach
    	        </div>
	        @endif
	       <div class="row">
	           <div class="col-12">
	                <div class="some-descrip my-3 text-justify">
	                {!! $category->content !!}
	                </div>
	           </div>
	       </div>

	       <div class="row">
	           <div class="col-12">
	                <div class="P-Relatepro my-3">
	                    <h3 class="title-page position-relative text-center mb-5 pb-3">پرفروش ترین محصولات</h3>
        	            <div class="owl-carousel owl-theme owl-related">
                        	@foreach($products as $product)
                            	<div class="item">
                                    <div class="item-img">
                                        <div class="row">
                                            <div class="col-12 p-0 pt-3 text-center">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                   class="img-pro-wnd" target="_blank">
                                                  <img class="img-fluid" alt="{{ $product->name }}" src="{{ asset(image_resize($product->image , ['width' => 233, 'height' => 220])) }}" >
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 text-left pro-name">
                                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2 align-items-end">
                                        <div class="col-12 cost text-right pr-3">
                                            @if($product->special)
                                            <span class="old-cost">{{ number_format($product->price) }}</span>
                                            <span class="offer-mob"><span class="off">% {{ $product->discount }}</span></span>
                                            <br>
                                            @endif
                                            <span class="cost-total">{{ number_format($product->special ?? $product->price) }}</span>
                                            <span class="unit">تومان</span>
                                        </div>
                                    </div>
                                </div>
        	                @endforeach
        	            </div>
	                </div>
	           </div>
	       </div>

	    </div>
	</div>
</div>
@endsection
