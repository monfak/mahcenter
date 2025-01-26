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
                    <h3 class="box-title">ویرایش استان</h3>
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
                        <form method="POST" action="{{ route('admin.provinces.update', $province->id) }}" id="form" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PATCH')
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label mt-2">نام استان</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $province->name) }}" placeholder="عنوان محصول را وارد کنید" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_large" class="col-md-2 control-label mt-2">هزینه ارسال (درشت)</label>
                                    <div class="col-md-10">
                                        <input type="text" id="price_large_mask" name="price_large_mask" class="form-control mask" value="{{ old('price_large_mask', number_format($province->price_large, 0, '', ',')) }}">
                                        <input type="hidden" name="price_large" id="price_large" class="price_large" value="{{ old('price_large', number_format($province->price_large, 0, '', '')) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_small" class="col-md-2 control-label mt-2">هزینه ارسال (خورده-ریز)</label>
                                    <div class="col-md-10">
                                        <input type="text" id="price_small_mask" name="price_small_mask" class="form-control mask" value="{{ old('price_small_mask', number_format($province->price_small, 0, '', ',')) }}">
                                        <input type="hidden" name="price_small" id="price_small" class="price_small" value="{{ old('price_small', number_format($province->price_small, 0, '', '')) }}">
                                    </div>
                                </div>
                            <div class="clearfix"></div>
                            <!-- /.tab-content -->
                            <input type="submit" class="btn btn-primary mt-2" value="ذخیره تغییرات">
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
