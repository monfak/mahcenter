@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست اعضای خبرنامه</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.newsletter.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن عضو
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>تاریخ افزودن</th>
                            <th>تاریخ ویرایش</th>
                            <th>نرخ باز کردن</th>
                            <th>نرخ کلیک</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newsletter['members'] as $the_news)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $the_news['merge_fields']['FNAME'] }}</td>
                            <td>{{ $the_news['merge_fields']['LNAME'] }}</td>
                            <td>{{ $the_news['email_address'] }}</td>
                            <td>{{ jdate(strtotime($the_news['timestamp_opt']))->format('d F Y ساعت H:i') }}</td>
                            <td>{{ jdate(strtotime($the_news['last_changed']))->format('d F Y ساعت H:i') }}</td>
                            <td>{{ $the_news['stats']['avg_open_rate'] }}</td>
                            <td>{{ $the_news['stats']['avg_click_rate'] }}</td>
                            <td>
                                <span class="label label-{{ ($the_news['status'] == 'subscribed' ? 'success' : 'warning') }}">{{ ($the_news['status'] == 'subscribed' ? 'مشترک' : 'لغو اشتراک') }}</span>
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.newsletter.destroy', [$the_news['email_address']]) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    {{--<a href="{{ route('admin.newsletter.edit', [$the_news['email_address']]) }}" class="btn btn-primary btn-xs">--}}
                                        {{--<span class="fa fa-pencil"></span> ویرایش--}}
                                    {{--</a>--}}
                                    <button type="submit" name="delete" class="btn btn-danger btn-xs" onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟');">
                                        <span class="fa fa-trash"></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @unless(count($newsletter))
                        <tr class="text-center">
                            <td colspan="5">خبرنامه هنوز هیچ عضوی ندارد!</td>
                        </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
{{--                {{ $newsletter->links() }}--}}
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
