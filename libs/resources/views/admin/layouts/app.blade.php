<!DOCTYPE html>
<html dir="rtl">
<head>
    @include('admin.layouts.meta')
    @include('admin.layouts.styles')
    @yield('meta')
    @yield('styles')
    <style>
        .spinner {
            margin: 300px auto;
            width: 40px;
            height: 40px;
            position: relative;
            text-align: center;
            top: 50%;
            -webkit-animation: sk-rotate 2.0s infinite linear;
            animation: sk-rotate 2.0s infinite linear;
        }

        .dot1, .dot2 {
            width: 60%;
            height: 60%;
            display: inline-block;
            position: absolute;
            top: 0;
            background-color: #333;
            border-radius: 100%;

            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .dot2 {
            top: auto;
            bottom: 0;
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-rotate { 100% { -webkit-transform: rotate(360deg) }}
        @keyframes sk-rotate { 100% { transform: rotate(360deg); -webkit-transform: rotate(360deg) }}

        @-webkit-keyframes sk-bounce {
            0%, 100% { -webkit-transform: scale(0.0) }
            50% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bounce {
            0%, 100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            } 50% {
                  transform: scale(1.0);
                  -webkit-transform: scale(1.0);
              }
        }
        .modal-static {
            position: fixed;
            overflow: visible !important;
        }
        .modal-static,
        .modal-static .modal-dialog,
        .modal-static .modal-content {
            width: 100%;
        }
        .modal-static .modal-dialog,
        .modal-static .modal-content {
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<div class="wrapper">

    @include('admin.layouts.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $site_settings['name'] }}
                <small>پنل مدیریت</small>
            </h1>
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> پنل مدیریت</a></li>--}}
                {{--<li><a href="#">بخش واسطه</a></li>--}}
                {{--<li class="active">بخش جاری</li>--}}
            {{--</ol>--}}
        </section>

        @include('admin.layouts.partials.callout')

        @include('admin.layouts.partials.input-errors')

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            
        </div>
        <span>تمامی حقوق برای فروشگاه مه سنتر محفوظ است.</span>
    </footer>
</div>
<!-- ./wrapper -->
@include('admin.layouts.scripts')
@include('admin.layouts.partials.message')
@yield('scripts')

</body>
</html>