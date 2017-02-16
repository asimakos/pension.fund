<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ivan Trebješanin
* @ Translator URL: http://www.elxis-srbija.org
* # Translator E-mail: admin@elxis-srbija.org
* @ Description: Serbian language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_DEFL_CONFIG', 'Konfiguracija Elxis zaštitnika');
DEFINE ('_DEFL_CONFPERMSUCC', 'Dozvole konfiguracionog fajla Zaštitnika su uspešno izmenjene na');
DEFINE ('_DEFL_CONFPERMNO', 'Ne mogu da otključam Zaštitnikov konfiguravioni fajl');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Dozvole Zaštitnikove evidencije su uspešno izmenjene na');
DEFINE ('_DEFL_LOGSPERMNO', 'Ne mogu da otključam direktorijum evidencije');
DEFINE ('_DEFL_ENABLEDESC', 'Uključivanje/Isključivanje Zaštitnika (proverite da li je /administrator/tools/defender/logs otključan)');
DEFINE ('_DEFL_PROTVARS', 'Zaštićene varijable');
DEFINE ('_DEFL_PROTVARSD', 'Izbor zaštićenih varijabli (predefinisano je: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Evidentiranje napada');
DEFINE ('_DEFL_LOGATTACKSD', 'Ukoliko je uključeno, Zaštitnik će voditi evidenciju, i obavestiti Vas o svakom napadu');
DEFINE ('_DEFL_MAILALERT', 'Poruka upozorenja');
DEFINE ('_DEFL_MAILALERTD', 'Ukoliko je uključeno, Zaštitnik će Vam poslati poruku o svakom napadu');
DEFINE ('_DEFL_MAILADDR', 'Adresa e-pošte (za obaveštenja)');
DEFINE ('_DEFL_SITEOFFFOR', 'Sajt van funkcije na');
DEFINE ('_DEFL_SECONDS', 'sekundi');
DEFINE ('_DEFL_SITEOFFD', 'Nakon napada, sajt će biti stavljen van funkcije na X sekundi. 0 ukoliko neželite da koristite ovu mogućnost');
DEFINE ('_DEFL_BLOCKIP', 'Blokiranje IP-ja');
DEFINE ('_DEFL_BLOCKIPD', 'Blokiranje IP adrese napadača. Obratite pažnju na činjenicu da će Zaštitnik blokirati pritup svakom potencijalnom napadaču, čak i Vama!');
DEFINE ('_DEFL_FILTERS', 'Filteri');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Zaštitnik je neupotrebljiv bez filtera.</b><br />
	Da biste dodali novi filter, unesite reč ili frzu koju želite da filtrirate i kliknite <b>Dodavanje</b>.<br />
	Ne morate voditi računa o velikim ili malim slovima.<br />
	Pritisnite <b>Brisanje</b> kako biste filter uklonili sa liste.<br />
	Ukoliko poznajete način rada <b>mod_Security</b> Apache srvera, imajte u vidu da Elxis Zaštitnik funkcioniše na sličan način, 
	pri dodavanju filtera.<br />
	Kada završite, kliknite <b>Čuvanje</b> da biste sačuvali konfiguraciju Zaštitnika.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Usporavanje');
DEFINE ('_DEFL_SLOWDOWN', 'Upotreba Elxis Zaštitnika usporava sajt. 
	Dodavanje previše filtera može previše uvećati vreme izvršavanja php zahteva. Savet je da ne dodajete više od 15 filtera, 
	podstičemo Vas da eksperimentišete, jer mnogo toga zavisi od sajta i servera. 
	Izuzmite određene fitere, ukoliko imate poteškoća. 
	Naši laboratorijski testovi su pokazali usporenje od <b>0.1 do 27 msec</b> u zavisnosti od broja filtera (od 10 do 30) 
	i ulaznih varijabli sa kojima je Zaštitnik suočen (od običnog pregleda, do slanja ogromnih članaka putem POST ili GET metoda).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Primeri filtera');
DEFINE ('_DEFL_DEFCONFIS', 'Fajl konfiguracije Zaštitnika je');
DEFINE ('_DEFL_DEFLOGSIS', 'Direktorijum evidencije Zaštitnika je');
DEFINE ('_DEFL_MAKEWRITE', 'Otključavanje');
DEFINE ('_DEFL_CONFSAVESUCC', 'Konfiguracija zaštitnika je uspešno sačuvana!');
DEFINE ('_DEFL_CONFSAVENO', 'Ne mogu da sačuvam konfiguraciju Zaštitnika!');
DEFINE ('_DEFL_ERRONEFILT', 'Greška: Morate dodati bar jedan filter!');
DEFINE ('_DEFL_ENCKEY', 'Šifrovani ključ');
DEFINE ('_DEFL_ENCKEYD', 'Upotrebljava se za šifrovanje informacija. Dužina ključa mora biti između 8 i 32 karaktera. Obrišite sve evidencione zapise pre promene ključa!');
DEFINE ('_DEFL_ERRENCKEY', 'Greška: Dužina ključa mora biti između 8 i 32 karaktera');
DEFINE ('_DEFL_ENABLEDEF', 'Uključivanje Zaštitnika');
DEFINE ('_DEFL_DISABLEDEF', 'Isključivanje Zaštitnika');
DEFINE ('_DEFL_VIEWLOGS', 'Pregled evidencije');
DEFINE ('_DEFL_CLEARLOGS', 'Čišćenje zapisa');
DEFINE ('_DEFL_VIEWBLOCK', 'Pregled blokiranih IP-jeva');
DEFINE ('_DEFL_CLEARBLOCK', 'Čišćenje blokiranih IP-jeva');
DEFINE ('_DEFL_DEFENDER', 'Elxis Zaštitnik');
DEFINE ('_DEFL_LOGSCLEARED', 'Zapisi su očišćeni');
DEFINE ('_DEFL_CNOTCLLOGS', 'Ne mogu da očistim zapise. Proverite da li je fajl otključan.');
DEFINE ('_DEFL_BLOCKCLEARED', 'Sve blokirane IP adrese su obrisane');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Ne mogu da očistim blokirane IP adrese. Proverite da li je fajl otključan.');
DEFINE ('_DEFL_SUBMITALERT', 'Izmena filtera dok je Zaštitnik uključen, biće smatrana napadom! Najpre isključite Zaštitnika, napravite izmene, a zatim ga uključite');
DEFINE ('_DEFL_GEOLOCATE', 'Lociranje');
DEFINE ('_DEFL_PERMSUCC', 'Dozvole uspešno izmenjene na');
DEFINE ('_DEFL_PERMFAIL', 'Ne mogu da izmenim dozvole za');
DEFINE ('_DEFL_ADDIP', 'Dodavanje IP-ja');
DEFINE ('_DEFL_DELETEIP', 'Brisanje IP-ja');
DEFINE ('_DEFL_BLOCKEDIPS', 'Blokirani IP-jevi');
DEFINE ('_DEFL_IPRANGES', 'IP opseg');
DEFINE ('_DEFL_ADDRANGE', 'Dodavanje IP opsega');
DEFINE ('_DEFL_DELRANGE', 'Brisanje IP opsega');
DEFINE ('_DEFL_RANGEHELP', 'Da biste blokirali određenu mrežu, provajdera, ili čak celu zemlju, Zaštitnik Vam daje mogućnost 
dodavanja IP opsega. Svaki opseg se sastoji iz 2 dela, odvojena donjom crtom (_). Prvi deo 
je početak ip adrese, a drugi je kraj ip adrese. Zaštitnik će blokirati svaki ip između ove dve vrednosti.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Primeri upotrebe');
DEFINE ('_DEFL_BLOCKFROM', 'će blokirati IP-jeve od');
DEFINE ('_DEFL_BLOCKTO', 'do');
DEFINE ('_DEFL_ALLOWIPS', 'Dozvoljene IP adrese');
DEFINE ('_DEFL_ALLOWIPSD', 'Ukoliko je uključeno, moći ćete da odredite IP kojima će biti omogućen pristup administraciji ili javnom interfejsu');
DEFINE ('_DEFL_FRONTBACK', 'Javni i administratorski interfejs.');
DEFINE ('_DEFL_ALLOWDIS', 'Dozvoljeni IP-jevi su isključeni');
DEFINE ('_DEFL_ONLACCADM', 'Samo donje IP adrese imaju pristup administraciji');
DEFINE ('_DEFL_ONLACCSAD', 'Samo donje IP adrese imaju pristup javnom interfejsu i administraciji');

?>
