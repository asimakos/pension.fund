<?php 
/**
* @ Version: 2008.1
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Siegmund Langsch
* @ Translator URL: http://www.langschnet.de
* # Translator E-mail: s.langsch@langshcnet.de
* @ Description: German language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen ort ist nicht erlaubt.' );


define ('_DEFL_CONFIG', 'Elxis Defender Konfiguration');
define ('_DEFL_CONFPERMSUCC', 'Defender Konfigurationsdatei Zugriffsrechte erfolgreich gesetzt auf');
define ('_DEFL_CONFPERMNO', 'Kann Konfigurationsdatei nicht beschreibbar machen');
define ('_DEFL_LOGSPERMSUCC', 'Defender Log-Verzeichnis Zugriffsrechte erfolgreich gesetzt auf');
define ('_DEFL_LOGSPERMNO', 'Kann Log-Verzeichnis nicht beschreibbar machen');
define ('_DEFL_ENABLEDESC', 'Aktiviere Defender oder nicht (stellen sie sicher, das /administrator/tools/defender/logs beschreibbar ist, bevor sie Defender aktivieren)');
define ('_DEFL_PROTVARS', 'Geschützte Variablen');
define ('_DEFL_PROTVARSD', 'Wählen sie den Typ von Varaiblen aus, die geschützt werden sollen (voreingestellt: REQUEST)');
define ('_DEFL_LOGATTACKS', 'Zeichne Angriffe auf');
define ('_DEFL_LOGATTACKSD', 'Falls aktiviert, zeichnet Defender alle Angriffsversuche auf');
define ('_DEFL_MAILALERT', 'Mail Alarm');
define ('_DEFL_MAILALERTD', 'Falls aktiviert, sendet Defender eine EMail-Warnung für jeden Angriffsversuchs');
define ('_DEFL_MAILADDR', 'EMail Addresse');
define ('_DEFL_SITEOFFFOR', 'Site Offline seit');
define ('_DEFL_SECONDS', 'Sekunden');
define ('_DEFL_SITEOFFD', 'Nach einem Angriff, schalten sie die Seite für X Sekunden offline. 0 zum deaktvieren dieser Option');
define ('_DEFL_BLOCKIP', 'Blocke IP');
define ('_DEFL_BLOCKIPD', 'Blockiert die IP des Angreifers. Vorsicht. Defender blockiert jeden, den es für einen Angreifer hält - auch sie selbst!');
define ('_DEFL_FILTERS', 'Filter');
define ('_DEFL_FILTHELP', '<b>Elxis Defender ist nutzlos ohne Filter.</b><br />
	Um einen Filter hinzuzufügen, geben sie das Wort oder die Phrase zum Filtern an und klicken sie auf Hinzufügen.<br />
	Stören sie sich nicht an Groß- oder Kleinschreibung.<br />
	Drücken sie <b>DEL</b> um einen Filter aus der Liste zu entfernen.<br />
	Wenn sie sich mit Apaches <b>mod_Security</b> auskennen, behalten sie im Hinterkopf das Defender mehr oder weniger auf die gleiche Weise funktioniert, 
	wenn sie Filter hinzufügen.<br />
	wenn sie fertig sind, klicken sie auf <b>Speichern</b> u die Konfiguration zu sichern.<br />');
define ('_DEFL_SLOWDOWNT', 'Zeitverlangsamung');
define ('_DEFL_SLOWDOWN', 'Das Benutzen von Defender macht Elxis langsamer. 
	Wenn zu viele Filter hinzugefügt werden, dann kann die PHP-Execution Time des Servers unter Umständen nicht mehr ausreichen. Geben sie nicht mehr als 15 Filter an. 
	Sie können natürlich experimentiern und so die Grenze erweitern, abhängig von ihren Servereinstellungen. 
	Unsere Labortests haben eine Verlangsamung von <b>0.1 bis 27 msec</b> abhängig von der Anzahl der Filter (von 10 hoch zu 30) 
	und der Eingabevariablen mit denen Defnder sich befassen muss, ergeben (von normalem browsen, bis zur Übergabe großer Artikel mittels POST oder GET Methode).');
define ('_DEFL_EXAMPLEFIL', 'Beispielfilter');
define ('_DEFL_DEFCONFIS', 'Defender Konfigurationsdatei ist');
define ('_DEFL_DEFLOGSIS', 'Defender Log-Verzeichnis ist');
define ('_DEFL_MAKEWRITE', 'Mache es Beschreibbar');
define ('_DEFL_CONFSAVESUCC', 'Defender Konfiguration erfolgreich gespeichert!');
define ('_DEFL_CONFSAVENO', 'Konnte Defender Konfiguration nicht speichern!');
define ('_DEFL_ERRONEFILT', 'Fehler: Sie müssen wenigstens einen Filter angeben!');
define ('_DEFL_ENCKEY', 'Verschlüsselungs Key');
define ('_DEFL_ENCKEYD', 'Wird benutzt um aufgezeichnete Information zu verschlüsseln. Schlüssellänge muss zwischen 8 und 32 Zeichen betragen. Löschen sie alle Aufzeichnungen, bevor sie den Schlüssel ändern!');
define ('_DEFL_ERRENCKEY', 'Fehler: Schlüssellänge muss zwischen 8 und 32 Zeichen betragen');
define ('_DEFL_ENABLEDEF', 'Aktiviere Defender');
define ('_DEFL_DISABLEDEF', 'Deaktiviere Defender');
define ('_DEFL_VIEWLOGS', 'Zeige Logs');
define ('_DEFL_CLEARLOGS', 'Lösche Logs');
define ('_DEFL_VIEWBLOCK', 'Zeige blockierte IPs');
define ('_DEFL_CLEARBLOCK', 'Lösche blockierte IPs');
define ('_DEFL_DEFENDER', 'Elxis Defender');
define ('_DEFL_LOGSCLEARED', 'Logs gelöscht');
define ('_DEFL_CNOTCLLOGS', 'Konnte Logs nicht löschen. Stellen sie sicher, das die Datei beschreibbar ist.');
define ('_DEFL_BLOCKCLEARED', 'Alle blockierten IP Addressen erfolgreich gelöscht');
define ('_DEFL_CNOTCLBLOCK', 'Konnte blockierte Adressen nicht löschen. Stellen sie sicher, das die Datei beschreibbar ist.');
define ('_DEFL_SUBMITALERT', 'Filter zu übermitteln während Defender aktiv ist, wird als Angriff bewertet! Schalten sie Defender zuerst ab, machen sie ihre Änderungen und aktivieren sie Defender danach wieder');
define ('_DEFL_GEOLOCATE', 'Geo Lokalisierung');
define ('_DEFL_PERMSUCC', 'Rechte geändert zu');
define ('_DEFL_PERMFAIL', 'Konnte Rechte nicht ändern');
define ('_DEFL_ADDIP', 'IP Hinzufügen');
define ('_DEFL_DELETEIP', 'Lösche IP');
define ('_DEFL_BLOCKEDIPS', 'Blockierte IPs');
define ('_DEFL_IPRANGES', 'IP Adressraum');
define ('_DEFL_ADDRANGE', 'IP Adressraum hinzufügen');
define ('_DEFL_DELRANGE', 'Lösche IP Adressraum');
define ('_DEFL_RANGEHELP', 'Um ein ganzes Netzwerk, einen Internet-Provider oder ein Land zu blockieren, gibt Defender ihnen 
die Option ganze Adressräume zu sperren. Jeder Adressraum besteht aus zwei Teilen, getrennt durch Unterstrich (_). Der erste Teil ist die Start_IP, der Zweite die END_IP. Defender blockiert alles zwischen diesen beiden Werten.');
define ('_DEFL_RANGEEXAMPLES', 'Anwendebeispiel');
define ('_DEFL_BLOCKFROM', 'blockiert IPs von');
define ('_DEFL_BLOCKTO', 'bis');
define ('_DEFL_ALLOWIPS', 'Erlaubte IP Addressen');
define ('_DEFL_ALLOWIPSD', 'Falls aktiviert haben sie Möglichkeit IP Adressen festzulegen die Backend und(oder Frontend Zugriff haben. Alle anderen IPs werden geblockt');
define ('_DEFL_FRONTBACK', 'Frontend und Admin.');
define ('_DEFL_ALLOWDIS', 'Erlaubte IPs ist deaktiviert');
define ('_DEFL_ONLACCADM', 'Nur die IP Adressen unten haben Zugriff auf den Admin-Bereich');
define ('_DEFL_ONLACCSAD', 'Nur die IP Adressen unten haben Zugriff auf den Admin-Bereich und das Frontend');

?>