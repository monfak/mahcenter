@extends('admin.layouts.app')
@section('styles')
    <link href="/dashboard/dist/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        input[type='checkbox'] {
            margin-right:10px;
        }
    </style>
@endsection
@section('scripts')
    <script src="/dashboard/dist/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">کنترل دسترسی :: {{ $role->display_name }}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-sm">گروه‌های کاربری
                                <span class="fa fa-arrow-left"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{ route('admin.permissions.update', $role->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <label class="control-label" for="lbl-{{ $permission->id }}" title="{{ $permission->content }}">{{ $permission->display_name }}</label>
                                                </td>
                                                <td width="50">
                                                    <input type="checkbox" class="toggle" name="permissions_id[]" id="lbl-{{ $permission->id }}" value="{{ $permission->name }}" data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-check'></i> دسترسی دارد" data-off="<i class='fa fa-close text-red'></i> دسترسی ندارد" {{ in_array($permission->id, $userPerms) ? ' checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
    </div>
@endsection
