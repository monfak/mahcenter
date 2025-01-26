@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایشگر فایل robots.txt</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{ route('admin.robots.store') }}" method="post" data-parsley-validate="" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="content" class="control-label col-md-3 col-sm-3 col-xs-12">robots.txt</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="content" id="content" class="form-control" rows="20" dir="auto">{{ old('content', $content) }}</textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="submit" class="btn btn-primary" value="ذخیره تغییرات">
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
