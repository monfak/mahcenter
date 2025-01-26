@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="/dashboard/dist/css/persian-datepicker-0.4.5.min.css">
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/persian-date-0.1.8.min.js"></script>
    <script src="/dashboard/dist/js/persian-datepicker-0.4.5.min.js"></script>
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#specific_date_datepicker').persianDatepicker({
                initialValue: false,
                altField: '#specific_date',
                altFormat: 'X',
                format: 'D MMMM YYYY',
                observer: true,
                timePicker: {
                    showMeridian: false,
                    enabled: false
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajaxUpdate').click(function (event) {
                event.preventDefault();
                var cities = [];
                $('.city:checked').each(function() {
                    cities.push($(this).val());
                });

                var date = $('#specific_date').val();

                var price = $('#price').val();

                $.ajax({
                    type: 'PATCH',
                    url: "{{ route('admin.deliveries.update', ['id' => $province->id]) }}",
                    data: {
                        'cities': cities,
                        'date': date,
                        'price': price,
                        'get': 0,
                        _method: "PATCH",
                    },
                    success: function(data) {
                        $('#processing-modal').modal('hide');
                        iziToast.success({
                            title: 'موفقیت',
                            message: 'تغییرات با موفقیت ذخیره شدند',
                            'position': 'topLeft'
                        });
                    },
                    error: function (e) {
                        iziToast.danger({
                            title: 'شکست',
                            message: 'متاسفانه تغییرات اعمال نشدند',
                            'position': 'topLeft'
                        });
                    }
                });
            });
            $('#specific_date').change(function () {
                $('#processing-modal').modal('show')
                var cities = [];
                $('.city:checked').each(function() {
                    cities.push($(this).val());
                });

                var date = $('#specific_date').val();

                var price = $('#price').val();

                $.ajax({
                    type: 'PATCH',
                    url: "{{ route('admin.deliveries.update', ['id' => $province->id]) }}",
                    data: {
                        'cities': cities,
                        'date': date,
                        'price': price,
                        'get': 1,
                        _method: "PATCH",
                    },
                    success: function(data) {
                        console.log(data);
                        $('.city:checked').prop('checked', false).change();
                        for (i = 0; i < data.length; i++) {
                            $('#shipping'+data[i]).prop('checked', true).change();
                        }
                        $('#processing-modal').modal('hide');
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش سیستم حمل و نقل استان {{ $province->name }}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.deliveries.index') }}" class="btn btn-default btn-sm">لیست استان‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom no-shadow">
                        <div class="form-group">
                            <label for="price" class="col-md-2 control-label">هزینه حمل و نقل استانی</label>
                            <div class="col-md-3">
                                <input name="price" id="price" class="form-control" value="{{ old('price', number_format($province->price, 0, '', '')) }}">
                            </div>
                            <label for="special_started_at" class="col-md-2 control-label">تاریخ ارسال</label>
                            <div class="col-md-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="specific_date_datepicker" name="specific_date_datepicker" class="form-control pull-right" value="{{ old('specific_date_datepicker') }}">
                                    <input type="hidden" id="specific_date" name="specific_date" class="form-control" value="{{ old('specific_date') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button id="ajaxUpdate" class="btn btn-primary pull-right" type="button"  data-toggle="modal" data-target="#processing-modal">
                                    <span></span> ذخیره تغییرات
                                </button>
                            </div>
                        </div>
                        <hr>
                        <h3>شهرها</h3>
                        <table class="table table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام شهر</th>
                                    <th>وضعیت ارسال</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($province->cities as $city)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <label for="shipping{{ $city->id }}" class="control-label">{{ $city->name }}</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="shipping[{{ $city->id }}]" id="shipping{{ $city->id }}" value="{{ $city->id }}" class="city"  data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-truck'></i> ارسال داریم" data-off="<i class='fa fa-map-signs text-red'></i> ارسال نداریم"{{ (in_array($city->id, $cities) ? ' checked' : '') }}>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@endsection
