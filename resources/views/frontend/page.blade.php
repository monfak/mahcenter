@extends('frontend.layouts.app')
@section('title', $page->title ?? $page->heading)
@section('description', $page->meta_description)
@section('image', asset($page->image))
@section('twitter_title', $page->twitter_title ?? $page->title ?? $page->name)
@section('twitter_description', $page->twitter_description ?? $page->meta_description)
@section('image', asset($page->image))
@section('og_image', asset($page->og_image ?? $page->image))
@section('twitter_image', asset($page->twitter_image ?? $page->image))
@section('canonical', $page->canonical ?? url()->current())
@section('seo')
@if($page->is_noindex && $page->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($page->is_noindex)
    <meta name="robots" content="noindex">
@elseif($page->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('content')
<div class="container-fluid content-page">
     <div class="row mt-5">
         <div class="col-12">
              <article class="col-12">
                  <h1 class="title-page position-relative mb-5 text-center pb-2"><span>{{ $page->title }}</span></h1>
                @if($page->image)
                    <div class="d-block text-center">
                        <img src="{{ asset($page->image) }}" alt="{{ $page->title }}" class="img-fluid rounded">
                    </div>
                @endif
                <div class="mt-4 desc-inner">
                    {!! $page->content !!}
                </div>
            </article>
         </div>
     </div>
</div>
@if($page->slug == 'contact')
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.7932979243924!2d51.437453999999995!3d35.682091299999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e03eb5765f8e9%3A0xb0edfa6018a6fbbd!2z2YHYsdmI2LTar9in2Ycg2KfbjNmG2KrYsdmG2KrbjCDZhdmO2Ycg2LPZhtiq2LE!5e0!3m2!1sen!2s!4v1737236093289!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endif
@endsection
