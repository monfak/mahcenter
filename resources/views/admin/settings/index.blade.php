@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="/dashboard/dist/css/persian-datepicker-0.4.5.min.css">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/persian-date-0.1.8.min.js"></script>
    <script src="/dashboard/dist/js/persian-datepicker-0.4.5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#special_started_at_datepicker').persianDatepicker({
                initialValue: true,
                initialValueType: 'persian',
                altField: '#special_started_at',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    showMeridian: true,
                    timeFormat: 'HH:mm:ss',
                    enabled: true
                },
            });
            $('#special_ended_at_datepicker').persianDatepicker({
                initialValue: true,
                initialValueType: 'persian',
                altField: '#special_ended_at',
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
                <h3 class="box-title">تنظیمات عمومی</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">نام سایت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="مه سنتر" value="{{ old('name', $settings['name']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slang" class="col-sm-2 control-label">شعار سایت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slang" name="slang" value="{{ old('slang', $settings['slang']) }}">
                            <small class="text-muted">این مورد در تایتل ادغام می‌گردد، لطفا دیگر از این مورد استفاده نکنید! در آینده حذف می‌گردد.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="copyright" class="col-sm-2 control-label">متن کپی رایت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="copyright" name="copyright" value="{{ old('copyright', $settings['copyright']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">آدرس فروشگاه</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $settings['address']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel" class="col-sm-2 control-label">تلفن</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tel" name="tel" dir="ltr" value="{{ old('tel', $settings['tel']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel-2" class="col-sm-2 control-label">تلفن دوم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tel-2" name="tel-2" dir="ltr" value="{{ old('tel-2', $settings['tel-2']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">موبایل</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mobile" name="mobile" dir="ltr" value="{{ old('mobile', $settings['mobile']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">ایمیل</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" dir="ltr" value="{{ old('email', $settings['email']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="response-time" class="col-sm-2 control-label">ساعت پاسخگویی</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="response-time" name="response-time" dir="ltr" rows="5">{!! old('response-time', $settings['response-time']) !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="special_started_at" class="col-md-2 control-label">تاریخ شروع قیمت ویژه</label>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="special_started_at_datepicker" name="special_started_at_datepicker" class="form-control pull-right" value="{{ date('Y-m-d H:i', old('special_started_at',  $settings['special_started_at'])) }}">
                                <input type="hidden" id="special_started_at" name="special_started_at" class="form-control pull-right" value="{{ old('special_started_at', $settings['special_started_at']) }}">
                            </div>
                        </div>
                        <label for="special_ended_at" class="col-md-2 control-label">تاریخ پایان قیمت ویژه</label>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="special_ended_at_datepicker" name="special_ended_at_datepicker" class="form-control pull-right" value="{{ date('Y-m-d H:i', old('special_ended_at', $settings['special_ended_at'])) }}">
                                <input type="hidden" id="special_ended_at" name="special_ended_at" class="form-control pull-right" value="{{ old('special_ended_at', $settings['special_ended_at']) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="footer_heading" class="col-sm-2 control-label">عنوان معرفی فوتر</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="footer_heading" name="footer_heading" placeholder="مه سنتر" value="{{ old('footer_heading', $settings['footer_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="footer_content" class="col-sm-2 control-label">متن معرفی فوتر</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="footer_content" name="footer_content" rows="5">{{ old('footer_content', $settings['footer_content']) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="app_bazaar" class="col-sm-2 control-label">لینک اپلیکیشن کافه بازار</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="app_bazaar" name="app_bazaar" dir="ltr" value="{{ old('app_bazaar', $settings['app_bazaar']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="app_store" class="col-sm-2 control-label">لینک اپلیکیشن اپ استور</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="app_store" name="app_store" dir="ltr" value="{{ old('app_store', $settings['app_store']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="scripts" class="col-sm-2 control-label">اسکریپت‌های عمومی</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="scripts" name="scripts" dir="ltr" rows="5">{{ old('scripts', $settings['scripts']) }}</textarea>
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
