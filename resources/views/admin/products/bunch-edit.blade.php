@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش گروهی محصول</h3>

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
                <form method="POST" action="{{ route('admin.products.bulk.import') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="tab-content">
                        <div class="form-group">
                            <label for="excel" class="col-md-2 control-label">فایل اکسل</label>
                            <div class="col-md-10">
                                <input id="excel" type="file" class="form-control" name="excel">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.tab-content -->
                    <input type="submit" class="btn btn-primary" value="ایمپورت فایل">
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
@endsection
