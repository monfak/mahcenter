@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
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
        .mt-2 {
            margin-top: 10px;
        }
    </style>
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
    <script src="/dashboard/dist/js/persian-date-0.1.8.min.js"></script>
    <script src="/dashboard/dist/js/persian-datepicker-0.4.5.min.js"></script>
    <script src="/dashboard/plugins/select2/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.attr').select2();
            $('#manufacturers').select2({
                placeholder : 'تولید کننده محصول را انتخاب کنید',
            });
            $('#categories').select2({
                placeholder : 'دسته‌بندی‌ها را انتخاب کنید',
            });
            $('#filters').select2({
                placeholder : 'فیلترها را انتخاب کنید',
            });
            $('#warranties').select2({
                placeholder : 'گارانتی‌ها را انتخاب کنید',
            });
            $('#products').select2({
                placeholder : 'محصول را انتخاب کنید',
            });
            $('#cross_products').select2({
                placeholder : 'محصول را انتخاب کنید',
            });
        });
        $(document).ready(function(){
            $('#add-image').click(function(e) {
                e.preventDefault();
                $("#clone-image").clone().attr('id', '').appendTo("table.images tbody");
            });
            $('#add-attribute').click(function(e) {
                e.preventDefault();
                  html  = '<tr id="clone-attribute">';
                  	html += '  <td>    <select name="attribute_id[]" class="attr form-control">';
                	 @foreach($attributes as $key => $attribute)
                       html += '<option value="{{ $key }}">{{ $attribute }}</option>';
                      @endforeach

                	html += '    </select> </td>';
                	  html += '    <td><input name="attribute_highlight[]" type="checkbox" value="1">   </td>';
                	html += '  <td class="text-left" style="width: 20%;"> <textarea name="attribute_value[]" class="form-control"></textarea></td>';

               html += ' <td> <button type="button" class="btn btn-danger btn-xs remove-item">  <span class="fa fa-trash"></span> حذف           </button>           </td>'
                  html += '</tr>';
               $('table.attributes tbody').append(html);
               $('.attr').select2();
            });
            $(document).on('click', '.remove-item',function () {
                $(this).closest('tr').remove();
            });
        });
        $(document).ready(function () {
            (function($, undefined) {
                "use strict";

                // When ready.
                $(function() {
                    var $form           = $("#form");
                    var $priceMask      = $form.find("#price_mask");
                    var $specialMask    = $form.find("#special_mask");
                    var $colleagueMask  = $form.find("#colleague_price_mask");
                    var $price          = $("#price");
                    var $special        = $("#special");
                    var $colleague      = $("#colleague_price");

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

                    $specialMask.on("keyup", function(event) {
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

                        var withoutCommas = $specialMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $special.val(withoutCommas);
                    });

                    $colleagueMask.on("keyup", function(event) {
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

                        var withoutCommas = $colleagueMask.val().replace(/,/g, ''),
                            asANumber = +withoutCommas;
                        $colleague.val(withoutCommas);
                    });
                });
            })(jQuery);
        });
    </script>
     <script type="text/javascript">
        $(document).ready(function() {
            $("#form").on('submit', function() {
                // to each unchecked checkbox
                $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
                var price = parseFloat($('#price').val());
                var special = parseFloat($('#special').val());

                if (!isNaN(special) && special > price) {
                    alert('قیمت ویژه نمی‌تواند بزرگتر از قیمت اصلی باشد!');
                    event.preventDefault();
                }
            })
        })
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش محصول</h3>

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
                    <div class="nav-tabs-custom no-shadow">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab" aria-expanded="false">عمومی</a></li>
                            <li><a href="#tab_seo" data-toggle="tab" aria-expanded="false">سئو</a></li>
                            <li><a href="#tab_information" data-toggle="tab" aria-expanded="false">اطلاعات</a></li>
                            <li><a href="#tab_links" data-toggle="tab" aria-expanded="false">لینک‌ها</a></li>
                            <li><a href="#tab_attributes" data-toggle="tab" aria-expanded="false">ویژگی‌ها</a></li>
                            <li><a href="#tab_images" data-toggle="tab" aria-expanded="false">تصاویر</a></li>
                            <li><a href="#tab_catalogue" data-toggle="tab" aria-expanded="false">کاتالوگ</a></li>
                        </ul>
                        <form method="POST" action="{{ route('admin.products.update', $product->slug) }}" id="form" role="form" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_general">
                                    <div class="form-group">
                                        <label for="name" class="col-md-12 control-label mt-2">عنوان محصول *</label>
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" placeholder="عنوان محصول را وارد کنید" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="label" class="col-md-12 control-label mt-2">لیبل</label>
                                        <div class="col-md-12">
                                            <input id="label" type="text" class="form-control" name="label" value="{{ old('label', $product->label) }}" placeholder="لیبل را وارد کنید" required>
                                            <small class="text-muted">این فیلد تا زمان تکمیل فلو خرید لطفا کامل شود و سپس از دو فیلد بعدی استفاده خواهد شد.</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variety_label" class="col-md-12 control-label mt-2">لیبل تنوع</label>
                                        <div class="col-md-12">
                                            <input id="variety_label" type="text" class="form-control" name="variety_label" value="{{ old('variety_label', $product->variety_label) }}" placeholder="مثلا رنگ، سایز و ..." required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="variety_value" class="col-md-12 control-label mt-2">مقدار تنوع</label>
                                        <div class="col-md-12">
                                            <input id="variety_value" type="text" class="form-control" name="variety_value" value="{{ old('variety_value', $product->variety_value) }}" placeholder="مثلا سبز،‌استیل، ۳۸ و ..." required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="col-md-12 control-label mt-2">اسلاگ محصول *</label>
                                        <div class="col-md-12">
                                            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Enter the page slug" dir="ltr" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-md-12 control-label mt-2">توضیحات *</label>
                                        <div class="col-md-12">
                                            <textarea id="description" type="text" class="form-control tinymce" name="description" required>{{ old('description', $product->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_seo" class="tab-pane">
                                    <div class="form-group">
                                        <label for="title" class="col-md-12 control-label mt-2">تایتل</label>
                                        <div class="col-md-12">
                                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" placeholder="تایتل صفحه محصول را وارد کنید" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description" class="col-md-12 control-label mt-2">دسکریپشن</label>
                                        <div class="col-md-12">
                                            <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description', $product->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_title" class="col-md-12 control-label mt-2">تایتل برای توئیتر</label>
                                        <div class="col-md-12">
                                            <input type="text" name="twitter_title" id="twitter_title" class="form-control" value="{{ old('twitter_title', $product->twitter_title) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_description" class="col-md-12 control-label mt-2">دسکریپشن برای توئیتر</label>
                                        <div class="col-md-12">
                                            <textarea name="twitter_description" id="twitter_description" class="form-control" rows="5">{{ old('twitter_description', $product->twitter_description) }}</textarea>
                                        </div>
                                    </div>
                                    @if($product->og_image)
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-12 control-label mt-2">تصویر</label>
                                        <div class="col-md-12">
                                            <img src="{{ asset(image_resize($product->og_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="og_image" class="col-md-12 control-label mt-2">تصویر برای اپن گراف</label>
                                        <div class="col-md-12">
                                            <input type="file" name="og_image" id="og_image" class="form-control">
                                        </div>
                                    </div>
                                    @if($product->twitter_image)
                                    <div class="form-group">
                                        <label for="twitter_image" class="col-md-12 control-label mt-2">تصویر</label>
                                        <div class="col-md-12">
                                            <img src="{{ asset(image_resize($product->twitter_image, ['width' => 60, 'height' => 60])) }}" alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="twitter_image" class="col-md-12 control-label mt-2">تصویر برای توئیتر</label>
                                        <div class="col-md-12">
                                            <input type="file" name="twitter_image" id="twitter_image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="canonical" class="col-md-12 control-label mt-2">کنونیکال</label>
                                        <div class="col-md-12">
                                            <input type="text" name="canonical" id="canonical" class="form-control" value="{{ old('canonical', $product->canonical) }}" dir="ltr">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_nofollow" class="col-md-12 control-label mt-2">نوفالو</label>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="is_nofollow" id="is_nofollow" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوفالو" data-off="<i class='fa fa-check'></i> فالو"{{ old('is_nofollow', $product->is_nofollow) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_noindex" class="col-md-12 control-label mt-2">نوایندکس</label>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="is_noindex" id="is_noindex" value="1" data-width="100" data-toggle="toggle" data-onstyle="danger" data-on="<i class='fa fa-close'></i> نوایندکس" data-off="<i class='fa fa-check'></i> ایندکس"{{ old('is_noindex', $product->is_noindex) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_information" class="tab-pane">
                                    <div class="form-group">
                                        <label for="model" class="col-md-12 control-label mt-2">مدل *</label>
                                        <div class="col-md-12">
                                            <input id="model" type="text" class="form-control" name="model" value="{{ old('model', $product->model) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="giftcard" class="col-md-12 control-label mt-2">کارت هدیه</label>
                                        <div class="col-md-12">
                                            <input type="text" name="giftcard" id="giftcard" class="form-control" placeholder="کارت هدیه" value="{{ old('giftcard', $product->giftcard) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="badge" class="col-md-12 control-label mt-2">بج</label>
                                        <div class="col-md-12">
                                            <input type="text" name="badge" id="badge" class="form-control" placeholder="بج" value="{{ old('badge', $product->badge) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="warranty" class="col-md-12 control-label mt-2">گارانتی</label>
                                        <div class="col-md-12">
                                            <input type="text" name="warranty" id="weight" class="form-control" placeholder="گارانتی" value="{{ old('warranty', $product->warranty) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="col-md-12 control-label mt-2">قیمت *</label>
                                        <div class="col-md-12">
                                            <input type="text" id="price_mask" name="price_mask" class="form-control mask" value="{{ old('price_mask', number_format($product->price, 0, '', ',')) }}" required>
                                            <input type="hidden" name="price" id="price" class="price" value="{{ old('price', number_format($product->price, 0, '', '')) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="special" class="col-md-12 control-label mt-2">قیمت ویژه</label>
                                        <div class="col-md-12">
                                            <input type="text" id="special_mask" name="special_mask" class="form-control mask" value="{{ old('special_mask', $product->special) ? old('special_mask', number_format($product->special, 0, '', ',')) : '' }}">
                                            <input type="hidden" name="special" id="special" class="price" value="{{ old('special', $product->special) ? old('special', number_format($product->special, 0, '', '')) : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="colleague_price" class="col-md-12 control-label mt-2">قیمت همکار</label>
                                        <div class="col-md-12">
                                            <input type="text" id="colleague_price_mask" name="colleague_price_mask" class="form-control mask" value="{{ old('colleague_price_mask', $product->colleague_price) ? old('colleague_price_mask', number_format($product->colleague_price, 0, '', ',')) : '' }}">
                                            <input type="hidden" name="colleague_price" id="colleague_price" class="price" value="{{ old('colleague_price', $product->colleague_price) ? old('colleague_price', number_format($product->colleague_price, 0, '', '')) : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock" class="col-md-12 control-label mt-2">موجودی</label>
                                        <div class="col-md-12">
                                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock ) }}">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label for="stock" class="col-md-12 control-label mt-2">ترتیب نمایش</label>
                                        <div class="col-md-12">
                                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="suggest" class="col-md-12 control-label mt-2">محصول پیشنهادی</label>
                                        <div class="col-md-12">
                                            <select name="suggest" id="suggest" class="form-control">
                                                <option value="0"{{ (old('suggest', $product->suggest) == 0 ? ' selected' : '') }}>نیست</option>
                                                <option value="1"{{ (old('suggest', $product->suggest) == 1 ? ' selected' : '') }}>است</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_installment" class="col-md-12 control-label mt-2">نمایش در صفحه اقساط</label>
                                        <div class="col-md-12">
                                            <select name="is_installment" id="is_installment" class="form-control">
                                                <option value="0"{{ (old('is_installment', $product->is_installment) == 0 ? ' selected' : '') }}>نمایش داده نشود</option>
                                                <option value="1"{{ (old('is_installment', $product->is_installment) == 1 ? ' selected' : '') }}>نمایش داده شود</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="type" class="col-md-12 control-label mt-2">نمایش محصول</label>
                                        <div class="col-md-12">
                                            <select name="type" id="type" class="form-control">
                                                <option value="">نمایش</option>
                                                <option value="visited"{{ (old('type', $product->type) == "visited" ? ' selected' : '') }}>پربازدیدترین</option>
                                                <option value="new"{{ (old('type', $product->type) == "new" ? ' selected' : '') }}>جدیدترین</option>
                                             <option value="bestsellers"{{ (old('type', $product->type) == "bestsellers" ? ' selected' : '') }}>پرفروش ترین</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group hide">
                                        <label for="length" class="col-md-12 control-label mt-2">ابعاد (طول)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="length" id="length" class="form-control" placeholder="طول محصول" value="{{ old('length', $product->length) }}">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="width" class="col-md-12 control-label mt-2">ابعاد (عرض)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="width" id="width" class="form-control" placeholder="عرض محصول" value="{{ old('width', $product->width) }}">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="height" class="col-md-12 control-label mt-2">ابعاد (ارتفاع)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="height" id="height" class="form-control" placeholder="ارتفاع محصول" value="{{ old('height', $product->height) }}">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="weight" class="col-md-12 control-label mt-2">وزن</label>
                                        <div class="col-md-12">
                                            <input type="number" name="weight" id="weight" class="form-control" placeholder="وزن محصول" value="{{ old('weight', $product->weight) }}">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="length_unit" class="col-md-12 control-label mt-2">واحد طول</label>
                                        <div class="col-md-12">
                                            <select name="length_unit" id="length_unit" class="form-control">
                                                <option></option>
                                                <option value="metre"{{ (old('length_unit', $product->length_unit) == 'metre' ? ' selected' : '') }}>متر</option>
                                                <option value="centimetre"{{ (old('length_unit', $product->length_unit) == 'centimetre' ? ' selected' : '') }}>سانتی متر</option>
                                                <option value="milimetre"{{ (old('length_unit', $product->length_unit) == 'milimetre' ? ' selected' : '') }}>میلی متر</option>
                                                <option value="inch"{{ (old('length_unit', $product->length_unit) == 'inch' ? ' selected' : '') }}>اینچ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="weight_unit" class="col-md-12 control-label mt-2">واحد وزن</label>
                                        <div class="col-md-12">
                                            <select name="weight_unit" id="weight_unit" class="form-control">
                                                <option></option>
                                                <option value="kilogram"{{ (old('weight_unit', $product->weight_unit) == 'inch' ? ' selected' : '') }}>کیلوگرم</option>
                                                <option value="gram"{{ (old('weight_unit', $product->weight_unit) == 'gram' ? ' selected' : '') }}>گرم</option>
                                                <option value="lb"{{ (old('weight_unit', $product->weight_unit) == 'lb' ? ' selected' : '') }}>پوند</option>
                                                <option value="oz"{{ (old('weight_unit', $product->weight_unit) == 'oz' ? ' selected' : '') }}>انس</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hide_price" class="col-md-12 control-label mt-2">مخفی کردن قیمت</label>
                                        <div class="col-md-12">
                                            <select name="hide_price" id="hide_price" class="form-control">
                                                <option value="0"{{ (old('hide_price', $product->hide_price) == 0 ? ' selected' : '') }}>قیمت نمایش داده شود</option>
                                                <option value="1"{{ (old('hide_price', $product->hide_price) == 1 ? ' selected' : '') }}>تماس با ما به جای قیمت نمایش داده شود</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_foreign" class="col-md-12 control-label mt-2">محصول خارجی</label>
                                        <div class="col-md-12">
                                            <select name="is_foreign" id="is_foreign" class="form-control">
                                                <option value="1" {{ old('is_foreign', $product->is_foreign) == '1' ? ' selected' : '' }}>می‌باشد</option>
                                                <option value="0" {{ old('is_foreign', $product->is_foreign) == '0' ? ' selected' : '' }}>نمی‌باشد</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-md-12 control-label mt-2">وضعیت</label>
                                        <div class="col-md-12">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"{{ (old('status', $product->status) == 0 ? ' selected' : '') }}>پیش‌نویس</option>
                                                <option value="1"{{ (old('status', $product->status) == 1 ? ' selected' : '') }}>انتشار</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="required_national_id" class="col-md-12 control-label mt-2">کدملی</label>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="required_national_id" id="required_national_id" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> اجباری" data-off="<i class='fa fa-close'></i> اختیاری"{{ old('required_national_id', $product->required_national_id) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_festival" class="col-md-12 control-label">وضعیت جشنواره</label>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="is_festival" id="is_festival" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> جشنواره" data-off="<i class='fa fa-close'></i> عادی"{{ old('is_festival', $product->is_festival) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_available" class="col-md-12 control-label">وضعیت موجودی</label>
                                        <div class="col-md-12">
                                            <input type="checkbox" name="is_available" id="is_available" value="1" data-width="100" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> موجود" data-off="<i class='fa fa-close'></i> ناموجود"{{ old('is_available', $product->is_available) ? ' checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_links" class="tab-pane">
                                    <div class="form-group">
                                        <label for="manufacturer_id" class="col-md-12 control-label mt-2">تولیدکننده *</label>
                                        <div class="col-md-12">
                                            <select name="manufacturer_id" id="manufacturers" class="form-control" required>
                                                @foreach($manufacturers as $key => $manufacturer)
                                                    <option value="{{ $key }}"{{ ((old('manufacturer_id', $product->manufacturer_id) == $key) ? ' selected' : '') }}>{{ $manufacturer }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="categories" class="col-md-2 control-label mt-2">انتخاب دسته‌بندی‌ها</label>
                                        <div class="col-md-12">
                                            <select name="category_id[]" id="categories" class="form-control" multiple="multiple">
                                                @foreach($categories as $key => $category)
                                                    <option value="{{ $key }}"{{ old('category_id') ? (in_array($key, old('category_id')) ? ' selected' : '') : (in_array($key, $selectedCategories) ? ' selected' : '') }}>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="products" class="col-md-12 control-label mt-2">انتخاب محصولات مرتبط</label>
                                        <div class="col-md-12">
                                            <select name="product_id[]" id="products" class="form-control" multiple="multiple">
                                                @foreach($products as $key => $pro)
                                                    <option value="{{ $key }}"{{ old('product_id') ? (in_array($key, old('product_id')) ? ' selected' : '') : (in_array($key, $selectedProducts) ? ' selected' : '') }}>{{ $pro }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cross_products" class="col-md-12 control-label mt-2">انتخاب محصولات مکمل</label>
                                        <div class="col-md-12">
                                            <select name="cross_product_id[]" id="cross_products" class="form-control" multiple="multiple">
                                                @foreach($products as $key => $pro)
                                                    <option value="{{ $key }}"{{ old('cross_product_id') ? (in_array($key, old('cross_product_id')) ? ' selected' : '') : (in_array($key, $selectedCrossProducts) ? ' selected' : '') }}>{{ $pro }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_id" class="col-md-12 control-label mt-2">انتخاب فیلترها</label>
                                        <div class="col-md-12">
                                            <select name="filter_id[]" id="filters" class="form-control" multiple="multiple">
                                                @foreach($filters as $filter)
                                                    <option value="{{ $filter->id }}"{{ in_array($filter->id, old('filter_id', $selectedFilters)) ? ' selected' : '' }}>{{ $filter->filter }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="warranty_id" class="col-md-12 control-label mt-2">انتخاب فیلترها</label>
                                        <div class="col-md-12">
                                            <select name="warranty_id[]" id="warranties" class="form-control" multiple="multiple">
                                                @foreach($warranties as $warrantyId => $warranty)
                                                    <option value="{{ $warrantyId }}"{{ in_array($warrantyId, old('warrantyId', $selectedWarranties)) ? ' selected' : '' }}>{{ $warranty }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_attributes">
                                    <table class="table table-bordered table-hover attributes">
                                        <thead>
                                            <tr>
                                                <th>ویژگی</th>
                                                <th>برجسته</th>
                                                <th>مقدار</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($selectedAttributes as $id => $value)
                                            <tr>
                                                <td>
                                                    <select name="attribute_id[{{ $id }}]" class="attr attributes form-control">
                                                        @foreach($attributes as $key => $attribute)
                                                            <option value="{{ $key }}"{{ ($id == $key ? ' selected' : '') }}>{{ $attribute }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input name="attribute_highlight[{{ $id }}]" type="checkbox" value="1"{{ (in_array($id, $highlightedAttributes) ? ' checked' : '') }}>
                                                </td>
                                                <td>
                                                    <textarea name="attribute_value[{{ $id }}]" class="form-control">{{ $value }}</textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-xs remove-item">
                                                        <span class="fa fa-trash"></span> حذف
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">هیچ ویژگی وجود ندارد</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td>
                                                    <button type="button" id="add-attribute" class="btn btn-default btn-xs">
                                                        <span class="fa fa-plus"></span> افزودن
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab_images">
                                    <div class="form-group">
                                        @if($product->image)
                                            <label class="col-md-2 control-label">تصویر اصلی</label>
                                            <div class="col-md-10">
                                                <img src="{{ asset(image_resize($product->image, ['width' => 60, 'height' => 60])) }}" alt="{{ $product->name }}" class="image-thumbnail">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">تغییر تصویر</label>
                                        <div class="col-md-4">
                                            <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control">
                                        </div>
                                        <label for="alt" class="col-md-2 control-label">alt</label>
                                        <div class="col-md-4">
                                            <input type="text" name="alt" id="alt" value="{{ old('alt', $product->alt) }}" class="form-control">
                                        </div>
                                    </div>
                                    <table class="table table-hover images">
                                        <thead>
                                        <tr>
                                            <th>تصویر</th>
                                            <th>alt</th>
                                            <th>ترتیب</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($product->images->count())
                                            @foreach($product->images as $image)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="keep_images[{{ $image->id }}]" value="{{ $image->id }}">
                                                        <img src="{{ asset(image_resize($image->image, ['width' => 40, 'height' => 40])) }}" alt="{{ $product->name }}" class="image-thumbnail">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="keep_images_alt[{{ $image->id }}]" class="form-control" value="{{ $image->alt }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="keep_images_sort_order[{{ $image->id }}]" class="form-control" value="{{ $image->sort_order }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs remove-item">
                                                            <span class="fa fa-trash"></span> حذف
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <button type="button" id="add-image" class="btn btn-default btn-xs">
                                                    <span class="fa fa-plus"></span> افزودن
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                   <div class="tab-pane" id="tab_catalogue">
                                    <div class="form-group">
                                        <label for="catalogue_name" class="col-md-2 control-label">عنوان کاتالوگ</label>
                                        <div class="col-md-10">
                                            <input id="catalogue_name" type="text" class="form-control" name="catalogue_name" value="{{ old('catalogue_name', $product->catalogue_name) }}" placeholder="عنوان کاتالوگ را وارد کنید" required>
                                        </div>
                                    </div>
                                        @if($product->catalogue)
                                        <div class="form-group">
                                            <label for="file_name" class="col-md-2 control-label">کاتالوگ</label>
                                            <div class="col-md-10">
                                                <a class="btn-efct2 px-md-4 py-3 rounded mt-3 d-block" href="{{ asset($product->catalogue)  }}"
                                                    download="{{$product->catalogue  }}">
                                                    <i class="mr-1 fa fa-download">
                                                        </i>دانلود مستقیم
                                                    </a>
                                            </div>
                                        </div>


                                          @unless(is_null($product->catalogue))
                                               <div class="form-group">
                                                   <label class="checkbox-inline" for="remove_catalogue">
                                                       <input type="checkbox" name="remove_catalogue" value="1" id="remove_catalogue">
                                                       <span style="font-weight: bold;margin-right: 2rem">حذف کاتالوگ</span>
                                                   </label>
                                               </div>
                                        @endunless


                                        @endif
                                        <div class="form-group">
                                            <label for="catalogue" class="col-md-2 control-label">{{ ($product->catalogue ? 'تغییر کاتالوگ' : 'کاتالوگ') }}</label>
                                            <div class="col-md-10">
                                                <input type="file" name="catalogue" id="catalogue" class="form-control">
                                            </div>
                                        </div>

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
        <div class="col-md-4">
            <div class="box box-widget">
                <div class="box-footer box-comments">
                    @foreach($product->notes as $note)
                    <div class="box-comment">
                        <img class="img-circle img-sm" src="{{ avatar($note->user->email) }}" alt="{{ $note->user->name }}">
                        <div class="comment-text">
                            <span class="username">
                                {{ $note->user->name }}
                                <span class="text-muted pull-right">{{ jdate($note->created_at)->format('d F Y ساعت H:i') }}</span>
                            </span>
                            {{ $note->content }}
                            @if($note->attachment)
                            <hr>
                            <a href="{{ url($note->attachment) }}">ضمیمه</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.products.note', $product->slug) }}" method="post">
                        @csrf
                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }} attachment">
                            <label for="attachment" class="control-label">فایل ضمیمه</label>
                            <input type="file" class="form-control" name="attachment" multiple>
                            @if ($errors->has('attachment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('attachment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="content" class="control-label">یادداشت</label>
                            <textarea id="content" name="content" class="form-control" rows="3" spellcheck="false" placeholder="متن یادداشت..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            افزودن یادداشت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="hide">
        <tbody>
        <tr id="clone-image">
            <td>
                <input type="file" name="images[]" class="form-control">
            </td>
            <td>
                <input type="text" name="images_alt[]" class="form-control">
            </td>
            <td>
                <input type="text" name="images_sort_order[]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-xs remove-item">
                    <span class="fa fa-trash"></span> حذف
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="hide">
        <tbody>
            <tr id="clone-attribute">
                <td>
                    <select name="attribute_id[]" class="attr form-control">
                        @foreach($attributes as $key => $attribute)
                            <option value="{{ $key }}">{{ $attribute }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input name="attribute_highlight[]" type="checkbox" value="1">
                </td>
                <td>
                    <textarea name="attribute_value[]" class="form-control"></textarea>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs remove-item">
                        <span class="fa fa-trash"></span> حذف
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- /.row -->
@endsection
