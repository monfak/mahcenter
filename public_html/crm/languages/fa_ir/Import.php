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
 * Filename: Import.php
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
  'LBL_IMPORT_STEP_1' => 'مرحله 1',
  'LBL_IMPORT_STEP_1_DESCRIPTION' => 'انتخاب فایل',
  'LBL_IMPORT_SUPPORTED_FILE_TYPES' => 'انواع فایل هایی که پشتیبانی می شوند: .CSV, .VCF',
  'LBL_IMPORT_STEP_2' => 'مرحله 2',
  'LBL_IMPORT_STEP_2_DESCRIPTION' => 'تعیین کردن فرمت',
  'LBL_FILE_TYPE' => 'نوع فایل',
  'LBL_CHARACTER_ENCODING' => 'نحوه رمزگذاری کاراکتر',
  'LBL_DELIMITER' => 'حائل:',
  'LBL_HAS_HEADER' => 'هدر دارد',
  'LBL_IMPORT_STEP_3' => 'مرحله 3',
  'LBL_IMPORT_STEP_3_DESCRIPTION' => 'بررسی اطلاعات ثبت شده تکراری',
  'LBL_IMPORT_STEP_3_DESCRIPTION_DETAILED' => 'این گزینه را برای فعال کردن و تنظیم معیار ادغام داده ها تکراری انتخاب کنید',
  'LBL_SPECIFY_MERGE_TYPE' => 'نحوه رسیدگی به اطلاعات ثبت شده تکراری را انتخاب کنید',
  'LBL_SELECT_MERGE_FIELDS' => 'فیلدهای مطابق را برای پیدا کردن فیلدهای تکراری انتخاب کنید',
  'LBL_AVAILABLE_FIELDS' => 'فیلدهای در دسترس',
  'LBL_SELECTED_FIELDS' => 'فیلدهایی که باید تطابق داده شوند',
  'LBL_NEXT_BUTTON_LABEL' => 'بعدی',
  'LBL_IMPORT_STEP_4' => 'مرحله 4',
  'LBL_IMPORT_STEP_4_DESCRIPTION' => 'معادل ستون ها را در فیلدهای ماژول بیابید',
  'LBL_FILE_COLUMN_HEADER' => 'تیتر',
  'LBL_ROW_1' => 'ردیف 1',
  'LBL_CRM_FIELDS' => 'فیلدهای CRM',
  'LBL_DEFAULT_VALUE' => 'مقدار پیش فرض',
  'LBL_SAVE_AS_CUSTOM_MAPPING' => 'ذخیره سازی تحت عنوان معادل یاب سفارشی',
  'LBL_IMPORT_BUTTON_LABEL' => 'وارد کردن اطلاعات',
  'LBL_RESULT' => 'نتیجه',
  'LBL_TOTAL_RECORDS_IMPORTED' => 'تعداد اطلاعات ثبتی وارد شده',
  'LBL_NUMBER_OF_RECORDS_CREATED' => 'تعداد اطلاعات ثبتی ایجاد شده',
  'LBL_NUMBER_OF_RECORDS_UPDATED' => 'تعداد اطلاعات ثبتی رونویسی شده',
  'LBL_NUMBER_OF_RECORDS_SKIPPED' => 'تعداد اطلاعات ثبتی صرف نظر شده',
  'LBL_NUMBER_OF_RECORDS_MERGED' => 'تعداد اطلاعات ثبتی ادغام شده',
  'LBL_TOTAL_RECORDS_FAILED' => 'تعداد اطلاعات ثبتی ناموفق',
  'LBL_IMPORT_MORE' => 'وارد کردن اطلاعات بیشتر',
  'LBL_VIEW_LAST_IMPORTED_RECORDS' => 'آخرین اطلاعات ثبتی وارد شده',
  'LBL_UNDO_LAST_IMPORT' => 'بی اثر کردن آخرین اطلاعات وارد شده',
  'LBL_FINISH_BUTTON_LABEL' => 'پایان',
  'LBL_UNDO_RESULT' => 'بی اثر ساختن نتایج اطلاعات وارد شده',
  'LBL_TOTAL_RECORDS' => 'تعداد کل اطلاعات ثبتی',
  'LBL_NUMBER_OF_RECORDS_DELETED' => 'تعداد اطلاعات ثبتی حذف شده',
  'LBL_OK_BUTTON_LABEL' => 'تایید',
  'LBL_IMPORT_SCHEDULED' => 'ورود اطلاعات زمانبندی شد',
  'LBL_RUNNING' => 'در حال پردازش',
  'LBL_CANCEL_IMPORT' => 'لغو وارد کردن اطلاعات',
  'LBL_ERROR' => 'خطا',
  'LBL_CLEAR_DATA' => 'پاک کردن داده ها',
  'ERR_LOCAL_INFILE_NOT_ON' => 'متغیر local_infile در سرور بانک اطلاعاتی غیرفعال است.',
  'ERR_UNIMPORTED_RECORDS_EXIST' => 'لطفا صفحه آپلود را برای آپلود اطلاعات جدید خالی کنید',
  'ERR_IMPORT_INTERRUPTED' => 'فرآیند فعلی ورود اطلاعات  قطع شد. لطفا بعدا تلاش نمایید.',
  'ERR_FAILED_TO_LOCK_MODULE' => 'عملیات قفل گذاری ماژول ناموفق بود. لطفاً مجدداً تلاش کنید.',
  'LBL_SELECT_SAVED_MAPPING' => 'اطلاعات مرتبط ذخیره شده را انتخاب کنید',
  'LBL_IMPORT_ERROR_LARGE_FILE' => 'خطای حجم بیشتر فایل وارد شده از حداکثر مجاز',
  'LBL_FILE_UPLOAD_FAILED' => 'آپلود فایل ناموفق بود',
  'LBL_IMPORT_CHANGE_UPLOAD_SIZE' => 'اطلاعات وارد شده حجم فایل آپلودی را تغییر داد',
  'LBL_IMPORT_DIRECTORY_NOT_WRITABLE' => 'دایرکتوری وارد کردن اطلاعات قابل نوشتن نیست',
  'LBL_IMPORT_FILE_COPY_FAILED' => 'وارد کردن کپی فایل ناموفق بود',
  'LBL_INVALID_FILE' => 'فایل نامعتبر',
  'LBL_NO_ROWS_FOUND' => 'هیچ ردیفی یافت نشد',
  'LBL_SCHEDULED_IMPORT_DETAILS' => 'عملیات آپلود در زمان مشخص صورت می گیرد و به محض انجام، ایمیلی به شما ارسال خواهد شد <br>
										لطفا مطمئن شوید که سرور خروجی و ایمیل شما تنظیم شده باشد',
  'LBL_DETAILS' => 'اطلاعات',
  'skipped' => 'اطلاعات در نظر گرفته نشده',
  'failed' => 'اطلاعات ناموفق',
  'LBL_IMPORT_LINEITEMS_CURRENCY' => 'واحد پولی (برای فیلدهای Line Items)',
  'LBL_USE_SAVED_MAPS' => 'از نمایش های ذخیره شده استفاده کنید',
  'LBL_IMPORT_MAP_FIELDS' => 'ستون ها را برای فیلدهای CRM نشان  دهید',
  'LBL_UPLOAD_CSV' => 'آپلود فایل CSV',
  'LBL_UPLOAD_VCF' => ' آپلود فایلVCF',
  'LBL_DUPLICATE_HANDLING' => 'بررسی موارد تکراری',
  'LBL_FIELD_MAPPING' => 'معادل یابی فیلدها',
  'LBL_IMPORT_FROM_CSV_FILE' => 'ورود از فایل CSV',
  'LBL_SELECT_IMPORT_FILE_FORMAT' => 'از کجا می خواهید اطلاعات را وارد کنید؟',
  'LBL_CSV_FILE' => 'فایل CSV',
  'LBL_VCF_FILE' => 'فایل VCF',
  'LBL_GOOGLE' => 'گوگل',
  'LBL_IMPORT_COMPLETED' => 'ورود اطلاعات کامل شد',
  'LBL_IMPORT_SUMMARY' => 'خلاصه ورود اطلاعات',
  'LBL_DELETION_COMPLETED' => 'حذف کامل شد',
  'LBL_TOTAL_RECORDS_SCANNED' => 'تمام رکوردها اسکن شد',
  'LBL_SKIP_BUTTON' => 'نادیده گرفتن',
  'LBL_DUPLICATE_RECORD_HANDLING' => 'بررسی رکورد تکراری',
  'LBL_IMPORT_FROM_VCF_FILE' => 'ورود از فایل VCF',
  'LBL_SELECT_VCF_FILE' => 'فایل VCF را انتخاب کنید',
  'LBL_DONE_BUTTON' => 'انجام شد',
  'LBL_DELETION_SUMMARY' => 'حذف خلاصه',
  'LBL_SKIP_THIS_STEP' => 'رد شدن از این مرحله',
  'LBL_ICS_FILE' => 'ICS فایل',
  'LBL_UPLOAD_ICS' => 'آپلود فایل ICS',
  'LBL_IMPORT_FROM_ICS_FILE' => 'ورود از فایل ICS',
  'LBL_SELECT_ICS_FILE' => 'فایل ICS را انتخاب کنید',
  'LBL_SELECT_CSV_FILE' => 'فایل CSV را انتخاب کنید',
   'LBL_IMPORT_COMPLETED'=>'ورود فایل انجام شد',
    
);

$jsLanguageStrings = array (
);