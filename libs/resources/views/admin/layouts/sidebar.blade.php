<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ avatar($authUser->email) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $authUser->name }}</p>
                <span class="text-muted">{{ $authUser->roles()->first()->display_name }}</span>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">پنل مدیریت</li>
            @foreach($menus as $menu)
                @if(user_has($menu['permissions'], $userPermissions))
                    @if(isset($menu['children']) && $menu['children'])
                        <li class="treeview @if(isset($menu['active']) && $menu['active']) active @endif">
                            <a href="#">
                                <i class="fa fa-{{$menu['icon']}}"></i>
                                <span>{{ $menu['label'] }}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                    @isset($menu['badges'])
                                    @foreach($menu['badges'] as $badge)
                                    @continue(${$badge['var']} === 0)
                                    <small class="label pull-right {{ $badge['color'] }}">{{ ${$badge['var']} }}</small>
                                    @endforeach
                                    @endisset
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach($menu['children'] as $child)
                                    @if(user_has($child['permissions'] , $userPermissions))
                                        <li class="nav-item @if(isset($child['active']) && $child['active']) active @endif">
                                            <a href="{{ route($child['route_name']) }}" class="nav-link">
                                                <span class="fa fa-{{ $child['icon'] }}"></span>
                                                <span class="title">{{ $child['label'] }}</span>
                                                @isset($child['badges'])
                                                <span class="pull-right-container">
                                                    @foreach($child['badges'] as $badge)
                                                    @continue(${$badge['var']} === 0)
                                                    <small class="label pull-right {{ $badge['color'] }}">{{ ${$badge['var']} }}</small>
                                                    @endforeach
                                                </span>
                                                @endisset
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="@if(isset($menu['active']) && $menu['active']) active treeview @endif">
                            <a href="{{ route($menu['route_name']) }}" class="nav-link">
                                <i class="fa fa-{{ $menu['icon'] }}"></i>
                                <span class="title">{{ $menu['label'] }}</span>
                                @isset($menu['badges'])
                                <span class="pull-right-container">
                                    @foreach($menu['badges'] as $badge)
                                    @continue(${$badge['var']} === 0)
                                    <small class="label pull-right {{ $badge['color'] }}">{{ ${$badge['var']} }}</small>
                                    @endforeach
                                </span>
                                @endisset
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="dropdown-item">
                    <i class="fa fa-unlock"></i> <span>خروج از سیستم</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
