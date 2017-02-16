<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Jádro';
public $A_ASTATS = 'Statistiky administrace';
public $A_VALUE = 'Hodnota';
public $A_LASTMOD = 'Poslední úprava';
public $A_OS = 'Operační Systém';
public $A_ELXIS_VERSION = 'Elxis verze';
public $A_SELECT = 'Zvolit';
public $NOEDITSYS = 'Nemáte oprávnění editovat systémové položky';
public $A_RESTORE = 'Obnovit';
public $SOFTDISK_HELP = 'SoftDisk je virtuální paměťová oblast pro proměnné a parametry jakéhokoliv druhu.<br />
  	Můžete přidávat nové nebo editovat stávající položky, kromě systémových. 
	Také položky označené jako "Netabulkované" lze editovat. Pro jména SoftDisk sekcí a hodnot 
	můžete použít pouze <strong>latinská písmena, čísla a podtržítko (_)</strong>.';
public $YCNOTEDITP = 'Parametr nelze editovat';
public $UNDELETABLE = 'Netabulkované';
public $SOFTENTRYEXIST = 'SoftDisk vstup s tímto jménem již existuje!';
public $INVSECTNAME = 'Chybné jméno sekce!';
public $INVNAME = 'Invalid name!';
public $INVEMAIL = 'Vložená hodnota není validní emailová adresa!';
public $INVURL = 'Vložená hodnota není validní URL!';
public $INVDEC = 'Vložená hodnota není validní číslo!';
public $INVTSTAMP = 'Vložená hodnota není validní UNIX časová značka!';
public $UPSYSTEM = 'Aktualizovat systém';
public $A_USERPROFILE = 'Uživatelský profil';
public $UPROF_WEBSITE = 'Webstránka';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Telefon';
public $UPROF_MOBILE = 'Mobil';
public $UPROF_BIRTHDATE = 'Datum narození';
public $UPROF_GENDER = 'Pohlaví';
public $UPROF_LOCATION = 'Lokalita';
public $UPROF_OCCUPATION = 'Povolání';
public $UPROF_SIGNATURE = 'Podpis';
public $UPROF_ARTICLES = 'Počet článků';
public $UPROF_USERGROUP = 'Uživatelská skupina';
public $UPROF_RANDUSERS = 'Zobrazení náhodných uživatelů na stránce profilu';
public $SUBMIT_CATEGORIES = 'Kategorie do kterých může uživatel navrhnout (přidat) obsah. Nevyplněné jsou povolená. (Kategorie ID, oddělené čárkou)';
public $SUBMIT_SECTIONS = 'Sekce do kterých může uživatel navrhnout (přidat) obsah. Nevyplněné jsou povolená. (Kategorie ID, oddělené čárkou)';
public $REG_AGREE = 'ID autonomní stránky registrační dohody. Nula (0) pro zakázání. Pro specifikaci jazyka registrační dohody vytvořte oddělené vstupy REG_AGREE_LANGUAGE-HERE pro každý jazyk';
public $A_WEBLINKS = 'Odkazy';
public $TOP_WEBLINK = 'Určuje zobrazení nebo nezobrazení Top odkazy uvnitř komponenty odkazy';
public $A_USERSLIST = 'Uživatelský seznam';
public $ULIST_ONLINE = 'Online status';
public $ULIST_USERNAME = 'Uživatelské jméno';
public $ULIST_NAME = 'Jméno';
public $ULIST_REGDATE = 'Datum registrace';
public $ULIST_PREFLANG = 'Preferovaný jazyk';
public $STATICCACHE = 'Statická cache';

}

?>