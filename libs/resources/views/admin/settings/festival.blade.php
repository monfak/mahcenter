@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/dashboard/dist/css/persian-datepicker-0.4.5.min.css">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script src="/dashboard/dist/js/persian-date-0.1.8.min.js"></script>
    <script src="/dashboard/dist/js/persian-datepicker-0.4.5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#festival_ended_at_datepicker').persianDatepicker({
                initialValue: true,
                initialValueType: 'persian',
                altField: '#festival_ended_at',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    showMeridian: true,
                    timeFormat: 'HH:mm:ss',
                    enabled: true
                },
            });
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">تنظیمات جشنواره</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.festival.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="festival_heading" class="col-sm-2 control-label">عنوان جشنواره</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="festival_heading" name="festival_heading" value="{{ old('festival_heading', $settings['festival_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="festival_title" class="col-sm-2 control-label">تایتل جشنواره</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="festival_title" name="festival_title" value="{{ old('festival_title', $settings['festival_title']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="festival_badge_heading" class="col-sm-2 control-label">عنوان بج جشنواره</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="festival_badge_heading" name="festival_badge_heading" value="{{ old('festival_badge_heading', $settings['festival_badge_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="festival_color" class="col-sm-2 control-label">رنگ جشنواره</label>
                        <div class="col-sm-4">
                            <input type="color" class="form-control" id="festival_color" name="festival_color" value="{{ old('festival_color', $settings['festival_color']) }}">
                        </div>
                        <label for="festival_complementary_color" class="col-sm-2 control-label">رنگ مکمل جشنواره</label>
                        <div class="col-sm-4">
                            <input type="color" class="form-control" id="festival_complementary_color" name="festival_complementary_color" value="{{ old('festival_complementary_color', $settings['festival_complementary_color']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="festival_ended_at" class="col-md-2 control-label">زمان پایان جشنواره</label>
                        <div class="col-md-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="festival_ended_at_datepicker" name="special_started_at_datepicker" class="form-control pull-right" value="{{ date('Y-m-d H:i', old('festival_ended_at',  $settings['festival_ended_at'])) }}">
                                <input type="hidden" id="festival_ended_at" name="festival_ended_at" class="form-control pull-right" value="{{ old('festival_ended_at', $settings['festival_ended_at']) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @if($settings['festival_home_image'])
                            <label class="col-md-2 control-label">تصویر جشنواره در صفحه اصلی</label>
                            <div class="col-md-10">
                                <img src="{{ asset(image_resize($settings['festival_home_image'], ['width' => 60, 'height' => 60])) }}" alt="تصویر جشنواره در صفحه اصلی" class="image-thumbnail">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="festival_home_image" class="col-md-2 control-label">تصویر جشنواره در صفحه اصلی</label>
                        <div class="col-md-10">
                            <input type="file" name="festival_home_image" id="festival_home_image" value="{{ old('festival_home_image') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        @if($settings['festival_home_title_image'])
                            <label class="col-md-2 control-label">عکس عنوان جشنواره در صفحه اصلی</label>
                            <div class="col-md-10">
                                <img src="{{ asset(image_resize($settings['festival_home_title_image'], ['width' => 60, 'height' => 60])) }}" alt="عکس عنوان جشنواره در صفحه اصلی" class="image-thumbnail">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="festival_home_title_image" class="col-md-2 control-label">عکس عنوان جشنواره در صفحه اصلی</label>
                        <div class="col-md-10">
                            <input type="file" name="festival_home_title_image" id="festival_home_title_image" value="{{ old('festival_home_title_image') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_festival_active" class="col-md-2 control-label">وضعیت جشنواره</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="is_festival_active" id="is_festival_active" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close'></i> غیرفعال"{{ old('is_festival_active', $settings['is_festival_active']) ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deactive_festival_automatically" class="col-md-2 control-label">غیرفعال کردن جشنواره</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="deactive_festival_automatically" id="deactive_festival_automatically" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> اتوماتیک" data-off="<i class='fa fa-close'></i> دستی"{{ old('deactive_festival_automatically', $settings['deactive_festival_automatically']) ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_festival_box" class="col-md-2 control-label">نمایش باکس در صفحه اصلی</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="show_festival_box" id="show_festival_box" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> جشنواره" data-off="<i class='fa fa-close'></i> عادی"{{ old('show_festival_box', $settings['show_festival_box']) ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
