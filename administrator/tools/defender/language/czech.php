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
* @description: Czech language for Defender tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );


define('_DEFL_CONFIG', 'Konfigurace Elxis Defenderu');
define('_DEFL_CONFPERMSUCC', 'Konfigurační složka Defenderu úspěšně nastavena na');
define('_DEFL_CONFPERMNO', 'Nemožné nastavit práva pro zápis do konfigurační složky Defenderu');
define('_DEFL_LOGSPERMSUCC', 'Adresář Defender logů úspěšně nastaven na');
define('_DEFL_LOGSPERMNO', 'Nemožné nastavit práva pro zápis do adresáře logů Defenderu');
define('_DEFL_ENABLEDESC', 'Povolit nebo zakázat Defender (nejdříve se ujistěte, že do adresáře /administrator/tools/defender/logs má práva pro zápis)');
define('_DEFL_PROTVARS', 'Chráněné proměnné');
define('_DEFL_PROTVARSD', 'Zvol typ proměnných k ochraně (standartně: REQUEST)');
define('_DEFL_LOGATTACKS', 'Logovat útoky');
define('_DEFL_LOGATTACKSD', 'Pokud je povoleno, Defender bude vytvářet a logovat zprávy každého útoku');
define('_DEFL_MAILALERT', 'Mail pohotovost');
define('_DEFL_MAILALERTD', 'Pokud je povoleno, Defender bude posílat E-mail výstrahu každého útoku');
define('_DEFL_MAILADDR', 'Oznamovací e-mail adresa');
define('_DEFL_SITEOFFFOR', 'Síť offline na');
define('_DEFL_SECONDS', 'sekund');
define('_DEFL_SITEOFFD', 'Po útoku vypne stránky na X sekund. 0 ke zrušení');
define('_DEFL_BLOCKIP', 'Blokovat IP');
define('_DEFL_BLOCKIPD', 'Blokovat útočníkovu IP adresu. Dávejte pozor, Defender bude blokovat kohokoli považovaného za útočníka, včetně vás!');
define('_DEFL_FILTERS', 'Filtry');
define('_DEFL_FILTHELP', '<b>Elxis Defender je zbytečný bez filtrů.</b><br />
	K přidání nového filtru vložte slova nebo fráze tak, jak je chcete vyfiltrovat do přidávajícího pole a klikněte na <b>Přidat</b>.<br />
	Neobtěžujte se psát velká nebo malá písmena, na nich nezáleží.<br />
	Klikni <b>Smazat</b> k odebrání filtru ze seznamu.<br />
	Pokud máte přístup k <b>mod_Security</b> v Apachi myslete na to, že funkce Elxis Defenderu je víceméně ten samý způsob, 
	, když přidáváte filtry.<br />
	Po dokončení klikni <b>Uložit</b> k uložení konfigurace a filtrů Defenderu.<br />');
define('_DEFL_SLOWDOWNT', 'Zpomalit čas');
define('_DEFL_SLOWDOWN', 'Používání Elxis Defenderu zpomaluje Elxis systém (stránky). 
	Přídáváním velkého množství filtrů můžete příliš zvýšit čas vykonávání php scriptů. Doporučujeme nepřídávat více než 15 filtrů 
	, ale také můžete experimentovat, protože závisí na webhostingu a serveru. 
	Pokud vám to připadá obtížné, vyhledejte pomoc. 
	Naše testy ukázaly zpomalení o <b>0.1 do 27 msec</b> závisející na počtu filtrů (od 10 až do 30) 
	a vstup proměnných, které měl Defender velmi mnoho (od normálního prohlížení, k odesílání velkých článků přes POST a GET metodu).');
define('_DEFL_EXAMPLEFIL', 'Příklady filtrů');
define('_DEFL_DEFCONFIS', 'Konfigurační soubor Defenderu je');
define('_DEFL_DEFLOGSIS', 'Logovací adresář Defenderu je');
define('_DEFL_MAKEWRITE', 'Nastavte na zapisovatelné');
define('_DEFL_CONFSAVESUCC', 'Konfigurace Defenderu úspěšně uložena!');
define('_DEFL_CONFSAVENO', 'Není možné uložit konfiguraci Defenderu!');
define('_DEFL_ERRONEFILT', 'Error: Nejdříve musíte přidat alespoň jeden filter!');
define('_DEFL_ENCKEY', 'Šifrovací klíč');
define('_DEFL_ENCKEYD', 'Používán k šifrování logovacích informací. Délka klíče musí být mezi 8 a 32 znaky. Smažte všechny logovací informace před změnou šifrovacího klíče!');
define('_DEFL_ERRENCKEY', 'Error: Délka šifrovacího klíče musí být mezi 8 a 32 znaky');
define('_DEFL_ENABLEDEF', 'Povolit Defender');
define('_DEFL_DISABLEDEF', 'Zrušit Defender');
define('_DEFL_VIEWLOGS', 'Zobrazit Logy');
define('_DEFL_CLEARLOGS', 'Smazat Logy');
define('_DEFL_VIEWBLOCK', 'Ukázat Blokované IP');
define('_DEFL_CLEARBLOCK', 'Smazat Blokované IP');
define('_DEFL_DEFENDER', 'Elxis Defender');
define('_DEFL_LOGSCLEARED', 'Logy smazány');
define('_DEFL_CNOTCLLOGS', 'Není možné smazat logy. Ujistěte se, zda soubor je nastaven na zapisovatelný.');
define('_DEFL_BLOCKCLEARED', 'Všechny blokované IP adery úspěšně smazány');
define('_DEFL_CNOTCLBLOCK', 'Není možné smazat blokované IP adresy. Ujistěte se, zda soubor je nastaven na zapisovatelný.');
define('_DEFL_SUBMITALERT', 'Předkládání filtrů při zapnutém Defenderu je povoleno, budete upozorňováni na útok! Prosím nejdřív zrušte Defender, proveďte vaše změny a znovu Defender povolte');
define('_DEFL_GEOLOCATE', 'Geo Lokace');
define('_DEFL_PERMSUCC', 'Oprávnění změněno na');
define('_DEFL_PERMFAIL', 'Nemůžete změnit oprávnění');
define('_DEFL_ADDIP', 'Přidat IP');
define('_DEFL_DELETEIP', 'Smazat IP');
define('_DEFL_BLOCKEDIPS', 'Blokované IP');
define('_DEFL_IPRANGES', 'IP Rozmezí');
define('_DEFL_ADDRANGE', 'Přidat IP rozsah');
define('_DEFL_DELRANGE', 'Smazat IP rozsah');
define('_DEFL_RANGEHELP', 'K blokování kompletní sítě, internetových správců nebo dokonce státu Defender má 
volbu přidání IP rozsahu. Každý rozsah obsahuje 2 části oddělené podtržítkem (_). První část 
je začátek IP adresy a druhá část konec IP adresy. Defender bude blokovat každou IP adresu mezi těmito 2 hodnotami.');
define('_DEFL_RANGEEXAMPLES', 'Příklady');
define('_DEFL_BLOCKFROM', 'bude blokovat IP adresy od');
define('_DEFL_BLOCKTO', 'do');
define('_DEFL_ALLOWIPS', 'Povolené IP adresy');
define('_DEFL_ALLOWIPSD', 'Pokud je povoleno, budete mít oprávnění nastavit IP adresy, které budou mít přístup pouze do administrace a/nebo na oficiální stránky');
define('_DEFL_FRONTBACK', 'Frontend a Admin.');
define('_DEFL_ALLOWDIS', 'Povolené IP je zrušeno');
define('_DEFL_ONLACCADM', 'Pouze IP adresy níže mají přístup do Administrace');
define('_DEFL_ONLACCSAD', 'Pouze IP adresy níže mají přístup na stránky i do Administrace');

?>