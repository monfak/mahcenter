@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">تولید کننده‌ها</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.manufacturers.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن تولید کننده
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover table-striped table-condensed table-datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام تولیدکننده</th>
                                        <th>لوگو</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($manufacturers as $manufacturer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $manufacturer->name }}</td>
                                        <td>
                                            @if($manufacturer->logo)
                                            <img src="{{ url(image_resize($manufacturer->logo, ['width' => 25, 'height' => 25])) }}" alt="{{ $manufacturer->name }}" class="img-thumbnail">
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="post" class="form-horizontal">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-default btn-xs" href="{{ route('manufacturers.show', $manufacturer->slug) }}">
                                                <span class="fa fa-eye"></span>
                                                مشاهده
                                            </a>
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}">
                                                <span class="fa fa-pencil"></span>
                                                ویرایش
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این تولید کننده اطمینان دارید؟');">
                                                <span class="fa fa-minus"></span>
                                                حذف
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">هیچ تولید کننده‌ای ایجاد نشده است.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               {{-- <div class="box-footer">
                    {{ $manufacturers->links() }}
                </div> --}}
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
