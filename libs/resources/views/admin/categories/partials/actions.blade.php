<form method="post" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    @can('products-manage')
    <a href="{{ route('admin.products.create', ['category_id' => $category->id]) }}" class="btn btn-default btn-xs">
        <span class="fa fa-plus"></span> افزودن محصول
    </a>
    @endcan
    <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    <button type="submit" name="delete" class="btn btn-danger btn-xs"   onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟');">
        <span class="fa fa-trash"></span> حذف
    </button>
</form>