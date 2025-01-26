@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویژگی‌ها</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.attributes.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن ویژگی‌ها
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed table-datatable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>نام گروه ویژگی</td>
                                <td>ترتیب</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($attributeGroups as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->sort_order }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.attributes.destroy', $group->id) }}" class="form-horizontal">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.attributes.edit', $group->id) }}">
                                            <span class="fa fa-pencil"></span>
                                            ویرایش گروه
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این ویژگی اطمینان دارید؟');">
                                            <span class="fa fa-minus"></span>
                                            حذف گروه
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($attributeGroups))
                            <tr class="text-center">
                                <td colspan="4">هیچ ویژگی‌ای یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
               {{-- <div class="box-footer clearfix">
                    {{ $attributeGroups->links() }}
                </div> --}}
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
