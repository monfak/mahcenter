@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('در حال بروز رسانی هستیم'))

@section('image')
<div style="background-image: url('/svg/503.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', __($exception->getMessage() ?: 'در حال به روز رسانی مه سنتر هستیم، بزودی برمی‌گردیم.'))
