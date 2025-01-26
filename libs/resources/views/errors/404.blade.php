@extends('frontend.layouts.app')
@section('title', 'صفحه مورد نظر یافت نشد')
@section('content')
<div class="flex-container my-5">
    <div>
        <img src="{{ asset('images/404.png') }}" class="img-fluid" alt="404">
    </div>
</div>
<div class="text-center pt-4 mt-lg-2 mb-5">
    <h1 class="display-5">صفحه مورد نظر یافت نشد</h1>
    <p class="fs-lg pb-2 pb-md-0 mb-4 mb-md-5">
        صفحه‌ای که به دنبال آن هستید یا منتقل شده، یا حذف شده یا وجود نداشته، برای کسب اطلاعات بیشتر، با ما
        <a href="https://mahcenter.com/page/contact" class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg" style="display:inline-block">
            تماس
        </a>
        بگیرید. یا از منوی بالا بخشی از نام محصول خود را جستجو کنید.
    </p>
    <a class="btn btn-lg btn-primary" href="{{ route('home') }}">بازگشت به صفحه اصلی</a>
</div>
@endsection