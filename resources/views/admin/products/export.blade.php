@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="/dashboard/dist/css/persian-datepicker-0.4.5.min.css">
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
    <script src="/dashboard/dist/js/persian-date-0.1.8.min.js"></script>
    <script src="/dashboard/dist/js/persian-datepicker-0.4.5.min.js"></script>
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#special_started_at_datepicker').persianDatepicker({
                initialValue: false,
                altField: '#special_started_at',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    showMeridian: false,
                    timeFormat: 'HH:mm:ss p',
                    enabled: true
                },
            });
            $('#special_ended_at_datepicker').persianDatepicker({
                initialValue: false,
                altField: '#special_ended_at',
                altFormat: 'X',
                format: 'D MMMM YYYY ساعت HH:mm',
                observer: true,
                timePicker: {
                    showMeridian: false,
                    timeFormat: 'HH:mm:ss p',
                    enabled: true
                },
            });
        });
        $(document).ready(function(){
            $('#manufacturers').select2({
                placeholder : 'تولید کننده محصول را انتخاب کنید',
            });
            $('#categories').select2({
                placeholder : 'دسته‌بندی‌ها را انتخاب کنید',
            });
            $('#filters').select2({
                placeholder : 'فیلترها را انتخاب کنید',
            });
        });
        $(document).ready(function(){
            $('#add-image').click(function(e) {
                e.preventDefault();
                $("#clone-image").clone().attr('id', '').appendTo("table.images tbody");
            });
            $('#add-attribute').click(function(e) {
                e.preventDefault();
                $("#clone-attribute").clone().attr('id', '').appendTo("table.attributes tbody");
                $('table .attributes').select2();
            });
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });

            $(document).on('change', '.mainHighlight', function() {
                var supportHighlight = $(this).siblings('.supportHighlight');
                if(this.checked)
                {
                    supportHighlight.removeAttr("checked");
                }
                else
                {
                    supportHighlight.prop("checked", true);
                }
            });
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">خروجی اکسل</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">لیست محصولات
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="get" action="{{ route('admin.products.export.excel') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="form-group">
                            <label for="manufacturer" class="col-md-2 control-label">موجودی</label>
                            <div class="col-md-5">
                                <input type="number" id="min_stock" name="min_stock" class="form-control" placeholder="حداقل">
                            </div>
                            <div class="col-md-5">
                                <input type="number" id="max_stock" name="max_stock" class="form-control" placeholder="حداکثر">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer" class="col-md-2 control-label">قیمت</label>
                            <div class="col-md-5">
                                <input type="number" id="min_price" name="min_price" class="form-control" placeholder="حداقل">
                            </div>
                            <div class="col-md-5">
                                <input type="number" id="max_price" name="max_price" class="form-control" placeholder="حداکثر">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label">وضعیت</label>
                            <div class="col-md-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="">همه</option>
                                    <option value="0">غیرفعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer" class="col-md-2 control-label">تولیدکننده</label>
                            <div class="col-md-10">
                                <select name="manufacturer_id" id="manufacturers" class="form-control">
                                    <option value="">همه تولیدکننده‌ها</option>
                                    @foreach($manufacturers as $key => $manufacturer)
                                        <option value="{{ $key }}"{{ (old('manufacturer_id') == $key ? ' selected' : '') }}>{{ $manufacturer }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.tab-content -->
                    <input type="submit" class="btn btn-primary" value="اکسپورت فایل">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
