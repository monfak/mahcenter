@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        اعضای گروه کاربری 
                        «{{ $role->display_name }}»
                    </h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-block">بازگشت به لیست</a>
                    </div>
                </div>
                <div class="content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>موبایل</th>
                                    <th>گروه کاربری</th>
                                    <th>موجودی کیف پول</th>
                                    <th>تاریخ ثبت نام</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>
                                        @forelse($user->roles as $role)
                                        <span class="badge bg-aqua">{{ $role->display_name }}</span>
                                        @empty
                                        <span class="badge bg-aqua">مشتری</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        {{ number_format($role->wallet, 0) }}
                                        تومان
                                    </td>
                                    <td>{{ jdate($user->created_at)->format('d F Y ساعت H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-default btn-xs" href="{{ route('admin.users.addresses.index', $user->id) }}">
                                                <span class="fa fa-map"></span>
                                                آدرس‌ها
                                            </a>
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin.users.edit', $user->id) }}">
                                                <span class="fa fa-pencil"></span>
                                                ویرایش
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟');">
                                                <span class="fa fa-user-times"></span>
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">هیچ کاربری عضو این گروه کاربری نیست!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection