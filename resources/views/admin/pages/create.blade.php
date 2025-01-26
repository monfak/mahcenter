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
                <h3 class="box-title">افزودن صفحه</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-default btn-sm">لیست صفحات
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
                    <form method="post" action="{{ route('admin.pages.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="tab-content">
                            <div id="tab_general" class="tab-pane active">
                                <div class="form-group">
                                    <label for="heading" class="col-md-2 control-label">عنوان صفحه *</label>
                                    <div class="col-md-10">
                                        <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="col-md-2 control-label">اسلاگ *</label>
                                    <div class="col-md-10">
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" dir="ltr">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-md-2 control-label">توضیحات</label>
                                    <div class="col-md-10">
                                        <textarea name="content" id="content" class="form-control tinymce">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_seo" class="tab-pane">
                                <div class="form-group">
                                    <label for="title" class="col-md-2 control-label">تایتل</label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description" class="col-md-2 control-label">دسکریپشن</label>
                                    <div class="col-md-10">
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter_title" class="col-md-2 control-label">تایتل برای توئیتر</label>
                                    <div class="col-md-10">
                                        <input type="text" name="twitter_title" id="twitter_title" class="form-control" value="{{ old('twitter_title') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter_description" class="col-md-2 control-label">دسکریپشن برای توئیتر</label>
                                    <div class="col-md-10">
                                        <textarea name="twitter_description" id="twitter_description" class="form-control" rows="5">{{ old('twitter_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="og_image" class="col-md-2 control-label">تصویر برای اپن گراف</label>
                                    <div class="col-md-10">
                                        <input type="file" name="og_image" id="og_image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter_image" class="col-md-2 control-label">تصویر برای توئیتر</label>
                                    <div class="col-md-10">
                                        <input type="file" name="twitter_image" id="twitter_image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="canonical" class="col-md-2 control-label">کنونیکال</label>
                                    <div class="col-md-10">
                                        <input type="text" name="canonical" id="canonical" class="form-control" value="{{ old('canonical') }}" dir="ltr">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_nofollow" class="col-md-2 control-label">نوفالو</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" name="is_nofollow" id="is_nofollow" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوفالو" data-off="<i class='fa fa-check'></i> فالو"{{ old('is_nofollow') ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_noindex" class="col-md-2 control-label">نوایندکس</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" name="is_noindex" id="is_noindex" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوایندکس" data-off="<i class='fa fa-check'></i> ایندکس"{{ old('is_noindex') ? ' checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_information" class="tab-pane">
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر</label>
                                    <div class="col-md-10">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-md-2 control-label">وضعیت</label>
                                    <div class="col-md-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="0"{{ (old('status') == 0 ? 'selected' : '') }}>پیش‌نویس</option>
                                            <option value="1"{{ (old('status') == 1 ? 'selected' : '') }}>انتشار</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="افزودن صفحه">
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
