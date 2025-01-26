@extends('frontend.layouts.app')
@section('title', 'پیام پشتیبانی جدید')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
                <div class="card crd-info">
                   <div class="text-h5">تیکت ها</div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div> 
                
                <form action="{{ route('panel.tickets.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend>ارسال تیکت جدید</legend>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-12 control-label">عنوان</label>

                            <div class="col-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-12 control-label">الویت</label>

                            <div class="col-12">
                                <select id="priority" type="" class="form-control" name="priority">
                                    <option value="">انتخاب کنید</option>
                                    <option {{ old('priority') == 'low' ? 'selected' : '' }} value="low">کم</option>
                                    <option {{ old('priority') == 'medium' ? 'selected' : '' }} value="medium">متوسط
                                    </option>
                                    <option {{ old('priority') == 'high' ? 'selected' : '' }} value="high">زیاد</option>
                                </select>

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-12 control-label">متن شما</label>
                            <div class="col-12">
                                <textarea rows="10" id="message" class="form-control tinymce" name="message"></textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="attachment-wrapper" class="hidden">
                            <div class="form-group attachment">
                                <div class="col-12"></div>
                                <div class="col-12">
                                    <input type="file" class="form-control" name="attachment[]" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('attachment.1') ? ' has-error' : '' }} attachment">
                            <label for="attachment" class="col-12 control-label">فایل ضمیمه</label>
                            <div class="col-12">
                                <input type="file" class="form-control" name="attachment[]" value="{{ old('attachment.1') }}" multiple>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment.1') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <div class="justify-content-between mt-3">
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">ارسال پیام پشتیبانی</button>
                        </div>
                        <div>
                            <a href="{{ route('panel.tickets.index') }}" class="btn btn-light btn-sm">بازگشت</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
