@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد پلن اقساط</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.installments.plans.index') }}" class="btn btn-default btn-sm">لیست پلن‌ها
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom no-shadow">
                        <form method="post" action="{{ route('admin.installments.plans.store') }}" role="form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div id="tab_general" class="tab-pane active">
                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">نام</label>
                                        <div class="col-md-5">
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sort_order" class="col-md-2 control-label">ترتیب</label>
                                        <div class="col-md-5">
                                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order') }}">
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
                                           <input type="submit" class="btn btn-primary" value="افزودن پلن">
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
