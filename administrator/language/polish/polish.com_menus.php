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
* @description: Polish language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined('_VALID_MOS') or die('Bezpośredni dostęp do tego pliku nie jest dozwolony.');


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER ='Manager Menu';
public $A_CMP_MU_MXLVLS ='Max Poziomy';
public $A_CMP_MU_CANTDEL ='* Nie można \'skasować\' menu, jest to niezbędne do prawidłowego funkcjonowania Elxis *';
public $A_CMP_MU_MANHOME ='* 1. Publikuj pozycję w tym menu [mainmenu] jest domyślnie \'Homepage\' na stronie *';
public $A_CMP_MU_MITEM ='Pozycje menu';
public $A_CMP_MU_NSMTG ='* Pamiętaj, że niektóre rodzaje menu pojawiają się w więcej niż w jednej grupie, ale są one nadal tym samym rodzajem menu.';
public $A_CMP_MU_MITYP ='Typ pozycji Menu';
public $A_CMP_MU_WBLV ='Co to jest \'Blog\' widok';
public $A_CMP_MU_WTLV ='Co to jest \'Tabela\' widok';
public $A_CMP_MU_WLIV ='Co to jest \'List\' widok';
public $A_CMP_MU_SMTAP ='* Niektóre \'Typy Menu\' pojawiają się w więcej niż jednej grupy *';
public $A_CMP_MU_MOVEITS ='Przenieś pozycje menu';
public $A_CMP_MU_MOVEMEN ='Przenieś do Menu';
public $A_CMP_MU_BEINMOV ='Pozycje menu są przenoszone';
public $A_CMP_MU_COPYITS ='Kopiuj pozycje menu';
public $A_CMP_MU_COPYMEN ='Kopiuj do Menu';
public $A_CMP_MU_BCOPIED ='Pozycje menu są kopiowane';
public $A_CMP_MU_EDNEWSF ='Edytuj Newsfeed';
public $A_CMP_MU_EDCONTA ='Edytuj ten Kontakt';
public $A_CMP_MU_EDCONTE ='Edytuj tą treść';
public $A_CMP_MU_EDSTCONTE ='Edytuj tę Autonomiczną Stronę';
public $A_CMP_MU_MSGITSAV ='Menu pozycji zapisane';
public $A_CMP_MU_MOVEDTO ='Pozycje menu przeniosła się do';
public $A_CMP_MU_COPITO ='Pozycje menu skopiowana do';
public $A_CMP_MU_THMOD ='Moduł';
public $A_CMP_MU_SCITLKT ='Musisz wybrać komponent na link';
public $A_CMP_MU_COMPLLTO ='Odnośnik do Komponentu';
public $A_CMP_MU_ITEMNAME ='Pozycja musi mieć nazwę';
public $A_CMP_MU_PLSELCMP ='Proszę wybrać Komponent';
public $A_CMP_MU_PARAVAI ='Parametry listy będą dostępne po zapisaniu tego nowego menu';
public $A_CMP_MU_YSELCAT ='Musisz wybrać Kategorię';
public $A_CMP_MU_TMHTITL ='Ten element menu musi mieć tytuł';
public $A_CMP_MU_TABLE ='Tabela';
public $A_CMP_MU_CCTBLANK ='Jeśli pozostawisz to pusty, nazwa kategorii zostanie użyta automatycznie';
public $A_CMP_MU_LNKHNAME ='Link musi mieć nazwę';
public $A_CMP_MU_SELCONT ='Musisz wybrać kontakt do link';
public $A_CMP_MU_CONLINK ='Kontakt do link:';
public $A_CMP_MU_ONCLOPI ='Kliknij, Otwórz w';
public $A_CMP_MU_THETITL ='Tytuł:';
public $A_CMP_MU_YMSSECT ='Musisz wybrać sekcję';
public $A_CMP_MU_ILBLSEC ='Jeśli pozostawisz to puste, nazwa sekcji zostaną użyta automatycznie';
public $A_CMP_MU_YCSMC ='Możesz wybrać wiele Kategorii';
public $A_CMP_MU_YCSMS ='Możesz wybrać wiele sekcji';
public $A_CMP_MU_EDCOI ='Edycja treści pozycji';
public $A_CMP_MU_YMSLT ='Musisz wybrać treść linku do';
public $A_CMP_MU_STACONT ='Treść Autonomicznej Strony';
public $A_CMP_MU_ONCLOP ='Kliknij, na otwórz';
public $A_CMP_MU_YSNWLT ='Musisz wybrać link do Newsfeed';
public $A_CMP_MU_NEWTL ='Odnośnik do Newsfeed';
public $A_CMP_MU_SEPER ='- - - - - - -'; // to zmienić, jeśli chcesz zmienić symbol linii SEPERATOR
public $A_CMP_MU_PATNAM ='Pattern/Nazwa';
public $A_CMP_MU_WRURL ='Musisz podać adres URL.';
public $A_CMP_MU_WRLINK ='Wrapper Link';
public $A_CMP_MU_MIBGCC ='Blog - Treść Kategoria';
public $A_CMP_MU_MITCG ='Tabela - Kontakt Kategoria';
public $A_CMP_MU_MICOMP ='Komponent';
public $A_CMP_MU_MIBGCS ='Blog - Treść sekcji';
public $A_CMP_MU_MILCMPI ='Link - Komponent Pozycja';
public $A_CMP_MU_MILCI ='Link - Kontakt Pozycja';
public $A_CMP_MU_MITBCC ='Tabela - Treść Kategoria';
public $A_CMP_MU_MILCEI ='Link - Treść pozycja';
public $A_CMP_MU_COTLINK ='Odnośnik do treści';
public $A_CMP_MU_MITBCS ='Tabela - zawartość sekcji';
public $A_CMP_MU_MILSTC ='Link - Autonomiczna Strona';
public $A_CMP_MU_MITBNFC ='Tabela - Newsfeed Kategoria';
public $A_CMP_MU_MILNEW ='Link - Newsfeed';
public $A_CMP_MU_MISEP ='Separator/Miejsce';
public $A_CMP_MU_MILIURL ='Link - URL';
public $A_CMP_MU_MITBWC ='Tabela - Odnośnik Kategoria';
public $A_CMP_MU_MIWRAP ='Wrapper';
public $A_CMP_MU_ITEM ='Pozycja';
public $A_CMP_MU_UMSBRI ='Musisz wybrać Bridge';
public $A_CMP_MU_BRINOINS ='komponent Bridge nie jest zainstalowany!';
public $A_CMP_MU_NOPUBBRI ='Brak opublikowanych Bridges!';
public $A_CMP_MU_CLVSEO ='Kliknij autonomiczne strony, by zobaczyć SEO tytuł';
public $A_CMP_MU_SYSLINK ='System link';
public $A_CMP_MU_SYSLINKD ='System Link powinien normalnie należeć do opublikowanych menu ustawić w module pozycja, że nie istnieje w szablonie!';
public $A_CMP_MU_PASSR ='Przypomnienie hasła';
public $A_CMP_MU_UREG ='Rejestracja użytkownika';
public $A_CMP_MU_REGCOMP ='Rejestracja kompletna';
public $A_CMP_MU_ACCACT ='Aktywacja konta';
public $A_CMP_MU_MSLINK ='Musisz wybrać system link.';
public $A_CMP_MU_SELLINK ='- wybierz link -';
public $A_CMP_MU_DONTDEL ='* Nie można usunąć to menu, jak to lepiej operaja Elxis. Upewnij się, które zostaną opublikowane w module pozycja, nie istnieje w szablonie! *';
public $A_CMP_MU_EDPROF ='Edytuj profil';
public $A_CMP_MU_SUBWEBL ='Wyślij odsyłacz';
public $A_CMP_MU_CHECKIN ='Sprawdzenie';
public $A_CMP_MU_USERLIST ='Lista użytkowników';
public $A_CMP_MU_POLLS ='Ankieta';
public $A_CMP_MU_SELBLOG ='Musisz wybrać na blogu link do';
public $A_CMP_MU_BLOGLINK ='Blog Link do';
									  
}

?>