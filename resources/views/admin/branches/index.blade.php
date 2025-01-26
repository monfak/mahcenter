@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">نمایندگی‌ها</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.branches.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن نمایندگی
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>نام نمایندگی</th>
                                <th>نام مدیر</th>
                                <th>آدرس</th>
                                <th>تلفن</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->city->province->name }}</td>
                                <td>{{ $branch->city->name }}</td>
                                <td>
                                    @if($branch->image)
                                        <img src="{{ asset(\App\ImageManager::resize($branch->image, ['width' => 45, 'height' => 45])) }}" alt="{{ $branch->name }}">
                                    @endif
                                    {{ $branch->name }}
                                </td>
                                <td>{{ $branch->moderator }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.branches.destroy', ['id' => $branch->id]) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.branches.edit', ['id' => $branch->id]) }}" class="btn btn-primary btn-xs">
                                            <span class="fa fa-pencil"></span> ویرایش
                                        </a>
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs">
                                            <span class="fa fa-trash"></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $branches->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
