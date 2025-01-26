@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">کد تخفیف</h3>
                    <div class="box-tools">
                        <div class="input-answer input-answer-sm">
                            <a href="{{ route('admin.discounts.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> ایجاد کد تخفیف
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>عنوان</td>
                                <td>درصد</td>
                                <td>وضعیت</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $discount->title }}</td>
                                <td>{{ $discount->value }}</td>
                                <td>
                                    <span class="label label-{{ ($discount->end_date - time() >=0 ? 'success' : 'warning') }}">{{ $discount->end_date - time() >=0  ? 'فعال' : 'غیرفعال' }}</span>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.discounts.destroy', $discount) }}" class="form-horizontal">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-default btn-xs" href="{{ route('discounts.show', $discount) }}" target="_blank">
                                            <span class="fa fa-eye"></span>
                                            مشاهده
                                        </a>
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.discounts.export', $discount) }}" target="_blank">
                                            <span class="fa fa-download"></span>
                                            دانلود اکسل
                                        </a>
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.discounts.edit', $discount->id) }}" target="_blank">
                                            <span class="fa fa-pencil"></span>
                                            ویرایش
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="1" onclick="return confirm('آیا از حذف این جشنواره اطمینان دارید؟');">
                                            <span class="fa fa-minus"></span>
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($discounts))
                            <tr class="text-center">
                                <td colspan="5">هیچ کد تخفیفی یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $discounts->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
