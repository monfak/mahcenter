@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">نظرات</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نویسنده</th>
                                <th>عنوان</th>
                                <th>تاریخ ثبت</th>
                                {{--<td>امتیاز</td>--}}
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ($review->name ?? $review->user->name) }}</td>
                                <td>{{ ($review->title ?? 'در پاسخ به: ' . ($review->parent->title ?? 'بدون عنوان')) }}</td>
                                <td>{{ jdate($review->created_at)->format('d F Y ساعت H:i') }}</td>
                                {{--<td>--}}
                                    {{--<i class="fa fa-star{{ ($review->star == 5 ? ' text-success' : '-o') }}"></i>--}}
                                    {{--<i class="fa fa-star{{ ($review->star >= 4 ? ' text-success' : '-o') }}"></i>--}}
                                    {{--<i class="fa fa-star{{ ($review->star >= 3 ? ' text-success' : '-o') }}"></i>--}}
                                    {{--<i class="fa fa-star{{ ($review->star >= 2 ? ' text-success' : '-o') }}"></i>--}}
                                    {{--<i class="fa fa-star{{ ($review->star >= 1 ? ' text-success' : '-o') }}"></i>--}}
                                {{--</td>--}}
                                <td>
                                    <span class="badge bg-{{ $review->status == 1 ? 'green' : 'red' }}">{{ $review->status == 1 ? 'تایید شده' : 'تایید نشده' }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.reviews.show', $review->id) }}">
                                        <span class="fa fa-eye"></span>
                                        مشاهده نظر
                                    </a>

                                    <form style="display: inline-block;" action="{{ route('admin.reviews.destroy', $review->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-{{ $review->status ? 'warning' : 'success' }} btn-xs" name="active" value="{{ $review->status ? 0 : 1}}" title="{{ $review->status == 1 ? 'رد نظر' : 'تایید نظر' }}">
                                            <span class="fa fa-{{ $review->status ? 'close' : 'check' }}"></span> {{ $review->status ? 'رد نظر' : 'تایید نظر' }}
                                        </button>
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
                    {{ $reviews->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
