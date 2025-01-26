@extends('frontend.layouts.app')
@section('title', $site_settings['blog_title'])
@section('description', $site_settings['blog_description'])
@section('content')
@if($blogHeaderBanners->status)
<section class="container-fluid banner-section pt-3 mb-3 pb-3 p-xs-0">
  <div class="container">
    <div class="hero-wrapper">
        @foreach($blogHeaderBanners->items->chunk(2) as $banners)
        <div class="{{ $loop->first ? 'hero-main' : 'hero-side' }}">
            @foreach($banners as $item)
            <div class="hero-box">
                <a href="{{ $item->url }}">
                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}">
                </a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
  </div>
</section>
@endif
<h1 class="headingnone" style="display:none">{{ $site_settings['blog_heading'] }}</h1>
<section class="container-fluid  blog-section pt-5 pb-5 position-relative p-xs-0">
    <div class="container">
        <div class="row">
                  <div class="col-12 p-0">
                     <div class="row align-items-center">
                        <div class="col-md-12 col-12 text-md-center">
                           <h2 class="title-section"> پیشنهاد سردبیر  </h2>
                        </div>
                        <div class="col-md-6 col-12 link-title-section text-end">
                           {{--<a href="">همه آرشیو </a>--}}
                        </div>
                     </div>
                  </div>
               </div>
        <div class="row mt-4">
            <div class="col-12 p-0">
                <div class="owl-carousel owl-theme owl-blog">
                    @foreach($editorSuggestedArticles as $article)
                    <div class="item">
                        <a href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}" class="d-block">
                            <div class="d-block img-blog">
                                <img src="{{ asset(image_resize($article->image, ['width' => 284, 'height' => 180])) }}" class="img-fluid" alt="{{ $article->title }}">
                            </div>
                            <div class="item__txt">
                              <span>{{ $article->title }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div>
                                    <span class="fal fa-calendar ms-1"></span>
                                    <span class="read-time__txt">زمان مورد نیاز برای مطالعه: {{ $article->reading_time }} دقیقه</span>
                                </div>
                                <div class="time-block">
                                    <i class="fal fa-clock"></i>
                                    {{ jdate($article->created_at)->format('d F Y') }}
                               </div>
                            </div>
                        </a>
                    </div>
                    @if($loop->index == 5) @break @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid pt-5 pb-5">
    <div class="container">
        	<div class="row">
		    @foreach($articles as $article)
			<div class="col-lg-3 col-12 mt-3">
			  <div class="card main__last__post">
				<a class="card-body" href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}">
					  @if($article->image)
						<div class="img-news">  
                          <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="img-fluid">
                        </div>
					  @endif
						<h4 class="news-name mt-3">{{ $article->title}}</h4>
						
                        <div class="d-flex justify-content-between mt-1">
                            <div>
                                <span class="fal fa-clock ms-1"></span>
                                <span class="read-time__txt">زمان مورد نیاز برای مطالعه: {{ $article->reading_time }} دقیقه</span>
                            </div>
                            <div class="time-block">
                                <i class="fal fa-clock"></i>
                                {{ jdate($article->created_at)->format('d F Y') }}
                           </div>
                        </div>
					 </a>
               </div>
            </div>
           @endforeach
	    </div>
    <div class="row">
        <div class="col-12 m-3">
            {{$articles->appends(request()->query())->links()}}
        </div>
    </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    var heroSlider = $(".owl-blog");
    var owlCarouselTimeout = 3500;
    $(".owl-blog").owlCarousel({
      autoplay: false,
      //loop: true,
      margin: 20,
      autoplayHoverPause: true,
      smartSpeed: 450,
      dots: false,
      rtl: true,
      navText: [],
      lazyLoad: true,
      responsive: {
        0: {
            nav: false,  
          stagePadding: 20,
          items: 1,
        },
        500: {
            nav: false,  
          items: 2,
        },
        768: {
            nav: false,  
          items: 2,
        },
        1200: {
           
        nav: true,   
          items: 4,
        },
      },
    });
</script>
@endsection