@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">تنظیمات سئو</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.seo.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="nav-tabs-custom" style="box-shadow: unset">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">صفحه اصلی</a></li>
                            <li class=""><a href="#blog" data-toggle="tab" aria-expanded="false">وبلاگ</a></li>
                            <li class=""><a href="#faq" data-toggle="tab" aria-expanded="false">سوالات متداول</a></li>
                            <li class=""><a href="#products" data-toggle="tab" aria-expanded="false">محصولات</a></li>
                            <li class=""><a href="#amazing" data-toggle="tab" aria-expanded="false">شگفت انگیز</a></li>
                            <li class=""><a href="#installment" data-toggle="tab" aria-expanded="false">اقساط</a></li>
                            <li class=""><a href="#b2b" data-toggle="tab" aria-expanded="false">عمده</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">تایتل سایت</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $settings['title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="heading" class="col-sm-2 control-label">هدینگ سایت</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading', $settings['heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">دسکریپشن سایت</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $settings['description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="blog">
                                <div class="form-group">
                                    <label for="blog_title" class="col-sm-2 control-label">تایتل وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="blog_title" name="blog_title" value="{{ old('blog_title', $settings['blog_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="blog_heading" class="col-sm-2 control-label">هدینگ وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="blog_heading" name="blog_heading" value="{{ old('blog_heading', $settings['blog_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="blog_description" class="col-sm-2 control-label">دسکریپشن وبلاگ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="blog_description" name="blog_description" rows="5">{{ old('blog_description', $settings['blog_description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="products">
                                <div class="form-group">
                                    <label for="products_title" class="col-sm-2 control-label">تایتل محصولات</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="products_title" name="products_title" value="{{ old('products_title', $settings['products_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="products_heading" class="col-sm-2 control-label">هدینگ محصولات</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="products_heading" name="products_heading" value="{{ old('products_heading', $settings['products_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="products_description" class="col-sm-2 control-label">دسکریپشن محصولات</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="products_description" name="products_description" rows="5">{{ old('products_description', $settings['products_description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="amazing">
                                <div class="form-group">
                                    <label for="amazing_title" class="col-sm-2 control-label">تایتل پیشنهادات شگفت انگیز</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="amazing_title" name="amazing_title" value="{{ old('amazing_title', $settings['amazing_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amazing_heading" class="col-sm-2 control-label">هدینگ پیشنهادات شگفت انگیز</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="amazing_heading" name="amazing_heading" value="{{ old('amazing_heading', $settings['amazing_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amazing_description" class="col-sm-2 control-label">دسکریپشن پیشنهادات شگفت انگیز</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="amazing_description" name="amazing_description" rows="5">{{ old('amazing_description', $settings['amazing_description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="installment">
                                <div class="form-group">
                                    <label for="installment_title" class="col-sm-2 control-label">تایتل اقساط</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="installment_title" name="installment_title" value="{{ old('installment_title', $settings['installment_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="installment_heading" class="col-sm-2 control-label">هدینگ اقساط</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="installment_heading" name="installment_heading" value="{{ old('installment_heading', $settings['installment_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="installment_description" class="col-sm-2 control-label">دسکریپشن اقساط</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="installment_description" name="installment_description" rows="5">{{ old('installment_description', $settings['installment_description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="b2b">
                                <div class="form-group">
                                    <label for="b2b_title" class="col-sm-2 control-label">تایتل وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_title" name="b2b_title" value="{{ old('b2b_title', $settings['b2b_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_heading" class="col-sm-2 control-label">هدینگ وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="b2b_heading" name="b2b_heading" value="{{ old('b2b_heading', $settings['b2b_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="b2b_description" class="col-sm-2 control-label">دسکریپشن وبلاگ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="b2b_description" name="b2b_description" rows="5">{{ old('b2b_description', $settings['b2b_description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="faq">
                                <div class="form-group">
                                    <label for="faq_title" class="col-sm-2 control-label">تایتل وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="faq_title" name="faq_title" value="{{ old('faq_title', $settings['faq_title']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="faq_heading" class="col-sm-2 control-label">هدینگ وبلاگ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="faq_heading" name="faq_heading" value="{{ old('faq_heading', $settings['faq_heading']) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="faq_description" class="col-sm-2 control-label">دسکریپشن وبلاگ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="faq_description" name="faq_description" rows="5">{{ old('faq_description', $settings['faq_description']) }}</textarea>
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
