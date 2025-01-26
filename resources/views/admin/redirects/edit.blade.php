@extends('admin.layouts.app')
@section('styles')
    <link  rel="stylesheet"href="{{ asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">
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
    <script src="{{ asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $('#type').select2({
            placeholder : 'نوع ریدایرکت را انتخاب کنید',
            dir: "rtl",
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش ریدایرکت</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.redirects.index') }}" class="btn btn-default btn-sm"> ریدایرکت‌ها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{ route('admin.redirects.update', $redirect->id) }}" method="post" data-parsley-validate="" class="form-horizontal form-label-left">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="old" class="control-label col-md-1 col-sm-3 col-xs-12">نشانی قدیمی *</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" name="old" id="old" class="form-control" value="{{ old('old', $redirect->old) }}" dir="ltr" placeholder="products/slug">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="control-label col-md-1 col-sm-3 col-xs-12">نشانی جدید *</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <input type="text" name="url" id="url" class="form-control" value="{{ old('url', $redirect->url) }}" dir="ltr" placeholder="{{ url('products/slug-2') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="control-label col-md-1 col-sm-3 col-xs-12">نوع *</label>
                        <div class="col-md-11 col-sm-9 col-xs-12">
                            <select name="type" id="type">
                                <option value="301"{{ old('type', $redirect->type) == 301 ? ' selected' : '' }}>301  کاملا انتقال یافت.</option>
                                <option value="302"{{ old('type', $redirect->type) == 302 ? ' selected' : '' }}>302 پیدا شد</option>
                                <option value="307"{{ old('type', $redirect->type) == 307 ? ' selected' : '' }}>307 به طور موقت تغییر مسیر داده شد</option>
                                <option value="410"{{ old('type', $redirect->type) == 410 ? ' selected' : '' }}>410 محتوای حذف شده است</option>
                                <option value="451"{{ old('type', $redirect->type) == 451 ? ' selected' : '' }}>451 به دلایل امنیتی غیر قابل دسترسی است</option>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection