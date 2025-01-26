@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">اقساط پیش پرداخت</h3>
                    <div class="box-tools">
                        <div class="input-answer input-answer-sm">
                            <a href="{{ route('admin.settings.installment.percent.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> ایجاد اقساط پیش پرداخت
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td> پیش پرداخت</td>
                            <td>وضعیت</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($percents as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->percent }} "درصد " </td>
                                <td>
                                    <span class="label label-{{ ( $item->is_active ==1 ? 'success' : 'danger') }}">{{ $item->is_active ==1 ? 'فعال' : 'غیرفعال' }}</span>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.settings.installment.percent.delete', ['id' => $item->id]) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs"   onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @unless(count($percents))
                            <tr class="text-center">
                                <td colspan="5">هیچ اقساط پیش پرداخت  یافت نشد!</td>
                            </tr>
                        @endunless
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $percents->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
