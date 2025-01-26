<form action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
    @csrf
    @method('delete')
    <a class="btn btn-primary btn-xs" href="{{ route('admin.orders.edit', $order->id) }}">
        <span class="fa fa-pencil-alt"></span>
        ویرایش
    </a>
    <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این سفارش اطمینان دارید؟');">
        <span class="fa fa-close"></span>
        حذف
    </button>
</form>
