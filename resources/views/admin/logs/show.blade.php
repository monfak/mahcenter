@extends('admin.layouts.app')
@section('styles')
<style>
    .changed {
        background: #fcf8e3 !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">مشاهده لاگ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @isset($log->properties['alert'])
                <div class="alert alert-info">
                    <p>
                        {!! $log->properties['alert'] !!}
                    </p>
                </div>
                @endisset
                @include('admin.logs.partials.model')
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection