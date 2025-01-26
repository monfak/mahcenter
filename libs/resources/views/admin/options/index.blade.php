@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">گزینه‌ها</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            {{ $options->links() }}
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
                                        <th>گزینه</th>
                                        <th>ترتیب</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($options as $option)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $option->name }}</td>
                                        <td>{{ $option->sort_order }}</td>
                                        <td>
                                            <form action="{{ route('admin.options.destroy', $option->id) }}" method="post" class="form-horizontal">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-primary btn-xs" href="{{ route('admin.options.edit', $option->id) }}">
                                                    <span class="fa fa-pencil"></span>
                                                    ویرایش گزینه
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این گزینه اطمینان دارید؟');">
                                                    <span class="fa fa-minus"></span>
                                                    حذف گزینه
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('admin.options.create') }}" class="btn btn-default btn-sm">
                        <span class="fa fa-plus"></span>
                        افزودن گزینه
                    </a>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
