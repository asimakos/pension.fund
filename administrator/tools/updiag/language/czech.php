<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://elxis.cz
* @email: info@elxis.cz
* @description: Czech language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );


class updiagLang {

	public $UPDATE = 'Aktualizovat';
	public $CHVERS = 'Zjistit Verzi';
	public $CNOTGETELXD = 'Není možné získat data z elxis.org';
	public $INVXML = 'Získaný neplatný XML soubor. Není možné zobrazit požadované informace.';
	public $SIZE = 'Velikost';
	public $MORE = 'Více';
	public $DOWNLOAD = 'Stahuj';
	public $INSELXVER = 'Instalovaná Elxis verze';
	public $CURRENT = 'Aktuální';
	public $OUTDATED = 'Zastaralé!';
	public $NEWVERAV = 'Je přístupná novější Elxis verze. Prosím aktualizujte vaší Elxis instalaci co nejdříve.';
	public $CHPATCHES = 'Zjisti patche';
	public $NOPATCHES = 'Nejsou přístupné žádné patche pro vaší Elxis verzi';
	public $PROSUPPORT = 'Profesionální podpora';
	public $NEWS = 'Novinky';
	public $MAINTENANCE = 'Údržba';
	public $REMOTEERR1 = 'Neplatný požadavek';
	public $REMOTEERR2 = 'Není možné vypsat seznam scriptů';
	public $REMOTEERR3 = 'Žádné scripty nenalezeny';
	public $REMOTEERR4 = 'Požadovaný soubor je prázdný';
	public $REMOTEERR5 = 'Není možné vypsat seznam s hash soubory';
	public $REMOTEERR6 = 'Žádný hash soubor nenalezen';
	public $REMOTEERR7 = 'Není možné stáhnout požadovaný soubor!';
	public $UNERROR = 'Neznámý error';
	public $PROVCODE = 'Poskytne kód pro aktualizaci Elxis z verze';
	public $TOVERSION = 'na verzi';
	public $INSTALLED = 'Instalované';
	public $REQFEXISTS = 'Požadovaný soubor již existuje!';
	public $FILDOWNSUC = 'Soubor byl úspěšně stáhnut!';
	public $DFORRUNSCR = 'Nezapomeňte spustit tento script v případě, že si přejete aktualizovat vaší Elxis instalaci.';
	public $CNOTCPDFIL = 'Není možné kopírovat stažený soubor do adresáře.';
	public $PLCHSCRPERM = 'Prosím, zkontrolujte práva složky /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Prosím, zkontrolujte práva složky /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Spustit';
	public $SCRNOTEX = 'Požadovaný script neexistuje!';
	public $FSCHECK = 'Zkontroluj systém souborů';
	public $HIDEHELP = 'Skrýt help';
	public $NORMAL = 'Normální';
	public $EXTENDED = 'Rozšířený';
	public $FULL = 'Plný';
	public $NOHASHFOUND = 'Nenalezeny žádné hash soubory';
	public $INVHFILE = 'Neplatný hash soubor!';
	public $SHFELXVER = 'Zvolený hash soubor je pro starší Elxis verzi než je vaše!';
	public $FNOTEXIST = 'Soubor neexistuje';
	public $WARNING = 'Varování';
	public $FNEEDUP = 'Soubor potřebuje aktualizovat';
	public $SITUP2D = 'Síť je nejnovější!';
	public $FOUND = 'Nalezeno';
	public $OUTFUP = 'zastaralé soubory. Prosím aktualizujte!';
	public $CHFINUS = 'Kontrola aktualizací stavu používá <b>%s</b> jako zdroj';
	public $NEWRELEASES = 'Nové vydání';
	public $NONEWREL = 'Nejsou žádná nová vydání';
	public $PRICE = 'Cena';
	public $LICENSE = 'License';
	public $SECURITY = 'Bezpečnost';
	public $INSTPATH = 'Instalační cesta';
	public $CREDITS = 'Autoři';
	public $ALERT = 'Výstraha';
	public $FSECALWA = 'Nalezeno <b>%d</b> bezpečnostních výstrah a varování';
	public $ELXINPAS = 'Vaše Elxis instalace úspěšně prošla základní bezpečnostní kontrolou';
	public $HOME = 'Domů';
	public $UPDSPAG = 'Updiag Centrum';
	public $UPDWELC = 'Vítejte v <b>Updiag</b>, Elxis aktualizačním a diagnostickém nástroji.';
	public $STARTMORE = 'Většina Updiag funkcí požaduje vzdálené spojení k elxis.org. 
	Tak musíte mít přístupné spojení z vaší sítě do internetu pro práci těchto funkcí. 
	Zvolte položku z horního menu k navigaci.';
	public $BASCHECKS = 'Základní Kontroly <small>(klikni na ikonu k provedení)</small>';
	public $FILEREMSUC = 'Soubor úspěšně odebrán!';
	public $CNREMSFILE = 'Není možné odebrat zvolený soubor! Zkontrolujte práva přístupu k souboru.';
	public $HASHNOTEX = 'Požadovaný hash soubor neexistuje!';
	public $DNHASHFLS = 'Stáhnout hash soubory';
	public $BUY = 'Koupit';
	public $DOWNLTIME = 'Čas stahování';
	public $DOWNLSPEED = 'Rychlost stahování';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Pomáhá aktualizovat vaší síť, oznamuje nové vydání Elxis, verze a patche a poskytuje vám zabezpečení a diagnostické úkoly.');

?>