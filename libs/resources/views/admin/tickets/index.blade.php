@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">تیکت‌ها</h3>
                </div>
                <div class="box-body table-responsive table-striped no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>کاربر</td>
                                <td>عنوان</td>
                                <td>وضعیت</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>
                                    <span class="badge bg-{{ $ticket->status == 1 ? 'green' : 'red' }}">{{ $ticket->status == 1 ? 'باز' : 'بسته' }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.tickets.show', $ticket->id) }}">
                                        <span class="fa fa-eye"></span>
                                        مشاهده تیکت
                                    </a>

                                    <form style="display: inline-block;" action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-{{ $ticket->status ? 'warning' : 'success' }} btn-xs" name="status" value="{{ $ticket->status ? 0 : 1}}" title="{{ $ticket->status == 1 ? 'رد نظر' : 'تایید نظر' }}">
                                            <span class="fa fa-{{ $ticket->status ? 'close' : 'check' }}"></span> {{ $ticket->status ? 'بستن تیکت' : 'باز کردن تیکت' }}
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" title="حذف تیکت" onclick="return confirm('آیا از حذف این تیکت اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف نظر
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($tickets))
                            <tr class="text-center">
                                <td colspan="4">هیچ تیکتی یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $tickets->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
