### دیباگ به صورت خودکار
با استفاده از این قابلیت شما میتوانید یکی از حالت های دیباگ در ویتایگر را بدون نیاز به ویرایش فایل های تنظیمات ویتایگر فعال و غیر فعال نمایید و پس از دیباگ برای جلوگیری از افت سرعت سیستم آن را غیر فعال نمایید.


پس از فعال سازی باکسی تحت عنوان ابزار دیباگ در ویتایگر شما نمایان می گردد که براساس نیاز خود می توانید مد دیباگ خود را انتخاب نمایید.

> ``📝`` نکته:
> به منظور سهولت کاربران در پروسه دیباگ راهنمای انجام این تنظیمات به صورت دستی نیر در ادامه آورده شده است

 <br>
 <br>

###دیباگ به صورت دستی

به منظور عیب یابی و مشاهده خطاها یا هشدارهای برنامه ی ویتایگر می توانید حالت عیب یابی (دیباگ) پیشفرض ویتایگر را از راهنمای زیر فعال کنید.

####دیباگ Database و بانک اطلاعاتی

برای دیباگ دیتابیس باید instance مربوطه به adb را از طریق ویرایش فایل زیر فعال کنید


```
include/database/PearDatabase.php
```

در انتهای فایل مقدار زیر را بیابید

```
if(empty($adb)) {
$adb = new PearDatabase();
$adb->connect();
}
```


و آن را با مقدار زیر جایگزین کنید

```
if(empty($adb)) {
$adb = new PearDatabase();
$adb->connect();
// ADD THIS LINE
$adb->setDebug(true);
$adb->setDieOnError(true);
}
```



برای مشاهده Query های سمت ویتایگر و پارامتر های ارسالی میتوانید از دستور کوئری مانند نمونه کپی بگیرید و آن را به فرمت پایین تبدیل نمایید

نمونه:

```
$result = $adb->pquery($sql, array($record));
$result2 = $adb->query($sql);
```

تبدیل به:

```
$result = ParsVT_KLogger_Model::printQuery($sql, array($record));
$result = ParsVT_KLogger_Model::printQuery($sql);
```



#### دیباگ PHP
برای فعال سازی دیباگ در کتابخانه log4php.debug مراحل زیر را انجام دهیدفایل config.performance.php را در روت ویتایگر ویرایش کنید و مقدار متغیر LOG4PHP_DEBUG را برابر true قرار دهید


```
'LOG4PHP_DEBUG' => true,
```

حال فایل log4php.properties را در روت ویتایگر باز کنید و مقدار log4php.rootLogger را برای فعال سازی level لاگ بر روی مقدار زیر تنظیم کنید


```
log4php.rootLogger = DEBUG, A1
```

نکته: اطمینان حاصل کنید پوشه logs در روت ویتایگر توسط وب سرور قابلیت نوشتن و ایجاد فایل را داشته باشد
با اعمال این تنظیمات گزارشات دیباگ در قالب لاگ فایل های جدید در سرور اضافه خواهند شد

#####دیباگ Exception ها

برای مشاهده فایل های صدا زده شده در یک تابع میتوانید از توابع زیر استفاده نمایید:

```
$var1 = ParsVT_KLogger_Model::debugCaller();
echo '<pre>';
print_r($var1);
echo '</pre>';

$var2 = ParsVT_KLogger_Model::traceCaller();
echo '<pre>';
print_r($var2);
echo '</pre>';
```


#### دیباگ SMTP
اگر می خواهید سرور SMTP خود را تنظیم کنید و با خطا مواجه شوید، به این معنی که نامه ارسال نمی شود، vTigerCRM جزئیات مشکل واقعی را به شما اطلاع نمی دهد.
برای دریافت خطای دقیق باید وارد کد شوید.

فایل modules/Emails/mail.php را ویرایش کنید و عبارت زیر را جستجو کنید

```
$mail_status = MailSend($mail);
```

اگر خط زیر را قبل از این تابع MailSend وارد کنید، می توانید در هنگام ذخیره تنظیمات Mailserver، Log کامل SMTP را در پاسخ درخواست Ajax دریافت کنید.

```
$mail->SMTPDebug = 2;
```

نکته: اطمینان حاصل کنید پوشه logs در روت ویتایگر توسط وب سرور قابلیت نوشتن و ایجاد فایل را داشته باشد
با اعمال این تنظیمات گزارشات دیباگ در قالب لاگ فایل های جدید در سرور اضافه خواهند شد

#### دیباگ موتور قالب Smarty
Smarty یک موتور قالب ساز حرفه‌ای برای زبان برنامه نویسی PHP است که از طریق آن به راحتی می‌توان بخش منطق برنامه را از بخش طراحی و نمایش خروجی برنامه جدا کرد. ویتایگر از این موتور قالب ساز استفاده میکند. برای دیباگ آن مراحل زیر را انجام دهیدفایل config.inc.php را در روت ویتایگر ویرایش کنید و مقدار زیر را به انتهای آن اضافه کنید

```
$_REQUEST['SMARTY_DEBUG']='true';
```








همچنین می توانید از طریق دریافت نمونه کد منتشر شده توسط پارس ویتایگر از دیباگر پارس ویتایگر بدون نیاز به چک کردن فایل های لاگ ویتایکر جهت عیب یابی استفاده نمایید

فایل های ضمیمه را در روت ویتایگر کپی کنید و محتوای آن را از حالت زیپ خارج کنید و سپس فایل index.php را در روت ویتایگر ویرایش کنید و خط زیر را پیدا کنید


```
include_once 'includes/main/WebUI.php';
```

بعد از خط بالا تکه کد زیر را اضافه کنید

```
vimport('~~/vendor/parsvt_autoload.php');
use Tracy\Debugger;
Debugger::DEVELOPMENT;
Debugger::enable(Debugger::EXCEPTION);
```

حال می توانید در زمان لود هر صفحه محتوای دیباگ را در همان صفحه مشاهده نمایید

[![Downloads](layouts/v7/modules/ParsVT/images/download.png)](http://license.aweb.co/download/debuger.zip)   [دانلود دیباگر](http://license.aweb.co/download/debuger.zip)




####نحوه ارتباط نوع داده UITYPE و TYPEOFDATA

<table style="direction:ltr; text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2" class="table  table-condensed table-striped table-bordered">
  <tbody>
    <tr align="center">
      <td style="width: 201px;" colspan="7" rowspan="1"><span
 style="font-weight: bold;">GENERATED VTIGER CRM UITYPE, TYPE
of DATA and SQL Data/Column Type on Custom Field Settings</span></td>
    </tr>
    <tr>
      <td style="width: 221px; background-color: rgb(255, 204, 0);">Field
type
on custom field settings</td>
      <td style="background-color: rgb(255, 204, 0); width: 107px;">Length</td>
      <td style="background-color: rgb(255, 204, 0); width: 158px;">Decimal
places</td>
      <td style="background-color: rgb(255, 204, 0); width: 116px;">(Generated)
uitype</td>
      <td style="background-color: rgb(255, 204, 0); width: 253px;">(Generated)
typeofdata</td>
      <td style="background-color: rgb(255, 204, 0); width: 201px;">(Generated)
SQL
Column Type</td>
      <td style="width: 104px; background-color: rgb(255, 204, 0);">Mandatory</td>
    </tr>
    <tr>
      <td style="width: 221px; background-color: rgb(255, 255, 204);">Text</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">100</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~O~LE~100</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(100)</td>
      <td style="width: 104px; background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Text</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">100</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~M~LE~100</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="width: 221px; background-color: rgb(255, 255, 204);">Text</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">25</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~O~LE~25</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(25)</td>
      <td style="width: 104px; background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Text</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">25</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~M~LE~25</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(25)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Number
(float)</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">10</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">0</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">NN~O~10,0</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">decimal(11,0)</td>
      <td style="width: 104px; background-color: rgb(153, 255, 153);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Number
(float)</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">10</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">0</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">NN~M~10,0</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">decimal(11,0)</td>
      <td style="width: 104px; background-color: rgb(153, 255, 153);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Number
(float)</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">3</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">NN~O~7,3</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">decimal(11,3)</td>
      <td style="width: 104px; background-color: rgb(153, 255, 153);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Number
(float)</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">3</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">7</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">NN~M~7,3</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">decimal(11,3)</td>
      <td style="background-color: rgb(153, 255, 153);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Percent
%</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">9</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">N~O~2~2</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">decimal(5,2)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Percent
%</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">9</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">N~M~2~2</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">decimal(5,2)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Currency</td>
      <td style="background-color: rgb(204, 255, 255); width: 107px;">10</td>
      <td style="background-color: rgb(204, 255, 255); width: 158px;">2</td>
      <td style="background-color: rgb(204, 255, 255); width: 116px;">71</td>
      <td style="background-color: rgb(204, 255, 255); width: 253px;">N~O~10,2</td>
      <td style="background-color: rgb(204, 255, 255); width: 201px;">decimal(13,2)</td>
      <td style="background-color: rgb(204, 255, 255);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Currency</td>
      <td style="background-color: rgb(204, 255, 255); width: 107px;">10</td>
      <td style="background-color: rgb(204, 255, 255); width: 158px;">0</td>
      <td style="background-color: rgb(204, 255, 255); width: 116px;">71</td>
      <td style="background-color: rgb(204, 255, 255); width: 253px;">N~M~10,0</td>
      <td style="background-color: rgb(204, 255, 255); width: 201px;">decimal(11,0)</td>
      <td style="background-color: rgb(204, 255, 255);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Date</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">5</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">D~O</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Date</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">5</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">D~M</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Email</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">---</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">---</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">13</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">E~O</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">varchar(50)</td>
      <td style="background-color: rgb(153, 255, 153);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Email</td>
      <td style="background-color: rgb(153, 255, 153); width: 107px;">---</td>
      <td style="background-color: rgb(153, 255, 153); width: 158px;">---</td>
      <td style="background-color: rgb(153, 255, 153); width: 116px;">13</td>
      <td style="background-color: rgb(153, 255, 153); width: 253px;">E~M</td>
      <td style="background-color: rgb(153, 255, 153); width: 201px;">varchar(50)</td>
      <td style="background-color: rgb(153, 255, 153);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Phone</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">11</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~O</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Phone</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">11</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~M</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Pick
List (Value 1, Value 2, etc.)</td>
      <td style="background-color: rgb(204, 255, 255); width: 107px;">---</td>
      <td style="background-color: rgb(204, 255, 255); width: 158px;">---</td>
      <td style="background-color: rgb(204, 255, 255); width: 116px;">15</td>
      <td style="background-color: rgb(204, 255, 255); width: 253px;">V~O</td>
      <td style="background-color: rgb(204, 255, 255); width: 201px;">varchar(255)</td>
      <td style="background-color: rgb(204, 255, 255);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Pick
List</td>
      <td style="background-color: rgb(204, 255, 255); width: 107px;">---</td>
      <td style="background-color: rgb(204, 255, 255); width: 158px;">---</td>
      <td style="background-color: rgb(204, 255, 255); width: 116px;">15</td>
      <td style="background-color: rgb(204, 255, 255); width: 253px;">V~M</td>
      <td style="background-color: rgb(204, 255, 255); width: 201px;">varchar(255)</td>
      <td style="background-color: rgb(204, 255, 255);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">URL</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">17</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~O</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">URL</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">---</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">17</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~M</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Checkbox</td>
      <td style="width: 107px; background-color: rgb(153, 255, 153);">---</td>
      <td style="width: 158px; background-color: rgb(153, 255, 153);">---</td>
      <td style="width: 116px; background-color: rgb(153, 255, 153);">56</td>
      <td style="width: 253px; background-color: rgb(153, 255, 153);">C~O</td>
      <td style="width: 201px; background-color: rgb(153, 255, 153);">varchar(3)</td>
      <td style="background-color: rgb(153, 255, 153);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(153, 255, 153);">Checkbox</td>
      <td style="width: 107px; background-color: rgb(153, 255, 153);">---</td>
      <td style="width: 158px; background-color: rgb(153, 255, 153);">---</td>
      <td style="width: 116px; background-color: rgb(153, 255, 153);">56</td>
      <td style="width: 253px; background-color: rgb(153, 255, 153);">C~M</td>
      <td style="width: 201px; background-color: rgb(153, 255, 153);">varchar(3)</td>
      <td style="background-color: rgb(153, 255, 153);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Text
Area</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">21</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">Text
Area</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">21</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~M</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Multi
Select Combo Box</td>
      <td style="width: 107px; background-color: rgb(204, 255, 255);">---</td>
      <td style="width: 158px; background-color: rgb(204, 255, 255);">---</td>
      <td style="width: 116px; background-color: rgb(204, 255, 255);">33</td>
      <td style="width: 253px; background-color: rgb(204, 255, 255);">V~O</td>
      <td style="width: 201px; background-color: rgb(204, 255, 255);">text</td>
      <td style="background-color: rgb(204, 255, 255);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(204, 255, 255);">Multi
Select Combo Box</td>
      <td style="width: 107px; background-color: rgb(204, 255, 255);">---</td>
      <td style="width: 158px; background-color: rgb(204, 255, 255);">---</td>
      <td style="width: 116px; background-color: rgb(204, 255, 255);">33</td>
      <td style="width: 253px; background-color: rgb(204, 255, 255);">V~M</td>
      <td style="width: 201px; background-color: rgb(204, 255, 255);">text</td>
      <td style="background-color: rgb(204, 255, 255);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">SkyPe
ID</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">85</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">SkyPe
ID</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">---</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">85</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~M</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr align="center">
      <td style="width: 201px;" colspan="7" rowspan="1"><span
 style="font-weight: bold;">EXISTING
VTIGER (5.x, 6.x, 7.x, 8.x) CRM UITYPE, TYPE of DATA and SQL Data/Column Type on the
SQL tables: vtiger_field &amp; module tables,
e.g.&nbsp;vtiger_leaddetails &amp; others</span></td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 204, 0);">Example
Column-name / table</td>
      <td style="background-color: rgb(255, 204, 0); width: 107px;">Fieldname</td>
      <td style="background-color: rgb(255, 204, 0); width: 158px;">Fieldlabel</td>
      <td style="background-color: rgb(255, 204, 0); width: 116px;">UITYPE</td>
      <td style="background-color: rgb(255, 204, 0); width: 253px;">TYPEOFDATA</td>
      <td style="background-color: rgb(255, 204, 0); width: 201px;">SQL
column type</td>
      <td style="background-color: rgb(255, 204, 0);">Mandatory</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Text
box </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">tickersymbol
/ vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">tickersymbol</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">Ticker
Symbol</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~O</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">noofemployees
/ vtiger_leaddetails</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">noofemployees</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">No
Of
Employees</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1<br>
      </td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">I~O&nbsp;
      <span class="e" id="q_1297a44c64da0d44_3">(??? text)</span></td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">int(50)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">qtyinstock
/ vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">qtyinstock</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">Qty
In
Stock</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1<br>
      </td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">NN~O
      <span class="e" id="q_1297a44c64da0d44_3"><span class="e"
 id="q_1297a44c64da0d44_3">(??? text)</span></span></td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">decimal(25,3)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">qty_per_unit
/ vtiger_service</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">qty_per_unit</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">No
of
Units</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1<br>
      </td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">N~O
      <span class="e" id="q_1297a44c64da0d44_3"><span class="e"
 id="q_1297a44c64da0d44_3">(??? text)</span></span></td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">decimal(11,2)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">subject
/ vtiger_servicecontracts</td>
      <td style="background-color: rgb(255, 255, 204); width: 107px;">subject</td>
      <td style="background-color: rgb(255, 255, 204); width: 158px;">Subject</td>
      <td style="background-color: rgb(255, 255, 204); width: 116px;">1</td>
      <td style="background-color: rgb(255, 255, 204); width: 253px;">V~M</td>
      <td style="background-color: rgb(255, 255, 204); width: 201px;">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Text
box, mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">time_start
/ vtiger_activity</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">time_start</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Time
Start</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">2</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">T~M</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(50)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">time_end
/ vtiger_activity</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">time_end</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">End
Time</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">2</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">T~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(50)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">accountname
/ vtiger_account</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">accountname</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Account
Name</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">2</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~M</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">activitytype
/ vtiger_activity</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">activitytype</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Activtiy
Type</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">2</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Text
box with Inheritance </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">accesskey
/ vtiger_users</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">accesskey</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Webservice
Access
Key</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">3</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(36)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Text
box with Inheritance, mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">account_no&nbsp;/
vtiger_account</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">account_no</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Account
No</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">4</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">V~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Date</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">enddate
/ vtiger_projecttask</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">enddate</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">End
Date</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">5</td>
      <td style="width: 253px; background-color: rgb(255, 255, 51);">D~0~OTH~GE~startdate~Start
Date&nbsp;
      <br>
[0 Null is a possible typo]<br>
      </td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">dateinservice
/ vtiger_assets</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">dateinservice</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Date
in
Service</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">5</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">D~M~OTH~GE~dateinservice~Date
in
Service</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">datesold
/ vtiger_assets</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">datesold</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Date
Sold</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">5</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">D~M~OTH~GE~datesold~Date
Sold</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">sales_start_date
/
vtiger_service</td>
      <td style="width: 107px; background-color: rgb(255, 255, 204);">sales_start_date</td>
      <td style="width: 158px; background-color: rgb(255, 255, 204);">Sales
Start
Date</td>
      <td style="width: 116px; background-color: rgb(255, 255, 204);">5</td>
      <td style="width: 253px; background-color: rgb(255, 255, 204);">D~O</td>
      <td style="width: 201px; background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">sales_end_date
/ vtiger_service</td>
      <td style="background-color: rgb(255, 255, 204);">sales_end_date</td>
      <td style="background-color: rgb(255, 255, 204);">Sales
End Date</td>
      <td style="background-color: rgb(255, 255, 204);">5</td>
      <td style="background-color: rgb(255, 255, 204);">D~O~OTH~GE~sales_start_date~Sales
Start
Date</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">expiry_date
/ vtiger_service</td>
      <td style="background-color: rgb(255, 255, 204);">expiry_date</td>
      <td style="background-color: rgb(255, 255, 204);">Support
Expiry Date</td>
      <td style="background-color: rgb(255, 255, 204);">5</td>
      <td style="background-color: rgb(255, 255, 204);">D~O~OTH~GE~start_date~Start
Date</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">support_end_date
/
vtiger_customerdetails</td>
      <td style="background-color: rgb(255, 255, 204);">support_end_date</td>
      <td style="background-color: rgb(255, 255, 204);">Support
End Date</td>
      <td style="background-color: rgb(255, 255, 204);">5</td>
      <td style="background-color: rgb(255, 255, 204);">D~O~OTH~GE~support_start_date~Support
Start
Date</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">end_period
/ vtiger_invoice_recurring_info</td>
      <td style="background-color: rgb(255, 255, 204);">end_period</td>
      <td style="background-color: rgb(255, 255, 204);">End
Period</td>
      <td style="background-color: rgb(255, 255, 204);">5</td>
      <td style="background-color: rgb(255, 255, 204);">D~O~OTH~G~start_period~Start
Period</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Date,
default to currenttime </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">date_start
/ vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">date_start</td>
      <td style="background-color: rgb(255, 255, 204);">Start
Date &amp; Time</td>
      <td style="background-color: rgb(255, 255, 204);">6</td>
      <td style="background-color: rgb(255, 255, 204);">DT~M~time_start</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">date_start
/ vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">date_start</td>
      <td style="background-color: rgb(255, 255, 204);">Date
&amp; Time Sent</td>
      <td style="background-color: rgb(255, 255, 204);">6</td>
      <td style="background-color: rgb(255, 255, 204);">DT~M~time_start~Time
Start</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Number
box </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">employees
/ vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204);">employees</td>
      <td style="background-color: rgb(255, 255, 204);">Employees</td>
      <td style="background-color: rgb(255, 255, 204);">7</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(10)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">total_units
/ vtiger_servicecontracts</td>
      <td style="background-color: rgb(255, 255, 204);">total_units</td>
      <td style="background-color: rgb(255, 255, 204);">Total
Units</td>
      <td style="background-color: rgb(255, 255, 204);">7</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">decimal(5,2)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">json
encoded string</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">to_email
/&nbsp;vtiger_emaildetails</td>
      <td style="background-color: rgb(255, 255, 204);">saved_toid</td>
      <td style="background-color: rgb(255, 255, 204);">To</td>
      <td style="background-color: rgb(255, 255, 204);">8</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">cc_email&nbsp;/&nbsp;vtiger_emaildetails</td>
      <td style="background-color: rgb(255, 255, 204);">ccemail</td>
      <td style="background-color: rgb(255, 255, 204);">Cc</td>
      <td style="background-color: rgb(255, 255, 204);">8</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Percent
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">probability
/ vtiger_potential</td>
      <td style="background-color: rgb(255, 255, 204);">probability</td>
      <td style="background-color: rgb(255, 255, 204);">Probability</td>
      <td style="background-color: rgb(255, 255, 204);">9</td>
      <td style="background-color: rgb(255, 255, 204);">N~O</td>
      <td style="background-color: rgb(255, 255, 204);">decimal(7,3)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">progress
/ vtiger_servicecontracts</td>
      <td style="background-color: rgb(255, 255, 204);">progress</td>
      <td style="background-color: rgb(255, 255, 204);">Progress</td>
      <td style="background-color: rgb(255, 255, 204);">9</td>
      <td style="background-color: rgb(255, 255, 204);">N~O~2~2</td>
      <td style="background-color: rgb(255, 255, 204);">decimal(5,2)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">general
relate field, for relating entities</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">sc_related_to
/&nbsp;vtiger_servicecontracts</td>
      <td style="background-color: rgb(255, 255, 204);">sc_related_to</td>
      <td style="background-color: rgb(255, 255, 204);">Related
to</td>
      <td style="background-color: rgb(255, 255, 204);">10</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(11)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">product
/&nbsp;vtiger_assets</td>
      <td style="background-color: rgb(255, 255, 204);">product</td>
      <td style="background-color: rgb(255, 255, 204);">Product
Name</td>
      <td style="background-color: rgb(255, 255, 204);">10</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Phone
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">phone
/&nbsp;vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204);">phone</td>
      <td style="background-color: rgb(255, 255, 204);">Phone</td>
      <td style="background-color: rgb(255, 255, 204);">11</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">OrgUnit
pickbox &nbsp;/ Organization
multiselect pickbox <br>
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">from_email
/&nbsp;vtiger_emaildetails</td>
      <td style="background-color: rgb(255, 255, 204);">from_email</td>
      <td style="background-color: rgb(255, 255, 204);">From</td>
      <td style="background-color: rgb(255, 255, 204);">12</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(50)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">EMail
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">email&nbsp;/
vtiger_contactdetails</td>
      <td style="background-color: rgb(255, 255, 204);">email</td>
      <td style="background-color: rgb(255, 255, 204);">Email</td>
      <td style="background-color: rgb(255, 255, 204);">13</td>
      <td style="background-color: rgb(255, 255, 204);">E~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Picklist
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">activitytype
/&nbsp;vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">activitytype</td>
      <td style="background-color: rgb(255, 255, 204);">Activity
Type</td>
      <td style="background-color: rgb(255, 255, 204);">15</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">industry
/&nbsp;vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204);">industry</td>
      <td style="background-color: rgb(255, 255, 204);">industry</td>
      <td style="background-color: rgb(255, 255, 204);">15</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Picklist,
mandatory entry &nbsp;???</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">recurringtype
/&nbsp;vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">recurringtype</td>
      <td style="background-color: rgb(255, 255, 204);">Recurrence</td>
      <td style="background-color: rgb(255, 255, 204);">16</td>
      <td style="background-color: rgb(255, 255, 204);">O~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">duration_minutes&nbsp;/&nbsp;vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">duration_minutes</td>
      <td style="background-color: rgb(255, 255, 204);">Duration
Minutes</td>
      <td style="background-color: rgb(255, 255, 204);">16</td>
      <td style="background-color: rgb(255, 255, 204);">T~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">reminder_interval
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">reminder_interval</td>
      <td style="background-color: rgb(255, 255, 204);">Reminder
Interval</td>
      <td style="background-color: rgb(255, 255, 204);">16</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">URL
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">website&nbsp;
/&nbsp;vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204);">website</td>
      <td style="background-color: rgb(255, 255, 204);">Website</td>
      <td style="background-color: rgb(255, 255, 204);">17</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Textarea
with colspan=2 </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">commentcontent
/ vtiger_modcomments</td>
      <td style="background-color: rgb(255, 255, 204);">commentcontent</td>
      <td style="background-color: rgb(255, 255, 204);">Comment</td>
      <td style="background-color: rgb(255, 255, 204);">19</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);"> <bdo
 xml:lang="en" dir="ltr">text</bdo></td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">description
/ vtiger_crmentity</td>
      <td style="background-color: rgb(255, 255, 204);">description</td>
      <td style="background-color: rgb(255, 255, 204);">Description</td>
      <td style="background-color: rgb(255, 255, 204);">19</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);"> <bdo
 xml:lang="en" dir="ltr">text</bdo></td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Textarea
with colspan=2, mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">question
/&nbsp;vtiger_faq</td>
      <td style="background-color: rgb(255, 255, 204);">question</td>
      <td style="background-color: rgb(255, 255, 204);">Question</td>
      <td style="background-color: rgb(255, 255, 204);">20</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Textarea
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">message
/&nbsp;vtiger_smsnotifier</td>
      <td style="background-color: rgb(255, 255, 204);">message</td>
      <td style="background-color: rgb(255, 255, 204);">message</td>
      <td style="background-color: rgb(255, 255, 204);">21</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">bill_street
/&nbsp;vtiger_accountbillads</td>
      <td style="background-color: rgb(255, 255, 204);">bill_street</td>
      <td style="background-color: rgb(255, 255, 204);">Billing
Address</td>
      <td style="background-color: rgb(255, 255, 204);">21</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(250)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Textarea,
mandatory entry <br>
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">title
/&nbsp;vtiger_troubletickets</td>
      <td style="background-color: rgb(255, 255, 204);">ticket_title</td>
      <td style="background-color: rgb(255, 255, 204);">Title</td>
      <td style="background-color: rgb(255, 255, 204);">22</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Date
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">closingdate
/&nbsp;vtiger_potential</td>
      <td style="background-color: rgb(255, 255, 204);">closingdate</td>
      <td style="background-color: rgb(255, 255, 204);">Expected
Close Date</td>
      <td style="background-color: rgb(255, 255, 204);">23</td>
      <td style="background-color: rgb(255, 255, 204);">D~M</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">due_date
/&nbsp;vtiger_activity</td>
      <td style="background-color: rgb(255, 255, 204);">due_date</td>
      <td style="background-color: rgb(255, 255, 204);">Due
Date</td>
      <td style="background-color: rgb(255, 255, 204);">23</td>
      <td style="background-color: rgb(255, 255, 204);">D~M~OTH~GE~date_start~Start
Date
&amp; Time</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">due_date
/&nbsp;vtiger_servicecontracts</td>
      <td style="background-color: rgb(255, 255, 204);">due_date</td>
      <td style="background-color: rgb(255, 255, 204);">Due
Date</td>
      <td style="background-color: rgb(255, 255, 204);">23</td>
      <td style="background-color: rgb(255, 255, 204);">D~O</td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">targetenddate
/&nbsp;vtiger_project</td>
      <td style="background-color: rgb(255, 255, 204);">targetenddate</td>
      <td style="background-color: rgb(255, 255, 204);">Target
End Date</td>
      <td style="background-color: rgb(255, 255, 204);">23</td>
      <td style="background-color: yellow;">D~0~OTH~GE~startdate~Start
Date<br>
      <span class="e" id="q_1297a44c64da0d44_3">[0 Null is a possible
typo]</span><br>
      </td>
      <td style="background-color: rgb(255, 255, 204);">date</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Textarea,
mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">bill_street
/&nbsp;vtiger_quotesbillads</td>
      <td style="background-color: rgb(255, 255, 204);">bill_street</td>
      <td style="background-color: rgb(255, 255, 204);">Billing
Address</td>
      <td style="background-color: rgb(255, 255, 204);">24</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(250)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">25,
26, 27,28 ??? <span class="e" id="q_1297a44c64da0d44_3">missing
entries at <a class="moz-txt-link-freetext" href="http://wiki.vtiger.com/index.php/Ui_types">http://wiki.vtiger.com/index.php/Ui_types</a></span></td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">access_count
/&nbsp;
vtiger_email_track</td>
      <td style="background-color: rgb(255, 255, 204);">access_count</td>
      <td style="background-color: rgb(255, 255, 204);">Access
Count</td>
      <td style="background-color: rgb(255, 255, 204);">25</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(11)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">folderid
/&nbsp;vtiger_notes</td>
      <td style="background-color: rgb(255, 255, 204);">folderid</td>
      <td style="background-color: rgb(255, 255, 204);">Folder
Name</td>
      <td style="background-color: rgb(255, 255, 204);">26</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">filelocationtype&nbsp;/&nbsp;vtiger_notes</td>
      <td style="background-color: rgb(255, 255, 204);">filelocationtype</td>
      <td style="background-color: rgb(255, 255, 204);">Download
Type</td>
      <td style="background-color: rgb(255, 255, 204);">27</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(5)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">filename&nbsp;/&nbsp;vtiger_notes</td>
      <td style="background-color: rgb(255, 255, 204);">filename</td>
      <td style="background-color: rgb(255, 255, 204);">File
Name</td>
      <td style="background-color: rgb(255, 255, 204);">28</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Time
left </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">reminder_time
/&nbsp;vtiger_activity_reminder</td>
      <td style="background-color: rgb(255, 255, 204);">reminder_time</td>
      <td style="background-color: rgb(255, 255, 204);">Send
Reminder</td>
      <td style="background-color: rgb(255, 255, 204);">30</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(11)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">No
sample for UITYPE 31-50 in the SQL table:
vtiger_field</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Popup
select box for account and contact
addresses </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">accountid
/&nbsp;vtiger_contactdetails</td>
      <td style="background-color: rgb(255, 255, 204);">accountid</td>
      <td style="background-color: rgb(255, 255, 204);">Account
Name</td>
      <td style="background-color: rgb(255, 255, 204);">51</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Picklist
for username entries </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">handler
/&nbsp;vtiger_service</td>
      <td style="background-color: rgb(255, 255, 204);">assigned_user_id</td>
      <td style="background-color: rgb(255, 255, 204);">Owner</td>
      <td style="background-color: rgb(255, 255, 204);">52</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(11)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">smcreatorid
/&nbsp;vtiger_crmentity</td>
      <td style="background-color: rgb(255, 255, 204);">creator</td>
      <td style="background-color: rgb(255, 255, 204);">Creator</td>
      <td style="background-color: rgb(255, 255, 204);">52</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">User
picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">smownerid
/&nbsp;vtiger_crmentity</td>
      <td style="background-color: rgb(255, 255, 204);">assigned_user_id</td>
      <td style="background-color: rgb(255, 255, 204);">Assigned
To</td>
      <td style="background-color: rgb(255, 255, 204);">53</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Salutation
type picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">salutation
/&nbsp;vtiger_leaddetails</td>
      <td style="background-color: rgb(255, 255, 204);">salutationtype</td>
      <td style="background-color: rgb(255, 255, 204);">Salutation</td>
      <td style="background-color: rgb(255, 255, 204);">55</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">firstname&nbsp;/&nbsp;vtiger_leaddetails</td>
      <td style="background-color: rgb(255, 255, 204);">firstname</td>
      <td style="background-color: rgb(255, 255, 204);">First
Name</td>
      <td style="background-color: rgb(255, 255, 204);">55</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(40)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Salutation
(for last name)</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">lastname&nbsp;/&nbsp;vtiger_leaddetails</td>
      <td style="background-color: rgb(255, 255, 204);">lastname</td>
      <td style="background-color: rgb(255, 255, 204);">Last
Name</td>
      <td style="background-color: rgb(255, 255, 204);">255</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(80)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Checkbox
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">donotcall
/&nbsp;vtiger_contactdetails</td>
      <td style="background-color: rgb(255, 255, 204);">donotcall</td>
      <td style="background-color: rgb(255, 255, 204);">Do
Not Call</td>
      <td style="background-color: rgb(255, 255, 204);">56</td>
      <td style="background-color: rgb(255, 255, 204);">C~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(3)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">discontinued
/&nbsp;vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204);">discontinued</td>
      <td style="background-color: rgb(255, 255, 204);">Product
Active</td>
      <td style="background-color: rgb(255, 255, 204);">56</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(1)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Contacts
popup select box </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">contactid
/&nbsp;vtiger_salesorder</td>
      <td style="background-color: rgb(255, 255, 204);">contact_id</td>
      <td style="background-color: rgb(255, 255, 204);">Contact
Name</td>
      <td style="background-color: rgb(255, 255, 204);">57</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Campaign
popup select box </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">campaignid
/&nbsp;vtiger_potential</td>
      <td style="background-color: rgb(255, 255, 204);">campaignid</td>
      <td style="background-color: rgb(255, 255, 204);">Campaign
Source</td>
      <td style="background-color: rgb(255, 255, 204);">58</td>
      <td style="background-color: rgb(255, 255, 204);">N~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Product
non-editable
capture, popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">product_id
/&nbsp;vtiger_campaign</td>
      <td style="background-color: rgb(255, 255, 204);">product_id</td>
      <td style="background-color: rgb(255, 255, 204);">Product</td>
      <td style="background-color: rgb(255, 255, 204);">59</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Attachments,
file selection box&nbsp;</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">name
/&nbsp;vtiger_attachments</td>
      <td style="background-color: rgb(255, 255, 204);">filename</td>
      <td style="background-color: rgb(255, 255, 204);">Attachment</td>
      <td style="background-color: rgb(255, 255, 204);">61</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Duration
minutes picklist - different typeofdata for the
tab_id: 9 and 16 ???</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">duration_hours
/&nbsp;vtiger_activity (16)</td>
      <td style="background-color: rgb(255, 255, 204);">duration_hours</td>
      <td style="background-color: rgb(255, 255, 204);">Duration</td>
      <td style="background-color: rgb(255, 255, 204);">63</td>
      <td style="background-color: rgb(255, 255, 204);">I~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">duration_hours
/&nbsp;vtiger_activity (9)</td>
      <td style="background-color: rgb(255, 255, 204);">duration_hours</td>
      <td style="background-color: rgb(255, 255, 204);">Duration</td>
      <td style="background-color: rgb(255, 255, 204);">63</td>
      <td style="background-color: rgb(255, 255, 204);">T~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: silver;" colspan="7" rowspan="1">Names
out of entities popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">crmid
/&nbsp;vtiger_seactivityrel</td>
      <td style="background-color: rgb(255, 255, 204);">parent_id</td>
      <td style="background-color: rgb(255, 255, 204);">Related
To</td>
      <td style="background-color: rgb(255, 255, 204);">66</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Names
out of entities
popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">parent_id
/&nbsp;vtiger_troubletickets</td>
      <td style="background-color: rgb(255, 255, 204);">parent_id</td>
      <td style="background-color: rgb(255, 255, 204);">Related
To</td>
      <td style="background-color: rgb(255, 255, 204);">68</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Products
attachments </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">imagename
/&nbsp;vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204);">vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204);">Product
Image</td>
      <td style="background-color: rgb(255, 255, 204);">69</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Date
(for the created and
modified date &amp; time)</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">createdtime
/&nbsp;vtiger_crmentity</td>
      <td style="background-color: rgb(255, 255, 204);">createdtime</td>
      <td style="background-color: rgb(255, 255, 204);">Created
Time</td>
      <td style="background-color: rgb(255, 255, 204);">70</td>
      <td style="background-color: rgb(255, 255, 204);">T~O</td>
      <td style="background-color: rgb(255, 255, 204);">datetime</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">createdtime&nbsp;/&nbsp;vtiger_crmentity</td>
      <td style="background-color: rgb(255, 255, 204);">createdtime</td>
      <td style="background-color: rgb(255, 255, 204);">Created
Time</td>
      <td style="background-color: rgb(255, 255, 204);">70</td>
      <td style="background-color: rgb(255, 255, 204);">V~O&nbsp;(???
for tab_id: 32 - ServiceContracts)</td>
      <td style="background-color: rgb(255, 255, 204);">datetime</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Currency
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">annualrevenue
/&nbsp;
vtiger_account</td>
      <td style="background-color: rgb(255, 255, 204);">annual_revenue</td>
      <td style="background-color: rgb(255, 255, 204);">Annual
Revenue</td>
      <td style="background-color: rgb(255, 255, 204);">71</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">unit_price
/&nbsp;vtiger_service</td>
      <td style="background-color: rgb(255, 255, 204);">unit_price</td>
      <td style="background-color: rgb(255, 255, 204);">Price</td>
      <td style="background-color: rgb(255, 255, 204);">71</td>
      <td style="background-color: rgb(255, 255, 204);">N~O</td>
      <td style="background-color: rgb(255, 255, 204);">decimal(25,2)&nbsp;</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Popup
select box for
Accounts, mandatory entry [Calls JS function to auto fill billing and
shipping address fields. Contact pop-up limited to only contacts
related to the selected Account]</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">accountid
/&nbsp;vtiger_quotes</td>
      <td style="background-color: rgb(255, 255, 204);">account_id</td>
      <td style="background-color: rgb(255, 255, 204);">Account
Name</td>
      <td style="background-color: rgb(255, 255, 204);">73</td>
      <td style="background-color: rgb(255, 255, 204);">I~M</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Vendor
name </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">vendor_id
/&nbsp;vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204);">vendor_id</td>
      <td style="background-color: rgb(255, 255, 204);">Vendor
Name</td>
      <td style="background-color: rgb(255, 255, 204);">75</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(11)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Potential
popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">potentialid
/&nbsp;vtiger_quotes</td>
      <td style="background-color: rgb(255, 255, 204);">potential_id</td>
      <td style="background-color: rgb(255, 255, 204);">Potential
Name</td>
      <td style="background-color: rgb(255, 255, 204);">76</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Picklist
for secondary
username entries </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">inventorymanager
/&nbsp;vtiger_quotes</td>
      <td style="background-color: rgb(255, 255, 204);">assigned_user_id1</td>
      <td style="background-color: rgb(255, 255, 204);">Inventory
Manager</td>
      <td style="background-color: rgb(255, 255, 204);">77</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Quote
popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">quoteid
/&nbsp;vtiger_salesorder</td>
      <td style="background-color: rgb(255, 255, 204);">quote_id</td>
      <td style="background-color: rgb(255, 255, 204);">Quote
Name</td>
      <td style="background-color: rgb(255, 255, 204);">78</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Sales
order popup picklist
      </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">salesorderid
/&nbsp;vtiger_invoice</td>
      <td style="background-color: rgb(255, 255, 204);">salesorder_id</td>
      <td style="background-color: rgb(255, 255, 204);">Sales
Order</td>
      <td style="background-color: rgb(255, 255, 204);">80</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Vendor
name, mandatory
entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">vendorid
/&nbsp;vtiger_purchaseorder</td>
      <td style="background-color: rgb(255, 255, 204);">
vendor_id</td>
      <td style="background-color: rgb(255, 255, 204);">Vendor
Name</td>
      <td style="background-color: rgb(255, 255, 204);">81</td>
      <td style="background-color: rgb(255, 255, 204);">I~M</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Tax
in Inventory </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">taxclass
/&nbsp;vtiger_products</td>
      <td style="background-color: rgb(255, 255, 204);">taxclass</td>
      <td style="background-color: rgb(255, 255, 204);">Tax
Class</td>
      <td style="background-color: rgb(255, 255, 204);">83</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(200)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Role
name popup picklist,
mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">roleid
/&nbsp;vtiger_user2role</td>
      <td style="background-color: rgb(255, 255, 204);">roleid</td>
      <td style="background-color: rgb(255, 255, 204);">Role</td>
      <td style="background-color: rgb(255, 255, 204);">98</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);"> <bdo
 xml:lang="en" dir="ltr">varchar(255)</bdo></td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Password,
mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">user_password
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">user_password</td>
      <td style="background-color: rgb(255, 255, 204);">Password</td>
      <td style="background-color: rgb(255, 255, 204);">99</td>
      <td style="background-color: rgb(255, 255, 204);">P~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">User
capture popup
picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">reports_to_id
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">reports_to_id</td>
      <td style="background-color: rgb(255, 255, 204);">Reports
To</td>
      <td style="background-color: rgb(255, 255, 204);">101</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(36)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">EMail,
mandatory entry</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">email1
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">email1</td>
      <td style="background-color: rgb(255, 255, 204);">Email</td>
      <td style="background-color: rgb(255, 255, 204);">104</td>
      <td style="background-color: rgb(255, 255, 204);">E~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(100)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">User
image </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">imagename
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">imagename</td>
      <td style="background-color: rgb(255, 255, 204);">User
Image</td>
      <td style="background-color: rgb(255, 255, 204);">105</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(250)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Text
box, mandatory entry </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">user_name
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">user_name</td>
      <td style="background-color: rgb(255, 255, 204);">User
Name</td>
      <td style="background-color: rgb(255, 255, 204);">106</td>
      <td style="background-color: rgb(255, 255, 204);">V~M</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(255)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Non
editable picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">status
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">status</td>
      <td style="background-color: rgb(255, 255, 204);">Status</td>
      <td style="background-color: rgb(255, 255, 204);">115</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(25)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Currency
in user details </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">currency_id&nbsp;/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">currency_id</td>
      <td style="background-color: rgb(255, 255, 204);">Currency</td>
      <td style="background-color: rgb(255, 255, 204);">116</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">hour_format&nbsp;/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">hour_format</td>
      <td style="background-color: rgb(255, 255, 204);">Calendar
Hour Format</td>
      <td style="background-color: rgb(255, 255, 204);">116</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(30)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">???
- Currency in modules - <span class="e" id="q_1297a44c64da0d44_3"> <span
 class="e" id="q_1297a44c64da0d44_3">missing entries at
<a class="moz-txt-link-freetext" href="http://wiki.vtiger.com/index.php/Ui_types">http://wiki.vtiger.com/index.php/Ui_types</a></span></span></td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">currency_id
/
vtiger_pricebook</td>
      <td style="background-color: rgb(255, 255, 204);">currency_id</td>
      <td style="background-color: rgb(255, 255, 204);">Currency</td>
      <td style="background-color: rgb(255, 255, 204);">117</td>
      <td style="background-color: rgb(255, 255, 204);">I~M</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">YES</td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">currency_id
/&nbsp;vtiger_invoice</td>
      <td style="background-color: rgb(255, 255, 204);">currency_id</td>
      <td style="background-color: rgb(255, 255, 204);">Currency</td>
      <td style="background-color: rgb(255, 255, 204);">117</td>
      <td style="background-color: rgb(255, 255, 204);">I~O</td>
      <td style="background-color: rgb(255, 255, 204);">int(19)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Admin
toggle, checkbox </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">is_admin
/&nbsp;vtiger_users</td>
      <td style="background-color: rgb(255, 255, 204);">is_admin</td>
      <td style="background-color: rgb(255, 255, 204);">Admin</td>
      <td style="background-color: rgb(255, 255, 204);">156</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">varchar(3)</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="1" style="background-color: silver;">Email,
Popup picklist </td>
    </tr>
    <tr>
      <td style="background-color: rgb(255, 255, 204);">idlistsi
/&nbsp;vtiger_emaildetails</td>
      <td style="background-color: rgb(255, 255, 204);">parent_id</td>
      <td style="background-color: rgb(255, 255, 204);">Parent
ID</td>
      <td style="background-color: rgb(255, 255, 204);">357</td>
      <td style="background-color: rgb(255, 255, 204);">V~O</td>
      <td style="background-color: rgb(255, 255, 204);">text</td>
      <td style="background-color: rgb(255, 255, 204);">No</td>
    </tr>
  </tbody>
</table>