@extends('frontend.layouts.app')
@section('title', 'ویرایش آدرس')
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
<div class="container pt-5 pb-4">
    <div class="row">
        @include('frontend.layouts.sidebar')
        <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
            <div class="card crd-info">
                  <div class="text-h5">       ویرایش آدرس {{ $address->name }}  </div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
        
        
                    <form action="{{ route('panel.addresses.update', $address->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">عنوان آدرس</label>
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $address->name) }}">
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
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', $address->phone) }}" dir="ltr">
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
                                <select name="city_id" id="city_id">
                                    {{--@foreach($provinces as $province)
                                        <optgroup label="{{ $province->name }}">
                                            @foreach($province->cities as $city)
                                                <option value="{{ $city->id }}"{{ (old('city_id', ($address->city_id ?? null)) == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach--}}
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"{{ (old('city_id', ($address->city_id ?? null)) == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
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
                                <textarea id="address" type="text" class="form-control" name="address" rows="5">{{ old('address', $address->address) }}</textarea>

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
                                <input id="post_code" type="text" class="form-control" name="post_code" value="{{ old('post_code', $address->post_code) }}" dir="ltr">

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
                                <input type="checkbox" name="is_default" id="is_default" value="1" data-toggle="toggle" data-offstyle="info" data-onstyle="success" data-width="150" data-on="<i class='fa fa-check'></i> پیش‌فرض" data-off="<i class='fa fa-close text-red'></i> ثانویه"{{ old('is_default', $address->is_default) ? ' checked' : '' }}>
                                @if ($errors->has('is_default'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_default') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
