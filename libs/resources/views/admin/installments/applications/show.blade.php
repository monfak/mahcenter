@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">مشاهده درخواست اقساط</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.installments.applications.index') }}" class="btn btn-default btn-sm">لیست درخواست‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>شماره درخواست</th>
                                <td>{{ $application->id }}</td>
                            </tr>
                            <tr>
                                <th>نام کاربر</th>
                                <td>{{ $application->name }}</td>
                            </tr>
                            <tr>
                                <th>موبایل</th>
                                <td>{{ $application->mobile }}</td>
                            </tr>
                            <tr>
                                <th>پلن</th>
                                <td>{{ $application->plan->name }}</td>
                            </tr>
                            <tr>
                                <th>تاریخ ثبت</th>
                                <td>{{ jdate($application->created_at)->format('d F Y ساعت H:i') }}</td>
                            </tr>
                            <tr>
                                <th>توضیحات</th>
                                <td>{{ $application->content }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@endsection
