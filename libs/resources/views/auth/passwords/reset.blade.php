@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3 col-sm-12 my-5">
            @if ($errors->has('wrong'))
                <div class="alert alert-danger">{{ $errors->first('invalid') }}</div>
            @endif
            @if ($errors->has('invalid'))
                <div class="alert alert-danger">{{ $errors->first('invalid') }}</div>
            @endif
            <div class="panel panel-default card">
                <div class="panel-heading card-header">
                    <div class="panel-title card-title">بازیابی پسورد</div>
                </div>
                <div class="panel-body card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">موبایل</label>
                            <div class="col-md-6">
                                <input id="mobile" type="tel" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="token" class="col-md-4 col-form-label text-md-right">کد ارسالی</label>

                            <div class="col-md-6">
                                <input id="token" type="number" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" size="5" name="token" value="{{ old('token') }}" required>

                                @if ($errors->has('token'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">پسورد</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تکرار پسورد</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">تغییر پسورد</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
