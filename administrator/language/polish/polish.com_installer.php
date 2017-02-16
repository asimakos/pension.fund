<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ryszard Bryś
* @link: http://www.elxis.pl
* @email: ryszard.brys@gmail.com
* @description: Polish language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bezpośredni dostęp do tego pliku nie jest dozwolony.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR ='Wybierz katalog';
public $A_CMP_INS_UPF ='Przesłanie pliku pakietu';
public $A_CMP_INS_PF ='Plik pakietu';
public $A_CMP_INS_UFI ='Prześlij plik i zainstaluj';
public $A_CMP_INS_FDIR ='Zainstaluj z katalogu';
public $A_CMP_INS_IDIR ='Katalog instalacji';
public $A_CMP_INS_DOIN ='Zainstaluj';
public $A_CMP_INS_CONT ='Kontynuuj ...';
public $A_CMP_INS_NF ='Nie znaleziono instalatora dla elementu';
public $A_CMP_INS_NA ='Instalator nie jest dostępny dla elementu';
public $A_CMP_INS_EFU ='Instalator nie może kontynuować przed przesłaniem plików. Proszę stosować metodę instalacji z katalogu.';
public $A_CMP_INS_ERTL ='Instalator - Błąd';
public $A_CMP_INS_ERZL ='Instalator nie może kontynuować przed zlib jest zainstalowany';
public $A_CMP_INS_ERNF ='Nie wybrano pliku';
public $A_CMP_INS_ERUM ='Przesłanie nowego modułu - błąd';
public $A_CMP_INS_UPTL ='Wyślij';
public $A_CMP_INS_UPE1 ='- Błąd';
public $A_CMP_INS_UPE2 ='- Błąd';
public $A_CMP_INS_SUCC ='Sukces';
public $A_CMP_INS_ER ='Błąd';
public $A_CMP_INS_ERFL ='Nie powiodło się';
public $A_CMP_INS_UPNW ='Prześlij nowe';
public $A_CMP_INS_FP ='Nie można zmienić uprawnienia przesłanemu plikowi.';
public $A_CMP_INS_FM ='Nie można przenieść przesłanych plików do katalogu <code>/media </code>.';
public $A_CMP_INS_FW ='Błąd w <code>/media</code> katalog nie jest zapisywalny.';
public $A_CMP_INS_FE ='Błąd w <code>/media</code> katalog nie istnieje.';
public $A_CMP_INST_ERUNR ='Nieodwracalny błąd';
public $A_CMP_INST_EREXT ='Wyodrębnij Błąd';
public $A_CMP_INST_ERMXM ='<strong> ERROR: </strong> Nie można znaleźć pliku XML Elxis, w pakiecie';
public $A_CMP_INST_ERXML ='<strong> ERROR: </strong> Nie można znaleźć pliku XML w pakiecie';
public $A_CMP_INST_ERNFN ='Nie określono nazwy pliku';
public $A_CMP_INST_ERVLD ='nie jest prawidłowym plikiem instalacyjny Elxis';
public $A_CMP_INST_ERINC ='Metoda instalacji nie może być zwołana przez klasy';
public $A_CMP_INST_ERUIC ='Sposób dezinstalacji nie może być zwołany przez klasy';
public $A_CMP_INST_ERIFN ='Nie znaleziono pliku instalacyjnego';
public $A_CMP_INST_ERSXM ='XML plik instalacyjny nie jest dla';
public $A_CMP_INST_ERCDR ='Nie można utworzyć katalogu';
public $A_CMP_INST_FNOTE ='nie istnieje!';
public $A_CMP_INST_TAFC ='Istnieje już plik o nazwie';
public $A_CMP_INST_AYIT ='- Czy próbujesz zainstalować ten sam CMT dwukrotnie?';
public $A_CMP_INST_FCPF ='Nie można skopiować pliku';
public $A_CMP_INST_CPTO ='do';
public $A_CMP_INST_UNINSTALL ='Odinstaluj';
public $A_CMP_INST_CUDIR ='Inny składnik używa ten katalog';
public $A_CMP_INST_SQLER ='Błąd SQL';
public $A_CMP_INST_CCPHP ='Nie można skopiować pliku PHP instalacji.';
public $A_CMP_INST_CCUNPHP ='Nie można skopiować pliku PHP odinstalować.';
public $A_CMP_INST_UNERR ='Odinstaluj - błąd';
public $A_CMP_INST_THCOM ='Komponent';
public $A_CMP_INST_ISCOR ='jest podstawowym elementem, i nie może być odinstalowany. <br /> Musisz cofnąć, jeśli nie chcesz go użyć';
public $A_CMP_INST_XMLINV ='Plik XML nieprawidłowy';
public $A_CMP_INST_OFEMP ='Opcja pusta, nie można usunąć pliki';
public $A_CMP_INST_INCOM ='Instalacja Komponentów';
public $A_CMP_INST_CURRE ='Aktualnie zainstalowane';
public $A_CMP_INST_MENL ='Menu Komponent Link';
public $A_CMP_INST_AUURL ='Autor URL';
public $A_CMP_INST_NCOMP ='Nie ma żadnych niestandardowych komponentów';
public $A_CMP_INST_INSCO ='Zainstaluj nowy komponent';
public $A_CMP_INST_DELE ='Usunięcie';
public $A_CMP_INST_LIDE ='Język id pusty, nie można usunąć pliki';
public $A_CMP_INST_ALL ='wszystkich';
public $A_CMP_INST_BKLM ='Powrót do Manager języków';
public $A_CMP_INST_NWLA ='Zainstaluj nowy język';
public $A_CMP_INST_NFMM ='Nie plik jest oznaczony jako plik bot';
public $A_CMP_INST_MAMB ='bot';
public $A_CMP_INST_AXST ='już istnieje!';
public $A_CMP_INST_IOID ='Nieprawidłowe id pozycji';
public $A_CMP_INST_FFEM ='Folder pusty, nie można usunąć pliki';
public $A_CMP_INST_DXML ='Usuwanie pliku XML';
public $A_CMP_INST_ICMO ='jest podstawowym elementem, i nie może być odinstalowany. <br /> Musisz cofnąć, jeśli nie chcesz go użyć';
public $A_CMP_INST_IMBT ='Zainstalowane boty sieciowe';
public $A_CMP_INST_OMBT ='Tylko boty sieciowe, które są wyświetlane mogą być odinstalowane - niektóre Główne boty sieciowe nie mogą być usunięte.';
public $A_CMP_INST_MBT ='Bot';
public $A_CMP_INST_MTYP ='Typ';
public $A_CMP_INST_NMBT ='Nie główny, niestandardowy bot zainstalowany.';
public $A_CMP_INST_INMT ='Zainstaluj nowy bot sieciowe';
public $A_CMP_INST_UCTP ='Nieznany typ klienta';
public $A_CMP_INST_NFMD ='Nie plik jest oznaczony jako moduł pliku';
public $A_CMP_INST_MODULE ='Moduł';
public $A_CMP_INST_ICMDL ='jest głównym modułem i nie może być odinstalowany. <br /> Musisz cofnąć, jeśli nie chcesz go użyć';
public $A_CMP_INST_IMDL ='Zainstalowane Moduły';
public $A_CMP_INST_OMDL ='Tylko te moduły, które są wyświetlane mogą być odinstalowane - niektóre podstawowe moduły nie mogą być usunięte.';
public $A_CMP_INST_MDLF ='Moduł pliku';
public $A_CMP_INST_NMDL ='Nie niestandardowe moduły zainstalowane';
public $A_CMP_INST_NWMDL ='Zainstaluj nowy modułów';
public $A_CMP_INST_ALLC ='Wszystkie';
public $A_CMP_INST_STMDL ='Strona modułów';
public $A_CMP_INST_ADMDL ='Administrator modułów';
public $A_CMP_INST_DDEX ='Katalog nie istnieje, nie może usuwać plików';
public $A_CMP_INST_TIDE ='Szablon id jest pusty, nie można usunąć plików';
public $A_CMP_INST_TINS ='Zainstaluj nowy szablon';
public $A_CMP_INST_BATP ='Powrót do szablonów';
public $A_CMP_INST_INSBR ='Zainstaluj nowy Bridge';
public $A_CMP_INST_BABR ='Powrót do Bridges';
public $A_CMP_INST_BIDE = 'Bridge id pusty, nie można usunąć plików';
public $A_INST_INCOM ='Wykryto ewentualną niezgodność między wersją Elxis którą używasz i zainstalowanymi rozszerzeniami.
Oprócz tego, program może działać dobrze i bez błędów. To jest tylko zgłoszenie.';
public $A_INST_INCOMJOO ='Instalacja pakietu jest dla CMS Joomla!';
public $A_INST_INCOMMAM ='Instalacja pakietu jest CMS Mambo!';
public $A_INST_OLDER ='Instalacja pakietu jest dla poprzedniej wersji Elxis ( %s ) niż twoja ( %s )';
public $A_INST_NEWER ='Instalacja pakietu jest dla nowszej wersji Elxis ( %s ) niż twoja ( %s )';
// 2009.0
public $A_INST_DOINEDC = 'Pobierz i zainstaluj z Centrum Pobrania Elxis';
public $A_INST_FETCHAVEXTS = 'Fetch lista dostępnych rozszerzeń';
public $A_INST_MORE = 'Więcej';
public $A_INST_LESS = 'Mniej';
public $A_INST_SIZE = 'Rozmiar';
public $A_INST_DOWNLOAD = 'Pobierz';
public $A_INST_DOWNLOADS = 'Pobieranie';
public $A_INST_DOWNINST = 'Pobierz i zainstaluj';
public $A_INST_LICENSE = 'Licencja';
public $A_INST_COMPAT = 'Zgodność';
public $A_INST_DATESUB = 'Data przedstawienia';
public $A_INST_SUREINST = 'Czy na pewno chcesz zainstalować %s ?'; // Pomoc w tłumaczeniu: wypełniona jest tytułem rozszerzenia
//2009.2
public $A_INST_UPTODATE = 'Aktualny';
public $A_INST_OUTDATED = 'Przestarzały';
public $A_INST_INSTVERS = 'Zainstalowanej wersji';
public $A_INST_UNLOAD = 'Rozładować';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>