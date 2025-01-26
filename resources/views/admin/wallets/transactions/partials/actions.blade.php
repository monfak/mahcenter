<form method="post" action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    @if($paymentMethod->is_removable)
    <button type="submit" name="delete" class="btn btn-danger btn-xs">
        <span class="fa fa-trash"></span> حذف
    </button>
    @endif
</form>