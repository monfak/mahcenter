@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش تولیدکننده {{ $manufacturer->name }}</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.manufacturers.index') }}" class="btn btn-default btn-sm">لیست تولیدکننده‌ها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="nav-tabs-custom no-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_general" data-toggle="tab" aria-expanded="true">عمومی</a>
                        </li>
                        <li>
                            <a href="#tab_seo" data-toggle="tab" aria-expanded="false">سئو</a>
                        </li>
                        <li>
                            <a href="#tab_information" data-toggle="tab" aria-expanded="false">اطلاعات</a>
                        </li>
                    </ul>
                    <form method="post" action="{{ route('admin.manufacturers.update', $manufacturer->id) }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <div class="tab-content">
                            <div id="tab_general" class="tab-pane active">
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">نام *</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $manufacturer->name) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="col-md-2 control-label">اسلاگ *</label>
                                    <div class="col-md-10">
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $manufacturer->slug) }}" dir="ltr">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-2 control-label">توضیحات</label>
                                    <div class="col-md-10">
                                        <textarea name="description" id="description" class="form-control tinymce">{{ old('description', $manufacturer->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_seo" class="tab-pane">
                                <div class="form-group">
                                    <label for="title" class="col-md-2 control-label">تایتل</label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $manufacturer->title) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description" class="col-md-2 control-label">دسکریپشن</label>
                                    <div class="col-md-10">
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description', $manufacturer->meta_description) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="twitter_title" class="col-md-2 control-label">تایتل برای توئیتر</label>
                                        <div class="col-md-10">
                                            <input type="text" name="twitter_title" id="twitter_title" class="form-control" value="{{ old('twitter_title', $manufacturer->twitter_title) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_description" class="col-md-2 control-label">دسکریپشن برای توئیتر</label>
                                        <div class="col-md-10">
                                            <textarea name="twitter_description" id="twitter_description" class="form-control" rows="5">{{ old('twitter_description', $manufacturer->twitter_description) }}</textarea>
                                        </div>
                                    </div>
                                    @if($manufacturer->og_image)
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($manufacturer->og_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $manufacturer->name }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-2 control-label">تصویر برای اپن گراف</label>
                                        <div class="col-md-10">
                                            <input type="file" name="og_image" id="og_image" class="form-control">
                                        </div>
                                    </div>
                                    @if($manufacturer->twitter_image)
                                    <div class="form-group">
                                        <label for="twitter_image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($manufacturer->twitter_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $manufacturer->name }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="twitter_image" class="col-md-2 control-label">تصویر برای توئیتر</label>
                                        <div class="col-md-10">
                                            <input type="file" name="twitter_image" id="twitter_image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="canonical" class="col-md-2 control-label">کنونیکال</label>
                                        <div class="col-md-10">
                                            <input type="text" name="canonical" id="canonical" class="form-control" value="{{ old('canonical', $manufacturer->canonical) }}" dir="ltr">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_nofollow" class="col-md-2 control-label mt-2">نوفالو</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" name="is_nofollow" id="is_nofollow" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوفالو" data-off="<i class='fa fa-check'></i> فالو"{{ old('is_nofollow', $manufacturer->is_nofollow) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_noindex" class="col-md-2 control-label mt-2">نوایندکس</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" name="is_noindex" id="is_noindex" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوایندکس" data-off="<i class='fa fa-check'></i> ایندکس"{{ old('is_noindex', $manufacturer->is_noindex) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                            </div>
                            <div id="tab_information" class="tab-pane">
                                <div class="form-group">
                                    <label for="sort_order" class="col-md-2 control-label">ترتیب</label>
                                    <div class="col-md-10">
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $manufacturer->sort_order) }}" min="0" max="999">
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if($manufacturer->logo)
                                        <label class="col-md-2 control-label">لوگو</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($manufacturer->logo, ['width' => 125, 'height' => 125])) }}" alt="{{ $manufacturer->name }}" class="image-thumbnail">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="logo" class="col-md-2 control-label">{{ ($manufacturer->logo ? 'تغییر لوگو' : 'انتخاب لوگو') }}</label>
                                    <div class="col-md-10">
                                        <input type="file" name="logo" id="logo" value="{{ old('logo') }}" class="form-control">
                                    </div>
                                </div>
                                @unless(is_null($manufacturer->logo))
                                <div class="form-group">
                                    <label for="remove_logo" class="col-md-2 control-label">حذف لوگو</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" id="remove_logo" name="remove_logo">
                                    </div>
                                </div>
                                @endunless
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="ذخیره تغییرات">
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection