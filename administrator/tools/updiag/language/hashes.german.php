<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Siegmund Langsch
* @ Translator URL: http://www.langschnet.de
* # Translator E-mail: s.langsch@langschnet.de
* @ Description: German language for Updiag tool (hashes help)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );

?>

<p align="justify">Ein Hash ist ein einzigartiger Fingerabdruck einer Datei. Dieser Fingerabdruck ändert sich schon bei der kleinsten Änderung an einer Datei. 
Auf diesem Wege kann man feststellen ob es sich um eine gültige Elxis-Installationsdatei handelt oder ob z.B. eine Datei im Paket vergessen wurde. 
Hashes helfen ebenso dabei, eine Elxis Site nach einem Hackerangriff wiederherzustellen oder bei einem anderen Schaden an der Installation. 
Bei Elxis wird eine spezielle Art zr Ermittlung der MD5 Hashes verwendet. 
Es gibt für jede Elxis Datei 2 verschieden Hashes. Wenn die erste Hash-Prüfung fehlschlägt, dann wird der zweite Hash ebenfalls geprüft. 
Falls die zweite Prüfung ebenfalls fehlschlägt, dann entscheidet Elxis, das es sich um eine modifizerte Datei handelt.</p>

<p align="justify">Für jede Elxis Version existieren 3 verschiedene Hash Dateien, eine <b>normale</b> (ideal für funktionale Sites, eine  
<b>erweiterte</b> (ideal für Sites direkt nach einer frischen Elxis Installation) und eine <b>volle</b> (nur in Spezialfällen sinnvoll 
). <u>Sie sollten den normalen Hash für funktionierende Sites verwenden.</u> 
<b>Das Elxis Team</b> ist die einzig zugelassen Autorität um diese Hash-Dateien zu erstellen. Verwenden sie keine Hash-Dateien 
aus unautorisierten Quellen. Modifiziern sie keine Hash-Dateien manuell oder benennem sie um. Sie können Hash-Dateien für ihre Version von 
<a href="http://www.elxis.org" target="blank">elxis.org</a> herunterladen.</p>

<p align="justify">Um eine Hash-Datei zu installieren, kopieren sie einfach die heruntergeladene Datei in das Hash-Verzeichnis (/administrator/tool/updiag/data/hashes). 
Sie können die Integrität ihres Dateisystems zu jeder Zeit prüfen, wenn sie eine zu ihrer Elxis Version passende Hash-Datei 
durch einen Klick auf den "Ausführen" Button für die Prüfung verwenden.</p>
