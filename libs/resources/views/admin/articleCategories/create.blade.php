@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2.min.css') }}">
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
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#category_id').select2({
                placeholder:'دسته بندی والد را انتخاب کنید'
            });
        });
    </script>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">افزودن دسته بندی </h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm">
                                <a href="{{route('admin.article_category.index')}}" class="btn btn-default btn-xs">
                                    لیست دسته بندی
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom no-shadow">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_general" data-toggle="tab" aria-expanded="true">عمومی</a>
                                </li>
                                <li>
                                    <a href="#tab_seo" data-toggle="tab" aria-expanded="true">سئو</a>
                                </li>
                            </ul>

                                <form action="{{route('admin.article_category.store')}}" method="post"
                                      class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content">
                                        <div id="tab_general" class="tab-pane active">
                                            <div class="form-group">
                                                <label for="name" class="col-md-2 control-label">نام دسته بندی</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           placeholder="نام دسته بندی را وارد کنید" value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="col-md-2 control-label">اسلاگ</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="slug" id="slug"
                                                           value="{{old('slug')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id" class="col-md-2 control-label">دسته بندی</label>
                                                <div class="col-md-10">
                                                    <select id="category_id" name="category_id" class="form-control">
                                                        <option value="">دسته بندی</option>
                                                        <option value="0">دسته بندی والد را انتخاب کنید</option>
                                                        @foreach($categories as $id=>$category)
                                                            <option value="{{$id}}" {{old('category_id')== $id? 'selected' : ''}}>{{$category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="image" class="col-md-2 control-label">تصویر</label>
                                                <div class="col-md-10">
                                                    <input type="file" name="image" class="form-control"
                                                           value="{{old('image')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-md-2 control-label">توضیحات</label>
                                                <div class="col-md-10">
                                            <textarea type="text" class="form-control" name="description"
                                                      id="description">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tab_seo" class="tab-pane">
                                            <div class="form-group">
                                                <label for="meta_keywords" class="col-md-2 control-label">متا تگ کلمات کلیدی</label>
                                                <div class="col-md-10">
                                                    <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3" placeholder="کلمات کلیدی را با خط تیره (-) از هم جدا کنید">{{ old('meta_keywords') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_description" class="col-md-2 control-label">متا تگ توضیحات</label>
                                                <div class="col-md-10">
                                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">افزودن دسته بندی</button>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
