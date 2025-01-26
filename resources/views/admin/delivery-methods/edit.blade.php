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
                    var $priceMask      = $("#price_mask");
                    var $price          = $("#price");

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
                    <h3 class="box-title">ویرایش روش ارسال</h3>
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
                    <form method="post" action="{{ route('admin.delivery-methods.update', $deliveryMethod->id) }}" role="form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">نام روش ارسال *</label>
                            <div class="col-md-10">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $deliveryMethod->name) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-md-2 control-label">قیمت</label>
                            <div class="col-md-10">
                                <input type="text" id="price_mask" name="price_mask" class="form-control mask" value="{{ old('price_mask', number_format($deliveryMethod->price, 0, '', ',')) }}">
                                <input type="hidden" name="price" id="price" class="price" value="{{ old('price', number_format($deliveryMethod->price, 0, '', '')) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-md-2 control-label">توضیحات</label>
                            <div class="col-md-10">
                                <textarea name="content" id="content" class="form-control tinymce">{!! old('content', $deliveryMethod->content) !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active" class="col-md-2 control-label">وضعیت</label>
                            <div class="col-md-10">
                                <input type="checkbox" name="is_active" id="is_active" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-check'></i> فعال" data-off="<i class='fa fa-close'></i> غیرفعال"{{ old('is_active', $deliveryMethod->is_active) ? ' checked' : '' }}>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="ذخیره تغییرات">
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@endsection
