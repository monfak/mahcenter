@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن روش پرداخت</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-default btn-sm"> روش‌های پرداخت
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="{{ route('admin.payment-methods.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">نام روش پرداخت *</label>
                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-md-2 control-label">نوع *</label>
                        <div class="col-md-10">
                            <select name="type" id="type" class="form-control" required>
                                <option value="1">درگاه</option>
                                <option value="2">کیف پول</option>
                                <option value="3">ثبت با رسید</option>
                                <option value="4">ثبت سریع</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="discount_percentage" class="col-md-2 control-label">درصد تخفیف</label>
                        <div class="col-md-10">
                            <input type="text" name="discount_percentage" id="discount_percentage" class="form-control" value="{{ old('discount_percentage') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-md-2 control-label">توضیحات</label>
                        <div class="col-md-10">
                            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active" class="col-md-2 control-label">وضعیت</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="is_active" id="is_active" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close'></i> غیرفعال"{{ old('is_active') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="افزودن روش پرداخت">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
