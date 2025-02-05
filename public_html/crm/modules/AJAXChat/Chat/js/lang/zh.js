/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @author mikespook
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Ajax Chat language Object:
var ajaxChatLang = {
	
	login: '%s 进入聊天室。',
	logout: '%s 退出聊天室。',
	logoutTimeout: '%s 因超时，退出聊天室。',
	logoutIP: '%s 因不合法的 IP 地址退出。',
	logoutKicked: '%s 被踢出聊天室。',
	channelEnter: '%s 进入频道。',
	channelLeave: '%s 退出频道。',
	privmsg: '（悄悄话）',
	privmsgto: '（对 %s 说悄悄话）',
	invite: '%s 邀请你加入 %s。',
	inviteto: '对 %s 在频道 %s 的邀请已经发送。',
	uninvite: '%s 撤销了你在频道 %s 的邀请。',
	uninviteto: '对 %s 在频道 %s 的撤销邀请已经发送。',	
	queryOpen: '私人频道对 %s 打开。',
	queryClose: '私人频道对 %s 关闭。',
	ignoreAdded: '将 %s 加入忽略列表。',
	ignoreRemoved: '从忽略列表中移除 %s。',
	ignoreList: '已忽略用户：',
	ignoreListEmpty: '已列出未忽略用户。',
	who: '在线用户：',
	whoChannel: '频道 %s 的在线用户：',
	whoEmpty: '指定频道中没有在线用户。',
	list: '可用频道：',
	bans: '已禁言用户：',
	bansEmpty: '已列出未禁言用户。',
	unban: '用户 %s 的禁言已取消。',
	whois: '用户 %s - IP 地址：',
	whereis: '用户 %s 进入频道 %s.',
	roll: '%s 摇出了 %s 并且得到了 %s。',
	nick: '%s 改名为 %s。',
	toggleUserMenu: '切换用户 %s 的菜单',
	userMenuLogout: '退出',
	userMenuWho: '列出在线用户',
	userMenuList: '列出可用的频道',
	userMenuAction: '动作描述',
	userMenuRoll: '摇骰子',
	userMenuNick: '修改用户名',
	userMenuEnterPrivateRoom: '进入私人房间',
	userMenuSendPrivateMessage: '发送私人消息',
	userMenuDescribe: '发送私人动作',
	userMenuOpenPrivateChannel: '打开私人频道',
	userMenuClosePrivateChannel: '关闭私人频道',
	userMenuInvite: '邀请',
	userMenuUninvite: '撤销邀请',
	userMenuIgnore: '忽略/接收',
	userMenuIgnoreList: '列出忽略的用户',
	userMenuWhereis: '显示频道',
	userMenuKick: '踢/禁',
	userMenuBans: '列出禁言的用户',
	userMenuWhois: '显示 IP',
	unbanUser: '撤销用户 %s 禁言',
	joinChannel: '加入频道 %s',
	cite: '%s 说：',
	imgDialog: 'Please enter the address (URL) of the Image:',
	urlDialog: '请输入网页地址（URL）：',
	deleteMessage: '删除聊天记录',
	deleteMessageConfirm: '要删除已经发出的聊天记录吗？',
	errorCookiesRequired: '聊天室需要开启 Cookie 功能。',
	errorUserNameNotFound: '错误：未找到用户 %s。',
	errorMissingText: '错误：缺少消息内容。',
	errorMissingUserName: '错误：缺少用户名。',
	errorInvalidUserName: 'Error: Invalid username.',
	errorUserNameInUse: 'Error: Username already in use.',
	errorMissingChannelName: '错误：缺少频道名。',
	errorInvalidChannelName: '错误：错误的频道名：%s',
	errorPrivateMessageNotAllowed: '错误：不允许发送私人消息。',
	errorInviteNotAllowed: '错误：你在这个频道没有权限邀请他人。',
	errorUninviteNotAllowed: '错误：你在这个频道没有权限取消邀请。',
	errorNoOpenQuery: '错误：没有私人频道开放。',
	errorKickNotAllowed: '错误：没有权限提出 %s。',
	errorCommandNotAllowed: '错误：不允许的命令：%s',
	errorUnknownCommand: '错误：未知命令：%s',
	errorMaxMessageRate: '错误：超出了每分钟最大讯息数。',
	errorConnectionTimeout: '错误：连接超时，请重试。',
	errorConnectionStatus: '错误：连接状态：%s',
	errorSoundIO: '错误：加载声音文件失败（Flash IO 错误）。',
	errorSocketIO: '错误：连接 Socket 服务器失败（Flash IO 错误）。',
	errorSocketSecurity: '错误：连接 Socket 服务器失败（Flash 安全错误）。',
	errorDOMSyntax: '错误：错误的 DOM 语法（DOM ID：%s）。'
	
}