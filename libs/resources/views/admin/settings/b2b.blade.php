@extends('admin.layouts.app')
@section('styles')
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
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#before_faqs_id').select2({
                placeholder : 'سوالات متداول قبل از خرید',
            });
            $('#after_faqs_id').select2({
                placeholder : 'سوالات متداول بعد از خرید',
            });
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">تنظیمات فروش عمده</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.b2b.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="nav-tabs-custom" style="box-shadow: unset">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#b2b" data-toggle="tab" aria-expanded="true">خرید عمده</a></li>
                            <li class=""><a href="#why" data-toggle="tab" aria-expanded="false">چرایی</a></li>
                            <li class=""><a href="#trust" data-toggle="tab" aria-expanded="false">اعتمادسازی</a></li>
                            <li class=""><a href="#faqs" data-toggle="tab" aria-expanded="false">سوالات متداول</a></li>
                            <li class=""><a href="#banners" data-toggle="tab" aria-expanded="false">بنرها</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="b2b">
                                <div class="form-group">
                                    <label for="b2b_intro_content" class="col-sm-2 control-label">متن زیر عنوان</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_intro_content" name="b2b_intro_content">{!! old('b2b_intro_content', $settings['b2b_intro_content']) !!}</textarea>
                                    </div>
                                </div>
                                @if($settings['b2b_intro_image'])
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر</label>
                                    <div class="col-md-10">
                                        <img src="{{ asset(image_resize($settings['b2b_intro_image'], ['width' => 60, 'height' => 60])) }}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="b2b_intro_image" class="col-sm-2 control-label">تصویر</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="b2b_intro_image" name="b2b_intro_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_intro_box_content" class="col-sm-2 control-label">متن باکس خرید عمده</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_intro_box_content" name="b2b_intro_box_content">{!! old('b2b_intro_box_content', $settings['b2b_intro_box_content']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_intro_contact_text" class="col-sm-2 control-label">متن دکمه تماس</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_intro_contact_text" name="b2b_intro_contact_text" value="{{ old('b2b_intro_contact_text', $settings['b2b_intro_contact_text']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_intro_contact_phone" class="col-sm-2 control-label">تلفن دکمه تماس</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_intro_contact_phone" name="b2b_intro_contact_phone" dir="ltr" value="{{ old('b2b_intro_contact_phone', $settings['b2b_intro_contact_phone']) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="why">
                                <div class="form-group">
                                    <label for="b2b_why_heading" class="col-sm-2 control-label">عنوان چرایی</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_why_heading" name="b2b_why_heading">{!! old('b2b_why_heading', $settings['b2b_why_heading']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_why_content" class="col-sm-2 control-label">متن چرایی</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control tinymce" id="b2b_why_content" name="b2b_why_content">{!! old('b2b_why_content', $settings['b2b_why_content']) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="trust">
                                <div class="form-group">
                                    <label for="b2b_trust_heading" class="col-sm-2 control-label">عنوان اعتمادسازی</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_trust_heading" name="b2b_trust_heading">{!! old('b2b_trust_heading', $settings['b2b_trust_heading']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_trust_content" class="col-sm-2 control-label">متن اعتمادسازی</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control tinymce" id="b2b_trust_content" name="b2b_trust_content">{!! old('b2b_trust_content', $settings['b2b_trust_content']) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="faqs">
                                <div class="form-group">
                                    <label for="before_faqs_id" class="col-md-2 control-label">سوالات متداول قبل از خرید</label>
                                    <div class="col-md-10">
                                        <select id="before_faqs_id" name="before_faqs_id[]" class="form-control" multiple>
                                            <option value="">انتخاب سوال</option>
                                            @foreach($faqs as $id => $heading)
                                                <option value="{{ $id }}" {{ in_array($id, old('before_faqs_id', $selectedBeforeFaqs)) ? 'selected' : '' }}>{{ $heading }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="after_faqs_id" class="col-md-2 control-label">سوالات متداول بعد از خرید</label>
                                    <div class="col-md-10">
                                        <select id="after_faqs_id" name="after_faqs_id[]" class="form-control" multiple>
                                            <option value="">انتخاب سوال</option>
                                            @foreach($faqs as $id => $heading)
                                                <option value="{{ $id }}" {{ in_array($id, old('after_faqs_id', $selectedAfterFaqs)) ? 'selected' : '' }}>{{ $heading }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="banners">
                                <div class="form-group">
                                    <label for="b2b_banners_1_heading" class="col-sm-2 control-label">عنوان بنر ۱</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_1_heading" name="b2b_banners_1_heading">{!! old('b2b_banners_1_heading', $settings['b2b_banners_1_heading']) !!}</textarea>
                                    </div>
                                </div>
                                @if($settings['b2b_banners_1_image'])
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر بنر ۱</label>
                                    <div class="col-md-10">
                                        <img src="{{ asset(image_resize($settings['b2b_banners_1_image'], ['width' => 60, 'height' => 60])) }}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="b2b_banners_1_image" class="col-sm-2 control-label">تصویر بنر ۱</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="b2b_banners_1_image" name="b2b_banners_1_imagero_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_1_content" class="col-sm-2 control-label">متن بنر ۱</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_1_content" name="b2b_banners_1_content">{!! old('b2b_banners_1_content', $settings['b2b_banners_1_content']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_1_text" class="col-sm-2 control-label">متن دکمه تماس بنر ۱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_1_text" name="b2b_banners_1_text" value="{{ old('b2b_banners_1_text', $settings['b2b_banners_1_text']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_1_url" class="col-sm-2 control-label">لینک دکمه تماس بنر ۱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_1_url" name="b2b_banners_1_url" dir="ltr" value="{{ old('b2b_banners_1_url', $settings['b2b_banners_1_url']) }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="b2b_banners_2_heading" class="col-sm-2 control-label">عنوان بنر ۲</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_2_heading" name="b2b_banners_2_heading">{!! old('b2b_banners_2_heading', $settings['b2b_banners_2_heading']) !!}</textarea>
                                    </div>
                                </div>
                                @if($settings['b2b_banners_2_image'])
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر بنر ۲</label>
                                    <div class="col-md-10">
                                        <img src="{{ asset(image_resize($settings['b2b_banners_2_image'], ['width' => 60, 'height' => 60])) }}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="b2b_banners_2_image" class="col-sm-2 control-label">تصویر بنر ۲</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="b2b_banners_2_image" name="b2b_banners_2_imagero_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_2_content" class="col-sm-2 control-label">متن بنر ۲</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_2_content" name="b2b_banners_2_content">{!! old('b2b_banners_2_content', $settings['b2b_banners_2_content']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_2_text" class="col-sm-2 control-label">متن دکمه تماس بنر ۲</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_2_text" name="b2b_banners_2_text" value="{{ old('b2b_banners_2_text', $settings['b2b_banners_2_text']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_2_url" class="col-sm-2 control-label">لینک دکمه تماس بنر ۲</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_2_url" name="b2b_banners_2_url" dir="ltr" value="{{ old('b2b_banners_2_url', $settings['b2b_banners_2_url']) }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="b2b_banners_3_heading" class="col-sm-2 control-label">عنوان بنر ۳</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_3_heading" name="b2b_banners_3_heading">{!! old('b2b_banners_3_heading', $settings['b2b_banners_3_heading']) !!}</textarea>
                                    </div>
                                </div>
                                @if($settings['b2b_banners_3_image'])
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر بنر ۳</label>
                                    <div class="col-md-10">
                                        <img src="{{ asset(image_resize($settings['b2b_banners_3_image'], ['width' => 60, 'height' => 60])) }}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="b2b_banners_3_image" class="col-sm-2 control-label">تصویر بنر ۳</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="b2b_banners_3_image" name="b2b_banners_3_imagero_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_3_content" class="col-sm-2 control-label">متن بنر ۳</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_3_content" name="b2b_banners_3_content">{!! old('b2b_banners_3_content', $settings['b2b_banners_3_content']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_3_text" class="col-sm-2 control-label">متن دکمه تماس بنر ۳</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_3_text" name="b2b_banners_3_text" value="{{ old('b2b_banners_3_text', $settings['b2b_banners_3_text']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_3_url" class="col-sm-2 control-label">لینک دکمه تماس بنر ۳</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_3_url" name="b2b_banners_3_url" dir="ltr" value="{{ old('b2b_banners_3_url', $settings['b2b_banners_3_url']) }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="b2b_banners_4_heading" class="col-sm-2 control-label">عنوان بنر ۴</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_4_heading" name="b2b_banners_4_heading">{!! old('b2b_banners_4_heading', $settings['b2b_banners_4_heading']) !!}</textarea>
                                    </div>
                                </div>
                                @if($settings['b2b_banners_1_image'])
                                <div class="form-group">
                                    <label for="image" class="col-md-2 control-label">تصویر بنر ۴</label>
                                    <div class="col-md-10">
                                        <img src="{{ asset(image_resize($settings['b2b_banners_4_image'], ['width' => 60, 'height' => 60])) }}">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="b2b_banners_4_image" class="col-sm-2 control-label">تصویر بنر ۴</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="b2b_banners_4_image" name="b2b_banners_4_imagero_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_4_content" class="col-sm-2 control-label">متن بنر ۴</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_banners_4_content" name="b2b_banners_4_content">{!! old('b2b_banners_4_content', $settings['b2b_banners_4_content']) !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_4_text" class="col-sm-2 control-label">متن دکمه تماس بنر ۴</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_4_text" name="b2b_banners_4_text" value="{{ old('b2b_banners_4_text', $settings['b2b_banners_4_text']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_banners_4_url" class="col-sm-2 control-label">لینک دکمه تماس بنر ۴</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_banners_4_url" name="b2b_banners_4_url" dir="ltr" value="{{ old('b2b_banners_4_url', $settings['b2b_banners_4_url']) }}">
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
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
