<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German language for component weblinks
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_WBL_MANAGER = 'Weblinks-Verwaltung';
public $A_CMP_WBL_APPROVED = 'Geprüft';
public $A_CMP_WBL_MUSTTITLE = 'Weblink Item muss einen Titel haben';
public $A_CMP_WBL_MUSTCATEG = 'Sie müssen eine Kategorie wählen.';
public $A_CMP_WBL_YMHURL = 'Sie müssen eine URL haben.';
public $A_CMP_WBL_WEBLNK = 'Weblink';
public $A_CMP_WBL_MUSTURL = 'Bildschirmfoto';
public $A_CMP_WBL_SSHOTDESC = 'Nur benutzen wenn kein Bildschirmfoto für diesen Link verfügbar ist.';
public $A_CMP_WBL_EDITCAT = 'Kategorie bearbeiten';
public $A_CMP_WBL_EDITWL = 'Weblinks bearbeiten';
public $A_CMP_WBL_SCRNO = 'Bildschirmfoto nicht anzeigen';
public $A_CMP_WBL_SCRLOC = 'Lokales Bild verwenden';
public $A_CMP_WBL_SCRINT = 'Neues Bild aus dem Internet laden';
public $A_CMP_WBL_COPYDESC = "Klicken sie auf die folgenden Schalter um ein Bildschirmfoto aus einer verfügbaren Webquelle zu erhalten. 
	Wenn diese Option aktiviert ist, erhalten sie nach dem Speichern eine Kopie des Weblink Bildschirmfotos in ihr Verzeichnis (images/screenshots/).";
public $A_CMP_WBL_SCRRECFROM = 'Bildschirmfoto erhalten von';
public $A_CMP_WBL_INVSOURCE = 'Ungültige Quelle gefunden';
public $A_CMP_WBL_INVURL = 'Ungültige Weblink URL gefunden';
public $A_CMP_WBL_DIRNOWRITE = 'Verzeichnis images/screenshots/ ist nicht beschreibbar. Bildschirmfoto kann nicht gespeichert werden!';
public $A_CMP_WBL_NOTCLICKED = 'Sie haben bisher nichts angeklickt';

}

?>
