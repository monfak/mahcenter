@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">پلن‌های اقساط</h3>
                    <div class="box-tools">
                        <div class="input-answer input-answer-sm">
                            <a href="{{ route('admin.installments.plans.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> ایجاد پلن ماهیانه
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>ترتیب</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->sort_order }}</td>
                                <td>
                                    <span class="label label-{{ ( $plan->is_active ==1 ? 'success' : 'danger') }}">{{ $plan->is_active ==1 ? 'فعال' : 'غیرفعال' }}</span>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin.installments.plans.destroy', $plan->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.installments.plans.edit', $plan->id) }}">
                                            <span class="fa fa-pencil"></span>
                                            ویرایش
                                        </a>
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs"   onclick="return confirm('آیا از حذف این آیتم اطمینان دارید؟');">
                                            <span class="fa fa-trash"></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5">هیچ پلن اقساطی یافت نشد!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    {{ $plans->links() }}
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
