@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست گارانتی‌ها</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.warranties.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن گارانتی
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>نمایش در صفحه اصلی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warranties as $warranty)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $warranty->name }}</td>
                            <td>
                                <span class="label label-{{ ($warranty->show_in_home ? 'success' : 'warning') }}">{{ $warranty->show_in_home ? 'فعال' : 'غیرفعال' }}</span>
                            </td>
                            <td>
                                <span class="label label-{{ ($warranty->is_active ? 'success' : 'warning') }}">{{ $warranty->is_active ? 'فعال' : 'غیرفعال' }}</span>
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.warranties.destroy', $warranty->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.warranties.edit', $warranty->slug) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-pencil"></span> ویرایش
                                    </a>
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این گارانتی اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="5">هیچ گارانتی‌ای یافت نشد!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $warranties->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
