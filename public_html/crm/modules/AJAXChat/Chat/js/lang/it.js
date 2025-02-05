/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @author s8s8
 * @author Massimiliano Tiraboschi
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// Ajax Chat language Object:
var ajaxChatLang = {
	
	login: '%s entra in Chat.',
	logout: '%s esce dalla Chat.',
	logoutTimeout: '%s esce (TimeOut).',
	logoutIP: '%s esce (IP non valido).',
	logoutKicked: '%s esce (Kicked).',
	channelEnter: '%s entra nel canale.',
	channelLeave: '%s lascia il canale.',
	privmsg: '(privato)',
	privmsgto: '(privato a %s)',
	invite: '%s ti invita a entrare in %s.',
	inviteto: 'Il tuo invito ad entrare nel canale %s è stato inviato a %s.',
	uninvite: '%s ha rimosso il tuo invito per %s.',
	uninviteto: 'Rimosso invito per %s per il canale %s.',
	queryOpen: 'Canale privato aperto con %s.',
	queryClose: 'Canale privato con %s chiuso.',
	ignoreAdded: '%s aggiunto agli ingorati.',
	ignoreRemoved: '%s rimosso dagli ignorati.',
	ignoreList: 'Utenti Ignorati:',
	ignoreListEmpty: 'Utenti permessi.',
	who: 'Utenti Online:',
	whoChannel: 'Utenti Online nel canale %s:',
	whoEmpty: 'Nessun utente in linea nel canale.',
	list: 'Canali disponibili:',
	bans: 'Utenti Bannati:',
	bansEmpty: 'Nessun utente bannato in lista.',
	unban: 'Ban di %s rimosso.',
	whois: '%s - IP:',
	whereis: 'User %s is in channel %s.',
	roll: '%s lancia %s e fa %s.',
	nick: '%s è conosciuto ora come %s.',
	toggleUserMenu: 'Mostra/Nascondi menu per %s',
	userMenuLogout: 'Esci',
	userMenuWho: 'Lista utenti online',
	userMenuList: 'Lista canali disponibili',
	userMenuAction: 'Descrivi azione',
	userMenuRoll: 'Getta dadi',
	userMenuNick: 'Cambia username',
	userMenuEnterPrivateRoom: 'Entra canale privato',
	userMenuSendPrivateMessage: 'Invia messaggio privato',
	userMenuDescribe: 'Invia azione privata',
	userMenuOpenPrivateChannel: 'Apri canale privato',
	userMenuClosePrivateChannel: 'Chiudi canale privato',
	userMenuInvite: 'Invita',
	userMenuUninvite: 'Disinvita',
	userMenuIgnore: 'Ignora/Accetta',
	userMenuIgnoreList: 'Lista utenti ignorati',
	userMenuWhereis: 'Mostra canale',
	userMenuKick: 'Butta fuori/Banna',
	userMenuBans: 'Lista utenti bannati',
	userMenuWhois: 'Mostra IP',
	unbanUser: 'Revoca il ban per l\'utente %s',
	joinChannel: 'Entra nel canale %s',
	cite: '%s dice:',
	imgDialog: 'Please enter the address (URL) of the Image:',
	urlDialog: 'Inserire indirizzo (URL) della pagina Web:',
	deleteMessage: 'Cancella questo messaggio',
	deleteMessageConfirm: 'Sicuro di cancellare il messaggio selezionato ?',
	errorCookiesRequired: 'I Cookies sono richiesti per questa chat.',
	errorUserNameNotFound: 'Errore: Utente %s non trovato.',
	errorMissingText: 'Errore: Messaggio di testo non trovato.',
	errorMissingUserName: 'Errore: Nome Utente non trovato.',
	errorInvalidUserName: 'Error: Invalid username.',
	errorUserNameInUse: 'Error: Username already in use.',
	errorMissingChannelName: 'Errore: Canale non trovato.',
	errorInvalidChannelName: 'Errore: Nome canale non valido: %s',
	errorPrivateMessageNotAllowed: 'Errore: Messaggi privati non permessi.',
	errorInviteNotAllowed: 'Errore: Non hai il permesso di invitare in questo canale.',
	errorUninviteNotAllowed: 'Errore: Non hai il permesso di rimuovere  inviti per queso canale.',
	errorNoOpenQuery: 'Errore: Nessun canale privato aperto.',
	errorKickNotAllowed: 'Errore: Non sei abilitato a Kikkare %s.',
	errorCommandNotAllowed: 'Errore: Comando non permesso: %s',
	errorUnknownCommand: 'Errore: Comando sconosciuto: %s',
	errorMaxMessageRate: 'Errore: Hai superato il numero massimo di messaggi per minuto.',
	errorConnectionTimeout: 'Errore: Connessione persa. Riprovare.',
	errorConnectionStatus: 'Errore: Stato di Connessione: %s',
	errorSoundIO: 'Errore: Caricamento files suono fallito (Flash IO Error).',
	errorSocketIO: 'Errore: Connection to socket server failed (Flash IO Error).',
	errorSocketSecurity: 'Error: Connection to socket server failed (Flash Security Error).',
	errorDOMSyntax: 'Error: Invalid DOM Syntax (DOM ID: %s).'
	
}