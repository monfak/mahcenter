@extends('admin.layouts.app')
@section('styles')
    <style>
        .table-responsive {
            overflow-x: hidden;
        }
    </style>
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
        $('#carts').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.carts.index') }}',
            columns: [
                {data: 'name', name: 'user.name'},
                {data: 'session_id', name: 'session_id'},
                {data: 'mobile', name: 'mobile'},
                {data: 'products', name: 'products', orderable: false, searchable: false},
                {data: 'total_price', name: 'total_price', searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'updated_at', name: 'updated_at', searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            "order": [[ 6, "desc" ]],
            "language": {
                "url": "/dashboard/plugins/yajra/i18n/Persian.json"
            },
            "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
            "pagingType": "simple_numbers_no_ellipses"
        });
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">لیست سبدهای خرید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="carts" class="table table-hover">
                    <thead>
                        <th>نام کاربر</th>
                        <th>سشن</th>
                        <th>موبایل</th>
                        <th>محصولات</th>
                        <th>جمع کل</th>
                        <th>تاریخ ثبت سفارش</th>
                        <th>تاریخ آخرین ویرایش</th>
                        <th>عملیات</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
