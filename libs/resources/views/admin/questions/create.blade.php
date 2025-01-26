@extends('admin.layouts.app')
@section('styles')
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
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $('#product_id').select2({
            placeholder : 'محصول را انتخاب کنید',
        });
        $('#user_id').select2({
            placeholder : 'کاربر را انتخاب کنید',
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ثبت پرسش جدید</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-default btn-sm">لیست پرسش‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('admin.questions.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal" style="padding: 12px">
                        @csrf
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">پرسش</label>
                                <div class="col-md-10">
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_id" class="col-md-2 control-label">محصول</label>
                                <div class="col-md-10">
                                    <select name="product_id[]" id="product_id" class="form-control" multiple="multiple">
                                        @foreach($products as $id => $name)
                                            <option value="{{ $id }}"{{ (in_array($id, old('product_id') ?? []) ? ' selected' : '') }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_id" class="col-md-2 control-label">کاربر</label>
                                <div class="col-md-10">
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option>مهمان</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"{{ (in_array($user->id, old('user_id') ?? []) ? ' selected' : '') }}>
                                            {{ $user->first_name }}
                                            {{ $user->last_name }}
                                            ({{ $user->mobile }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-md-2 control-label">ip</label>
                                <div class="col-md-10">
                                    <input type="text" name="ip" id="ip" class="form-control" value="{{ old('ip', '127.0.0.1') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-2 control-label">وضعیت</label>
                                <div class="col-md-10">
                                    <select name="status" id="status" class="form-control">
                                        <option>در انتظار بررسی</option>
                                        <option value="1">تایید شده</option>
                                        <option value="0">رد شده</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">ثبت پرسش</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
