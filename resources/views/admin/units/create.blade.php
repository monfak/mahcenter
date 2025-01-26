@extends('admin.layouts.app')

@section('scripts')
@endsection

@section('styles')
    <style>
        input[type='checkbox'] {
            margin-right:10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">افزودن واحد شمارش</h3>
                    <a href="{{ route('admin.units.index') }}" class="btn btn-default pull-right">بازگشت به لیست <span class="fa fa-arrow-left"></span></a>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.units.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">نام واحد شمارش</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="نام تولید کننده را وارد کنید">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">افزودن واحد شمارش</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
