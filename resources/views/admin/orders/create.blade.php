@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="/dashboard/plugins/select2/select2.min.css">
    <style>
        .select2-selection__choice {
            color: #666 !important;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-search__field {
            width: 100% !important;
        }
    </style>
@endsection
@section('scripts')
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#user_id').select2({
                placeholder : 'خریدار را انتخاب کنید',
            });
            $('#product_id').select2({
                placeholder : 'محصول را انتخاب کنید',
            });

            $('#user_id').on('change', function() {
                $('#user-name').html($(this).find(':selected').attr('data-name'));
                $('#user-email').html($(this).find(':selected').attr('data-email'));
                $('#user-mobile').html($(this).find(':selected').attr('data-mobile'));
                $('#user-nid').html($(this).find(':selected').attr('data-nid'));
                var userId = $(this).find(':selected').val();
                
                $.ajax({
                    type: 'GET',
                    url: "/admin/users/" + userId + "/addresses",
                    success: function(response) {
                        if(response.status == 'success') {
                            $('#address_id').html('<option value="">آدرس را انتخاب کنید</option>');
                            $.each(response.addresses, function (index, address) {
                                $('#address_id').append('<option value="' + address.id + '" data-city="' + address.city.name + '" data-province="' + address.city.province.name + '" data-postal_code="' + address.post_code + '" data-address="' + address.address + '" data-phone="' + address.phone + '">' + address.name + '</option>');
                            });
                            iziToast.success({
                                message: response.body,
                                position: 'topLeft'
                            });
                        } else {
                            iziToast.error({
                                message: response.body,
                                position: 'topLeft'
                            });
                        }
                    },
                    error: function() {
                        Toast.fire({
                            icon: 'error',
                            title: 'متاسفانه مشکلی در دریافت آدرس‌های کاربر رخ داد.'
                        });
                    }
                });
            });

            $('#address_id').on('change', function() {
                var selectedAddress = $(this).find(':selected');
                $('#address-province').text(selectedAddress.data('province'));
                $('#address-city').text(selectedAddress.data('city'));
                $('#address-postal_code').text(selectedAddress.data('postal_code'));
                $('#address-details').text(selectedAddress.data('address'));
                $('#address-phone').text(selectedAddress.data('phone'));
            });
            
            $('#cash_on_delivery').on('change', function() {
                $('#order-cash-on-delivery').text($(this).find(':selected').text());
            });
            $('#status').on('change', function() {
                var label = $(this).find(':selected').attr('data-label');
                var txt = $(this).find(':selected').text();
                $('#order-status').html('<span class="label label-' + label + '">' + txt + '</span>');
            });
            $(document).on('click', '#add-product', function(e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                var product = $('#product_id').find(':selected');
                var name = product.text();
                var price = product.attr('data-price');
                var clone = $("#clone-product").clone();
                clone.find('.product-name').html(name);
                clone.find('.product-quantity').html(quantity);
                clone.find('.product-price').html(price);
                clone.find('.product-id').html(product.val());
                clone.find('.product-quantity').val(quantity);
                clone.attr('id', '').appendTo("#products tbody");
            });
            
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                این صفحه هنوز کامل نشده لطفا سفارشی از طریق آن ثبت نکنید.
            </div>
            <form method="post" action="{{ route('admin.orders.store') }}" role="form" class="form-horizontal">
                @csrf
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ثبت سفارش</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm">لیست سفارش‌ها
                                    <span class="fa fa-arrow-left"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>کاربر</th>
                                    <th>آدرس</th>
                                    <th>نوع پرداخت</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="user_id" name="user_id" required>
                                            <option>جستجوی کاربر</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" data-name="{{ $user->name }}" data-mobile="{{ $user->mobile }}" data-email="{{ $user->email }}" data-nid="{{ $user->national_code }}">{{ $user->name }} ({{ $user->mobile }} - {{ $user->email }} - {{ $user->national_code }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="address_id" name="address_id" required>
                                            <option>لطفا ابتدا کاربر را انتخاب کنید</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="cash_on_delivery" name="cash_on_delivery" required>
                                            <option>پرداخت آنلاین</option>
                                            <option>پرداخت در محل تهران</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="0" data-label="danger">منقضی شده</option>
                                            <option value="1" data-label="warning" selected>در حال بررسی (منتظر پرداخت)</option>
                                            <option value="2" data-label="success">پرداخت شده (در حال ارسال)</option>
                                            <option value="3" data-label="primary">ارسال شده</option>
                                            <option value="4" data-label="warning">بازگشت خورده</option>
                                            <option value="5" data-label="success">کامل شده</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>محصول</th>
                                    <th>تعداد</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="product_id">
                                            <option>جستجوی محصول</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ number_format($product->special ?? $product->price, 0) }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" id="quantity" class="form-control" style="width: 80px" value="1">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-xs" id="add-product">
                                            افزودن
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>نام کاربر</th>
                                    <th>موبایل</th>
                                    <th>ایمیل</th>
                                    <th>کد ملی</th>
                                    <th>نوع پرداخت</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="user-name"></td>
                                    <td id="user-mobile"></td>
                                    <td id="user-email"></td>
                                    <td id="user-nid"></td>
                                    <td id="order-cash-on-delivery">پرداخت آنلاین</td>
                                    <td id="order-status">
                                        <span class="label label-warning">در حال بررسی (منتظر پرداخت)</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h4>لیست محصولات</h4>
                        <table id="products" class="table table-hover table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center r-tblle">نام محصول</th>
                                    <th class="text-center r-tblle">تعداد</th>
                                    <th class="text-center r-tblle">قیمت</th>
                                    <th class="text-center r-tblle">قیمت کل </th>
                                    <th class="text-center r-tblle">عملیات</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <hr>
                        <div class="well">
                            <h4>آدرس:</h4>
                            <p>
                                <strong>استان:</strong>
                                <span id="address-province"></span>
                                <br>
                                <strong>شهر:</strong>
                                <span id="address-city"></span>
                                <br>
                                <strong>کد پستی:</strong>
                                <span id="address-postal_code"></span>
                                <br>
                                <strong>آدرس:</strong>
                                <span id="address-details"></span>
                                <br>
                                <strong>تلفن:</strong>
                                <span id="address-phone"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">ثبت سفارش</button>
            </form>
        </div>
    </div>
    <table class="hide">
        <tbody>
            <tr id="clone-product">
                <td>
                    <input type="hidden" name="product[]" class="product-id">
                    <input type="hidden" name="quantity[]" class="product-quantity">
                    <span class="product-name"></span>
                </td>
                <td class="product-quantity"></td>
                <td class="product-special"></td>
                <td class="product-discount"></td>
                <td class="product-price"></td>
                <td class="product-total-price"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs remove-item">
                        <span class="fa fa-trash"></span> حذف
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection