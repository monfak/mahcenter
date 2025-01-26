@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">درخواست‌های اقساط</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <th>نام و نام خانوادگی</th>
                            <th>موبایل</th>
                            <th>پلن</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->mobile }}</td>
                                <td>{{ $application->plan->name }}</td>
                                <td>{{ jdate($application->created_at)->format('d F Y ساعت H:i') }}</td>
                                <td>
                                    @if($application->seen_at)
                                    <span class="label label-success">بررسی شده</span>
                                    @else
                                    <span class="label label-info">در انتظار بررسی</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.installments.applications.destroy', $application->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.installments.applications.show', $application->id) }}">
                                            <span class="fa fa-eye"></span>
                                            مشاهده
                                        </a>
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">هیچ  درخواست اقساطی یافت نشد!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $applications->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
