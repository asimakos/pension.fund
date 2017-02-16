<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: English language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Prosím, zvolte adresář';
public $A_CMP_INS_UPF = 'Uploadovat souborový balíček';
public $A_CMP_INS_PF = 'Souborový balíček';
public $A_CMP_INS_UFI = "Uploadovat soubor &amp; instalovat";
public $A_CMP_INS_FDIR = 'Instalovat z adresáře';
public $A_CMP_INS_IDIR = 'Instalační adresář';
public $A_CMP_INS_DOIN = 'Instalovat';
public $A_CMP_INS_CONT = 'Pokračovat...';
public $A_CMP_INS_NF = 'Instalátor nenalezl součást pro ';
public $A_CMP_INS_NA = 'Instalátor nenalezl součást pro ';
public $A_CMP_INS_EFU = 'Instalátor nemůže pokračovat v uploadování souboru. Prosím, instalujte soubor pomocí metody instalace z adresáře.';
public $A_CMP_INS_ERTL = 'Instalátor - chyba';
public $A_CMP_INS_ERZL = 'Instalátor nemůže pokračovat';
public $A_CMP_INS_ERNF = 'Není zvolen soubor';
public $A_CMP_INS_ERUM = 'Uploadovat nový soubor - chyba';
public $A_CMP_INS_UPTL = 'Upload ';
public $A_CMP_INS_UPE1 = ' - Uploadování se nezdařilo';
public $A_CMP_INS_UPE2 = ' -  Chyba uploadování';
public $A_CMP_INS_SUCC = 'Úspěšné';
public $A_CMP_INS_ER = 'Chyba';
public $A_CMP_INS_ERFL = 'Neúspěšné';
public $A_CMP_INS_UPNW = 'Nový upload ';
public $A_CMP_INS_FP = 'Chyba - nelze změnit práva uploadovaného souboru.';
public $A_CMP_INS_FM = 'Selhal přesun souboru do  <code>/media</code> adresáře.';
public $A_CMP_INS_FW = 'Upload selhal, adresář <code>/media</code> nemá práva zápisu.';
public $A_CMP_INS_FE = 'Upload selhal, adresář <code>/media</code> neexistuje.';
public $A_CMP_INST_ERUNR = 'Neopravitelná chyba';
public $A_CMP_INST_EREXT = 'Extrahování selhalo';
public $A_CMP_INST_ERMXM = '<strong>CHYBA:</strong> Nenalezen Elxis XML setup soubor v instalačním balíčku';
public $A_CMP_INST_ERXML = '<strong>CHYBA:</strong> Nenalezen Elxis XML setup soubor v instalačním balíčku';
public $A_CMP_INST_ERNFN = 'Není uvedeno jméno souboru';
public $A_CMP_INST_ERVLD = 'není validní s Elxis instalačním souborem';
public $A_CMP_INST_ERINC = 'Metoda instalace nemůže být volána třídou';
public $A_CMP_INST_ERUIC = 'Metoda odinstalace nemůže být volána třídou';
public $A_CMP_INST_ERIFN = 'Nenalezen instalační soubor';
public $A_CMP_INST_ERSXM = 'XML setup soubor není pro';
public $A_CMP_INST_ERCDR = 'Neúspěšné vytvoření adresáře';
public $A_CMP_INST_FNOTE = 'neexistuje!';
public $A_CMP_INST_TAFC = 'Soubor s tímto názvem již existuje';
public $A_CMP_INST_AYIT = '- Zkoušíte instalovat stejný CMT dvakrát?';
public $A_CMP_INST_FCPF = 'Chyba kopírování souboru';
public $A_CMP_INST_CPTO = 'z';
public $A_CMP_INST_UNINSTALL = 'Odinstalovat';
public $A_CMP_INST_CUDIR = 'Složku již používá jiný komponent';
public $A_CMP_INST_SQLER = 'Chyba SQL';
public $A_CMP_INST_CCPHP = 'Nelze kopírovat PHP instalační soubor.';
public $A_CMP_INST_CCUNPHP = 'Nelze kopírovat PHP odinstalační soubor.';
public $A_CMP_INST_UNERR = 'Odinstalovat -  chyba';
public $A_CMP_INST_THCOM = 'Komponent';
public $A_CMP_INST_ISCOR = 'je komponent jádra, a nemůže být odinstalována.';
public $A_CMP_INST_XMLINV = 'Chybný XML soubor';
public $A_CMP_INST_OFEMP = 'Pole výběru je prázdné, nelze odstranit soubory';
public $A_CMP_INST_INCOM = 'Nainstalované komponenty';
public $A_CMP_INST_CURRE = 'Aktuálně nainstalované';
public $A_CMP_INST_MENL = 'Menu odkaz komponenty';
public $A_CMP_INST_AUURL = 'URL autora';
public $A_CMP_INST_NCOMP = 'Nenalezeny žádné nainstalované uživatelské komponenty';
public $A_CMP_INST_INSCO = 'Instalovat nový komponent';
public $A_CMP_INST_DELE = 'Smazané';
public $A_CMP_INST_LIDE = 'Chybné ID jazyku, nemohu odstranit soubory';
public $A_CMP_INST_ALL = 'vše';
public $A_CMP_INST_BKLM = 'Zpět do správce jazyků';
public $A_CMP_INST_NWLA = 'Instalovat nový jazyk';
public $A_CMP_INST_NFMM = 'Soubor není označený jako Mambot soubor';
public $A_CMP_INST_MAMB = 'Mambot';
public $A_CMP_INST_AXST = 'již existuje!';
public $A_CMP_INST_IOID = 'Chybné ID objektu';
public $A_CMP_INST_FFEM = 'Prázdné pole složky, nelze odstranit soubory';
public $A_CMP_INST_DXML = 'Vymazání XML souboru';
public $A_CMP_INST_ICMO = 'je součást jádra, a nelze odinstalovat.';
public $A_CMP_INST_IMBT = 'Nainstalované Mamboty';
public $A_CMP_INST_OMBT = 'Jen zobrazené Mamboty mohou být odinstalovány - ostatní jsou součástí jádra Elxis.';
public $A_CMP_INST_MBT = 'Mambot';
public $A_CMP_INST_MTYP = 'Typ';
public $A_CMP_INST_NMBT = 'Nenalezeny žádné nainstalované uživatelské Mamboty.';
public $A_CMP_INST_INMT = 'Instalovat nové Mamboty';
public $A_CMP_INST_UCTP = 'Neznámý typ klienta';
public $A_CMP_INST_NFMD = 'Soubor nemá označení, jako soubor modulu';
public $A_CMP_INST_MODULE = 'Modul';
public $A_CMP_INST_ICMDL = 'je modul jádra Elxis a nemůže být odinstalován.';
public $A_CMP_INST_IMDL = 'Nainstalované moduly';
public $A_CMP_INST_OMDL = 'Pouze zobrazené moduly je možno odinstalovat - ostatní jsou součástí jádra Elxis.';
public $A_CMP_INST_MDLF = 'Soubor modulu';
public $A_CMP_INST_NMDL = 'Nenainstalovány žádné uživatelské moduly';
public $A_CMP_INST_NWMDL = 'Instalovat nový modul';
public $A_CMP_INST_ALLC = 'Vše';
public $A_CMP_INST_STMDL = 'Moduly stránek';
public $A_CMP_INST_ADMDL = 'Moduly administrace';
public $A_CMP_INST_DDEX = 'Adresář neexistuje, nelze odstranit soubory';
public $A_CMP_INST_TIDE = 'Neplatné ID šablony, soubory nelze odstranit';
public $A_CMP_INST_TINS = 'Instalovat novou šablonu';
public $A_CMP_INST_BATP = 'Zpět k šablonám';
public $A_CMP_INST_INSBR = 'Instalovat nový Bridge';
public $A_CMP_INST_BABR = 'Návrat k Bridges';
public $A_CMP_INST_ΒIDE = 'Chybné ID Bridge, soubory nelze odstranit';
public $A_INST_INCOM = 'Detekována možná neslučitelnost mezi Vaší verzí Elxis a nainstalovaným rozšířením, 
ale software může pracovat dobře a bez chyby.';
public $A_INST_INCOMJOO = 'Instalační balíček je pro Joomla CMS!';
public $A_INST_INCOMMAM = 'Instalační balíček je pro Mambo CMS!';
public $A_INST_OLDER = 'Instalační balíček je pro novější verzi Elxis (%s) než Vaše (%s)';
public $A_INST_NEWER = 'Instalační balíček je pro novější verzi Elxis (%s) než Vaše (%s)';
//2009.0
public $A_INST_DOINEDC = 'Stáhnout a instalovat z Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = 'Vyvolat seznam dostupných přípon';
public $A_INST_MORE = 'Více';
public $A_INST_LESS = 'Méně';
public $A_INST_SIZE = 'Velikost';
public $A_INST_DOWNLOAD = 'Stáhnout';
public $A_INST_DOWNLOADS = 'Stahování';
public $A_INST_DOWNINST = 'Stáhnout a instalovat';
public $A_INST_LICENSE = 'Licence';
public $A_INST_COMPAT = 'Kompaktibilita';
public $A_INST_DATESUB = 'Datum přidání';
public $A_INST_SUREINST = 'Opravdu hodláte nainstalovat %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Osvěžený';
public $A_INST_OUTDATED = 'Zastaralý';
public $A_INST_INSTVERS = 'Nainstalovaná verze';
public $A_INST_UNLOAD = 'Vyložit';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Verze šek vrátil nic.<br />
	S největší pravděpodobností nemáte žádné třetí straně %s nainstalován."; //translators help: filled in be extension type (i.e. module)

}

?>