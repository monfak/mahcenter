@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش سوال</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-default btn-sm"> سوالات متداول
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="{{ route('admin.faqs.update', $faq->id) }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="heading" class="col-md-2 control-label">عنوان سوال *</label>
                            <div class="col-md-10">
                                <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading', $faq->heading)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-md-2 control-label">توضیحات</label>
                            <div class="col-md-10">
                                <textarea name="content" id="content" class="form-control tinymce">{!! old('content', $faq->content) !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort_order" class="col-md-2 control-label">ترتیب</label>
                            <div class="col-md-10">
                                <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $faq->sort_order)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active" class="col-md-2 control-label">نمایش در سوالات متداول</label>
                            <div class="col-md-10">
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="0"{{ (old('is_active', $faq->is_active) == 0 ? 'selected' : '') }}>غیرفعال</option>
                                    <option value="1"{{ (old('is_active', $faq->is_active) == 1 ? 'selected' : '') }}>فعال</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="ذخیره تغییرات">
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@endsection
