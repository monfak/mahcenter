@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ticket->title }}</h3>
                    <small class="text-muted">
                        <i class="fa fa-sort-amount-desc"></i> اولویت:
                        @if($ticket->priority == 'high')
                            زیاد
                        @elseif($ticket->priority == 'medium')
                            متوسط
                        @else
                            کم
                        @endif
                        <i class="fa fa-envelope{{ ($ticket->status ? '-open' : '') }}-o"></i> وضعیت: {{ ($ticket->status ? 'باز' : 'بسته') }}
                    </small>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.tickets.index') }}" class="btn btn-default btn-sm">لیست تیکت‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body chat" id="chat-box">
                            @foreach($ticket->messages as $message)
                            <div class="item">
                                <img src="{{ mini_avatar($message->user->email) }}" alt="user image" class="offline">
                                <div class="message">
                                    <span class="name">
                                        <small class="text-muted pull-right">
                                            <i class="fa fa-clock-o"></i> {{ jdate($message->created_at)->format('d F Y ساعت H:i') }}
                                        </small>
                                        <a href="{{ route('admin.users.edit', $message->user_id) }}">
                                            @if($message->user->name !== ' ')
                                            {{ $message->user->name }}
                                            @else
                                            بدون نام کاربری
                                            @endif
                                        </a>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa fa-phone"></i> {{ $message->user->mobile }}
                                        </small>
                                    </span>
                                    <div>
                                        <p>{!! nl2br(strip_tags($message->body)) !!}</p>
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

                                </div>
                            </div>
                            @endforeach
                            <hr>
                            @if($ticket->status)
                                <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <h4>پاسخ به تیکت</h4>
                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                        <label for="message" class="col-md-2 control-label">متن شما</label>
                                        <div class="col-md-10">
                                            <textarea rows="10" id="message" class="form-control" name="message"></textarea>

                                            @if ($errors->has('message'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('message') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('attachment.1') ? ' has-error' : '' }} attachment">
                                        <label for="attachment" class="col-md-2 control-label">فایل ضمیمه</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" name="attachment[]" multiple>
                                            @if ($errors->has('attachment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('attachment.1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" value="ارسال پاسخ" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    این تیکت بسته شده است، برای ارسال پاسخ ابتدا تیکت را باز کنید.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
