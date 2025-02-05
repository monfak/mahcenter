/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @author of translate Carlos Rocha (aka Broas@)
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Ajax Chat language Object:
var ajaxChatLang = {

	login: '%s acaba de entrar no chat.',
	logout: '%s acaba de sair no chat.',
	logoutTimeout: '%s desligou-se (Tempo esgotado).',
	logoutIP: '%s desligou-se (Endereço de IP inválido).',
	logoutKicked: '%s desligou-se (Expulso da sala).',
	channelEnter: '%s entrou na sala.',
	channelLeave: '%s saiu da sala.',
	privmsg: '(Mensagem privada)',
	privmsgto: '(Mensagem privada enviada para %s)',
	invite: '%s convidou-te para entrar na sala %s.',
	inviteto: 'O teu convite para %s se juntar à sala %s foi enviado.',
	uninvite: '%s cancelou o convite para entrares na sala %s.',
	uninviteto: 'O cancelamento do convite para %s entrar na sala %s foi enviado.',	
	queryOpen: 'Sala privada aberta para %s.',
	queryClose: 'A sala privada para %s está fechada.',
	ignoreAdded: 'Adicionaste %s à a lista do ignorados.',
	ignoreRemoved: 'Removeste %s da lista de ignorados.',
	ignoreList: 'Utilizadores ignorados:',
	ignoreListEmpty: 'Ninguém está ignorado.',
	who: 'Utilizadores online:',
	whoChannel: 'Utilizadores online na sala %s:',
	whoEmpty: 'Nenhum utilizador online na determinada sala.',
	list: 'Salas disponíveis:',
	bans: 'Utilizadores banidos:',
	bansEmpty: 'Ninguém está banido.',
	unban: 'O utilizador %s foi desbanido.',
	whois: 'Endereço IP do utilizador %s:',
	whereis: 'O utilizador %s está na sala %s.',
	roll: '%s rola %s e começa com %s.',
	nick: '%s mudou o nick para %s.',
	toggleUserMenu: 'Menu de alternância de %s',
	userMenuLogout: 'Logout',
	userMenuWho: 'Lista de utilizadores online',
	userMenuList: 'Lista de salas disponíveis',
	userMenuAction: 'Acção administrativa',
	userMenuRoll: 'Jogar dados',
	userMenuNick: 'Trocar de nick',
	userMenuEnterPrivateRoom: 'Entrar na sala privada',
	userMenuSendPrivateMessage: 'Enviar mensagem privada',
	userMenuDescribe: 'Enviar acção administrativa em privado',
	userMenuOpenPrivateChannel: 'Abrir sala privada',
	userMenuClosePrivateChannel: 'Fechar sala privada',
	userMenuInvite: 'Convidar',
	userMenuUninvite: 'Cancelar convite',
	userMenuIgnore: 'Recusar/Aceitar',
	userMenuIgnoreList: 'Lista utilizadores ignorados',
	userMenuWhereis: 'Mostrar salas',
	userMenuKick: 'Kickar/Banir',
	userMenuBans: 'Lista de utilizadores banidos',
	userMenuWhois: 'Mostrar IP',
	unbanUser: 'Desbanir %s',
	joinChannel: 'Entrar na sala %s',
	cite: '%s cita:',
	imgDialog: 'Please enter the address (URL) of the Image:',
	urlDialog: 'Digita o endereço (URL) da página:',
	deleteMessage: 'Eliminar esta mensagem',
	deleteMessageConfirm: 'Tens a certeza que queres eliminar a mensagem selecionada do chat?',
	errorCookiesRequired: 'Os cookies são requeridos para utilizar o chat.',
	errorUserNameNotFound: 'Erro: O utilizador %s não foi encontrado.',
	errorMissingText: 'Erro: Falta o texto.',
	errorMissingUserName: 'Erro: Falta o utilizador.',
	errorInvalidUserName: 'Erro: Utilizador inválido.',
	errorUserNameInUse: 'Erro: Utilizador em uso.',
	errorMissingChannelName: 'Erro: Falta o nome da sala.',
	errorInvalidChannelName: 'Erro: O nome da sala é inválido: %s',
	errorPrivateMessageNotAllowed: 'Erro: Não são premitidas mensagens privadas.',
	errorInviteNotAllowed: 'Erro: Não tens permissão para convidar alguém para uma sala.',
	errorUninviteNotAllowed: 'Erro: Não estás autorizado a cancelar algum convite.',
	errorNoOpenQuery: 'Erro: Nenhuma sala privada aberta.',
	errorKickNotAllowed: 'Erro: Não tens permissão para kickar %s.',
	errorCommandNotAllowed: 'Erro: O comando %s não é permitido.',
	errorUnknownCommand: 'Erro: Comando desconhecido: %s',
	errorMaxMessageRate: 'Erro: Excedeste o número máximo de mensagens permitidas por minuto.',
	errorConnectionTimeout: 'Erro: O tempo de limite para a conexão esgotou. Por favor, tenta novamente..',
	errorConnectionStatus: 'Erro: Estado da conexão: %s',
	errorSoundIO: 'Erro: Falha ao carregar o ficheiro de som (Erro Flash IO).',
	errorSocketIO: 'Erro: A conexão socket para o servidor falhou (Erro Flash IO).',
	errorSocketSecurity: 'Erro: A conexão socket para o servidor falhou (Erro de segurança Flash).',
	errorDOMSyntax: 'Erro: Síntese DOM inválida (DOM ID: %s).'

}