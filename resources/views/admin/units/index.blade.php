@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">واحدهای شمارش</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.units.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن واحد شمارش
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام واحد شمارش</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.units.destroy', ['id' => $unit->id]) }}" method="post" class="form-horizontal">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin.units.edit', ['id' => $unit->id]) }}">
                                                <span class="fa fa-pencil"></span>
                                                ویرایش تولید کننده
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این تولید کننده اطمینان دارید؟');">
                                                <span class="fa fa-minus"></span>
                                                حذف تولید کننده
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @unless(count($units))
                                    <tr>
                                        <td colspan="4">هیچ واحد شمارشی ایجاد نشده است.</td>
                                    </tr>
                                @endunless
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    {{ $units->links() }}
                </div>
            </div>
        </section>
        <!-- /.Left col -->
    </div>
@endsection
