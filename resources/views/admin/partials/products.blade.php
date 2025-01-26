<form method="post" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    @if($product->status)
    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-default btn-xs">
        <span class="fa fa-eye"></span>-
    </a>
    @endif
    @can('logs-manage')
    <a class="btn btn-info btn-xs" href="{{ route('admin.products.logs', $product->slug) }}">
        <span class="fa fa-history"></span>
        لاگ‌ها
    </a>
    @endcan
    <a href="{{ route('admin.products.clone', $product->slug) }}" class="btn btn-warning btn-xs">
        <span class="fa fa-clone"></span> کلون
    </a>
    <a href="{{ route('admin.products.edit', $product->slug) }}?<?php echo rand();?>" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    <button type="submit" name="delete" class="btn btn-danger btn-xs"  onclick="return confirm('آیا از حذف این محصول اطمینان دارید؟');">
        <span class="fa fa-trash"></span> حذف
    </button>
</form>