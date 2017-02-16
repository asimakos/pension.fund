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
* @description: German language for component menumanager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MMA_MANAG = 'Menüverwaltung';
public $A_CMP_MMA_NAME = 'Menü Name';
public $A_CMP_MMA_MITE = 'Menü Items';
public $A_CMP_MMA_EDMN = 'Menü Name bearbeiten';
public $A_CMP_MMA_EDMITS = 'Menü Items bearbeiten';
public $A_CMP_MMA_ENTER = 'Geben sie einen Namen für ihr Menü an';
public $A_CMP_MMA_ENTEMN = 'Geben sie einen Modulnamen für ihr Menü an';
public $A_CMP_MMA_DETAIL = 'Menü Details';
public $A_CMP_MMA_TIP01 = 'Dies ist der Identifikationsname den Elxis benutzt um dieses Menü innerhalb des Codes zu identifizieren. Er muss einzigartig sein. Wir raten davon ab, Leerzeichen in ihrem Menünamen zu verwenden';
public $A_CMP_MMA_TIP02 = 'Titel des mod_mainmenu Moduls. Erforderlich um dieses Menü anzuzeigen';
public $A_CMP_MMA_TXT01 = '* Wenn sie dieses Menü speichern, wird automatisch ein neues mod_mainmenu Modul mit dem oben angegebenen Namen erzeugt. *<br/><br/>Parameter für dieses neue Modul können sie in der Modulverwaltung einstellen';
public $A_CMP_MMA_DEL = 'Menü löschen';
public $A_CMP_MMA_MODULE_DEL = 'Menü/Modul werden gelöscht';
public $A_CMP_MMA_ITEMS_DEL = 'Menü Items werden gelöscht';
public $A_CMP_MMA_WILL = '* Dadurch wird diese Modul <span style="color:#FF0000; font-weight:bold;">gelöscht</span>.';
public $A_CMP_MMA_WILL2 = '<br />Inklusive aller Inhalte und Module die damit verbunden sind *';
public $A_CMP_MMA_YOU_SURE = 'Sind sie sicher, das sie diese Menü löschen wollen? \nDadurch wird dieses Menü, seine Items und das Modul gelöscht.';
public $A_CMP_MMA_NAMEMENU = 'Bitte geben sie einen Namen für die Kopie dieses Menüs an';
public $A_CMP_MMA_ENNMNEWM = 'Bitte geben sie einen Namen für das neue Modul an';
public $A_CMP_MMA_COPY = 'Kopiere Menü';
public $A_CMP_MMA_NEW = 'Neuer Menüname';
public $A_CMP_MMA_MODNEW = 'Neuer Modulname';
public $A_CMP_MMA_COPIED = 'Menü wird kopiert';
public $A_CMP_MMA_ITMSCOP = 'Menü Items werden kopiert';
public $A_CMP_MMA_TYPE = 'Menütyp';
public $A_CMP_MMA_CANTREN = 'Dieses Menü können sie nicht umbenennen. Dadurch würde die korrekte Funktionsweise von Elxis zerstört';
public $A_CMP_MMA_UNIQUE = 'Ein Menü mit diesem Namen existiert schon - sie müssen einen eindeutigen Namen angeben';
public $A_CMP_MMA_CREATED = 'Neues Menü erstellt';
public $A_CMP_MMA_ALCDEL = 'Sie können das \'mainmenu\' nicht löschen. Es handelt sich um ein Core-Menü';
public $A_CMP_MMA_DELETED = 'Menü gelöscht';
public $A_CMP_MMA_NEWMENU = 'Neues Menü';
public $A_CMP_MMA_NEWMODU = 'Neues Modul';
public $A_CMP_MMA_COPYOF = 'Kopie von Menü';
public $A_CMP_MMA_CONSIST = 'erstellt, bestehend aus';
public $A_CMP_MMA_UPDATED = 'Menü Items & Module aktualisiert.';

}

?>
