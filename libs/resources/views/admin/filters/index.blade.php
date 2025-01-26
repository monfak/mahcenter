@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">فیلترها</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.filters.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن فیلترها
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed table-datatable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>گروه فیلتر</td>
                                <td>لیبل گروه فیلتر</td>
                                <td>ترتیب</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($filterGroups as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->label }}</td>
                                <td>{{ $group->sort_order }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.filters.destroy', $group->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.filters.edit', $group->id) }}">
                                        <span class="fa fa-pencil"></span>
                                        ویرایش گروه فیلتر
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این فیلتر اطمینان دارید؟');">
                                        <span class="fa fa-minus"></span>
                                        حذف گروه فیلتر
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($filterGroups))
                            <tr class="text-center">
                                <td colspan="4">هیچ فیلتری یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
              {{--  <div class="box-footer clearfix">
                    {{ $filterGroups->links() }}
                </div> --}}
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
