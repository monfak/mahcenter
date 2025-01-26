@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">پرسش و پاسخ</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.questions.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن پرسش
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نویسنده</th>
                                <th>عنوان</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $question->name ?? $question->user->name }}</td>
                                <td>{{ $question->title  }}</td>
                                <td>{{ jdate($question->created_at)->format("d F Y ساعت H:i") }}</td>
                                <td>
                                    <span class="badge bg-{{ $question->status == 1 ? 'green' : 'red' }}">{{ $question->status == 1 ? 'تایید شده' : 'تایید نشده' }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.questions.show', ['id' => $question->id]) }}">
                                        <span class="fa fa-eye"></span>
                                        مشاهده پرسش
                                    </a>
                                    <form style="display: inline-block;" action="{{ route('admin.questions.destroy', ['id' => $question->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-{{ $question->status ? 'warning' : 'success' }} btn-xs" name="active" value="{{ $question->status ? 0 : 1}}" title="{{ $question->status == 1 ? 'رد پرسش' : 'تایید پرسش' }}">
                                            <span class="fa fa-{{ $question->status ? 'close' : 'check' }}"></span> {{ $question->status ? 'رد پرسش' : 'تایید پرسش' }}
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" title="حذف پرسش" onclick="return confirm('آیا از حذف این پرسش اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف پرسش
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($questions))
                            <tr class="text-center">
                                <td colspan="6">هیچ پرسشی یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $questions->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
