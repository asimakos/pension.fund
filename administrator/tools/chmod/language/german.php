<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Siegmund Langsch
* @ Translator URL: http://www.langschnet.de
* # Translator E-mail: s.langsch@langshcnet.de
* @ Description: German language for Chmod tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


define('_CMOD_CHMOD', 'Modus ändern');
define('_CMOD_PATH', 'Pfad');
define('_CMOD_MSGSERVER', 'Nachricht vom Server');
define('_CMOD_PATHNOTEXIST', 'Pfad existiert nicht!');
define('_CMOD_PATHNOTELXIS', 'Pfad gehört nicht zu Elxis!');
define('_CMOD_NOTALLOWED1', 'Sie können den Modus nicht wechseln auf');
define('_CMOD_NOTALLOWED2FI', 'auf eine Datei.<br>Probleme beim Dateizugriff werden auftauchen.');
define('_CMOD_NOTALLOWED2FO', 'auf einen Ordner.<br>Probleme beim Ordnerzugriff werden auftauchen.');
define('_CMOD_CHMODSUCC', 'Modus erfolgeich geändert zu');
define('_CMOD_CHMODCNOT', 'Konnte Modus nicht ändern zu');
define('_CMOD_ONLYUNIX', 'Nur unter UNIX verfügbar');
define('_CMOD_LOAD', 'Laden');
define('_CMOD_CHMODTO', 'Chmod zu');
define('_CMOD_OWNER', 'Eigentümer');
define('_CMOD_READ', 'Lesen');
define('_CMOD_WRITE', 'Schreiben');
define('_CMOD_EXECUTE', 'Ausführen');
define('_CMOD_USER', 'Benutzer');
define('_CMOD_GROUP', 'Gruppe');
define('_CMOD_WORLD', 'Welt');
define('_CMOD_SHOWHELP', 'Zeige Hilfe');
define('_CMOD_HIDEHELP', 'Verstecke Hilfe');
define('_CMOD_HELPTEXT', 'Geben sie den vollen Pfad zu einer Elxis Datei oder einem Elxis Ordner an. 
	Drücken sie Laden, wenn sie die aktuellen Werte sehen wollen. 
	Ändern sie die Werte durch drücken des Modus ändern Buttons. Nur unter UNIX vefügbar.
	<br><br>Wir empfehlen die folgenden Werte zu verwenden:<br>
	Beschreibbare Ordner: 0777, unbeschreibbare Ordner: 0755, Beschreibbare Dateien: 0666, unbeschreibbare Dateien: 0644<br>
        VORSICHT! 0777 und 0666 sind sehr gefährlich. Normalerweise reichen 644 und 755 als Rechte aus!');

?>
