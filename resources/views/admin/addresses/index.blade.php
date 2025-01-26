@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">آدرس‌های {{ $user->name }}</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.users.addresses.create', $user->id) }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن آدرس
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان آدرس</th>
                                <th>تلفن</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>کدپستی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $address->name }}
                                    @if($address->is_default)
                                    <span class="label label-success">پیش فرض</span>
                                    @endif
                                </td>
                                <td>{{ $address->phone }}</td>
                                <td>{{ $address->city->province->name }}</td>
                                <td>{{ $address->city->name }}</td>
                                <td>{{ $address->post_code }}</td>
                                <td>
                                    <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.addresses.edit', $address->id) }}">
                                            <span class="fa fa-pencil"></span>
                                            ویرایش
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این آدرس اطمینان دارید؟');">
                                            <span class="fa fa-user-times"></span>
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
               <div class="box-footer clearfix">
                      {{ $addresses->links() }}
                      
                </div> 
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
