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
* @description: Czech language for Chmod tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );


define('_CMOD_CHMOD', 'Změnit mód');
define('_CMOD_PATH', 'Cesta');
define('_CMOD_MSGSERVER', 'Zpráva ze serveru');
define('_CMOD_PATHNOTEXIST', 'Cesta neexistuje!');
define('_CMOD_PATHNOTELXIS', 'Zadaná cesta není součástí Elxis!');
define('_CMOD_NOTALLOWED1', 'Nemáte oprávnení ke změně módu na');
define('_CMOD_NOTALLOWED2FI', 'do souboru.<br>Zpřístupněním souboru nastanou problémy.');
define('_CMOD_NOTALLOWED2FO', 'do složky.<br>Zpřístupněním souboru nastanou složky.');
define('_CMOD_CHMODSUCC', 'Mód úspěšně změněn na');
define('_CMOD_CHMODCNOT', 'Není možné změnit mód na');
define('_CMOD_ONLYUNIX', 'Přístupné jen pro UNIX');
define('_CMOD_LOAD', 'Nahrát');
define('_CMOD_CHMODTO', 'Chmod na');
define('_CMOD_OWNER', 'Vlastník');
define('_CMOD_READ', 'Čtení');
define('_CMOD_WRITE', 'Zápis');
define('_CMOD_EXECUTE', 'Spouštění');
define('_CMOD_USER', 'vlastník');
define('_CMOD_GROUP', 'skupina');
define('_CMOD_WORLD', 'ostatní');
define('_CMOD_SHOWHELP', 'Ukázat Help');
define('_CMOD_HIDEHELP', 'Skrýt Help');
define('_CMOD_HELPTEXT', 'Napište úplnou cestu do existujícího souboru nebo složky Elxis systému. 
	Stiskněte Nahrát, pokud chcete vidět existující oprávnění a vlastníka pro danou cestu. 
	Pro změnu módu dané cesty klikněte na tlačítko CHMOD. Hlavní část přístupná pouze pro Unix systémy.
	<br /><br />Doporučujeme používat následující oprávnění:<br />
	zapisovatelné složky: 0777, nezapisovatelné složky: 0755, zapisovatelné soubory: 0666, nezapisovatelné soubory: 0644');

?>