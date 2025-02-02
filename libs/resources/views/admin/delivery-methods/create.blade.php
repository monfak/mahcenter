@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            (function($, undefined) {
                "use strict";
                // When ready.
                $(function() {
                    var $priceMask              = $("#price_mask");
                    var $price                  = $("#price");
                    var $inCityPriceMask        = $("#in_city_price_mask");
                    var $inCityPrice            = $("#in_city_price");
                    var $smallFloorPriceMask    = $("#small_floor_price_mask");
                    var $smallFloorPrice        = $("#small_floor_price");
                    var $bigFloorPriceMask      = $("#big_floor_price_mask");
                    var $bigFloorPrice          = $("#big_floor_price");

                    $priceMask.on("keyup", function(event) {
                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }

                        // When the arrow keys are pressed, abort.
                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }

                        var $this = $(this);

                        // Get the value.
                        var input = $this.val();

                        var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;

                        $this.val(function() {
                            return ( input === 0 ) ? "0" : input.toLocaleString( "en-US" );
                        });

                        var withoutCommas = $priceMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $price.val(withoutCommas);
                    });
                    
                    $inCityPriceMask.on("keyup", function(event) {
                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }

                        // When the arrow keys are pressed, abort.
                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }

                        var $this = $(this);

                        // Get the value.
                        var input = $this.val();

                        var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;

                        $this.val(function() {
                            return ( input === 0 ) ? "0" : input.toLocaleString( "en-US" );
                        });

                        var withoutCommas = $inCityPriceMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $inCityPrice.val(withoutCommas);
                    });
                    
                    $smallFloorPriceMask.on("keyup", function(event) {
                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }

                        // When the arrow keys are pressed, abort.
                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }

                        var $this = $(this);

                        // Get the value.
                        var input = $this.val();

                        var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;

                        $this.val(function() {
                            return ( input === 0 ) ? "0" : input.toLocaleString( "en-US" );
                        });

                        var withoutCommas = $smallFloorPriceMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $smallFloorPrice.val(withoutCommas);
                    });
                    
                    $bigFloorPriceMask.on("keyup", function(event) {
                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if (selection !== '') {
                            return;
                        }

                        // When the arrow keys are pressed, abort.
                        if ($.inArray(event.keyCode, [38,40,37,39]) !== -1) {
                            return;
                        }

                        var $this = $(this);

                        // Get the value.
                        var input = $this.val();

                        var input = input.replace(/[\D\s\._\-]+/g, "");
                        input = input ? parseInt( input, 10 ) : 0;

                        $this.val(function() {
                            return ( input === 0 ) ? "0" : input.toLocaleString( "en-US" );
                        });

                        var withoutCommas = $bigFloorPriceMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $bigFloorPrice.val(withoutCommas);
                    });
                });
            })(jQuery);
        });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن روش ارسال</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.delivery-methods.index') }}" class="btn btn-default btn-sm"> روش‌های ارسال
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="{{ route('admin.delivery-methods.store') }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">نام روش ارسال *</label>
                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-2 control-label">هزینه ارسال</label>
                        <div class="col-md-10">
                            <input type="text" id="price_mask" name="price_mask" class="form-control mask" value="{{ old('price_mask') }}">
                            <input type="hidden" name="price" id="price" class="price" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="in_city_price" class="col-md-2 control-label">هزینه درون شهری</label>
                        <div class="col-md-10">
                            <input type="text" id="in_city_price_mask" name="in_city_price_mask" class="form-control mask" value="{{ old('in_city_price_mask') }}">
                            <input type="hidden" name="in_city_price" id="in_city_price" class="price" value="{{ old('in_city_price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="big_floor_price" class="col-md-2 control-label">هزینه طبقه (درشت)</label>
                        <div class="col-md-10">
                            <input type="text" id="big_floor_price_mask" name="big_floor_price_mask" class="form-control mask" value="{{ old('big_floor_price_mask') }}">
                            <input type="hidden" name="big_floor_price" id="big_floor_price" class="price" value="{{ old('big_floor_price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="small_floor_price" class="col-md-2 control-label">هزینه طبقه (خورده ریز)</label>
                        <div class="col-md-10">
                            <input type="text" id="small_floor_price_mask" name="small_floor_price_mask" class="form-control mask" value="{{ old('small_floor_price_mask') }}">
                            <input type="hidden" name="small_floor_price" id="small_floor_price" class="price" value="{{ old('small_floor_price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-md-2 control-label">توضیحات</label>
                        <div class="col-md-10">
                            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="has_carrige_forward" class="col-md-2 control-label">پس کرایه</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="has_carrige_forward" id="has_carrige_forward" value="1" data-width="125" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-check'></i> دارد" data-off="<i class='fa fa-close'></i> ندارد"{{ old('has_carrige_forward') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_cover_all" class="col-md-2 control-label">پوشش</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="is_cover_all" id="is_cover_all" value="1" data-width="125" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-check'></i> همه شهرها" data-off="<i class='fa fa-close'></i> دارای قیمت"{{ old('is_cover_all') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active" class="col-md-2 control-label">وضعیت</label>
                        <div class="col-md-10">
                            <input type="checkbox" name="is_active" id="is_active" value="1" data-width="125" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close'></i> غیرفعال"{{ old('is_active') ? ' checked' : '' }}>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="افزودن روش ارسال">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
