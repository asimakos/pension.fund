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
* @description: Polish language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS'  ) or die( 'Bezpośredni dostęp do tego pliku nie jest dozwolony.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG ='Zarządzanie treścią';
public $A_CMP_CNT_DATEFORMAT ='Y-m-d h:i:s';
public $A_CMP_CNT_ALTEDITCONT ='Edytuj zawartość';
public $A_CMP_CNT_TRASH ='Proszę dokonać wyboru z listy, aby wysłać do kosza';
public $A_CMP_CNT_TRASHMESS ='Czy na pewno chcesz przenieść do Kosza wybrane element (-ów)? \nW tym nie będą trwale usunięte pozycja (e).';
public $A_CMP_CNT_ARCHMANAGER ='Archiwum Manager';
public $A_CMP_CNT_DATECREATED ='%A, %d %B %Y %H:%M';
public $A_CMP_CNT_DATEMODIFIED ='%A, %d %B %Y %H:%M';
public $A_CMP_CNT_MUSTTITLE ='Treść pozycji musi mieć tytuł.';
public $A_CMP_CNT_MUSTSECTN ='Musisz wybrać sekcję';
public $A_CMP_CNT_MUSTCATEG ='Musisz wybrać kategorię.';
public $A_CMP_CNT_CONTITEM ='Treść pozycja';
public $A_CMP_CNT_ITEMDETLS ='Szczegóły';
public $A_CMP_CNT_INTRO ='Wstępny tekst: (wymagane)';
public $A_CMP_CNT_MAIN ='Główny tekst: (opcjonalnie)';
public $A_CMP_CNT_FRONTPAGE ='Pokaż na Frontpage';
public $A_CMP_CNT_AUTHOR ='Autor Alias';
public $A_CMP_CNT_CREATOR ='Zmień twórcę';
public $A_CMP_CNT_OVERRIDE ='Nadpisz Datę utworzenia';
public $A_CMP_CNT_STRTPUB ='Rozpocznij działalność wydawniczą';
public $A_CMP_CNT_FNSHPUB ='Zakończ działalność wydawniczą';
public $A_CMP_CNT_DRFTUNPUB ='Projekt niepublikowany';
public $A_CMP_CNT_RESETHIT ='Resetuj licznik punktów';
public $A_CMP_CNT_REVISED ='Zrewidowany';
public $A_CMP_CNT_TIMES ='razy';
public $A_CMP_CNT_BY ='przez';
public $A_CMP_CNT_NEWDOC ='Nowy dokument';
public $A_CMP_CNT_LASTMOD ='Ostatnio zmodyfikowane';
public $A_CMP_CNT_NOTMOD ='Nie zmodyfikowane';
public $A_CMP_CNT_ADDETC ='Dodaj Sekcja/Kategoria/Tytuł';
public $A_CMP_CNT_LINKCI ='To stworzy \' Link - treść pozycja \' w menu utwórz';
public $A_CMP_CNT_SOMTHING ='Proszę wybrać coś';
public $A_CMP_CNT_MVEITEMS ='Przenieś pozycje';
public $A_CMP_CNT_MVESECCAT ='Przenieś do Sekcja/Kategoria';
public $A_CMP_CNT_ITMSMVED ='Pozycje, które są przenoszone';
public $A_CMP_CNT_SECCAT ='Proszę wybrać Sekcja/Kategoria, aby skopiować pozycje do';
public $A_CMP_CNT_CPYITEMS ='Kopiuj zawartość pozycji';
public $A_CMP_CNT_CPYSECCAT ='Kopiuj do Sekcja/Kategoria';
public $A_CMP_CNT_ITMSCPED ='Pozycje są kopiowane';
public $A_CMP_CNT_CCHECL ='Cache Oczyszczony';
public $A_CMP_CNT_CANNOT ='Nie można edytować zarchiwizowanego pozycji';
public $A_CMP_CNT_THMODULIS ='Moduł';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV ='Nigdy';
public $A_CMP_CNT_DPUBLISHUP ='Y-m-d';
public $A_CMP_CNT_SLSECTN ='Wybierz Sekcjię';
public $A_CMP_CNT_SELCAT ='Wybierz Kategorię';
public $A_CMP_CNT_ARCHVED ='Pozycja (-e) Zarchiwizowane pomyślnie';
public $A_CMP_CNT_PUBLSHED ='Pozycja (-e) Publikowane pomyślnie';
public $A_CMP_CNT_ITSUUNP ='Pozycja (-e) opublikowane pomyślnie';
public $A_CMP_CNT_ITSUUNA ='Pozycja (-e) nie archiwizowane pomyślnie';
public $A_CMP_CNT_SELITOG ='Wybierz element, aby przełączyć';
public $A_CMP_CNT_SELIDEL ='Wybierz element do usunięcia';
public $A_CMP_CNT_ERROCCRD ='Wystąpił błąd';
public $A_CMP_CNT_MOVD ='Pozycja (-e) zostały przeniesione do sekcji';
public $A_CMP_CNT_COPED ='Pozycja (-e) zostały skopiowane do sekcji';
public $A_CMP_CNT_RSTHTCNT ='Pomyślnie zresetowano licznik na';
public $A_CMP_CNT_INMENU ='(Link - Autonomicznej strony) w menu';
public $A_CMP_CNT_SUCCSS ='został pomyślnie utworzony';
public $A_CMP_CNT_RSZERO ='Czy na pewno chcesz zresetować licznik do zera? \n Niezapisane zmiany treści zostaną utracone.';
public $A_CMP_CNT_MUST_CIMNA ='Treść pozycji musi mieć nazwę';
public $A_CMP_CNT_SITMAPFOR ='Mapa strony dla';
public $A_CMP_CNT_ALLLANGS ='Wszystkie języki';
public $A_CMP_CNT_LANG ='Język';
public $A_CMP_CNT_PHRENAME ='Naciśnij i przytrzymaj, aby zmienić nazwę';
public $A_CMP_CNT_EDITITEM ='Edytuj pozycję';
public $A_CMP_CNT_NOTES ='Uwagi';
public $A_CMP_CNT_PRSHREN ='Naciśnij i przytrzymaj, aby zmienić nazwę pozycji';
public $A_CMP_CNT_EMPCATSEC ='Drzewo nie wyświetla pustych sekcji i kategorii.';
public $A_CMP_CNT_TREEUNPUBL ='Pola oznaczone szarym kolorem i kursywą są niepublikowane';
public $A_CMP_CNT_NULLVAL ='Wartość pusta!';
public $A_CMP_CNT_INCCTP ='Nieprawidłowy typ zawartości';
public $A_CMP_CNT_CLDNFETCH ='Nie można pobrać danych';
public $A_CMP_CNT_TRSELPAIR ='Proszę wybrać język pary';
public $A_CMP_CNT_TRSOUDEST ='Wybierz źródło i cel języków';
public $A_CMP_CNT_TRITEMS ='Pozycja będzie przetłumaczona';
public $A_CMP_CNT_TRNOTE ='<strong> Elxis Uwaga: </strong> Wybierz starannie języków źródłowy i docelowy. Ta procedura może potrwać 
    chwilę, w zależności od wielkości tłumaczonego tekstu.<br />
	Przekład opiera się na darmowej usłudze tłumaczenia maszynowego Altavista. 
	Elxis nie ponosi odpowiedzialności za jakość tłumaczenia.';
public $A_CMP_CNT_TRSELITEM ='Wybierz element do przetłumaczenia';
public $A_CMP_CNT_TROKSAVED ='Pozycja przetłumaczone z powodzeniem i zapisane';
public $A_CMP_CNT_TRITMNOTF ='Wybranej pozycji nie znaleziono w bazie danych!';
public $A_CMP_CNT_MFS ='Wiadomość z serwera';
public $A_CMP_CNT_WID ='Z id';
public $A_CMP_CNT_RNMTO ='zmieniono do';
public $A_CMP_CNT_FL= 'Filtr Język';
public $A_CMP_CNT_CONFL ='Język Konflikt';
public $A_CMP_CNT_CONFI ='Pozycja w kategorii z ustawienia języka, który nie może być wyświetlony!';
public $A_CMP_CNT_STARTALW ='Start: Zawsze';
public $A_CMP_CNT_FINNOEXP ='Zakończ: Nie ważność';
public $A_CMP_CNT_FINISH ='Zakończ';
public $A_CMP_CNT_FROM ='z';
public $A_CMP_CNT_SHOWHIDE ='Pokaż/Ukryj';
public $A_SIMPLEVIEW ='Prosty widok';
public $A_EXTENDVIEW ='Rozszerzony widok';
public $A_CMP_CNT_COMMENTS ='Komentarze';
public $A_CMP_CNT_SAVTRANS ='Pozycja przeniesiony i zapisany w miejscu zawartości';
public $A_CMP_CNT_RELLINKS ='Linki';
public $A_CMP_CNT_RELLINKSD ='Podobne odnośniki do tego artykułu. Jeśli chcesz dodać linki zewnętrzne, należy dodać przedrostek http:// w adresie URL.';

}

?>