@extends('frontend.layouts.app')
@section('title', 'مشاهده پیام پشتیبانی')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
                <div class="card crd-info">
                  
                     <div class="text-h5">{{ $ticket->title }}  </div>
                           <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                     </div>     
          
                <form action="{{ route('panel.tickets.update', $ticket->slug) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <legend>تیکت #{{ $ticket->slug }} - {{ $ticket->title }}
                            <small class="text-muted">(
                            اولویت:
                            @if($ticket->priority == 'high')
                                زیاد
                            @elseif($ticket->priority == 'medium')
                                متوسط
                            @else
                                کم
                            @endif
                            -
                            وضعیت:
                            {{ ($ticket->status ? 'باز' : 'بسته') }}
                            )</small>
                        </legend>

                        @foreach($ticket->messages as $message)
                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="{{ mini_avatar($message->user->email) }}"
                                         alt="User Image">
                                    <span class="username">
                                    <a href="#">{{ $message->user->name }}</a>
                                </span>
                                    <small class="text-muted pull-left"> {{ jdate($message->created_at)->ago() }} - ارسال شده  </small>
                                </div>
                                <!-- /.user-block -->
                                {!! nl2br(strip_tags($message->body)) !!}
                                @if(count($message->attachment) > 0)
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            <span class="fa fa-paperclip"></span>
                                            <strong>پیوست‌ها:</strong>
                                            @foreach($message->attachment as $attachment)
                                                @if($attachment->mime == 'jpg' OR $attachment->mime == 'png' OR $attachment->mime == 'jpeg' OR $attachment->mime == 'gif')
                                                    @php $icon = '-image-o'; @endphp
                                                @elseif($attachment->mime == 'docx' OR $attachment->mime == 'doc')
                                                    @php $icon = '-word-o'; @endphp
                                                @elseif($attachment->mime == 'pdf')
                                                    @php $icon = '-pdf-o'; @endphp
                                                @elseif($attachment->mime == 'zip')
                                                    @php $icon = '-zip-o'; @endphp
                                                @else
                                                    @php $icon = ''; @endphp
                                                @endif
                                                <span class="fa fa-file{{ $icon }}"></span>
                                                <a href="{{ url($attachment->url) }}">{{ $attachment->client_name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr>
                        @endforeach
                        @if($ticket->status)
                        <h4>پاسخ به تیکت</h4>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-3 control-label">متن شما</label>
                            <div class="col-md-9">
                                <textarea rows="10" id="message" class="form-control tinymce" name="message"></textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('attachment.1') ? ' has-error' : '' }} attachment">
                            <label for="attachment" class="col-md-3 control-label">فایل ضمیمه</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="attachment[]" value="{{ old('attachment.1') }}" multiple>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment.1') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @else
                            <div class="alert alert-warning">
                                این تیکت بسته شده است، برای ارسال پاسخ ابتدا تیکت را باز کنید.
                            </div>
                        @endif
                    </fieldset>
                    <div class="justify-content-between mt-3">
                        <div>
                            @if($ticket->status)
                            <button type="submit" class="btn btn-primary btn-sm">ارسال پاسخ</button>
                            @endif
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
