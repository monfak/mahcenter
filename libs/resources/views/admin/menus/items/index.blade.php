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
        $('#items').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.menus.items.ajax', $menu->id) }}',
                method: 'GET'
            },
            columns: [
                {data: 'heading', name: 'heading'},
                {data: 'label', name: 'label'},
                {data: 'parent', name: 'menu_items.name'},
                {data: 'sort_order', name: 'sort_order'},
                {data: 'is_active', name: 'is_active', orderable: false, searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            //"order": [[ 0, "desc" ]],
            initComplete: function () {
                this.api().columns('.search').every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).addClass('form-control').appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
            "language": {
                "url": "{{ asset('vendor/yajra/i18n/Persian.json') }}"
            },
            "pagingType": "simple_numbers_no_ellipses"
        });
    </script>
@endsection 
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3>آیتم‌های منو {{ $menu->name }}</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <div class="btn-group">
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-default btn-sm"><i class="fa fa-list"></i> منوها</a>
                            <a href="{{ route('admin.menus.items.create', $menu->id) }}" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> افزودن آیتم</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="items" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="search">عنوان</th>
                            <th class="search">لیبل</th>
                            <th class="search">والد</th>
                            <th class="search">ترتیب</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="text" disabled class="form-control"></th>
                            <th><input type="text" disabled class="form-control"></th>
                            <th><input type="text" disabled class="form-control"></th>
                            <th><input type="text" disabled class="form-control"></th>
                            <th><input type="text" disabled class="form-control"></th>
                            <th><input type="text" disabled class="form-control"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection