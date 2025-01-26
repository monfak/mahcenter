@extends('admin.layouts.app')
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
                    <h3 class="box-title">ایجاد نقش کاربری</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-block">بازگشت به لیست</a>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('admin.roles.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                            @csrf
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">نام</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" id="name" placeholder="Admin" class="form-control" dir="ltr" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="display_name" class="col-md-2 control-label">نام نمایشی</label>
                                    <div class="col-md-10">
                                        <input type="text" name="display_name" id="display_name" value="{{ old('display_name') }}" placeholder="مدیر سایت" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-md-2 control-label">توضیحات</label>
                                    <div class="col-md-10">
                                        <textarea name="content" id="content" cols="30" rows="10" placeholder="توضیحات درباره این نقش کاربری" class="form-control">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">افزودن نقش کاربری</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
