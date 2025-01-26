@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">تنظیمات اقساط</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" id="form" action="{{ route('admin.settings.installment.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                    <div class="form-group">
                        <label for="installment_heading" class="col-sm-2 control-label">عنوان</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_heading" name="installment_heading" value="{{ old('installment_heading', $settings['installment_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_subheading" class="col-sm-2 control-label">زیر عنوان</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_subheading" name="installment_subheading" value="{{ old('installment_subheading', $settings['installment_subheading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_secondheading" class="col-sm-2 control-label">عنوان فرعی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_secondheading" name="installment_secondheading" value="{{ old('installment_secondheading', $settings['installment_secondheading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">عکس</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="">تنها در صورتی عکس انتخاب کنید که تمایل به تغییر آن دارید.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_content" class="col-sm-2 control-label">متن</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="installment_content" name="installment_content" rows="8">{{ old('installment_content', $settings['installment_content']) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_products_heading" class="col-sm-2 control-label">عنوان بخش محصولات</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_products_heading" name="installment_products_heading" value="{{ old('installment_products_heading', $settings['installment_products_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_calculation_heading" class="col-sm-2 control-label">عنوان محاسبه اقساط</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_calculation_heading" name="installment_calculation_heading" value="{{ old('installment_calculation_heading', $settings['installment_calculation_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_application_heading" class="col-sm-2 control-label">عنوان فرم ثبت درخواست</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_application_heading" name="installment_application_heading" value="{{ old('installment_application_heading', $settings['installment_application_heading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_application_subheading" class="col-sm-2 control-label">زیرعنوان فرم ثبت درخواست</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_application_subheading" name="installment_application_subheading" value="{{ old('installment_application_subheading', $settings['installment_application_subheading']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_sidebar_content" class="col-sm-2 control-label">متن سایدبار</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_sidebar_content" name="installment_sidebar_content" value="{{ old('installment_sidebar_content', $settings['installment_sidebar_content']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installment_sidebar_tel" class="col-sm-2 control-label">شماره تماس</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="installment_sidebar_tel" name="installment_sidebar_tel" value="{{ old('installment_sidebar_tel', $settings['installment_sidebar_tel']) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
