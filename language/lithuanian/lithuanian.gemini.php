<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Installation Language
* @ Author: Elxis Team
* @ Translator: Kestas a.k.a. LitElxis
* @ Translator URL: http://www.elxis.lt
* # Translator E-mail: LitElxis@gmail.com
* @ Description: Lietuviškas Elxis 2008 naudotojų (front end) puslapis
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die ('Tiesioginė prieiga į šią vietą negalima.');


DEFINE('_GEM_RTL', 0); //set to 1 for Right-To-Left languages like arabic and hebrew
DEFINE('_GEM_UNKN_ERR', 'Nežinoma klaida');
DEFINE('_GEM_CNOT_UPFTP', 'Nepavyko įkelti bylos į FTP serverį.');
DEFINE('_GEM_CNOT_CONFTP', 'Nepavyko prisijungti prie FTP serverio.');
DEFINE('_GEM_FCPERM_UPFILE', 'Nepavyko pakeisti įkeltos bylos leidimų.');
DEFINE('_GEM_FMOVE_UPFILE', 'Nepavyko perkelti bylos į galutinį katalogą.');
DEFINE('_GEM_CNOT_COPYF', 'Nepavyko nukopijuoti bylos.');
DEFINE('_GEM_TRNOTHING', 'Nėra ką versti!');
DEFINE('_GEM_TRINV_INOUT', 'Negalima įvesties/išvesties kalbų kombinacija.');
DEFINE('_GEM_CNOT_CRFILE', 'Nepavyko sukurti reikalingos bylos');
DEFINE('_GEM_MUST_WRITE', 'turi būti įrašoma!');
DEFINE('_GEM_CNOT_TRANS', 'Nepavyko išversti!');
DEFINE('_GEM_PUBLISHED_PEND', 'Paskelbtas, <u>Sulaikytas</u>');
DEFINE('_GEM_PUBLISHED_CURRENT', 'Paskelbtas, <u>Aktualus</u>');
DEFINE('_GEM_PUBLISHED_EXPIRED', 'Paskelbtas, <u>Pasibaigęs galiojimas</u>');
DEFINE('_GEM_PUBLISHED_NOT', 'Nepaskelbtas');
DEFINE('_GEM_TOGGLE_STATE', 'Paspausti piktogramą norint pakeisti būklę.');
DEFINE('_GEM_PENDING', 'Sulaikytas');
DEFINE('_GEM_VISIBLE', 'Matomas');
DEFINE('_GEM_INVISIBLE', 'Nematomas');
DEFINE('_GEM_SORT_NONE', 'Nėra rikiavimo');
DEFINE('_GEM_SORT_ASC', 'Rikiavimas didėjančiai');
DEFINE('_GEM_SORT_DESC', 'Rikiavimas mažėjančiai');
DEFINE('_GEM_DATE_FORMLC', "%A, %B %d, %Y"); //Note: Uses PHP's strftime Command Format,  %A, %d %B %Y           this line  needs revision
DEFINE('_GEM_DATE_FORMLC2', "%A, %Y %B %d, %H:%M");     //this line needs revision %A, %d %B %Y %H:%M
DEFINE('_GEM_YES', 'Taip');
DEFINE('_GEM_NO','Ne');
DEFINE('_GEM_NONE','Nėra');  //needs to be checked on the working website or at least demo version 
DEFINE('_GEM_LEFT','Kairė');  //needs to be checked on the working website or at least demo version 
DEFINE('_GEM_RIGHT','Dešinė');  ///needs to be checked on the working website or at least demo version 
DEFINE('_GEM_CENTER','Centras');  //needs to be checked on the working website or at least demo version 
DEFINE('_GEM_CANCEL','Panaikinti');  //needs to be checked on the working website or at least demo version 
DEFINE('_GEM_NO_PARAMS','Šiam elementui nėra parametrų');
DEFINE('_GEM_PUBL_ITEM','Panaikinti elemento paskelbimą');
DEFINE('_GEM_UNPUBL_ITEM','Paskelbti elementą');
DEFINE('_GEM_WRITABLE','Įrašoma');
DEFINE('_GEM_UNWRITABLE','Neįrašoma');
DEFINE('_GEM_PARNAV','Pirminis langas su naršyklės navigacija');
DEFINE('_GEM_NEWNAV','Naujas langas su naršyklės navigacija');
DEFINE('_GEM_NEWNONAV','Naujas langas be naršyklės navigacijos');
DEFINE('_GEM_WEBLINK_TITLE','Žiniatinklio nuorodai turi būti priskirta antraštė.');
DEFINE('_GEM_WEBLINK_EXIST','Tokiu vardu jau yra sukurta žiniatinklio nuoroda, bandykite dar kartą.');
DEFINE('_NEW_USER_MESSAGE_SUBJECT','Naujo naudotojo detalės.');
DEFINE('_NEW_USER_MESSAGE','Sveiki %s,
Administratorius Jus patvirtino kaip %s naudotoją. 
Šiame laiške yra Jūsų naudotojo vardas ir slaptažodis, skirti prisijungti prie %s
Naudotojo vardas - %s
Slaptažodis - %s
Neatsakinėkite į šį laišką, kadangi tai yra automatiškai sugeneruotas informacinio pobūdžio laiškas');
DEFINE('_GEM_VALID_AZ09',"Įveskite galiojantį %s. Neturi būti tarpų, ne daugiau nei %d simbolių ir turi būti tik simboliai 0-9, a-z arba A-Z");
DEFINE('_GEM_REGWARN_NAME','Įveskite savo vardą.');
DEFINE('_GEM_REGWARN_UNAME','Įveskite savo naudotojo vardą.');
DEFINE('_GEM_REGWARN_MAIL','Įveskite galiojantį el. pašto adresą.');
DEFINE('_GEM_REGWARN_INUSE','Toks naudotojo vardas/slaptažodis jau užregistruoti. Pasirinkite kitą.');
DEFINE('_GEM_REGWARN_EMAIL_INUSE', 'Toks el. pašto adresas jau užregistruotas. Jei pamiršote slaptažodį, spauskite nuorodą "Slaptažodžio priminimas" ir Jums bus atsiųstas naujas slaptažodis.');

?>
