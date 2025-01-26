@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.toggle').addClass('pull-right');
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن منو</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-default btn-sm">لیست منوها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="{{ route('admin.menus.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">نام منو *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="control-label col-md-3 col-sm-3 col-xs-12">موقعیت *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_active">وضعیت</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="checkbox" name="is_active" id="is_active" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال" data-width="125"{{ old('is_active') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="افزودن منو">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection