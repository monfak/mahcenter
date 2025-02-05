/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @author pepotiger (www.dd4bb.com)
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

// Ajax Chat language Object:
var ajaxChatLang = {
	
	login: '%s وارد شد.',
	logout: '%s خارج شد.',
	logoutTimeout: '%s شما از گفتگو خارج شده اید (Timeout).',
	logoutIP: '%s شما از گفتگو خارج شده اید (Invalid IP address).',
	logoutKicked: '%s شما از گفتگو خارج شده اید (Kicked).',
	channelEnter: '%s وارد محیط گفتگو شد.',
	channelLeave: '%s از محیط گفتگو خارج شد.',
	privmsg: '(پیغام خصوصی)',
	privmsgto: '(پیغام خصوصی برای %s)',
	invite: '%s دعوت به %s.',
	inviteto: 'دعوت شما به %s برای ورود به اتاق %s ارسال شد.',
	uninvite: '%s لغو دعوت شما از ورود به اتاق %s.',
	uninviteto: 'لغو دعوت شما به %s برای اتاق %s ارسال شد.',	
	queryOpen: 'گفتگوی خصوصی با %s باز شد.',
	queryClose: 'گفتگوی خصوصی با %s به پایان رسید.',
	ignoreAdded: '%s به لیست صرف نظر اضافه شد.',
	ignoreRemoved: '%s از لست صرف نظر حذف شد.',
	ignoreList: 'اعضای صرف نظر شده:',
	ignoreListEmpty: 'عضو صرف نظر شده ای وجود ندارد.',
	who: 'اعضای آنلاین:',
	whoChannel: 'اعضای آنلاین در اتاق گفتگو %s:',
	whoEmpty: 'اتاق گفتگو خالیست .',
	list: 'اتاق های موجود:',
	bans: 'افراد محدود شده:',
	bansEmpty: 'عضو محدود شده ای وجود ندارد.',
	unban: 'محدود شدن %s لغو شد.',
	whois: '%s - آدرس آیپی:',
	whereis: 'کاربر %s در اتاق %s مشغول به گفتگو میباشد.',
	roll: '%s rolls %s and gets %s.',
	nick: '%s هم اکنون به نام %s شناخته می شود.',
	toggleUserMenu: 'تغییر وضعیت منوی کاربری برای %s',
	userMenuLogout: 'خروج',
	userMenuWho: 'لیست اعضای آنلاین',
	userMenuList: 'لیست اتاق های موجود',
	userMenuAction: 'شرح واقعه',
	userMenuRoll: 'Roll dice',
	userMenuNick: 'تغییر نام کاربری',
	userMenuEnterPrivateRoom: 'ورود به اتاق خصوصی',
	userMenuSendPrivateMessage: 'ارسال پیغام خصوصی',
	userMenuDescribe: 'ارسال واقعه خصوصی',
	userMenuOpenPrivateChannel: 'بازکردن اتاق خصوصی',
	userMenuClosePrivateChannel: 'بستن اتاق خصوصی',
	userMenuInvite: 'دعوت',
	userMenuUninvite: 'لغو دعوت',
	userMenuIgnore: 'صرف نظر/قبول',
	userMenuIgnoreList: 'لیست افراد صرف نظر شده',
	userMenuWhereis: 'نمایش اتاق ها',
	userMenuKick: 'اخراج/محدود کردن',
	userMenuBans: 'لیست افراد محدود شده',
	userMenuWhois: 'نمایش آیپی',
	unbanUser: 'لغو محدودیت برای کاربر : %s',
	joinChannel: '%s وارد محیط گفتگو شد',
	cite: '%s نوشته شده:',
	imgDialog: 'لطفا نام آدرس (URL) تصویر را وارد کنید:',
	urlDialog: 'لطفا نام آدرس (URL) وب سایت را وارد کنید:',
	deleteMessage: 'حذف این پیغام گفتگو',
	deleteMessageConfirm: 'آیا از حذف این پیغام اطمینان دارید؟',
	errorCookiesRequired: 'کوکی ها برای گفتگو در این سایت ضروری می باشند.',
	errorUserNameNotFound: 'خطا: نام کاربری %s موجود نمی باشد.',
	errorMissingText: 'خطا: متن پیغام دردسترس نمیباشد.',
	errorMissingUserName: 'خطا: نام کاربری موجود نمیباشد.',
	errorInvalidUserName: 'خطا: نام کاربری اشتباه است.',
	errorUserNameInUse: 'خطا: نام کاربری هم اکنون درحال استفاده می باشد.',
	errorMissingChannelName: 'خطأ: نام اتاق گفتگو موجود نیست.',
	errorInvalidChannelName: 'خطا: نام اتاق گفتگو : %s اشتباه است',
	errorPrivateMessageNotAllowed: 'خطا: اجازه ارسال پیغام خصوصی داده نشده است.',
	errorInviteNotAllowed: 'خطا: اجازه دعوت داده نشده است.',
	errorUninviteNotAllowed: 'خطا: لغو دعوت امکان پذیر نیست.',
	errorNoOpenQuery: 'خطا: هیچ اتاق خصوصی ای موجود نمیباشد.',
	errorKickNotAllowed: 'خطا: اجازه اخراج داده نشده است %s.',
	errorCommandNotAllowed: 'خطا: برای فرمان: %s اجازه داده نشده است',
	errorUnknownCommand: 'خطأ: دستور : %s شناخته نشده است',
	errorMaxMessageRate: 'خطا: شما از حداکثر مجاز برای تعداد پیام در دقیقه عبور کرده اید.',
	errorConnectionTimeout: 'خطا: زمان اتصال به پایان رسید. لطفا دوباره تلاش کنید.',
	errorConnectionStatus: 'خطا: مورد اتصال: %s',
	errorSoundIO: 'خطا: خطا در اجرای فایل صوتی (Flash IO Error).',
	errorSocketIO: 'خطا: اشکال در ایجاد اتصال به درگاه سرور (Flash IO Error).',
	errorSocketSecurity: 'خطا: اشکال در اتصال به درگاه سرور (Flash Security Error).',
	errorDOMSyntax: 'خطا: دستور DOM اشتباه است (کد DOM: %s).'
	
}
