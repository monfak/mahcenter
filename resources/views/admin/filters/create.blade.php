@extends('admin.layouts.app')

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#add-item').click(function(e) {
                e.preventDefault();
                $("#clone").clone().attr('id', '').appendTo("table.filters tbody");
            });
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        input[type='checkbox'] {
            margin-right:10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">افزودن گروه فیلتر</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.filters.index') }}" class="btn btn-default btn-sm">لیست فیلتر‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.filters.store') }}" method="post">
                                @csrf
                                <table class="table table-bordered table-hover table-striped table-condensed">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="">نام گروه فیلتر *</label>
                                                <input name="group_name" type="text" placeholder="نام گروه فیلتر" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="">لیبل گروه فیلتر</label>
                                                <input name="group_label" type="text" placeholder="لیبل فیلتر" class="form-control">
                                            </td>
                                            <td>
                                                <label for="">ترتیب</label>
                                                <input name="group_sort_order" type="number" min="0" max="255" placeholder="ترتیب" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-bordered table-hover table-striped table-condensed filters">
                                    <thead>
                                        <tr>
                                            <th>نام فیلتر</th>
                                            <th>ترتیب</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td>
                                                <button type="button" id="add-item" class="btn btn-default btn-xs">
                                                    <span class="fa fa-plus"></span> افزودن
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
    <table class="hide">
        <tbody>
        <tr id="clone">
            <td><input type="text" name="name[]" class="form-control"></td>
            <td><input type="number" name="sort_order[]" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger btn-xs remove-item">
                    <span class="fa fa-trash"></span> حذف
                </button>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
