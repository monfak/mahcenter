@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست صفحات</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن صفحه
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
                            <th>عنوان</th>
                            <th>نویسنده</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->user->name }}</td>
                            <td>
                                <span class="label label-{{ ($page->status ? 'success' : 'warning') }}">{{ $page->status ? 'منتشر شده' : 'پیش‌نویس' }}</span>
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.pages.destroy', $page->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    @if($page->status)
                                    <a href="{{ route('page.show', $page->slug) }}" class="btn btn-default btn-xs">
                                        <span class="fa fa-eye"></span> مشاهده
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.pages.edit', $page->slug) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-pencil"></span> ویرایش
                                    </a>
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این صفحه اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @unless(count($pages))
                        <tr class="text-center">
                            <td colspan="5">هیچ صفحه‌ای یافت نشد!</td>
                        </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $pages->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
