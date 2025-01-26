@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">نقش‌های کاربری</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-default btn-sm">ایجاد نقش کاربری</a>
                    </div>
                </div>
                <div class="content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام نمایشی</th>
                                <th>تعداد اعضا</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->users_count }}</td>
                                    <td>
                                        <form method="post" action="{{ route('admin.roles.destroy', $role->id) }}" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            @can('permissions-assign')
                                            <a href="{{ route('admin.permissions.edit', $role->id) }}" class="btn btn-default btn-xs">
                                                <span class="fa fa-key"></span> تخصیص دسترسی
                                            </a>
                                            @endcan
                                            @can('users-manage')
                                            <a href="{{ route('admin.roles.users', $role->id) }}" class="btn btn-warning btn-xs">
                                                <span class="fa fa-users"></span>
                                                کاربران
                                            </a>
                                            @endcan
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-xs">
                                                <span class="fa fa-pencil"></span> ویرایش
                                            </a>
                                            @if($role->is_deletable)
                                            <button type="submit" name="delete" class="btn btn-danger btn-xs">
                                                <span class="fa fa-trash"></span> حذف
                                            </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">هیچ گروه کاربری یافت نشد!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
