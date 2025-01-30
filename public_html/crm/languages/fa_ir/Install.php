<?php
/*+**********************************************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************************************/
/************************************************************************************************************
 * Filename: Install.php
 * Description:  Defines the Persian (Farsi - فارسی) language pack for the base application.
 * تیم پارس ویتایگر - بهار 97/Spring 2018
 * تمام حقوق محفوظ است.
 * فروش و انتشار این بسته بدون ذکر منبع و اجازه از تیم پارس ویتایگر شرعا و عرفا حرام بوده وپیگرد قانونی دارد.
 * آخرین بروزرسانی بسته زبان: 1397/04/10 
 * Contributor: VTFarsi - www.vtfarsi.ir
 * Language file for Vtiger version 7.*
 * Author: VTFarsi Team
*************************************************************************************************************/
$languageStrings = array (
  'ERR_DATABASE_CONNECTION_FAILED' => 'خطا در اتصال به سرور بانک اطلاعاتی',
  'ERR_DB_NOT_FOUND' => 'این بانک اطلاعاتی پیدا نشد.تلاش مجدد با تغییر تنظیمات بانک',
  'ERR_DB_NOT_UTF8' => 'Charset یا collation پایگاه داده با UTF8 سازگار نیست',
  'ERR_INVALID_MYSQL_PARAMETERS' => 'پارامترهای اتصال به بانک اطلاعاتی به درستی وارد نشده',
  'ERR_INVALID_MYSQL_VERSION' => 'نسخه MySQL شما توسط نرم افزار پشتیبانی نمی شود ، شما باید از نسخه 5.1 یا بالاتر استفاده کنید',
  'ERR_UNABLE_CREATE_DATABASE' => 'ایجاد بانک اطلاعاتی ممکن نیست',
  'ERR_DB_SQLMODE_NOTFRIENDLY' => 'سرور MySQL باید به صورت زیر پیکربندی شود:<br> sql_mode = ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION',
  'LBL_ADMIN_INFORMATION' => 'اطلاعات کاربر مدیر',
  'LBL_ADMIN_USER_INFORMATION' => 'اطلاعات کاربر مدیر',
  'LBL_CHOOSE_LANGUAGE' => 'انتخاب زبان پیش فرض برای این نصب:',
  'LBL_CONFIRM_CONFIGURATION_SETTINGS' => 'تایید تنظیمات',
  'LBL_CREATE_NEW_DB' => 'ایجاد دیتابیس جدید',
  'LBL_CURRENCIES' => 'ارز',
  'LBL_CURRENCY' => 'ارز',
  'LBL_DATABASE_INFORMATION' => 'اطلاعات دیتابیس',
  'LBL_DATABASE_TYPE' => 'نوع دیتابیس',
  'LBL_DATE_FORMAT' => 'فرمت تاریخ',
  'LBL_DB_NAME' => 'نام دیتابیس',
  'LBL_DISAGREE' => 'نمی پذیرم',
  'LBL_EMAIL' => 'ایمیل',
  'LBL_GD_LIBRARY' => 'پشتیبانی از GD کتابخانه',
  'LBL_HOST_NAME' => 'نام هاست',
  'LBL_I_AGREE' => 'می پذیرم',
  'LBL_IMAP_SUPPORT' => 'پشتیبانی از Imap',
  'LBL_INSTALLATION_IN_PROGRESS' => 'در حال نصب',
  'LBL_INSTALLATION_WIZARD' => 'پنجره نصب',
  'LBL_INSTALL_BUTTON' => 'نصب',
  'LBL_INSTALL_PREREQUISITES' => 'پیش نیازهای نصب',
  'LBL_MORE_INFORMATION' => 'اطلاعات بیشتر',
  'LBL_NEXT' => 'بعدی',
  'LBL_ONE_LAST_THING' => 'مورد آخر...',
  'LBL_PASSWORD_MISMATCH' => 'لطفاً رمز عبور را دوباره وارد کنید',
  'LBL_PASSWORD' => 'رمز عبور',
  'LBL_PHP_CONFIGURATION' => 'تنظیمات PHP',
  'LBL_PHP_RECOMMENDED_SETTINGS' => 'تنظیمات توصیه شده PHP',
  'LBL_PHP_VERSION' => 'نسخه PHP',
  'LBL_PLEASE_WAIT' => 'لطفا صبر کنید',
  'LBL_PRESENT_VALUE' => 'مقدار فعلی',
  'LBL_READ_WRITE_ACCESS' => 'دسترسی خواندن/نوشتن',
  'LBL_RECHECK' => 'بررسی مجدد',
  'LBL_REQUIRED_VALUE' => 'مقدار موردنیاز',
  'LBL_RETYPE_PASSWORD' => 'رمز عبور را مجدد وارد کنید',
  'LBL_ROOT_PASSWORD' => 'رمز عبور Root',
  'LBL_ROOT_USERNAME' => 'نام کاربری Root',
  'LBL_SYSTEM_CONFIGURATION' => 'تنظیمات سیستم',
  'LBL_SYSTEM_INFORMATION' => 'اطلاعات سیستم',
  'LBL_TIME_ZONE' => 'منطقه زمانی',
  'LBL_TRUE' => 'صحیح',
  'LBL_URL' => 'آدرس اینترنتی',
  'LBL_USERNAME' => 'نام کاربری',
  'LBL_VTIGER7_SETUP_WIZARD_DESCRIPTION' => 'این ویزارد به شما در نصب نرم افزار ویتایگرکمک خواهد کرد.',
  'LBL_WELCOME_TO_VTIGER7_SETUP_WIZARD' => 'به ویزارد نصب نرم افزار ویتایگرخوش آمدید',
  'LBL_WELCOME' => 'خوش آمدید',
  'LBL_ZLIB_SUPPORT' => 'پشتیبانی از Zlib',
  'LBL_SIMPLEXML' => 'پشتیبانی از SimpleXML',
  'MSG_DB_PARAMETERS_INVALID' => 'یکی از مقادیری که برای اتصال به بانک اطلاعاتی وارد شده اند نا درستند',
  'MSG_DB_ROOT_USER_NOT_AUTHORIZED' => 'پیام: نام کابری Root که برای بانک اطلاعاتی وارد کردید مجوز لازم برای تولید بانک را ندارد و یا از کاراکترهای خاص در نام بانک استفاده کرده اید',
  'MSG_DB_USER_NOT_AUTHORIZED' => 'نام کاربری وارد شده برای اتصال به بانک اطلاعاتی نا درست است',
  'MSG_LIST_REASONS' => 'این ممکن است به این دلایل باشد',
  'LBL_MYSQLI_CONNECT_SUPPORT' => 'پشتیبانی MySQLi',
  'LBL_OPEN_SSL' => 'باز SSL پشتیبانی',
  'LBL_CURL' => 'cURL پشتیبانی',
);

$jsLanguageStrings = array (
);