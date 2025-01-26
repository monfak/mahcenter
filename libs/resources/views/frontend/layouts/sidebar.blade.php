<aside class="main-sidebar col-md-3 col-sm-5 col-12">
    <section id="column-left" class="pt-3 pb-3">
        <div class="d-block ps-3 pe-3">
            <div class="d-flex justify-between items-center">
                <div class="n-user">
                    {{ auth()->user()->name }}
                </div>
                <div>
                    <a href="{{ route('panel.edit') }}">
                        <svg style="width: 20px; height: 20px; fill:#19bfd3;">
                            <use xlink:href="#edit">
                                <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol> 
                            </use>m
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @if(auth()->check() && auth()->id() == 2)
            <div class="d-block ps-3 pe-3 mt-4">
                <div class="d-flex justify-between items-center">
                    <div>
                        کیف پول
                    </div>
                    <div>
                        -
                        <span class="unit">تومان</span>
                    </div>
                </div>
            </div>
            <div  class="d-flex items-center link-bag ps-3 pe-3 mt-2">
                فعالسازی 
                <a class="d-flex" href="">
                    <svg style="width: 20px; height: 20px; fill: #19bfd3;">
                        <use xlink:href="#chevronLeft">
                            <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path></symbol>
                        </use>
                    </svg>
                </a>
            </div>
            <div class="d-block ps-3 pe-3 mt-4">
                <div class="d-flex justify-between items-center">
                    <div>
                        مه کلاب
                    </div>
                    <div>
                        12
                        <span class="unit">امتیاز</span>
                    </div>
                </div>
            </div>
            <div  class="d-flex items-center link-bag ps-3 pe-3 mt-2">
                <a class="d-flex" href="">
                    مشاهده ماموریت ها
                    <svg style="width: 20px; height: 20px; fill: #19bfd3;">
                        <use xlink:href="#chevronLeft">
                            <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path></symbol>
                        </use>
                    </svg>
                </a>
            </div>
            @endif
            @if($panelSidebar->status)
            <div class="d-block mt-3">
                @foreach($panelSidebar->orderedItems as $item)
                    <a href="{{ $item->url }}" class="d-block">
                        <img src="{{ asset($item->image) }}" class="img-fluid w-100" alt="{{ $item->title }}">
                    </a>
                @endforeach
            </div>
            @endif
            <ul class="group-items mt-3">
                <li>
                    <a href="{{ route('panel.index') }}" class="{{ request()->route()->getName() == 'panel.index'  ? 'active':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="width: 24px; height: 24px;" class="me-2">
                              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                            </svg>
                            داشبورد
                        </span>
                    </a>
                     
                </li>
                <li>
                    <a href="{{ route('panel.edit') }}" class="{{ request()->route()->getName() == 'panel.edit'  ? 'active':'' }}">
                        <span>
                            <svg style="width: 20px; height: 20px;" class="me-2">
                                 <use xlink:href="#edit">
                                    <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol> 
                                 </use>
                            </svg>
                            ویرایش پروفایل
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('panel.password') }}" class="{{ request()->route()->getName() == 'panel.password'  ? 'active':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="width: 20px; height: 20px;" class="me-2">
                                  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                                  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                            تغییر رمز 
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('panel.addresses.index') }}" class="{{ request()->route()->getName() == 'panel.addresses.index'  ? 'active':'' }}">
                        <span>
                            <svg style="width: 24px; height: 24px;" class="me-2">
                              <use xlink:href="#street">
                                 <symbol id="street" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13 1h-2v2.5H5a1 1 0 00-.928 1.371L4.923 7l-.851 2.129A1 1 0 005 10.5h6v1H6a1 1 0 00-.928.629l-1 2.5a1 1 0 000 .742l1 2.5A1 1 0 006 18.5h5v4h2v-4h6a1 1 0 00.928-1.371L19.078 15l.851-2.129A1 1 0 0019 11.5h-6v-1h5a1 1 0 00.928-.629l1-2.5a1 1 0 000-.742l-1-2.5A1 1 0 0018 3.5h-5V1zM6.928 6.629L6.477 5.5h10.846l.6 1.5-.6 1.5H6.477l.451-1.129a1 1 0 000-.742zM6.677 13.5h10.846l-.451 1.129a1 1 0 000 .742l.451 1.129H6.677l-.6-1.5.6-1.5z" clip-rule="evenodd"></path></symbol> 
                              </use>
                            </svg>
                            آدرس‌ها
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('panel.reviews.index') }}" class="{{ request()->route()->getName() == 'panel.reviews.index'  ? 'active':'' }}">
                        <span>
                            <svg style="width: 24px; height: 24px;">
                                <use xlink:href="#comment">
                                   <symbol id="comment" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 21a1 1 0 001.6.8l6.92-5.198A8 8 0 0014 2h-4a8 8 0 100 16v3zm7.373-6.037l-.037.027L12 18.998V17a1 1 0 00-1-1h-1a6 6 0 010-12h4a6 6 0 013.373 10.963z" clip-rule="evenodd"></path></symbol> 
                                </use>
                            </svg>
                            دیدگاه‌ها
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('wishlist') }}" class="{{ request()->route()->getName() == 'wishlist'  ? 'active':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="width: 24px; height: 24px;">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>
                            علاقه مندی‌ها
                        </span>
                    </a>
                </li>
                {{--<li>
                    <a href="{{ route('panel.addresses.index') }}" class="{{ request()->route()->getName() == 'panel.addresses.index'  ? 'active':'' }}">
                        <span>
                            <svg style="width: 24px; height: 24px;">
                                <use xlink:href="#time">
                                    <symbol id="time" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm1-14v5.586l3.707 3.707-1.414 1.414-4-4A1 1 0 0111 12V6h2z" clip-rule="evenodd"></path></symbol>
                                </use>
                            </svg>
                            بازدیدهای اخیر
                        </span>
                    </a>
                </li>--}}
                <li>
                    <a href="{{ route('panel.tickets.index') }}" class="{{ request()->route()->getName() == 'panel.tickets.index'  ? 'active':'' }}"> 
                        <span>
                          <svg class="svg-icon" style="width: 24px; height: 24px;" class="me-2" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M898.133333 855.466667h-768c-46.933333 0-85.333333-38.4-85.333333-85.333334v-177.066666c0-12.8 8.533333-21.333333 21.333333-21.333334 10.666667 0 21.333333 8.533333 21.333334 21.333334v177.066666c0 23.466667 19.2 42.666667 42.666666 42.666667h768c23.466667 0 42.666667-19.2 42.666667-42.666667v-168.533333c0-12.8 8.533333-21.333333 21.333333-21.333333s21.333333 8.533333 21.333334 21.333333v168.533333c0 46.933333-38.4 85.333333-85.333334 85.333334zM960 443.733333c-12.8 0-21.333333-8.533333-21.333333-21.333333v-179.2c0-23.466667-19.2-42.666667-42.666667-42.666667H128c-23.466667 0-42.666667 19.2-42.666667 42.666667v172.8c0 10.666667-10.666667 21.333333-21.333333 21.333333-12.8 0-21.333333-10.666667-21.333333-21.333333v-172.8c0-46.933333 38.4-85.333333 85.333333-85.333333h768c46.933333 0 85.333333 38.4 85.333333 85.333333v179.2c0 10.666667-8.533333 21.333333-21.333333 21.333333z"  /><path d="M960 622.933333c-61.866667 0-110.933333-49.066667-110.933333-110.933333 0-61.866667 49.066667-110.933333 110.933333-110.933333v42.666666c-38.4 0-68.266667 29.866667-68.266667 68.266667s29.866667 68.266667 68.266667 68.266667v42.666666zM70.4 614.4l-8.533333-42.666667c32-6.4 70.4-36.266667 70.4-66.133333 0-32-23.466667-59.733333-55.466667-66.133333l8.533333-42.666667c51.2 10.666667 89.6 55.466667 89.6 108.8-2.133333 55.466667-53.333333 98.133333-104.533333 108.8z"  /><path d="M76.8 439.466667c-4.266667 0-8.533333-2.133333-12.8-2.133334v-42.666666c8.533333 0 14.933333 0 21.333333 2.133333l-8.533333 42.666667zM712.533333 296.533333c0 10.666667-8.533333 21.333333-21.333333 21.333334s-21.333333-10.666667-21.333333-21.333334V192c0-12.8 8.533333-21.333333 21.333333-21.333333s21.333333 8.533333 21.333333 21.333333v104.533333zM712.533333 480c0 12.8-8.533333 21.333333-21.333333 21.333333s-21.333333-8.533333-21.333333-21.333333v-104.533333c0-10.666667 8.533333-21.333333 21.333333-21.333334s21.333333 10.666667 21.333333 21.333334v104.533333zM712.533333 667.733333c0 10.666667-8.533333 21.333333-21.333333 21.333334s-21.333333-8.533333-21.333333-21.333334v-104.533333c0-12.8 8.533333-21.333333 21.333333-21.333333s21.333333 8.533333 21.333333 21.333333v104.533333zM714.666667 832c0 12.8-8.533333 21.333333-21.333334 21.333333-10.666667 0-21.333333-8.533333-21.333333-21.333333v-81.066667c0-10.666667 8.533333-21.333333 21.333333-21.333333 10.666667 0 21.333333 10.666667 21.333334 21.333333V832zM552.533333 341.333333H247.466667c-10.666667 0-21.333333 8.533333-21.333334 21.333334s10.666667 21.333333 21.333334 21.333333h302.933333c12.8 0 21.333333-8.533333 21.333333-21.333333s-8.533333-21.333333-19.2-21.333334zM548.266667 494.933333H245.333333c-10.666667 0-21.333333 8.533333-21.333333 21.333334 0 10.666667 10.666667 21.333333 21.333333 21.333333h302.933334c10.666667 0 21.333333-10.666667 21.333333-21.333333 0-12.8-8.533333-21.333333-21.333333-21.333334zM556.8 637.866667H253.866667c-12.8 0-21.333333 10.666667-21.333334 21.333333 0 12.8 8.533333 21.333333 21.333334 21.333333h302.933333c12.8 0 21.333333-8.533333 21.333333-21.333333 0-10.666667-8.533333-21.333333-21.333333-21.333333z"  /></svg>
                          پشتیبانی
                          @if($unreadTickets)<span class="label label-primary">{{ $unreadTickets }}</span>@endif
                         </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('panel.orders.index') }}" class="{{ request()->route()->getName() == 'panel.orders.index'  ? 'active':'' }}">
                        <span>
                            <svg style="width: 24px; height: 24px;" class="me-2">
                                <use xlink:href="#order">
                                   <symbol id="order" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2a5 5 0 014.995 4.783L17 7h2a1 1 0 01.993.883L20 8v11a3 3 0 01-2.824 2.995L17 22H7a3 3 0 01-2.995-2.824L4 19V8a1 1 0 01.883-.993L5 7h2a5 5 0 015-5zm6 7h-1v2h-2V9H9v2H7V9H6v10a1 1 0 00.77.974l.113.02L7 20h10a1 1 0 00.993-.883L18 19V9zM9.005 6.824A3 3 0 0115 7H9l.005-.176z" clip-rule="evenodd"></path></symbol> 
                                </use>
                            </svg>
                            تاریخچه سفارشات
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>
                            <svg style="width: 24px; height: 24px;" class="me-2">
                               <use xlink:href="#registerationSignOut">
                                   <symbol id="registerationSignOut" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M16 15h-2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v2h2V7a4 4 0 00-4-4H6a4 4 0 00-4 4v10a4 4 0 004 4h6a4 4 0 004-4v-2zm-9-2h12.586l-2.293 2.293 1.414 1.414 4-4a1 1 0 000-1.414l-4-4-1.414 1.414L19.586 11H7v2z" clip-rule="evenodd"></path></symbol>
                               </use>
                            </svg>
                            خروج از سیستم <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                        </span>
                    </a>
                </li>
          </ul>
    </section>
</aside>
