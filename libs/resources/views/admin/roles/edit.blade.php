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
                    <h3 class="box-title">ویرایش نقش کاربری :: {{ $role->display_name }}</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-block">بازگشت به لیست</a>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('patch')
                                <table class="table table-bordered">
                                    <tr>
                                        <td><label for="name">نام نقش</label></td>
                                        <td>
                                            <input type="text" name="name" id="name" placeholder="Admin" class="form-control" dir="ltr" value="{{ old('name', $role->name) }}" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="display_name">نام نمایشی</label></td>
                                        <td>
                                            <input type="text" name="display_name" id="display_name" class="form-control" value="{{ old('display_name', $role->display_name) }}" required>
                                            @if ($errors->has('display_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('display_name') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="content">توضیحات</label></td>
                                        <td>
                                            <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="توضیحات درباره این نقش کاربری">
                                                {{ old('content', $role->content) }}
                                            </textarea>
                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </form>
                        </div>
                        <div class="col-md-3 pull-right">
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-block">بازگشت به لیست</a>
                                @if($role->is_deletable)
                                <button type="submit" class="btn btn-danger btn-block" name="delete" value="{{ $role->id }}">حذف نقش</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
