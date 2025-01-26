@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">کدهای وریفیکیشن</h3>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>موبایل</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ درخواست</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($verifications as $verification)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $verification->mobile }}</td>
                                        <td>
                                            @if($verification->is_used)
                                            <span class="label label-success">استفاده شده</span>
                                            @else
                                            <span class="label label-danger">استفاده نشده</span>
                                            @endif
                                            @if(!$verification->is_used && now()->diffInMinutes($verification->created_at) >= 2)
                                            <span class="label label-success">فعال</span>
                                            @else
                                            <span class="label label-danger">منقضی شده</span>
                                            @endif
                                        </td>
                                        <td>{{ jdate($verification->created_at)->format('d F Y ساعت H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">هیچ کد وریفیکشنی درخواست نشده است.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    {{ $verifications->links() }}
                </div>
            </div>
        </section>
        <!-- /.Left col -->
    </div>
@endsection
