@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">اقساط ماهیانه</h3>
                    <div class="box-tools">
                        <div class="input-answer input-answer-sm">
                            <a href="{{ route('admin.settings.installment.month.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> ایجاد اقساط ماهیانه
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td> ماهیانه</td>
                            <td>وضعیت</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($months as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->month }} "ماه" </td>
                                <td>
                                    <span class="label label-{{ ( $item->is_active ==1 ? 'success' : 'danger') }}">{{ $item->is_active ==1 ? 'فعال' : 'غیرفعال' }}</span>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.settings.installment.month.delete', ['id' => $item->id]) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs"   onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($months))
                            <tr class="text-center">
                                <td colspan="5">هیچ  اقساط ماهیانه یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $months->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
