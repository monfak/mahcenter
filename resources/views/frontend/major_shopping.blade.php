@extends('frontend.layouts.app')
@section('title', $site_settings['b2b_title'])
@section('description', $site_settings['b2b_description'])
@section('content')
      <div class="container-fluid banner-inner">
         <div class="container">
           <div class="row align-items-center">
             <div class="col-md-6">
               <div class="row">
                 <div class="col-md-10">
                  <h1 class="title-inner-banner mb-4">{{ $site_settings['b2b_heading'] }}</h1>
                  <div class="ts-text-dark inline-block">برای مشاهده قیمت همکاری و خرید عمده باید حساب کاربری تایید شده داشته باشید. برای تایید حساب همکاری مراحلی که در زیر توضیح داده شده را انجام دهید.<small class="ts-text-body mr-1 inline-block font-normal">(کل فرآیند ثبت نام و تایید حساب طی چند دقیقه انجام خواهد شد)</small></div>
                  <div class="ts-text-dark block text-sm">در صورت نیاز به راهنمایی بیشتر میتوانید با شماره<span class="ltr mx-1 inline-block text-lg font-semibold ">021-67524</span>تماس حاصل فرمایید</div>
                  <div class="d-block mt-4">
                     <a href="" class="btn btn-primary">ثبت نام و ثبت درخواست حساب همکار</a>
                  </div>
                </div>
               </div>
             </div>
             <div class="col-md-6">
                <img src="{{asset('images/msh.png')}}" class="img-fluid" alt="">
             </div>
           </div>
         </div>
      </div>
      <div class="container-fluid pt-5 pb-5 bg-gray ">
        <div class="container">
          <div class="row align-items-center">
           <div class="col-lg-10 mx-auto col-12 p-0">
            <h2 class="ts-text-dark mb-8 text-center text-2xl font-bold">
              <span>چرا خرید عمده از </span>
              <span class="text-danger">مَه سنتر</span> 
            </h2>
            <div class="text-body mb-0 d-block text-justify mt-4">
              <p>مرکز پخش عمده مَه سنتر با بیش از 8 سال سابقه درخشان در بازار آی تی و دارا بودن گستره ‌ای وسیع از محصولات در حوزه های موبایل، کامپیوتر، برق و الکتریکی، لوازم تحریر، ابزار آلات و لوازم صوتی و تصویری جهت رفع نیاز همکاران و مغازه داران محترم در تامین کالا و خرید آنلاین به صورت عمده فعالیت دارد. این مجموعه با بیش از 20 هزار کالای موجود، امکان خرید عمده با کمترین هزینه و در کمترین زمان ممکن را برای رفع نیاز همکاران و مغازه داران محترم رقم زده است و شما می توانید تنها با چند کلیک ساده، محصولاتی با کیفیت و قیمتی مناسب را در اختیار داشته باشید.</p>
              <p>اگر شما هم مایل به خرید عمده انواع کالاها برای کسب و کار خود به صورت آنلاین هستید و دوست ندارید که وقت طولانی را در مغازه های عمده فروشی صرف پیدا کردن کالاهای مورد نظر خود کنید، تنها کافی است که با طی کردن چند قدم کوتاه در وبسایت مَه سنتر عضو شوید، سپس حساب همکاری خود را فعال نمایید و خریدی آسان و به صرفه را تجربه کنید.</p>
            </div>
          </div>
          </div>
          <div class="row mt-5 mb-5 row-item">
            <div class="col-md-4 col-12 mt-3 mb-3 tml-card-box">
              <div class="d-block img-text">
                 <img src="{{asset('images/mss1-3.png')}}" class="img-fluid" alt="">
              </div>
              <div class="mt-2 text-body  position-relative tml-card">
                ابتدا در سایت ثبت نام کنید.
              </div>
            </div>
            <div class="col-md-4 col-12 mt-3 mb-3 tml-card-box">
              <div class="d-block img-text">
                 <img src="{{asset('images/mss1-2.png')}}" class="img-fluid" alt="">
              </div>
              <div class="mt-2 text-body  position-relative tml-card">
                بعد از ثبت نام، ایمیل ثبت نامی خود را به همراه یک عکس از مغازه یا کارت ویزیت خود به شماره تلگرام 09903859936 (Technosun@) یا در چت آنلاین سایت برای تایید حساب همکاری ارسال کنید.
              </div>
            </div>
            <div class="col-md-4 col-12 mt-3 mb-3 tml-card-box">
              <div class="d-block img-text">
                 <img src="{{asset('images/mss1-1.png')}}" class="img-fluid" alt="">
              </div>
              <div class="mt-2 text-body  position-relative tml-card">
                بعد از ارسال عکس و تایید حساب همکاری توسط پشتیبانی مَه سنتر، برای حساب کاربری تایید شده شما، تمام قیمت های نمایش داده شده در سایت قیمت همکاری و عمده خواهند بود.
              </div>
            </div>
          </div>
          <div class="row align-items-center mt-3">
            <div class="col-lg-10 mx-auto col-12 p-0">
             <h2 class="ts-text-dark mb-8 text-center text-2xl font-bold">
               <span class="text-danger">مَه سنتر</span> 
               <span>بزرگترین سایت خرید عمده لوازم جانبی موبایل و کامپیوتر</span>
             </h2>
             <div class="text-body mb-0 d-block text-justify mt-4">
              <p>مَه سنتر توانسته است با تکیه بر اعتماد همکاران و مشتریان خود به بزرگترین فروشگاه آنلاین خرید عمده لوازم جانبی موبایل و کامپیوتر تبدیل شود. یکی از مهم ترین مزیت های فروشگاه اینترنتی مَه سنتر نسبت به سایر فروشگاه های عمده فیزیکی و آفلاین، دسترسی کامل به تمام کالاهای موجود در مجموعه و امکان ثبت سفارش در هر زمان دلخواهی می باشد. مزیت مهم دیگر مَه سنتر نیز امکان سفارش تکی از طرح و رنگ های مختلف یک محصول به دلخواه مشتری است و در این زمینه تقریبا هیچ محدودیتی در انتخاب کالاهای موجود روی سایت وجود ندارد و شما می توانید تنها با چند کلیک ساده تمام کالاهای مورد نیاز خود را به راحتی خریداری کنید.</p>
              <p>لازم به ذکر است که حداقل مبلغ سبد خرید برای همکاران گرامی 2.5 میلیون تومان در هر سفارش می باشد (به جز هارد و سخت افزار). البته برای محاسبه قیمت خرید عمده برای همکاران نیازی به خرید تعداد بالا از هر محصول نیست و شما می توانید بدون دغدغه تعداد کالای مورد نیاز خود را با قیمت خرید عمده خریداری کنید. علاوه بر این، قیمت گذاری منصفانه و نزدیک به قیمت خرید و تنوع بالای محصولات در دسته بندی های کالایی مختلف در مَه سنتر علت دیگری است که همکاران و مغازه داران در طی این سال ها به ما اعتماد نموده اند. همچنین در مورد قیمت گذاری ها سعی شده تا شما بتوانید با پایین ترین قیمت بازار، اجناس خود را خریداری کنید و این تضمین به شما داده می شود که اگر حتی بعد از خرید قیمت پایین تری پیدا کنید، با هماهنگی با بخش فروش، قیمت کالا تا حد ممکن برای شما اصلاح شود.</p>
              <br>
              <br>
              <h2 class="ts-text-dark mb-8 text-center text-2xl font-bold">
                <span class="text-danger">مَه سنتر</span> 
                <span> اختصاصی و پشتیبانی فعال؛ تضمین تجربه خریدی بی دغدغه با مَه سنتر</span>
              </h2>
              <p>
                یکی از مهم ترین مشکلات خرید عمده به صورت آفلاین و حضوری، مربوط به ارسال بار و جابجایی کالا تا مقصد است که ممکن است در هنگام جابجایی کالایی جا بماند یا در پروسه ارسال، کالاها دچار آسیب شوند. مجموعه مَه سنتر با وجود بهره گیری از روش های متداول پستی از جمله ارسال مرسوله از طریق شرکت های پست، باربری، تیپاکس و... ناوگان اختصاصی خود را نیز در نزدیک به 10 استان کشور دارد که از این طریق سفارش های خریداران عزیز را با سرعت بیشتری در درب محل تحویل خواهد داد. استان های تهران، البرز، گیلان، مازندران، تبریز، گلستان، خوزستان و... در حال حاضر جزو ناوگان مَه سنتر محسوب می شوند و در آینده شهر ها و استان های بیشتری نیز به ناوگان اختصاصی مَه سنتر اضافه خواهند شد.
              </p>
              <p>
                وجود پشتیبانی همه روزه یکی دیگر از بزرگترین مزیت های خرید از مَه سنتر است که در صورت نیاز به راهنمایی برای خرید از دو طریق تماس تلفنی و چت آنلاین سایت می توانید از همکاران ما مشاوره گرفته و خرید بهتری را تجربه کنید. همچنین بخش گارانتی و خدمات پس از فروش نیز برای مشکلاتی از قبیل خرابی کالا و نیاز به تعویض کالاهای معیوب نیز در خدمت خریداران محترم می باشد تا خریدی آسان و بی دغدغه از هر نظر را شما همکاران عزیز بتوانید تجربه کنید.
              </p>
            </div>
           </div>
           </div>
        </div>
     </div>
     <div class="container-fluid pb-5">
      <div class="container p-0">
        <div class="row">
          <div class="col-md-6 col-12 pt-4">
            <h2 class="text-dark mb-2 text-center text-lg font-bold ">سوالات قبل از خرید عمده</h2>
            <div class="row accordion mt-3" id="accordionFq1">
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">خرید از مَه سنتر چه مزایایی نسبت به سایز مراکز پخش دارد؟</button>
                  </h3>
                  <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionFq1" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseOne">  چرا باید به مَه سنتر اعتماد کنیم؟</button>
                  </h3>
                  <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionFq1" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseOne">  قیمت عمده لوازم جانبی چند درصد پایین تر از قیمت تک فروشی سایت هست؟</button>
                  </h3>
                  <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFq1" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseOne"> از کجا می توانم لیست قیمت عمده محصولات را دریافت کنم؟</button>
                  </h3>
                  <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionFq1" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapseOne">چرا قیمت عمده و همکاری برای من نمایش داده نمی شود؟</button>
                  </h3>
                  <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionFq1" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12 pt-4">
            <h2 class="text-dark mb-2 text-center text-lg font-bold ">سوالات بعد از خرید عمده </h2>
            <div class="row accordion mt-3" id="accordionFq2">
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2-1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-1" aria-expanded="false" aria-controls="ccollapse2-1">خرید از مَه سنتر چه مزایایی نسبت به سایز مراکز پخش دارد؟</button>
                  </h3>
                  <div id="collapse2-1" class="accordion-collapse collapse" aria-labelledby="heading2-1" data-bs-parent="#accordionFq2" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2-2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-2" aria-expanded="false" aria-controls="collapse2-2">  چرا باید به مَه سنتر اعتماد کنیم؟</button>
                  </h3>
                  <div id="collapse2-2" class="accordion-collapse collapse" aria-labelledby="heading2-2" data-bs-parent="#accordionFq2" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2-3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-3" aria-expanded="false" aria-controls="collapse2-3">  قیمت عمده لوازم جانبی چند درصد پایین تر از قیمت تک فروشی سایت هست؟</button>
                  </h3>
                  <div id="collapse2-3" class="accordion-collapse collapse" aria-labelledby="heading2-3" data-bs-parent="#accordionFq2" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2-4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-4" aria-expanded="false" aria-controls="collapse2-4"> از کجا می توانم لیست قیمت عمده محصولات را دریافت کنم؟</button>
                  </h3>
                  <div id="collapse2-4" class="accordion-collapse collapse" aria-labelledby="heading2-4" data-bs-parent="#accordionFq2" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading2-5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-5" aria-expanded="false" aria-controls="collapse2-5">چرا قیمت عمده و همکاری برای من نمایش داده نمی شود؟</button>
                  </h3>
                  <div id="collapse2-5" class="accordion-collapse collapse" aria-labelledby="heading2-5" data-bs-parent="#accordionFq2" style="">
                    <div class="accordion-body"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">کانال تلگرام پخش عمده لوازم الکتریکی و ابزار آلات مَه سنتر</h3>
                <div class="d-block img-boxt">
                  <img src="images/mss2-1.png" class="img-fluid" alt="">
                </div>
                <div class="d-block mt-2  text-box">
                  در کانال تلگرام خرید عمده لوازم الکتریکی و ابزارآلات مَه سنتر، محصولات جدید و تخفیفات ویژه لوازم جانبی الکتریکی از قبیل لامپ و تجهیزات روشنایی، کلید و پریز، محافظ و چند راهی، ابزار برقی و غیر برقی و … اطلاع رسانی شده و سعی می شود موجودی و قیمت بروزرسانی شود. البته لیست کامل محصولات، موجودی و قیمت در سایت مَه سنتر بروزتر و کامل تر می باشد.
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="" class="w-100 btn btn-success font-12">
                    ورود به کانال تلگرام فروش عمده لوازم الکتریکی و ابزار آلات مَه سنتر
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">کانال تلگرام پخش عمده لوازم الکتریکی و ابزار آلات مَه سنتر</h3>
                <div class="d-block img-boxt">
                  <img src="images/mss2-1.png" class="img-fluid" alt="">
                </div>
                <div class="d-block mt-2  text-box">
                  در کانال تلگرام خرید عمده لوازم الکتریکی و ابزارآلات مَه سنتر، محصولات جدید و تخفیفات ویژه لوازم جانبی الکتریکی از قبیل لامپ و تجهیزات روشنایی، کلید و پریز، محافظ و چند راهی، ابزار برقی و غیر برقی و … اطلاع رسانی شده و سعی می شود موجودی و قیمت بروزرسانی شود. البته لیست کامل محصولات، موجودی و قیمت در سایت مَه سنتر بروزتر و کامل تر می باشد.
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="" class="w-100 btn btn-success font-12">
                    ورود به کانال تلگرام فروش عمده لوازم الکتریکی و ابزار آلات مَه سنتر
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">کانال تلگرام پخش عمده لوازم الکتریکی و ابزار آلات مَه سنتر</h3>
                <div class="d-block img-boxt">
                  <img src="images/mss2-1.png" class="img-fluid" alt="">
                </div>
                <div class="d-block mt-2  text-box">
                  در کانال تلگرام خرید عمده لوازم الکتریکی و ابزارآلات مَه سنتر، محصولات جدید و تخفیفات ویژه لوازم جانبی الکتریکی از قبیل لامپ و تجهیزات روشنایی، کلید و پریز، محافظ و چند راهی، ابزار برقی و غیر برقی و … اطلاع رسانی شده و سعی می شود موجودی و قیمت بروزرسانی شود. البته لیست کامل محصولات، موجودی و قیمت در سایت مَه سنتر بروزتر و کامل تر می باشد.
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="" class="w-100 btn btn-success font-12">
                    ورود به کانال تلگرام فروش عمده لوازم الکتریکی و ابزار آلات مَه سنتر
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">کانال تلگرام پخش عمده لوازم الکتریکی و ابزار آلات مَه سنتر</h3>
                <div class="d-block img-boxt">
                  <img src="images/mss2-1.png" class="img-fluid" alt="">
                </div>
                <div class="d-block mt-2  text-box">
                  در کانال تلگرام خرید عمده لوازم الکتریکی و ابزارآلات مَه سنتر، محصولات جدید و تخفیفات ویژه لوازم جانبی الکتریکی از قبیل لامپ و تجهیزات روشنایی، کلید و پریز، محافظ و چند راهی، ابزار برقی و غیر برقی و … اطلاع رسانی شده و سعی می شود موجودی و قیمت بروزرسانی شود. البته لیست کامل محصولات، موجودی و قیمت در سایت مَه سنتر بروزتر و کامل تر می باشد.
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="" class="w-100 btn btn-success font-12">
                    ورود به کانال تلگرام فروش عمده لوازم الکتریکی و ابزار آلات مَه سنتر
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
@endsection