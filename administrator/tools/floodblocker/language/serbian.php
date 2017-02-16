<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ivan Trebješanin
* @ Translator URL: http://www.elxis-srbija.org
* # Translator E-mail: admin@elxis-srbija.org
* @ Description: Serbian language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_FLOODL_CONFIG', 'Konfiguracija Brane');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Dozvole konfiguracionog fajla Brane uspešno postavljene na');
DEFINE ('_FLOODL_CONFPERMNO', 'Ne mogu da otključam konfiguraciju Brane');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Direktorijum evidencije Brane uspešno su postavljene na');
DEFINE ('_FLOODL_LOGSPERMNO', 'Ne mogu da otključam direktorijum evidencije Brane');
DEFINE ('_FLOODL_INVINTER', 'Neispravan interval!');
DEFINE ('_FLOODL_INVTIME', 'Neispravno vreme isteka evidencije!');
DEFINE ('_FLOODL_ONEPAIR', 'Morate uneti bar jedan ispravan vremenski par!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Konfiguracija Brane je uspešno sačuvana!');
DEFINE ('_FLOODL_CONFSAVENO', 'Ne mogu da sačuvam konfiguraciju Brane!');
DEFINE ('_FLOODL_ENABLEDESC', 'Uključivanje/Isključivanje Brane (proverite da li je /tools/floodblocker/logs direktorijum otključan pre uključivanja)');
DEFINE ('_FLOODL_CRONINT', 'Interval krona');
DEFINE ('_FLOODL_CRONINTDESC', 'Izvršenje krona u sekundama. 1800 sekundi (30 minuta) je predefinisano');
DEFINE ('_FLOODL_LOGSTIME', 'Istek zapisa');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'Nakon koliko sekundi će zapisi biti samatrani zastarelima? Predefinisano je 7200 sekundi (2 sata)');
DEFINE ('_FLOODL_FLOODRULES', 'Postavke Brane');
DEFINE ('_FLOODL_INTSECS', 'Interval (sekunde)');
DEFINE ('_FLOODL_LIMREQS', 'Ograničenje (zahtevi)');
DEFINE ('_FLOODL_FLOODCONFIS', 'Konfiguracioni fajl Brane je');
DEFINE ('_FLOODL_FLOODLOGSIS', 'Diektorijum zapisa Brane je');
DEFINE ('_FLOODL_MAKEWRITE', 'Otključavanje');
DEFINE ('_FLOODL_PAIRSDESC', 'Asocijativni niz u {INTERVAL} => {OGRANIČENjE} formatu, 
	pri čemu {OGRANIČENjE} predstavlja broj mogućih zahteva tokom određenog broja {INTERVAL} sekundi. 
	Možete koristiti više parova. Neki parovi:<br>
	&nbsp; &nbsp; - načelo 1: 10=>10 (maksimalno 10 zahteva tokom 10 sekundi)<br>
	&nbsp; &nbsp; - načelo 2: 60=>30 (maksimalno 30 zahteva tokom 60 sekundi)<br>
	&nbsp; &nbsp; - načelo 3: 300=>50 (maksimalno 50 zahteva tokom 300 sekundi)<br>
	&nbsp; &nbsp; - načelo 4: 3600=>200 (maksimalno 200 zahteva tokom 1 sata)<br><br>
	Najviše 6 načela');
DEFINE ('CX_LFLOODBD', 'Brana sprečava napade putem izazivanja preopterećenja Vašeg Elxis sajta.');

?>
