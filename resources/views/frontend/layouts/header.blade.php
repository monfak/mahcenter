<!--منو گوشی-->
<nav class="nav panel-menu" role="navigation" id="panel-menu">
  <span class="closePanel close-menu">
    <i class="fal fa-times"></i>
  </span>
  <div class="row header-menu">
    <div class="col-12 p-0">
      <div class="btn-menu">منوی دسترسی</div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 p-0">
      <ul>
        <li class="main-menu">
          <a href="{{ route('home') }}">صفحه اصلی</a>
        </li>
        <li class="main-menu">
          <span class="openSubPanel">
            دسته بندی کالاها
            <span class="arow-menu">
              <i class="img-slice"></i>
            </span>
          </span>
          <ul class="subPanel">
            <li class="close-li">
              <span class="closeSubPanel">
                <i class="img-slice"></i> بازگشت
              </span>
            </li>
            @foreach($menuCategories as $category)
                <li class="main-menu">
                @if($category->children->count())
                    <span class="openSubPanel">
                        {{ $category->name }}
                        <span class="arow-menu">
                            <i class="img-slice"></i>
                        </span>
                    </span>
                    <ul class="subPanel">
                        <li class="close-li">
                            <span class="closeSubPanel">
                                <i class="img-slice"></i> بازگشت
                            </span>
                        </li>
                        <li class="main-menu">
                            <a href="{{ route('category.show', [$category->slug]) }}">
                                مشاهده محصولات
                                {{ $category->name }}
                            </a>
                        </li>
                        @foreach($category->children as $childCategory)
                        <li class="main-menu">
                            @if($childCategory->children->count())
                                <span class="openSubPanel">
                                    {{ $childCategory->name }}
                                    <span class="arow-menu">
                                        <i class="img-slice"></i>
                                    </span>
                                </span>
                                <ul class="subPanel">
                                    <li class="close-li">
                                        <span class="closeSubPanel">
                                            <i class="img-slice"></i> بازگشت
                                        </span>
                                    </li>
                                    <li class="main-menu">
                                        <a href="{{ route('category.show', [$childCategory->slug]) }}">
                                            مشاهده محصولات
                                            {{ $childCategory->name }}
                                        </a>
                                    </li>
                                    @foreach($childCategory->children as $grandCategory)
                                        <li class="main-menu">
                                        @if($grandCategory->children->count())
                                            <span class="openSubPanel">
                                                {{ $grandCategory->name }}
                                                <span class="arow-menu">
                                                    <i class="img-slice"></i>
                                                </span>
                                            </span>
                                            <ul class="subPanel">
                                                <li class="close-li">
                                                    <span class="closeSubPanel">
                                                        <i class="img-slice"></i> بازگشت
                                                    </span>
                                                </li>
                                            </ul>
                                            <li class="main-menu">
                                                <a href="{{ route('category.show', [$grandCategory->slug]) }}">
                                                    مشاهده محصولات
                                                    {{ $grandCategory->name }}
                                                </a>
                                            </li>
                                            <li class="main-menu">
                                            @foreach($grandCategory->children as $finalCategory)
                                                <a href="{{ route('category.show', [$finalCategory->slug]) }}">{{ $finalCategory->name }}</a>
                                            @endforeach
                                            </li>
                                        @else
                                            <a href="{{ route('category.show', [$grandCategory->slug]) }}">{{ $grandCategory->name }}</a>
                                        @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <a href="{{ route('category.show', [$childCategory->slug]) }}">{{ $childCategory->name }}</a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                @else
                    <a href="{{ route('category.show', [$category->slug]) }}">{{ $category->name }}</a>
                @endif
                </li>
            @endforeach
          </ul>
        </li>
        @if($headerMenu->is_active)
            @foreach($headerMenu->items as $item)
                @if($item->is_active)
                <li class="main-menu">
                    <a href="{{ parse_url_rel($item->url) }}">{{ $item->heading }}</a>
                </li>
                @endif
            @endforeach
        @endif
      </ul>
    </div>
  </div>
</nav>
<!--منو گوشی-پایان-->
<!--نمایش هدر در حالت دسکتاپ-->
<header class="container-fluid header p-0">
    @if($notification->status)
        <div class="container-fluid ps-0 pe-0 banner-top">
            <a href="{{ $notification->orderedItems->first()->url }}" class="d-block">
                <img src="{{ asset($notification->orderedItems->first()->image) }}" class="img-fluid w-100 d-none d-lg-block" alt="{{ $notification->orderedItems->first()->title }}"/>
                <img src="{{ asset($notification->orderedItems->last()->image) }}" class="img-fluid w-100 d-xl-none d-lg-none" height="35" alt="{{ $notification->orderedItems->last()->title }}"/>
            </a>
        </div>
    @endif
  <div class="container p-0">
    <!--نمایش گوشی-->
    <div class="row row-menu-mob pt-1 align-items-center pb-1">
      <div class="col-10">
        <div class="product_search position-relative">
          <form role="search" method="get" class="product-search" action="{{ route('search') }}">
            <input type="search" id="search-field" class="search-field search-input" autocomplete="off" placeholder="جستجو کنید..." name="s"/>
            <button type="submit" value="Search">
              <i class="fal fa-search"></i>
            </button>
          </form>
          <div class="col-12 p-0 search-result" style="display: none">
            <ul class="p-0 search-result-list">
              {{--<li>
                <a href=""> آب مرکبات گیری بوش مدل MCP3500N </a>
              </li>
              <li>
                <a href="">نام محصول</a>
              </li>--}}
            </ul>
          </div>
        </div>
      </div>
      <div class="col-2 text-end ps-0">
        <a href="{{ route('home') }}" class="d-inline-block logo-mob">
          <img src="{{ asset('new-theme/images/logo.png') }}" class="img-fluid" alt="مه سنتر"/>
        </a>
      </div>
    </div>
    <!--پایان نمایش گوشی-->
    <div class="row row-header d-none d-lg-block">
      <div class="col-12 p-0">
        <div class="row align-items-center pt-2">
          <div class="col-lg-9 text-center">
            <div class="d-flex flex-header">
              <div class="d-block">
                <a href="{{ route('home') }}" class="d-inline-block logo">
                  <img src="{{ asset('new-theme/images/logo.png') }}" class="img-fluid" alt="مه سنتر"/>
                </a>
              </div>
              <div class="position-relative search-desc">
                <div class="example"></div>
                <form class="frm-search" action="{{ route('search') }}" method="get">
                  <button class="btn-search" type="submit">
                    <i class="fal fa-search"></i>
                  </button>
                  <input id="search-input-desktop" name="s" type="text" class="form-control search-input" autocomplete="off" placeholder="کالای مورد نظر خود را جستجو کنید "/>
                </form>
                <div class="frm-search" id="result-show" style="display: none">
                  <div class="row row-botton-search mt-2 w-100">
                    <div id="result-content" class="col-12">
                      {{--<p class="c-search">بیشترین جستجوهای اخیر</p>
                      <ul class="most-search ps-0">
                        <li>
                          <a href="">ساید بای ساید </a>
                      </ul>--}}
                      <ul class="list-search mt-3 ps-0">
                        <li>
                          <a href="#">
                            <i class="fal fa-search ms-1"></i>
                            برای جستجو تایپ کنید...
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-2  text-end">
            <div class="d-block text-end right-toolbar">
              <span class="dropdown register">
                <button type="button" class="btn-text dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="img-slice img-reg"></div>
                </button>
                <ul class="dropdown-menu menu-account" aria-labelledby="dropdownMenuButton2">
                    @guest
                    <li>
                        <div class="flex items-center justify-center relative grow">
                        <span class="icon-user">
                            <a href="{{ route('login') }}"><i class="fal fa-user-lock"></i> ورود | ثبت‌نام</a>
                        </span>
                    </li>
                    @else
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('panel.index') }}">
                                {{ $authUser->name ?? '' }}
                                <i class="fal fa-angle-double-left icon-user-arrow"></i>
                            </a>
                        </span>
                    </li>
                    @can('manage-store')
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('admin.app.index') }}">
                                <i class="fal fa-user-tie"></i> پنل مدیریت
                            </a>
                        </span>
                    </li>
                    @endcan
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('panel.index') }}">
                                <i class="fal fa-user"></i> حساب کاربری
                            </a>
                        </span>
                    </li>
                    {{--<li class="mh-club">
                        <span class="icon-user">
                            <a href="">
                                <i class="fal fa-club"></i>
                                کلاب مه سنتر
                            </a>
                        </span>
                        <span class="club-rate"> 0 امتیاز </span>
                    </li>--}}
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('panel.orders.index') }}">
                                <i class="fal fa-bags-shopping"></i>
                                سفارش ها
                            </a>
                        </span>
                    </li>
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('wishlist') }}">
                                <i class="fal fa-heart"></i>
                                علاقه‌مندی‌ها
                            </a>
                        </span>
                    </li>
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('panel.reviews.index') }}">
                                <i class="fal fa-comments"></i>
                                دیدگاه‌ها
                            </a>
                        </span>
                    </li>
                    <li>
                        <span class="icon-user">
                            <a href="{{ route('panel.tickets.index') }}">
                                <i class="fal fa-bell"></i>
                                پیام‌های پشتیبانی
                            </a>
                        </span>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <span class="icon-user">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="far fa-sign-out"></i> خروج </a>
                        </span>
                    </li>
                    @endguest
                </ul>
              </span>
              <span class="gap"></span>
              <span class="shop shop-link">
                <button type="button" class="shop-link d-inline-block dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class=" img-shop position-relative">
                      <svg class="svg-icon" style="width: 30px; height: 30px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M848 712H318.4c-25.6 0-46.4-19.2-48-41.6L240 201.6c-1.6-25.6-16-46.4-38.4-57.6l-48-20.8c-12.8-4.8-25.6 0-32 12.8s0 25.6 12.8 32l46.4 20.8c6.4 3.2 11.2 9.6 11.2 17.6l28.8 468.8c3.2 48 46.4 86.4 96 86.4H848c12.8 0 24-11.2 24-24s-11.2-25.6-24-25.6z"  /><path d="M884.8 265.6c-14.4-16-35.2-25.6-57.6-25.6H337.6c-12.8 0-24 11.2-24 24s11.2 24 24 24h489.6c8 0 16 3.2 20.8 9.6 4.8 6.4 8 14.4 8 22.4l-38.4 211.2v1.6c-1.6 14.4-12.8 24-27.2 25.6l-420.8 32c-12.8 1.6-22.4 12.8-22.4 25.6 1.6 12.8 11.2 22.4 24 22.4h1.6l419.2-32c36.8-3.2 67.2-30.4 70.4-67.2l38.4-212.8v-1.6c4.8-20.8-1.6-43.2-16-59.2z"  /><path d="M305.6 856m-56 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0Z"  /><path d="M753.6 856m-56 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0Z"  /></svg>
                    <span class="count itemsInBasket">{{ $itemsInBasket['quantity'] }}</span>
                  </div>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <div class="mini-cart">
                    @include('frontend.cart.mini-cart')
                  </div>
                </ul>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row menu mt-2">
      <div class="col-12 ">
        <nav class="c-navi js-navi">
          <div class="c-navi__row">
            <ul class="c-navi-new-list ps-0">
              <li class="c-navi-new-list__categories">
                <ul class="c-navi-new-list__category-item p-0">
                  <li class="js-categories-bar-item js-mega-menu-main-item">
                    <div class="position-relative">
                      دسته بندی کالاها
                      <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="c-navi-new-list__sublist js-mega-menu-categories-options c-navi-new__ads-holder" style="display: none">
                      <div class="c-navi-new-list__inner-categories">
                        @foreach($menuCategories as $category)
                        @if(count($category->children))
                        <a href="{{ route('category.desc', $category->slug) }}" data-index="{{ $category->id }}" class="c-navi-new-list__inner-category js-mega-menu-category{{ $loop->first ? ' c-navi-new-list__inner-category--hovered' : '' }}">
                            @if($category->icon)
                            <span class="ico-menu">
                                <img src="{{ asset($category->icon) }}"  class="img-fluid" alt="{{ $category->name }}"/>
                            </span>
                            @endif
                            {{ $category->name }}
                        </a>
                        @endif
                        @endforeach
                      </div>
                      <div class="c-navi-new-list__options-container">
                        @foreach($menuCategories as $category)
                        @if(count($category->children))
                        <div class="c-navi-new-list__options-list js-mega-menu-category-options{{ $loop->first ? ' is-active' : '' }}" id="categories-{{ $category->id }}">
                          <div class="c-navi-new-list__sublist-top-bar">
                            <a href="{{ route('category.desc', $category->slug) }}" class="c-navi-new-list__sublist-see-all-cats">
                              همه دسته‌بندی‌های {{ $category->name }}
                            </a>
                          </div>
                          <ul class="p-0">
                            <!--تکرار دسته و زیر ودسته-->
                            @foreach($category->children as $childCategory)
                                <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title">
                                  <a href="{{ route('category.show', $childCategory->slug) }}" class="c-navi-new__big-display-title">
                                    <span>{{ $childCategory->name }}</span>
                                  </a>
                                </li>
                                @foreach($childCategory->children as $grandCategory)
                                <li>
                                  <a href="{{ route('category.show', $grandCategory->slug) }}" class="c-navi-new__big-display-title">
                                    <span>{{ $grandCategory->name }}</span>
                                  </a>
                                </li>
                                @endforeach
                            @endforeach
                          </ul>
                        </div>
                        @endif
                        @endforeach
                      </div>
                    </div>
                  </li>
                  @if($headerMenu->is_active)
                    @foreach($headerMenu->items as $item)
                        @if($item->is_active)
                        <li>
                            <a href="{{ parse_url_rel($item->url) }}">{{ $item->heading }}</a>
                        </li>
                        @endif
                    @endforeach
                  @endif
                </ul>
              </li>
              <li class="ms-auto">
                <span class="number ms-2">
                  <a href="tel:{{ str_replace(' ', '', str_replace('-', '', $site_settings['tel'])) }}">
                    <i class="fal fa-phone"></i>
                    {{ $site_settings['tel'] }}
                  </a>
                </span>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>