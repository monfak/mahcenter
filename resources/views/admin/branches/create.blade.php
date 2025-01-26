@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">افزودن نمایندگی</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.branches.index') }}" class="btn btn-default btn-sm">لیست نمایندگی‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.branches.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">نام نمایندگی</label>
                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="moderator" class="col-md-2 control-label">نام مدیر</label>
                                <div class="col-md-10">
                                    <input id="moderator" type="text" class="form-control" name="moderator" value="{{ old('moderator') }}">

                                    @if ($errors->has('moderator'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('moderator') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-md-2 control-label">شهر</label>
                                <div class="col-md-10">
                                    <select name="city" id="city">
                                        @foreach($provinces as $province)
                                            <optgroup label="{{ $province->name }}">
                                                @foreach($province->cities as $city)
                                                    <option value="{{ $city->id }}"{{ (old('city') == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-md-2 control-label">تلفن</label>
                                <div class="col-md-10">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" dir="ltr">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-md-2 control-label">آدرس کامل</label>
                                <div class="col-md-10">
                                    <textarea id="address" type="text" class="form-control" name="address" rows="5">{{ old('address') }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">افزودن نمایندگی</button>
                        </form>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
