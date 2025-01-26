@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $comment->article->name }}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.comments.index') }}" class="btn btn-default btn-sm">لیست نظرات
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body chat" id="chat-box">
                            <div class="item">
                                <img src="{{ $comment->avatar }}" alt="user image" class="offline">

                                <div class="message">
                                    <span class="name">
                                        <small class="text-muted pull-right">
                                            <i class="fa fa-clock-o"></i> {{ jdate($comment->created_at)->format('d F Y ساعت H:i') }}
                                        </small>
                                        {{ $comment->name }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa fa-laptop"></i> {{ $comment->ip }}
                                            <i class="fa fa-envelope-o"></i> {{ $comment->email }}
                                        </small>
                                    </span>
                                    <div>
                                        <h4>{{ $comment->title }}</h4>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                    <hr>
                                    <h4>ارسال پاسخ</h4>
                                    <form action="{{ route('admin.comments.update', $comment->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <label for="content" class="col-md-2">نظر شما</label>
                                            <div class="col-md-10">
                                                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-default" value="ارسال پاسخ">
                                    </form>
                                </div>
                            </div>
                            <!-- /.item -->
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
