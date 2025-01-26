<!---FOOTER-->
      <footer class="container-fluid footer position-relative ps-md-0 pe-md-0  mt-3 p-xs-0">
        <section class="container-fluid">
          <div class="container p-xs-0">
            <div class="row">
              <div class="col-12 p-0">
                <div class="row">
                  <div class="col-xl-9 col-lg-8 col-md-12 p-0">
                    <div class="row pt-md-5">
                      <div class="col-md-6 col-12 p-xs-0">
                        <div class="row">
                          <div class="col-lg-10 col-md-11 col-12 p-0 me-auto info-contact">
                            <ul class="p-0 footer-contact">
                              <li>
                                <span class="icon-li">
                                  <span class="tel-icon">
                                    <i class="fal fa-phone"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                  <span class="bld d-block">
                                    کارشناس فروش:
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:{{ str_replace(' ', '', str_replace('-', '', $site_settings['mobile'])) }}" class="cal">{{ $site_settings['mobile'] }}</a>
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:{{ str_replace(' ', '', str_replace('-', '', $site_settings['tel-2'])) }}" class="cal">{{ $site_settings['tel-2'] }}</a>
                                  </span>
                                  <span class="sale-cal">
                                    <a href="tel:{{ str_replace(' ', '', str_replace('-', '', $site_settings['tel'])) }}" class="cal">{{ $site_settings['tel'] }}</a>
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
                                  {{ $site_settings['address'] }}
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
                                    <a href="mail:{{ $site_settings['email'] }}" class="cal">{{ $site_settings['email'] }}</a>
                                  </span>
                                </span>
                              </li>
                              <li>
                                <span class="icon-li">
                                  <span class="email-icon">
                                    <i class="fal fa-clock"></i>
                                  </span>
                                </span>
                                <span class="text-li">
                                    <div class="time-link">
                                      <span>ساعت پاسخگویی: </span>
                                      {!! $site_settings['response-time'] !!}
                                    </div>
                                  {{--<span class="bld"> ساعات پاسخگویی: </span>
                                  <span class="cal">{!! $site_settings['response-time'] !!}</span>--}}
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-12 pe-md-2 ps-md-0 accordion-container">
                          @if($customerServices->is_active)
                            <div class="set">
                                <span class="title-footer lnk-footer un-link">
                                {{ $customerServices->name }}
                                <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
                                </span>
                                <div class="content">
                                    <ul class="lnk-footers">
                                        @foreach($customerServices->items as $item)
                                        @if($item->is_active)
                                        <li>
                                            <a href="{{ parse_url_rel($item->url) }}">{{ $item->heading }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                          @endif
                      </div>
                      <div class="col-md-3 col-12 pe-md-2 ps-md-0 accordion-container">
                        @if($saleGuides->is_active)
                        <div class="set">
                            <span class="title-footer lnk-footer un-link">
                                {{ $saleGuides->name }}
                                <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
                            </span>
                            <div class="content">
                                <ul class="lnk-footers">
                                    @foreach($saleGuides->items as $item)
                                    @if($item->is_active)
                                    <li>
                                        <a href="{{ parse_url_rel($item->url) }}">{{ $item->heading }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
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
                                @if($site_settings['instagram'])
                                <li>
                                  <a href="{{ $site_settings['instagram'] }}">
                                    <img src="{{ asset('new-theme/images/instagram.png') }}" class="img-fluid" alt="instagram"/>
                                  </a>
                                </li>
                                @endif
                                @if($site_settings['aparat'])
                                <li>
                                  <a href="{{ $site_settings['aparat'] }}">
                                    <img src="{{ asset('new-theme/images/aparat.png') }}" class="img-fluid" alt="aparat"/>
                                  </a>
                                </li>
                                @endif
                                @if($site_settings['whatsapp'])
                                <li>
                                  <a href="{{ $site_settings['whatsapp'] }}">
                                    <img src="{{ asset('new-theme/images/whatsapp.png') }}" class="img-fluid" alt="instagram"/>
                                  </a>
                                </li>
                                @endif
                                @if($site_settings['telegram'])
                                <li>
                                  <a href="{{ $site_settings['telegram'] }}">
                                    <img src="{{ asset('new-theme/images/telegram.png') }}" class="img-fluid" alt="instagram"/>
                                  </a>
                                </li>
                                @endif
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
                                <input type="text" placeholder="مثلا : info@mahcenter.com"/>
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
                      <img src="{{ asset('new-theme/images/original-products.svg') }}" class="img-fluid" alt=""/>
                    </div>
                    <div class="d-block text-send">ضمانت اصلی بودن كالا</div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img src="{{ asset('new-theme/images/cash-on-delivery.svg') }}" class="img-fluid" alt=""/>
                    </div>
                    <div class="d-block text-send">امکان پرداخت در محل</div>
                  </div>
                  {{--<div class="item text-center">
                    <div class="d-block img-send">
                      <img src="{{ asset('new-theme/images/support.svg') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="d-block text-send">۷ روز ﻫﻔﺘﻪ، ۲۴ ﺳﺎﻋﺘﻪ</div>
                  </div>
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img src="{{ asset('new-theme/images/days-return.svg') }}" class="img-fluid" alt=""/>
                    </div>
                    <div class="d-block text-send">
                      هفت روز ضمانت بازگشت کالا
                    </div>
                  </div>--}}
                  <div class="item text-center">
                    <div class="d-block img-send">
                      <img src="{{ asset('new-theme/images/express-delivery.svg') }}" class="img-fluid" alt=""/>
                    </div>
                    <div class="d-block text-send">اﻣﮑﺎن ﺗﺤﻮﯾﻞ اﮐﺴﭙﺮس</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 pe-md-0 text-center">
                  
              </div>
            </div>
          </div>
        </section>
        <section class="container-fluid about-company-section">
          <div class="container p-0">
            <div class="row">
              <div class="col-lg-8 col-md-7 p-xs-0">
                <div class="d-block about-me position-relative">
                  <div class="about-company">
                    <strong class="heading h6">{{ $site_settings['footer_heading'] }}</strong>
                    <p>{{ $site_settings['footer_content'] }}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 text-md-end mt-xs-15">
                <ul class="namd p-0">
                  <li>
                    <img referrerpolicy='origin' id='rgvjjxlzjzpenbqefukzoeuk' style='cursor:pointer' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=317268&p=xlaorfthjyoeuiwkgvkamcsi", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt='logo-samandehi' src='https://logo.samandehi.ir/logo.aspx?id=317268&p=qftinbpdyndtodrfwlbqaqgw' />
                  </li>
                  <li>
                    <a href="https://trustseal.enamad.ir/?id=293149&Code=ZDOLxksv2HvWXUlf1iMG"><img  style = 'cursor:pointer' alt = 'logo-samandehi' src = 'https://mahcenter.com/images/enamad.png' /></a>
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
                            {!! $site_settings['copyright'] !!}
                        </span>
                    </div>
                    <div class="col-md-6 p-0 text-lg-end">
                        <span class="c-right ms-md-3">
                            کلیه حقوق این سایت متعلق به
                          <span class="color-footer"> فروشگاه مَه سنتر </span> می
                          باشد.
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
            <a href="{{ route('home') }}">
              <div class="icon-toolbar">
                <i class="fal fa-home"></i>
              </div>
              <div class="d-block lbl-menu">خانه</div>
            </a>
          </li>
          <li>
            <span class="menuTrigger">
              <div class="icon-toolbar">
                <svg xmlns="http://www.w3.org/2000/svg') }}" width="20" height="20" fill="currentColor" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                  <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z"></path>
                </svg>
              </div>
              <div class="d-block lbl-menu">دسته بندی ها</div>
            </span>
          </li>
          <li class="shop">
            <a href="{{ url('cart') }}" class="shop-link">
              <div class="icon-toolbar">
                <span class="img-shop position-relative img-slice">
                  <span class="itemsInBasket">{{ $itemsInBasket['quantity'] }}</span>
                </span>
              </div>
              <div class="d-block lbl-menu">سبد خرید</div>
            </a>
          </li>
          @guest
          <li class="shop">
            <a href="{{ route('login') }}" class="shop-link">
              <div class="icon-toolbar">
                <div class="img-slice img-reg"></div>
              </div>
              <div class="d-block lbl-menu">ورود</div>
            </a>
          </li>
          @else
          <li class="shop">
            <a href="{{ route('panel.index') }}" class="shop-link">
              <div class="icon-toolbar">
                <div class="img-slice img-reg"></div>
              </div>
              <div class="d-block lbl-menu">پروفایل من</div>
            </a>
          </li>
          @endguest
        </ul>
      </div>
    </main>
    <!--chat-->
    <div id="wa" class="wa__widget_container">
      <div class="wa__btn_popup">
        <div class="wa__btn_popup_icon"></div>
      </div>
      <div
        class="wa__popup_chat_box">
        <div class="wa__popup_heading">
          <div class="wa__popup_title">شروع مکالمه</div>
        </div>
        <div class="wa__popup_content wa__popup_content_left">
          <div class="wa__popup_notice">
            همکاران ما در کوتاه ترین زمان ممکن پاسخگو هستند
          </div>
          <div class="wa__popup_content_list">
            <div class="wa__popup_content_item">
              <a target="_blank" href="{{ $site_settings['whatsapp'] }}" rel="nofollow" class="wa__stt wa__stt_online">
                <div class="wa__popup_avatar nta-default-avt">
                  <svg width="48px" height="48px" class="nta-whatsapp-default-avatar" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg') }}" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve">
                    <path style="fill: #ededed" d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0 S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z"></path>
                    <path style="fill: #55cd6c" d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662 c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234 c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z"></path>
                    <path
                      style="fill: #fefefe" d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297 c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048 c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359 c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248 c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062 l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945"></path>
                  </svg>
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی واتس اپ</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a target="_blank" href="#" class="wa__stt wa__stt_online">
                <div class="wa__popup_avatar nta-default-avt">
                  <img src="{{ asset('new-theme/images/telegram-logo.png') }}" width="45" data-loaded="true"/>
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی تلگرام</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a target="_blank" href="#" class="wa__stt wa__stt_online">
                <div class="wa__popup_avatar nta-default-avt">
                  <img src="{{ asset('new-theme/images/eita-logo.png') }}" width="45" data-loaded="true"/>
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی ایتا</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a target="_blank" href="{{ $site_settings['instagram'] }}" rel="nofollow" class="wa__stt wa__stt_online">
                <div class="wa__popup_avatar nta-default-avt">
                  <img src="{{ asset('new-theme/images/instagram-logo.png') }}" width="45" data-loaded="true"/>
                </div>
                <div class="wa__popup_txt">
                  <div class="wa__member_name">پشتیبانی اینستاگرام</div>
                </div>
              </a>
            </div>
            <div class="wa__popup_content_item">
              <a target="_blank" href="tel:09122109737" class="wa__stt wa__stt_online">
                <div class="wa__popup_avatar nta-default-avt">
                  <img src="{{ asset('new-theme/images/cal-logo.png') }}" width="52" data-loaded="true"/>
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
    {!! $site_settings['scripts'] !!}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SJEH0VFZRE"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-SJEH0VFZRE');
    </script>