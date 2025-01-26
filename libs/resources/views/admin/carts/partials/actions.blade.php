<form action="{{ route('admin.carts.destroy', $cart->id) }}" method="post">
    @csrf
    @method('delete')
    <a class="btn btn-default btn-xs" href="{{ route('admin.carts.show', $cart->id) }}">
        <span class="fa fa-eye"></span>
        مشاهده
    </a>
    <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این سبد خرید اطمینان دارید؟');">
        <span class="fa fa-close"></span>
        حذف
    </button>
</form>
