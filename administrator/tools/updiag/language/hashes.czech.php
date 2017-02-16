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
* @description: Czech language for Updiag tool (hashes help)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );

?>

<p align="justify">Hash je unikátní stopa souboru. Tato stopa se mění, dokonce i když soubor je upraven. 
Tímto způsobem můžeme určit jestli soubory obsahují instalaci Elxis, zda jsou nepoškozené nebo jestli jsme zmeškali 
aktualizaci nějakých souborů po aktualizaci/patchi. Hashe nám budou také pomáhat obnovit Elxis síť po útoku hackera 
nebo něčeho jiného, co může postihnout náš Elxis systém souborů. V Elxis používáme speciální způsob vypočítavé MD5 hashe. 
Tak pro každý Elxis soubor jsou 2 odlišné hashe. Když první hash kontrola selže, poté je kontrola 
provedena v tom druhém. Pokud druhý souborový hash také selže, tak Elxis usoudí, že tento soubor už byl upraven.</p>

<p align="justify">Pro každou Elxis verzi jsou zde 3 odlišné hash soubory <b>normální</b> (ideální pro funkční síť),   
<b>rozšířený</b> (ideální pro síť právě po čisté Elxis instalaci) a <b>plný</b> (použitelný pouze pro 
speciální účely). <u>Měli byste používat normální hash soubor pro funkční online stránky.</u> 
<b>Elxis Tým</b> má jedině pravomoc oprávněnou k produkování těchto hash souborů. Nepoužívejte hash soubory z 
neoprávněných zdrojů. Manuálně neupravujte nebo nepřejmenovávejte hash soubory. Můžete si stáhnout hash soubory pro Vaší 
Elxis verzi z <a href="http://www.elxis.org" target="blank">elxis.org</a> stránek.</p>

<p align="justify">K instalaci hash souboru stačí jej nahrát do hash adresáře (/administrator/tool/updiag/data/hashes). 
Můžete kdykoliv nastavit nedotknutelnost kontroly systému souborů, pro případ instalovaného hash souboru, který odpovídá Vaší 
Elxis verzi, kliknutím na tlačítko "Spustit".</p>
