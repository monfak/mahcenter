<form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
    @csrf
    @method('delete')
    <a class="btn btn-primary btn-xs" href="{{ route('admin.users.addresses.index', $user->id) }}">
        <span class="fa fa-sign"></span>
        آدرس‌ها
    </a>
    <a class="btn btn-primary btn-xs" href="{{ route('admin.users.edit', $user->id) }}">
        <span class="fa fa-pencil"></span>
        ویرایش
    </a>
    <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این سفارش اطمینان دارید؟');">
        <span class="fa fa-close"></span>
        حذف
    </button>
</form>
