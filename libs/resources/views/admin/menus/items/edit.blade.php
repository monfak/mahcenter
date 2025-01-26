@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
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
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle').addClass('pull-right');
            $('#fields').select2({
                dir: "rtl",
            });
            $('#parent_id').select2();
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>ویرایش آیتم</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.menus.items.index', $menu->id) }}" class="btn btn-default btn-sm">آیتم‌های منو
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_general" data-toggle="tab" aria-expanded="true">عمومی</a>
                        </li>
                        <li>
                            <a href="#tab_information" data-toggle="tab" aria-expanded="false">اطلاعات</a>
                        </li>
                    </ul>
                    <form action="{{ route('admin.menus.items.update', $item->id) }}" method="post" enctype="multipart/form-data" data-parsley-validate="" role="form" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <div class="tab-content">
                            <div id="tab_general" class="tab-pane active">
                                <div class="form-group">
                                    <label for="heading" class="control-label col-md-3 col-sm-3 col-xs-12">عنوان *</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading', $item->heading) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lable" class="control-label col-md-3 col-sm-3 col-xs-12">لیبل</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="lable" id="lable" class="form-control" value="{{ old('lable', $item->lable) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="control-label col-md-3 col-sm-3 col-xs-12">لینک</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url', $item->url) }}" dir="ltr">
                                    </div>
                                </div>
                            </div>
                            <div id="tab_information" class="tab-pane">
                                <div class="form-group">
                                    <label for="parent_id" class="control-label col-md-3 col-sm-3 col-xs-12">آیتم والد</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="parent_id" id="parent_id" class="form-control" dir="rtl">
                                            <option value="">فاقد والد</option>
                                            @foreach($parents as $id => $heading)
                                                <option value="{{ $id }}"{{ (old('parent_id', $item->parent_id) == $id ? 'selected' : '') }}>{{ $heading }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sort_order" class="control-label col-md-3 col-sm-3 col-xs-12">ترتیب</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order) }}" min="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if($item->image)
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">تصویر اصلی</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <img src="{{ asset(image_resize($item->image, ['width' => 60, 'height' => 60])) }}" alt="{{ $item->name }}" class="image-thumbnail">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">تغییر تصویر</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_active">وضعیت</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="checkbox" name="is_active" id="is_active" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close text-red'></i> غیرفعال" data-width="125"{{ old('is_active', $item->is_active) ? ' checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="submit" class="btn btn-success" value="ذخیره تغییرات">
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
