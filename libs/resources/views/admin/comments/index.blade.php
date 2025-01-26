@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">نظرات مقالات</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نویسنده</th>
                                <th>تاریخ ثبت</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ($comment->name ?? $comment->user->name) }}</td>
                                <td>{{ jdate($comment->created_at)->format('d F Y ساعت H:i') }}</td>
                                <td>
                                    @switch($comment->status)
                                        @case(0)
                                            <span class="badge bg-red">حذف شده</span>
                                            @break
                                        @case(1)
                                            <span class="badge bg-blue">در انتظار بررسی</span>
                                            @break
                                        @case(2)
                                            <span class="badge bg-red">رد شده</span>
                                            @break
                                        @case(3)
                                            <span class="badge bg-green">تایید شده</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.comments.show', $comment->id) }}">
                                        <span class="fa fa-eye"></span>
                                        مشاهده نظر
                                    </a>

                                    <form style="display: inline-block;" action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        @if($comment->status === 3)
                                        <button type="submit" class="btn btn-warning btn-xs" name="active" value="2">
                                            <span class="fa fa-close"></span>
                                            رد کردن
                                        </button>
                                        @elseif($comment->status === 2)
                                        <button type="submit" class="btn btn-success btn-xs" name="active" value="3">
                                            <span class="fa fa-check"></span>
                                            تایید
                                        </button>
                                        @endif
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" title="حذف نظر" onclick="return confirm('آیا از حذف این نظر اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف نظر
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">هیچ نظری یافت نشد!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $comments->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
