<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ioannis Sannos
* @ Translator URL: http://www.elxis.org
* # Translator E-mail: info@elxis.org
* @ Description: English language for Updiag tool (hashes help)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

?>

<p align="justify">Hash je jedinstveni otisak fajla. Ovaj otisak se menja čak i ako je fajl izmenjen dodavanjem jednog razmaka. 
Na ovaj način možemo da odredimo koji su od fajlova koji čine Elxis instalaciju ostali netaknuti ili koje smo propustili prilikom ažuriranja. Oni nam takođe pomažu da popravimo Elxis sajt nakon napada 
hakera ili bilo čega drugog što utiče na Elxis sistem. Elxis koristi poseban način kalkulacije MD5 hash-a. 
Zato, za svaki fajl koji čini Elxis postoje dva hash-a. Ako je prva provera neuspešna, ista provera će se izvršiti i na drugom. Ukoliko i drugi hash fajl ne prođe test, tada Elxis odlučuje da je fajl izmenjen.</p>

<p align="justify">Za svaku Elxis verziju postoje tri različita hash fajla: <b>normalni</b> (idealan za sajtove koji su već u funkciji),   
<b>prošireni</b> (idealan za tek instalirane čiste Elxis instalacije), i <b>pun</b> (koristan samo za posebne namene). <u>Upotrebite normalni hash fajl na funkcionalnim sajtovima.</u> 
<b>Elxis Team</b> jedini ima ovlašćenje za izdavanje hash fajlova. Ne upotrebnjavajte hash fajlove dobijene 
iz neautorizovanih izvora. DNemojte ručno menjati, ili preimenovati hash fajlove. Hash fajlove za svoju 
Elxis verziju možete preuzeti sa <a href="http://www.elxis.org" target="blank">elxis.org</a> sajta.</p>

<p align="justify">Da biste instalirali hash fajl, jednostavno ga dodajte u hashes direktorijum (/administrator/tool/updiag/data/hashes). 
Možete uvek izvršiti proveru integriteta Vašeg sistema, u odnosu na bilo koji hash fajl koji odgovara vašoj verziji  
Elxis-a, ukoliko jednostavno kliknete dugme "Izvršavanje".</p>
