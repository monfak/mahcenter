@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#add-item').click(function(e) {
                e.preventDefault();
                $("#clone").clone().attr('id', '').appendTo("tbody");
            });
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });
            $('.toggle').addClass('pull-right');
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن بنر</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-default btn-sm">لیست بنرها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="{{ route('admin.banners.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <div class="col-md-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="نام *" title="نام (ضروری)" required value="{{ old('name') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="position" id="position" class="form-control" placeholder="موقعیت" title="موقعیت" value="{{ old('position') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="width" id="width" class="form-control" dir="ltr" placeholder="عرض" title="عرض برش عکس‌ها (پیکسل)" value="{{ old('width') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="height" id="height" class="form-control" dir="ltr" placeholder="ارتفاع" title="ارتفاع برش عکس‌ها (پیکسل)" value="{{ old('height') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" name="status" id="status" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال"{{ old('status') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>لینک</th>
                                <th>تصویر</th>
                                <th>webp</th>
                                <th>توضیحات</th>
                                <th>ترتیب</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6"></td>
                                <td>
                                    <button type="button" id="add-item" class="btn btn-default btn-xs"><span class="fa fa-plus"></span> افزودن</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="submit" class="btn btn-primary" value="افزودن بنر">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<table class="hide">
    <tbody>
        <tr id="clone">
            <td><input type="text" name="title[]" class="form-control"></td>
            <td><input type="text" name="url[]" class="form-control" dir="ltr"></td>
            <td><input type="file" name="image[]" class="form-control"></td>
            <td><input type="text" name="webp[]" class="form-control"></td>
            <td><textarea name="content[]" class="form-control"></textarea></td>
            <td><input type="number" name="sort_order[]" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger btn-xs remove-item">
                    <span class="fa fa-trash"></span> حذف
                </button>
            </td>
        </tr>
    </tbody>
</table>
<!-- /.row -->
@endsection
