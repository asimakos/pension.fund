<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Frank Gijsels
* @link: http://elxis.onsnet.be
* @email: elxis@onsnet.be
* @description: Dutch Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Menu Afbeelding';
protected $AX_MENUIMGD = 'Een kleine afbeelding die links of rechts van het menu item wordt geplaatst. Afbeeldingen moeten in de map images/stories/ staan.';
protected $AX_MENUIMGONLYL = 'Gebruik enkel de menu afbeelding';
protected $AX_MENUIMGONLYD = 'Als je <strong>Ja</strong> selecteert, dan wordt het menu item enkel voorgesteld door de afbeelding die je selecteerde.<br /><br />Als je <strong>Nee</strong> selecteert, dan wordt het menu item voorgesteld door de afbeelding die je selecteerde EN de tekst.';
protected $AX_MENUIMG2D = 'Een kleine afbeelding die links of rechts van uw menu item wordt geplaatst. Afbeeldingen moeten in de map /images staan.';
protected $AX_PAGCLASUFL = 'Pagina Class Achtervoegsel';
protected $AX_PAGCLASUFD = 'Een achtervoegsel dat moet toegevoegd worden aan de css classen van de pagina, dit laat individuele pagina stijlen toe.';
protected $AX_TEXTPAGECL = 'Artikel Achtervoegsel';
protected $AX_TEXTPAGECLD = 'Een achtervoegsel dat moet toegevoegd worden aan de css class van het artikel, dit laat individuele artikel stijlen toe.';
protected $AX_BACKBUTL = 'Terug Knop';
protected $AX_BACKBUTD = 'Toon/Verberg een Terug Knop, die je terug brengt naar de vorige bekeken pagina.';
protected $AX_USEGLB = 'Gebruik Globaal';
protected $AX_HIDE = 'Verberg';
protected $AX_SHOW = 'Toon';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Toon Pagina Titel';
protected $AX_PAGTITLSD = 'Toon/Verberg Pagina Titel.';
protected $AX_PAGTITLL = 'Pagina Titel';
protected $AX_PAGTITLD = 'Tekst die in het begin van de pagina moet getoond worden. Als dit wordt leeg gelaten, wordt de Menunaam gebruikt.';
protected $AX_PAGTITL2D = 'Tekst die in het begin van de pagina moet worden getoond.';
protected $AX_LEFT = 'Links';
protected $AX_RIGHT = 'Rechts';
protected $AX_PRNTICOL = 'Print Icoon';
protected $AX_PRNTICOD = 'Toon/Verberg de print knop - enkel van toepassing op deze pagina.';
protected $AX_YES = 'Ja';
protected $AX_NO = 'Nee';
protected $AX_SECNML = 'Sectie Naam';
protected $AX_SECNMD = 'Toon/Verberg de Sectie waartoe het item behoort.';
protected $AX_SECNMLL = 'Sectie Naam kan gelinkt worden';
protected $AX_SECNMLD = 'Maak van de Sectie tekst een link naar de actuele sectie pagina.';
protected $AX_CATNML = 'Categorienaam';
protected $AX_CATNMD = 'Toon/Verberg de Categorie waartoe het item behoort.';
protected $AX_CATNMLL = 'Categorienaam kan gelinkt worden';
protected $AX_CATNMLD = 'Maak van de Categorietekst een link naar de actuele categorie pagina.';
protected $AX_LNKTTLL = 'Gelinkte titels';
protected $AX_LNKTTLD = 'Maak van de artikeltitels een hyperlink.';
protected $AX_ITMRATL = 'Artikel Waardering';
protected $AX_ITMRATD = 'Toon/Verberg de artikel waardering - enkel van toepassing op deze pagina.';
protected $AX_AUTNML = 'Auteur Naam';
protected $AX_AUTNMD = 'Toon/Verberg de auteur van het artikel - enkel van toepassing op deze pagina.';
protected $AX_CTDL = 'Aanmaak datum en tijd';
protected $AX_CTDD = 'Toon/Verberg de aanmaak datum - enkel van toepassing op deze pagina.';
protected $AX_MTDL = 'Aanpassings datum en tijd';
protected $AX_MTDD = 'Toon/Verberg de aanpassings datum - enkel van toepassing op deze pagina.';
protected $AX_PDFICL = 'PDF Icoon';
protected $AX_PDFICD = 'Toon/Verberg de PDF knop - enkel van toepassing op deze pagina.';
protected $AX_PRICL = 'Print Icoon';
protected $AX_PRICD = 'Toon/Verberg de print knop - enkel van toepassing op deze pagina.';
protected $AX_EMICL = 'Email Icoon';
protected $AX_EMICD = 'Toon/Verberg de email knop - enkel van toepassing op deze pagina.';
protected $AX_FTITLE = 'Titel';
protected $AX_FAUTH = 'Auteur';
protected $AX_FHITS = 'Hits';
protected $AX_DESCRL = 'Omschrijving';
protected $AX_DESCRD = 'Toon/Verberg onderstaande omschrijving.';
protected $AX_DESCRTXL = 'Omschrijving tekst';
protected $AX_DESCRTXD = 'Omschrijving van de pagina. Als dit wordt leeg gelaten, dan wordt _WEBLINKS_DESC geladen van het taal bestand';
protected $AX_IMAGEL = 'Afbeelding';
protected $AX_IMGFRPD = 'Afbeelding voor de pagina, moet zich bevinden in de map /images/stories. Standaard wordt web_links.jpg getoond. - "Gebruik geen afbeelding" wil zeggen dat er geen afbeelding wordt getoond.';
protected $AX_IMGALL = 'Uitlijning afbeelding';
protected $AX_IMGALD = 'Uitlijning van de afbeelding.';
protected $AX_TBHEADL = 'Tabel hoofdingen';
protected $AX_TBHEADD = 'Toon/Verberg de tabel hoofdingen.';
protected $AX_POSCOLL = 'Positie kolom';
protected $AX_POSCOLD = 'Toon/Verberg de positie van de kolom.';
protected $AX_EMAILCOLL = 'Email kolom';
protected $AX_EMAILCOLD = 'Toon/Verberg de Email kolom.';
protected $AX_TELCOLL = 'Telefoon kolom';
protected $AX_TELCOLD = 'Toon/Verberg de telefoon kolom.';
protected $AX_FAXCOLL = 'Fax kolom';
protected $AX_FAXCOLD = 'Toon/Verberg de fax kolom.';
protected $AX_LEADINGL = '# Hoofdartikelen';
protected $AX_LEADINGD = 'Aantal artikelen dat getoond moet worden als hoofdartikel (volledige breedte). 0 betekent dat er geen enkel artikel als een hoofdartikel wordt getoond.';
protected $AX_INTROL = '# Intro';
protected $AX_INTROD = 'Aantal weer te geven artikelen waarvan de intro tekst getoond wordt.';
protected $AX_COLSL = 'Kolommen';
protected $AX_COLSD = 'Selecteer hoeveel kolommen per rij moeten getoond worden als de intro tekst wordt weergegeven.';
protected $AX_LNKSL = '# Links';
protected $AX_LNKSD = 'Aantal artikelen dat als een link getoond moet worden.';
protected $AX_CATORL = 'Categorie volgorde';
protected $AX_CATORD = 'Sorteer artikelen op categorie.';
protected $AX_OCAT01 = 'Geen, sorteer alleen volgens primaire volgorde';
protected $AX_OCAT02 = 'Titel Alfabetisch';
protected $AX_OCAT03 = 'Titel Omgekeerd-Alfabetisch';
protected $AX_OCAT04 = 'Volgorde';
protected $AX_PRMORL = 'Primaire volgorde';
protected $AX_PRMORD = 'Volgorde dat de artikelen zullen weergegeven worden.';
protected $AX_OPRM01 = 'Standaard';
protected $AX_OPRM02 = 'Volgorde Hoofdpagina';
protected $AX_OPRM03 = 'Oudste eerst';
protected $AX_OPRM04 = 'Meest recente eerst';
protected $AX_OPRM07 = 'Auteur Alfabetisch';
protected $AX_OPRM08 = 'Auteur Omgekeerd-Alfabetisch';
protected $AX_OPRM09 = 'Meeste Hits';
protected $AX_OPRM10 = 'Minste Hits';
protected $AX_PAGL = 'Paginatie';
protected $AX_PAGD = 'Toon/Verberg paginatie ondersteuning.';
protected $AX_PAGRL = 'Paginatie gegevens';
protected $AX_PAGRD = 'Toon/Verberg paginatie gegevens ( bijv. 1-4 of 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Toon {mosimages}.';
protected $AX_ITMTL = 'Artikelen Titels';
protected $AX_ITMTD = 'Toon/Verberg de artikel titel.';
protected $AX_REMRL = 'Lees Meer';
protected $AX_REMRD = 'Toon/Verberg de Lees Meer link.';
protected $AX_OTHCATL = 'Andere Categorieën';
protected $AX_OTHCATD = 'Als men een Categorie bekijkt, Toon/Verberg de lijst van de andere categorieën.';
protected $AX_TDISTPD = 'Tekst om te tonen aan het begin van de pagina.';
protected $AX_ORDBYL = 'Volgorde';
protected $AX_ORDBYD = 'Dit overschrijft de sorteer volgorde van de artikelen.';
protected $AX_MCS_DESCL = 'Omschrijving';
protected $AX_SHCDESD = 'Toon/Verberg de categorie omschrijving.';
protected $AX_DESCIL = 'Omschrijving afbeelding';
protected $AX_MUDATFL = 'Datum Formaat';
protected $AX_MUDATFD = 'Datum formaat van de getoonde datum, gebruik makende van PHP strftime Command Formaat - als dit wordt leeg gelaten, dan wordt het datum formaat van uw taal bestand gebruikt.';
protected $AX_MUDATCL = 'Datum kolom';
protected $AX_MUDATCD = 'Toon/Verberg de datum kolom.';
protected $AX_MUAUTCL = 'Auteur kolom';
protected $AX_MUAUTCD = 'Toon/Verberg de auteur kolom.';
protected $AX_MUHITCL = 'Hits kolom';
protected $AX_MUHITCD = 'Toon/Verberg de Hits kolom.';
protected $AX_MUNAVBL = 'Menubalk';
protected $AX_MUNAVBD = 'Toon/Verberg de menubalk.';
protected $AX_MUORDSL = 'Selecteren volgorde';
protected $AX_MUORDSD = 'Toon/Verberg de Drop-Down Box voor het selecteren van de volgorde.';
protected $AX_MUDSPSL = 'Weergave selectie';
protected $AX_MUDSPSD = 'Toon/Verberg de Drop-Down Box.';
protected $AX_MUDSPNL = 'Toon Aantal';
protected $AX_MUDSPND = 'Aantal artikelen dat standaard moet getoond worden.';
protected $AX_MUFLTL = 'Filter';
protected $AX_MUFLTD = 'Toon/Verberg de filter beschikbaarheid.';
protected $AX_MUFLTFL = 'Filter veld';
protected $AX_MUFLTFD = 'Op welk veld zal de filter van toepassing zijn.';
protected $AX_MUOCATL = 'Andere Categorieën';
protected $AX_MUOCATD = 'Toon/Verberg de lijst van de andere categorieën.';
protected $AX_MUECATL = 'Lege categorieën';
protected $AX_MUECATD = 'Toon/Verberg lege (geen artikelen) categorieën.';
protected $AX_CATDSCL = 'Categorie Omschrijving';
protected $AX_CATDSBLND = 'Toon/Verberg de categorie omschrijving, deze zal onder de categorie naam getoond worden.';
protected $AX_NAMCOLL = 'Kolom naam';
protected $AX_LINKDSCL = 'Link Omschrijving';
protected $AX_LINKDSCD = 'Toon/Verberg de omschrijving van de links.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Dit component toont een lijst met contact informatie.';
protected $AX_CCT_CATLISTSL = 'Categorie Lijst - Sectie';
protected $AX_CCT_CATLISTSD = 'Toon/Verberg de lijst van de categorieën in de lijstweergave.';
protected $AX_CCT_CATLISTCL = 'Categorie Lijst - Categorie';
protected $AX_CCT_CATLISTCD = 'Toon/Verberg de lijst van de categorieën in tabelweergave.';
protected $AX_CCT_CATDSCD = 'Toon/Verberg de omschrijving voor de lijst van de andere categorieën.';
protected $AX_CCT_NOCATITL = '# Categorie artikelen';
protected $AX_CCT_NOCATITD = 'Toon/Verberg het aantal artikelen in iedere categorie.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parameters voor individuele contacts.';
protected $AX_CIT_NAMEL = 'Naam';
protected $AX_CIT_NAMED = 'Toon/Verberg de naam informatie.';
protected $AX_CIT_POSITL = 'Positie';
protected $AX_CIT_POSITD = 'Toon/Verberg de positie informatie.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Toon/Verberg de email informatie. Als je dit op toon zet, dan wordt het email adres beschermt tegen spambots met javascript cloaking.';
protected $AX_CIT_SADDREL = 'Straat';
protected $AX_CIT_SADDRED = 'Toon/Verberg de straat informatie.';
protected $AX_CIT_TOWNL = 'Woonplaats';
protected $AX_CIT_TOWND = 'Toon/Verberg de woonplaats informatie.';
protected $AX_CIT_STATEL = 'Provincie';
protected $AX_CIT_STATED = 'Toon/Verberg de provincie informatie.';
protected $AX_CIT_COUNTRL = 'Land';
protected $AX_CIT_COUNTRD = 'Toon/Verberg de land informatie.';
protected $AX_CIT_ZIPL = 'PosCode';
protected $AX_CIT_ZIPD = 'Toon/Verberg de postcode informatie.';
protected $AX_CIT_TELL = 'Telefoon';
protected $AX_CIT_TELD = 'Toon/Verberg de telefoon informatie.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Toon/Verberg de fax informatie.';
protected $AX_CIT_MISCL = 'Overige gegevens';
protected $AX_CIT_MISCD = 'Toon/Verberg de overige gegevens informatie.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Toon/Verberg de Vcard.';
protected $AX_CIT_CIMGL = 'Afbeelding';
protected $AX_CIT_CIMGD = 'Toon/Verberg de afbeelding.';
protected $AX_CIT_DEMAILL = 'Email omschrijving';
protected $AX_CIT_DEMAILD = 'Toon/Verberg onderstaande omschrijving.';
protected $AX_CIT_DTXTL = 'Omschrijving';
protected $AX_CIT_DTXTD = 'De omschrijving voor het email formulier. Als deze wordt leeg gelaten zal de _EMAIL_DESCRIPTION taal definitie gebruikt worden.';
protected $AX_CIT_EMFRML = 'Email Formulier';
protected $AX_CIT_EMFRMD = 'Toon/Verberg "email naar" op het formulier.';
protected $AX_CIT_EMCPYL = 'Email kopie';
protected $AX_CIT_EMCPYD = 'Toon/Verberg het selectie vakje om een kopie te versturen naar het verzender adres.';
protected $AX_CIT_DDL = 'Drop-Down Box';
protected $AX_CIT_DDD = 'Toon/Verberg de Drop-Down Box in de contact weergave.';
protected $AX_CIT_ICONTXL = 'Iconen/tekst';
protected $AX_CIT_ICONTXD = 'Gebruik iconen, tekst, of niets naast de getoonde contact informatie.';
protected $AX_CIT_ICONS = 'Iconen';
protected $AX_CIT_TEXT = 'Tekst';
protected $AX_CIT_NONE = 'Geen';
protected $AX_CIT_ADICONL = 'Adres Icoon';
protected $AX_CIT_ADICOND = 'Icoon voor adres informatie.';
protected $AX_CIT_EMICONL = 'Email Icoon';
protected $AX_CIT_EMICOND = 'Icoon voor email informatie.';
protected $AX_CIT_TLICONL = 'Telefoon Icoon';
protected $AX_CIT_TLICOND = 'Icoon voor telefoon informatie.';
protected $AX_CIT_FXICONL = 'Fax Icoon';
protected $AX_CIT_FXICOND = 'Icoon voor fax informatie.';
protected $AX_CIT_MCICONL = 'Overige Icoon';
protected $AX_CIT_MCICOND = 'Icoon voor de overige gegevens.';
protected $AX_CCT_NAMEL = 'Naam';
protected $AX_CCT_NAMED = 'Toon/Verberg de naam informatie.';
protected $AX_CCT_POSITL = 'Positie';
protected $AX_CCT_POSITD = 'Toon/Verberg de positie informatie.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Toon/Verberg de email informatie. Als je dit op toon zet, dan wordt het email adres beschermt tegen spambots met javascript cloaking.';
protected $AX_CCT_SADDREL = 'Straat';
protected $AX_CCT_SADDRED = 'Toon/Verberg de straat informatie.';
protected $AX_CCT_TOWNL = 'Woonplaats';
protected $AX_CCT_TOWND = 'Toon/Verberg de woonplaats informatie.';
protected $AX_CCT_STATEL = 'Provincie';
protected $AX_CCT_STATED = 'Toon/Verberg de provincie informatie.';
protected $AX_CCT_COUNTRL = 'Land';
protected $AX_CCT_COUNTRD = 'Toon/Verberg de land informatie.';
protected $AX_CCT_ZIPL = 'Postcode';
protected $AX_CCT_ZIPD = 'Toon/Verberg de postcode informatie.';
protected $AX_CCT_TELL = 'Telefoon';
protected $AX_CCT_TELD = 'Toon/Verberg de telefoon informatie.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Toon/Verberg de fax informatie.';
protected $AX_CCT_MISCL = 'Overige gegevens';
protected $AX_CCT_MISCD = 'Toon/Verberg de overige gegevens informatie.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Toon/Verberg de Vcard.';
protected $AX_CCT_CIMGL = 'Afbeelding';
protected $AX_CCT_CIMGD = 'Toon/Verberg de afbeelding.';
protected $AX_CCT_DEMAILL = 'Email omschrijving';
protected $AX_CCT_DEMAILD = 'Toon/Verberg onderstaande omschrijving.';
protected $AX_CCT_DTXTL = 'Omschrijving';
protected $AX_CCT_DTXTD = 'Omschrijving voor het email formulier. Als dit wordt leeg gelaten, dan wordt de _EMAIL_DESCRIPTION taal definitie gebruikt.';
protected $AX_CCT_EMFRML = 'Email Formulier';
protected $AX_CCT_EMFRMD = 'Toon/Verberg "email naar" op het formulier.';
protected $AX_CCT_EMCPYL = 'Email Kopie';
protected $AX_CCT_EMCPYD = 'Toon/Verberg het selectie vakje om een kopie te versturen naar het verzender adres.';
protected $AX_CCT_DDL = 'Drop-Down Box';
protected $AX_CCT_DDD = 'Toon/Verberg de Drop-Down Box in de contact weergave.';
protected $AX_CCT_ICONTXL = 'Icoon/tekst';
protected $AX_CCT_ICONTXD = 'Gebruik iconen, tekst, of niets naast de getoonde contact informatie.';
protected $AX_CCT_ICONS = 'Iconen';
protected $AX_CCT_TEXT = 'Tekst';
protected $AX_CCT_NONE = 'Geen';
protected $AX_CCT_ADICONL = 'Adres Icoon';
protected $AX_CCT_ADICOND = 'Icoon voor de adres informatie.';
protected $AX_CCT_EMICONL = 'Email Icoon';
protected $AX_CCT_EMICOND = 'Icoon voor de email informatie.';
protected $AX_CCT_TLICONL = 'Telefoon Icoon';
protected $AX_CCT_TLICOND = 'Icoon voor de telefoon informatie.';
protected $AX_CCT_FXICONL = 'Fax Icoon';
protected $AX_CCT_FXICOND = 'Icoon voor de fax informatie.';
protected $AX_CCT_MCICONL = 'Overige Icoon';
protected $AX_CCT_MCICOND = 'Icoon voor de overige informatie.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Dit toont een pagina met slecht één artikel.';
protected $AX_CNT_INTEXTL = 'Intro Tekst';
protected $AX_CNT_INTEXTD = 'Toon/Verberg de intro tekst.';
protected $AX_CNT_KEYRL = 'Verwijzingssleutel';
protected $AX_CNT_KEYRD = 'Een tekstsleutel welke naar het artikel kan doorverwijzen (bijvoorbeeld een help referentie).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Dit component toont alle gepubliceerde artikelen van uw website die gemarkeerd zijn als "Toon op de hoofdpagina".';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parameters voor individuele contacten.';
protected $AX_LG_LPTL = 'Titel Login Pagina';
protected $AX_LG_LPTD = 'Tekst die bovenaan de pagina moet getoond worden. Als deze wordt leeg gelaten, dan zal de menunaam gebruikt worden.';
protected $AX_LG_LRURLL = 'Inlog doorverwijzings-URL';
protected $AX_LG_LRURLD = 'Welke pagina wil je dat getoond wordt nadat een gebruiker heeft ingelogd?. Als dit wordt leeg gelaten, dan wordt de hoofd pagina gebruikt.';
protected $AX_LG_LJSML = 'Login JS Bericht';
protected $AX_LG_LJSMD = 'Toon/Verberg een javascript pop-up, met de melding "Login Succes".';
protected $AX_LG_LDESCL = 'Login Omschrijving';
protected $AX_LG_LDESCD = 'Toon/Verberg onderstaande Login Omschrijving.';
protected $AX_LG_LDESTL = 'Login Omschrijving Tekst';
protected $AX_LG_LDESTD = 'Tekst om te tonen op de login pagina. Als je deze leeg laat, dan zal _LOGIN_DESCRIPTION gebruikt worden.';
protected $AX_LG_LIMGL = 'Login Afbeelding';
protected $AX_LG_LIMGD = 'Afbeelding voor de Login Pagina.';
protected $AX_LG_LIMGAL = 'Uitlijning Login Pagina';
protected $AX_LG_LIMGAD = 'Uitlijning van de Login afbeelding.';
protected $AX_LG_LOPTL = 'Titel Logout Pagina';
protected $AX_LG_LOPTD = 'Tekst die bovenaan de pagina moet getoond worden. Als deze wordt leeg gelaten, dan zal de menu naam gebruikt worden.';
protected $AX_LG_LORURLL = 'Logout doorverwijzings-URL';
protected $AX_LG_LORURLD = 'Welke pagina wil je dat getoond wordt nadat een gebruiker heeft uitgelogd? Als dit wordt leeg gelaten, dan wordt de hoofdpagina gebruikt.';
protected $AX_LG_LOJSML = 'Logout JS Bericht';
protected $AX_LG_LOJSMD = 'Toon/Verberg een javascript pop-up, met de melding "Logout Succes".';
protected $AX_LG_LODSCL = 'Logout Omschrijving';
protected $AX_LG_LODSCD = 'Toon/Verberg onderstaande logout omschrijving.';
protected $AX_LG_LODSTL = 'Logout Omschrijving Tekst';
protected $AX_LG_LODSTD = 'Tekst om te tonen op de logout pagina. Als je deze leeg laat, dan zal _LOGOUT_DESCRIPTION gebruikt worden.';
protected $AX_LG_LOGOIL = 'Logout Afbeelding';
protected $AX_LG_LOGOID = 'Afbeelding voor de logout pagina.';
protected $AX_LG_LOGOIAL = 'Uitlijning Logout Afbeelding';
protected $AX_LG_LOGOIAD = 'Uitlijning voor de logout afbeelding.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Met dit component kan je een groepsmail versturen naar een groep van gebruikers.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Dit component beheert de website media.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Dit component beheert uw menus.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - Component Item';
protected $AX_MUCIL_CDESC = 'Maakt een link naar een bestaande Component.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Component';
protected $AX_MUCOMP_CDESC = 'Toont de frontend interface van een Component.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabel - Contact Categorie';
protected $AX_MUCCT_CDESC = 'Toont contact items van een bepaalde categorie in tabelvorm.';
protected $AX_MUCCT_CATDL = 'Categorie Omschrijving';
protected $AX_MUCCT_CATDD = 'Toon/Verberg de omschrijving voor de lijst van de andere categorieën.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Contact Item';
protected $AX_MUCTIL_CDESC = 'Maakt een link naar een gepubliceerd Contact Item';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Artikelen Categorie Archief';
protected $AX_MUCAC_CDESC = 'Toont een lijst van gearchiveerde artikelen van een bepaalde categorie.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Artikelen Sectie Archief';
protected $AX_MUCAS_CDESC = 'Toont een lijst van gearchiveerde artikelen van een bepaalde sectie.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Artikelen Categorie';
protected $AX_MUCBC_CDESC = 'Toont een pagina met artikelen van meerdere categorieën in blog formaat.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Artikelen Sectie';
protected $AX_MUCBS_CDESC = 'Toont een pagina met artikelen van meerdere secties in blog formaat.';
protected $AX_MUCBS_SHSD = 'Toon/Verberg de sectie omschrijving.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabel - Artikelen Categorie';
protected $AX_MUCC_CDESC = 'Toont artikelen van een bepaalde categorie in tabelvorm.';
protected $AX_MUCC_SHLOCD = 'Toon/Verberg de lijst van andere categorieën.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - Artikel';
protected $AX_MCIL_CDESC = 'Toont een link naar een gepubliceerd artikel in volledige weergave.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabel - Artikelen Sectie';
protected $AX_MCS_CDESC = 'Maakt een lijst van artikel categorieën voor een bepaalde sectie.';
protected $AX_MCS_STL = 'Sectie Titel';
protected $AX_MCS_STD = 'Toon/Verberg de sectie titel.';
protected $AX_MCS_SHCTID = 'Toon/Verberg de afbeelding van de categorie omschrijving.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - Alleenstaande Pagina';
protected $AX_MLSC_CDESC = 'Maakt een link naar een alleenstaande pagina.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabel - Nieuwsfeed Categorie';
protected $AX_MNSFC_CDESC = 'Toont nieuwsfeed items voor een bepaalde categorie in tabelvorm.';
protected $AX_MNSFC_SHNCD = 'Toon/Verberg de naam kolom.';
protected $AX_MNSFC_ACL = 'Artikelen kolom';
protected $AX_MNSFC_ACD = 'Toon/Verberg de artikelen kolom.';
protected $AX_MNSFC_LCL = 'Link kolom';
protected $AX_MNSFC_LCD = 'Toon/Verberg de link kolom.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - Nieuwsfeed';
protected $AX_MNSFL_CDESC = 'Maakt een link naar een enkele gepubliceerde nieuwsfeed.';
protected $AX_MNSFL_FDIML = 'Nieuwsfeed Afbeelding';
protected $AX_MNSFL_FDIMD = 'Toon/Verberg de afbeelding van de nieuwsfeed.';
protected $AX_MNSFL_FDDSL = 'Nieuwsfeed Omschrijving';
protected $AX_MNSFL_FDDSD = 'Toon/Verberg de omschrijving van de nieuwsfeed.';
protected $AX_MNSFL_WDCL = 'Aantal woorden';
protected $AX_MNSFL_WDCD = 'Beperkt de lengte van de weer te geven tekst van de omschrijving. 0 toont alle tekst van de omschrijving.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Scheidingsruimte / Scheidingsteken';
protected $AX_MSEP_CDESC = 'Maakt scheidingsruimte voor een menu of plaats scheidingstekens.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC = 'Maakt een link naar een URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabel - Weblink Categorie';
protected $AX_MWLC_CDESC = 'Toont Weblink items voor een bepaalde weblink categorie in tabelvorm.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Toont een externe pagina/website in een IFrame.';
protected $AX_MWRP_SCRBL = 'Scrollbalken';
protected $AX_MWRP_SCRBD = 'Toon/Verberg de horizontale & verticale scrollbalken.';
protected $AX_MWRP_WDTL = 'Breedte';
protected $AX_MWRP_WDTD = 'Breedte van het IFrame venster, je kan een absolute waarde in pixels invullen, of een relatieve door een % toe te voegen.';
protected $AX_MWRP_HEIL = 'Hoogte';
protected $AX_MWRP_HEID = 'Hoogte van het IFrame venster.';
protected $AX_MWRP_AHL = 'Automatische Hoogte';
protected $AX_MWRP_AHD = 'De hoogte wordt automatisch ingesteld op de grootte van de externe pagina. Dit werkt alleen met pagina\'s binnen uw eigen domein.';
protected $AX_MWRP_AADL = 'Automatisch Toevoegen';
protected $AX_MWRP_AADD = 'Als er geen http:// of https:// wordt gedetecteerd in de opgegeven url, dan wordt standaard http:// toegevoegd. Deze optie laat je toe om deze functie uit te zetten.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Systeem link';
protected $AX_MSYS_CDESC = 'Maakt een link naar een systeem functie';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Dit component beheert RSS/RDF nieuwsfeeds.';
protected $AX_NFE_DPD = 'Omschrijving voor de pagina';
protected $AX_NFE_SHFNCD = 'Toon/Verberg de nieuwsfeed naam kolom.';
protected $AX_NFE_NOACL = '# Artikelen kolom';
protected $AX_NFE_NOACD = 'Toon/Verberg het # artikelen in de nieuwsfeed.';
protected $AX_NFE_LCL = 'Link kolom';
protected $AX_NFE_LCD = 'Toon/Verberg de nieuwsfeed link kolom.';
protected $AX_NFE_IDL = 'Item Omschrijving';
protected $AX_NFE_IDD = 'Toon/Verberg de omschrijving of intro tekst van een item.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Dit component beheert de zoek functionaliteit.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Dit component beheert de instellingen van het syndicatie component.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache de nieuwsfeed bestanden.';
protected $AX_SYN_CACHTL = 'Cache Tijd';
protected $AX_SYN_CACHTD = 'Cache bestand zal alle x seconden vernieuwd worden.';
protected $AX_SYN_ITMSL = '# Items';
protected $AX_SYN_ITMSD = 'Aantal Items om te syndiceren.';
protected $AX_SYN_ITMSDFLT = 'Elxis Syndicatie';
protected $AX_SYN_TITLE = 'Syndicatie Titel';
protected $AX_SYN_DESCD = 'Syndicatie Omschrijving.';
protected $AX_SYN_DESCDFLT = 'Elxis website syndicatie';
protected $AX_SYN_IMGD = 'Afbeelding die in de niewsfeed moet worden ingesloten.';
protected $AX_SYN_IMGAL = 'Afbeelding Alt';
protected $AX_SYN_IMGAD = 'Alt tekst voor de afbeelding.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Tekstlimiet';
protected $AX_SYN_LMTD = 'Limiteer de artikel tekst met de hieronder opgegeven waarde.';
protected $AX_SYN_TLENL = 'Tekstlengte';
protected $AX_SYN_TLEND = 'De woordlengte van de artikel tekst - 0 toont geen tekst.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Activeer ondersteuning voor de Firefox Live Bookmarks functionaliteit.';
protected $AX_SYN_BFL = 'Bladwijzer bestand';
protected $AX_SYN_BFD = 'Speciale bestandsnaam. Als je deze leeg laat, wordt de standaard gebruikt.';
protected $AX_SYN_ORDL = 'Volgorde';
protected $AX_SYN_ORDD = 'Volgorde waarin de items zullen getoond worden.';
protected $AX_SYN_MULTIL = 'Meertalige nieuwsfeeds';
protected $AX_SYN_MULTILD = 'Indien ja, dan zal Elxis taal specifieke nieuwsfeeds genereren.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Dit component beheert de prullenbak.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Dit toont een pagina met één enkel artikel.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Dit component toont een lijst van weblinks met website schermafdrukken.';
protected $AX_WBL_LDL = 'Link Omschrijvingen';
protected $AX_WBL_LDD = 'Toon/Verberg de omschrijving van de links.';
protected $AX_WBL_ICL = 'Icoon';
protected $AX_WBL_ICD = 'Welk Icoon er in de tabelweergave links van de url moet worden gebruikt.';
protected $AX_WBL_SCSL = 'Schermafdrukken';
protected $AX_WBL_SCSD = 'Toon gelinkte website schermafdruk. Als dit gebruikt wordt, dan zal het bovenstaande weblink icoon niet getoond worden.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Doel venster als op de link wordt geklikt.';
protected $AX_WBLI_OT01 = 'Huidig venster met menubalk';
protected $AX_WBLI_OT02 = 'Nieuw venster met menubalk';
protected $AX_WBLI_OT03 = 'Nieuw venster zonder menubalk';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Deze module toont een lijst van de meest recente gepubliceerde artikelen die nog niet verlopen zijn (sommige kunnen verlopen zijn, ook al zijn ze de meest recente). Artikelen die op de hoofdpagina worden getoond zijn niet inbegrepen in de lijst.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Deze module toont een lijst van de gebruikers die momenteel zijn ingelogd.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Deze module toont een lijst van de meest populaire gepubliceerde artikelen die nog niet verlopen zijn (sommige kunnen verlopen zijn, ook al zijn ze het meest populair). Artikelen die op de hoofdpagina worden getoond zijn niet inbegrepen in de lijst.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Deze module toont statistieken van artikelen die nog niet verlopen zijn (sommige kunnen verlopen zijn). Artikelen die op de hoofdpagina worden getoond zijn niet inbegrepen in de lijst.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Module Class Achtervoegsel'; 
protected $AX_SM_MCSD = 'Het achtervoegsel dat moet toegevoegd worden aan de CSS class van de module (table.moduletable), dit laat individuele stijlen toe.'; 
protected $AX_SM_MUCSL = 'Menu Class Achtervoegsel'; 
protected $AX_SM_MUCSD = 'Het achtervoegsel dat moet toegevoegd worden aan de CSS class van de menu items.'; 
protected $AX_SM_ECL = 'Cache inschakelen'; 
protected $AX_SM_ECD = 'Selecteer of de inhoud van deze module moet gecached worden.'; 
protected $AX_SM_SMIL = 'Toon Menu Iconen'; 
protected $AX_SM_SMID = 'Toon de menu iconen die je hebt geselecteerd voor uw menu items.'; 
protected $AX_SM_MIAL = 'Menu Iconen Uitlijning'; 
protected $AX_SM_MIAD = 'Uitlijning van de menu iconen'; 
protected $AX_SM_MODL = 'Module Mode'; 
protected $AX_SM_MODD = 'Bepaalt welke artikelen in de module getoond wordt.'; 
protected $AX_SM_OP01 = 'Enkel Artikelen'; 
protected $AX_SM_OP02 = 'Enkel alleenstaande pagina\'s'; 
protected $AX_SM_OP03 = 'Beide'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Aangepaste Module.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Geef de URL van de RSS/RDF nieuwsfeed.'; 
protected $AX_SM_CU_FEDL = 'Nieuwsfeed Omschrijving'; 
protected $AX_SM_CU_FEDD = 'Toon de omschrijving voor de hele nieuwsfeed.'; 
protected $AX_SM_CU_FEIL = 'Nieuwsfeed Afbeelding'; 
protected $AX_SM_CU_FEDID = 'Toon de afbeelding die verbonden is met de hele nieuwsfeed.'; 
protected $AX_SM_CU_ITL = 'Items'; 
protected $AX_SM_CU_ITD = 'Geef het aantal RSS items dat getoond moet worden.'; 
protected $AX_SM_CU_ITDL = 'Item Omschrijving'; 
protected $AX_SM_CU_ITDD = 'Toon de omschrijving of de intro tekst van individuele nieuws items.'; 
protected $AX_SM_CU_WCL = 'Aantal woorden'; 
protected $AX_SM_CU_WCD = 'Stelt een limiet aan de hoeveelheid item omschrijving tekst. 0 zal alle tekst tonen.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Deze module toont een lijst van de maanden die gearchiveerde artikelen bevatten. Nadat je de status van een artikel op \'Gearchiveerd\' hebt gezet, zal deze lijst automatisch gegenereerd worden.'; 
protected $AX_SM_AR_CNTL = 'Aantal'; 
protected $AX_SM_AR_CNTD = 'Het aantal artikelen dat getoond moet worden (standaard is 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'De banner module toont de actieve banners uit het banner component in uw website.'; 
protected $AX_SM_BN_CNTL = 'Banner cliënt'; 
protected $AX_SM_BN_CNTD = 'Referentie naar de banner cliënt id. Ingeven, gescheiden door ","!'; 
protected $AX_SM_BN_NBSL = 'Aantal te tonen banners';
protected $AX_SM_BN_NBPRL = 'Aantal banners per rij';
protected $AX_SM_BN_NBPRD = 'Aantal banners per rij, om uit te schakelen, zet op 0. Om de banners verticaal te tonen, zet op 1';
protected $AX_SM_BN_UNQBL = 'Unieke Banners';
protected $AX_SM_BN_UNQBD = 'Geen enkele banner is ooit meer dan één keer getoond (per sessie). Als alle banners getoond zijn, dan is de geschiedenis gewist en terug gestart.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Deze module toont een lijst van de meest recent gepubliceerde items die nog niet verlopen zijn (sommige kunnen verlopen zijn, ook al zijn ze de meest recente). Items die op de hoofdpagina worden getoond zijn niet inbegrepen in de lijst.'; 
protected $AX_SM_LN_FPIL = 'Hoofdpagina Items'; 
protected $AX_SM_LN_FPID = 'Toon/Verberg artikelen die bestemd zijn voor de hoofdpagina - Werkt enkel als men in "Enkel Artikelen" mode is.'; 
protected $AX_SM_AR_CNT5D = 'Het aantal artikelen dat getoond moet worden (standaard is 5).'; 
protected $AX_SM_LN_CATIL = 'Categorie ID'; 
protected $AX_SM_LN_CATID = 'Selecteer artikelen van een specifieke categorie of meerdere categorieën (om meer dan één categorie op te geven, scheiden met een komma , ).'; 
protected $AX_SM_LN_SECIL = 'Sectie ID'; 
protected $AX_SM_LN_SECID = 'Selecteert artikelen van een specifieke sectie of meerdere secties (om meer dan één sectie op te geven, scheiden met een komma , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Deze module toont een gebruikersnaam en paswoord login formulier. Ze toont ook een link om een vergeten paswoord op te vragen. Als gebruikersregistratie is ingeschakeld, (zie configuratie instellingen), dan een andere link zal getoond worden om gebruikers uit te nodigen om te registreren.'; 
protected $AX_SM_LF_PTL = 'Pre-tekst'; 
protected $AX_SM_LF_PTD = 'Dit is de tekst of HTML die getoond wordt boven het login formulier.'; 
protected $AX_SM_LF_PSTL = 'Post-tekst'; 
protected $AX_SM_LF_PSTD = 'Dit is de tekst of HTML die getoond wordt onder het login formulier.'; 
protected $AX_SM_LF_LRUL = 'Login doorverwijzings-URL'; 
protected $AX_SM_LF_LRUD = 'Naar welke pagina zal de gebruiker die zich aanmeld naartoe gebracht worden nadat hij is aangemeld. Als dit wordt leeg gelaten, dan wordt de hoofdpagina getoond.'; 
protected $AX_SM_LF_LORUL = 'Logout doorverwijzings-URL'; 
protected $AX_SM_LF_LORUD = 'Naar welke pagina zal de gebruiker die zich afmeld naartoe gebracht worden nadat hij is afgemeld. Als dit wordt leeg gelaten, dan wordt de hoofdpagina getoond.'; 
protected $AX_SM_LF_LML = 'Login Bericht'; 
protected $AX_SM_LF_LMD = 'Toon/Verberg een javascript pop-up, met de melding "Login Succes".'; 
protected $AX_SM_LF_LOML = 'Logout Bericht'; 
protected $AX_SM_LF_LOMD = 'Toon/Verberg een javascript pop-up, met de melding "Logout Succes".'; 
protected $AX_SM_LF_GML = 'Groeten'; 
protected $AX_SM_LF_GMD = 'Toon/Verberg de eenvoudige groeten tekst.'; 
protected $AX_SM_LF_NUNL = 'Naam/Gebruikersnaam'; 
protected $AX_SM_LF_OP01 = 'Gebruikersnaam'; 
protected $AX_SM_LF_OP02 = 'Naam'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Toont een menu.'; 
protected $AX_SM_MNM_MNL = 'Menu Naam'; 
protected $AX_SM_MNM_MND = 'De naam van het menu (standaard is \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Menu Stijl'; 
protected $AX_SM_MNM_MSD = 'De menu stijl'; 
protected $AX_SM_MNM_OP1 = 'Verticaal'; 
protected $AX_SM_MNM_OP2 = 'Horizontaal'; 
protected $AX_SM_MNM_OP3 = 'Ongeordende lijst'; 
protected $AX_SM_MNM_EML = 'Menu uitklappen'; 
protected $AX_SM_MNM_EMD = 'Menu uitklappen en maak zijn sub-menus altijd zichtbaar.'; 
protected $AX_SM_MNM_IIL = 'Insprong Afbeelding'; 
protected $AX_SM_MNM_IID = 'Kies welke afbeelding het systeem moet gebruiken om tekst te laten inspringen.'; 
protected $AX_SM_MNM_OP4 = 'Template'; 
protected $AX_SM_MNM_OP5 = 'Elxis standaard afbeeldingen'; 
protected $AX_SM_MNM_OP6 = 'Gebruik onderstaande parameters'; 
protected $AX_SM_MNM_OP7 = 'Geen'; 
protected $AX_SM_MNM_II1L = 'Insprong Afbeelding 1'; 
protected $AX_SM_MNM_II1D = 'Afbeelding voor het eerste sub-niveau.'; 
protected $AX_SM_MNM_II2L = 'Insprong Afbeelding 2'; 
protected $AX_SM_MNM_II2D = 'Afbeelding voor het tweede sub-niveau.'; 
protected $AX_SM_MNM_II3L = 'Insprong Afbeelding 3'; 
protected $AX_SM_MNM_II3D = 'Afbeelding voor het derde sub-niveau.'; 
protected $AX_SM_MNM_II4L = 'Insprong Afbeelding 4'; 
protected $AX_SM_MNM_II4D = 'Afbeelding voor het vierde sub-niveau.'; 
protected $AX_SM_MNM_II5L = 'Insprong Afbeelding 5'; 
protected $AX_SM_MNM_II5D = 'Afbeelding voor het vijfde sub-niveau.'; 
protected $AX_SM_MNM_II6L = 'Insprong Afbeelding 6'; 
protected $AX_SM_MNM_II6D = 'Afbeelding voor het zesde sub-niveau.'; 
protected $AX_SM_MNM_SPL = 'Spacer'; 
protected $AX_SM_MNM_SPD = 'Spacer voor Horizontaal menu.'; 
protected $AX_SM_MNM_ESL = 'Einde Spacer'; 
protected $AX_SM_MNM_ESD = 'Einde Spacer voor Horizontaal menu.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid preload';
protected $AX_SM_MNM_IDPRD = 'AJAX preload van het Itemid inschakelen is een oplossing voor het probleem dat optreed als er meer dan één menu link naar dezelfde pagina wijzen.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Deze module toont een lijst van de huidig gepubliceerde artikelen die het meest bekeken zijn - bepaald door het aantal keer een pagina is bekeken.'; 
protected $AX_SM_MRC_MNL = 'Menu Naam'; 
protected $AX_SM_MRC_MND = 'De naam van het menu (standaard is mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Artikelen Hoofdpagina'; 
protected $AX_SM_MRC_FPID = 'Toon/Verberg artikelen die bestemd zijn voor de Hoofdpagina - werkt enkel als men in "Enkel Artikelen" mode is.'; 
protected $AX_SM_MRC_CL = 'Aantal'; 
protected $AX_SM_MRC_CD = 'Het aantal artikelen dat getoond mag worden (standaard is 5).'; 
protected $AX_SM_MRC_CIDL = 'Categorie ID'; 
protected $AX_SM_MRC_CIDD = 'Selecteert artikelen van een specifieke categorie of meerdere categorieën (om meer dan één categorie op te geven, scheiden met een komma , ).'; 
protected $AX_SM_MRC_SIDL = 'Sectie ID'; 
protected $AX_SM_MRC_SIDD = 'Selecteert artikelen van een specifieke sectie of meerdere secties (om meer dan één sectie op te geven, scheiden met een komma , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'De Nieuwsflits module maakt een willekeurige selectie van één van de gepubliceerde artikelen van een categorie bij iedere pagina vernieuwing. Het kan ook meerdere artikelen tonen in horizontale of verticale configuraties.'; 
protected $AX_SM_NWF_CATL = 'Categorie'; 
protected $AX_SM_NWF_CATD = 'Een artikel categorie.'; 
protected $AX_SM_NWF_STL = 'Stijl'; 
protected $AX_SM_NWF_STD = 'De stijl waarmee de categorie wordt weergegeven.'; 
protected $AX_SM_NWF_OP1 = 'Kiest willekeurig, één per keer'; 
protected $AX_SM_NWF_OP2 = 'Horizontaal'; 
protected $AX_SM_NWF_OP3 = 'Verticaal'; 
protected $AX_SM_NWF_SIL = 'Toon afbeeldingen'; 
protected $AX_SM_NWF_SID = 'Toon de afbeelding van het artikel.'; 
protected $AX_SM_NWF_LTL = 'Gelinkte Titels'; 
protected $AX_SM_NWF_LTD = 'Maak gelinkte artikel titels.'; 
protected $AX_SM_NWF_RML = 'Lees Meer'; 
protected $AX_SM_NWF_RMD = 'Toon/Verberg de lees meer knop.'; 
protected $AX_SM_NWF_ITL = 'Artikel Titel'; 
protected $AX_SM_NWF_ITD = 'Toon artikel titel.'; 
protected $AX_SM_NWF_NOIL = 'Aantal artikelen'; 
protected $AX_SM_NWF_NOID = 'Geen artikelen om te tonen.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Deze module vult het enquête component aan. Het wordt gebruikt om de geconfigureerde enquêtes te tonen. De module verschilt in zover van andere modules dat deze component links tussen Menu Items en enquêtes ondersteund. Dit betekent dat deze module enkel deze enquêtes toont, die geconfigureerd zijn voor een specifiek Menu Item.'; 
protected $AX_SM_POL_CATL = 'Categorie'; 
protected $AX_SM_POL_CATD = 'Een artikel categorie.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Deze module toont een willekeurige afbeelding van een gekozen map.'; 
protected $AX_SM_RNI_ITL = 'Afbeeldings Type'; 
protected $AX_SM_RNI_ITD = 'Type van afbeelding PNG/GIF/JPG enz. (standaard is JPG).'; 
protected $AX_SM_RNI_IFL = 'Afbeeldings Map'; 
protected $AX_SM_RNI_IFD = 'Pad naar de afbeeldings map relatief tot de website URL, bijv: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Link'; 
protected $AX_SM_RNI_LND = 'Een URL om naar door te verwijzen als er op de afbeelding wordt geklikt, bijv: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Breedte (px)'; 
protected $AX_SM_RNI_WD = 'Afbeeldings breedte (alle afbeeldingen worden gedwongen op deze breedte getoond).'; 
protected $AX_SM_RNI_HL = 'Hoogte (px)'; 
protected $AX_SM_RNI_HD = 'Afbeeldings hoogte (alle afbeeldingen worden gedwongen met deze hoogte getoond).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = 'Deze module toont andere artikelen die verwant zijn aan het huidig getoonde artikel. Deze zijn gebaseerd op de "keywords Metadata". Al de sleutelwoorden van het huidige artikel worden gebruikt om alle andere gepubliceerde artikelen te doorzoeken. Als voorbeeld, je kan een artikel hebben over "Griekenland" en een ander artikel over "Parthenon". Als je het sleutelwoord "Griekenland" in bijde artikelen gebruikt, dan zal deze module een lijst met alle "Griekenland" artikelen tonen als men naar de "Parthenon" artikelen kijkt en omgekeerd.'; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'De Syndicatie module toont een weblink waarmee bezoekers zich kunnen syndiceren op al het laatste nieuws van uw website. Als je op het RSS icoon klikt wordt je doorgestuurd naar een nieuwe pagina met een lijst van alle laatste nieuws in XML formaat. Om de nieuwsfeed te gebruiken in een andere Elxis website of een nieuwsfeed lezer moet je de URL kopiëren.'; 
protected $AX_SM_RSS_TXL = 'Tekst'; 
protected $AX_SM_RSS_TXD = 'Geef de tekst die tezamen met de weblinks getoond moet worden.'; 
protected $AX_SM_RSS_091D = 'Toon/Verberg RSS 0.91 Link.'; 
protected $AX_SM_RSS_10D = 'Toon/Verberg 1.0 Link.'; 
protected $AX_SM_RSS_20D = 'Toon/Verberg RSS 2.0 Link.'; 
protected $AX_SM_RSS_03D = 'Toon/Verberg Atom 0.3 Link.'; 
protected $AX_SM_RSS_OPD = 'Toon/Verberg OPML Link.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 Afbeelding'; 
protected $AX_SM_RSS_I10L = 'RSS 1.0 Afbeelding'; 
protected $AX_SM_RSS_I20L = 'RSS 2.0 Afbeelding'; 
protected $AX_SM_RSS_I03L = 'Atom Afbeelding'; 
protected $AX_SM_RSS_IOPL = 'OPML Afbeelding'; 
protected $AX_SM_RSS_CHID = 'Kies de afbeelding die moet gebruikt worden.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Deze module toont een zoek box.';
protected $AX_SM_SEM_TOP = 'Bovenkant';
protected $AX_SM_SEM_BTM = 'Onderkant';
protected $AX_SM_SEM_BWL = 'Box Breedte';
protected $AX_SM_SEM_BWD = 'Grootte van de zoeken box.';
protected $AX_SM_SEM_TXL = 'Tekst';
protected $AX_SM_SEM_TXD = 'De tekst die wordt weergegeven in de zoeken box. Als dit wordt leeg gelaten, dan wordt _SEARCH_BOX van uw taal bestand getoond.';
protected $AX_SM_SEM_BPL = 'Knop Positie';
protected $AX_SM_SEM_BPD = 'Positie van de knop, relatief tot de zoeken box.';
protected $AX_SM_SEM_BTXL = 'Knop Tekst';
protected $AX_SM_SEM_BTXD = 'De tekst die getoond wordt op de zoeken knop. Als dit wordt leeg gelaten, dan wordt _SEARCH_TITLE van uw taal bestand getoond.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'De sectie module toont een lijst van alle geconfigureerde secties in uw database. De secties refereren hier naar de artikelen secties alleen. Als de configuratie \'Toon niet geautoriseerde links\' niet is aangezet dan wordt de lijst gelimiteerd tot de secties die de gebruiker mag zien.'; 
protected $AX_SM_SEC_CL = 'Aantal';
protected $AX_SM_SEC_CD = 'Het aantal artikelen dat getoond moet worden (standaard is 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'De statistieken module toont informatie over uw server installatie, aantal artikelen in uw database, en het aantal weblinks in uw database.';
protected $AX_SM_STA_SVIL = 'Server Informatie'; 
protected $AX_SM_STA_SVID = 'Toon server informatie.'; 
protected $AX_SM_STA_SIL = 'Website informatie'; 
protected $AX_SM_STA_SID = 'Toon website informatie.'; 
protected $AX_SM_STA_HCL = 'Hits Teller'; 
protected $AX_SM_STA_HCD = 'Toon hits teller.'; 
protected $AX_SM_STA_ICL = 'Verhoog de hits teller'; 
protected $AX_SM_STA_ICD = 'Geef het aantal hits de teller moet verhoogd worden.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Met de template kiezer module kan de gebruiker (bezoeker) de website template "on the fly" via een Drop-Down Box veranderen.'; 
protected $AX_SM_TMC_MNLL = 'Maximum lengte van de naam'; 
protected $AX_SM_TMC_MNLD = 'Dit is de maximum lengte van de template naam die getoond moet worden (standaard 20).'; 
protected $AX_SM_TMC_SPL = 'Toon Voorbeeld'; 
protected $AX_SM_TMC_SPD = 'Template voorbeeld moet getoond worden.'; 
protected $AX_SM_TMC_WL = 'Breedte'; 
protected $AX_SM_TMC_WD = 'Dit is de breedte van de voorbeeld afbeelding (standaard 140 px).'; 
protected $AX_SM_TMC_HL = 'Hoogte'; 
protected $AX_SM_TMC_HD = 'Dit is de hoogte van de voorbeeld afbeelding (standaard 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'De wie is online module toont het aantal anonieme (gasten) gebruikers en geregistreerde gebruikers die momenteel op uw website zijn.'; 
protected $AX_SM_WSO_DL = 'Toon'; 
protected $AX_SM_WSO_DD = 'Selecteer wat getoond moet worden.'; 
protected $AX_SM_WSO_OP1 = '# Gasten/Leden<br />'; 
protected $AX_SM_WSO_OP2 = 'Leden Namen<br />'; 
protected $AX_SM_WSO_OP3 = 'Beide'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Deze module toont een IFrame venster naar de gespecificeerde locatie.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL naar website/bestand die je wil tonen in het IFrame'; 
protected $AX_SM_WRM_SCBL = 'Scrollbalken'; 
protected $AX_SM_WRM_SCBD = 'Toon/Verberg horizontale & verticale scrollbalken.'; 
protected $AX_SM_WRM_WL = 'Breedte'; 
protected $AX_SM_WRM_WD = 'Breedte van het IFrame venster. Je kan een absolute waarde opgeven in pixels, of een relatieve waarde door een % toe te voegen.'; 
protected $AX_SM_WRM_HL = 'Hoogte'; 
protected $AX_SM_WRM_HD = 'Hoogte van het IFrame venster'; 
protected $AX_SM_WRM_AHL = 'Automatische Hoogte'; 
protected $AX_SM_WRM_AHD = 'De hoogte zal automatisch gezet worden op de grootte van de externe pagina. Dit werkt enkel voor paginas op uw eigen domein.'; 
protected $AX_SM_WRM_ADL = 'Automatisch toevoegen'; 
protected $AX_SM_WRM_ADD = 'Standaard zal http:// toegevoegd worden, behalve als het systeem  http:// of https:// detecteert in de URL weblink die je hebt opgegeven. Met deze optie kan je deze mogelijkheid uitschakelen.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Functionaliteit'; 
protected $AX_ED_FUNCTD = 'Selecteer functionaliteit'; 
protected $AX_ED_FUNSIMPLE = 'Eenvoudig'; 
protected $AX_ED_FUNADV = 'Uitgebreid';
protected $AX_ED_EDITORWIDTHL = 'Tekstverwerker breedte';
protected $AX_ED_EDITORWIDTHD = 'Breedte van het tekstverwerker venster';
protected $AX_ED_EDITORHEIGHTL = 'Tekstverwerker hoogte';
protected $AX_ED_EDITORHEIGHTD = 'Hoogte van het tekstverwerker venster';
protected $AX_ED_COMPRESSEDVL = 'Gecomprimeerde versie';
protected $AX_ED_COMPRESSEDVD = 'Om sneller te laden kan TinyMCE ook werken in gecomprimeerde mode. Dit werkt echter niet altijd (vooral in IE), dus standaard staat dit uitgeschakeld. Wees er zeker van dat het werkt op uw systeem vooraleer je het ingeschakeld.';
protected $AX_ED_OFF = 'Uit';
protected $AX_ED_ON = 'Aan';
protected $AX_ED_COMPRESSL = 'Compressie';
protected $AX_ED_COMPRESSD = 'Comprimeer de TinyMCE Editor met gzip (laad 75% sneller)';
protected $AX_ED_CONVERTURLL = 'Converteer URLs';
protected $AX_ED_CONVERTURLD = 'Converteer Absolute URLs naar relatieve.';
protected $AX_ED_ENTENCODL = 'Teken Encoding';
protected $AX_ED_ENTENCODD = 'Deze optie bepaalt hoe tekens/karakters worden verwerkt door TinyMCE. De waarde kan op een numerieke representatie gezet worden, genaamd of ruw waar geen codering wordt gebruikt. De standaard waarde van deze optie is genaamd.';
protected $AX_ED_TXTDIRL = 'Tekstrichting';
protected $AX_ED_TXTDIRD = 'Mogelijkheid om de tekstrichting te wijzigen';
protected $AX_ED_CNVFONTSPANL = 'Converteer Fonts naar Spans';
protected $AX_ED_CNVFONTSPAND = 'Converteer Font elementen naar Span elementen. Standaard is ja omdat font elementen  zijn afgekeurd.';
protected $AX_ED_FONTSIZETYPEL = 'Type Fontgrootte';
protected $AX_ED_FONTSIZETYPED = 'Kies het type fontgrootte dat moet gebruikt worden, ofwel length bijv: 10pt, ofwel absolute-size bijv: x-small.';
protected $AX_ED_INLTABLEDITL = 'Ingesloten tabel bewerking';
protected $AX_ED_INLTABLEDITD = 'Maakt ingesloten bewerken van tabellen mogelijk.';
protected $AX_ED_PROHELEMENTSL = 'Verboden elementen';
protected $AX_ED_PROHELEMENTSD = 'Elementen die uit de tekst verwijderd zullen worden';
protected $AX_ED_EXTELEMENTSL = 'Uitgebreide elementen';
protected $AX_ED_EXTELEMENTSD = 'Breid hier de functionaliteit van TinyMCE uit door het toevoegen van extra elementen. Formaat: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Gebeurtenis Elementen';
protected $AX_ED_EVELEMENTSD = 'Deze optie zou een komma gescheiden lijst van elementen moeten bevatten die gebeurtenis attributen mogen hebben zoals onclick en soortgelijke. Deze optie is nodig omdat sommige browsers deze gebeurtenissen uitvoeren tijdens het bewerken van artikelen.';
protected $AX_ED_TCSSCLASSESL = 'Template CSS classen';
protected $AX_ED_TCSSCLASSESD = 'Laad CSS classen van template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Aangepaste CSS Classen';
protected $AX_ED_CCSSCLASSESD = 'Je kan een aangepast CSS bestand opgeven om te laden - geef de naam van het vervangende CSS bestand. Dit bestand MOET zich bevinden in dezelfde map als uw template CSS bestand.';
protected $AX_ED_NEWLINESL = 'Nieuwe regels';
protected $AX_ED_NEWLINESD = 'Nieuwe regels zullen aangemaakt worden in de geselecteerde optie';
protected $AX_ED_TOOLBARL = 'Toolbar';
protected $AX_ED_TOOLBARD = 'Positie van de toolbar';
protected $AX_ED_HTMLHEIGHTL = 'HTML Hoogte';
protected $AX_ED_HTMLHEIGHTD = 'Hoogte van het HTML mode pop-up venster.';
protected $AX_ED_HTMLWIDTHL = 'HTML Breedte';
protected $AX_ED_HTMLWIDTHD = 'Breedte van het HTML mode pop-up venster.';
protected $AX_ED_PREVIEWHEIGHTL = 'Hoogte Voorbeeld';
protected $AX_ED_PREVIEWHEIGHTD = 'Hoogte van het voorbeeld mode pop-up venster.';
protected $AX_ED_PREVIEWWIDTHL = 'Breedte voorbeeld';
protected $AX_ED_PREVIEWWIDTHD = 'Breedte van het voorbeeld mode pop-up venster.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser is een geavanceerde afbeeldingen beheerder';
protected $AX_ED_PLTABLESL = 'Tabellen Plugin';
protected $AX_ED_PLTABLESD = 'Inschakelen van de tabellen bewerker in WYSIWYG mode.';
protected $AX_ED_PLPASTEL = 'Plakken Plugin';
protected $AX_ED_PLPASTED = 'Inschakelen van plakken vanuit Word, plakken plain tekst en alles selecteren.';
protected $AX_ED_PLIMGPLUGINL = 'Geavanceerde Afbeeldingen Plugin';
protected $AX_ED_PLIMGPLUGIND = 'Inschakelen van de Geavanceerde Afbeeldingen Beheerder. Standaard is de eenvoudige afbeeldingen bewerker ingeschakeld.';
protected $AX_ED_PLSEARCHL = 'Zoeken/Vervangen Plugin';
protected $AX_ED_PLSEARCHD = 'Inschakelen van de zoeken en vervangen plugin.';
protected $AX_ED_PLLINKSL = 'Geavanceerde weblinks Plugin';
protected $AX_ED_PLLINKSD = 'Inschakelen van de geavanceerde weblinks beheerder. Standaard is de eenvoudige weblinks bewerker ingeschakeld.';
protected $AX_ED_PLEMOTL = 'Emoties Plugin';
protected $AX_ED_PLEMOTD = 'Inschakelen van de emoties Plugin. Je kan gemakkelijk Emoticons toevoegen.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Inschakelen van de Flash Plugin. Maakt het mogelijk om Flash multimedia toe te voegen aan het artikel.';
protected $AX_ED_PLDTL = 'Datum/Tijd Plugin';
protected $AX_ED_PLDTD = 'Inschakelen van de datum/tijd Plugin. Maakt het mogelijk de huidige datum en tijd toe te voegen in het artikel.';
protected $AX_ED_PLPREVL = 'Voorbeeld Plugin';
protected $AX_ED_PLPREVD = 'Deze plugin voegt een voorbeeld knop to aan TinyMCE, drukken op de knoop opent een pop-up venster dat de huidige inhoud toont.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Voegt een zoom Drop-Down Box toe in MSIE5.5+, deze plugin is vooral bedoeld om te tonen hoe je een aangepaste Drop-Down Box moet toevoegen als een plugin.';
protected $AX_ED_PLFSCRL = 'Volledig Scherm Plugin';
protected $AX_ED_PLFSCRD = 'Deze plugin voegt een volledig scherm bewerkings mode toe aan TinyMCE.';
protected $AX_ED_PLPRINTL = 'Print Plugin';
protected $AX_ED_PLPRINTD = 'Deze plugin voegt een print knop toe aan TinyMCE.';
protected $AX_ED_PLDIRL = 'Richting Plugin';
protected $AX_ED_PLDIRD = 'Deze plugin voegt richtings iconen toe aan TinyMCE. Hiermee kan TinyMCE beter talen met schrijfrichting van rechts naar links ondersteunen.';
protected $AX_ED_PLFONTSL = 'Font Selectie Lijst';
protected $AX_ED_PLFONTSD = 'Deze plugin voegt een font selectie drop-down lijst toe.';
protected $AX_ED_PLFONTSZL = 'Font Grootte Lijst';
protected $AX_ED_PLFONTSZD = 'Deze plugin voegt een font grootte selectie drop-down lijst toe.';
protected $AX_ED_PLFORMLSL = 'Formaat Lijst';
protected $AX_ED_PLFORMLSD = 'Deze plugin voegt een formaat drop-down lijst toe (H1, H2, enz.)';
protected $AX_ED_PLSSLL = 'Stijl Selectie Lijst';
protected $AX_ED_PLSSLD = 'Deze plugin voegt een stijl selectie lijst toe, die gebaseerd is op de huidige template of een CSS bestand dat je hebt geselecteerd.';
protected $AX_ED_NAMED = 'Genaamd';
protected $AX_ED_NUMERIC = 'Numeriek';
protected $AX_ED_RAW = 'Ruw';
protected $AX_ED_LTR = 'Links naar rechts';
protected $AX_ED_RTL = 'Rechts naar links';
protected $AX_ED_LENGTH = 'Lengte';
protected $AX_ED_ABSSIZE = 'Absolute-Grootte';
protected $AX_ED_BRELEMENTS = 'BR Elementen';
protected $AX_ED_PELEMENTS = 'P Elementen';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Rekenmachine';
protected $AX_TCAL_D = 'Een geavanceerd javascript rekenmachine';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Maak tijdelijke map leeg';
protected $AX_TEMTEMP_D = 'Maakt de tijdelijke map van Elxis leeg (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Taal herstellen';
protected $AX_TFIXLANG_D = 'Doet een controle in meertalige database tabellen en brengt herstellingen aan waar nodig.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Agenda';
protected $AX_TORGANIZ_D = 'Elxis Agenda houd uw contacten, notas, bladwijzers en afspraken bij.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Wis Cache';
protected $AX_TCLEANCACHE_D = 'Wist artikelen en afbeeldingen uit de cache map';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Wijzig rechten';
protected $AX_TCHMOD_D = 'Wijzigt de rechten van een bepaald bestand of map';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Herstel Postgres Sequenties';
protected $AX_TFPGSEQ_D = 'Herstelt Postgres sequenties indien nodig.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxis registratie';
protected $AX_TELXREG_D = 'Registreer uw Elxis installatie bij Elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Brug';
protected $AX_BRIDGE_CDESC = 'Maakt een weblink naar een brug.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Nieuwe regel';
protected $AX_SAME_LINE = 'Dezelfde regel';
protected $AX_INDICATOR = 'Aanwijzer';
protected $AX_INDICATOR_D = 'Toont het woord taal als een aanwijzer';
protected $AX_FLAG = 'Vlag';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Toont de Front-End taalselectie als een drop-down lijst, weblinks lijst, of een serie vlaggen.';
protected $AX_FLAGS = 'Vlaggen';
protected $AX_SMARTSW = 'Slimme schakelaar';
protected $AX_SMARTSW_D = 'Laat je van taal wisselen en onder bepaalde condities op dezelfde pagina blijven';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Toont willekeurige gebruikers profielen';
protected $AX_DISPSTYLE = 'Toont Stijl';
protected $AX_COMPACT = 'Compact';
protected $AX_EXTENDED = 'Uitgebreid';
protected $AX_GENDER = 'Geslacht';
protected $AX_GENDERDESC = 'Toon gebruikers geslacht?';
protected $AX_AGE = 'Leeftijd';
protected $AX_AGEDESC = 'Toon gebruikers leeftijd?';
protected $AX_REALUNAME = 'Toon echte naam van de gebruiker?';
//weblinks item
protected $AX_WBLI_TL = 'Doel';
//content
protected $AX_RTFICL = 'RTF Icoon';
protected $AX_RTFICD = 'Toon/Verberg de RTF knop - enkel van toepassing op deze pagina.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filter Groepen';
protected $AX_MODWHO_FILGRD = 'Als ja, dan zullen gebruikers met een lager toegangsniveau (bezoekers) de login status van gebruikers met een hoger toegansniveau niet kunnen zien.';
//search bots
protected $AX_SEARCH_LIMIT = 'zoek limiet';
protected $AX_MAXNUM_SRES = 'Maximum aantal zoek resultaten';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Toont een overzicht van de laatste website toevoegingen. Ideaal voor de hoofdpagina.'; 
protected $AX_SECTIONS = 'Secties';
protected $AX_SECTIONSD = 'Sectie IDs, komma gescheiden (,)';
protected $AX_CATEGORIES = 'Categorieën';
protected $AX_CATEGORIESD = 'Categorie IDs, komma gescheiden (,)';
protected $AX_NUMDAYS = 'Aantal dagen';
protected $AX_NUMDAYSD = 'Toont artikelen die gemaakt zijn in de laatste X dagen (standaard waarde is 900)';
protected $AX_SHOWTHUMBS = 'Toon miniaturen';
protected $AX_SHOWTHUMBSD = 'Toon/Verberg miniatuur afbeeldingen in de intro tekst';
protected $AX_THUMBWIDTHD = 'Breedte van de miniatuur afbeeldingen in pixels';
protected $AX_THUMBHEIGHTD = 'Hoogte van de miniatuur afbeeldingen in pixels';
protected $AX_KEEPRATIO = 'Behoud verhoudingen';
protected $AX_KEEPRATIOD = 'Behoud de afbeeldings verhoudingen. Als ja, dan speelt de hoogte parameter hierboven geen rol.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog Item';
protected $AX_EBLOGITEMD = 'Maakt een weblink naar een gepubliceerd eBlog blog';
//2009.0
protected $AX_COMMENTARY = 'Commentaar';
protected $AX_COMMENTARYD = 'Selecteer wie commentaar mag geven op dit artikel.';
protected $AX_NOONE = 'Niemand';
protected $AX_REGUSERS = 'Geregistreerde gebruikers';
protected $AX_ALL = 'Iedereen';
protected $AX_COMMENTS = 'Commentaar';
protected $AX_COMMENTSD = 'Toon commentaar aantal?';

}

?>