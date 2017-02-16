<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Frank Gijsels
* @link: http://elxis.onsnet.be
* @email: elxis@onsnet.be
* @description: Dutch language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Selecteer een map';
public $A_CMP_INS_UPF = 'Upload Pakket Bestand';
public $A_CMP_INS_PF = 'Pakket Bestand';
public $A_CMP_INS_UFI = 'Upload Bestand en Installeer';
public $A_CMP_INS_FDIR = 'Installeer vanuit map';
public $A_CMP_INS_IDIR = 'Installatie Map';
public $A_CMP_INS_DOIN = 'Installeer';
public $A_CMP_INS_CONT = 'Verder gaan...';
public $A_CMP_INS_NF = 'Installeerder niet gevonden voor element ';
public $A_CMP_INS_NA = 'Installeerder niet beschikbaar voor element';
public $A_CMP_INS_EFU = 'De installeerder kan niet verder gaan vooraleer bestand uploads zijn ingeschakeld.';
public $A_CMP_INS_ERTL = 'Installeerder - Fout';
public $A_CMP_INS_ERZL = 'De installeerder kan niet verder gaan vooraleer zlib is geïnstalleerd';
public $A_CMP_INS_ERNF = 'Geen bestand geselecteerd';
public $A_CMP_INS_ERUM = 'Upload nieuwe module - fout';
public $A_CMP_INS_UPTL = 'Upload ';
public $A_CMP_INS_UPE1 = ' - Upload Mislukt';
public $A_CMP_INS_UPE2 = ' -  Upload Fout';
public $A_CMP_INS_SUCC = 'Succes';
public $A_CMP_INS_ER = 'Fout';
public $A_CMP_INS_ERFL = 'Mislukt';
public $A_CMP_INS_UPNW = 'Upload Nieuw ';
public $A_CMP_INS_FP = 'Het wijzigen van de rechten van het geuploade bestand is mislukt.';
public $A_CMP_INS_FM = 'Verplaatsen van het geuploade bestand naar de <code>/media</code> map is mislukt.';
public $A_CMP_INS_FW = 'Upload mislukt omdat de <code>/media</code> map niet schrijfbaar is.';
public $A_CMP_INS_FE = 'Upload mislukt omdat de <code>/media</code> map niet bestaat.';
public $A_CMP_INST_ERUNR = 'Onherstelbare fout';
public $A_CMP_INST_EREXT = 'Fout bij uitpakken';
public $A_CMP_INST_ERMXM = '<strong>FOUT:</strong> Kon geen Elxis XML set-up bestand vinden in het pakket';
public $A_CMP_INST_ERXML = '<strong>FOUT:</strong> Kon geen XML set-up bestand vinden in het pakket';
public $A_CMP_INST_ERNFN = 'Geen bestandsnaam opgegeven';
public $A_CMP_INST_ERVLD = 'is geen geldig Elxis installatie bestand';
public $A_CMP_INST_ERINC = 'De functie installeer kan niet door een class aangeroepen worden';
public $A_CMP_INST_ERUIC = 'De functie deïnstalleer kan niet door een class aangeroepen worden';
public $A_CMP_INST_ERIFN = 'Installatie bestand niet gevonden';
public $A_CMP_INST_ERSXM = 'Het XML set-up bestand is niet voor een';
public $A_CMP_INST_ERCDR = 'Aanmaken map is mislukt';
public $A_CMP_INST_FNOTE = 'bestaat niet!';
public $A_CMP_INST_TAFC = 'Er bestaat reeds een bestand genaamd'; 
public $A_CMP_INST_AYIT = '- Probeer je dezelfde CMT twee keer te installeren?';
public $A_CMP_INST_FCPF = 'Kopiëren bestand is mislukt';
public $A_CMP_INST_CPTO = 'naar';
public $A_CMP_INST_UNINSTALL = 'Deïnstalleer';
public $A_CMP_INST_CUDIR = 'Deze map wordt reeds gebruikt door een andere component';
public $A_CMP_INST_SQLER = 'SQL Fout';
public $A_CMP_INST_CCPHP = 'Kon het PHP installatie bestand niet kopiëren.';
public $A_CMP_INST_CCUNPHP = 'Kon het PHP deïnstallatie bestand niet kopiëren.';
public $A_CMP_INST_UNERR = 'Deïnstalleren -  fout';
public $A_CMP_INST_THCOM = 'Component';
public $A_CMP_INST_ISCOR = 'is een core component, en kan niet gedeïnstalleerd worden.<br />Je moet dit component depubliceren als je het niet wil gebruiken.';
public $A_CMP_INST_XMLINV = 'XML Bestand is ongeldig';
public $A_CMP_INST_OFEMP = 'Optie veld is leeg, kan de bestanden niet verwijderen';
public $A_CMP_INST_INCOM = 'Geïnstalleerde bestanden';
public $A_CMP_INST_CURRE = 'Voor het moment geïnstalleerd';
public $A_CMP_INST_MENL = 'Component Menu Link';
public $A_CMP_INST_AUURL = 'Auteur URL';
public $A_CMP_INST_NCOMP = 'Er zijn geen componenten geïnstalleerd';
public $A_CMP_INST_INSCO = 'Installeer een Nieuw Component';
public $A_CMP_INST_DELE = 'Verwijderen';
public $A_CMP_INST_LIDE = 'Taal id is leeg, kan geen bestanden verwijderen';
public $A_CMP_INST_ALL = 'alle';
public $A_CMP_INST_BKLM = 'Terug naar Taal beheerder';
public $A_CMP_INST_NWLA = 'Installeer een Nieuwe Taal';
public $A_CMP_INST_NFMM = 'Er is geen enkel bestand gemarkeerd als bot bestand';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'bestaat reeds!';
public $A_CMP_INST_IOID = 'Ongeldig object id';
public $A_CMP_INST_FFEM = 'Map veld is leeg, kan geen bestanden verwijderen';
public $A_CMP_INST_DXML = 'Verwijderen XML Bestand';
public $A_CMP_INST_ICMO = 'is een core component, en kan niet gedeïnstalleerd worden.<br />Je moet dit component depubliceren als je het niet wil gebruiken.';
public $A_CMP_INST_IMBT = 'Geïnstalleerde Bots';
public $A_CMP_INST_OMBT = 'Enkel de Bots die kunnen gedeïnstalleerd worden getoond - sommige Core Bots kunnen niet verwijderd worden.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Type';
public $A_CMP_INST_NMBT = 'Er zijn geen non-core, aangepaste bots geïnstalleerd.';
public $A_CMP_INST_INMT = 'Installeer nieuwe Bots';
public $A_CMP_INST_UCTP = 'Onbekend cliënt type';
public $A_CMP_INST_NFMD = 'Geen bestand is gemarkeerd als module bestand';
public $A_CMP_INST_MODULE = 'Module';
public $A_CMP_INST_ICMDL = 'is een core module en kan niet gedeïnstalleerd worden.<br />Je moet het depubliceren als je het niet wil gebruiken';
public $A_CMP_INST_IMDL = 'Geïnstalleerde Modules';
public $A_CMP_INST_OMDL = 'Enkel de modules die kunnen gedeïnstalleerd worden, worden getoond - sommige Core Modules kunnen niet verwijderd worden.';
public $A_CMP_INST_MDLF = 'Module Bestand';
public $A_CMP_INST_NMDL = 'Er zijn geen aangepaste modules geïnstalleerd';
public $A_CMP_INST_NWMDL = 'Installeer nieuwe Modules';
public $A_CMP_INST_ALLC = 'Alle';
public $A_CMP_INST_STMDL = 'Website Modules';
public $A_CMP_INST_ADMDL = 'Admin Modules';
public $A_CMP_INST_DDEX = 'Map bestaat niet, kan bestanden niet verwijderen';
public $A_CMP_INST_TIDE = 'Template id is leeg, kan bestanden niet verwijderen';
public $A_CMP_INST_TINS = 'Installeer nieuwe Template';
public $A_CMP_INST_BATP = 'Terug naar Templates';
public $A_CMP_INST_INSBR = 'Installeer nieuwe Brug';
public $A_CMP_INST_BABR = 'Terug naar Bruggen';
public $A_CMP_INST_ΒIDE = 'Brug id leeg, kan bestanden niet verwijderen';
public $A_INST_INCOM = 'Mogelijke incompatibiliteit gedetecteerd tussen de Elxis versie die je gebruikt en de geïnstalleerde extentie. 
Buiten dit zal de software mogelijk zonder fouten werken. Dit is enkel een mededeling.';
public $A_INST_INCOMJOO = 'Installatie pakket is voor Joomla CMS!';
public $A_INST_INCOMMAM = 'Installatie pakket is voor Mambo CMS!';
public $A_INST_OLDER = 'Installatie pakket is voor een oudere Elxis versie (%s) dan de uwe (%s)';
public $A_INST_NEWER = 'Installatie pakket is voor een nieuwere Elxis versie (%s) dan de uwe (%s)';
//2009.0
public $A_INST_DOINEDC = 'Download en installeer van Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = 'Haal lijst met beschikbare extenties op';
public $A_INST_MORE = 'Meer';
public $A_INST_LESS = 'Minder';
public $A_INST_SIZE = 'Grootte';
public $A_INST_DOWNLOAD = 'Download';
public $A_INST_DOWNLOADS = 'Downloads';
public $A_INST_DOWNINST = 'Download en installeer';
public $A_INST_LICENSE = 'Licentie';
public $A_INST_COMPAT = 'Compatibiliteit';
public $A_INST_DATESUB = 'Datum verzonden';
public $A_INST_SUREINST = 'Ben je zeker dat je %s wil installeren?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Actueel';
public $A_INST_OUTDATED = 'Achterhaald';
public $A_INST_INSTVERS = 'Geïnstalleerde versie';
public $A_INST_UNLOAD = 'Lossen';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed."; //translators help: filled in be extension type (i.e. module)

}

?>