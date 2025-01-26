@extends('admin.layouts.app')
@section('styles')
    <style>
        input[type='checkbox'] {
            margin-right:10px;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#add-item').click(function(e) {
                e.preventDefault();
                $("#clone").clone().attr('id', '').appendTo("table.options tbody");
            });
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش گزینه {{ $option->name }}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.options.index') }}" class="btn btn-default btn-sm">لیست گزینه‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.options.update', $option->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <table class="table table-bordered table-hover table-striped table-condensed">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="option_name">نام گزینه</label>
                                                <input name="option_name" type="text" placeholder="نام گزینه" class="form-control" value="{{ old('option_name', $option->name) }}">
                                            </td>
                                            <td>
                                                <label for="option_sort_order">ترتیب</label>
                                                <input name="option_sort_order" type="text" placeholder="ترتیب" class="form-control" value="{{ old('option_sort_order', $option->sort_order) }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table table-bordered table-hover table-striped table-condensed options">
                                    <thead>
                                    <tr>
                                        <th>نام گزینه</th>
                                        <th>تصویر</th>
                                        <th>ترتیب</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($option->values as $value)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="keep_options[{{ $value->id }}]" value="{{ $value->id }}">
                                                <input name="name[{{ $value->id }}]" type="text" placeholder="نام گزینه" class="form-control" value="{{ $value->name }}">
                                            </td>
                                            <td>
                                                <input type="hidden" name="keeper[{{ $value->id }}]" value="{{ $value->id }}">
                                                @if($value->image)
                                                <img src="{{ asset(App\ImageManager::getResizeName($value->image, ['width' => 40, 'height' => 40])) }}" alt="{{ $value->name }}" class="col-md-2">
                                                @endif
                                                <input type="file" name="image[{{ $value->id }}]" class="col-md-10">
                                            </td>
                                            <td>
                                                <input name="sort_order[{{ $value->id }}]" type="text" placeholder="ترتیب" class="form-control" value="{{ $value->sort_order }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-xs remove-item">
                                                    <span class="fa fa-trash"></span> حذف
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
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
            <td><input type="file" name="image[]" class="form-control"></td>
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
