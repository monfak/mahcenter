@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $question->product->name }}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.questions.index') }}" class="btn btn-default btn-sm"> لیست پرسش‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body chat" id="chat-box">
                            <div class="item">
                                <img src="{{ $question->avatar }}" alt="user image" class="offline">

                                <div class="message">
                                    <span class="name">
                                        <small class="text-muted pull-right">
                                            <i class="fa fa-clock-o"></i> {{ jdate($question->published_at)->format('d F Y ساعت H:i') }}</i>
                                        </small>
                                        {{ $question->name }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa fa-laptop"></i> {{ $question->ip }}
                                            <i class="fa fa-phone"></i> {{ $question->mobile }}
                                        </small>
                                    </span>
                                    <div>
                                        <h4>{{ $question->title }}</h4>
                                        <p>{{ $question->content }}</p>
                                    </div>
                                    <hr>
                                    <h4>پاسخ‌ها</h4>
                                    @forelse($question->answers as $answer)
                                    <p>{{ $answer->content }}</p>
                                    @empty
                                    <div class="alert alert-info">
                                        <p>
                                            هنوز برای این پرسش پاسخی ارسال نکرده‌اید.
                                        </p>
                                    </div>
                                    @endforelse
                                    <hr>
                                    <h4>ارسال پاسخ</h4>
                                    <form action="{{ route('admin.questions.update', ['id' => $question->id]) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <label for="answer" class="col-md-2">پاسخ</label>
                                            <div class="col-md-10">
                                                <textarea name="answer" id="answer" cols="30" rows="10" class="form-control"></textarea>
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
