@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">شبکه‌های اجتماعی</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.socials.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="youtube" class="col-sm-2 control-label">یوتیوب</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="https://youtube.com/@mahcenter" dir="ltr" value="{{ old('youtube', $settings['youtube']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="col-sm-2 control-label">اینستاگرام</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="https://instagram.com/mahcenter" dir="ltr" value="{{ old('instagram', $settings['instagram']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter" class="col-sm-2 control-label">ایکس (توئیتر)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="https://x.com/mahcenter" dir="ltr" value="{{ old('twitter', $settings['twitter']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="col-sm-2 control-label">فیسبوک</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="https://facebook.com/mahcenter" dir="ltr" value="{{ old('facebook', $settings['facebook']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aparat" class="col-sm-2 control-label">آپارات</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="aparat" name="aparat" placeholder="https://aparat.com/mahcenter" dir="ltr" value="{{ old('aparat', $settings['aparat']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telegram" class="col-sm-2 control-label">تلگرام</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telegram" name="telegram" placeholder="https://t.me/mahcenter" dir="ltr" value="{{ old('telegram', $settings['telegram']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp" class="col-sm-2 control-label">واتس اپ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" dir="ltr" value="{{ old('whatsapp', $settings['whatsapp']) }}">
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
