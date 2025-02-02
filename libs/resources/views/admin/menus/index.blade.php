@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منوها</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.menus.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن منو
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
                            <th>نام منو</th>
                            <th>موقعیت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($menus as $menu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->position }}</td>
                            <td>
                                <span class="label label-{{ ($menu->is_active ? 'success' : 'warning') }}">{{ $menu->is_active ? 'فعال' : 'غیرفعال' }}</span>
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.menus.destroy', $menu->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.menus.items.index', $menu->id) }}" class="btn btn-default btn-xs">
                                        <span class="fa fa-eye"></span> آیتم‌ها
                                    </a>
                                    <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-pencil"></span> ویرایش
                                    </a>
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این منو اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">هیچ منویی یافت نشد!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $menus->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection