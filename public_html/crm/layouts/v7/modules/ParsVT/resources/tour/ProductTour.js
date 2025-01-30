/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
var TOURLANGUAGES = {
    LBL_NEXT: "بعدی",
    LBL_BACK: "قبلی",
    LBL_FINISH: "پایان تور"
};
jQuery.Class("ParsTour", {}, {
    registerHelperIcon: function () {
        var thisInstance = this;
        thisInstance.loadResources();
    },
    showTour: function () {
        var thisInstance = this;
        localStorage.clear();
        window.general = [
            {
                target: '#navbar ul.navbar-nav  li.dropdown .userName,dropdown-toggle',
                position: 'bottom',
                content: 'با کلیک بر روی این گزینه می توانید اطلاعات شخصی نظیر واحد پول، فرمت تاریخ، نوع تقویم، شماره داخلی متصل به سی آر ام و ... را تنظیم نمایید. همچنین شما می توانید تصویر خود را در قسمت پروفایل آپلود نمایید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#menubar_quickCreate',
                position: 'bottom',
                content: 'با کلیک بر روی دکمه افزودن سریع (+) می توانید بدون خروج از صفحه نسبت به ایجاد رکورد در ماژول های مختلف نظیر سرنخ، مخاطبین و ... اقدام نمایید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#navbar ul.navbar-nav .fa-bar-chart',
                position: 'bottom',
                content: 'با کلیک بر روی این دکمه می توانید به گزارشات و نمودارهای برنامه دسترسی پیدا کنید. همچنین می توانید گزارشات آماری و نموداری دلخواه خود را ایجاد کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#navbar ul.navbar-nav .taskManagement.vicon.vicon-task',
                position: 'bottom',
                content: 'با کلیک بر روی این گزینه می توانید به لیست وظایف مرتبط با خود بر اساس اولویت دسترسی پیدا کنید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.search-links-container .search-link',
                position: 'bottom',
                content: 'از این قسمت می توانید برای جستجوی عمومی و پیشرفته در کل سیستم استفاده نمایید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#appnavigator',
                position: 'bottom-left',
                content: 'از این قسمت می توانید به کل ماژول های فعال در برنامه و ابزارهای دسترسی پیدا کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#modnavigator .settingsgroup',
                position: 'left',
                content: 'از این قسمت می توانید برای دسترسی به تنظیمات کاربری و مدیریت براساس سطوح مجاز دسترسی استفاده نمایید',
                onShow: function (anno, $target, $annoElem) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                   thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                   thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.register_help_btn',
                position: 'bottom',
                content: 'از این قسمت می توانید برای دسترسی به ویدئو های آموزشی سی آر ام استفاده نمایید',
                onShow: function (anno, $target, $annoElem) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
        ];
        window.dashboardtour = [
            /*start dashboard*/
            {
                target: 'div.dashBoardContainer .tabContainer .moreSettings button',
                position: 'bottom',
                content: 'از این قسمت می توانید برای ایجاد داشبورد های اختصاصی و شخصی استفاده نمایید. با دوبار کلیک روی هر داشبورد می توانید نام آن را تغییر دهید. </br>همچنین با کلیک روی آیکون ضربدر می توانید داشبورد را حذف کنید.',
                onShow: function (anno, $target, $annoElem) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: 'div.dashboardHeading.container-fluid div.buttonGroups  div.btn-group  button.addButton',
                position: 'bottom',
                content: 'از این قسمت می توانید برای افزودن ویجت های موجود به داشبوردی که در حال مشاهده آن هستید استفاده نمایید. ویجت ها ابزارک هایی هستند که شما می توانید توسط آن ها گزارش هایی بگیرید و یک دید کلی نسبت به کسب و کارتان پیدا کنید.',
                onShow: function (anno, $target, $annoElem) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.DoneButton]
            },
            /*end dashboard*/
        ];
        window.listviewtour = [
            /*start listview*/
            {
                target: '#listViewContent div.floatThead-wrapper',
                position: 'right',
                content: 'اینجا می توانید لیست رکورهای در دسترس برای این ماژول را مشاهده کنید. همچنین می توانید برحسب شاخص های مد نظر هر ستون، اقدام به فیلتر این لیست نمایید.</br>با کلیک روی <i class="fa fa-th-large"></i> می توانید روی ستون های این جدول مدیریت داشته باشید. مثلا ستون های مد نظر خود را حذف یا اضافه کنید.',
                onShow: function (anno, $target, $annoElem) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                   thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#listview-actions > div > div:nth-child(3).col-md-3',
                position: 'bottom',
                content: 'در این قسمت تعداد صفحات فهرست شده را مشاهده می کنید. همچنین می توانید با کلیک روی علامت سئوال تعداد کل رکوردهای ثبت شده را مشاهده کنید و همچنین به رکورد های مختلف هر صفحه دسترسی داشته باشید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#listview-actions .listViewActionsContainer',
                position: 'bottom',
                content: 'توسط گزینه های این قسمت با انتخاب یک یا چند رکورد می توانید آنها را به صورت گروهی ویرایش یا حذف کنید و یا به صورتی گروهی اقدام به افزودن یادداشت نمایید.<br /> توجه نمایید که برای حفظ امنیت اطلاعات، کلیه رکوردهای حذف شده ابتدا در "منوی اصلی> ابزارها> سطل بازیابی" قرار خواهند گرفت و درصورت تمایل برای حذف دائمی یا بازیابی اطلاعات می توانید از این ابزار کمک بگیرید. <br > با کلیک روی گزینه بیشتر در صورتی که نقش کاربری شما دسترسی های لازم را داشته باشد گزینه هایی نظیر یافتن موارد تکراری و خروجی اطلاعات به فایل  به صورت عمومی و همچنین با انتخاب رکوردها امکاناتی نظیر قابلیت ارسال ایمیل، ارسال پیامک، پیگیری و توقف پیگیری، افزودن هشتگ، ادغام رکوردهای انتخاب شده و ابزارهای دیگرکه بسته به پکیج و ماژول های نصب شده بر روی نرم افزار شما، در اختیار شما قرار خواهد گرفت.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: "button[id$='listView_basicAction_LBL_ADD_RECORD']",
                position: 'bottom',
                content: 'برای افزودن یک رکورد جدید به فهرست این ماژول می توانید از این گزینه یا در صورت پشتیبانی ماژول از گزینه افزودن سریع واقع در نوار بالایی نرم افزار استفاده کنید. همچنین می توانید از فایل های CSV، وب فرم ها و... برای ورود اطلاعات استفاده کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: "button[id$='basicAction_LBL_IMPORT']",
                position: 'bottom',
                content: 'در پارس ویتایگر امکان خروجی گرفتن و ورود اطلاعات رکوردهای مختلف را از فایل های CSV انجام دهید. توسط این ابزار می توانید اطلاعات رکوردها را توسط فایل های CSV وارد نرم افزار کنید. همچنین در صورتیکه فایل های اکسل دارید و نیاز تبدیل آن ها به CSV دارید با واحد پشتیبانی و آموزش در ارتباط باشید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#appnav ul  li div.settingsIcon button',
                position: 'bottom',
                content: 'با ابزارهای موجود در این قسمت می توانید قسمت های مختلف این ماژول را <b>سفارشی سازی</b> کنید و به <b>تنظیمات ماژول</b> دسترسی داشته باشید. بسته به قابلیت های ماژول ممکن است یکی از گزینه های زیر را مشاهده نمایید: </br><b>ویرایش فیلد:</b> توسط این ابزار می توانید فرم های ثبت اطلاعات را در این بخش سفارشی سازی کنید.</br><b>ویرایش گردش کار:</b> با استفاده از گردش کارها، قادر خواهید بود فرآیندهای خودکاررا طبق شرایط مشخص ایجاد ، اجرا و سفارشی سازی نمایید.ویرایش مقادیر فهرست های انتخابی:</b> فهرست های انتخابی فیلدهای کشویی قابل انتخابی هستند که می توانید از بخش ویرایش فیلد اضافه کنید. اما برای ویرایش مقادیر آن ها از این قسمت استفاده کنید.</br><b>تنظیمات شماره گذاری رکوردها:</b> بصورت پیش فرض هر رکورد در پارس ویتایگر دارای یک شماره اختصاصی است. برای ویرایش یا تغییر متد شماره گذاری از این قسمت استفاده کنید.</br><b>راه اندازی وب فرم:</b> در صورت پشتیبانی ماژول از راه اندازی وب فرم با استفاده از این قسمت می توانید کدهای HTML بسازید که با قرار دادن آن ها در وب سایت خود، کلیه اطلاعات ثبت شده توسط این فرم ها در بطور خودکار در نرم افزار ثبت کنید.</br><b>سایر ابزارها:</b> بسته به ماژول ها و بسته های نرم افزار، ممکن است گزینه های بیشتری به شما نمایش داده شود. می توانید از فیلم های راهنمای مرتبط یا از همکاران بخش پشتیبانی و آموزش راهنمایی های لازم را دریافت نمایید. ',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#sidebar-essentials',
                position: 'left',
                content: 'شما می توانید توسط این قسمت لیست های سفارشی طبق معیارها و شرط های مد نظرتان ایجاد کنید، همچنین به تگ های موجود در فهرست و افزونه های مازاد نصب شده روی ماژول ها در صورت وجود دسترسی داشته باشید. این بخش برای دسته بندی اطلاعات، سهولت دسترسی و... کاربرد زیادی دارد. همچنین می توانید لیست های ایجاد شده را با سایر همکارانتان به اشتراک بگذارید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                    thisInstance.toggleClass("#sidebar-essentials", "anno-app-fixed-zindex", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                    thisInstance.toggleClass("#sidebar-essentials", "anno-app-fixed-zindex", false);
                },
                buttons: [AnnoButton.BackButton ,  AnnoButton.DoneButton]
            },
            /*end listview*/
        ];
        window.editviewtour = [
            /*start editview*/
            {
                target: '#EditView div.editViewBody div.editViewContents div',
                position: 'top',
                content: 'در این قسمت فرم افزودن رکورد در ماژول را به همراه فیلد ها و بلوک ها بر اساس دسترسی نقش کاربری خود مشاهده می کنید و باید نسبت به تکمیل اطلاعات فرم اقدام نمایید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#EditView div.editViewBody div.fieldBlockContainer div.lineitemTableContainer',
                position: 'top',
                content: 'با توجه به مرتبط بودن این ماژول به انبار سیستم از این بخش می توانید آیتم های مرتبط با محصول و سرویس را مشاهده و تغییر دهید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#EditView div.editViewBody div.editViewContents #addProduct',
                position: 'bottom',
                content: 'با کلیک بر روی این دکمه می توانید یک ردیف جدید جهت انتخاب از ماژول محصولات در فرم اضافه کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#EditView div.editViewBody div.editViewContents #addService',
                position: 'bottom',
                content: 'با کلیک بر روی این دکمه می توانید یک ردیف جدید جهت انتخاب از ماژول سرویس در فرم اضافه کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#EditView  div.modal-overlay-footer button.saveButton',
                position: 'top',
                content: 'با کلیک بر روی این گزینه در صورت تکمیل فیلد های الزامی و معتبر بودن فیلد های تکمیل شده فرم در قالب یک رکورد ذخیره خواهد شد.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                    thisInstance.toggleClass("#EditView  div.modal-overlay-footer", "anno-app-fixed-zindex", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                    thisInstance.toggleClass("#EditView  div.modal-overlay-footer", "anno-app-fixed-zindex", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.DoneButton]
            },
            /*ends editview*/
        ];
        window.detailsviewtour = [
            /*start detailsview*/
            {
                target: '.detailViewContainer .record-header', // second block of code
                position: 'bottom',
                content: 'در این قسمت اطلاعات مندرج در هدر رکورد را مشاهده می کنید. این اطلاعات توسط مدیر سیستم در قسمت ویرایش فیلد قابل پیکربندی هستند.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .tagContainer', // second block of code
                position: 'top',
                content: 'در این بخش تگ و برچسب های رکورد را در صورت وجود مشاهده می کنیدو همچنین می توانید تگ های جدید اضافه نمایید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer div.btn-group:nth-child(1)', // second block of code
                position: 'bottom',
                content: 'در این بخش نواری از عملیات های قابل اجرا بر روی رکورد فعلی را مشاهده می کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer div.detailview-header div.pull-right.btn-toolbar div.btn-group.pull-right', // second block of code
                position: 'right',
                content: 'با این دکمه ها می توانید بین رکورد های قبلی و بعدی براساس نمایه لیست انتخاب شده قبلی حرکت کنید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .nav-tabs', // second block of code
                position: 'top',
                content: 'در این بخش قادر خواهید بود تا علاوه بر مشاهده اطلاعات کامل رکورد فعلی، از تاریخچه تغییرات و ارتباطات آن با سایر ماژول های سیستم نظیر یادداشت ها، تقویم و ... آگاه شده و قادر باشید عملیات هایی را براساس نوع ارتباط هر ماژول با رکورد فعلی انجام دهید.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .summaryView', // second block of code
                position: 'left',
                content: 'در این بخش فیلدهای کلیدی انتخاب شده برای ماژول را مشاهده می کنید این فیلد ها جهت نمایش در خلاصه اطلاعات در قسمت ویرایش فیلدها توسط مدیر سیستم قابل پیکربندی هستند.',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .widgetContainer_documents', // second block of code
                position: 'left',
                content: 'در این قسمت اسناد پیوست شده مرتبط با این رکورد را مشاهده می کنید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer #relatedActivities', // second block of code
                position: 'right',
                content: 'در این قسمت ویجت رویدادها و فعالیت های مرتبط با رکورد را مشاهده می کنید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .widgetContainer_mileStone', // second block of code
                position: 'right',
                content: 'از این قسمت می توانید به فازهای پروژه دسترسی سریع داشته باشید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .widgetContainer_tasks', // second block of code
                position: 'right',
                content: 'از این قسمت می توانید به وظایف پروژه دسترسی داشته باشید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '.detailViewContainer .widgetContainer_comments', // second block of code
                position: 'right',
                content: 'در این قسمت خلاصه ای از یادداشت ها مرتبط با رکورد را مشاهده می کنید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.DoneButton]
            },
            /*end detailsview*/
        ];
        window.generaluserpreference = [
            {
                target: '#modnavigator .settingsgroup',
                position: 'left',
                content: 'از این قسمت می توانید برای دسترسی به تنظیمات کاربری و مدیریت براساس سطوح مجاز دسترسی استفاده نمایید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                    thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                    thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
            {
                target: '#prefPageHeader div.row.detailViewButtoncontainer .btn-group',
                position: 'bottom',
                content: 'از این قسمت می توانید پروفایل کاربری را ویرایش کنید. همچنین می توانید کلید دسترسی و گذرواژه و ورود دومرحله ای را با کلیک بر روی گزینه بیشتر مشاهده کنید',
                onShow: function (anno, $target, $annoElem) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", true);
                    thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", true);
                },
                onHide: function(anno, $target, $annoElem, returnFromOnShow) {
                    thisInstance.toggleClass(".app-fixed-navbar", "anno-app-fixed-navbar", false);
                    thisInstance.toggleClass("#modnavigator", "anno-app-fixed-zindex", false);
                },
                buttons: [AnnoButton.BackButton , AnnoButton.NextButton, AnnoButton.DoneButton]
            },
        ];

        var view = app.getViewName();
        var moduleName = app.getModuleName();
        if (moduleName == 'Home' && view == 'DashBoard') {
            window.generaltour = general.concat(dashboardtour);
        } else if (moduleName == 'Users' && view == 'PreferenceDetail') {
            window.generaltour = generaluserpreference.concat(general);
        } else if (view == 'Detail') {
            window.generaltour =detailsviewtour;
        } else if (view == 'Edit') {
            window.generaltour =editviewtour;
        } else if (view == 'List') {
            window.generaltour =listviewtour;
        } else {
            window.generaltour =general;
        }
        window.anntourvalues = [];
        $.each(generaltour, function (k, v) {
            if ($(v.target).length) {
                anntourvalues.push(v);
            }
        });
        if (anntourvalues === undefined || anntourvalues.length == 0) {
            jQuery('#guiderHandler').on('click', function () {
                app.helper.showErrorNotification({message: 'موردی جهت نمایش در تور آموزشی وجود ندارد!'});
            });
        } else {
            if (jQuery(window).width() >= 900) {
                window.tour = new Anno(anntourvalues);
                jQuery('#appnav > ul').prepend("<style>.blink_me {animation: blinker 1s linear infinite;font-weight:bold;}@keyframes blinker {  50% { opacity: 0.0; }}</style><div class='btn-group cursorPointer '><img class='alignMiddle blink_me' src='layouts/vlayout/skins/images/circle_question_mark.png' onclick='tour.show();' ></div>&nbsp;<div class='btn-group cursorPointer' id='guiderHandler'></div>   &nbsp;");
            }
        }
    },
    loadScript: function (url, callback) {
        // Adding the script tag to the head as suggested before
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;

        // Then bind the event to the callback function.
        // There are several events for cross browser compatibility.
        script.onreadystatechange = callback;
        script.onload = callback;

        // Fire the loading
        head.appendChild(script);
    },
    loadCSS: function (url, cssId) {
        var head = document.getElementsByTagName('head')[0];
        var link = document.createElement('link');
        link.id = cssId;
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = url;
        link.media = 'all';
        head.appendChild(link);
    },
    loadResources: function () {
        var thisInstance = this;
        setTimeout(function () {
            if (typeof Anno === 'function') {
                thisInstance.showTour();
            } else {
                thisInstance.loadCSS('layouts/v7/modules/ParsVT/resources/tour/anno.css', 'bootstrap-tour');
                thisInstance.loadScript('layouts/v7/modules/ParsVT/resources/tour/anno.js', function () {
                    thisInstance.loadResources();
                });
            }
        }, 1000);

    },
    toggleClass: function (target, classname, option) {
        if (option === false) {
            jQuery(target).removeClass(classname);
        } else {
            jQuery(target).addClass(classname);
        }
    },
    /**
     * Function to register required events
     */
    registerEvents: function () {
        var self = this;
        self.registerHelperIcon();
    }
});

jQuery(document).ready(function () {
    if (jQuery('body').data('language').substring(0, 2) == 'fa') {
        var instance = new ParsTour();
        instance.registerEvents();
    }
});