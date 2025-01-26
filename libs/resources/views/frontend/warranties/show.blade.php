@extends('frontend.layouts.app')
@section('title', $warranty->title ?? $warranty->name)
@section('description', $warranty->description)
@section('image', asset($warranty->image))
@section('twitter_title', $warranty->twitter_title ?? $warranty->title ?? $warranty->name)
@section('twitter_description', $warranty->twitter_description ?? $warranty->description)
@section('image', asset($warranty->image))
@section('og_image', asset($warranty->og_image ?? $warranty->image))
@section('twitter_image', asset($warranty->twitter_image ?? $warranty->image))
@section('canonical', $warranty->canonical ?? url()->current())
@section('seo')
@if($warranty->is_noindex && $warranty->is_nofollow)
    <meta name="robots" content="noindex, nofollow">
@elseif($warranty->is_noindex)
    <meta name="robots" content="noindex">
@elseif($warranty->is_nofollow)
    <meta name="robots" content="nofollow">
@endif
@endsection
@section('content')
<div class="container-fluid  content-page">
    <div class="row mt-5">
        <article class="col-12">
            <h1 class="title-page position-relative mb-5 text-center pb-2"><span>{{ $warranty->name }}</span></h1>
            @if($warranty->image)
                <div class="d-block text-center">
                    <img src="{{ asset($warranty->image) }}" alt="{{ $warranty->name }}" class="img-fluid rounded">
                </div>
            @endif
            <div class="mt-4 desc-inner">
                {!! $warranty->content !!}
            </div>
        </article>
    </div>
</div>
@endsection
