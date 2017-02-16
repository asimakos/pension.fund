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
* @description: Polish language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS'  ) or die( 'Bezpośredni dostęp do tego pliku nie jest dozwolony.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM ='Nazwa tabeli';
public $A_CMP_DB_ACTIONS ='Akcje';
public $A_CMP_DB_TDESCR ='Opis tabeli';
public $A_CMP_DB_BROWSE ='Przegląd';
public $A_CMP_DB_STRUCTURE ='Struktura';
public $A_CMP_DB_INFO ='Informacja';
public $A_CMP_DB_DUMPDB ='Zrzut bazy danych';
public $A_CMP_DB_XDUMPDB ='XML/SQL Zrzut bazy danych';
public $A_CMP_DB_BACTYPE ='Kopia zapasowa typu';
public $A_CMP_DB_XML ='XML';
public $A_CMP_DB_SQL ='SQL';
public $A_CMP_DB_XCRBACK ='Tworzenie kopii zapasowych XML';
public $A_CMP_DB_XFULL ='Struktura i dane';
public $A_CMP_DB_XSTRUONL ='Tylko struktura';
public $A_CMP_DB_XSAVSERV ='Zapisz na serwerze';
public $A_CMP_DB_DOWNLD ='Pobierz';
public $A_CMP_DB_XMLBACK ='XML Backup';
public $A_CMP_DB_SCRBACK ='Tworzenie kopii zapasowej SQL';
public $A_CMP_DB_SFULL ='Struktura i dane';
public $A_CMP_DB_SDATAONL ='Tylko dane';
public $A_CMP_DB_SLOCTBL ='Zablokuj tabelę';
public $A_CMP_DB_SFSYNTX ='Pełna składnia';
public $A_CMP_DB_SDRTBL ='Zrzut tabeli';
public $A_CMP_DB_STBLS ='Tabele';
public $A_CMP_DB_ATBLS ='Wszystkie';
public $A_CMP_DB_SELTBLS ='Wybrane';
public $A_CMP_DB_SQLBACK ='SQL Backup';
public $A_CMP_DB_TDESC ='Opis tabeli';
public $A_CMP_DB_CLNAME ='Nazwa kolumny';
public $A_CMP_DB_CLTYPE ='Typ kolumny';
public $A_CMP_DB_ADOTYPE ='Typ ADOdb';
public $A_CMP_DB_MAXLEN ='Maksymalna długość';
public $A_CMP_DB_BRTBL ='Przegląd tabeli';
public $A_CMP_DB_BCKDB ='Powrót do bazy';
public $A_CMP_DB_DBTYPE ='Typ Bazy Danych';
public $A_CMP_DB_DBDESCR ='Opis Baz Danych';
public $A_CMP_DB_DBVER ='Wersja Baza danych';
public $A_CMP_DB_DBHOST ='Host bazy danych';
public $A_CMP_DB_DBNAME ='Nazwa bazy danych';
public $A_CMP_DB_DBUSER ='Użytkownik';
public $A_CMP_DB_DBERRF ='Wystąpił błąd FN';
public $A_CMP_DB_DBDBG ='Debug';
public $A_CMP_DB_TBLSTR ='Struktura tabeli';
public $A_CMP_DB_DBBACK ='Kopia zapasowa bazy danych';
public $A_CMP_DB_NOEXISTS ='Nie ma kopii zapasowej';
public $A_CMP_DB_FOOTER= '<u>Uwaga</u>: Kliknij prawym przyciskiem myszy na nazwę pliku i wybierz Zapisz element docelowy jako do pobrania. <strong> Uwaga </strong>: Pliki UTF-8.';
public $A_CMP_DB_DBMONIT ='Monitor Bazy Danych';
public $A_CMP_DB_TBLNOT ='Tabela nie istnieje!';
public $A_CMP_DB_BACKSUCC ='Została utworzona kopia zapasowa Bazy Danych';
public $A_CMP_DB_NOTSUPPO ='Zrzut SQL nie jest obsługiwana';
public $A_CMP_DB_NOTBLSEL ='Nie wybrano tabeli!';
public $A_CMP_DB_NOTDWNL ='Nie można utworzyć/pobrać Zrzutu SQL';
public $A_CMP_DB_NOTCRSV ='Nie można utworzyć lub zapisywać Zrzutu SQL';
public $A_CMP_DB_DUMPSUCC ='Zrzut SQL utworzony';
public $A_CMP_DB_DTUNKN ='Nieznana Data'; // Tłumaczyć jak: Nieznana Data
public $A_CMP_DB_TXMLSCHEM ='XML Schema';
public $A_CMP_DB_TSQL ='SQL';
public $A_CMP_DB_TUNKN ='Nieznany typ'; // Tłumaczyć jak: Nieznany typ
public $A_CMP_DB_UNKOWN ='Nieznany rozmiar'; // Tłumaczyć jak: Nieznany Rozmiar
public $A_CMP_DB_NOFSELDEL ='Nie wybrano pliku do usunięcia!';
public $A_CMP_DB_FSDELETED ='Pliki zostały usunięte';
public $A_CMP_DB_FDELETED ='Plik został usunięty';
public $A_CMP_DB_TLMANBACK ='Zarządzanie Kopiami zapasowymi';
public $A_CMP_DB_TLDELSLBCK ='Usuń zaznaczone Kopie zapasowe';
public $A_CMP_DB_TLNEWFXML ='Nowy XML Pełna kopia zapasowa';
public $A_CMP_DB_TLNEWFSQL ='Nowy SQL Pełna kopia zapasowa';
public $A_CMP_DB_MAINTEN ='Utrzymanie';
public $A_CMP_DB_MAINTEND ='Baz Danych';
public $A_CMP_DB_OPTIM ='Optymalizuj';
public $A_CMP_DB_REPAIR ='Napraw';
public $A_CMP_DB_TBLOPTED ='tabele zoptymalizowano';
public $A_CMP_DB_FRUOPTINCP ='Częste korzystanie z <strong>optymalizacji</strong>, zwiększa wydajność Bazy Danych.';
public $A_CMP_DB_RRERRDBTAB ='<strong>Napraw</strong>, naprawa wszelkich istniejących błędów w tabelach Dazy Danych.';
public $A_CMP_DB_FAVMYSQL ='Ta funkcja jest dostępna tylko dla bazy danych MySQL!';
public $A_CMP_DB_TBLREPED ='tabele naprawiono';
public $A_CMP_DB_SIZE ='Rozmiar';

}

?>