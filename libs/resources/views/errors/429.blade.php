@extends('errors::illustrated-layout')

@section('code', '429')
@section('title', __('درخواست های زیاد'))

@section('image')
<div style="background-image: url('/svg/403.svg');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', __('سیستم شما درخواست های زیادی به سرور ما داده، دسترسی شما رد شد'))
