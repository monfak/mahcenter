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
                    <h3 class="box-title">ایجاداقساط پیش پرداخت</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.settings.installment.percent.index') }}" class="btn btn-default btn-sm">لیست اقساط پیش پرداخت
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom no-shadow">

                        <form method="post" action="{{ route('admin.settings.installment.percent.store') }}" role="form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div id="tab_general" class="tab-pane active">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">درصد </label>
                                        <div class="col-md-5">
                                            <input type="number" name="percent" id="title" class="form-control" value="{{ old('percent') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active" class="col-md-2 control-label">فعال</label>
                                        <div class="col-md-5">
                                            <select name="is_active" id="is_active" class="form-control">
                                                <option value="0"{{ (old('is_active') == 0 ? 'selected' : '') }}>غیرفعال</option>
                                                <option value="1"{{ (old('is_active') == 1 ? 'selected' : '') }} >فعال</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-10">
                                           <input type="submit" class="btn btn-primary" value="ثبت اطلاعات">
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
