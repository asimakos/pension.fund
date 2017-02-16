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
* @description: Dutch language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Core';
public $A_ASTATS = 'Administratie Statistieken';
public $A_VALUE = 'Waarde';
public $A_LASTMOD = 'Laatst gewijzigd';
public $A_OS = 'Besturings Systeem';
public $A_ELXIS_VERSION = 'Elxis versie';
public $A_SELECT = 'Selecteer';
public $NOEDITSYS = 'Het is niet toegelaten om systeem ingangen te bewerken';
public $A_RESTORE = 'Herstellen';
public $SOFTDISK_HELP = 'SoftDisk is een virtueel opslag gebied voor variabelen en parameters van alle soorten.<br />
  	Je kan nieuwe SoftDisk items toevoegen, bestaande SoftDisk items bewerken of verwijderen. Systeem items kunnen niet bewerkt/verwijderd worden. 
	Items gemarkeerd als "Onverwijderbaar" kunnen enkel bewerkt worden. Voor het benoemen van SoftDisks secties en waarden 
	is het enkel toegelaten om <strong>letters, cijfers en onderstrepingstekens (_)</strong> te gebruiken.';
public $YCNOTEDITP = 'Je kan deze parameter niet wijzigen';
public $UNDELETABLE = 'Onverwijderbaar';
public $SOFTENTRYEXIST = 'Er is reeds een SoftDisk item met die naam!';
public $INVSECTNAME = 'Ongeldige sectie naam!';
public $INVNAME = 'Ongeldige naam!';
public $INVEMAIL = 'Gegeven waarde is geen geldig email adres!';
public $INVURL = 'Gegeven waarde is geen geldige URL!';
public $INVDEC = 'Gegeven waarde is geen decimaal getal!';
public $INVTSTAMP = 'Gegeven waarde is geen geldige UNIX tijdstempel!';
public $UPSYSTEM = 'Update systeem';
public $A_USERPROFILE = 'Gebruikers profiel';
public $UPROF_WEBSITE = 'Website';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Telefoon';
public $UPROF_MOBILE = 'GSM';
public $UPROF_BIRTHDATE = 'Geboorte datum';
public $UPROF_GENDER = 'Geslacht';
public $UPROF_LOCATION = 'Locatie';
public $UPROF_OCCUPATION = 'Beroep';
public $UPROF_SIGNATURE = 'Handtekening';
public $UPROF_ARTICLES = 'Aantal artikelen';
public $UPROF_USERGROUP = 'Gebruikers groep';
public $UPROF_RANDUSERS = 'Toon willekeurige gebruikers in profiel pagina';
public $USERS_RPASSMAIL = 'Breng administrator op de hoogte als er een paswoord herinnering is verzonden';
public $SUBMIT_CATEGORIES = 'Categorieën waar artikelen mogen ingezonden worden. Als leeg, dan zijn alle categorieën toegelaten. (Categorie IDs, komma gescheiden)';
public $SUBMIT_SECTIONS = 'Secties waar artikelen mogen ingezonden worden. Als leeg, dan zijn alle categorieën toegelaten. (Categorie IDs, komma gescheiden)';
public $REG_AGREE = 'Registratie overeenkomst alleenstaande pagina ID. Nul (0) om uit te schakelen. Voor taal afhankelijke overeenkomst, maak een SoftDisk ingang voor elke taal genaamd REG_AGREE_LANGUAGE-HERE in de sectie GEBRUIKERS van het type Integer';
public $A_WEBLINKS = 'Weblinks';
public $TOP_WEBLINK = 'Bepaald de weergave van de module Top Weblinks in de component weblinks';
public $A_USERSLIST = 'Gebruikers lijst';
public $ULIST_ONLINE = 'Online status';
public $ULIST_USERNAME = 'Gebruikersnaam';
public $ULIST_NAME = 'Naam';
public $ULIST_REGDATE = 'Registratie datum';
public $ULIST_PREFLANG = 'Voorkeur taal';
public $STATICCACHE = 'Statische cache';

}

?>