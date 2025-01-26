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
            $('#faqs_id').select2({
                placeholder : 'سوالات متداول را انتخاب کنید',
            });
            $('#products_id').select2({
                placeholder : 'محصولات را انتخاب کنید',
            });
            $('#relate_id').select2({
                placeholder : 'مقالات مرتبط را انتخاب کنید',
            });
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش مقاله</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-sm">لیست مقالات
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
                        <form method="post" action="{{ route('admin.articles.update', $article->id) }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            <div class="tab-content">
                                <div id="tab_general" class="tab-pane active">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">عنوان مقاله *</label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title)}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="col-md-2 control-label">اسلاگ *</label>
                                        <div class="col-md-10">
                                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $article->slug) }}" dir="ltr">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="col-md-2 control-label">توضیحات</label>
                                        <div class="col-md-10">
                                            <textarea name="content" id="content" class="form-control tinymce">{!! old('content', $article->content) !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_seo" class="tab-pane">
                                    <div class="form-group">
                                        <label for="meta_title" class="col-md-2 control-label">تایتل</label>
                                        <div class="col-md-10">
                                            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $article->meta_title) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description" class="col-md-2 control-label">دسکریپشن</label>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description', $article->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_title" class="col-md-2 control-label">تایتل برای توئیتر</label>
                                        <div class="col-md-10">
                                            <input type="text" name="twitter_title" id="twitter_title" class="form-control" value="{{ old('twitter_title', $article->twitter_title) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_description" class="col-md-2 control-label">دسکریپشن برای توئیتر</label>
                                        <div class="col-md-10">
                                            <textarea name="twitter_description" id="twitter_description" class="form-control" rows="5">{{ old('twitter_description', $article->twitter_description) }}</textarea>
                                        </div>
                                    </div>
                                    @if($article->og_image)
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($article->og_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $article->title }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-2 control-label">تصویر برای اپن گراف</label>
                                        <div class="col-md-10">
                                            <input type="file" name="og_image" id="og_image" class="form-control">
                                        </div>
                                    </div>
                                    @if($article->twitter_image)
                                    <div class="form-group">
                                        <label for="twitter_image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($article->twitter_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $article->title }}">
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
                                            <input type="text" name="canonical" id="canonical" class="form-control" value="{{ old('canonical', $article->canonical) }}" dir="ltr">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_nofollow" class="col-md-2 control-label">نوفالو</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" name="is_nofollow" id="is_nofollow" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوفالو" data-off="<i class='fa fa-check'></i> فالو"{{ old('is_nofollow', $article->is_nofollow) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_noindex" class="col-md-2 control-label">نوایندکس</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" name="is_noindex" id="is_noindex" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوایندکس" data-off="<i class='fa fa-check'></i> ایندکس"{{ old('is_noindex', $article->is_noindex) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_information" class="tab-pane">
                                    @if($article->image)
                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(image_resize($article->image, ['width' => 60, 'height' => 60])) }}" alt="{{ $article->title }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">{{ ($article->image ? 'تغییر تصویر' : 'تصویر') }}</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="col-md-2 control-label">دسته بندی</label>
                                        <div class="col-md-10">
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option value="">دسته بندی</option>
                                                @foreach($categories as $id=>$category)
                                                    <option value="{{$id}}" {{old('category_id',$article->category_id)== $id ? 'selected' : ''}}>{{$category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="faqs_id" class="col-md-2 control-label">سوالات متداول</label>
                                        <div class="col-md-10">
                                            <select id="faqs_id" name="faqs_id[]" class="form-control" multiple>
                                                <option value="">انتخاب سوال</option>
                                                @foreach($faqs as $id => $heading)
                                                    <option value="{{ $id }}" {{ in_array($id, old('faqs_id', $selectedFaqs)) ? 'selected' : '' }}>{{ $heading }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="products_id" class="col-md-2 control-label">محصولات</label>
                                        <div class="col-md-10">
                                            <select id="products_id" name="products_id[]" class="form-control" multiple>
                                                <option value="">انتخاب محصول</option>
                                                @foreach($products as $id => $name)
                                                    <option value="{{ $id }}" {{ in_array($id, old('products_id', $selectedProducts)) ? 'selected' : '' }}>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="relate_id" class="col-md-2 control-label">مقالات</label>
                                        <div class="col-md-10">
                                            <select id="relate_id" name="relate_id[]" class="form-control" multiple>
                                                <option value="">انتخاب مقاله</option>
                                                @foreach($articles as $id => $title)
                                                    <option value="{{ $id }}" {{ in_array($id, old('relate_id', $relatedArticles)) ? 'selected' : '' }}>{{ $title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_suggested" class="col-md-2 control-label">پیشنهاد سردبیر</label>
                                        <div class="col-md-10">
                                            <select name="is_suggested" id="is_suggested" class="form-control">
                                                <option value="0"{{ (old('is_suggested', $article->is_suggested) == 0 ? 'selected' : '') }}>پیش‌نویس</option>
                                                <option value="1"{{ (old('is_suggested', $article->is_suggested) == 1 ? 'selected' : '') }}>انتشار</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-md-2 control-label">وضعیت</label>
                                        <div class="col-md-10">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"{{ (old('status', $article->status) == 0 ? 'selected' : '') }}>پیش‌نویس</option>
                                                <option value="1"{{ (old('status', $article->status) == 1 ? 'selected' : '') }}>انتشار</option>
                                            </select>
                                        </div>
                                    </div>
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
