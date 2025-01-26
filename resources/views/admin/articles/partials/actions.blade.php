<form method="post" action="{{ route('admin.articles.destroy', $article->id) }}" style="display: inline-block;">
    @csrf
    @method('DELETE')
    @if($article->status)
    <a href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}" class="btn btn-default btn-xs">
        <span class="fa fa-eye"></span> مشاهده
    </a>
    @else
    <a href="{{ route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug) }}" class="btn btn-default btn-xs">
        <span class="fa fa-eye"></span> پیش نمایش
    </a>
    @endif
    <a href="{{ route('admin.articles.edit', $article->slug) }}" class="btn btn-primary btn-xs">
        <span class="fa fa-pencil"></span> ویرایش
    </a>
    <button type="submit" name="delete" class="btn btn-danger btn-xs">
        <span class="fa fa-trash"></span> حذف
    </button>
</form>