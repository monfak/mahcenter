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
        $('#logs').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/products/{{ $product->slug }}/logs',
            columns: [
                {data: 'log_name', name: 'log_name'},
                {data: 'description', name: 'description'},
                {data: 'causer', name: 'causer'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            "order": [[ 4, "desc" ]],
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
                <h3 class="box-title">لاگ‌های {{ $product->name }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="logs" class="table table-hover">
                    <thead>
                        <tr>
                            <th>نام لاگ</th>
                            <th>توضیحات</th>
                            <th>ایجادکننده</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection