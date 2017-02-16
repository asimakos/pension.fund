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
* @description: German language for component access manager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direker Zugriff auf diesen Ort nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ACC_GROUP = 'Gruppen';
public $A_CMP_ACC_GRUSR = 'Anzahl von Benutzern';
public $A_CMP_ACC_BCKASS = 'Backend Zugriff';
public $A_CMP_ACC_PHREN = 'Drücken und halten zum Umbenennen';
public $A_CMP_ACC_GRHIE = 'Gruppenhierarchie';
public $A_CMP_ACC_GGRNM = 'Sie müssen der Gruppe einen Namen geben';
public $A_CMP_ACC_GGNSO = 'Ihre gewählte Elterngruppe ist keine auswählbare Option';
public $A_CMP_ACC_MANG = 'Gruppen verwalten';
public $A_CMP_ACC_GDTL = 'Gruppendetails';
public $A_CMP_ACC_GNAME = 'Name der Gruppe';
public $A_CMP_ACC_PRGR = 'Elterngruppe';
public $A_CMP_ACC_EXUG = 'Existiernde Benutzergruppen';
public $A_CMP_ACC_PRMFOR = 'Rechte für';
public $A_CMP_ACC_ACO = 'ACO';
public $A_CMP_ACC_ACOV = 'ACO Wert';
public $A_CMP_ACC_AXO = 'AXO';
public $A_CMP_ACC_AXOV = 'AXO Wert';
public $A_CMP_ACC_ADNP = 'Neue Rechte hinzufügen';
public $A_CMP_ACC_ARO = 'ARO';
public $A_CMP_ACC_AROV = 'ARO Wert';
public $A_CMP_ACC_SEL = '-AUSWAHL-';
public $A_CMP_ACC_ACT = 'Aktion';
public $A_CMP_ACC_ADM = 'Administration';
public $A_CMP_ACC_WKF = 'Arbeitsablauf';
public $A_CMP_ACC_YMSGR = 'Sie müssen eine Gruppe zum Umbenennen spezifizieren';
public $A_CMP_ACC_TSAGN = 'Es gibt bereits eine Gruppe mit dem Namen';
public $A_CMP_ACC_YANARG = 'Es ist ihnen nicht erlaubt diese Gruppe umzubenennen!';
public $A_CMP_ACC_CNUTACL = 'Konnte die Tabelle _core_acl_aro_groups nicht aktualisieren';
public $A_CMP_ACC_CNUTUS = 'Konnte die Tabelle _users nicht aktualisieren';
public $A_CMP_ACC_CNUTCAL = 'Konnte die Tabelle _core_acl_access_lists nicht aktualisieren';
public $A_CMP_ACC_YHTLA = 'SIE MÜSSEN SICH ERNEUT ANMELDEN!';
public $A_CMP_ACC_MFS = 'Nachricht vom Server';
public $A_CMP_ACC_WID = 'mit der ID';
public $A_CMP_ACC_UGWID = 'Benutze Gruppe mit der ID';
public $A_CMP_ACC_RNMTO = 'Umbenannt zu';
public $A_CMP_ACC_YCNEDGR = 'Es ist ihnen nicht erlaubt diese Gruppe zu bearbeiten!';
public $A_CMP_ACC_YMSPNGR = 'Sie müssen einen Namen für diese Gruppe spezifizieren';
public $A_CMP_ACC_IPGR = 'Ungültige Elterngruppe';
public $A_CMP_ACC_YCCGPY = 'Sie können keine Gruppe anlegen, die Elterngruppe zu ihrer Gruppe ist!';
public $A_CMP_ACC_YCNUSGR = 'Es ist ihnen nicht erlaubt, diese Gruppe als Elterngruppe zu benutzen!';
public $A_CMP_ACC_TIAGTN = 'Es gibt eine andere Gruppe mit diesem Namen!';
public $A_CMP_ACC_GADDSUC = 'Gruppe erfolgreich hinzugefügt mit der ID';
public $A_CMP_ACC_CNADDNG = 'Kann neue Gruppe nicht hinzufügen.';
public $A_CMP_ACC_THGRP = 'Gruppe';
public $A_CMP_ACC_UPSUCC = 'erfolgreich aktualisiert';
public $A_CMP_ACC_CNUPGR = 'Konnte Gruppe nicht aktualisieren';
public $A_CMP_ACC_GESLAG = 'Gruppe erfolgreich bearbeitet, aber sie müssen sich neu anmelden!';
public $A_CMP_ACC_NGSDEL = 'Keine Gruppe zum Löschen ausgewählt';
public $A_CMP_ACC_YCNDELG = 'Sie können diese Gruppe nicht löschen!';
public $A_CMP_ACC_YANALDG = 'Es ist ihnen nicht erlaubt diese Gruppe zu löschen!';
public $A_CMP_ACC_CNDLGR = 'Konnte Gruppe nicht löschen';
public $A_CMP_ACC_GRSDEL = 'Gruppe erfolgreich gelöscht';
public $A_CMP_ACC_BCNDGP = 'Gruppenrechte konnten nicht gelöscht werden!';
public $A_CMP_ACC_BCNDUS = 'Benutzer konnten nicht gelöscht werden!';
public $A_CMP_ACC_NOGRSEL = 'Keine Gruppe ausgewählt';
public $A_CMP_ACC_PERMADD = 'Rechte erfolgreich hinzugefügt für';
public $A_CMP_ACC_PERDSUC = 'Rechte erfolgreich gelöscht';
public $A_CMP_ACC_CNDELPER = 'Konnte Rechte nicht löschen!';
public $A_CMP_ACC_PERMEXIST = 'Rechte existieren schon!';
public $A_CMP_ACC_TEDITGR = 'Gruppe bearbeiten';
public $A_CMP_ACC_TGUPALD = 'Gruppenbenutzer und Rechte werden ebenfalls gelöscht!';
public $A_CMP_ACC_TEDITPR = 'Rechte bearbeiten';
public $A_CMP_ACC_VIEW = 'Ansehen';
public $A_CMP_ACC_UPLOAD = 'Hochladen';
public $A_CMP_ACC_CONTENT = 'Inhalt';
public $A_CMP_ACC_OWN = 'Eigene';
public $A_CMP_ACC_PROF = 'Profile';
public $A_CMP_ACC_FILES = 'Dateien';
public $A_CMP_ACC_AVATARS = 'Avatare';
public $A_CMP_ACC_MANAGE = 'Verwalte';
public $A_CMP_ACC_USERP = 'Benutzereigenschaften';

}

?>
