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
* @description: German language for component bridge
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_BRI_SYSDISABLED = 'Bridge System ist deaktiviert!';
public $A_CMP_BRI_INVBRIDGE = 'Ungültige Bridge';
public $A_CMP_BRI_BRISUCPUB = 'Bridge erfolgreich veröffentlicht';
public $A_CMP_BRI_BRISUCUNPUB = 'Bridge erfolgreich gesperrt';
public $A_CMP_BRI_CNOTPUBBRI = 'Konnte die Bridge nicht veröffentlichen';
public $A_CMP_BRI_CNOTUNPUBRI = 'Konte die Bridge nicht sperren';
public $A_CMP_BRI_CNOTSAVESETS = 'Konnte die Einstellungen nicht speichern!';
public $A_CMP_BRI_UNPUBBRIFIRST = 'Sperren sie die Bridge zuerst!';
public $A_CMP_BRI_BRIUNISTSUC = 'Bridge erfolgreich deinstalliert';
public $A_CMP_BRI_CNOTUNISTBRI = 'Konnte Bridge nicht deinstallieren. Bitte prüfen sie die Verzeichnisrechte.';
public $A_CMP_BRI_CNOTDETREGV = 'Aktuelle Registry-Version konnte nicht ermittelt werden!';
public $A_CMP_BRI_CNOTUPDREG = 'Registry konnte nicht aktualisiert werden!';
public $A_CMP_BRI_REGSUCUPTO = 'Registry erfolgreich aktualisiert auf Version';
public $A_CMP_BRI_REGINIUNWR = 'registry.ini ist nicht beschreibbar!';
public $A_CMP_BRI_REGUPTODATE = 'Registry ist bereits aktuell!';
public $A_CMP_BRI_BRIUNPUB = 'Bridge ist gesperrt!';
public $A_CMP_BRI_CNOTLOCXML = 'Konnte die Bridge XML Datei nicht finden!';
public $A_CMP_BRI_BNOTHAVECFI = 'Bridge %s hat keine Konfigurationsdatei';
public $A_CMP_BRI_BNOTHAVECPA = 'Bridge %s hat keine Konfigurationsparameter!';
public $A_CMP_BRI_DETINVPARAMS = 'Ungültige Parameter gefunden!';
public $A_CMP_BRI_INSTBRI = 'Installierte Bridges';
public $A_CMP_BRI_SYSENABLED = 'Bridge System ist aktiviert';
public $A_CMP_BRI_REGVERSION = 'Registry Version';
public $A_CMP_BRI_DETREGERRUP = 'Registry Fehler gefunden. Bitte aktualisieren sie die Bridge Registry!';
public $A_CMP_BRI_UPDATE = 'Aktualisiere';
public $A_CMP_BRI_REGERR = 'Registry Fehler';
public $A_CMP_BRI_LICENSE = 'Lizenz';
public $A_CMP_BRI_UNIST = 'Deinstallieren';
public $A_CMP_BRI_DISBRISYS = 'Deaktiviere Bridge System';
public $A_CMP_BRI_ENBRISYS = 'Aktiviere Bridge System';
public $A_CMP_BRI_REGMOD = 'Registrierungs-Modul';
public $A_CMP_BRI_REGMODHELP = 'Wählen sie bitte, welche Anwendung als primäres Anmelde/Registrierungssystem benutzt werden soll.';
public $A_CMP_BRI_REGMODHELP2 = 'Sie können wählen zwischen Elxis und veröffentlichen Bridges.';
public $A_CMP_BRI_REGMODHELP3 = 'Einige Bridges haben KEINE Anmelde/Registrierungsfunktion.';
public $A_CMP_BRI_REGMODHELP4 = 'Vergessen sie nicht, das Registrierungsmodul der Bridge an Stelle des klassischen zu verwenden.';
public $A_CMP_BRI_NOTE = 'Notiz';

}

?>
