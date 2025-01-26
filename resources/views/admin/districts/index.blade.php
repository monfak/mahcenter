@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="/dashboard/dist/css/dataTables.bootstrap.min.css">
@endsection
@section('scripts')
    <script src="/dashboard/plugins/yajra/js/jquery.dataTables.min.js"></script>
    <script src="/dashboard/plugins/yajra/js/datatables.bootstrap.js"></script>
    <script src="/dashboard/plugins/yajra/js/simple_numbers_no_ellipses.js"></script>
    <script type="text/javascript">
        $.fn.DataTable.ext.pager.simple_numbers_no_ellipses = function(page, pages){
            var numbers = [];
            var buttons = $.fn.DataTable.ext.pager.numbers_length;
            var half = Math.floor( buttons / 2 );

            var _range = function ( len, start ){
                var end;

                if ( typeof start === "undefined" ){
                    start = 0;
                    end = len;

                } else {
                    end = start;
                    start = len;
                }

                var out = [];
                for ( var i = start ; i < end; i++ ){ out.push(i); }

                return out;
            };


            if ( pages <= buttons ) {
                numbers = _range( 0, pages );

            } else if ( page <= half ) {
                numbers = _range( 0, buttons);

            } else if ( page >= pages - 1 - half ) {
                numbers = _range( pages - buttons, pages );

            } else {
                numbers = _range( page - half, page + half + 1);
            }

            numbers.DT_el = 'span';

            return [ 'previous', numbers, 'next' ];
        };
    </script>
    <script type="text/javascript">
    $('#districts').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/districts/ajax',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'city', name: 'city.name'},
            {data: 'price_large', name: 'price_large'},
            {data: 'price_small', name: 'price_small'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ],
        stateSave: true,
        "order": [[ 3, "desc" ]],
        "language": {
            "url": "/dashboard/plugins/yajra/i18n/Persian.json"
        },
        "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
        "pagingType": "simple_numbers_no_ellipses"
    });
    </script>
@endsection 
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست محله‌ها</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.districts.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن محله
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="districts" class="table table-hover">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>شهر</th>
                            <th>هزینه ارسال (درشت)</th>
                            <th>هزینه ارسال (خورده-ریز)</th>
                            <th>تاریخ آپدیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix"></div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
