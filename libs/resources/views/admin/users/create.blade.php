@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">افزودن کاربر</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-default btn-sm">لیست کابران
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="first_name" class="col-md-2 control-label">نام</label>
                                <div class="col-md-10">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-md-2 control-label">نام خانوادگی</label>
                                <div class="col-md-10">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-md-2 control-label" class="form-control">گروه کاربری</label>
                                <div class="col-md-10">
                                    <select name="role" id="role">
                                        <option value="">بدون نقش کاربری</option>
                                        @foreach($roles as $id => $role)
                                            <option value="{{ $id }}"{{ (old('role', 2) == $id ? ' selected' : '') }}>{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">ایمیل</label>
                                <div class="col-md-10">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" dir="ltr">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-2 control-label">پسورد</label>
                                <div class="col-md-10">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" dir="ltr">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="national_code" class="col-md-2 control-label">کدملی</label>
                                <div class="col-md-10">
                                    <input id="national_code" type="text" class="form-control" name="national_code" value="{{ old('national_code') }}" dir="ltr">

                                    @if ($errors->has('national_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('national_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="col-md-2 control-label">موبایل</label>
                                <div class="col-md-10">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" dir="ltr">

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">افزودن کاربر</button>
                        </form>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
