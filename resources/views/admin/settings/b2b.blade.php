@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">تنظیمات فروش عمده</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{--<form method="POST" id="form" action="{{ route('admin.settings.b2b.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="nav-tabs-custom" style="box-shadow: unset">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">تنظیمات عمومی</a></li>
                            <li class=""><a href="#socials" data-toggle="tab" aria-expanded="false">شبکه‌های اجتماعی</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">نام سایت</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="مه سنتر" value="{{ old('name', $settings['name']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">تایتل سایت</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="مه سنتر | فروشگاه لوازم خانگی با قیمت مناسب" value="{{ old('title', $settings['title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords" class="col-sm-2 control-label">کلمات کلیدی</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="5" placeholder="با دش و بدون اسپیس جدا کنید">{{ old('meta_keywords', $settings['meta_keywords']) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">متا دسکریپشن</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $settings['description']) }}</textarea>
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
                                    <label for="fax" class="col-sm-2 control-label">فکس</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="fax" name="fax" dir="ltr" value="{{ old('fax', $settings['fax']) }}">
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
                                    <label for="footer_heading" class="col-sm-2 control-label">عنوان معرفی فوتر</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="footer_heading" name="footer_heading" placeholder="مه سنتر" value="{{ old('footer_heading', $settings['footer_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="footer_content" class="col-sm-2 control-label">متن معرفی فوتر</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control tinymce" id="footer_content" name="footer_content" rows="5">{{ old('footer_content', $settings['footer_content']) }}</textarea>
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
                            </div>
                            <div class="tab-pane" id="socials">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </div>
                        </div>
                    </div>
                </form>--}}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
