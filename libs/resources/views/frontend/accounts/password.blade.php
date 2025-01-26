@extends('frontend.layouts.app')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
               <div class="card crd-info">
           
                <div class="text-h5">تغییر رمز عبور  </div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
              
                <form action="{{ route('panel.password.update') }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                      
                        <div class="form-group mt-3 required">
                            <label class="col-12 control-label" for="first_name">رمز عبور</label>
                            <div class="col-12">
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mt-3 required">
                            <label class="col-12 control-label" for="confirm">تکرار رمز عبور</label>
                            <div class="col-12">
                                <input type="password" name="password_confirmation" id="confirm" class="form-control">
                            </div>
                        </div>
                    </fieldset>
                 
                    <div class="row form-group  mt-5 mb-4">
                        <div class="col-6">
                            <a href="{{ route('panel.index') }}" class="btn btn-outline-light text-dark form-control" style="line-height: 2;">بازگشت</a
                            ></div>
                        <div class="col-6">
                            <input type="submit" value="ذخیره تغییرات" class="btn btn-primary form-control" style="line-height: 2;">
                        </div>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
@endsection
