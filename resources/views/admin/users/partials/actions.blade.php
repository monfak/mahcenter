<form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
    @csrf
    @method('delete')
    @can('logs-manage')
    <a class="btn btn-info btn-xs" href="{{ route('admin.users.logs', $user->id) }}">
        <span class="fa fa-history"></span>
        لاگ‌ها
    </a>
    @endcan
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