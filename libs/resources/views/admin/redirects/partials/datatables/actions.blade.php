<form method="post" action="{{ route('admin.redirects.destroy', $redirect->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <a href="{{ route('admin.redirects.edit', $redirect->id) }}" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این ریدایرکت اطمینان دارید؟');">
        <span class="fa fa-trash"></span> حذف
    </button>
</form>