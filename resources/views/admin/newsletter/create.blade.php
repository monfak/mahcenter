@extends('admin.layouts.app')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن عضو به خبرنامه</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-default btn-sm">لیست اعضای خبرنامه
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="{{ route('admin.newsletter.store') }}" role="form" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="first_name" class="col-md-2 control-label">نام</label>
                            <div class="col-md-10">
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-md-2 control-label">نام خانواگی</label>
                            <div class="col-md-10">
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">ایمیل</label>
                            <div class="col-md-10">
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="افزودن به خبرنامه">
                    </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
