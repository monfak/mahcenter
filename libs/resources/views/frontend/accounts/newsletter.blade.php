@extends('frontend.layouts.app')

@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
               <div class="card crd-info">
               <div class="text-h5">خبرنامه</div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>
             
                <form action="{{ route('panel.address.update') }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <legend>خبرنامه ایمیلی</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">عضویت</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="newsletter" value="1">
                                    بله </label>
                                <label class="radio-inline">
                                    <input type="radio" name="newsletter" value="0" checked="checked">
                                    خیر</label>
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
