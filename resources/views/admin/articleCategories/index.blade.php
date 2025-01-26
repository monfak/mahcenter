@extends('admin.layouts.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">لیست دسته بندی ها</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm">
                                <a href="{{route('admin.article_category.create')}}" class="btn btn-default btn-xs">
                                    <span class="fa fa-plus"></span>
                                    افزودن دسته بندی
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                           <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام دسته بندی</th>
                                    <th>عملیات</th>
                                 </tr>
                            </thead>
                           <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <form
                                                action="{{route('admin.article_category.destroy', $category->id)}}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('admin.article_category.edit', $category->id)}}"
                                                   class="btn btn-primary btn-xs">
                                                    <i class="fa fa-pencil"></i>
                                                    ویرایش
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" name="delete"
                                                        value="1"
                                                        onclick="return confirm('آیا از حذف این دسته بندی اطمینان دارید؟');">
                                                    <span class="fa fa-minus"></span>
                                                    حذف
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                              @unless(count($categories))
                                    <tr class="text-center">
                                        <td colspan="4">هیچ دسته بندی یافت نشد!</td>
                                    </tr>
                                @endunless
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
