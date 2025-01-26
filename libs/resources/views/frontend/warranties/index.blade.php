@extends('frontend.layouts.app')
@section('title', 'گارانتی‌های لوازم خانگی')
@section('styles')
<style>
    img {
        width: 100px;
        height: 100px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid content-page mt-5">
    <h1 class="title-page position-relative mb-5 text-center pb-2"><span>گارانتی‌های لوازم خانگی</span></h1>
    <div class="row mt-5">
        @foreach($warranties as $warranty)
        <article class="col-md-2">
            @if($warranty->logo)
                <div class="d-block text-center">
                    <a href="{{ route('frontend.warranties.show', $warranty->slug) }}"><img src="{{ asset($warranty->logo) }}" alt="{{ $warranty->name }}" class="img-fluid rounded"></a>
                    <h3 class="position-relative mb-5 py-2"><a href="{{ route('frontend.warranties.show', $warranty->slug) }}">{{ $warranty->name }}</a></h3>
                </div>
            @endif
        </article>
        @endforeach
    </div>
</div>
@endsection
