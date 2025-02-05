<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ee384e" />
    <title>فروشگاه لوازم خانگی با بهترین قیمت | مه‌سنتر</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/main.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/template.css?v=1.0.0') }}" />
  </head>
  <body>
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
              <a href="">صفحه اصلی</a>
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
                <li class="main-menu">
                  <span class="openSubPanel"
                    >زیر دسته
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
                      <a href=""> زیر منو </a>
                    </li>
                    <li class="main-menu">
                      <a href=""> زیر منو </a>
                    </li>
                    <li class="main-menu">
                      <a href=""> زیر منو </a>
                    </li>
                  </ul>
                </li>
                <li class="main-menu">
                  <a href=""> زیر منو </a>
                </li>
                <li class="main-menu">
                  <a href=""> زیر منو </a>
                </li>
                <li class="main-menu">
                  <a href=""> زیر منو </a>
                </li>
              </ul>
            </li>
            <li class="main-menu">
              <a href="#"> شکفت انگیز</a>
            </li>
            <li class="main-menu">
              <a href="#"> تامین کنندگان </a>
            </li>
            <li class="main-menu">
              <a href="#"> مقاله </a>
            </li>
            <li class="main-menu">
              <a href="#"> گالری </a>
            </li>
            <li class="main-menu">
              <a href="#"> درباره ما </a>
            </li>
            <li class="main-menu">
              <a href="#"> تماس با ما </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--منو گوشی-پایان-->
    <!--نمایش هدر در حالت دسکتاپ-->
    <header class="container-fluid header p-0">
        @foreach($notification->orderedItems as $item)
            <div class="container-fluid ps-0 pe-0 banner-top">
                <a href="{{ $item->url }}" class="d-block">
                    <img
                    src="{{ asset($item->image) }}"
                    class="img-fluid w-100 d-none d-lg-block"
                     alt="{{ $item->title }}"/>
                    <img
                    src="{{ asset($item->image) }}"
                    class="img-fluid w-100 d-xl-none d-lg-none"
                    height="35"
                    alt="{{ $item->title }}"/>
                </a>
            </div>
        @endforeach
      <div class="container p-0">
        <!--نمایش گوشی-->
        <div class="row row-menu-mob pt-1 align-items-center pb-1">
          <div class="col-10">
            <div class="product_search position-relative">
              <form role="search" method="get" class="product-search" action="">
                <input
                  type="search"
                  id="search-field"
                  class="search-field"
                  placeholder="جستجو کنید..."
                  value=""
                  name="s"
                />
                <button type="submit" value="Search">
                  <i class="fal fa-search"></i>
                </button>
              </form>
              <div class="col-12 p-0 search-result" style="display: none">
                <ul class="p-0 search-result-list">
                  <li>
                    <a href=""> آب مرکبات گیری بوش مدل MCP3500N </a>
                  </li>
                  <li>
                    <a href=""> اسپرسوساز اسمگ مدل ECF01 آبی </a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                  <li>
                    <a href="">نام محصول</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-2 text-end ps-0">
            <a href="#" class="d-inline-block logo-mob">
              <img src="{{ asset('new-theme/images/logo.png') }}" class="img-fluid" alt="" />
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
                    <a href="#" class="d-inline-block logo">
                      <img src="{{ asset('new-theme/images/logo.png') }}" class="img-fluid" alt="" />
                    </a>
                  </div>
                  <div class="position-relative search-desc">
                    <div class="example"></div>
                    <form class="frm-search" action="" method="get">
                      <button class="btn-search" type="submit">
                        <i class="fal fa-search"></i>
                      </button>
                      <input
                        id="phrase"
                        name="phrase"
                        type="text"
                        class="form-control"
                        placeholder=" محصول مورد نظر خود را جستجو کنید "
                      />
                    </form>
                    <div
                      class="frm-search"
                      id="result-show"
                      style="display: none"
                    >
                      <div class="row row-botton-search mt-2 w-100">
                        <div class="col-12">
                          <p class="c-search">بیشترین جستجوهای اخیر</p>
                          <ul class="most-search ps-0">
                            <li>
                              <a href="">ساید بای ساید </a>
                            </li>
                            <li>
                              <a href="">لباسشویی</a>
                            </li>
                            <li>
                              <a href="">ساندویچ ساز</a>
                            </li>
                            <li>
                              <a href="">پنکه</a>
                            </li>
                          </ul>
                          <ul class="list-search mt-3 ps-0">
                            <li>
                              <a href="">
                                <i class="fal fa-search ms-1"></i>
                                آب مرکبات گیری بوش مدل MCP3500N
                              </a>
                            </li>
                            <li>
                              <a href="">
                                <i class="fal fa-search ms-1"></i>
                                اسپرسوساز اسمگ مدل ECF01 آبی
                              </a>
                            </li>
                            <li>
                              <a href="">
                                <i class="fal fa-search ms-1"></i>
                                مخلوط کن اسمگ مدل BLF01
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
                    <button
                      type="button"
                      class="btn-text dropdown-toggle"
                      id="dropdownMenuButton2"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <div class="img-slice img-reg"></div>
                    </button>
                    <ul
                      class="dropdown-menu menu-account"
                      aria-labelledby="dropdownMenuButton2"
                    >
                      <li>
                        <span class="icon-user">
                          <a href=""> <i class="fal fa-user-lock"></i> ورود </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-users-medical"></i> عضویت
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <span class="m-user-img">
                              <img
                                src="{{ asset('new-theme/images/user.svg') }}"
                                class="img-fluid"
                                alt=""
                              />
                            </span>
                            <span class="m-lbl-text"> خوش آمدی :</span> علی عزیز
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-user-edit"></i> حساب کاربری
                          </a>
                        </span>
                      </li>
                      <li class="mh-club">
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-club"></i>
                            کلاب مه سنتر
                          </a>
                        </span>
                        <span class="club-rate"> 0 امتیاز </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-user-edit"></i>
                            سفارش ها
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-heart"></i>
                            لیست ها
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-comments"></i>
                            دیدگاه ها
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href="">
                            <i class="fal fa-bell"></i>
                            پیغام ها
                          </a>
                        </span>
                      </li>
                      <li>
                        <span class="icon-user">
                          <a href=""> <i class="far fa-sign-out"></i> خروج </a>
                        </span>
                      </li>
                    </ul>
                  </span>
                  <span class="gap"></span>
                  <span class="shop shop-link">
                    <button
                      type="button"
                      class="shop-link d-inline-block dropdown-toggle"
                      id="dropdownMenuButton1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <div class="img-slice img-shop position-relative">
                        <span class="count">0</span>
                      </div>
                    </button>
                    <ul
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <div class="mini-cart">
                        <div class="mini-cart-header">
                          <span class="mini-cart-products-count fa-num"
                            >1 کالا</span
                          >
                          <a class="btn btn-link px-0">مشاهده سبد خرید </a>
                        </div>
                        <div class="mini-cart-products do-simplebar">
                          <div class="simplebar-wrapper" style="margin: 0px">
                            <div class="simplebar-mask">
                              <div class="simplebar-offset">
                                <div class="simplebar-content-wrapper">
                                  <div class="simplebar-content">
                                    <div class="mini-cart-product">
                                      <div class="mini-cart-product-thumbnail">
                                        <a href="">
                                          <img src="{{ asset('new-theme/images/pro1.jpg') }}" alt=" " />
                                        </a>
                                      </div>
                                      <div class="mini-cart-product-detail">
                                        <div class="mini-cart-product-brand">
                                          <a href=""
                                            >ساندویچ ساز بلک پلاس دکر مدل
                                            TS4130</a
                                          >
                                        </div>
                                        <div class="mini-cart-product-title">
                                          <a href="">TS4130</a>
                                        </div>
                                        <div class="mini-cart-purchase-info">
                                          <div class="mini-cart-product-meta">
                                            <span class="fa-num">2 عدد</span>
                                          </div>
                                          <div
                                            class="mini-cart-product-price fa-num"
                                          >
                                            990,000
                                            <span class="currency">تومان</span>
                                          </div>
                                        </div>
                                        <form method="post" action="">
                                          <button
                                            type="submit"
                                            class="mini-cart-product-remove"
                                          >
                                            <i class="fal fa-times"></i>
                                          </button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mini-cart-footer">
                          <div class="mini-cart-total">
                            <span class="mini-cart-total-label"
                              >مبلغ قابل پرداخت:</span
                            >
                            <span class="mini-cart-total-value fa-num"
                              >990,000 <span class="currency">تومان</span>
                            </span>
                          </div>
                          <a href="" class="btn btn-primary"
                            >ورود و ثبت سفارش</a
                          >
                        </div>
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
                        <div
                          class="c-navi-new-list__sublist js-mega-menu-categories-options c-navi-new__ads-holder"
                          style="display: none"
                        >
                          <div class="c-navi-new-list__inner-categories">
                            <a
                              href=""
                              data-index="1"
                              class="c-navi-new-list__inner-category js-mega-menu-category c-navi-new-list__inner-category--hovered"
                            >
                              <span class="ico-menu">
                                <img
                                  src="{{ asset('new-theme/images/pro7.jpg') }}"
                                  class="img-fluid"
                                  alt=""
                                />
                              </span>
                              یخچال فریزر
                            </a>
                            <a
                              href=""
                              data-index="2"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img
                                  src="{{ asset('new-theme/images/pro8.jpg') }}"
                                  class="img-fluid"
                                  alt=""
                                />
                              </span>
                              شستشوونظافت</a
                            >
                            <a
                              href=""
                              data-index="3"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img
                                  src="{{ asset('new-theme/images/pro9.jpg') }}"
                                  class="img-fluid"
                                  alt=""
                                />
                              </span>
                              پخت و پز</a
                            >
                            <a
                              href=""
                              data-index="4"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img src="{{ asset('new-theme/images/pro10.jpg') }}" />
                              </span>
                              تهیه غذا</a
                            >
                            <a
                              href=""
                              data-index="5"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img src="{{ asset('new-theme/images/pro11.webp') }}" />
                              </span>
                              صوتی و تصويری</a
                            >
                            <a
                              href=""
                              data-index="6"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img src="{{ asset('new-theme/images/pro11.jpeg') }}" />
                              </span>
                              توکار</a
                            >
                            <a
                              href=""
                              data-index="7"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img src="{{ asset('new-theme/images/pro12webp.webp') }}" />
                              </span>
                              تهویه مطبوع</a
                            >
                            <a
                              href=""
                              data-index="8"
                              class="c-navi-new-list__inner-category js-mega-menu-category"
                            >
                              <span class="ico-menu">
                                <img src="{{ asset('new-theme/images/pro13.jpeg') }}" />
                              </span>
                              لوازم مکمل</a
                            >
                          </div>
                          <div class="c-navi-new-list__options-container">
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options is-active"
                              id="categories-1"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های یخچال فریزر
                                </a>
                              </div>
                              <ul class="p-0">
                                <!--تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span> ساید بای ساید</span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید دوو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید بوش
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید ال جی
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید مابه
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید جی پلاس
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید اسنوا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید بکو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید هیمالیا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    ساید بای ساید الکترواستیل
                                  </a>
                                </li>
                                <!--پایان دسته و زیر دسته اول-->
                                <!-- دوم تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span>یخچال فریزر دوقلو </span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو دوو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو بوش
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو اسنوا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو دیپوینت
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو بست
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو هیمالیا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوقلو الکترواستیل
                                  </a>
                                </li>
                                <!--پایان دسته و زیر دسته دوم-->
                                <!-- سوم تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span>یخچال فریزر </span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دوو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر اسنوا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر دیپوینت
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر الکترواستیل
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بست
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر هیمالیا
                                  </a>
                                </li>
                                <!-- سوم تکرار دسته و زیر ودسته-->
                                <!-- چهارم تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span>یخچال فریزر بالا </span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا دوو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا اسنوا
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا دیپوینت</a
                                  >
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا جی پلاس
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا ایستکول
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا بست
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    یخچال فریزر بالا بست
                                  </a>
                                </li>
                                <!--پایان دسته و زیر دسته چهارم-->
                                <!--تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span>یخچال / فریزر مینی بار </span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    مینی بار الکترواستیل
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    مینی بار ایستکول
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    مینی بار اسمگ
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    مینی بار دوو
                                  </a>
                                </li>
                                <!-- سوم تکرار دسته و زیر ودسته-->
                                <!-- چهارم تکرار دسته و زیر ودسته-->
                                <li
                                  class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                                >
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    <span>فریزر تک </span>
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    فریزر تک برفاب
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    فریزر تک دوو
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    فریزر تک ایستکول
                                  </a>
                                </li>
                                <li>
                                  <a
                                    href=""
                                    class="c-navi-new__big-display-title"
                                  >
                                    فریزر تک هیمالیا
                                  </a>
                                </li>
                                <!--پایان دسته و زیر دسته چهارم-->
                              </ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-3"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های زیر منو سوم
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-4"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های لوازم زیر منو چهارم
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-5"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                  >همه دسته‌بندی‌های زیر منو پنجم
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-6"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های سر منو
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-7"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href=""
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های سر منو
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                            <div
                              class="c-navi-new-list__options-list js-mega-menu-category-options"
                              id="categories-8"
                            >
                              <div class="c-navi-new-list__sublist-top-bar">
                                <a
                                  href="/"
                                  class="c-navi-new-list__sublist-see-all-cats"
                                >
                                  همه دسته‌بندی‌های سر منو
                                </a>
                              </div>
                              <ul></ul>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <a href=""> شگفت‌انگیزها </a>
                      </li>
                      <li>
                        <a href=""> کارت هدیه </a>
                      </li>
                      <li>
                        <a href=""> پرفروش‌ترین‌ها </a>
                      </li>
                      <li>
                        <a href=""> تخفیف‌ها و پیشنهادها </a>
                      </li>
                      <li>
                        <a href=""> سوالی دارید؟ </a>
                      </li>
                    </ul>
                  </li>
                  <li class="ms-auto">
                    <span class="number ms-2">
                      <a href="tel:+982133132373">
                        <i class="fal fa-phone"></i>
                        021-33132373
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
    <main class="container-fluid body-content ps-0 pe-0">
      <div class="c-navi-categories__overlay js-navi-overlay"></div>
      <section class="container-fluid slider p-0">
        <div class="row">
          <div class="col-12 p-0 slide-col position-relative">
            <div class="owl-carousel owl-theme owl-slider">
                @foreach($slider as $slide) 
                        <a class="item img-pro-banner" href="{{ $slide->url }}">
                          <img src="{{ asset($slide->image) }}" class="d-none d-md-block" alt="{{ $slide->heading }}"><!--عکس مناسب دسکتاپ-->
                          <img src="{{ asset($slide->image) }}" class="d-xl-none d-lg-none d-md-none" alt="{{ $slide->heading }}"><!--عکس مناسب گوشی-->
                        </a>
                @endforeach
            </div>
          </div>
        </div>
      </section>
      <section class="contaner-fluid pt-3 pb-3">
        <div class="container">
          <div class="row">
            <div class="col-lg-11 mx-auto col-12 p-0">
              <div class="owl-carousel owl-theme owl-category">
                @foreach($categories->orderedItems as $item)
                    <div class="item">
                      <a
                        class="main-img-category position-relative text-center"
                        href="{{ $item->url }}"
                      >
                        <div class="logo-category-image">
                          <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}" />
                        </div>
                        <div class="layer-category mt-4 mb-4">{{ $item->title }}</div>
                      </a>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid pe-2 ps-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 wnd">
              <div class="row align-items-center">
                <div class="col-md-2 col-5">
                  <div class="row">
                    <div class="col-12 p-0 text-center">
                      <img src="{{ asset('new-theme/images/Amazings.svg') }}" class="img-fluid" />
                    </div>
                    <div class="col-12 p-0 text-center">
                      <img
                        src="{{ asset('new-theme/images/off-image.png') }}"
                        class="img-fluid"
                        width="120"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="timer text-center">
                        <span
                          class="soon"
                          id="time1"
                          data-format="d,h,m,s"
                          data-face="slot doctor glow"
                          data-visual="ring color-light width-thin glow-progress"
                        ></span>
                      </div>
                      <div class="d-block text-center mb-3">
                        <a href="" class="more-wnd">
                          مشاهده همه <i class="fas fa-chevron-left"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-10 p-0 col-7">
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="owl-carousel owl-theme owl-wnd">
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro1.jpg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                ساندویچ ساز بلک پلاس دکر مدل TS4130
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro2.jpg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                ماشین لباسشویی دوو سری کاریزما مدل DWK-CH701S
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro3.jpeg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                آب مرکبات گیری بوش مدل MCP3500N
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro4.jpeg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                اسپرسوساز مباشی مدل ME-ECM2013
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro5.jpg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                اسپرسوساز اسمگ مدل ECF01 آبی
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item item-pro position-relative">
                          <div class="item-img">
                            <div
                              class="d-block favo-link mb-2 text-end pe-1 pt-1"
                            >
                              <button class="favo-btn-pro">
                                <i class="fal fa-heart"></i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <div class="img-pro position-relative">
                                  <a
                                    href=""
                                    target="_blank"
                                    class="position-relative"
                                  >
                                    <img
                                      src="{{ asset('new-theme/images/pro6.jpg') }}"
                                      class="img-fluid"
                                      alt=""
                                    />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row name-col mt-1">
                            <div
                              class="col-12 pro-name-special position-relative"
                            >
                              <a class="d-block pro-name" href="">
                                مخلوط کن اسمگ مدل BLF01 قرمز
                              </a>
                            </div>
                          </div>
                          <div class="row mt-3 align-items-flex-end cost-col">
                            <div class="col-2">
                              <button class="btn-add">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg') }}"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="#fff"
                                  aria-hidden="true"
                                  class="absolute-center ts-white h-7 w-7"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                  ></path>
                                </svg>
                              </button>
                            </div>
                            <div
                              class="col-10 cost text-end ps-0 off-pro mb-2 mt-2"
                            >
                              <div class="d-block">
                                <span class="old-cost me-2"
                                  >372،300 <span class="unit">تومان</span>
                                </span>
                                <span class="offer">
                                  <span class="off">40 %</span>
                                </span>
                              </div>
                              <div class="d-block mt-1">
                                <span class="cost-total">372،300</span>
                                <span class="unit">تومان</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid pe-2 ps-2 mt-3">
        <div class="container ps-0 pe-0">
          <div class="row">
            <div class="col-lg-12 mx-auto col-12 p-0">
                @foreach($supermarket->orderedItems as $item)
                    <a href="{{ $item->url }}" class="d-block text-center">
                        <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}" />
                    </a>
                @endforeach
              {{--<div class="row align-items-center">
                <div class="col-md-6 col-12 ps-md-0">
                  <div class="d-md-flex flex-item">
                    <div class="d-flex align-items-center">
                      <div>
                        <img src="{{ asset('new-theme/images/fresh.png') }}" class="img-fluid" />
                      </div>
                      <div class="ms-2 me-2">
                        <img
                          src="{{ asset('new-theme/images/fresh-incredible-offer.svg') }}"
                          class="img-fluid"
                        />
                      </div>
                    </div>
                    <div>
                      <a href="" class="link-item">تا ۶۲٪ تخفیف</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12 pe-md-0 text-md-end mt-xs-15">
                  <div class="d-flex flex-link">
                    <div class="d-flex flex-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                        <span class="price-discount-percent">62%</span>
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                        <span class="price-discount-percent">22%</span>
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                        <span class="price-discount-percent">30%</span>
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                        <span class="price-discount-percent">42%</span>
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                        <span class="price-discount-percent">19%</span>
                      </a>
                    </div>
                    <div>
                      <a href="" class="all-pro">
                        <span>بیش از ۱۰۰ کالا</span>
                        <i class="fal fa-arrow-left"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>--}}
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid banner-section pt-3 pb-3 pe-0 ps-0">
        <div class="container p-0">
            <div class="row">
                @foreach($belowSupermarket->orderedItems as $item)
                    <div class="col-md-3 col-6 mt-xs-15 ps-2 pe-2">
                        <a href="{{ $item->url }}" class="d-block text-center">
                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
      </section>
      <section class="container-fluid logo-section pt-3 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 text-center">
              <h4 class="title-section">محبوب‌ترین محصولات</h4>
            </div>
          </div>
          <div class="row mt-2 mb-3 brand-section">
            <div class="col-12 ps-0 pe-0 pt-3 pb-3">
              <div class="owl-carousel owl-theme owl-logo">
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro7.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid banner-section pe-2 ps-2 pt-md-3 pb-md-3">
        <div class="container p-0">
            <div class="row">
              @foreach($belowProducts->orderedItems as $item)
                    <div class="col-md-6 col-12 ps-2 pe-2 mt-xs-15">
                        <a href="{{ $item->url }}" class="d-block">
                            <img src="{{ asset($item->image) }}" class="img-fluid w-100" alt="{{ $item->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
      </section>
      <section class="container-fluid category-section pe-2 ps-2 pt-3 pb-3">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0">
              <div class="gird row-category">
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهویه مطبوع</h4>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهیه غذا</h4>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">نوشیدنی ساز</h4>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهیه غذا</h4>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid logo-section pt-3 pb-2">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0 text-center">
              <h4 class="title-section">محبوب‌ترین برندها</h4>
            </div>
          </div>
          <div class="row mt-2 mb-3 brand-section">
            <div class="col-12 ps-0 pe-0 pt-3 pb-3">
              <div class="owl-carousel owl-theme owl-logo">
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo1.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo2.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo3.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo4.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo5.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo6.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo7.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo1.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
                <div class="item">
                  <a class="inline-bllock" href="">
                    <img src="{{ asset('new-theme/images/logo2.jpg') }}" class="img-fluid" alt="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid best-saler-section pe-2 ps-2 pt-3 pb-3">
        <div class="container">
          <div class="row mt-2">
            <div class="col-12 p-0 text-center title-section">
              پرفروش‌ترین کالاهای ماه
            </div>
          </div>
          <div class="mt-3">
            <div class="col-12">
              <div class="owl-carousel owl-theme owl-best-pro">
                <div class="item">
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">1</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">2</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">3</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                </div>
                <div class="item">
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">4</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">5</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">6</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                </div>
                <div class="item">
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">7</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">8</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">9</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                </div>
                <div class="item">
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">10</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">11</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">12</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                </div>
                <div class="item">
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">1</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">2</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                  <a class="d-flex">
                    <div class="flex-img">
                      <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                    </div>
                    <span class="counter-item">3</span>
                    <div class="flex-pro position-relative">
                      <p>ساندویچ ساز بلک پلاس دکر مدل TS4130</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid pe-2 ps-2 club-section mt-3">
        <div class="container ps-0 pe-0">
          <div class="row">
            <div class="col-lg-11 mx-auto col-12 p-0">
              <div class="row align-items-center">
                <div class="col-md-6 col-12 ps-md-0">
                  <img src="{{ asset('new-theme/images/mahsenter.png') }}" class="img-fluid" alt="" />
                </div>
                <div class="col-md-6 col-12 pe-md-0 text-md-end">
                  <div class="d-flex flex-club">
                    <a class="d-flex club-item" href="">
                      <div class="lbl-club ms-3">
                        <i class="fal fa-bullseye-arrow"></i>
                        ماموریت ها
                      </div>
                      <div class="img-club">
                        <img
                          src="{{ asset('new-theme/images/missions.png') }}"
                          class="img-fluid"
                          alt=""
                        />
                      </div>
                    </a>
                    <a class="d-flex club-item" href="">
                      <div class="lbl-club ms-3">
                        <i class="fal fa-gifts"></i>
                        جایزه ها
                      </div>
                      <div class="img-club">
                        <img src="{{ asset('new-theme/images/awards.png') }}" class="img-fluid" alt="" />
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid category-section pe-2 ps-2 pt-3 pb-3">
        <div class="container p-0">
          <div class="row">
            <div class="col-12 p-0">
              <div class="gird row-category">
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهویه مطبوع</h4>
                  <p class="text-caption">بر اساس بازدیدهای شما</p>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهیه غذا</h4>
                  <p class="text-caption">بر اساس بازدیدهای شما</p>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">نوشیدنی ساز</h4>
                  <p class="text-caption">بر اساس بازدیدهای شما</p>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro3.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro4.jpeg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
                <div class="d-flex flex-col">
                  <h4 class="title-section">تهیه غذا</h4>
                  <p class="text-caption">بر اساس بازدیدهای شما</p>
                  <div class="d-block mt-2">
                    <div class="grid grid-pro">
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro5.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro6.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro2.jpg') }}" class="img-fluid" alt="" />
                      </a>
                      <a href="">
                        <img src="{{ asset('new-theme/images/pro1.jpg') }}" class="img-fluid" alt="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-block mt-2 text-center">
                    <a href="" class="more">
                      مشاهده <i class="fas fa-chevron-left"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="container-fluid news-section pe-2 ps-2 pt-3 pb-3">
        <div class="container p-0">
          <div class="row align-items-center">
            <div class="col-md-6 col-8 ps-0">
              <h4 class="title-section">خواندنی ها</h4>
            </div>
            <div class="col-md-6 col-4 pe-0 text-end">
              <a href="{{ url('articles') }}" class="more-product">
                مشاهده همه <i class="fal fa-long-arrow-left"></i>
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 p-0">
              <div class="owl-carousel owl-theme owl-news">
                @foreach($articles as $article)
                <div class="item position-relative">
                  <div class="item-img position-relative">
                    <div class="d-block img-special">
                      <img src="{{ asset(\App\ImageManager::resize($article->image, ['width' => 404, 'height' => 224])) }}" alt="{{ $article->title }}" />
                    </div>
                    <a href="" class="layer-item" target="_blank">
                      <div class="item-layer">
                        <div class="short-desc-blog mt-2">
                          {{ $article->title }}
                          <i class="fal fa-chevron-left"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
      <!---FOOTER-->
      <footer class="container-fluid footer position-relative ps-md-0 pe-md-0 mt-4 p-xs-0">
        <section class="container-fluid">
          <div class="container p-xs-0">
            <div class="row">
              <div class="col-12 p-0">
                <div class="row">
                  <div class="col-xl-9 col-lg-8 col-md-12 p-0">
                    <div class="row pt-md-5">
                      <div class="col-md-6 col-12 p-xs-0">
                        <div class="row">
                          <div
                            class="col-lg-10 col-md-11 col-12 p-0 me-auto info-contact"
                          >
                            <ul class="p-0 footer-contact">
                              <li>
                                <span class="icon-li">
                                  <span class="tel-icon">
                                    <i class="fal fa-phone"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                  <span class="bld d-block">
                                    کارشناش فروش:
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:021-33132373" class="cal"
                                      >021-33132373</a
                                    >
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:021-33132398" class="cal"
                                      >021-33132398</a
                                    >
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:0912 2109737" class="cal"
                                      >0912 2109737</a
                                    >
                                  </span>
                                </span>
                              </li>
                              <li>
                                <span class="icon-li">
                                  <span class="map-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                  <span class="bld d-block"> آدرس: </span>
                                  تهران- خیابان امین حضور- بعد از پاساژ سهامی-
                                  پلاک 733- طبقه
                                </span>
                              </li>
                              <li>
                                <span class="icon-li">
                                  <span class="email-icon">
                                    <i class="fal fa-envelope"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                  <span class="bld"> پست الکترونیکی: </span>
                                  <span>
                                    <a
                                      class="cal"
                                      href="mail:info@mahcenter.com"
                                      >info[at]mahcenter.com</a
                                    >
                                  </span>
                                </span>
                              </li>
                              <li>
                                <span class="icon-li">
                                  <span class="email-icon">
                                    <i class="fal fa-fax"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                  <span class="bld"> فکـــس: </span>
                                  <span class="cal">021-33544472</span>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div
                        class="col-md-3 col-12 pe-md-2 ps-md-0 accordion-container"
                      >
                        <div class="set">
                          <span class="title-footer lnk-footer un-link">
                            راهنمای خرید
                            <i
                              class="fa-chevron-down fas fa-chevron-up"
                              aria-hidden="false"
                            ></i>
                          </span>
                          <div class="content">
                            <ul class="lnk-footers">
                              <li>
                                <a href=""> پرسش هاي متداول</a>
                              </li>
                              <li>
                                <a href=""> نحوه ثبت سفارش </a>
                              </li>
                              <li>
                                <a href=""> هزینه ارسال </a>
                              </li>
                              <li>
                                <a href="">درباره ما</a>
                              </li>
                              <li>
                                <a href="">تماس با ما </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div
                        class="col-md-3 col-12 pe-md-2 ps-md-0 accordion-container"
                      >
                        <div class="set">
                          <span class="title-footer lnk-footer un-link">
                            دسته بندی ها
                            <i
                              class="fa-chevron-down fas fa-chevron-up"
                              aria-hidden="false"
                            ></i>
                          </span>
                          <div class="content">
                            <ul class="lnk-footers">
                              <li>
                                <a href="">انواع ماشین ظرفشویی </a>
                              </li>
                              <li>
                                <a href="">انواع یخچال فریزر </a>
                              </li>
                              <li>
                                <a href=""> انواع چای ساز </a>
                              </li>
                              <li>
                                <a href=""> انواع ماشین لباسشویی </a>
                              </li>
                              <li>
                                <a href=""> انواع تلویزیون دوو </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-12 pe-md-0 mt-xs-15">
                    <div class="row">
                      <div class="col-lg-12 col-md-6 mx-auto p-0">
                        <div class="row pt-md-5">
                          <div class="col-md-12 col-12 pe-md-2 ps-md-0">
                            <div class="title-footer">
                              ما را در شبکه های اجتماعی دنبال کنید
                            </div>
                            <div class="d-block sotial-footer">
                              <ul class="social-box p-0 text-center ms-auto">
                                <li>
                                  <a href="">
                                    <img
                                      src="{{ asset('new-theme/images/instagram.png') }}"
                                      class="img-fluid"
                                      alt="instagram"
                                    />
                                  </a>
                                </li>
                                <li>
                                  <a href="">
                                    <img
                                      src="{{ asset('new-theme/images/aparat.png') }}"
                                      class="img-fluid"
                                      alt="aparat"
                                    />
                                  </a>
                                </li>
                                <li>
                                  <a href="">
                                    <img
                                      src="{{ asset('new-theme/images/whatsapp.png') }}"
                                      class="img-fluid"
                                      alt="instagram"
                                    />
                                  </a>
                                </li>
                                <li>
                                  <a href="">
                                    <img
                                      src="{{ asset('new-theme/images/telegram.png') }}"
                                      class="img-fluid"
                                      alt="instagram"
                                    />
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12 p-0">
                            <div class="title-footer">
                              از تخفیف‌ها و جدیدترین‌های مَه سنتر باخبر شوید:
                            </div>
                            <div class="d-block">
                              <form class="form-news-letter" action="#">
                                <input
                                  type="text"
                                  placeholder="مثلا : hi@mahcenter.com"
                                />
                                <button class="btn btn-news-letter">
                                  <i class="fas fa-paper-plane"></i>
                                </button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2 mb-2 row-send">
              <div class="col-lg-9 col-md-8 col-12 ps-m-0">
                <div class="owl-carousel owl-theme owl-send">
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img
                        src="{{ asset('new-theme/images/original-products.svg') }}"
                        class="img-fluid"
                        alt=""
                      />
                    </div>
                    <div class="d-block text-send">ضمانت اصلي بودن كالا</div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img
                        src="{{ asset('new-theme/images/cash-on-delivery.svg') }}"
                        class="img-fluid"
                        alt=""
                      />
                    </div>
                    <div class="d-block text-send">امکان پرداخت در محل</div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img src="{{ asset('new-theme/images/support.svg') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="d-block text-send">۷ روز ﻫﻔﺘﻪ، ۲۴ ﺳﺎﻋﺘﻪ</div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img
                        src="{{ asset('new-theme/images/days-return.svg') }}"
                        class="img-fluid"
                        alt=""
                      />
                    </div>
                    <div class="d-block text-send">
                      هفت روز ضمانت بازگشت کالا
                    </div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img
                        src="{{ asset('new-theme/images/express-delivery.svg') }}"
                        class="img-fluid"
                        alt=""
                      />
                    </div>
                    <div class="d-block text-send">اﻣﮑﺎن ﺗﺤﻮﯾﻞ اﮐﺴﭙﺮس</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 pe-md-0 text-center">
                <div class="time-link">
                  <span>ساعت پاسخگویی: </span>
                  <span class="tel">9:00</span>
                  <span>الی: </span>
                  <span class="tel">19:00</span>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="container-fluid about-company-section">
          <div class="container p-0">
            <div class="row">
              <div class="col-lg-8 col-md-7 p-xs-0">
                <div
                  class="d-block about-me c-desc-wrapper shaodow position-relative"
                >
                  <div class="about-company c-desc">
                    <h1>
                      <strong
                        >فروشگاه اینترنتی مَه سنتر، بررسی، انتخاب و خرید
                        آنلاین</strong
                      >
                    </h1>
                    <p>
                      فروشگاه مَه سنتر نمایندگی رسمی برندهای دوو و مکسیدر است.
                      علاوه بر این، برندهای معتبری مانند بوش، فیلیپس، تفال،
                      دلونگی و... در این فروشگاه عرضه می شود. این مجموعه سابقه‌ی
                      درخشان 30 ساله در زمینه فروش لوازم خانگی به صورت اینترنتی
                      و حضوری داشته است. هدف مجموعه مَه سنتر فروش کالا با حداقل
                      سود و بهترین خدمات بوده است. لذا شما عزیزان می‌توانید
                      کالای دلخواه خود را با بهترین قیمت در کوتاه‌ترین زمان ممکن
                      در هر کجای کشور دریافت کنید. از دیگر مزایای مجموعه مَه
                      سنتر می توان به شیوه‌های مختلف پرداخت و ارسال اشاره کرد.
                    </p>
                    <p>
                      فروشگاه مه سنتر فروشگاهي است با دارابودن بيش از 1000مدل
                      لوازم برقي خانگي از جمله اجناس بزرگ و كوچك كاربردي در
                      منازل ، اماكن ، ادارات و امثال آن ها
                    </p>
                    <p>
                      با فروشگاه مه سنتر مي توانيد بيشتر انتظار داشته باشيد اما
                      كمتر پرداخت كنيد و هر آنچه كه نیاز دارید درب منزل تحويل
                      بگيريد هدف تیم مه سنتر این است که با کمترین قیمت بالاترین
                      خدمت رسانی را به شما مشتریان گرامی ارائه دهد
                    </p>
                    <p>
                      شما مي توانيد قبل از خريد قيمت ها را مقايسه و با اطمينان
                      كامل از فروشگاه مه سنتر خريداری نماييد
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-12 more-view-info p-0">
                    <button class="c-more-info more more-desc-info">
                      <span class="mores"
                        >مشاهده بیشتر <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="less"> بستن </span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 text-md-end mt-xs-15">
                <ul class="namd p-0">
                  <li>
                    <img src="{{ asset('new-theme/images/namad2.png') }}" />
                  </li>
                  <li>
                    <img src="{{ asset('new-theme/images/namad3.png') }}" />
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <section class="container-fluid copy">
          <div class="container p-xs-0">
            <div class="row">
              <div class="col-lg-12 mx-auto p-0">
                <div class="row">
                  <div class="col-md-6 col-12 p-0">
                    <span class="c-left">
                      کلیه حقوق این سایت متعلق به
                      <span class="color-footer"> فروشگاه مَه سنتر </span> می
                      باشد
                    </span>
                  </div>
                  <div class="col-md-6 p-0 text-lg-end">
                    <span class="c-right ms-md-3">
                      هر چی که مي خواهيد ! درب منزل تحویل بگیرید.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </footer>
      <!--نمایش در حالت گوشی-->
      <div class="toolbar d-xl-none d-lg-none">
        <ul class="p-0">
          <li>
            <a href="">
              <div class="icon-toolbar">
                <i class="fal fa-home"></i>
              </div>
              <div class="d-block lbl-menu">خانه</div>
            </a>
          </li>
          <li>
            <span class="menuTrigger">
              <div class="icon-toolbar">
                <svg
                  xmlns="http://www.w3.org/2000/svg') }}"
                  width="20"
                  height="20"
                  fill="currentColor"
                  class="bi bi-ui-checks-grid"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z"
                  ></path>
                </svg>
              </div>
              <div class="d-block lbl-menu">دسته بندی ها</div>
            </span>
          </li>
          <li class="shop">
            <a href="" class="shop-link">
              <div class="icon-toolbar">
                <span class="img-shop position-relative img-slice">
                  <span class="count">0</span>
                </span>
              </div>
              <div class="d-block lbl-menu">سبد خرید</div>
            </a>
          </li>
          <li class="shop">
            <a href="" class="shop-link">
              <div class="icon-toolbar">
                <div class="img-slice img-reg"></div>
              </div>
              <div class="d-block lbl-menu">پروفایل من</div>
            </a>
          </li>
        </ul>
      </div>
    </main>
    <!--chat-->
    <div id="wa" class="wa__widget_container">
      <div
        class="wa__btn_popup"
        style="left: unset; left: 10px; bottom: 12px"
      >
        <div
          class="wa__btn_popup_icon"
          style="background: #ed1944 ;"
        ></div>
      </div>
      <div
        class="wa__popup_chat_box"
        style="left: unset; left: 10px; bottom: 80px"
      >
        <div class="wa__popup_heading" style="background: #ed1944 ;">
          <div class="wa__popup_title" style="color: #fff">شروع مکالمه</div>
        </div>
        <div class="wa__popup_content wa__popup_content_left">
          <div class="wa__popup_notice">
            همکاران ما در کوتاه ترین زمان ممکن پاسخگو هستند
          </div>
          <div class="wa__popup_content_list">
            <div class="wa__popup_content_item">
              <a
                target="_blank"
                href="https://wa.me/98"
                class="wa__stt wa__stt_online"
              >
                <div class="wa__popup_avatar nta-default-avt">
                  <svg
                    width="48px"
                    height="48px"
                    class="nta-whatsapp-default-avatar"
                    version="1.1"
                    id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg') }}"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px"
                    y="0px"
                    viewBox="0 0 512 512"
                    style="enable-background: new 0 0 512 512"
                    xml:space="preserve"
                  >
                    <path
                      style="fill: #ededed"
                      d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0
       S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z"
                    ></path>
                    <path
                      style="fill: #55cd6c"
                      d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662
       c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234
       c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z"
                    ></path>
                    <path
                      style="fill: #fefefe"
                      d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297
       c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048
       c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359
       c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248
       c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062
       l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945"
                    ></path>
                  </svg>
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی واتس اپ</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a
                target="_blank"
                href="https://t.me/"
                class="wa__stt wa__stt_online"
              >
                <div class="wa__popup_avatar nta-default-avt">
                  <img
                    src="{{ asset('new-theme/https://ir125.com/images/m-telegram.png') }}"
                    width="45"
                    data-loaded="true"
                  />
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی تلگرام</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a
                target="_blank"
                href="https://eitaa.com/"
                class="wa__stt wa__stt_online"
              >
                <div class="wa__popup_avatar nta-default-avt">
                  <img
                    src="{{ asset('new-theme/https://ir125.com/images/eita-logo.png') }}"
                    width="45"
                    data-loaded="true"
                  />
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی ایتا</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a
                target="_blank"
                href="https://instagram.com/"
                class="wa__stt wa__stt_online"
              >
                <div class="wa__popup_avatar nta-default-avt">
                  <img
                    src="{{ asset('new-theme/https://ir125.com/images/instagram-1.png') }}"
                    width="45"
                    data-loaded="true"
                  />
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی اینستاگرام</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a
                target="_blank"
                href="tel:+98"
                class="wa__stt wa__stt_online"
              >
                <div class="wa__popup_avatar nta-default-avt">
                  <img
                    src="{{ asset('new-theme/https://ir125.com/images/cal.png') }}"
                    width="52"
                    data-loaded="true"
                  />
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">تلفن تماس</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('new-theme/js/main-min.js') }}"></script>
    <script src="{{ asset('new-theme/js/script.js') }}"></script>
    <script>
      $("#time1").soon().create({
        due: "2024-6-21",
        separator: ":",
        layout: "group",
      });
    </script>
  </body>
</html>
