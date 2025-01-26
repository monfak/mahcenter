@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            (function($, undefined) {
                "use strict";
                // When ready.
                $(function() {
                    var $priceMask      = $("#price_mask");
                    var $price          = $("#price");
    
                    $priceMask.on("keyup", function(event) {
                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }
    
                        // When the arrow keys are pressed, abort.
                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }
    
                        var $this = $(this);
    
                        // Get the value.
                        var input = $this.val();
    
                        var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;
    
                        $this.val(function() {
                            return ( input === 0 ) ? "0" : input.toLocaleString( "en-US" );
                        });
    
                        var withoutCommas = $priceMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $price.val(withoutCommas);
                    });
                });
            })(jQuery);
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن گارانتی</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.warranties.index') }}" class="btn btn-default btn-sm">لیست گارانتی‌ها
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
                    <form method="post" action="{{ route('admin.warranties.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="tab-content">
                            <div id="tab_general" class="tab-pane active">
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">نام</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
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
                                    <label for="description" class="col-md-2 control-label">دسکریپشن</label>
                                    <div class="col-md-10">
                                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
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
                                    <label for="logo" class="col-md-2 control-label">لوگو</label>
                                    <div class="col-md-10">
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="col-md-2 control-label">قیمت *</label>
                                    <div class="col-md-10">
                                        <input type="text" id="price_mask" name="price_mask" class="form-control mask" value="{{ old('price_mask') }}" required>
                                        <input type="hidden" name="price" id="price" class="price" value="{{ old('price') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="show_in_home" class="col-md-2 control-label">نمایش در صفحه اصلی</label>
                                    <div class="col-md-10">
                                        <select name="show_in_home" id="show_in_home" class="form-control">
                                            <option value="0"{{ (old('show_in_home') == 0 ? 'selected' : '') }}>غیرفعال</option>
                                            <option value="1"{{ (old('show_in_home') == 1 ? 'selected' : '') }}>فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_active" class="col-md-2 control-label">وضعیت</label>
                                    <div class="col-md-10">
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option value="0"{{ (old('is_active') == 0 ? 'selected' : '') }}>غیرفعال</option>
                                            <option value="1"{{ (old('is_active') == 1 ? 'selected' : '') }}>فعال</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="افزودن گارانتی">
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
