@extends('frontend.layouts.app')

@section('content')

    <div class="container p-30">
        <div class="row">
            @include('admin.errors')
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">بازیابی رمز عبور</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('reset.password.send.sms') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">شماره همراه</label>
                                <div class="col-md-6">
                                    <input id="mobile" type="number" name="mobile" class="style-input form-control" placeholder="شماره همراه خود را وارد کنید" autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        ارسال
                                    </button><br><br>
                                    <a href="{{ route('login')  }}">
                                        ورود
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
