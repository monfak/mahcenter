@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2.min.css') }}">
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
    <script src="{{ asset('js/persian-date.min.js') }}"></script>
    <script src="{{ asset('js/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#start_date_datepicker').persianDatepicker({
                initialValue: false,
                altField: '#start_date',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    // showMeridian: false,
                    timeFormat: 'HH:mm:ss p',
                    enabled: true
                },
            });
            $('#end_date_datepicker').persianDatepicker({
                initialValue: false,
                altField: '#end_date',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    // showMeridian: false,
                    timeFormat: 'HH:mm:ss p',
                    enabled: true
                },
            });
        });
        $(document).ready(function(){
            $('.type_target').select2({
                placeholder : 'انتخاب کنید',
            });
            $('.customers').select2({
                placeholder : 'انتخاب کنید',
            });
        });
    </script>

    <script>
        $('#type').on('change', function (e) {
            let value = this.value;
            $('.type_status').addClass('hide');
            switch (value) {
                case '1' :
                    $('#products').parent().parent().removeClass('hide');
                    break;
                case '2' :
                    $('#categories').parent().parent().removeClass('hide');
                    break;
                case '3' :
                    $('#manufacturers').parent().parent().removeClass('hide');
                    break;
                default :
            }
        });

        $('#users').on('change', function (e) {
            let value = this.value;
            $('.user_target').addClass('hide');
            if(value == '0') {
                $('.customer_target').removeClass('hide');
            } else if(value == '1') {
                $('.golden_target').removeClass('hide');
            } else if(value == '2') {
                $('.silver_target').removeClass('hide');
            } else if(value == '3') {
                $('.bronze_target').removeClass('hide');
            }
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد کد تخفیف</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.discounts.index') }}" class="btn btn-default btn-sm">لیست کدهای تخفیف
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom no-shadow">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab" aria-expanded="true">عمومی</a>
                            </li>
                        </ul>
                        <form method="post" action="{{ route('admin.discounts.store') }}" role="form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div id="tab_general" class="tab-pane active">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">عنوان *</label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="value" class="col-md-2 control-label">درصد تخفیف *</label>
                                        <div class="col-md-10">
                                            <input type="number" min="1" max="99" name="value" id="value" class="form-control" value="{{ old('value') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="col-md-2 control-label">نوع تخفیف</label>
                                        <div class="col-md-10">
                                            <select name="type" id="type" class="form-control">
                                                <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>تمام محصولات</option>
                                                <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>انتخاب محصول</option>
                                                <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>انتخاب دسته‌بندی</option>
                                                <option value="3" {{ old('type') == 3 ? 'selected' : '' }}>انتخاب تولیدکننده</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group type_status {{ old('type') == 1 ? '' : 'hide' }}">
                                        <label for="products" class="col-md-2 control-label">محصولات *</label>
                                        <div class="col-md-10">
                                            <select name="product_id[]" id="products" class="form-control type_target" multiple="multiple">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ (in_array($product->id, old('product_id') ?? []) ? ' selected' : '') }}>{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group type_status {{ old('type') == 2 ? '' : 'hide' }}">
                                        <label for="categories" class="col-md-2 control-label">دسته‌بندی‌ها *</label>
                                        <div class="col-md-10">
                                            <select name="category_id[]" id="categories" class="form-control type_target" multiple="multiple">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ (in_array($category->id, old('category_id') ?? []) ? ' selected' : '') }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group type_status {{ old('type') == 3 ? '' : 'hide' }}">
                                        <label for="manufacturers" class="col-md-2 control-label">تولیدکنندگان *</label>
                                        <div class="col-md-10">
                                            <select name="manufacturer_id[]" id="manufacturers" class="form-control type_target" multiple="multiple">
                                                @foreach($manufacturers as $manufacturer)
                                                    <option value="{{ $manufacturer->id }}" {{ (in_array($manufacturer->id, old('manufacturer_id') ?? []) ? ' selected' : '') }}>{{ $manufacturer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date" class="col-md-2 control-label">تاریخ شروع استفاده *</label>
                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" id="start_date_datepicker" name="start_date_datepicker" class="form-control pull-right" autocomplete="off" value="{{ old('start_date_datepicker') }}">
                                                <input type="hidden" id="start_date" name="start_date" class="form-control pull-right" value="{{ old('start_date') }}">
                                            </div>
                                        </div>
                                        <label for="end_date" class="col-md-2 control-label">تاریخ پایان استفاده *</label>
                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" id="end_date_datepicker" name="end_date_datepicker" class="form-control pull-right" autocomplete="off" value="{{ old('end_date_datepicker') }}">
                                                <input type="hidden" id="end_date" name="end_date" class="form-control pull-right" value="{{ old('end_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="col-md-2 control-label">توضیحات</label>
                                        <div class="col-md-10">
                                            <textarea name="content" id="content" class="form-control tinymce" rows="5">{{ old('content') }}</textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="users" value="0">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="users" class="col-md-2 control-label">کاربران</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <select name="users" id="users" class="form-control">--}}
{{--                                                <option value="0" {{ old('users') == 0 ? 'selected' : '' }}>تمام مشتریان</option>--}}
{{--                                                <option value="1" {{ old('users') == 1 ? 'selected' : '' }}>طلایی</option>--}}
{{--                                                <option value="2" {{ old('users') == 2 ? 'selected' : '' }}>نقره‌ای</option>--}}
{{--                                                <option value="3" {{ old('users') == 3 ? 'selected' : '' }}>برنزی</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group user_target customer_target {{ old('users', 0) == 0 ? '' : 'hide' }}">
                                        <label for="customers" class="col-md-2 control-label">لیست تمام مشتریان</label>
                                        <div class="col-md-10">
                                            <select name="customer_id[]" class="form-control customers" multiple="multiple">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ (in_array($user->id, old('customer_id') ?? []) ? ' selected' : '') }}>{{ $user->first_name. ' '.$user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
{{--                                    <div class="form-group user_target golden_target {{ old('users') == 1 ? '' : 'hide' }}">--}}
{{--                                        <label for="customers" class="col-md-2 control-label">لیست مشتریان طلایی</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <select name="customer_id[]" class="form-control customers" multiple="multiple">--}}
{{--                                                @foreach($goldens as $user)--}}
{{--                                                    <option value="{{ $user->id }}" {{ (in_array($user->id, old('customer_id') ?? []) ? ' selected' : '') }}>{{ $user->first_name. ' '.$user->last_name. '('. $user->mobile.')'. '(امتیاز : '. $user->score.')'  }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group user_target silver_target {{ old('users') == 2 ? '' : 'hide' }}">--}}
{{--                                        <label for="customers" class="col-md-2 control-label">لیست مشتریان نقره‌ای</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <select name="customer_id[]" class="form-control customers" multiple="multiple">--}}
{{--                                                @foreach($silvers as $user)--}}
{{--                                                    <option value="{{ $user->id }}" {{ (in_array($user->id, old('customer_id') ?? []) ? ' selected' : '') }}>{{ $user->first_name. ' '.$user->last_name. '('. $user->mobile.')'. '(امتیاز : '. $user->score.')'  }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group user_target bronze_target {{ old('users') == 3 ? '' : 'hide' }}">--}}
{{--                                        <label for="customers" class="col-md-2 control-label">لیست مشتریان برنزی</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <select name="customer_id[]" class="form-control customers" multiple="multiple">--}}
{{--                                                @foreach($bronzes as $user)--}}
{{--                                                    <option value="{{ $user->id }}" {{ (in_array($user->id, old('customer_id') ?? []) ? ' selected' : '') }}>{{ $user->first_name. ' '.$user->last_name. '('. $user->mobile.')'. '(امتیاز : '. $user->score.')'  }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="raw">
                                        <div class="col-md-8 col-md-offset-2"><small>* برای انتخاب همه، کاربری انتخاب نشود</small></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="ارسال کدهای تخفیف">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
