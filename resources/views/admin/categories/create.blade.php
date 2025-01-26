@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/dashboard/plugins/select2/select2.min.css">
    <style>
        .select2-selection__choice {
            color: #666 !important;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-search__field {
            width: 100% !important;
        }
    </style>
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#filters').select2({
                placeholder : 'گروه فیلترها انتخاب کنید',
            });
            $('#attributes').select2({
                placeholder : 'گروه خصوصیات انتخاب کنید',
            });
            $('#manufacturers').select2({
                placeholder : 'تولیدکننده‌ها را انتخاب کنید',
            });
            $('#parent_id').select2({
                placeholder : 'دسته‌بندی والد را انتخاب کنید',
            });
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن دسته‌بندی</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-sm">لیست دسته‌بندی‌ها
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
                        <li>
                            <a href="#tab_links" data-toggle="tab" aria-expanded="false">لینک‌ها</a>
                        </li>
                    </ul>
                    <form method="post" action="{{ route('admin.categories.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="tab-content">
                            <div id="tab_general" class="tab-pane active">
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">نام دسته‌بندی *</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-md-2 control-label">لیبل</label>
                                    <div class="col-md-10">
                                        <input type="text" name="label" id="label" class="form-control" value="{{ old('label') }}">
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
                                    <label for="parent_id" class="col-md-2 control-label">دسته‌بندی والد</label>
                                    <div class="col-md-10">
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">فاقد والد</option>
                                            @foreach($parents as $id => $name)
                                                <option value="{{ $id }}"{{ (old('parent_id') == $id ? 'selected' : '') }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sort_order" class="col-md-2 control-label">ترتیب</label>
                                    <div class="col-md-10">
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order') }}" min="0" max="999">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icon" class="col-md-2 control-label">آیکن</label>
                                    <div class="col-md-10">
                                        <input type="file" name="icon" id="icon" value="{{ old('icon') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر</label>
                                    <div class="col-md-10">
                                        <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="show" class="col-md-2 control-label">نمایش در صفحه اصلی</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" id="show" name="show" value="1" {{old('show')==1?'checked' : ''}}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="has_slider" class="col-md-2 control-label">دارای اسلایدر</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" name="has_slider" id="has_slider" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال" data-width="100"{{ old('has_slider') ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_in_menu" class="col-md-2 control-label">نمایش در منو</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال" data-width="100"{{ old('show_in_menu') ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-md-2 control-label">وضعیت</label>
                                    <div class="col-md-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="0"{{ old('status') == 0 ? 'selected' : '' }}>پیش‌نویس</option>
                                            <option value="1"{{ old('status') == 1 ? 'selected' : '' }}>انتشار</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="size_type" class="col-md-2 control-label">سایز کالاها</label>
                                    <div class="col-md-10">
                                        <select name="size_type" id="size_type" class="form-control">
                                            <option value="">انتخاب نوع سایز</option>
                                            <option value="0"{{ old('size_type') === 0 ? 'selected' : '' }}>کالاهای درشت</option>
                                            <option value="1"{{ old('size_type') === 1 ? 'selected' : '' }}>کالاهای خورده-ریز</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_links" class="tab-pane">
                                <div class="form-group">
                                    <label for="filters" class="col-md-2">گروه فیلترها</label>
                                    <div class="col-md-8">
                                        <select name="filter_id[]" id="filters" class="form-control" multiple="multiple">
                                            @foreach($filters as $key => $filter)
                                                <option value="{{ $key }}"{{ (in_array($key, old('filter_id') ?? []) ? ' selected' : '') }}>{{ $filter }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="attributes" class="col-md-2">گروه ویژگی‌ها</label>
                                    <div class="col-md-8">
                                        <select name="attribute_id[]" id="attributes" class="form-control" multiple="multiple">
                                            @foreach($attributes as $key => $attribute)
                                                <option value="{{ $key }}"{{ (in_array($key, old('attribute_id') ?? []) ? ' selected' : '') }}>{{ $attribute }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="manufacturers" class="col-md-2">تولیدکننده‌ها</label>
                                    <div class="col-md-8">
                                        <select name="manufacturer_id[]" id="manufacturers" class="form-control" multiple="multiple">
                                            @foreach($manufacturers as $key => $manufacturer)
                                                <option value="{{ $key }}"{{ (in_array($key, old('manufacturer_id') ?? []) ? ' selected' : '') }}>{{ $manufacturer }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="افزودن دسته‌بندی">
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
