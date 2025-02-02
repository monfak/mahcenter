@extends('admin.layouts.app')
@section('scripts')
<script src="{{ asset('dashboard/plugins/chartjs/Chart.min.js') }}"></script>
<script>
$(document).ready(function () {
    $(function() {
        'use strict';
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        var salesChart = new Chart(salesChartCanvas);
        var salesChartData = {
            labels: @json($months),
            datasets: [{
                label: 'کل سفارشات',
                fillColor: 'rgb(210, 214, 222)',
                strokeColor: 'rgb(210, 214, 222)',
                pointColor: 'rgb(210, 214, 222)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgb(220,220,220)',
                data: @json($monthlySalesData),
                fill: true
            }, {
                label: 'سفارشات موفق',
                fillColor: 'rgba(60,141,188,0.9)',
                strokeColor: 'rgba(60,141,188,0.8)',
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: @json($monthlySuccessfulSalesData),
                fill: true
            }]
        };
        var salesChartOptions = {
            showScale: true,
            scaleShowGridLines: false,
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            bezierCurve: true,
            bezierCurveTension: 0.3,
            pointDot: false,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
            maintainAspectRatio: true,
            responsive: true
        };
        salesChart.Line(salesChartData, salesChartOptions);
    });
});
</script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $totalOrders }}</h3>
                    <p>کل سفارش‌ها</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>

                    <p>کل کاربران</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>

                    <p>کل محصولات</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tags"></i>
                </div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $totalCategories }}</h3>

                    <p>کل دسته‌ها</p>
                </div>
                <div class="icon">
                    <i class="fa fa-folder-open"></i>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">نمودار فروش</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>
                                    فروش:
                                    یکسال اخیر(برحسب میلیون تومان)
                                </strong>
                            </p>
                            <div class="chart">
                                <canvas id="salesChart" style="height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage {{ $isGrowthLastWeek > 0 ? 'text-green' : 'text-red' }}">
                                    <i class="fa fa-caret-{{ $isGrowthLastWeek > 0 ? 'up' : 'down' }}"></i>
                                    {{ round($growthLastWeek, 2) }}%
                                </span>
                                <h5 class="description-header">
                                    {{ number_format($totalOrdersAmountLastWeek, 0) }}
                                    تومان
                                </h5>
                                <span class="description-text">فروش هفته</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage {{ $isGrowthLastMonth > 0 ? 'text-green' : 'text-red' }}">
                                    <i class="fa fa-caret-{{ $isGrowthLastMonth > 0 ? 'up' : 'down' }}"></i>
                                    {{ round($growthLastMonth, 2) }}%
                                </span>
                                <h5 class="description-header">
                                    {{ number_format($totalOrdersAmountLastMonth, 0) }}
                                    تومان
                                </h5>
                                <span class="description-text">فروش ماه</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage {{ $isGrowthLastYear > 0 ? 'text-green' : 'text-red' }}">
                                    <i class="fa fa-caret-{{ $isGrowthLastYear > 0 ? 'up' : 'down' }}"></i>
                                    {{ round($growthLastYear, 2) }}%
                                </span>
                                <h5 class="description-header">
                                    {{ number_format($totalOrdersAmountLastYear, 0) }}
                                    تومان
                                </h5>
                                <span class="description-text">فروش سال</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <span class="description-percentage"></span>
                                <h5 class="description-header">
                                    {{ number_format($totalOrdersAmount, 0) }}
                                    تومان
                                </h5>
                                <span class="description-text">فروش کل</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">آخرین سفارشات</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>شماره سفارش</th>
                                    <th>نام مشتری</th>
                                    <th>جمع</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت پرداخت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.edit', $order->id) }}">{{ $order->id }}</a></td>
                                    <td>{{ $order->user?->name ?? $order->name }}</td>
                                    <td>{{ number_format($order->total_price, 0) }} تومان</td>
                                    <td>
                                        <span class="label label-{{ $order->checked ? 'success' : 'info' }}">
                                            {{ $order->checked ? 'بررسی شده' : 'جدید' }}
                                        </span>
                                    </td>
                                    <td>
                                    @switch($order->status)
                                        @case(0)
                                            <span class="label label-danger">منقضی شده</span>
                                            @break
                                        @case(1)
                                            <span class="label label-warning">منتظر پرداخت</span>
                                            @break
                                        @case(2)
                                            <span class="label label-success">پرداخت شده</span>
                                            @break
                                        @case(3)
                                            <span class="label label-primary">ارسال شده</span>
                                            @break
                                        @case(4)
                                            <span class="label label-warning">بازگشت خورده</span>
                                            @break
                                        @case(5)
                                            <span class="label label-success">کامل شده</span>
                                            @break
                                    @endswitch
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">هیچ سفارشی هنوز ثبت نشده است!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-info btn-flat pull-left">ثبت سفارش جدید</a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default btn-flat pull-right">مشاهده همه سفارشات</a>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">محصولات نیازمند توجه</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if(count($notCompletedProducts) > 0)
                    <div class="alert alert-danger">
                        حال {{ count($notCompletedProducts) }} محصول خوب نیست!
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>نام محصول</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notCompletedProducts as $product)
                                <tr>
                                    <td><a href="{{ route('admin.products.edit', $product->slug) }}">{{ $product->name }}</a></td>
                                    <td>
                                        @if($product->alt == null)
                                        <span class="label label-danger">تصویر شاخص فاقد alt</span>
                                        @endif
                                        @if($product->title == null)
                                        <span class="label label-danger">فاقد تایتل</span>
                                        @endif
                                        @if($product->meta_description == null)
                                        <span class="label label-danger">فاقد دسکریپشن</span>
                                        @endif
                                        @if($product->is_noindex)
                                        <span class="label label-danger">نوایندکس</span>
                                        @endif
                                        @unless($product->status)
                                        <span class="label label-warning">پیش نویس</span>
                                        @endunless
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">تبریک! حال همه محصولات خوب است!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین محصولات اضافه شده</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach($latestProducts as $product)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset(image_resize($product->image, ['width' => 40, 'height' => 40])) }}" alt="{{ $product->name}}">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">
                                            {{ $product->name}}
                                            @if($product->status)
                                                <span class="label label-success pull-right">فعال</span>
                                            @else
                                            <span class="label label-warning pull-right">غیرفعال</span>
                                            @endif
                                        </a>
                                        <span class="product-description">
                                        {{ $product->model }}
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="uppercase">مشاهده همه محصولات</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین نظرات</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>شناسه نظر</th>
                                            <th>نویسنده</th>
                                            <th>عنوان</th>
                                            <th>وضعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($latestReviews as $review)
                                        <tr>
                                            <td><a href="{{ route('admin.reviews.show', $review->id) }}">{{ $review->id }}</a></td>
                                            <td>{{ ($review->name ?? $review->user->name) }}</td>
                                            <td>{{ ($review->title ?? 'در پاسخ به: ' . ($review->parent->title ?? 'بدون عنوان')) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $review->status == 1 ? 'green' : 'red' }}">{{ $review->status == 1 ? 'تایید شده' : 'تایید نشده' }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">هیچ نظری یافت نشد!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-default btn-flat pull-right">مشاهده همه نظرات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">آخرین تیکت‌ها</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>شناسه تیکت</th>
                                    <th>کاربر</th>
                                    <th>عنوان</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($latestTickets as $ticket)
                                <tr>
                                    <td><a href="{{ route('admin.tickets.show', $ticket->id) }}">{{ $ticket->slug }}</a></td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $ticket->status == 1 ? 'green' : 'red' }}">{{ $ticket->status == 1 ? 'باز' : 'بسته' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">هیچ تیکتی یافت نشد!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-default btn-flat pull-right">مشاهده همه سفارشات</a>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">آخرین کاربران</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-۱۲">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($latestUsers as $user)
                                <li>
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ $user->name ?? 'بدون نام' }}
                                        <span class="pull-right text-success">{{ $user->mobile }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">وضعیت سیستم</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-۱۲">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="#">ورژن لاراول
                                        <span class="pull-right text-success">{{ Illuminate\Foundation\Application::VERSION }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">ورژن PHP
                                        <span class="pull-right text-success">{{ PHP_VERSION }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.installments.applications.index') }}">تعداد درخواست‌های اقساط
                                        <span class="pull-right text-success">{{ $totalInstallmentApplications }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tickets.index') }}">تعداد تیکت‌ها
                                        <span class="pull-right text-success">{{ $totalTickets }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.reviews.index') }}">تعداد نظرات محصولات
                                        <span class="pull-right text-success">{{ $totalReviews }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.comments.index') }}">تعداد نظرات وبلاگ
                                        <span class="pull-right text-success">{{ $totalComments }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
