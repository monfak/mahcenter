 ### راهنمای اتصال به سایر بانک های اطلاعاتی با استفاده از کتابخانه ParsVT_DataBase_Model 

####کتابخانه ای برای دسترسی به انواع پایگاه داده.

کتابخانه ParsVT_DataBase_Model با PHP ADOdb نوشته شده است.

از سیستم متا تایپ (metatype system) برای یافتن نوع داده (data type) معادل یک فیلد در پایگاه داده استفاده می کند. ایده آن از Microsoft ADOdb گرفته شده است.

از انواع پایگاه داده مانند MySQL، Oracle، Microsoft SQL Server، Sybase، Sybase SQL Anywhere، Informix، PostgreSQL، FrontBase، Interbase، Foxpro، Access،ADO و ODBC پشتیبانی می کند.

همچنین این کتابخانه نه تنها از دستورات select و Delete که از Insert نیز پشتیبانی می کند.

PHP ADOdb از نوع Write once run anywhere است.(یکبار بنویسید همه جا استفاده کنید) کد sql آن انتقال پذیر(portable) است .

این کتابخانه بدون نیاز به تغییر کد، تمام پایگاه های داده اصلی را پشتیبانی می کند. توابع PHP برای دسترسی به پایگاه داده استاندارد نشده است. این نیاز به یک Class Library پایگاه داده را برای پنهان کردن اختلافات بین API پایگاه داده، بیشتر می کند، با این Class Library می توانیم به راحتی پایگاه داده را تعویض کنیم. در حال حاضر ADOdb از MySQL، Oracle، Microsoft SQL Server، Sybase، Sybase SQL Anywhere، Informix، PostgreSQL، FrontBase، Interbase، Foxpro، Access، ADO و ODBC پشتیبانی می کند. گزارش هایی مبنی بر اتصال موفق به Progress و DB2 هم از طریق ODBC نیز وجود دارد

برای کاربران ویندوز کار با آن راحت است. چون بسیاری از قرارداد ها شبیه Microsoft ADO است. بر خلاف دیگر کلاس های پایگاه داده PHP که بر دستور Select تمرکز دارند، ما کدی را ارائه می کنیم که insert و delete را هم انجام داده و قابل انتقال به دیگر پایگاه های داده باشد. برای هر پایگاه داده، متدهایی برای پردازش تاریخ (date)، الحاق رشته ها ارائه شده است.

یک سیستم متا تایپ به طور توکار نوشته شده که می توانیم معادل های نوع داده هایی مانند CHAR، STRING و TEXT را برای انواع پایگاه داده ها بیابیم.

انتقال آن راحت است، چون تمام کد وابسته به پایگاه داده در توابع stub نگهداری می شود. لازم نیست منطق هسته ی (Core logic) کلاس ها را منتقل کنید.


####راهنمای استفاده

برای اتصال به پایگاه داده میتوانید از رشته کد زیر استفاده نمایید:

```
 $db_type = "mssqlnative";
 $db_hostname = "SEPIDAR";
 $db_username = "damavand";
 $db_password = "damavand";
 $db_name = "SEPIDAR01";
 $db = ParsVT_DataBase_Model::getInstance($db_type,$db_hostname,$db_name,$db_username,$db_password);
 $db->connect();
```

بانک های اطلاعاتی مهم مورد پشتیبانی در متغیر $db_type می تواند یکی از مقادیر زیر باشد

```
 msssql ->   SQL Server 
 mssqlnative ->  SQL Server 
 mssqlpo ->  SQL Server 
 mssqlpo ->  SQL Server 
 mysql ->   MySQL Server 
 mysqli ->  MySQL Server 
 mysqlpo ->  MySQL Server 
 mysqlt ->  MySQL Server 
```

$db_hostname با نام سرور بانک اطلاعاتی و پورت غیر پیش فرض مقدار دهی میشود. برای مثال 192.168.1.2:3309

$db_name با نام بانک اطلاعاتی مقداردهی می شود

$db_username با نام کاربری بانک اطلاعاتی مقدار دهی می شود

$db_password با گذرواژه بانک اطلاعاتی مقداردهی می شود

$db_type با نام درایور بانک اطلاعاتی مقداردهی می شود

سایر بانک های اطلاعاتی مورد پشتیبانی را می توانید از لینک زیر مشاهده نمایید

[ADOdb - Database Abstraction Layer for PHP](https://adodb.org/dokuwiki/doku.php?id=v5:database:supported) 

برای دیباگ می توانید پس از ایجاد کانکشن از قطعه کد زیر استفاده نمایید

```
$db->setDebug(true);
$db->setDieOnError(true);
```

سایر دستورات جهت ارتباط منطبق با کتابخانه پیش فرض ویتایگر می باشد.

####راهنمای نصب درایور SQL Server در لینوکس

برای نصب درایور SQL Server میتوانید از دستورات زیر استفاده نمایید

 ```
yum install php-pear php-devel unixODBC-devel make

pecl install sqlsrv pdo_sqlsrv

#CentOS 7
yum -y install https://packages.microsoft.com/rhel/7/prod/msodbcsql17-17.6.1.1-1.x86_64.rpm

#CentOS 8
dnf -y install https://packages.microsoft.com/rhel/8/prod/msodbcsql17-17.6.1.1-1.x86_64.rpm

echo 'extension=pdo_sqlsrv.so' > /etc/php.d/30-pdo_sqlsrv.ini

echo 'extension=sqlsrv.so' > /etc/php.d/30-sqlsrv.ini
 ```

[Driver For Centos 7](https://packages.microsoft.com/rhel/7/prod/) 

[Driver For Centos 8](https://packages.microsoft.com/rhel/8/prod/) 
