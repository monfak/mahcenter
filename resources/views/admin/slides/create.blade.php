@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.toggle').addClass('pull-right');
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن اسلاید</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.slides.index') }}" class="btn btn-default btn-sm">لیست اسلایدها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.slides.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="heading" class="control-label col-md-1 col-sm-3 col-xs-12">عنوان</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="heading" class="control-label col-md-1 col-sm-3 col-xs-12">تصویر</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="file" name="image" id="image" class="dropify">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alt" class="control-label col-md-1 col-sm-3 col-xs-12">متن جایگزین</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" name="alt" id="alt" class="form-control" value="{{ old('alt') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="control-label col-md-1 col-sm-3 col-xs-12">لینک</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" dir="ltr">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sort_order" class="control-label col-md-1 col-sm-3 col-xs-12">ترتیب</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="is_active">وضعیت</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="checkbox" name="is_active" id="is_active" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال"{{ old('is_active') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.tab-content -->
                    <input type="submit" class="btn btn-primary" value="افزودن اسلاید">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection