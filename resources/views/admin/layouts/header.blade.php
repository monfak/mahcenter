<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>مه</b> سنتر</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{--<li class="dropdown notifications-menu">
                    <a href="{{route('admin.tickets.index')}}" >
                      <i class="fa fa-ticket"></i>
                      <span class="label label-warning">{{ $openTickets }}</span>
                    </a>
                </li>
                <li class="notifications-menu">
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="fa fa-shopping-basket"></i>
                        <span class="label label-warning">{{ $waitingOrders }}</span>
                    </a>
                </li>--}}
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ avatar($authUser->email ?? null) }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ $authUser->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ avatar($authUser->email ?? null) }}" class="img-circle" alt="User Image">

                            <p>
                                {{ $authUser->roles()->first()?->display_name }}
                                <small>عضویت در {{ jdate($authUser->created_at)->format('d F Y ساعت H:i') }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="{{ route('admin.categories.index') }}">دسته‌بندی‌ها</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="{{ route('admin.products.index') }}">محصولات</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="{{ route('admin.orders.index') }}">سفارش‌ها</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('home') }}" class="btn btn-default btn-flat">فروشگاه</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat"><span>خروج</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
