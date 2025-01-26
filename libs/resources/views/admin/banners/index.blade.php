@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست بنرها</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن بنر
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام بنر</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $banner->name }}</td>
                            <td><span class="label label-{{ ($banner->status ? 'success' : 'warning') }}">{{ $banner->status ? 'فعال' : 'غیرفعال' }}</span></td>
                            <td>
                                <form method="post" action="{{ route('admin.banners.destroy', $banner->id) }}" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-pencil"></span> ویرایش
                                    </a>
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این بنر اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @unless(count($banners))
                            <tr class="text-center">
                                <td colspan="5">هیچ بنری یافت نشد!</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $banners->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
