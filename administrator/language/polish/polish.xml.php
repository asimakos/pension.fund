<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin/XML Language
* @author: Elxis Team
* @translator: Ryszard Bryś
* @link: http://www.elxis.pl
* @email: ryszard.brys@gmail.com
* @description: Polish Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008/2009: values for custom language strings defined as php contants start with'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Bezpośredni dostęp do tego pliku nie jest dozwolony.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL ='Obraz Menu';
protected $AX_MENUIMGD ='Mały obrazek, który ma być przedstawiony na lewej lub prawej stronie pozycji menu. Obraz powinien być zlokalizowany w katalogu images/stories/.';
protected $AX_MENUIMGONLYL ='Użyj tylko obraz menu';
protected $AX_MENUIMGONLYD ='Jeśli wybierzesz <strong>Tak</strong>, a następnie w pozycji menu będą reprezentowane tylko przez wybrany obraz. <br /> <br /> Jeśli wybierzesz <strong>Nie</strong> a następnie w pozycji menu będą reprezentowane przez wybrany obraz PLUS tekst.';
protected $AX_MENUIMG2D ='Mały obrazek, który ma być przedstawiony na lewej lub prawej stronie pozycji menu. Obrazki muszą być w katalogu /images .';
protected $AX_PAGCLASUFL ='Strona Klasy Przyrostek';
protected $AX_PAGCLASUFD ='Przyrostek będzie stosowany dla klas css strony. W ten sposób możemy osiągnąć zróżnicowanie wyglądu strony.';
protected $AX_TEXTPAGECL ='Przyrostek Artykułu';
protected $AX_TEXTPAGECLD ='Przyrostek będzie stosowany dla css klasy artykułu. W ten sposób możemy osiągnąć zróżnicowania w wyglądzie tego artykułu.';
protected $AX_BACKBUTL ='Wstecz';
protected $AX_BACKBUTD ='Pokaż/Ukryj Przycisk Wstecz, aby powrócić do poprzedniej strony';
protected $AX_USEGLB ='Ustawienia ogólne';
protected $AX_HIDE ='Ukryj';
protected $AX_SHOW ='Widok';
protected $AX_AUTO ='Automatycznie';
protected $AX_PAGTITLSL ='Pokaż Tytuł strony';
protected $AX_PAGTITLSD ='Pokaż/Ukryj tytuł strony.';
protected $AX_PAGTITLL ='Tytuł strony';
protected $AX_PAGTITLD ='Tekst wyświetlany na górze strony. Jeśli pozostanie puste, będzie automatycznie korzystać z nazwy w menu.';
protected $AX_PAGTITL2D ='Wpisz tekst wyświetlany na górze strony.';
protected $AX_LEFT ='Lewo';
protected $AX_RIGHT ='Prawo';
protected $AX_PRNTICOL ='Ikona Drukuj';
protected $AX_PRNTICOD ='Pokaż/Ukryj ikonę drukowania - dotyczy tylko tej strony.';
protected $AX_YES ='Tak';
protected $AX_NO ='Nie';
protected $AX_SECNML ='Nazwa modułu';
protected $AX_SECNMD ='Pokaż/Ukryj nazwa modułu, w którym pozycja należy';
protected $AX_SECNMLL ='Połączenie Nazwa Jedność';
protected $AX_SECNMLD ='Wprowadź tekst sekcji linku do aktualnej sekcji strony.';
protected $AX_CATNML ='Nazwa kategorii';
protected $AX_CATNMD ='Pokaż/Ukryj pozycja kategorii należący do';
protected $AX_CATNMLL ='Nazwa kategorii Connected';
protected $AX_CATNMLD ='Wprowadź tekst kategoria link do rzeczywistej kategorii strony.';
protected $AX_LNKTTLL ='Związane tytuły';
protected $AX_LNKTTLD ='Aby uruchomić tytuł pozycji jako link';
protected $AX_ITMRATL ='Ocena pozycji';
protected $AX_ITMRATD ='Pokaż/Ukryj oceny pozycji - dotyczy tylko tej strony.';
protected $AX_AUTNML ='Imiona Autorów';
protected $AX_AUTNMD ='Pokaż/Ukryj autora pozycji - dotyczy tylko tej strony.';
protected $AX_CTDL ='Data i godzina utworzenia';
protected $AX_CTDD ='Pokaż/Ukryj daty utworzenia pozycji - dotyczy tylko tej strony.';
protected $AX_MTDL ='Zmodyfikowana data i godzina';
protected $AX_MTDD ='Pokaż/Ukryj datę zmiany pozycji - dotyczy tylko tej strony.';
protected $AX_PDFICL ='Ikona PDF';
protected $AX_PDFICD ='Pokaż/Ukryj pozycja przycisku PDF - dotyczy tylko tej strony.';
protected $AX_PRICL ='Ikona Drukuj';
protected $AX_PRICD ='Pokaż/Ukryj pozycja przycisku drukowania treści - dotyczy tylko tej strony.';
protected $AX_EMICL ='Ikona Email';
protected $AX_EMICD ='Pokaż/Ukryj pozycja przycisku e-mail - dotyczy tylko tej strony.';
protected $AX_FTITLE ='Tytuł';
protected $AX_FAUTH ='Autor';
protected $AX_FHITS ='Widok';
protected $AX_DESCRL ='Opis';
protected $AX_DESCRD ='Pokaż/Ukryj Opis poniżej.';
protected $AX_DESCRTXL ='Tekst opisu';
protected $AX_DESCRTXD ='Opis strony, jeśli pozostanie puste to będzie załadowany z_pliku językowego WEBLINKS_DESC';
protected $AX_IMAGEL ='Obraz';
protected $AX_IMGFRPD ='Obraz dla strony musi znajdować się w katalogu /images/stories. Domyślnie będzie załadowany web_links.jpg. \'Nie\' obraz nie będzie załadowany obraz.';
protected $AX_IMGALL ='Wyrównaj obraz';
protected $AX_IMGALD ='Ustawienie obrazu.';
protected $AX_TBHEADL ='Tabela nagłówki';
protected $AX_TBHEADD ='Pokaż/Ukryj nagłówki w tabeli.';
protected $AX_POSCOLL ='Pozycja Kolumny';
protected $AX_POSCOLD ='Pokaż/Ukryj pozycję kolumny.';
protected $AX_EMAILCOLL ='Kolumna Email';
protected $AX_EMAILCOLD ='Pokaż/Ukryj kolumnę Email.';
protected $AX_TELCOLL ='Kolumna Telefon';
protected $AX_TELCOLD ='Pokaż/Ukryj kolumnę Telefon.';
protected $AX_FAXCOLL ='Kolumna Faks';
protected $AX_FAXCOLD ='Pokaż/Ukryj kolumne Fax.';
protected $AX_LEADINGL ='# widoczny';
protected $AX_LEADINGD ='Liczba faktycznych treści, które mają być przedstawione w sposób widoczny (w pełna szerokość) pozycji. 0 oznacza, że żadna pozycja nie będzie wyświetlany jako wiodący.';
protected $AX_INTROL ='# wprowadzenie';
protected $AX_INTROD ='Liczba faktycznych treści, które mają być wyświetlane z widocznymi wprowadzającym tekstem.';
protected $AX_COLSL ='Kolumny';
protected $AX_COLSD ='Wybierz ile kolumn zostanie wykorzystane na linię, gdy pojawi się tekst wprowadzający.';
protected $AX_LNKSL ='# Linki';
protected $AX_LNKSD ='Liczba faktycznych treści, które mają być wyświetlane jako linki';
protected $AX_CATORL ='Kolejność Kategorii';
protected $AX_CATORD ='Sortuj według pozycji kategorii.';
protected $AX_OCAT01 ='Nie tylko na podstawie Głównej Klasyfikacja';
protected $AX_OCAT02 ='Alfabetycznie wg tytułów';
protected $AX_OCAT03 ='Odwrotnie alfabetycznie według tytułu';
protected $AX_OCAT04 ='Kolejność';
protected $AX_PRMORL ='Podstawowa kolejność';
protected $AX_PRMORD ='serii, w której pozycje będą wyświetlane';
protected $AX_OPRM01 ='Domyślnie';
protected $AX_OPRM02 ='Sortuj według pierwszej strony';
protected $AX_OPRM03 = 'najstarszego Pierwsze ';
protected $AX_OPRM04 = 'Najnowsze Pierwsze ';
protected $AX_OPRM07 = 'alfabetycznie, według autora';
protected $AX_OPRM08 = 'odwrotnie alfabetycznie pod autora';
protected $AX_OPRM09 = 'Dodatkowe Widok';
protected $AX_OPRM10 = 'Mniej Widok';
protected $AX_PAGL = 'Układ';
protected $AX_PAGD ='Pokaż/Ukryj wsparcie stronicowania.';
protected $AX_PAGRL ='Wyniki paginacji';
protected $AX_PAGRD ='Pokaż/Ukryj info Wyniku paginacji (np. 1-4 z 4).';
protected $AX_MOSIL ='Zdjęcia MOS';
protected $AX_MOSID ='Wyświetl obraz (mosimages).';
protected $AX_ITMTL ='Pozycja w tytułach';
protected $AX_ITMTD ='Pokaż/Ukryj pozycję tytułu.';
protected $AX_REMRL ='Więcej';
protected $AX_REMRD ='Pokaż/Ukryj link Więcej.';
protected $AX_OTHCATL ='Inne kategorie';
protected $AX_OTHCATD ='Podczas wyświetlania kategorii, Pokaż/Ukryj listę pozostałych kategorii.';
protected $AX_TDISTPD ='Tekst będzie wyświetlany na górze strony.';
protected $AX_ORDBYL ='Bazy klasyfikacji';
protected $AX_ORDBYD ='Ta opcja omija klasyfikacji pozycji.';
protected $AX_MCS_DESCL ='Opis';
protected $AX_SHCDESD ='Pokaż/Ukryj Opis klasy';
protected $AX_DESCIL ='Opis obrazu';
protected $AX_MUDATFL ='Format daty';
protected $AX_MUDATFD ='w formie wyświetlanej daty. Używa kodyfikacji mandatu PHP strftime. Jeśli pozostanie puste, będzie korzystać z formatowania z pliku.';
protected $AX_MUDATCL ='Kolumna Data';
protected $AX_MUDATCD ='Pokaż/Ukryj kolumnę Data.';
protected $AX_MUAUTCL ='Kolumna Autor';
protected $AX_MUAUTCD ='Pokaż/Ukryj kolumnę Autor.';
protected $AX_MUHITCL ='Kolumna Punkty';
protected $AX_MUHITCD ='Pokaż/Ukryj kolumnę Punkty.';
protected $AX_MUNAVBL ='Pasek nawigacyjny';
protected $AX_MUNAVBD ='Pokaż/Ukryj pasek nawigacyjny.';
protected $AX_MUORDSL ='Wybierz Klasyfikację';
protected $AX_MUORDSD ='Pokaż/Ukryj na liście wyboru klasyfikacji.';
protected $AX_MUDSPSL ='Wyświetl wybór';
protected $AX_MUDSPSD ='Pokaż/Ukryj na liście opcji.';
protected $AX_MUDSPNL ='Wyświetl liczbę ppozycji';
protected $AX_MUDSPND ='Domyślna liczba pozycji, które mają być wyświetlane.';
protected $AX_MUFLTL ='Filtr';
protected $AX_MUFLTD ='Pokaż/Ukryj możliwość filtrowania.';
protected $AX_MUFLTFL ='Pole filtru';
protected $AX_MUFLTFD ='W jakim obszarze będzie zastosować filtr.';
protected $AX_MUOCATL ='Inne kategorie';
protected $AX_MUOCATD ='Pokaż/Ukryj wykaz innych kategorii.';
protected $AX_MUECATL ='Puste kategorie';
protected $AX_MUECATD ='Pokaż/Ukryj puste kategorie (te, które nie są pozycjami).';
protected $AX_CATDSCL ='Opis kategorii';
protected $AX_CATDSBLND ='Pokaż/Ukryj opis klasy. Opis pojawi się pod nazwą klasy.';
protected $AX_NAMCOLL ='Nazwa kolumny';
protected $AX_LINKDSCL ='Opis linku';
protected $AX_LINKDSCD ='Pokaż/Ukryj tekst opisu linku';
//com_contact/contact.xml
protected $AX_CCT_CDESC ='Ten komponent wyświetla listę dostępnych kontaktów';
protected $AX_CCT_CATLISTSL ='Lista kategorii - Sekcja';
protected $AX_CCT_CATLISTSD ='Pokaż/Ukryj listy kategorii w widoku listy-Strona.';
protected $AX_CCT_CATLISTCL ='Lista kategorii - Kategoria';
protected $AX_CCT_CATLISTCD ='Pokaż/Ukryj listy kategorii, aby wyświetlić tabelę';
protected $AX_CCT_CATDSCD ='Pokaż/Ukryj opis z listy kategorii.';
protected $AX_CCT_NOCATITL ='# Pozycje kategorii';
protected $AX_CCT_NOCATITD ='Pokaż/Ukryj liczba pozycji w każdej kategorii.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC ='Parametry dla poszczególnych elementów Kontakt.';
protected $AX_CIT_NAMEL ='Nazwa';
protected $AX_CIT_NAMED ='Pokaż/Ukryj nazwę info.';
protected $AX_CIT_POSITL ='Pozycja';
protected $AX_CIT_POSITD ='Pokaż/Ukryj informacje o położeniu';
protected $AX_CIT_EMAILL ='Email';
protected $AX_CIT_EMAILD ='Pokaż/Ukryj informację o e-mail. Jeśli informacje wyświetlanę są, to są one zabezpieczone przed spambots poprzez Javascript-Cloaking.';
protected $AX_CIT_SADDREL ='Ulica';
protected $AX_CIT_SADDRED ='Pokaż/Ukryj na informację o adresie.';
protected $AX_CIT_TOWNL ='Miasto/Przedmieście';
protected $AX_CIT_TOWND ='Pokaż/Ukryj informację o mieście/przedmieściu.';
protected $AX_CIT_STATEL ='Państwo';
protected $AX_CIT_STATED ='Pokaż/Ukryj informację o państwie.';
protected $AX_CIT_COUNTRL ='Kraj';
protected $AX_CIT_COUNTRD ='Pokaż/Ukryj informację o kraju.';
protected $AX_CIT_ZIPL ='Kod pocztowy';
protected $AX_CIT_ZIPD ='Pokaż/Ukryj informację o kodzie pocztowym.';
protected $AX_CIT_TELL ='Telefon';
protected $AX_CIT_TELD ='Pokaż/Ukryj informację o telefonie.';
protected $AX_CIT_FAXL ='Fax';
protected $AX_CIT_FAXD ='Pokaż/Ukryj informację o faksie.';
protected $AX_CIT_MISCL ='Informacja dodatkowa';
protected $AX_CIT_MISCD ='Pokaż/Ukryj informację dodatkową.';
protected $AX_CIT_VCARDL ='vcard';
protected $AX_CIT_VCARDD ='Pokaż/Ukryj vcard.';
protected $AX_CIT_CIMGL ='obraz';
protected $AX_CIT_CIMGD ='Pokaż/Ukryj obraz';
protected $AX_CIT_DEMAILL ='Opis Email';
protected $AX_CIT_DEMAILD ='Pokaż/Ukryj następujący tekst.';
protected $AX_CIT_DTXTL ='Tekst Opis';
protected $AX_CIT_DTXTD ='Tekst opisu. Jeśli pozostanie puste, będzie korzystać z definicji z pliku _języka EMAIL_DESCRIPTION. ';
protected $AX_CIT_EMFRML ='Email Od';
protected $AX_CIT_EMFRMD ='Pokaż/Ukryj z wiadomości e-mai.';
protected $AX_CIT_EMCPYL ='Kopia Email';
protected $AX_CIT_EMCPYD ='Pokaż/Ukryj pole do wysyłania kopii wiadomości, adres nadawcy.';
protected $AX_CIT_DDL ='Lista wyboru';
protected $AX_CIT_DDD ='Pokaż/Ukryj wybór z listy kontaktów';
protected $AX_CIT_ICONTXL ='Ikona/tekst';
protected $AX_CIT_ICONTXD ='Wybierz, czy wyświetlać ikony, tekst, albo nic, obok kontaktu prezentowanych informacji.';
protected $AX_CIT_ICONS ='Ikony';
protected $AX_CIT_TEXT ='Tekst';
protected $AX_CIT_NONE ='Nic';
protected $AX_CIT_ADICONL ='Ikona Adres';
protected $AX_CIT_ADICOND ='Ikona dla adres informacji.';
protected $AX_CIT_EMICONL ='Ikona Email';
protected $AX_CIT_EMICOND ='Ikona dla informacji e-mail.';
protected $AX_CIT_TLICONL ='Ikona Telefon';
protected $AX_CIT_TLICOND ='Ikona dla informacji telefonu.';
protected $AX_CIT_FXICONL ='Ikona Faks';
protected $AX_CIT_FXICOND ='Ikona dla informacji Faks.';
protected $AX_CIT_MCICONL ='Ikona dodatkowa';
protected $AX_CIT_MCICOND ='Ikona dla informacji dodatkowej.';
protected $AX_CCT_NAMEL ='Nazwa';
protected $AX_CCT_NAMED ='Pokaż/Ukryj informację o nazwisku.';
protected $AX_CCT_POSITL ='Pozycja';
protected $AX_CCT_POSITD ='Pokaż/Ukryj informację o położeniu.';
protected $AX_CCT_EMAILL ='Email';
protected $AX_CCT_EMAILD ='Pokaż/Ukryj informację o e-mail. Jeśli informacje wyświetlanę są, to są one zabezpieczone przed spambots poprzez Javascript-Cloaking.';
protected $AX_CCT_SADDREL ='Ulica';
protected $AX_CCT_SADDRED ='Pokaż/Ukryj informację zawarte w e-mail.';
protected $AX_CCT_TOWNL ='Miasto/Region';
protected $AX_CCT_TOWND ='Pokaż/Ukryj informację o Mieście/Regionie.';
protected $AX_CCT_STATEL ='Państwo';
protected $AX_CCT_STATED ='Pokaż/Ukryj informację o państwie.';
protected $AX_CCT_COUNTRL ='Kraj';
protected $AX_CCT_COUNTRD ='Pokaż/Ukryj informację o kraju.';
protected $AX_CCT_ZIPL ='Kod pocztowy';
protected $AX_CCT_ZIPD ='Pokaż/Ukryj informację o kodzie pocztowy.';
protected $AX_CCT_TELL ='Telefon';
protected $AX_CCT_TELD ='Pokaż/Ukryj informację o telefonie.';
protected $AX_CCT_FAXL ='Fax';
protected $AX_CCT_FAXD ='Pokaż/Ukryj informację o fakse.';
protected $AX_CCT_MISCL ='Informacja dodatkowa';
protected $AX_CCT_MISCD ='Pokaż/Ukryj informację dodatkową.';
protected $AX_CCT_VCARDL ='vcard';
protected $AX_CCT_VCARDD ='Pokaż/Ukryj vcard.';
protected $AX_CCT_CIMGL ='obraz';
protected $AX_CCT_CIMGD ='Pokaż/Ukryj obraz';
protected $AX_CCT_DEMAILL ='Opis Email';
protected $AX_CCT_DEMAILD ='Pokaż/Ukryj następujący tekst.';
protected $AX_CCT_DTXTL ='Tekst Opis';
protected $AX_CCT_DTXTD ='Tekst opisu. Jeśli pozostanie puste, będzie skorzystać z definicji z pliku języka EMAIL_DESCRIPTION.';
protected $AX_CCT_EMFRML ='Email Od';
protected $AX_CCT_EMFRMD ='Pokaż/Ukryj wiadomość e-mail.';
protected $AX_CCT_EMCPYL ='Kopia Email';
protected $AX_CCT_EMCPYD ='Pokaż/Ukryj pole do wysyłania kopii wiadomości, adres nadawcy.';
protected $AX_CCT_DDL ='Lista wyboru.';
protected $AX_CCT_DDD ='Pokaż/Ukryj wybór listy kontaktów';
protected $AX_CCT_ICONTXL ='Ikony/tekst';
protected $AX_CCT_ICONTXD ='Wybierz, czy wyświetlać ikony, tekst, albo nic, obok kontaktu prezentowanych informacji.';
protected $AX_CCT_ICONS ='Ikony';
protected $AX_CCT_TEXT ='Tekst';
protected $AX_CCT_NONE ='Nic';
protected $AX_CCT_ADICONL ='Ikona Adres';
protected $AX_CCT_ADICOND ='Ikona informacji dla adresu.';
protected $AX_CCT_EMICONL ='Ikona Email';
protected $AX_CCT_EMICOND ='Ikona informacji dla e-mail.';
protected $AX_CCT_TLICONL ='Ikona Telefon';
protected $AX_CCT_TLICOND ='Ikona informacji dla telefonu.';
protected $AX_CCT_FXICONL ='Ikona Faks';
protected $AX_CCT_FXICOND ='Ikona dla informacji Faks.';
protected $AX_CCT_MCICONL ='Ikona dodatkowa';
protected $AX_CCT_MCICOND ='Ikona dla informacji dodatkowej.';
//com_content/content.xml
protected $AX_CNT_CDESC ='Wyświetla zawartość strony.';
protected $AX_CNT_INTEXTL ='Tekst wstępny';
protected $AX_CNT_INTEXTD ='Pokaż/Ukryj tekst wstępny.';
protected $AX_CNT_KEYRL ='Referencje';
protected $AX_CNT_KEYRD ='Hasło (tekst), które mogą odnosić się do pozycji (służy do tworzenia pomocy dla serwera Elxis).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC ='Ten składnik, wyświetla wszystkie publikowane treści pozycji, które zostały wybrane do wyświetlania na stronie głównej.';
//com_login/login.xml
protected $AX_LG_CDESC ='Parametry dla poszczególnych elementów Kontakt.';
protected $AX_LG_LPTL ='Tytuł strony logowania';
protected $AX_LG_LPTD ='Tekst wyświetlany na górze strony. Jeśli puste, będzie używana nazwa Menu.';
protected $AX_LG_LRURLL ='Login URL Przekierowania';
protected $AX_LG_LRURLD ='Co będzie stroną logowania do przekierowaniu po zalogowaniu. Jeśli pozostanie puste, zostanie załadowana strona początkowa.';
protected $AX_LG_LJSML ='Login JS Wiadomość';
protected $AX_LG_LJSMD ='Pokaż/Ukryj JavaScript pop-up, potwierdzające pomyślne link.';
protected $AX_LG_LDESCL ='Opis Login';
protected $AX_LG_LDESCD ='Pokaż/Ukryj Opis logowania poniżej.';
protected $AX_LG_LDESTL ='Login Opis Tekst';
protected $AX_LG_LDESTD ='Tekst wyświetlany na stronie logowania. Jeśli pozostanie puste, będzie wykorzystywać _LOGIN_DESCRIPTION z pliku ';
protected $AX_LG_LIMGL ='Obraz Logowania';
protected $AX_LG_LIMGD ='Obraz do strony logowania.';
protected $AX_LG_LIMGAL ='Dopasowanie obrazu logowania';
protected $AX_LG_LIMGAD ='ustawienie obrazu logowania.';
protected $AX_LG_LOPTL ='Tytuł strony Wyloguj';
protected $AX_LG_LOPTD ='Tekst wyświetlany na górze strony. Jeśli puste, stosowana będzie używać nazwy Menu.';
protected $AX_LG_LORURLL ='URL Przekierowuje po Wyloguj';
protected $AX_LG_LORURLD ='Wybierz stronę, która będzie wyświetlana po wylogowaniu.Jeśli zostawisz puste wyświetli stronę początkową.';
protected $AX_LG_LOJSML ='Wyloguj JS Wiadomość';
protected $AX_LG_LOJSMD ='Pokaż/Ukryj JavaScript pop-up, potwierdzające pomyślne link.';
protected $AX_LG_LODSCL ='Opis Wyloguj';
protected $AX_LG_LODSCD ='Pokaż/Ukryj Wyloguj Opis poniżej.';
protected $AX_LG_LODSTL ='Tekst Opis Wyloguj';
protected $AX_LG_LODSTD ='Tekst do wyświetlenia na stronie wylogowania. Jeśli puste, _zostanie wykorzystany LOGOUT_DESCRIPTION z pliku.';
protected $AX_LG_LOGOIL ='Obraz Wyloguj';
protected $AX_LG_LOGOID ='Obrazek dla strony Wyloguj.';
protected $AX_LG_LOGOIAL ='Dostosowanie obrazu Wyloguj';
protected $AX_LG_LOGOIAD ='Ustawienie Obrazu za Wylogowywanie.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC ='Ten składnik umożliwia wysyłanie masowych wiadomości e-mail do określonych grup użytkowników.';
//com_media/media.xml
protected $AX_ME_CDESC ='Ten element zarządza multimediami witryny.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC ='Ten element zarządza twoim menu.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME ='Link - Cel Komponent';
protected $AX_MUCIL_CDESC ='Tworzy link do istniejącego komponentu Elxis.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME ='komponent';
protected $AX_MUCOMP_CDESC ='Wyświetla interfejs Komponent strony początkowej.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME ='Tabela - Kategoria Kontakt';
protected $AX_MUCCT_CDESC ='Wyświetla w formie tabelarycznej, pozycje Kontakt określonej kategorii kontaktów.';
protected $AX_MUCCT_CATDL ='Opis kategorii';
protected $AX_MUCCT_CATDD ='Pokaż/Ukryj opis na liście innych kategorii.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME ='Link - Pozycja Kontakt';
protected $AX_MUCTIL_CDESC ='Tworzy link do opublikowanych Pozycii Kontakt';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME ='Blog - Kontent Archiwum Kategorii';
protected $AX_MUCAC_CDESC ='Wyświetla listę elementów treścii zarchiwizowanych dla określonej kategorii.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME ='Blog - Treść sekcji Archiwum';
protected $AX_MUCAS_CDESC ='Pokazuje listę Treścii zarchiwizowanych elementów dla danej sekcji.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME ='Blog - Zawartość kategorii';
protected $AX_MUCBC_CDESC ='Wyświetla faktyczną zawartość danej kategorii w formie blogu.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME ='Blog - Treść sekcji';
protected $AX_MUCBS_CDESC ='Wyświetla stronę treści pozycji z wielu części w formie blogu.';
protected $AX_MUCBS_SHSD ='Pokaż/Ukryj Opis sekcji.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME ='Tabela - Zawartość Kategorii';
protected $AX_MUCC_CDESC ='Wyświetla w formie tabeli, zawartość pozycji w danej kategorii.';
protected $AX_MUCC_SHLOCD ='Pokaż/Ukryj listę innych kategorii.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME ='Link - Treść Temat';
protected $AX_MCIL_CDESC ='Tworzy link do opublikowanych treści Temat. Cały temat jest przedstawiony.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME ='Tabela - zawartość sekcji';
protected $AX_MCS_CDESC ='Tworzy listę kategorii treści dla danego modułu.';
protected $AX_MCS_STL ='Tytuł Sekcji';
protected $AX_MCS_STD ='Pokaż/Ukryj tytuł sekcji.';
protected $AX_MCS_SHCTID ='Pokaż/Ukryj Opis obraz kategorii';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME ='Link - Autonomiczna strona';
protected $AX_MLSC_CDESC ='Tworzy link do Autonomicznej strony.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME ='Tabela - Kategoria Newsfeeds';
protected $AX_MNSFC_CDESC ='Wyświetla tabelę w formacie Newsfeed prasowych w danej kategorii.';
protected $AX_MNSFC_SHNCD ='Pokaż/Ukryj nazwę kolumny.';
protected $AX_MNSFC_ACL ='Kolumna Artykuły';
protected $AX_MNSFC_ACD ='Pokaż/Ukryj kolumnę Artykuły.';
protected $AX_MNSFC_LCL ='Kolumna Link';
protected $AX_MNSFC_LCD ='Pokaż/Ukryj kolumnę Link.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME ='Link - Newsfeed';
protected $AX_MNSFL_CDESC ='Tworzy link do Newsfeed.';
protected $AX_MNSFL_FDIML ='Feed obrazu';
protected $AX_MNSFL_FDIMD ='Pokaż/Ukryj obraz w komunikacie prasowym.';
protected $AX_MNSFL_FDDSL ='Opisy prasowe';
protected $AX_MNSFL_FDDSD ='Pokaż/Ukryj tekst opisu prasowego.';
protected $AX_MNSFL_WDCL ='Liczba słów';
protected $AX_MNSFL_WDCD ='Pozwala ograniczyć długość widoczne opis. Wartość 0 oznacza: Zobacz pełny tekst.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME ='Separator/Miejsce';
protected $AX_MSEP_CDESC ='Tworzy menu lub symbol separatora.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC ='Tworzy link do adresu URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME ='Tabela - Kategoria Linki';
protected $AX_MWLC_CDESC ='Tabela pokazuje widok pozycji Linki dla danej kategorii Linków.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME ='Wrapper';
protected $AX_MWRP_CDESC ='Tworzy IFRAME który będzie zawierał zewnętrzną stronę w witrynie Elxis.';
protected $AX_MWRP_SCRBL ='Paski';
protected $AX_MWRP_SCRBD ='Pokaż/Ukryj poziome i pionowe paski przewijania.';
protected $AX_MWRP_WDTL ='Szerokość';
protected $AX_MWRP_WDTD ='Szerokość ramki okna. Można wprowadzić bezwzględną wartość w pikselach lub względną wartość dodając %.';
protected $AX_MWRP_HEIL ='Wysokość';
protected $AX_MWRP_HEID ='Wysokość ramki okna.';
protected $AX_MWRP_AHL ='Wysokość automatyczna';
protected $AX_MWRP_AHD ='Wysokość zostanie dopasowana automatycznie do wielkości zewnętrznej strony. To działa tylko dla stron z własną domeną.';
protected $AX_MWRP_AADL ='Automatycznie dodaj http';
protected $AX_MWRP_AADD ='Domyślnie automatycznie doda http://na początku adresu URL, jeśli nie jest już dodane przez użytkownika. Możesz wyłączyć tą funkcję.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME ='Link System';
protected $AX_MSYS_CDESC ='Tworzy link do funkcji systemu';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC ='Ten element zarządza newsfeeds RSS/RDF.';
protected $AX_NFE_DPD ='Opis strony';
protected $AX_NFE_SHFNCD ='Pokaż/Ukryj kolumnę Nazwa kanału prasowego.';
protected $AX_NFE_NOACL ='# Kolumna regulamin';
protected $AX_NFE_NOACD ='Pokaż/Ukryj liczba artykułów w komunikacie prasowym.';
protected $AX_NFE_LCL ='Kolumna Link';
protected $AX_NFE_LCD ='Pokaż/Ukryj kolumna link komunikatu prasowego.';
protected $AX_NFE_IDL ='Opis';
protected $AX_NFE_IDD ='Pokaż/Ukryj opis lub element tekstowy.';
//com_search/search.xml
protected $AX_SEAR_CDESC ='Ten element zarządza funkcjonalnością wyszukiwania.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC ='Ten element kontroli ustawienia syndykat.';
protected $AX_SYN_CACHL ='Cache';
protected $AX_SYN_CACHD ='Feed cache plików.';
protected $AX_SYN_CACHTL ='Cache Czas';
protected $AX_SYN_CACHTD ='Pliki Cache odświeżyć co x sekund.';
protected $AX_SYN_ITMSL ='Liczba pozycji';
protected $AX_SYN_ITMSD ='Liczba elementów do syndykatu.';
protected $AX_SYN_ITMSDFLT ='Prasa Elxis';
protected $AX_SYN_TITLE ='Tytuł Syndication';
protected $AX_SYN_DESCD ='Opis Syndication.';
protected $AX_SYN_DESCDFLT ='Elxis witryny syndykacji';
protected $AX_SYN_IMGD ='Obrazy, który mają być włączone w wiadomościach prasowych.';
protected $AX_SYN_IMGAL ='Alternatywne zdjęcia tekst';
protected $AX_SYN_IMGAD ='Alternatywne obraz tekst.';
protected $AX_SYN_IMGADFLT ='Powered by Elxis';
protected $AX_SYN_LMTL ='Limit Tekst';
protected $AX_SYN_LMTD ='Ogranicz teks artykułu do wartości wskazanej poniżej.';
protected $AX_SYN_TLENL ='Długość tekstu';
protected $AX_SYN_TLEND ='Liczba słów w artykule. Wartość 0 oznacza brak tekstu.';
protected $AX_SYN_LBL ='Aktywne Zakładki';
protected $AX_SYN_LBD ='Włącz funkcję Live Zakładki wsparcie dla Firefoksa.';
protected $AX_SYN_BFL ='Plik Zakładki';
protected $AX_SYN_BFD ='Specjalne nazwy plików. Jeśli puste, zostanie użyta nazwa domyślna.';
protected $AX_SYN_ORDL ='Pozycja';
protected $AX_SYN_ORDD ='Kolejność, w jakiej pojawiają się pozycje.';
protected $AX_SYN_MULTIL ='Kanał wielojęzykowy';
protected $AX_SYN_MULTILD ='Jeśli tak,  Elxis będzie tworzyć oddzielne kanały dla każdego języka.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC ='Ten element zarządza funkcjonalnością Kosza.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC ='Strona wyświetla pojedynczą pozycję.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC ='Składnik ten wyświetla listę linków z ekranu na stronie.';
protected $AX_WBL_LDL ='Opisy Linku';
protected $AX_WBL_LDD ='Pokaż/Ukryj Opis tekstowy linków';
protected $AX_WBL_ICL ='Ikona';
protected $AX_WBL_ICD ='Ikona po lewej stronie linku URL w widoku tabeli.';
protected $AX_WBL_SCSL ='Screenshots';
protected $AX_WBL_SCSD ='Pokazuje zrzuty ekranu powiązanych witryn. Jeśli aktywny, funkcja ikony nie były wcześniej używane.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD ='Docelowe okno po kliknięciu linku';
protected $AX_WBLI_OT01 ='Okno rodzica przeglądarki Nawigacja';
protected $AX_WBLI_OT02 ='Nowe okno przeglądarki Nawigacja';
protected $AX_WBLI_OT03 ='Nowe okno bez przeglądarki Nawigacja';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC ='Ten moduł wyświetla listę ostatnio opublikowanych artykułów, które są jeszcze opublikowane (niektóre z nich mogą mieć minął, nawet jeżeli została ona opublikowana). Pozycje, które pojawiają się w pierwszej stronie Komponent nie są zawarte w liście. ';
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC ='Ten moduł wyświetla listę ostatnio podłączonych użytkowników.';
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC ='Ten moduł wyświetla listę najpopularniejszych (najczęściej oglądanych) artykułów.';
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC ='Ten moduł wyświetla statystyki dotyczące pozycji, które są jeszcze opublikowane (niektóre mogą mieć minął nawet jeżeli została ona opublikowana). Pozycje, które pojawiają się w pierwszej stronie Komponent nie są zawarte w liście. ';
//SITE MODULES
//General
protected $AX_SM_MCSL ='Moduły klasy przyrostek';
protected $AX_SM_MCSD ='Możesz dodać przyrostek do domyślnej klasy CSS modułu (table.moduletable), Dzięki temu możesz zmienić wygląd.';
protected $AX_SM_MUCSL ='Menu Przyrostek klasy';
protected $AX_SM_MUCSD ='Możesz dodać przyrostek do domyślnego CSS klasy pozycje Menu i modyfikować ich wygląd.';
protected $AX_SM_ECL ='Włącz Cache';
protected $AX_SM_ECD ='Wybierz, czy buforować treści tego modułu.';
protected $AX_SM_SMIL ='Pokaż menu Ikony';
protected $AX_SM_SMID ='Wyświetla menu ikony dla wybranych pozycji menu.';
protected $AX_SM_MIAL ='Wyrównaj ikony menu';
protected $AX_SM_MIAD ='Wybierz wyrównania ikon menu';
protected $AX_SM_MODL ='Status modułu';
protected $AX_SM_MODD ='Pozwala kontrolować rodzaj treści, które pojawią się w tym module.';
protected $AX_SM_OP01 ='Treść pozycji';
protected $AX_SM_OP02 ='Tylko Autonomiczne Strony';
protected $AX_SM_OP03 ='Obie';
//modules/custom.xml
protected $AX_SM_CU_DESC = 'niestandardowy moduł.';
protected $AX_SM_CU_RSURL ='URL RSS';
protected $AX_SM_CU_RSURD ='Podaj adres URL kanału RSS/RDF.';
protected $AX_SM_CU_FEDL ='Opisy prasowe';
protected $AX_SM_CU_FEDD ='Pokaż opis tekstowy dla całego prasowego';
protected $AX_SM_CU_FEIL ='Obraz Feed';
protected $AX_SM_CU_FEDID ='Pokaż zdjęcia związane z prasą';
protected $AX_SM_CU_ITL ='Pozycje';
protected $AX_SM_CU_ITD ='Wprowadź numer RSS pozycji do wyświetlenia.';
protected $AX_SM_CU_ITDL ='Opisy pozycji';
protected $AX_SM_CU_ITDD ='Pokaż opis lub tekst poszczególnych wiadomości.';
protected $AX_SM_CU_WCL ='Liczba słów';
protected $AX_SM_CU_WCD ='Pozwala na ograniczenie ilości widocznego opisu tekstu. 0 pokaże cały tekst.';
//modules/mod_archive.xml
protected $AX_SM_AR_DESC ='Ten moduł pokazuje listę z miesięcy kalendarzowych, które zawierają elementy zarchiwizowane. Po zmianie stanu Treść elementu do \'Zarchiwizowane\' tej listy będą generowane automatycznie.';
protected $AX_SM_AR_CNTL ='Liczba';
protected $AX_SM_AR_CNTD ='Liczba pozycji, które mają być wyświetlane (domyślnie jest 10).';
//modules/mod_banners.xml
protected $AX_SM_BN_DESC ='Transparent modułu umożliwia wyświetlanie w aktywnym miejscu banera reklamowego.';
protected $AX_SM_BN_CNTL ='Banner klienta';
protected $AX_SM_BN_CNTD ='Odniesienie do id klienta reklamy. Można wpisać więcej niż jedną, oddzielonych \', \' !';
protected $AX_SM_BN_NBSL ='Liczba wyświetlanych banerów';
protected $AX_SM_BN_NBPRL ='Liczba banerów w każdym wierszu';
protected $AX_SM_BN_NBPRD ='Liczba banerów na rząd, aby wyłączyć zostaw 0. Aby wyświetlać banery w pionie, należy ustawić na 1';
protected $AX_SM_BN_UNQBL ='Unikalne bannery';
protected $AX_SM_BN_UNQBD ='Nie baner nie pojawi się więcej niż jeden raz (na sesję). Jeśli otrzymasz wszystkie banery, następnie historii jest czyszczona i ponownie uruchomiony.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC ='Ten moduł wyświetla listę najbardziej aktywnych i niedawno opublikowanych artykułów (niektóre mogą mieć minął, choć należące do najnowszych). Zawiera artykuły opublikowane przez komponent na pierwszej stronie.';
protected $AX_SM_LN_FPIL ='Pozycje strony startowej';
protected $AX_SM_LN_FPID ='Pokaż/Ukryj Pozycje, które zostały przypisane do pierwszej strony - prowadzi do stanu, tylko rzeczywistej treści.';
protected $AX_SM_AR_CNT5D ='Liczba pozycji do wyświetlenia (domyślnie 5).';
protected $AX_SM_LN_CATIL ='Kategoria ID';
protected $AX_SM_LN_CATID ='Wybór pozycji z danej kategorii lub grupa kategorii (aby określić więcej niż jedną kategorię, oddziel przecinkami).';
protected $AX_SM_LN_SECIL ='Sekcja ID';
protected $AX_SM_LN_SECID ='Wybór konkretnej pozycji z sekcji lub grupy modułów (określić więcej niż jeden punkt, oddziel przecinkami).';
//modules/mod_login.xml
protected $AX_SM_LF_DESC ='Ten moduł wyświetla nazwę użytkownika i hasło logowania formularza rejestracyjnego. To także wyświetla link do pobrania zapomnianego hasła. Jeżeli rejestracja użytkownika jest aktywna, (odnoszą się do ustawień konfiguracyjnych), a następnie inny link będzie widoczny, aby zaprosić użytkowników do samodzielnej rejestracji.';
protected $AX_SM_LF_PTL ='Tekst przed';
protected $AX_SM_LF_PTD ='To jest tekst lub kod HTML, który jest wyświetlany powyżej formularza rejestracyjnego.';
protected $AX_SM_LF_PSTL ='Test po';
protected $AX_SM_LF_PSTD ='To jest tekst lub kod HTML, który jest wyświetlany poniżej formularza rejestracyjnego.';
protected $AX_SM_LF_LRUL ='Login URL Przekierowania ';
protected $AX_SM_LF_LRUD ='Wybierz stronę, która będzie przewodnikiem użytkownika po połączeniu. Jeśli pozostanie puste, będzie prowadzić do strony głównej.';
protected $AX_SM_LF_LORUL ='Wyloguj url Przekierowywania';
protected $AX_SM_LF_LORUD ='Możesz wybrać to, co strony użytkownika wymagane będzie po rozłączenie. Jeśli pozostanie puste, będzie prowadzić do strony głównej.';
protected $AX_SM_LF_LML ='Login Wiadomość';
protected $AX_SM_LF_LMD ='Pokaż/Ukryj JavaScript wyskakujący komunikat o udanej rejestracji.';
protected $AX_SM_LF_LOML ='Wyloguj Wiadomość';
protected $AX_SM_LF_LOMD ='Pokaż/Ukryj JavaScript wyskakujący komunikat o udanym wylogowaniu.';
protected $AX_SM_LF_GML ='Pozdrowienie';
protected $AX_SM_LF_GMD ='Pokaż/Ukryj prosty tekst pozdrowienia.';
protected $AX_SM_LF_NUNL ='Imię i nazwisko/Nazwa użytkownika';
protected $AX_SM_LF_OP01 ='Nazwa użytkownika';
protected $AX_SM_LF_OP02 ='Nazwa';
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC ='Wyświetla menu.';
protected $AX_SM_MNM_MNL ='Menu Nazwa';
protected $AX_SM_MNM_MND ='Nazwa menu (domyślnie \'GŁÓWNE \').';
protected $AX_SM_MNM_MSL ='Menu Styl';
protected $AX_SM_MNM_MSD ='Menu stylu';
protected $AX_SM_MNM_OP1 ='pionowy';
protected $AX_SM_MNM_OP2 ='pozioma';
protected $AX_SM_MNM_OP3 ='Płaska lista';
protected $AX_SM_MNM_EML ='Rozwiń menu';
protected $AX_SM_MNM_EMD ='Rozwiń menu i podgrupy menu pozycje zawsze widoczna.';
protected $AX_SM_MNM_IIL ='Obraz Tiret';
protected $AX_SM_MNM_IID ='Wybierz obraz, który jest używany tiret.';
protected $AX_SM_MNM_OP4 ='Szablon';
protected $AX_SM_MNM_OP5 ='Elxis domyślny obraz';
protected $AX_SM_MNM_OP6 ='Użyj parametrów poniżej';
protected $AX_SM_MNM_OP7 ='Brak';
protected $AX_SM_MNM_II1L ='Image Tiret 1';
protected $AX_SM_MNM_II1D ='Obrazek na pierwszy poziom.';
protected $AX_SM_MNM_II2L ='Obraz Tiret 2';
protected $AX_SM_MNM_II2D ='Obraz na drugi poziom.';
protected $AX_SM_MNM_II3L ='Obraz Tiret 3';
protected $AX_SM_MNM_II3D ='Obraz na trzeci poziom.';
protected $AX_SM_MNM_II4L ='Obraz Tiret 4';
protected $AX_SM_MNM_II4D ='Obraz na czwarty poziom.';
protected $AX_SM_MNM_II5L ='Obraz Tiret 5';
protected $AX_SM_MNM_II5D ='Obraz na piąty poziomi.';
protected $AX_SM_MNM_II6L ='Obraz Tiret 6';
protected $AX_SM_MNM_II6D ='Obraz na szósty poziom.';
protected $AX_SM_MNM_SPL ='Separator';
protected $AX_SM_MNM_SPD ='Separator na poziomie menu.';
protected $AX_SM_MNM_ESL ='Koniec separatora';
protected $AX_SM_MNM_ESD ='Koniec separatora na poziome menu.';
protected $AX_SM_MNM_IDPR ='SEO PRO wstępne Itemid';
protected $AX_SM_MNM_IDPRD ='Włączenie Preload poprzez AJAX Itemid rozwiązuje problem z poprawną definicję pozycji menu po kilka elementów menu, które prowadzą do tej samej strony.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC ='Ten moduł pokazuje listę aktualnie opublikowanych artykułów, które były wyświetlane najczęściej - określane przez liczbę wyświetlania strony.';
protected $AX_SM_MRC_MNL ='Menu Nazwa';
protected $AX_SM_MRC_MND ='Nazwa menu (domyślnie GŁÓWNE).';
protected $AX_SM_MRC_FPIL ='Pozycje strony startowej';
protected $AX_SM_MRC_FPID ='Pokaż/Ukryj pozycje wyznaczone dla strony startowej - działa tylko, gdy w treści pozycji tylko w trybie';
protected $AX_SM_MRC_CL ='Count';
protected $AX_SM_MRC_CD ='Liczba pozycji do wyświetlenia (domyślnie 5).';
protected $AX_SM_MRC_CIDL ='Kategoria ID';
protected $AX_SM_MRC_CIDD ='Wybierz pozycje z danej kategorii lub grup kategorii (aby określić więcej niż jedną kategorię, należy użyć partycji jako \', \').';
protected $AX_SM_MRC_SIDL ='Sekcja ID';
protected $AX_SM_MRC_SIDD ='Wybór konkretnej pozycji z sekcji lub grupy modułów (aby określić więcej niż jeden modułów należy użyć partycji jako \', \').';
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC ='Moduł Krótki News, wyświetla losowo z jednego artykułów opublikowanych z jednej kategorii, w trakcie odnawiania strony. Może on również być obecny w wielu pozycji poziomej lub pionowej konfiguracji. ';
protected $AX_SM_NWF_CATL ='Kategoria';
protected $AX_SM_NWF_CATD ='Kategoria A';
protected $AX_SM_NWF_STL ='Forma';
protected $AX_SM_NWF_STD ='Forma w jakiej będą wyświetlane kategorie.';
protected $AX_SM_NWF_OP1 ='Losowo';
protected $AX_SM_NWF_OP2 ='Pozioma';
protected $AX_SM_NWF_OP3 ='Pionowy';
protected $AX_SM_NWF_SIL ='Pokaż obraz';
protected $AX_SM_NWF_SID ='Wyświetl zawartość pozycji obrazów.';
protected $AX_SM_NWF_LTL ='Podobne tytuły';
protected $AX_SM_NWF_LTD ='To tytuły artykułów zachowywać linki.';
protected $AX_SM_NWF_RML ='Więcej';
protected $AX_SM_NWF_RMD ='Pokaż/Ukryj przycisk Czytaj więcej.';
protected $AX_SM_NWF_ITL ='Obiekt Tytuł';
protected $AX_SM_NWF_ITD = 'Wyświetla tytuł elementu. ';
protected $AX_SM_NWF_NOIL = 'Liczba pozycji';
protected $AX_SM_NWF_NOID = 'Liczba pozycji, które mają być wyświetlane.';
//modules/mod_poll.xml
protected $AX_SM_POL_DESC ='Ten moduł, komponent zakończenia badania. Służy do badania opinii publicznej pokazują, że można ustawić. Ten moduł różni się od innych modułów i obsługuje wzajemnych między Pozycje menu i sondaży. Oznacza to, że moduł pokazuje jedynie Ankiety, które są do określonego Tematu menu. ';
protected $AX_SM_POL_CATL ='Kategoria';
protected $AX_SM_POL_CATD ='Klasa Kontent.';
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC ='Moduł ten wyświetla obraz z losowo wybranej listy.';
protected $AX_SM_RNI_ITL ='Formatuj obraz';
protected $AX_SM_RNI_ITD ='Format obrazu PNG/GIF/JPG itp. (Domyślnie jest JPG).';
protected $AX_SM_RNI_IFL ='Folder obrazu';
protected $AX_SM_RNI_IFD ='Ścieżka do folderu obrazu w stosunku do adresu URL witryny, np.: images/stories';
protected $AX_SM_RNI_LNL ='Link';
protected $AX_SM_RNI_LND ='Adres URL do przekierowania, jeśli obraz jest kliknięty, np.: http://www.goup.gr';
protected $AX_SM_RNI_WL ='Szerokość (px)';
protected $AX_SM_RNI_WD ='Szerokość obrazu (wszystkie zdjęcia mają być wyświetlane z tą szerokością).';
protected $AX_SM_RNI_HL ='Wysokość (px)';
protected $AX_SM_RNI_HD ='wysokość obrazu (wszystkie zdjęcia mają być wyświetlane z tą wysokości).';
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC ='Moduł ten wyświetla inne treści pozycji, które są związane z pozycją przedstawionej sprawy. Wybór jest oparty na słowach kluczowych metadanych. Wszystkie słowa kluczowe w bieżącej pozycji treści, dopasowane do słów kluczowych w innych opublikowanych artykułach. Na przykład, może mieć na pozycji \'Grecja\', a inny na \'Partenon\'. Jeśli to słowo kluczowe \'Grecja\' w obu artykułach, moduł związanych z pozycjami, pokaże Temat \'Grecja\', gdy widzisz \'Partenon\' i vice versa.';
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC ='Ten moduł zostanie wyświetlony link który ludzie mogą syndykat witrynie dla wszystkich najnowszych wiadomości. Po kliknięciu na ikonę RSS, zostanie przekierowany do nowej strony, która zostanie wyświetlona lista wszystkich aktualności w formacie XML. W celu korzystania z Newsfeed w innym miejscu lub Elxis Newsfeed czytelnika, należy wyciąć i wkleić adres URL.';
protected $AX_SM_RSS_TXL ='Tekst';
protected $AX_SM_RSS_TXD ='Wpisz tekst, który będzie wyświetlany wraz z linkami RSS.';
protected $AX_SM_RSS_091D ='Pokaż/Ukryj RSS 0.91 Link.';
protected $AX_SM_RSS_10D ='Pokaż/Ukryj RSS 1.0 Link.';
protected $AX_SM_RSS_20D ='Pokaż/Ukryj RSS 2.0 Link.';
protected $AX_SM_RSS_03D ='Pokaż/Ukryj Atom 0.3 Link.';
protected $AX_SM_RSS_OPD ='Pokaż/Ukryj OPML Link';
protected $AX_SM_RSS_I091L ='RSS 0.91 Obraz';
protected $AX_SM_RSS_I10L ='RSS 1.0 Obraz';
protected $AX_SM_RSS_I20L ='RSS 2.0 Obraz';
protected $AX_SM_RSS_I03L ='Atom Obraz';
protected $AX_SM_RSS_IOPL ='OPML Obraz';
protected $AX_SM_RSS_CHID ='Wybierz obraz, który będzie stosowany.';
//modules/mod_search.xml
protected $AX_SM_SEM_DESC ='Moduł ten będzie wyświetlać pole wyszukiwania.';
protected $AX_SM_SEM_TOP ='Do góry';
protected $AX_SM_SEM_BTM ='Dolny';
protected $AX_SM_SEM_BWL ='Pole szerokości';
protected $AX_SM_SEM_BWD ='Rozmiar pola wyszukiwania.';
protected $AX_SM_SEM_TXL ='Tekst';
protected $AX_SM_SEM_TXD ='Tekst, który pojawia się w polu wyszukiwania, jeśli pozostanie puste będzie _używana wartości _SEARCH_BOX z pliku języka.';
protected $AX_SM_SEM_BPL ='Button stanowiska';
protected $AX_SM_SEM_BPD ='Stanowisko przycisku w stosunku do pola wyszukiwania.';
protected $AX_SM_SEM_BTXL ='Button Tekst';
protected $AX_SM_SEM_BTXD ='Tekst, który pojawia się w przycisk wyszukiwania, jeśli pozostanie puste będzie _używana wartości _SEARCH_BOX z pliku języka.';
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC ='Sekcja modułu pokazuje listę wszystkich sekcji skonfigurowanych w bazie danych. Działy odnoszą się tylko do obszarów w sekcjach. Jeśli konfiguracji \'Pokaż Nieautoryzowane Linki \' nie jest ustawiona, lista zostanie ograniczona do sekcji użytkownika, który jest uprawniony do zobaczenia.';
protected $AX_SM_SEC_CL ='Licznik';
protected $AX_SM_SEC_CD ='Liczba pozycji, które zostaną przedstawione. (domyślnie 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC ='Moduł Statystyczny, pokazuje informacje o serwerze informacje o użytkownikach, liczba zawartość bazy danych, i liczba połączeń, które oferują. ';
protected $AX_SM_STA_SVIL ='Informacje na temat serwera';
protected $AX_SM_STA_SVID ='Wyświetla informacje na temat serwera.';
protected $AX_SM_STA_SIL ='Site Info';
protected $AX_SM_STA_SID ='Wyświetla informacje na stronie.';
protected $AX_SM_STA_HCL ='Wizyty';
protected $AX_SM_STA_HCD ='Wyświetl licznik wizyt.';
protected $AX_SM_STA_ICL ='Zwiększenie licznik';
protected $AX_SM_STA_ICD ='Wprowadź liczbę sukcesów, w którym chcesz zwiększyć licznik.';
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC ='Moduł wyboru szablonu pozwala użytkownikowi (klient), aby zmienić szablon strony internetowej na bieżącej stronie startowej, za pomocą rozwijanej listy wyboru.';
protected $AX_SM_TMC_MNLL ='Maksymalna długość Nazwy';
protected $AX_SM_TMC_MNLD ='Jest to maksymalna długość nazwy szablonu, aby wyświetlić (domyślnie 20).';
protected $AX_SM_TMC_SPL ='Pokaż podgląd';
protected $AX_SM_TMC_SPD ='Podgląd szablonu jest widoczny.';
protected $AX_SM_TMC_WL ='Szerokość';
protected $AX_SM_TMC_WD ='To jest szerokość podglądu obrazu (domyślnie 140 px).';
protected $AX_SM_TMC_HL ='Wysokość';
protected $AX_SM_TMC_HD ='To jest wysokość podglądu obrazu (domyślnie 90 px).';
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC ='Moduł ten wyświetla liczbę anonimowych użytkowników (gości) oraz użytkowników zarejestrowanych, którzy są obecnie dostępu da stronie internetowej.';
protected $AX_SM_WSO_DL ='Widok';
protected $AX_SM_WSO_DD ='Wybierz, co ma być widoczne.';
protected $AX_SM_WSO_OP1 ='# osób/Członkowie <br />';
protected $AX_SM_WSO_OP2 ='Nazwy członków <br />';
protected $AX_SM_WSO_OP3 ='Obie';
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC ='Moduł ten pokazuje IFRAME okno do określonego miejsca.';
protected $AX_SM_WRM_URLL ='URL';
protected $AX_SM_WRM_URLD ='adres URL witryny/plik, który chcesz wyświetlić w ramce';
protected $AX_SM_WRM_SCBL ='paski';
protected $AX_SM_WRM_SCBD ='Pokaż/Ukryj poziome i pionowe paski.';
protected $AX_SM_WRM_WL ='Szerokość';
protected $AX_SM_WRM_WD ='Szerokość ramki okien. Możesz wprowadzić bezwzględną wartość w pikselach lub względna wartość dodając %.';
protected $AX_SM_WRM_HL ='Wysokość';
protected $AX_SM_WRM_HD ='Wysokość ramki okna';
protected $AX_SM_WRM_AHL ='Automatyczna Wysokość';
protected $AX_SM_WRM_AHD ='Wysokość zostanie obliczona automatycznie do wielkości zewnętrznej strony. To działa tylko dla stron z własną domenę.';
protected $AX_SM_WRM_ADL ='Automatycznie dodaj';
protected $AX_SM_WRM_ADD ='Domyślnie http://zostanie dodane chyba że wykryje http://lub https: //w adresie linku URL.Przełącznik ten pozwala przełączać się lub wyłączyć tę możliwość.';
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL ='Tryb';
protected $AX_ED_FUNCTD ='Wybierz Tryb';
protected $AX_ED_FUNSIMPLE ='Proste';
protected $AX_ED_FUNADV ='Zaawansowane';
protected $AX_ED_EDITORWIDTHL ='Edytor Szerokość';
protected $AX_ED_EDITORWIDTHD ='Szerokość edytora Okno';
protected $AX_ED_EDITORHEIGHTL ='Edytor Wysokość';
protected $AX_ED_EDITORHEIGHTD ='Wysokość Edytora Okno';
protected $AX_ED_COMPRESSEDVL ='Skompresowany format';
protected $AX_ED_COMPRESSEDVD ='TinyMCE można uruchamiać w trybie skompresowanym, co prowadzi do nieco szybciej ładowania. Jednakże, ten tryb pracy nie zawsze działa, zwłaszcza w IE, więc domyślnie jest wyłączony. Po włączeniu tej opcji, sprawdź, czy działa prawidłowo w systemie.';
protected $AX_ED_OFF ='Nieaktywne';
protected $AX_ED_ON ='Aktywne';
protected $AX_ED_COMPRESSL ='Kompresja';
protected $AX_ED_COMPRESSD ='Kompresuje TinyMCE Editor przy użyciu gzip (ładuje 75% szybciej)';
protected $AX_ED_CONVERTURLL ='Konwertuj adresy URL';
protected $AX_ED_CONVERTURLD ='Konwersja do bezwzględnych adresów URL w tym zakresie.';
protected $AX_ED_ENTENCODL ='Kodowanie';
protected $AX_ED_ENTENCODD ='Ta opcja steruje procesor traktuje podmioty/znaków. Dostępne opcje to: Ilustracja numeryczna, Onomatizomenes jednostki i nie, w którym nie ma łączenia. Wartość domyślna tego parametru to nie przetwarzanie.';
protected $AX_ED_TXTDIRL ='Kierunek tekstu';
protected $AX_ED_TXTDIRD ='Możliwość zmiany kierunku tekstu';
protected $AX_ED_CNVFONTSPANL ='Konwersja czcionki obejmuje tag';
protected $AX_ED_CNVFONTSPAND ='Domyślnie opcja jest przekształcenie tagu font w tagu span. Dzieje się tak, ponieważ znak czcionka jest przestarzały';
protected $AX_ED_FONTSIZETYPEL ='Rozmiar czcionki Typ';
protected $AX_ED_FONTSIZETYPED ='Wybierz typ czcionki do wykorzystania, albo np. długość: 10pt lub bezwzględnych wielkości np.: x-small.';
protected $AX_ED_INLTABLEDITL ='Łączenie tabel';
protected $AX_ED_INLTABLEDITD ='Pozwala na przetwarzanie tabel.';
protected $AX_ED_PROHELEMENTSL ='Zabronione';
protected $AX_ED_PROHELEMENTSD ='Dane, które zostaną oczyszczone z tekstu';
protected $AX_ED_EXTELEMENTSL ='Rozszerzony Elementy';
protected $AX_ED_EXTELEMENTSD ='TinyMCE Rozszerz funkcjonalność przez dodanie dodatkowych elementów tutaj. Format: wiąz [tag1 | tag2]';
protected $AX_ED_EVELEMENTSL ='Elementy zdarzenia';
protected $AX_ED_EVELEMENTSD ='Opcja ta powinna zawierać listę oddzielonych przecinkami te elementy mogą mieć atrybuty takie jak zdarzenia onclick i podobne. Opcja ta jest potrzebna, ponieważ niektóre przeglądarki wykonują te zdarzenia podczas edycji treści.';
protected $AX_ED_TCSSCLASSESL ='Szablon CSS klasy';
protected $AX_ED_TCSSCLASSESD ='Załaduj klasy CSS z template_css.css';
protected $AX_ED_CCSSCLASSESL ='Własne klasy CSS';
protected $AX_ED_CCSSCLASSESD ='Można określić ładowanie niestandardowego pliku CSS - wystarczy wpisać nazwę wymiana plików CSS. Ten plik musi znajdować się w tym samym folderze co masz plik szablonu CSS.';
protected $AX_ED_NEWLINESL ='Nowa linia';
protected $AX_ED_NEWLINESD ='Wybierz element (znak) używany do opisania przełączników.';
protected $AX_ED_TOOLBARL ='narzędzi';
protected $AX_ED_TOOLBARD ='Pozycja paska narzędzi';
protected $AX_ED_HTMLHEIGHTL ='Wysokość okna HTML';
protected $AX_ED_HTMLHEIGHTD ='Wysokość okien pop-up trybu HTML.';
protected $AX_ED_HTMLWIDTHL ='Szerokość okna HTML';
protected $AX_ED_HTMLWIDTHD ='Szerokość okien pop-up trybu HTML.';
protected $AX_ED_PREVIEWHEIGHTL ='Wysokość podglądu';
protected $AX_ED_PREVIEWHEIGHTD ='Wysokość okien pop-up w trybie podglądu.';
protected $AX_ED_PREVIEWWIDTHL ='Szerokość podglądu';
protected $AX_ED_PREVIEWWIDTHD ='Szerokość okien pop-up w trybie podglądu.';
protected $AX_ED_IBROWSERL ='iBrowser Plugin';
protected $AX_ED_IBROWSERD ='iBrowser jest zaawansowanym Managerem obrazów';
protected $AX_ED_PLTABLESL ='Dodatkowe tabele';
protected $AX_ED_PLTABLESD ='Edytor tabel w trybie WYSIWYG.';
protected $AX_ED_PLPASTEL ='Dodatkowe wklej';
protected $AX_ED_PLPASTED ='Umożliwia Wklej z Worda, Wklej zwykły tekst i zaznacz wszystko.';
protected $AX_ED_PLIMGPLUGINL ='Zaawansowany Menager obrazów';
protected $AX_ED_PLIMGPLUGIND ='Włącz Zaawansowany Menager obrazów. Domyślnie włączona jest zwykłą wersję.';
protected $AX_ED_PLSEARCHL ='Dodatkowe wyszukiwanie/zastąpić';
protected $AX_ED_PLSEARCHD ='Włącz dodatkowe Znajdź i zamień';
protected $AX_ED_PLLINKSL ='Zaawansowane zarządzanie linkami';
protected $AX_ED_PLLINKSD ='Włącz Zaawansowany Menager linków. Domyślnie włączona jest zwykłą wersję.';
protected $AX_ED_PLEMOTL ='Dodatkowe Emotikony';
protected $AX_ED_PLEMOTD ='Włącza możliwość dodawania Emotikon.';
protected $AX_ED_PLFLASHL ='Dodatkowe Flash';
protected $AX_ED_PLFLASHD ='Włącz dodatkowe Flash. Możesz dodać pozycje do Flash.';
protected $AX_ED_PLDTL ='Dodatkowa Data i godzina';
protected $AX_ED_PLDTD ='Włącz dodatkowe daty/godziny. Można szybko dodać aktualną datę i czas.';
protected $AX_ED_PLPREVL ='Dodatkowe Podgląd';
protected $AX_ED_PLPREVD ='To wprowadza dodatkowy przycisk podglądu w TinyMCE. Po kliknięciu otwiera się okno pop-up do aktualnej zawartości.';
protected $AX_ED_PLZOOML ='Ekstra powiększenie';
protected $AX_ED_PLZOOMD ='Dodaje powiększenie rozwijanej listy w MSIE5.5 + tej wtyczki został stworzony, aby pokazać wszystkim, jak dodać niestandardowe listy jako wtyczki.';
protected $AX_ED_PLFSCRL ='Dodatkowe Pełny ekran';
protected $AX_ED_PLFSCRD ='Ta wtyczka dodajetryb edycji TinyMCE na pełnym ekranie.';
protected $AX_ED_PLPRINTL ='Dodatkowe Drukuj';
protected $AX_ED_PLPRINTD ='Ta wtyczka dodaje przycisk, aby wydrukować TinyMCE.';
protected $AX_ED_PLDIRL ='Dodatkowe wskazówki';
protected $AX_ED_PLDIRD ='To wprowadza dwie dodatkowe ikony, które można wybrać w czasie pisania. W ten sposób możesz łatwo zarządzać językami pisanymi od prawej do lewej.';
protected $AX_ED_PLFONTSL ='Wybór czcionki Lista';
protected $AX_ED_PLFONTSD ='Ta wtyczka dodaje wybor czcionki z rozwijanej listy.';
protected $AX_ED_PLFONTSZL ='Rozmiar czcionki Lista';
protected $AX_ED_PLFONTSZD ='Ta wtyczka dodaje rozmiar czcionki wyboru na liście rozwijanej.';
protected $AX_ED_PLFORMLSL ='Format Lista';
protected $AX_ED_PLFORMLSD ='Ta wtyczka dodaje formaty listy z rozwijanej listy, np. H1, H2 itp.';
protected $AX_ED_PLSSLL ='Wybierz styl z listy';
protected $AX_ED_PLSSLD ='Ta wtyczka dodaje listę wyboru stylu w oparciu o bieżący szablon lub wybór z pliku CSS.';
protected $AX_ED_NAMED ='Nazwa';
protected $AX_ED_NUMERIC ='Ilustracja numeryczna';
protected $AX_ED_RAW ='Nieprzetworzony';
protected $AX_ED_LTR ='Od lewej do prawej';
protected $AX_ED_RTL ='Od prawej do lewej';
protected $AX_ED_LENGTH ='Długość';
protected $AX_ED_ABSSIZE ='Absolutna wielkość';
protected $AX_ED_BRELEMENTS ='Elementy BR';
protected $AX_ED_PELEMENTS ='Elementy P';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L ='Kalkulator';
protected $AX_TCAL_D ='zaawansowany kalkulator javascript';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L ='Opróżnij tymczasowe';
protected $AX_TEMTEMP_D ='Opróżnia folder tymczasowy Elxis (/ tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L ='Napraw Język';
protected $AX_TFIXLANG_D ='Wyniki kontroli w wielojęzycznej bazie danych i ustala porady w tabelach razie potrzeby.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L ='Organizator';
protected $AX_TORGANIZ_D ='Organizator Elxis utrzymuje kontakty, notatki, zakładki i terminy.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L ='Czyszczenie cache';
protected $AX_TCLEANCACHE_D ='Czyści listę pamięci podręcznej (cache) pozycji i obrazów, jakie zawiera.';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L ='Zmień tryb';
protected $AX_TCHMOD_D ='Zmiana trybu danego pliku lub folderu';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L ='Napraw sekwencję Postgres';
protected $AX_TFPGSEQ_D ='Korekcje sekwencji Postgres w razie potrzeby.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L ='Oświadczenie Elxis';
protected $AX_TELXREG_D ='Rejestruj swóją instalacji Elxis na Elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME ='Most';
protected $AX_BRIDGE_CDESC ='Tworzy link do mostu.';
//modules/mod_language.xml
protected $AX_NEW_LINE ='Nowa linia';
protected $AX_SAME_LINE ='Jednej linii';
protected $AX_INDICATOR ='Index';
protected $AX_INDICATOR_D ='Wyświetla język jako wyraz indeksu';
protected $AX_FLAG ='Flaga';
//modules/mod_language.xml
protected $AX_MODLANGD ='Wyświetla na stronie startowej wybór języka jako rozwijane listy, listy linków lub serii flagi.';
protected $AX_FLAGS ='Flagi';
protected $AX_SMARTSW ='Inteligentny przełącznik';
protected $AX_SMARTSW_D ='Pozwala zmienić język i pozostanie na tej samej stronie pod pewnymi warunkami';
//modules/mod_random_profile.xml
protected $AX_RP_DESC ='Wyświetla losowo profile użytkowników';
protected $AX_DISPSTYLE ='Wyświetl Styl';
protected $AX_COMPACT ='Compact';
protected $AX_EXTENDED ='Rozszerzony';
protected $AX_GENDER ='Płeć';
protected $AX_GENDERDESC ='Wyświetl płeć użytkownika';
protected $AX_AGE ='Wiek';
protected $AX_AGEDESC ='Wyświetl wiek użytkownika';
protected $AX_REALUNAME ='Wyświetl Prawdziwe imię lub nazwę użytkownika';
//weblinks item
protected $AX_WBLI_TL ='Cel';
//content
protected $AX_RTFICL ='Ikona RTF';
protected $AX_RTFICD ='Pokaż/Ukryj przycisk RTF - dotyczy tylko tej strony.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR ='Filtr grup';
protected $AX_MODWHO_FILGRD ='Jeśli tak, to użytkownicy z niższym poziomie dostępu (np. osób) nie będzie mógł zobaczyć status logowania użytkowników z wyższym poziomem dostępu';
//search bots
protected $AX_SEARCH_LIMIT ='Ograniczenie szukaj';
protected $AX_MAXNUM_SRES ='Maksymalna liczba wyników wyszukiwania';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE ='Wyświetla podsumowanie najnowszych aktualizacji witryny. Idealny dla strony startowej.';
protected $AX_SECTIONS ='Moduły';
protected $AX_SECTIONSD ='Jednostka kody oddzielone przecinkami (,)';
protected $AX_CATEGORIES ='Kategorie';
protected $AX_CATEGORIESD ='Kategoria kody oddzielone przecinkami (,)';
protected $AX_NUMDAYS ='Liczba dni';
protected $AX_NUMDAYSD ='Wyświetl pozycje, które zostały utworzone ostatnich X dni (domyślnie 900)';
protected $AX_SHOWTHUMBS ='Wyświetl miniatury';
protected $AX_SHOWTHUMBSD ='Pokaż/Ukryj miniatury obrazów w wprowadzającym tekstem';
protected $AX_THUMBWIDTHD ='Szerokość miniatury obrazu w pikselach';
protected $AX_THUMBHEIGHTD ='Wysokość miniatury obrazu w pikselach';
protected $AX_KEEPRATIO ='Zachowanie proporcji';
protected $AX_KEEPRATIOD ='Zachowanie proporcji obrazu. Jeśli tak, wówczas wysokość powyższych parametrów nie jest brane pod uwagę.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM ='blog Elxis';
protected $AX_EBLOGITEMD ='Tworzy link do opublikowanego blogu eBlog';
protected $AX_COMMENTARY = 'Komentarz';
protected $AX_COMMENTARYD = 'Wybierz, kto może skomentować ten artykuł.';
protected $AX_NOONE = 'Nikt';
protected $AX_REGUSERS = 'Zarejestrowani użytkownicy';
protected $AX_ALL = 'Wszyscy';
//2009.0
protected $AX_COMMENTS = 'Komentarze';
protected $AX_COMMENTSD = 'Pokaż liczbę komentarzy?';

}

?>