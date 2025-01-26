@extends('admin.layouts.app')
@section('scripts')
    <script>
        $(document).ready(function () {
            (function($, undefined) {
                "use strict";
                // When ready.
                $(function() {
                    var $form           = $("#form");
                    var $priceLargeMask = $form.find("#price_large_mask");
                    var $priceSmallMask = $form.find("#price_small_mask");
                    var $priceLarge     = $("#price_large");
                    var $priceSmall     = $("#price_small");

                    $priceLargeMask.on("keyup", function(event) {
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

                        var withoutCommas = $priceLargeMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $priceLarge.val(withoutCommas);
                    });

                    $priceSmallMask.on("keyup", function(event) {
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

                        var withoutCommas = $priceSmallMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $priceSmall.val(withoutCommas);
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
                <h3 class="box-title">افزودن استان</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm">
                        <a href="{{ route('admin.provinces.index') }}" class="btn btn-default btn-sm">لیست استان‌ها
                            <span class="fa fa-arrow-left"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <form method="POST" id="form" action="{{ route('admin.provinces.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">نام استان *</label>
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_large" class="col-md-2 control-label">هزینه ارسال (درشت)</label>
                            <div class="col-md-10">
                                <input type="text" id="price_large_mask" name="price_large_mask" class="form-control mask" value="{{ old('price_large_mask') }}">
                                <input type="hidden" name="price_large" id="price_large" class="price_large" value="{{ old('price_large') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_small" class="col-md-2 control-label">هزینه ارسال (خرده-ریز)</label>
                            <div class="col-md-10">
                                <input type="text" id="price_small_mask" name="price_small_mask" class="form-control mask" value="{{ old('price_small_mask') }}">
                                <input type="hidden" name="price_small" id="price_small" class="price" value="{{ old('price_small') }}">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- /.tab-content -->
                        <input type="submit" class="btn btn-primary" value="افزودن استان">
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
