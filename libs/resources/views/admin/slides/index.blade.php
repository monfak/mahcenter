@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">اسلایدر</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.slides.create') }}" class="btn btn-default btn-sm">افزودن اسلایدها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>تصویر</th>
                            <th>متن جایگزین</th>
                            <th>ترتیب</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slide->heading }}</td>
                            <td><img src="{{ asset(image_resize($slide->image, ['width' => 40, 'height' => 40], $slide->image_id)) }}"></td>
                            <td>{{ $slide->alt }}</td>
                            <td>{{ $slide->sort_order }}</td>
                            <td>
                                <span class="label label-{{ ($slide->is_active ? 'success' : 'warning') }}">{{ $slide->is_active ? 'فعال' : 'غیرفعال' }}</span>
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.slides.destroy', $slide->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.slides.edit', $slide->id) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-pencil"></span> ویرایش
                                    </a>
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این اسلاید اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7">هیچ اسلایدی یافت نشد!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $slides->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection