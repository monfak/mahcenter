/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @author Manu Quintans
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Ajax Chat language Object:
var ajaxChatLang = {
	
	login: '%s logs dentro de Chat.',
	logout: '%s logs fora del Chat.',
	logoutTimeout: '%s desconectouse(Tempo de espera esgotado).',
	logoutIP: '%s desconectouse (Dirección IP non válida ).',
	logoutKicked: '%s desconectouse (Pateado).',
	channelEnter: '%s Entra no chat.',
	channelLeave: '%s Vaise do chat.',
	privmsg: '(whispers)',
	privmsgto: '(whispers to %s)',
	invite: '%s invítache a unirte a %s.',
	inviteto: 'A túa invitación a %s para unirse a %s foi enviada.',
	uninvite: '%s rechazado en %s.',
	uninviteto: 'O teu rechazo a  %s para %s foi enviado.',	
	queryOpen: 'Chat privado aberto %s.',
	queryClose: 'Chat privado pechado %s pechado.',
	ignoreAdded: 'Engadido %s a lista de usuarios ignorados.',
	ignoreRemoved: 'Eliminado %s da lista de usuarios ignorados.',
	ignoreList: 'Usuarios ignorados',
	ignoreListEmpty: 'Lista de usuarios non ignorados.',
	who: 'Usuarios conectados:',
	whoChannel: 'Usuarios en liña na canle %s:',
	whoEmpty: 'Non hai usuarios conectados neste momento.',
	list: 'Chats disponibles:',
	bans: 'Usuarios Baneados:',
	bansEmpty: 'Non hai usuarios baneados.',
	unban: 'Baneo do usuario %s revocado.',
	whois: 'Usuario %s - Direccion IP:',
	whereis: 'Usuario %s en chat %s.',
	roll: '%s rolls %s e toma %s.',
	nick: '%s agora como %s.',
	toggleUserMenu: 'Cambiar menu de usuario para %s',
	userMenuLogout: 'Sair',
	userMenuWho: 'Listar usuarios en liña',
	userMenuList: 'Canles disponibles',
	userMenuAction: 'Describe acción',
	userMenuRoll: 'Roll di',
	userMenuNick: 'Cambiar nome de usuario',
	userMenuEnterPrivateRoom: 'Entrar nun privado',
	userMenuSendPrivateMessage: 'Enviar mensaxe privada',
	userMenuDescribe: 'Enviar accion en privado',
	userMenuOpenPrivateChannel: 'Abrir privado',
	userMenuClosePrivateChannel: 'Pechar privado',
	userMenuInvite: 'Invitar',
	userMenuUninvite: 'Rechazar invitado',
	userMenuIgnore: 'Ignorar/Aceptar',
	userMenuIgnoreList: 'Lista usuarios ignorados',
	userMenuWhereis: 'Amosar canle',
	userMenuKick: 'Banear',
	userMenuBans: 'Lista usuarios baneados',
	userMenuWhois: 'Amosar IP',
	unbanUser: 'Eliminar baneo de %s',
	joinChannel: 'Unirte a %s',
	cite: '%s dixo:',
	imgDialog: 'Please enter the address (URL) of the Image:',
	urlDialog: 'Por favor, introduce a URL da paxina web:',
	deleteMessage: 'Eliminar mensaxe',
	deleteMessageConfirm: 'Queres borra-la mensaxe?',
	errorCookiesRequired: 'As Cookies son necesarias para o chat.',
	errorUserNameNotFound: 'Error: usuario %s non encontrado.',
	errorMissingText: 'Error: mensaxe perdida.',
	errorMissingUserName: 'Error: Usuario non encontrado.',
	errorInvalidUserName: 'Error: Nome de usuario non valido.',
	errorUserNameInUse: 'Error: Usuario en uso.',
	errorMissingChannelName: 'Error: No se atopa a canle.',
	errorInvalidChannelName: 'Error: Nome inválido de canle: %s',
	errorPrivateMessageNotAllowed: 'Error: mensaxes privadas non permitidas.',
	errorInviteNotAllowed: 'Error: Non se che permite invitar nesta canle.',
	errorUninviteNotAllowed: 'Error: Non se che permite rechazar invitados nesta canle.',
	errorNoOpenQuery: 'Error: Ningunha canle privado aberto.',
	errorKickNotAllowed: 'Error: Non podes banear %s.',
	errorCommandNotAllowed: 'Error: Comando non permitido: %s',
	errorUnknownCommand: 'Error: Comando descoñecido: %s',
	errorMaxMessageRate: 'Error: Excedes o numero maximo de mensaxes por minuto.',
	errorConnectionTimeout: 'Error: Tempo superado. Téntao de novo.',
	errorConnectionStatus: 'Error: Estado de conexión: %s',
	errorSoundIO: 'Error: Error o reproducir son(Flash IO Error).',
	errorSocketIO: 'Error: Conexión co servidor fallida (Flash IO Error).',
	errorSocketSecurity: 'Error: Conexión co servidor fallida(Flash Security Error).',
	errorDOMSyntax: 'Error: Sintaxis DOM Inválida(DOM ID: %s).'
	
}