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
        $(document).ready(function(){
            $('#city_id').select2({
                placeholder : 'شهر را انتخاب کنید',
            });
            $('.toggle').addClass('pull-right');
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">افزودن آدرس برای {{ $user->name }}</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.users.addresses.index', $user->id) }}" class="btn btn-default btn-sm">لیست آدرس‌های کاربر
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.users.addresses.store', $user->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">عنوان آدرس</label>
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
                                <label for="city_id" class="col-md-2 control-label">شهر</label>
                                <div class="col-md-10">
                                    <select name="city_id" id="city_id" class="form-control">
                                        @foreach($provinces as $province)
                                            <optgroup label="{{ $province->name }}">
                                                @foreach($province->cities as $city)
                                                    <option value="{{ $city->id }}"{{ (old('city_id') == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
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
                            <div class="form-group">
                                <label for="post_code" class="col-md-2 control-label">کدپستی</label>
                                <div class="col-md-10">
                                    <input id="post_code" type="text" class="form-control" name="post_code" value="{{ old('post_code') }}" dir="ltr">

                                    @if ($errors->has('post_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('post_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_default" class="col-md-2 control-label">وضعیت آدرس</label>
                                <div class="col-md-10">
                                    <input type="checkbox" name="is_default" id="is_default" value="1" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> پیش فرض" data-off="<i class='fa fa-close text-red'></i> ثانویه"{{ old('is_default') ? ' checked' : '' }}>
                                    @if ($errors->has('is_default'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('is_default') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">افزودن آدرس</button>
                        </form>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
