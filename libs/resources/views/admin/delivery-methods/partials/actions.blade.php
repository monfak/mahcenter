<form method="post" action="{{ route('admin.delivery-methods.destroy', $deliveryMethod->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <a href="{{ route('admin.delivery-methods.edit', $deliveryMethod->id) }}" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این روش ارسال اطمینان دارید؟');">
        <span class="fa fa-trash"></span> حذف
    </button>
</form>