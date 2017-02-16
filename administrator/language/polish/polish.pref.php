<?php
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Ryszard Brys
* @link: http://www.elxis.pl
* @email: ryszard.brys@gmail.com
* @description: Polish - user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bezpośredni dostęp do tego pliku nie jest możliwy.' );


class prefLang_polish {

	public $_ON_NEW_CONTENT = "Nowa treść wysłana przez [ %s ] nazwana [ %s ] w sekcji [ %s ] i kategorii [ %s ]";
	public $_E_COMMENTS = 'Komentarze';
	public $_DATE = 'Data';
	public $_E_SUBCONWAIT = 'Wysłane artykuły oczekujące na akceptację:';
	public $_E_CONTENTSUB = 'Wysyłanie treści';
	public $_MAIL_SUB = 'Użytkownik wysłał';
	public $_E_HI = 'Witaj,';
	public $_E_NEWSUBBY = "Nowe przedłożenie nadesłane przez: %s";
	public $_E_TYPESUB = 'Rodzaj:';
	public $_E_TITLE = 'Tytuł';
	public $_E_LOGINAPPR = 'Zaloguj się jako administrator, aby zaakceptować.';
	public $_E_DONTRESPOND = 'Prosimy nie odpowiadać na tą wiadomość.';
	public $_E_NEWPASS_SUB = "Nowe hasło dla %s";
	public $_E_RPASS_NADMIN = "Użytkownik %s skorzystał z funkcji przypominania hasła. Nowe hasło zostało wygenerowane i wysłane do niego.
	Jeśli nie chcesz być informowany o tym zmień USERS_RPASSMAIL w SoftDisk na No.";
	public $_E_SEND_SUB = "Szczegóły konta dla %s na %s";
	public $_ASEND_MSG = "Witaj, %s,
	Nowy użytkownik zarejestrował się jako %s.
	Ten e-mail zawiera szczegóły:

	Imię - %s
	e-mail - %s
	Nazwa użytkownika - %s

	Prosimy nie odpowiadać na tą wiadomość.";
	public $_NEW_MESSAGE = 'Nowa wiadomość prywatna';
	public $_NEW_PRMSGF = "Nowa wiadomość prywatna przesłana przez: %s";
	public $_LOG_READMSG = 'Zaloguj się jako administrator aby przeczytać tą wiadomość.';
	public $_SUBCON_APPRNTF = 'Zatwierdzenie przedłożonych treści powiadomienia';
	public $_SUBCON_ATAPPR = 'Treść wysłana jako %s została zaakceptowana.';
	public $_SECTION = 'Sekcja';
	public $_CATEGORY = 'Kategoria';

	//elxis 2008.1
	public $_MANAPPROVE = 'Aby nowi użytkownicy mogli się logować, musisz ręcznie potwierdzić ich rejestrację!';
	public $_ACCUNBLOCK = "Twoje konto na %s zostało aktywowane. Możesz teraz zalogować się jako %s";

	// elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Nowy komentarz notyfikacji';
	public $_E_NEWCOMBYTITLE = "Nowy komentarz został opublikowany przez %s na pod tytułem %s";
    public $_E_COMSTAYUNPUB = 'Ten komentarz pozostanie niepublikowanych aż super administrator opublikuje go.';
    public $_E_ACCEXPDATE = 'Data ważności konta';

	public function __construct() {
	}

}

?>