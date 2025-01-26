@extends('admin.layouts.app')

@section('styles')
@endsection

@section('scripts')

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
                        <form method="post" action="{{ route('admin.articles.update', ['id' => $article->id]) }}" role="form" enctype="multipart/form-data" class="form-horizontal">
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
                                        <label for="meta_keywords" class="col-md-2 control-label">متا تگ کلمات کلیدی</label>
                                        <div class="col-md-10">
                                            <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3" placeholder="کلمات کلیدی را با خط تیره (-) از هم جدا کنید">{{ old('meta_keywords', comma2dash($article->meta_keywords)) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description" class="col-md-2 control-label">متا تگ توضیحات</label>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description', $article->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_information" class="tab-pane">
                                    @if($article->image)
                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">تصویر</label>
                                        <div class="col-md-10">
                                            <img src="{{ asset(\App\ImageManager::getResizeName($article->image, ['width' => 60, 'height' => 60])) }}" alt="{{ $article->title }}">
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
                                        <label for="status" class="col-md-2 control-label">وضعیت</label>
                                        <div class="col-md-10">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"{{ (old('status', $article->status) == 0 ? 'selected' : '') }}>پیش‌نویس</option>
                                                <option value="1"{{ (old('status', $article->status) == 1 ? 'selected' : '') }}>انتشار</option>
                                            </select>
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
