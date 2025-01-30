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
      $(".categories").change(function() {

        var category=$(this).val();
        var quantity=$(".quantity").val();
        $('#products').DataTable().destroy();

        $('#products').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/products/ajax/'+category+'/'+quantity,
            columns: [
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'model', name: 'model'},
                {
                    data: 'stock',
                    name: 'stock',
                    render: function(data, type, row) {
                        return `<span class="editable-stock" data-slug="${row.slug}">${row.stock}</span>`;
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                        let priceHtml = `<span class="editable-price" data-slug="${row.slug}">`;

                        if (row.special && parseFloat(row.special) > 0) {
                            priceHtml += `<del class="text-red price">${formatNumber(row.price)} تومان</del> `;
                            priceHtml += `<ins class="text-green special">${formatNumber(row.special)} تومان</ins>`;
                        } else {
                            priceHtml += `<span class="price">${formatNumber(row.price)} تومان</span>`;
                        }

                        priceHtml += `</span>`;
                        return priceHtml;
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'dev_title', name: 'dev_title', visible: false, orderable: false, searchable: true}
            ],
            stateSave: true,
            "order": [[ 7, "desc" ],[5,'desc']],
            orderMulti: true,
            columnDefs: [
                { targets: [7, 5], orderable: true },
            ],
            "language": {
                "url": "/dashboard/plugins/yajra/i18n/Persian.json"
            },
            "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
            "pagingType": "simple_numbers_no_ellipses"
        });
      });
    $(".quantity").change(function(){

        var quantity=$(this).val();
        var category=$(".categories").val();
        $('#products').DataTable().destroy();

        $('#products').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/products/ajax/'+category+'/'+quantity,
            columns: [
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'model', name: 'model'},
                {
                    data: 'stock',
                    name: 'stock',
                    render: function(data, type, row) {
                        return `<span class="editable-stock" data-slug="${row.slug}">${row.stock}</span>`;
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                        let priceHtml = `<span class="editable-price" data-slug="${row.slug}">`;

                        if (row.special && parseFloat(row.special) > 0) {
                            priceHtml += `<del class="text-red price">${formatNumber(row.price)} تومان</del> `;
                            priceHtml += `<ins class="text-green special">${formatNumber(row.special)} تومان</ins>`;
                        } else {
                            priceHtml += `<span class="price">${formatNumber(row.price)} تومان</span>`;
                        }

                        priceHtml += `</span>`;
                        return priceHtml;
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'dev_title', name: 'dev_title', visible: false, orderable: false, searchable: true}
            ],
            stateSave: true,
            "order": [[ 7, "desc" ]],
            "language": {
                "url": "/dashboard/plugins/yajra/i18n/Persian.json"
            },
            "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
            "pagingType": "simple_numbers_no_ellipses"
        });
      });
    $('#products').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/products/ajax/0/0',
        columns: [
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'model', name: 'model'},
            {
                data: 'stock',
                name: 'stock',
                render: function(data, type, row) {
                    return `<span class="editable-stock" data-slug="${row.slug}">${row.stock}</span>`;
                }
            },
            {
                data: 'price',
                name: 'price',
                render: function(data, type, row) {
                    let priceHtml = `<span class="editable-price" data-slug="${row.slug}">`;

                    if (row.special && parseFloat(row.special) > 0) {
                        priceHtml += `<del class="text-red price">${formatNumber(row.price)} تومان</del> `;
                        priceHtml += `<ins class="text-green special">${formatNumber(row.special)} تومان</ins>`;
                    } else {
                        priceHtml += `<span class="price">${formatNumber(row.price)} تومان</span>`;
                    }

                    priceHtml += `</span>`;
                    return priceHtml;
                }
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'dev_title', name: 'dev_title', visible: false, orderable: false, searchable: true}
        ],
        stateSave: true,
        "order": [[ 7, "desc" ]],
        "language": {
            "url": "/dashboard/plugins/yajra/i18n/Persian.json"
        },
        "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
        "pagingType": "simple_numbers_no_ellipses"
    });

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function removeCommas(num) {
        return num.replace(/,/g, '');
    }

    $('#products').on('dblclick', '.editable-price', function() {
        var span = $(this);
        var slug = span.data('slug');
        var priceValue = span.find('.price').text().replace(/,| تومان/g, '').trim();
        var specialPriceValue = span.find('.special').text().replace(/,|\(|\)| تومان/g, '').trim();

        span.data('original-price', priceValue);
        span.data('original-special-price', specialPriceValue);

        span.html(`
            <input type="text" class="form-control edit-price" value="${formatNumber(priceValue)}" min="0" placeholder="قیمت اصلی">
            <input type="hidden" class="hidden-price" value="${priceValue}">
            <input type="text" class="form-control edit-special-price" value="${formatNumber(specialPriceValue || '')}" min="0" placeholder="قیمت ویژه">
            <input type="hidden" class="hidden-special-price" value="${specialPriceValue || ''}">
            <button class="btn btn-primary btn-xs btn-save-price" data-slug="${slug}">ذخیره</button>
            <button class="btn btn-secondary btn-xs btn-cancel-price">لغو</button>
        `);

        span.find('.edit-price, .edit-special-price').on('input', function() {
            var input = $(this);
            var hiddenInput = input.hasClass('edit-price') ? span.find('.hidden-price') : span.find('.hidden-special-price');
            var value = removeCommas(input.val());

            hiddenInput.val(value);
            input.val(formatNumber(value));
        });
    });

    $('#products').on('click', '.btn-save-price', function() {
        var button = $(this);
        var slug = button.data('slug');
        var span = button.closest('.editable-price');
        var newPrice = removeCommas(span.find('.edit-price').val());
        var newSpecialPrice = removeCommas(span.find('.edit-special-price').val());

        if (newSpecialPrice && parseFloat(newSpecialPrice) >= parseFloat(newPrice)) {
            alert('قیمت ویژه نباید از قیمت اصلی بزرگ‌تر باشد.');
            return;
        }

        $.ajax({
            url: `{{ route('admin.products.updatePrice', ':slug') }}`.replace(':slug', slug),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                price: newPrice,
                special: newSpecialPrice
            },
            success: function(response) {
                if (response.success) {
                    let updatedHtml = newSpecialPrice
                        ? `<del class="text-red price">${formatNumber(newPrice)} تومان</del> <ins class="text-green special">${formatNumber(newSpecialPrice)} تومان</ins>`
                        : `<span class="price">${formatNumber(newPrice)} تومان</span>`;

                    span.html(updatedHtml);
                    iziToast.success({
                        title: 'موفقیت',
                        message: 'قیمت با موفقیت آپدیت شد.',
                        position: 'topLeft'
                    });
                } else {
                    iziToast.error({
                        title: 'خطا',
                        message: 'خطایی در آپدیت قیمت رخ داد!',
                        position: 'topLeft'
                    });
                }
            }
        });
    });

    $('#products').on('click', '.btn-cancel-price', function() {
        var button = $(this);
        var span = button.closest('.editable-price');
        var originalPrice = span.data('original-price');
        var originalSpecialPrice = span.data('original-special-price');

        let restoredHtml = originalSpecialPrice
            ? `<del class="text-red price">${formatNumber(originalPrice)} تومان</del> <ins class="text-green special">${formatNumber(originalSpecialPrice)} تومان</ins>`
            : `<span class="price">${formatNumber(originalPrice)} تومان</span>`;

        span.html(restoredHtml);
    });

    $('#products').on('dblclick', '.editable-stock', function() {
        var span = $(this);
        var slug = span.data('slug');
        var stockValue = span.text().trim();
        span.data('original-stock', stockValue);
        span.html(`
            <input type="number" class="form-control edit-stock" value="${stockValue}" min="0" placeholder="موجودی">
            <button class="btn btn-primary btn-xs btn-save-stock" data-slug="${slug}">ذخیره</button>
            <button class="btn btn-secondary btn-xs btn-cancel-stock">لغو</button>
        `);
    });
    $('#products').on('click', '.btn-save-stock', function() {
        var button = $(this);
        var slug = button.data('slug');
        var span = button.closest('.editable-stock');
        var newStock = span.find('.edit-stock').val();
        $.ajax({
            url: `{{ route('admin.products.updateStock', ':slug') }}`.replace(':slug', slug),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                stock: newStock
            },
            success: function(response) {
                if (response.success) {
                    span.html(newStock);
                    iziToast.success({
                        title: 'موفقیت',
                        message: 'موجودی با موفقیت آپدیت شد.',
                        position: 'topLeft'
                    });
                } else {
                    iziToast.error({
                        title: 'خطا',
                        message: 'خطایی در آپدیت موجودی رخ داد!',
                        position: 'topLeft'
                    });
                }
            }
        })
    ;});
    $('#products').on('click', '.btn-cancel-stock', function() {
        var button = $(this);
        var span = button.closest('.editable-stock');
        var originalStock = span.data('original-stock');
        span.html(originalStock);
    });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           <select class="categories">
                <option value="0">همه دسته بندی ها</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                 </option>
                @endforeach
            </select>

                <select class="quantity">
                <option value="0">همه کالاها</option>
              <option value="1">فقط موجود</option>
              <option value="2">فقط نا موجود</option>

            </select>
            <div class="box-header with-border">
                <h3 class="box-title">لیست محصولات</h3>


                {{ Illuminate\Support\Facades\Log::emergency(session('msg'))}}

                @if (cache('message'))
                <div class="alert">{{  cache('message') }}</div>
                 @endif

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">لیست محصولات</span>
                            </button>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-default btn-sm">
                                <span class="fa fa-plus"></span> افزودن محصول
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('admin.products.import') }}">افزودن گروهی</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.bulk.edit') }}">ویرایش گروهی</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.export') }}">خروجی اکسل</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="products" class="table table-hover">
                    <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>نام محصول</th>
                            <th>مدل</th>
                            <th>موجودی</th>
                            <th>قیمت</th>
                            <th>تاریخ ایجاد</th>
                            <th>تاریخ آپدیت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
