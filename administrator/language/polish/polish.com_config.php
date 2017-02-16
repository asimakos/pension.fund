<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ryszard Bryś
* @link: http://www.elxis.pl
* @email: ryszard.brys@gmail.com
* @description: Polish language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bezpośredni dostęp do tego pliku nie jest dozwolony.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE ='Strona offline';
	public $A_COMP_CONF_OFFMESSAGE ='Wiadomość offline';
	public $A_COMP_CONF_TIP_OFFMESSAGE ='Wiadomość, ta jest wyświetlany, jeśli w witryna jest offline';
	public $A_COMP_CONF_ERR_MESSAGE ='Systemowa wiadomość o błędzie';
	public $A_COMP_CONF_TIP_ERR_MESSAGE ='Wiadomość, ta jest wyświetlana, jeżeli Elxis nie mógł podłączyć się do bazy danych';
	public $A_COMP_CONF_SITE_NAME ='Nazwa witryny';
	public $A_COMP_CONF_UN_LINKS ='Pokaż nieautoryzowane Linki';
	public $A_COMP_CONF_UN_TIP ='Jeśli tak, będą wyświetlane linki do treści zarejestrowanych nawet jeśli nie jesteś zalogowany. Użytkownicy będą musieli się zalogować, aby zobaczyć pozycję w całości.';
	public $A_COMP_CONF_USER_REG ='Zezwalaj na rejestrację użytkownika.';
	public $A_COMP_CONF_TIP_USER_REG ='Jeśli tak, można dodawać nowych użytkowników do rejestracji na stronie';
	public $A_COMP_CONF_REQ_EMAIL ='Wymagaj unikalne Email';
	public $A_COMP_CONF_REQTIP ='Jeśli tak, to użytkownicy nie korzystają z tego samego adresu e-mail';
	public $A_COMP_CONF_DEBUG ='Debug Strona';
	public $A_COMP_CONF_DEBTIP ='Jeśli tak, wyświetla informacje diagnostyczne i SQL błędy, jeśli obecne';
	public $A_COMP_CONF_EDITOR ='Edytor WYSIWYG';
	public $A_COMP_CONF_LENGTH ='Długość listy';
	public $A_COMP_CONF_LENTIP ='Ustawia domyślną długość list w administracji dla wszystkich użytkowników';
	public $A_COMP_CONF_FAV_ICON ='Ikona ulubione strony';
	public $A_COMP_CONF_FAVTIP ='Jeśli pozostawić puste lub pliku nie można znaleźć, domyślnie zostanie wykorzystana favicon.ico';
	public $A_COMP_CONF_CLINKACC ='Komponent z prawem dostępu';
	public $A_COMP_CONF_CLACCDESC ='Wybierz typ elementów, które chcesz by były stosowane z systemem dostępu we frontend (ACO wartości = widok). Przeczytaj pomoc, jeśli nie masz pewności.';
	public $A_COMP_CONF_CORECOMPS ='Główne Komponenty';
	public $A_COMP_CONF_3RDCOMPS ='Trzecie Komponenty';
	public $A_COMP_CONF_ALLCOMPS ='Wszystkie Komponenty';
	public $A_COMP_CONF_CAPTCHA ='Użyj obrazy zabezpieczeń';
	public $A_COMP_CONF_CAPTCHATIP ='Tak, jeśli chcesz bezpieczeństwa obrazy (Captcha), który będzie wyświetlany wewnątrz formularzy strony. Słowo pisowni Funkcja dostępna jest również, by pomagać ludziom z problemami wzroku.';
	public $A_COMP_CONF_LOCALE ='Lokalizacja';
	public $A_COMP_CONF_LANG ='Domyślny język Front-End';
	public $A_COMP_CONF_ALANG ='Domyślny język Back-End';
	public $A_COMP_CONF_TIME_SET ='Odstęp czasowy';
	public $A_COMP_CONF_DATE ='Aktualna data/czas skonfigurowany do wyświetlania';
	public $A_COMP_CONF_LOCAL ='Kraj Lokalizacja';
	public $A_COMP_CONF_LOCRECOM ='Zalecamy pozostawienie go Auto Select. Elxis załaduje najbardziej odpowiednią lokalizację dla systemu OS i wybranego języka. System Windows nie obsługuje lokalizacji UTF-8.';
	public $A_COMP_CONF_LOCCHECK ='Sprawdź lokalizację';
	public $A_COMP_CONF_LOCCHECK2 ='Jeśli widzisz tę datę źle sformatowaną, a lokalizacja jest dobra dla naszego systemu i języka. <br /> <strong> Uwaga! </strong> W systemie Windows lokalizacja jest ustawiona automatycznie na angielski.';
	public $A_COMP_CONF_AUTOSEL ='Automatyczne';
	public $A_COMP_CONF_CONTROL ='* kontrola tych parametrów wyjściowych elementów *';
	public $A_COMP_CONF_LINK_TITLES ='Związane tytuły';
	public $A_COMP_CONF_LTITLES_TIP ='Jeśli tak, tytuł treść pozycji będzie działał jako hiperłącze do pozycji';
	public $A_COMP_CONF_MORE_LINK ='Link Więcej';
	public $A_COMP_CONF_MLINK_TIP ='Jeśli ustawione, aby pokazać, link do odczytu więcej, pokaż jeśli główny tekst został dostarczony jako pozycja';
	public $A_COMP_CONF_RATE_VOTE ='Pozycja ocena/głosowanie';
	public $A_COMP_CONF_RVOTE_TIP ='Jeśli ustawione, aby pokazać, system głosowania zostanie włączony do treści pozycji';
	public $A_COMP_CONF_AUTHOR ='Imiona Autora';
	public $A_COMP_CONF_AUTHORTIP ='Jeśli ustawione, aby pokazać, nazwisko autora będzie wyświetlane. Jest to ustawienie globalne, ale może ulec zmianie w menu i pozycji poziom';
	public $A_COMP_CONF_CREATED ='Utworzono Data i godzina';
	public $A_COMP_CONF_CREATEDTIP ='Jeśli ustawione, aby pokazać, datę i godzinę utworzenia pozycji zostanie wyświetlony. Jest to ustawienie globalne, ale może ulec zmianie w menu i pozycji poziom';
	public $A_COMP_CONF_MOD_DATE ='Zmodyfikowana Data i godzina';
	public $A_COMP_CONF_MDATETIP ='Jeśli ustawione, aby pokazać, datę i godzinę elementu ostatnio zmodyfikowanego zostaną wyświetlone. Jest to ustawienie globalne, ale może ulec zmianie w menu i pozycji poziom';
	public $A_COMP_CONF_HITS ='Wizyty';
	public $A_COMP_CONF_HITSTIP ='Jeśli ustawione, aby pokazać, do trafienia dla konkretnj pozycji będą wyświetlana. Jest to ustawienie globalne, ale może ulec zmianie w menu i pozycji poziom';
	public $A_COMP_CONF_PDF ='Ikona PDF';
	public $A_COMP_CONF_OPT_MEDIA ='Opcja niedostępna w /tmpr nie może zapisywać do katalogu';
	public $A_COMP_CONF_PRINT_ICON ='Ikona Drukuj';
	public $A_COMP_CONF_EMAIL_ICON ='Ikona Email';
	public $A_COMP_CONF_ICONS ='Ikony';
	public $A_COMP_CONF_USE_OR_TEXT ='Drukuj, RTF, PDF i e-mail będą korzystać z Ikony lub Tekstu';
	public $A_COMP_CONF_TBL_CONTENTS ='Spis treści na wielu stronach pozycjii';
	public $A_COMP_CONF_BACK_BUTTON ='Przycisk Wstecz';
	public $A_COMP_CONF_CONTENT_NAV ='Treść pozycja Nawigacja';
	public $A_COMP_CONF_HYPER ='Użyj hiperlinków w tytułów';
	public $A_COMP_CONF_DBTYPE ='Typ bazy danych';
	public $A_COMP_CONF_DBWARN ='Nie zmieniaj, chyba że system wspiera tą bazę danych i kopia danych Elxis jest zainstalowana na tej bazie danych!';
	public $A_COMP_CONF_HOSTNAME ='Nazwa hosta';
	public $A_COMP_CONF_DB_PW ='Hasło';
	public $A_COMP_CONF_DB_NAME ='Baza danych';
	public $A_COMP_CONF_DB_PREFIX ='Prefiks bazy danych';
	public $A_COMP_CONF_NOT_CH ='!! NIE ZMIENIAJ, CHYBA ŻĘ MASZ BAZĘ DANYCH ZBUDOWANĄ W OPARCIU O PREFIKS TABEL, KTÓRY USTAWIASZ!!';
	public $A_COMP_CONF_ABS_PATH ='Absolutna ścieżka';
	public $A_COMP_CONF_LIVE ='Strona Live';
	public $A_COMP_CONF_SECRET ='Tajne słowo';
	public $A_COMP_CONF_GZIP ='Kompresja GZIP strony';
	public $A_COMP_CONF_CP_BUFFER ='Kompresuje buforowane wyjście jeśli jest obsługiwane';
	public $A_COMP_CONF_SESSION_TIME ='Czas życia sesji';
	public $A_COMP_CONF_SEC ='sekund';
	public $A_COMP_CONF_AUTO_LOGOUT ='Automatyczne wylogowanie po tym okresie bezczynności';
	public $A_COMP_CONF_ERR_REPORT ='Raportowanie błędów';
	public $A_COMP_CONF_HELP_SERVER ='Pomoc Server';
	public $A_COMP_CONF_META_PAGE ='metadanych strony';
	public $A_COMP_CONF_META_DESC ='Global Site Meta Description';
	public $A_COMP_CONF_META_KEY ='Global Site Meta Keywords';
	public $A_COMP_CONF_META_TITLE ='Pokaż tytuł metatag';
	public $A_COMP_CONF_META_ITEMS ='Pokaż tytuł metatagu podczas przeglądania zawartości pozycii';
	public $A_COMP_CONF_META_AUTHOR ='Pokaż Autor metatag';
	public $A_COMP_CONF_HPS1 ='Pomoc pliki lokalne';
	public $A_COMP_CONF_HPS2 ='Pomoc Elxis zdalnego serwera';
	public $A_COMP_CONF_HPS3 ='Dziennik Elxis Pomoc Server';
	public $A_COMP_CONF_PERMFLES ='Wybierz tę opcję, aby określić uprawnienia flagi nowych plików';
	public $A_COMP_CONF_PERMDIRS ='Wybierz tę opcję, aby określić uprawnienia flagi nowych katalogów';
	public $A_COMP_CONF_NCHMODDIRS ='Nie używaj chmod dla nowych katalogów (użyj domyślnych ustawień serwera)';
	public $A_COMP_CONF_CHAPFLAGS ='Sprawdzanie tutaj będzie stosować pozwolenia flagi do <em> wszystkich istniejących plików </em> w witrynie. <br/> <strong> NIEWŁAŚCIWE UŻYCIE TEJ OPCJI MOŻE UCZYNIĆ OBSZAR NIEPRACUJĄCYM! </strong>';
	public $A_COMP_CONF_CHAPDLAGS ='Sprawdzanie tutaj będzie stosować pozwolenia flagi do <em> wszystkich istniejących katalogów </em> w witrynie. <br/> <strong> NIEWŁAŚCIWE UŻYCIE TEJ OPCJI MOŻE UCZYNIĆ OBSZAR NIEPRACUJĄCYM! </strong>';
	public $A_COMP_CONF_APPEXDIRS ='Stosuje się do istniejących Katalogów';
	public $A_COMP_CONF_APPEXFILES ='Stosuje się do istniejących plików';
	public $A_COMP_CONF_WORLD ='Świat';
	public $A_COMP_CONF_CHMODNDIRS ='CHMOD nowych katalogów';
	public $A_COMP_CONF_MAIL ='Program';
	public $A_COMP_CONF_MAIL_FROM ='Wyślij Od';
	public $A_COMP_CONF_MAIL_FROM_NAME ='Nazwa Od';
	public $A_COMP_CONF_MAIL_SMTP_AUTH ='SMTP Autor';
	public $A_COMP_CONF_MAIL_SMTP_USER ='SMTP użytkownik';
	public $A_COMP_CONF_MAIL_SMTP_PASS ='SMTP hasło';
	public $A_COMP_CONF_MAIL_SMTP_HOST ='SMTP Host';
	public $A_COMP_CONF_CACHE ='Buforowanie';
	public $A_COMP_CONF_CACHE_FOLDER ='Folder Cache';
	public $A_COMP_CONF_CACHE_DIR ='Aktualny katalog cache';
	public $A_COMP_CONF_CACHE_DIR_UNWRT ='Katalog cache niezapisywalny - proszę ustawić ten katalog CHMOD 777 przed włączeniem cache';
	public $A_COMP_CONF_CACHE_TIME ='Czas Cache';
	public $A_COMP_CONF_STATS ='Statystyki';
	public $A_COMP_CONF_STATS_ENABLE ='Włącz/Wyłącz zbieranie statystyk strony';
	public $A_COMP_CONF_STATS_LOG_HITS ='Treść wniosków wraz z datą zapisu';
	public $A_COMP_CONF_STATS_WARN_DATA ='OSTRZEŻENIE: Duże ilości danych będą zbierane';
	public $A_COMP_CONF_STATS_LOG_SEARCH ='Zbieraj szukane teksty';
	public $A_COMP_CONF_SEO_LBL ='SEO';
	public $A_COMP_CONF_SEO ='Optymalizacja SEO';
	public $A_COMP_CONF_SEO_SEFU ='SEF adresy URL';
	public $A_COMP_CONF_SEOBASIC ='SEO podstawowe';
	public $A_COMP_CONF_SEOPRO ='SEO Pro';
	public $A_COMP_CONF_SEOHELP ='Apache i IIS. Apache: aby zmienić nazwę htaccess.txt. htaccess przed aktywacją (aktywne mod_rewrite). IIS: wykorzystanie Ionic Rewriter filtr ISAPI. Aby zapewnić maksymalną wydajność przygotowanie treści przed włączeniem SEO PRO. Wybierz SEO Podstawowe, jeśli chcesz użyć trzeciej części składnika SEF.';
	public $A_COMP_CONF_SEO_DYN ='Dynamiczny tytuł strony';
	public $A_COMP_CONF_SEO_DYN_TITLE ='Dynamiczne zmiany tytułu strony w celu uwzględnienia aktualnej zawartości wyświetlania';
	public $A_COMP_CONF_SERVER ='Serwer';
	public $A_COMP_CONF_METADATA ='Metadata';
	public $A_COMP_CONF_CACHE_TAB ='Cache';
	public $A_COMP_CONF_FTP_LBL ='FTP';
	public $A_COMP_CONF_FTP ='Ustawienia FTP';
	public $A_COMP_CONF_FTP_ENB ='Włącz';
	public $A_COMP_CONF_FTP_HST ='FTP Host';
	public $A_COMP_CONF_FTP_HSTTP ='Najprawdopodobniej';
	public $A_COMP_CONF_FTP_USR ='FTP użytkownik';
	public $A_COMP_CONF_FTP_USRTP ='Najprawdopodobniej';
	public $A_COMP_CONF_FTP_PAS ='FTP Hasło';
	public $A_COMP_CONF_FTP_PRT ='FTP Port';
	public $A_COMP_CONF_FTP_PRTTP ='Wartość domyślna to: 21';
	public $A_COMP_CONF_FTP_PTH ='FTP Root Ścieżka';
	public $A_COMP_CONF_FTP_PTHTP ='Ścieżka FTP root z twojej instalacji Elxis. Np. / public_html/elxis';
	public $A_COMP_CONF_HIDE ='Ukryj';
	public $A_COMP_CONF_SHOW ='Pokaż';
	public $A_COMP_CONF_DEFAULT ='Preferencje systemowe';
	public $A_COMP_CONF_NONE ='Brak';
	public $A_COMP_CONF_SIMPLE ='Proste';
	public $A_COMP_CONF_MAX ='Maksymalna';
	public $A_COMP_CONF_MAIL_FC ='PHP mail';
	public $A_COMP_CONF_SEND ='sendmail';
	public $A_COMP_CONF_SENDP ='Sendmaila ścieżka';
	public $A_COMP_CONF_SMTP ='Serwer SMTP';
	public $A_COMP_CONF_UPDATED ='Konfiguracja danych zostały <strong>zaktualizowane!</strong>';
	public $A_COMP_CONF_ERR_OCC ='<strong> Wystąpił błąd! </strong> Nie można otworzyć pliku konfiguracyjnego do zapisu!';
	public $A_COMP_CONF_READ ='Odczyt';
	public $A_COMP_CONF_WRITE ='Zapis';
	public $A_COMP_CONF_EXEC ='Wykonywanie';
	public $A_COMP_CONF_FCRE ='Tworzenie pliku';
	public $A_COMP_CONF_FPERM ='Uprawnienia pliku';
	public $A_COMP_CONF_DCRE ='Tworzenie katalogu';
	public $A_COMP_CONF_DPERM ='Uprawnienia katalogu';
	public $A_COMP_CONF_OFFEX ='Tak (z wyjątkiem Super Administratorów)';
	public $A_COMP_CONF_RTF ='Ikona RTF';
	public $A_C_CONF_AC_ACT ='Konto';
	public $A_C_CONF_NOACT ='Brak aktywacji';
	public $A_C_CONF_EMACT ='Aktywacji przez e-mail';
	public $A_C_CONF_MANACT ='Ręczna inicjalizacja';
	public $A_C_CONF_AC_ACTD ='Wybierz, sposób w jaki chcesz aktywować nowe konta użytkowników. Bezpośrednio, za pośrednictwem aktywacji łącza w wiadomości e-mail lub ręcznie przez administratora.';

	// 2009.0
	public $A_C_CONF_COMMENTS = 'Komentarze';
	public $A_C_CONF_COMMENTSTIP = 'Jeśli ustawione, aby pokazać, liczbę komentarzy na temat treści danej pozycji będzie wyświetlana. Jest to ustawienie globalne, ale można zmienić w menu i pozycji poziom';
	public $A_C_CONF_CHKFTP = 'Sprawdź ustawienia FTP';
	public $A_C_CONF_STDCACHE = 'Standardowy cache';
	public $A_C_CONF_STATCACHE = 'Statystyki cache';
	public $A_C_CONF_CACHED = 'Standard Cache buforuje częściowo stronę blokuje, natomiast statyczne Cach całą stronę. Statyczny Cache jest zalecany do ciężkich załadowanych stron. Aby użyć statyczny cach musisz mieć aktywne SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO jest wyłączony!';

	public function __construct() {	
	}

}

?>