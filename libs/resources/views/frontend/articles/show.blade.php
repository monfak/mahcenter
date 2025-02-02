@extends('frontend.layouts.app')
@section('title', $article->meta_title ?? $article->title)
@section('twitter_title', $article->twitter_title ?? $article->meta_title ?? $article->title)
@section('description', $article->meta_description)
@section('twitter_description', $article->twitter_description ?? $article->meta_description)
@section('image', asset($article->image))
@section('og_image', asset($article->og_image ?? $article->image))
@section('twitter_image', asset($article->twitter_image ?? $article->image))
@section('canonical', $article->canonical ?? url()->current())
@section('seo')
@if($article->is_noindex && $article->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($article->is_noindex)
    <meta name="robots" content="noindex">
@elseif($article->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('styles')
<style>
    ul li{
        list-style-type: none!important;
    }
    body {
        font-weight: 300;
    }
</style>
@endsection
@section('content')
<div class="container-fluid  gap-col-mob content-page pb-4">
    <div class="row">
        <div class="breadcrumb col-12 gap-col gap-col-mob mt-4 p-0">
            <ul class="breadcrumbs m-0 w-100 bg-white border rounded p-2">
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/') }}">صفحه اصلی</a></li>
                <li class="float-left">/</li>
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ url('/blog') }}">مقالات </a></li>
                <li class="float-left">/</li>
                <li class="float-left"><a class="link text-dark p-2" itemprop="item" href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}">{{$article->title}} </a></li>
            </ul>
          </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container p-xs-0">
      <div class="row">
        @if(count($article->relates) OR count($article->products))
        <div class="col-lg-9 col-md-8 col-12 ps-md-0 p-xs-0">
        @else
        <div class="col-lg-12 col-md-12 col-12 ps-md-0 p-xs-0">
        @endif
         <div class="row ">
           <article class="col-12 p-0">
                <h1 class="title-section">{{ $article->title }}</h1>
                <div class="row mt-3 mb-4">
                    <div class="col-md-6 col-12 ps-md-0 time-article">
                        <time >
                            <span class="fal fa-calendar ms-1"></span>
                            {{ jdate($article->created_at)->format('d F Y | H:i') }}                             
                        </time>
                    </div>
                    <div class="col-md-6 col-12 pe-md-0 text-md-end read-time-txt">
                        <span class="fal fa-clock ms-1"></span>
                        <span class="read-time__txt">زمان مورد نیاز برای مطالعه: {{ $article->reading_time }} دقیقه</span>
                    </div>
                </div>
                <div class="d-block">
                    <hr>
                </div>
                {{--<div class="d-block mt-3 mb-4 link-sample-pro text-center">
                    <a href="#sample-pro">نمونه محصول مرتبط</a>
                </div>--}}
                @if($article->image)
                  <div class="d-block text-center mt-2 mb-2">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="img-fluid rounded img-first">
                  </div>
                @endif
                <div class="mt-4">
                    {!! $article->content !!}
                </div>
            </article>
        </div>
        @if(count($article->faqs))
        <div class="d-block">
            <hr>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <h5 class="text-center"><span class="fa fa-question-circle"></span> سوالات متداول</h5>
            </div>
            <div class="col-12 p-0 mt-3">
                <div class="row accordion" id="accordionFaq">
                    @foreach($article->faqs as $faq)
                        <div class="col-12 mb-3">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading{{ $loop->iteration }}">
                                    <button class="accordion-button {{ $loop->first ? '' : ' collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->iteration }}">{{ $faq->heading }}</button>
                                </h3>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : ' ' }}" aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>{!! $faq->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="d-block">
            <hr>
        </div>
        @if(auth()->check() && auth()->id() === 2)
        <div class="row" id="comment-form-box">
            <div class="col-12 p-0 mb-4">
               <div class="card crd-comment">
                    <div class="card-body">
                        @include('frontend.layouts.partials.input-errors')
                        <form id="comment-form" method="post" action="{{ route('frontend.comments.store', $article->slug) }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="name">نام *</label>
                                    <input class="form-control" id="name" name="name" type="text" required="" value="{{ old('name', $authUser->name ?? '') }}"{{ auth()->check() && auth()->user()->name ? ' readonly' : '' }}>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input class="form-control" id="email" name="email" type="email" dir="ltr" required="" value="{{ old('email', $authUser->email ?? '') }}"{{ auth()->check() && auth()->user()->email ? ' readonly' : '' }}>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                  <label for="comment">نظر *</label>
                                  <textarea placeholder="نظر باید حداقل ۵ کاراکتر داشته باشد" class="form-control" rows="5" id="comment" name="content" required="">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-2 ">
                                <div class="col-12">
                                  <button type="submit" class="btn btn-primary btn-sm">ثبت نظر</button>
                                </div>
                            </div>
                        </form>
                    </div>
               </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 p-0">
                <ul class="comment-list ps-0">
                    @foreach($article->comments as $comment)
                    <li>
                        <div class="card crd-list-comment">
                            <div class="card-body">
                                <div class="comment-block">
                                    <div class="comment-author">
                                          <h6>{{ $comment->name }}</h6>
                                          {{--<p class="reply-to"> پاسخ به هادی</p>--}}
                                    </div>
                                    <div class="comment-text-child mt-2">
                                        {!! nl2br(strip_tags($comment->content)) !!}
                                    </div>
                                </div>
                                <div class="row mt-2 align-items-center">
                                    <div class="col-6 ps-0">
                                        {{--<a href="#comment-form-box" class="replay-comment">
                                            پاسخ به این نظر 
                                        </a>--}}
                                    </div>
                                    <div class="col-6 pe-0 text-end comment-date">
                                        {{ jdate($comment->created_at)->ago() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        </div>
        @if(count($article->relates) OR count($article->products))
        <div class="col-lg-3 col-md-4 col-12 pe-md-0 sticky_column p-xs-0 mt-xs-15">
            @if(count($article->relates))
            <div class="row">
                <div class="col-12 p-0 mb-3">
                    <div class="card crd-left">
                        <div class="d-block mb-3">
                            <h4 class="title-section">مطالب مرتبط</h4>
                        </div>
                        <ul class="ps-0 list-article">
                            @foreach($article->relates as $relate)
                            <li>
                                <a href="{{ route($relate->id > 147 ? 'frontend.blog.show' : 'articles.show', $relate->slug) }}">
                                    <div class="img-small-blog">
                                        <img src="{{ asset(image_resize($relate->image, ['width' => 284, 'height' => 180])) }}" alt="{{ $relate->title }}">  
                                    </div>
                                    <div class="title-small-blog">{{ $relate->title }}</div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @if(count($article->products))
            <div class="row">
                <div class="col-12 p-0 mb-3">
                    <div class="card crd-left">
                        <div class="d-block mb-3">
                            <h4 class="title-section">محصولات مرتبط </h4>
                        </div>
                        <ul class="ps-0 list-article">
                            @foreach($article->products as $product)
                            <li>
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <div class="img-small-blog">
                                      <img src="{{ asset(image_resize($product->image, ['width' => 60, 'height' => 60])) }}" alt="{{ $product->alt }}">  
                                    </div>
                                     <div class="title-small-blog">
                                        <div class="d-block pro-name">{{ $product->name }}</div> 
                                        <div class="d-flex flex-price">
                                            @if($product->discount)
                                            <div class="">
                                                <span class="offer">
                                                  <span class="off">{{ $product->discount }}%</span>
                                                </span>
                                            </div>
                                            @endif
                                            <div class="">
                                                @if($product->special)
                                                <div>
                                                    <span class="old-cost me-2">
                                                        {{ number_format($product->price) }}
                                                        <span class="unit">تومان</span>
                                                    </span>
                                                </div>
                                                @endif
                                                <div>
                                                     <span class="cost-total">{{ number_format($product->special ?? $product->price) }}</span>
                                                    <span class="unit">تومان</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
           </div>
           @endif
        </div>
        @endif
     </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/theia-sticky-sidebar.js"></script>
<script>
    function sticky_sidebar() {
        $('.sticky_column')
            .theiaStickySidebar({
                additionalMarginTop: 100
            });
    }
    jQuery(document).ready(function () {
        sticky_sidebar()
    });
</script>
@endsection
