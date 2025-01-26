@extends('frontend.layouts.app')

@section('styles')
    <link rel="stylesheet" href="/vendor/select2/select2.min.css">
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
    <script src="/vendor/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#city').select2({
                placeholder : 'شهر خود را انتخاب کنید',
            });
        });
    </script>
@endsection
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
                <div class="card crd-info">
                         <div class="text-h5">آدرس</div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
                <form action="{{ route('panel.address.update') }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <legend>ویرایش آدرس شما</legend>
                        <div class="form-group">
                            <label for="city" class="col-12 control-label">شهر</label>
                            <div class="col-12 ">
                                <select name="city" id="city">
                                    @foreach($provinces as $province)
                                        <optgroup label="{{ $province->name }}">
                                            @foreach($province->cities as $city)
                                                <option value="{{ $city->id }}"{{ (old('city', ($userAddress->city_id ?? null)) == $city->id ? ' selected' : '') }}>{{ $city->name }}</option>
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
                            <label for="phone" class="col-12  control-label">تلفن</label>
                            <div class="col-12 ">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', ($userAddress->phone?? null)) }}" dir="ltr">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post_code" class="col-12  control-label">کدپستی</label>
                            <div class="col-12 ">
                                <input id="post_code" type="text" class="form-control" name="post_code" value="{{ old('post_code', ($userAddress->post_code ?? null)) }}" dir="ltr">

                                @if ($errors->has('post_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-12  control-label">آدرس کامل</label>
                            <div class="col-12 ">
                                <textarea id="address" type="text" class="form-control" name="address" rows="5">{{ old('address', ($userAddress->address?? null)) }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons clearfix">
                        <div class="pull-left"><a href="{{ route('panel.index') }}" class="btn btn-default">بازگشت</a></div>
                        <div class="pull-right">
                            <input type="submit" value="ذخیره تغییرات" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
