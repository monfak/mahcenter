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
        $('#delivery-methods').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/delivery-methods',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            "order": [[ 0, "asc" ]],
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
                <h3 class="box-title">روش‌های ارسال</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.delivery-methods.create') }}" class="btn btn-default btn-sm">
                            <span class="fa fa-plus"></span> افزودن روش ارسال
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="delivery-methods" class="table table-hover">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>هزینه ارسال</th>
                            <th>وضعیت</th>
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
