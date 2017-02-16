<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin/XML Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008/2009: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class xmlLanguage extends standardLanguage {

function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Obrázek menu';
protected $AX_MENUIMGD = 'Malý obrázek umístěný vpravo nebo vlevo vaší položky nabídky. Obrázek musí být umístěný v adresáři images/stories/ .';
protected $AX_MENUIMGONLYL = 'Použití jen obrázku nabídky';
protected $AX_MENUIMGONLYD = 'Při volbě <strong>Ano</strong> bude položka prezentována pouze zvoleným obrázkem.<br /><br />Při volbě <strong>Ne</strong> bude zobrazen obrázek i text.';
protected $AX_MENUIMG2D = 'Malý obrázek umístěný vpravo nebo vlevo vaší položky nabídky. Obrázek musí být umístěný v adresáři images/.';
protected $AX_PAGCLASUFL = 'Přípona stylu stránky';
protected $AX_PAGCLASUFD = 'Přípona aplikovaná na CSS styl stránky. To dovoluje individuální stránkový styl.';
protected $AX_TEXTPAGECL = 'Přípona článku';
protected $AX_TEXTPAGECLD = 'Přípona aplikovaná na CSS styl článku. To dovoluje individuální styl článku.';
protected $AX_BACKBUTL = 'Tlačítko Zpět';
protected $AX_BACKBUTD = 'Ukázat/Skrýt tlačítko Zpět, které vrací na předtím otevřenou stránku.';
protected $AX_USEGLB = 'Použít globální';
protected $AX_HIDE = 'Skrýt';
protected $AX_SHOW = 'Ukázat';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Zobrazit Titul stránky';
protected $AX_PAGTITLSD = 'Zobrazit/Skrýt Titul stránky.';
protected $AX_PAGTITLL = 'Titul stránky';
protected $AX_PAGTITLD = 'Text zobrazený nahoře stránky.';
protected $AX_PAGTITL2D = 'Text zobrazený nahoře stránky.';
protected $AX_LEFT = 'Vlevo';
protected $AX_RIGHT = 'Vpravo';
protected $AX_PRNTICOL = 'Ikona Tisk';
protected $AX_PRNTICOD = 'Ukázat/Skrýt ikonu pro Tisk - volba pouze pro tuto stránku.';
protected $AX_YES = 'Ano';
protected $AX_NO = 'Ne';
protected $AX_SECNML = 'Jméno sekce';
protected $AX_SECNMD = 'Ukázat/Skrýt do jaké sekce článek patří.';
protected $AX_SECNMLL = 'Klikatelné jméno sekce';
protected $AX_SECNMLD = 'Text odkazuje na stránku výpisu obsahu aktuální sekce.';
protected $AX_CATNML = 'Jméno kategorie';
protected $AX_CATNMD = 'Ukázat/Skrýt do jaké kategorie článek patří.';
protected $AX_CATNMLL = 'Klikatelné jméno kategorie';
protected $AX_CATNMLD = 'Text odkazuje na stránku výpisu obsahu aktuální kategorie.';
protected $AX_LNKTTLL = 'Klikatelný titul';
protected $AX_LNKTTLD = 'Titul odkazuje na aktuální článek.';
protected $AX_ITMRATL = 'Hodnocení';
protected $AX_ITMRATD = 'Ukázat/Skrýt hodnocení článku - volba pouze pro tuto stránku.';
protected $AX_AUTNML = 'Jméno autora';
protected $AX_AUTNMD = 'Ukázat/Skrýt jméno autora - volba pouze pro tuto stránku.';
protected $AX_CTDL = 'Datum a čas vytvoření';
protected $AX_CTDD = 'Ukázat/Skrýt datum a čas vytvoření - volba pouze pro tuto stránku.';
protected $AX_MTDL = 'Datum a čas úpravy';
protected $AX_MTDD = 'Ukázat/Skrýt datum a čas poslední úpravy - volba pouze pro tuto stránku.';
protected $AX_PDFICL = 'Ikonka PDF';
protected $AX_PDFICD = 'Ukázat/Skrýt ikonkové tlačítko PDF - volba pouze pro tuto stránku.';
protected $AX_PRICL = 'Ikonka Tisk';
protected $AX_PRICD = 'Ukázat/Skrýt ikonkové tlačítko pro tisk - volba pouze pro tuto stránku.';
protected $AX_EMICL = 'Ikonka Email';
protected $AX_EMICD = 'Ukázat/Skrýt ikonkové tlačítko Email - volba pouze pro tuto stránku.';
protected $AX_FTITLE = 'Titul';
protected $AX_FAUTH = 'Autor';
protected $AX_FHITS = 'Hitů';
protected $AX_DESCRL = 'Popis';
protected $AX_DESCRD = 'Ukázat/Skrýt dolní popis.';
protected $AX_DESCRTXL = 'Text popisu';
protected $AX_DESCRTXD = 'Popis pro stránku.';
protected $AX_IMAGEL = 'Obrázek';
protected $AX_IMGFRPD = 'Obrázek stránky musí být umístěn v adresáři /images/stories/. Defaultně je nahráván web_links.jpg. -Nepoužít obrázek- znamená, že obrázek nebude zobrazen.';
protected $AX_IMGALL = 'Zarovnání obrázku';
protected $AX_IMGALD = 'Zarovnání obrázku k textu.';
protected $AX_TBHEADL = 'Hlavy tabulky';
protected $AX_TBHEADD = 'Ukázat/Skrýt hlavy tabulky.';
protected $AX_POSCOLL = 'Sloupec Pozice';
protected $AX_POSCOLD = 'Ukázat/Skrýt sloupec Pozice.';
protected $AX_EMAILCOLL = 'Sloupec Email';
protected $AX_EMAILCOLD = 'Ukázat/Skrýt sloupec Email.';
protected $AX_TELCOLL = 'Sloupec Telefon';
protected $AX_TELCOLD = 'Ukázat/Skrýt sloupec Telefon.';
protected $AX_FAXCOLL = 'Sloupec Fax';
protected $AX_FAXCOLD = 'Ukázat/Skrýt sloupec Fax.';
protected $AX_LEADINGL = '# Základní';
protected $AX_LEADINGD = 'Počet položek zobrazených jako základní (plná šíře). 0 znamená, že žádná položka nebude zobrazena.';
protected $AX_INTROL = '# Úvod';
protected $AX_INTROD = 'Množství položek zobrazených jako úvodních.';
protected $AX_COLSL = 'Sloupců';
protected $AX_COLSD = 'Výběr počtu sloupců pro zobrazování úvodních položek.';
protected $AX_LNKSL = '# Odkazů';
protected $AX_LNKSD = 'Počet položek zobrazených jako odkaz.';
protected $AX_CATORL = 'Pořadí kategorie';
protected $AX_CATORD = 'Pořadí položek v kategorii.';
protected $AX_OCAT01 = 'Bez pořadí, pouze původní';
protected $AX_OCAT02 = 'Titul abecedně';
protected $AX_OCAT03 = 'Titul abecedně - reverzně';
protected $AX_OCAT04 = 'Řazení';
protected $AX_PRMORL = 'Primární řazení';
protected $AX_PRMORD = 'Řazení položek zobrazených v.';
protected $AX_OPRM01 = 'Výchozí';
protected $AX_OPRM02 = 'Řazení úvodní stránky';
protected $AX_OPRM03 = 'První nejstarší';
protected $AX_OPRM04 = 'První nejnovější';
protected $AX_OPRM07 = 'Autor abecedně';
protected $AX_OPRM08 = 'Autor abecedně - reverzně';
protected $AX_OPRM09 = 'Nejvíce Hitů';
protected $AX_OPRM10 = 'Nejméně Hitů';
protected $AX_PAGL = 'Stránkování';
protected $AX_PAGD = 'Ukázat/Skrýt stránkování.';
protected $AX_PAGRL = 'Výsledky stránkování';
protected $AX_PAGRD = 'Ukázat/Skrýt info výsledku stránkování ( 1-4 ze 4 ).';
protected $AX_MOSIL = 'MOSobrázek';
protected $AX_MOSID = 'Zobrazit {mosimages}.';
protected $AX_ITMTL = 'Položky Titulů';
protected $AX_ITMTD = 'Ukázat/Skrýt položky Titulů.';
protected $AX_REMRL = 'Čtěte více';
protected $AX_REMRD = 'Ukázat/Skrýt odkaz Čtěte více.';
protected $AX_OTHCATL = 'Další kategorie';
protected $AX_OTHCATD = 'Při prohlížení kategorie, Ukázat/Skrýt výpis dalších kategorií.';
protected $AX_TDISTPD = 'Text zobrazený na vrcholu stránky.';
protected $AX_ORDBYL = 'Pořadí v';
protected $AX_ORDBYD = 'Potlačuje pořadí položek.';
protected $AX_MCS_DESCL = 'Popis';
protected $AX_SHCDESD = 'Ukázat/Skrýt popis kategorie.';
protected $AX_DESCIL = 'Popis obrázku';
protected $AX_MUDATFL = 'Formát datumu';
protected $AX_MUDATFD = "Zobrazovaný formát datumu (PHP) - pokud zůstane prázdný, bude použit dle jazykového souboru.";
protected $AX_MUDATCL = 'Sloupec Datum';
protected $AX_MUDATCD = 'Ukázat/Skrýt sloupec datumu.';
protected $AX_MUAUTCL = 'Sloupec Autor';
protected $AX_MUAUTCD = 'Ukázat/Skrýt sloupec Autor.';
protected $AX_MUHITCL = 'Sloupec Hitů';
protected $AX_MUHITCD = 'Ukázat/Skrýt sloupec Hitů.';
protected $AX_MUNAVBL = 'Navigační bar';
protected $AX_MUNAVBD = 'Ukázat/Skrýt Navigační bar.';
protected $AX_MUORDSL = 'Vybrat pořadí';
protected $AX_MUORDSD = 'Ukázat/Skrýt výběr pořadí.';
protected $AX_MUDSPSL = 'Volba zobrazení';
protected $AX_MUDSPSD = 'Ukázat/Skrýt volbu zobrazení.';
protected $AX_MUDSPNL = 'Zobrazit položek';
protected $AX_MUDSPND = 'Standardní počet zobrazených položek.';
protected $AX_MUFLTL = 'Filtr';
protected $AX_MUFLTD = 'Ukázat/Skrýt možnosti filtru.';
protected $AX_MUFLTFL = 'Pole filtru';
protected $AX_MUFLTFD = 'Výběr pole aplikovaného na filtr.';
protected $AX_MUOCATL = 'Další kategorie';
protected $AX_MUOCATD = 'Ukázat/Skrýt výpis dalších kategorií.';
protected $AX_MUECATL = 'Prázdné kategorie';
protected $AX_MUECATD = 'Ukázat/Skrýt zobrazení prázdných kategorií.';
protected $AX_CATDSCL = 'Popis kategorie';
protected $AX_CATDSBLND = 'Ukázat/Skrýt popis kategorie zobrazeného pod titulem kategorie.';
protected $AX_NAMCOLL = 'Sloupec Jméno';
protected $AX_LINKDSCL = 'Popis odkazu';
protected $AX_LINKDSCD = 'Ukázat/Skrýt textový popis pro odkaz.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Komponenta zobrazuje seznam kontaktních informací.';
protected $AX_CCT_CATLISTSL = 'Seznam kategorií - Sekce';
protected $AX_CCT_CATLISTSD = 'Ukázat/Skrýt seznam kategorií na stránce.';
protected $AX_CCT_CATLISTCL = 'Seznam kategorií - Kategorie';
protected $AX_CCT_CATLISTCD = 'Ukázat/Skrýt seznam kategorií zobrazených v tabulce na stránce.';
protected $AX_CCT_CATDSCD = 'Ukázat/Skrýt popis dalších kategorií na stránce.';
protected $AX_CCT_NOCATITL = '# Položky kategorie';
protected $AX_CCT_NOCATITD = 'Ukázat/Skrýt počet položek v kategorii.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parametry pro individuální kontaktní položky.';
protected $AX_CIT_NAMEL = 'Jméno';
protected $AX_CIT_NAMED = 'Ukázat/Skrýt jméno kontaktu.';
protected $AX_CIT_POSITL = 'Pozice';
protected $AX_CIT_POSITD = 'Ukázat/Skrýt pozici kontaktu.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Ukázat/Skrýt email kontaktu. Při volbě ukázat, bude emailová adresa chráněna JavaSkriptem proti spamovým robotům.';
protected $AX_CIT_SADDREL = 'Ulice';
protected $AX_CIT_SADDRED = 'Ukázat/Skrýt položku ulice.';
protected $AX_CIT_TOWNL = 'Město';
protected $AX_CIT_TOWND = 'Ukázat/Skrýt položku Město.';
protected $AX_CIT_STATEL = 'Okres';
protected $AX_CIT_STATED = 'Ukázat/Skrýt položku Okres.';
protected $AX_CIT_COUNTRL = 'Stát';
protected $AX_CIT_COUNTRD = 'Ukázat/Skrýt položku Stát.';
protected $AX_CIT_ZIPL = 'PSČ';
protected $AX_CIT_ZIPD = 'Ukázat/Skrýt položku PSČ.';
protected $AX_CIT_TELL = 'Telefon';
protected $AX_CIT_TELD = 'Ukázat/Skrýt telefonní číslo.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Ukázat/Skrýt faxové číslo.';
protected $AX_CIT_MISCL = 'Rozšířené Info';
protected $AX_CIT_MISCD = 'Ukázat/Skrýt doplňující informace o kontaktu.';
protected $AX_CIT_VCARDL = 'Vizitka';
protected $AX_CIT_VCARDD = 'Ukázat/Skrýt vizitku.';
protected $AX_CIT_CIMGL = 'Obrázek';
protected $AX_CIT_CIMGD = 'Ukázat/Skrýt obrázek kontaktu.';
protected $AX_CIT_DEMAILL = 'Popis emailu';
protected $AX_CIT_DEMAILD = 'Ukázat/Skrýt popis emailu.';
protected $AX_CIT_DTXTL = 'Text popisu';
protected $AX_CIT_DTXTD = 'Popis u emailového formuláře. Pokud necháte pole prázdné, bude použit text z jazykových souborů.';
protected $AX_CIT_EMFRML = 'Emailový formulář';
protected $AX_CIT_EMFRMD = 'Ukázat/Skrýt emailový formulář.';
protected $AX_CIT_EMCPYL = 'Kopie emailu';
protected $AX_CIT_EMCPYD = 'Ukázat/Skrýt možnost zaslání kopie emailu na adresu odesílatele.';
protected $AX_CIT_DDL = 'Volba ze seznamu';
protected $AX_CIT_DDD = 'Ukázat/Skrýt možnost výběru z více kontaktů.';
protected $AX_CIT_ICONTXL = 'Ikona/text';
protected $AX_CIT_ICONTXD = 'Použít ikonky, text nebo nic vedle kontaktních informací.';
protected $AX_CIT_ICONS = 'Ikonky';
protected $AX_CIT_TEXT = 'Text';
protected $AX_CIT_NONE = 'Nic';
protected $AX_CIT_ADICONL = 'Ikonka adresy';
protected $AX_CIT_ADICOND = 'Ikonka k položce adresa';
protected $AX_CIT_EMICONL = 'Ikonka emailu';
protected $AX_CIT_EMICOND = 'Ikonka emailu.';
protected $AX_CIT_TLICONL = 'Ikonka telefonu';
protected $AX_CIT_TLICOND = 'Ikonka telefonu.';
protected $AX_CIT_FXICONL = 'Ikonka faxu';
protected $AX_CIT_FXICOND = 'Ikonka faxu.';
protected $AX_CIT_MCICONL = 'Ikonka Info';
protected $AX_CIT_MCICOND = 'Ikonka rozšířených informací o kontaktu.';
protected $AX_CCT_NAMEL = 'Jméno';
protected $AX_CCT_NAMED = 'Ukázat/Skrýt jméno kontaktu.';
protected $AX_CCT_POSITL = 'Pozice';
protected $AX_CCT_POSITD = 'Ukázat/Skrýt pozici kontaktu.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Ukázat/Skrýt email kontaktu. Při volbě ukázat, bude emailová adresa chráněna JavaSkriptem proti spamovým robotům.';
protected $AX_CCT_SADDREL = 'Ulice';
protected $AX_CCT_SADDRED = 'Ukázat/Skrýt položku ulice.';
protected $AX_CCT_TOWNL = 'Město';
protected $AX_CCT_TOWND = 'Ukázat/Skrýt položku Město.';
protected $AX_CCT_STATEL = 'Okres';
protected $AX_CCT_STATED = 'Ukázat/Skrýt položku Okres.';
protected $AX_CCT_COUNTRL = 'Stát';
protected $AX_CCT_COUNTRD = 'Ukázat/Skrýt položku Stát.';
protected $AX_CCT_ZIPL = 'PSČ';
protected $AX_CCT_ZIPD = 'Ukázat/Skrýt položku PSČ.';
protected $AX_CCT_TELL = 'Telefon';
protected $AX_CCT_TELD = 'Ukázat/Skrýt telefonní číslo.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Ukázat/Skrýt faxové číslo.';
protected $AX_CCT_MISCL = 'Rozšířené Info';
protected $AX_CCT_MISCD = 'Ukázat/Skrýt doplňující informace o kontaktu.';
protected $AX_CCT_VCARDL = 'Vizitka';
protected $AX_CCT_VCARDD = 'Ukázat/Skrýt vizitku.';
protected $AX_CCT_CIMGL = 'Obrázek';
protected $AX_CCT_CIMGD = 'Ukázat/Skrýt obrázek kontaktu.';
protected $AX_CCT_DEMAILL = 'Popis emailu';
protected $AX_CCT_DEMAILD = 'Ukázat/Skrýt popis emailu.';
protected $AX_CCT_DTXTL = 'Text popisu';
protected $AX_CCT_DTXTD = 'Popis u emailového formuláře. Pokud necháte pole prázdné, bude použit text z jazykových souborů.';
protected $AX_CCT_EMFRML = 'Emailový formulář';
protected $AX_CCT_EMFRMD = 'Ukázat/Skrýt emailový formulář';
protected $AX_CCT_EMCPYL = 'Kopie emailu';
protected $AX_CCT_EMCPYD = 'Ukázat/Skrýt možnost zaslání kopie emailu na adresu odesílatele.';
protected $AX_CCT_DDL = 'Volba kontaktu';
protected $AX_CCT_DDD = 'Ukázat/Skrýt možnost výběru z více kontaktů.';
protected $AX_CCT_ICONTXL = 'Ikona/text';
protected $AX_CCT_ICONTXD = 'Použít ikonky, text nebo nic vedle kontaktních informací.';
protected $AX_CCT_ICONS = 'Ikonky';
protected $AX_CCT_TEXT = 'Text';
protected $AX_CCT_NONE = 'Nic';
protected $AX_CCT_ADICONL = 'Ikonka adresy';
protected $AX_CCT_ADICOND = 'Ikonka k položce adresa.';
protected $AX_CCT_EMICONL = 'Ikonka emailu';
protected $AX_CCT_EMICOND = 'Ikonka emailu.';
protected $AX_CCT_TLICONL = 'Ikonka telefonu';
protected $AX_CCT_TLICOND = 'Ikonka telefonu.';
protected $AX_CCT_FXICONL = 'Ikonka faxu';
protected $AX_CCT_FXICOND = 'Ikonka faxu.';
protected $AX_CCT_MCICONL = 'Ikonka Info';
protected $AX_CCT_MCICOND = 'Ikonka rozšířených informací o kontaktu.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Zobrazí stránku s obsahem.';
protected $AX_CNT_INTEXTL = 'Úvodní text';
protected $AX_CNT_INTEXTD = 'Ukázat/Skrýt úvodní text.';
protected $AX_CNT_KEYRL = 'Klíčový odkaz';
protected $AX_CNT_KEYRD = 'Textový klíč položky (pomocný odkaz).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Komponenta zobrazí všechny položky určené k zobrazení na titulní stránce Vašeho webu.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parametry pro individuální kontaktní položky.';
protected $AX_LG_LPTL = 'Titul přihlašovací stránky';
protected $AX_LG_LPTD = 'Text zobrazený na vrcholu stránky.';
protected $AX_LG_LRURLL = 'URL přesměrování po přihlášení';
protected $AX_LG_LRURLD = 'Url stránky, na kterou se automaticky přesměruje po přihlášení do systému. Při nevyplnění zůstává nastavena titulní stránka.';
protected $AX_LG_LJSML = 'Přihlašovací JS zpráva';
protected $AX_LG_LJSMD = 'Ukázat/Skrýt javascript pop-up okno po přihlášení.';
protected $AX_LG_LDESCL = 'Popis přihlášení';
protected $AX_LG_LDESCD = 'Ukázat/Skrýt popis přihlášení.';
protected $AX_LG_LDESTL = 'Text přihlášení';
protected $AX_LG_LDESTD = 'Text zobrazený na titulní stránce.';
protected $AX_LG_LIMGL = 'Obrázek přihlášení';
protected $AX_LG_LIMGD = 'Obrázek pro přihlašovací stránku.';
protected $AX_LG_LIMGAL = 'Pozice přihlašovacího obrázku';
protected $AX_LG_LIMGAD = 'Zarovnání přihlašovacího obrázku.';
protected $AX_LG_LOPTL = 'Titul stránky odhlášení';
protected $AX_LG_LOPTD = 'Text zobrazený nahoře stránky po odhlášení uživatele.';
protected $AX_LG_LORURLL = 'URL přesměrování po odhlášení';
protected $AX_LG_LORURLD = 'Url stránky, na kterou se automaticky přesměruje po odhlášení ze systému. Při nevyplnění zůstává nastavena titulní stránka.';
protected $AX_LG_LOJSML = 'Odhlašovací JS zpráva';
protected $AX_LG_LOJSMD = 'Ukázat/Skrýt javascript pop-up zprávu po odhlášení.';
protected $AX_LG_LODSCL = 'Popis odhlášení';
protected $AX_LG_LODSCD = 'Ukázat/Skrýt popis odhlášení.';
protected $AX_LG_LODSTL = 'Text popisu odhlášení';
protected $AX_LG_LODSTD = 'Text zobrazený na odhlašovací stránce.';
protected $AX_LG_LOGOIL = 'Obrázek odhlášení';
protected $AX_LG_LOGOID = 'Obrázek odhlašovací stránky.';
protected $AX_LG_LOGOIAL = 'Pozice odhlašovacího obrázku';
protected $AX_LG_LOGOIAD = 'Zarovnání pro odhlašovací obrázek.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Komponenta dovoluje zaslat hromadný email zvolené skupině uživatelů.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Komponenta pro správu obsahu médií stránek.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Komponenta pro správu Vašeho menu.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Odkaz - Komponent';
protected $AX_MUCIL_CDESC = 'Vytvoří odkaz na existující Elxis komponentu.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Komponent';
protected $AX_MUCOMP_CDESC = 'Zobrazuje rozhraní pro Komponentu hlavních stránek.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabulka - Kontakty v kategorii';
protected $AX_MUCCT_CDESC = 'Zobrazí tabulku kontaktů ve zvolené kategorii.';
protected $AX_MUCCT_CATDL = 'Popis kategorie';
protected $AX_MUCCT_CATDD = 'Ukázat/Skrýt popis ve výpisu dalších kategorií.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Odkaz - Kontakt';
protected $AX_MUCTIL_CDESC = 'Vytvoří odkaz na vybraný kontakt';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Archivované články v kategorii';
protected $AX_MUCAC_CDESC = 'Vypíše seznam článků v archivu pro zvolenou kategorii.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Archivované články v sekci';
protected $AX_MUCAS_CDESC = 'Vypíše seznam článků v archivu pro zvolenou sekci.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Obsah kategorie(í)';
protected $AX_MUCBC_CDESC = 'Zobrazí stránku se články i z více kategorií v Blog formátu.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Obsah sekci(í)';
protected $AX_MUCBS_CDESC = 'Zobrazí stránku se články i z více sekcí v Blog formátu.';
protected $AX_MUCBS_SHSD = 'Ukázat/Skrýt popis sekce.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabulka - Obsah kategorie';
protected $AX_MUCC_CDESC = 'Zobrazí tabulku s výpisem článků ve zvolené kategorii.';
protected $AX_MUCC_SHLOCD = 'Ukázat/Skrýt výpis dalších kategorií.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Odkaz - Článek';
protected $AX_MCIL_CDESC = 'Vytvoří odkaz na určitý článek pro jeho plné zobrazení.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabulka - Obsah sekce';
protected $AX_MCS_CDESC = 'Zobrazí tabulku s výpisem článků ve zvolené kategorii.';
protected $AX_MCS_STL = 'Titul sekce';
protected $AX_MCS_STD = 'Ukázat/Skrýt titul sekce.';
protected $AX_MCS_SHCTID = 'Ukázat/Skrýt popis obrázku kategorie.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Odkaz - Autonomní stránka';
protected $AX_MLSC_CDESC = 'Vytvoří odkaz na autonomní stránku.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabulka - Kategorie Newsfeed';
protected $AX_MNSFC_CDESC = 'Zobrazí tabulku obsahu Newsfeed položek ve zvolené kategorii.';
protected $AX_MNSFC_SHNCD = 'Ukázat/Skrýt sloupeček Jméno.';
protected $AX_MNSFC_ACL = 'Sloupec Článek';
protected $AX_MNSFC_ACD = 'Ukázat/Skrýt sloupeček Článek.';
protected $AX_MNSFC_LCL = 'Sloupec Obsah';
protected $AX_MNSFC_LCD = 'Ukázat/Skrýt sloupeček Obsah.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Odkaz - Newsfeed';
protected $AX_MNSFL_CDESC = 'Vytvoří odkaz na zvolenou publikovanou Newsfeed zprávu.';
protected $AX_MNSFL_FDIML = 'Obrázek Feedu';
protected $AX_MNSFL_FDIMD = 'Ukázat/Skrýt obrázek pro feed.';
protected $AX_MNSFL_FDDSL = 'Popis Feedu';
protected $AX_MNSFL_FDDSD = 'Ukázat/Skrýt popis pro feed.';
protected $AX_MNSFL_WDCL = 'Počet slov';
protected $AX_MNSFL_WDCD = 'Dovoluje omezit délku zobrazovaného popisu. 0 znamená celý text.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Oddělovač';
protected $AX_MSEP_CDESC = 'Vytvoří oddělovač v menu.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Odkaz - Url';
protected $AX_MURL_CDESC = 'Vytvoří odkaz na URL. Je možné zadal i lokální adresu na Vašem serveru.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabulka - Kategorie odkazů';
protected $AX_MWLC_CDESC = 'Zobrazí tabulku s obsahem odkazů ve zvolené kategorii.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Iframe';
protected $AX_MWRP_CDESC = 'Vytvoří iframe okno pro zobrazení externí stránky.';
protected $AX_MWRP_SCRBL = 'Posuvné lišty';
protected $AX_MWRP_SCRBD = 'Ukázat/Skrýt Horizontální & Vertikální posuvné lišty.';
protected $AX_MWRP_WDTL = 'Šířka';
protected $AX_MWRP_WDTD = 'Šířka IFrame okna. Lze zadat absolutní hodnotu v px nebo relativní v %.';
protected $AX_MWRP_HEIL = 'Výška';
protected $AX_MWRP_HEID = 'Výška IFrame okna.';
protected $AX_MWRP_AHL = 'Autovýška';
protected $AX_MWRP_AHD = 'Automatické nastavení výšky okna dle externí stránky. TUTO FUNKCI LZE POUŽÍT POUZE PRO STRÁNKY NA VAŠÍ DOMÉNĚ!.';
protected $AX_MWRP_AADL = 'Autoprotekt';
protected $AX_MWRP_AADD = 'Výchozí http:// bude funkční http:// i https://. Toto nastavení dovoluje tuto funkci vypnout.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Systémový odkaz';
protected $AX_MSYS_CDESC = 'Vytvoří odkaz na zvolenou systémovou funkci';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Komponent spravuje RSS/RDF newsfeedy.';
protected $AX_NFE_DPD = 'Popis stránky';
protected $AX_NFE_SHFNCD = 'Ukázat/Skrýt sloupeček popisu Feedu.';
protected $AX_NFE_NOACL = '# Sloupec Články';
protected $AX_NFE_NOACD = 'Ukázat/Skrýt # pro články v feedu.';
protected $AX_NFE_LCL = 'Sloupec Odkaz';
protected $AX_NFE_LCD = 'Ukázat/Skrýt sloupeček odkazu Feedu.';
protected $AX_NFE_IDL = 'popis položky';
protected $AX_NFE_IDD = 'Ukázat/Skrýt popis nebo úvodní text položky.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Komponent pro správu funkcí vyhledávání.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Komponent umožňuje odběratelské nastavení RSS.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache feed souborů.';
protected $AX_SYN_CACHTL = 'Čas Cache';
protected $AX_SYN_CACHTD = 'Cache soubor obnovit každých x sekund.';
protected $AX_SYN_ITMSL = '# Položek';
protected $AX_SYN_ITMSD = 'Počet položek Feed.';
protected $AX_SYN_ITMSDFLT = 'Elxis RSS';
protected $AX_SYN_TITLE = 'Titul RSS';
protected $AX_SYN_DESCD = 'Popis RSS.';
protected $AX_SYN_DESCDFLT = 'Elxis RSS stránky';
protected $AX_SYN_IMGD = 'Obrázek přidružený k feedu.';
protected $AX_SYN_IMGAL = 'Popis obrázku';
protected $AX_SYN_IMGAD = 'Text k obrázku.';
protected $AX_SYN_IMGADFLT = 'Běží na Elxis';
protected $AX_SYN_LMTL = 'Limit textu';
protected $AX_SYN_LMTD = 'Omezení délky článku(dolní indikátor).';
protected $AX_SYN_TLENL = 'Počet slov';
protected $AX_SYN_TLEND = 'Počet slov - 0 znamená bez textu.';
protected $AX_SYN_LBL = 'Live záložky';
protected $AX_SYN_LBD = 'Aktivovat podporu pro Firefox Live Bookmarks funkce.';
protected $AX_SYN_BFL = 'Soubor záložky';
protected $AX_SYN_BFD = 'Zvláštní jméno záložky. Zůstane-li prázdné, bude použito výchozí.';
protected $AX_SYN_ORDL = 'Další';
protected $AX_SYN_ORDD = 'Další zobrazené položky.';
protected $AX_SYN_MULTIL = 'Vícejazyčné feedy';
protected $AX_SYN_MULTILD = 'Pokud ANO, Elxis vygeneruje jazykově specifické feedy.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Komponent spravuje funkce koše.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Zobrazuje jednotlivou stránku s obsahem.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Komponent zobrazuje výpis webových odkazů s náhledem odkazu.';
protected $AX_WBL_LDL = 'Popis odkazu';
protected $AX_WBL_LDD = 'Ukázat/Skrýt popis pro odkaz.';
protected $AX_WBL_ICL = 'Ikona';
protected $AX_WBL_ICD = 'Ikona zobrazená vlevo odkazu při tabulkovém zobrazení.';
protected $AX_WBL_SCSL = 'Náhledy';
protected $AX_WBL_SCSD = 'Zobrazí náhled stránky odkazu. V tomto režimu nebude zobrazena ikona.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Cílové okno po kliknutí.';
protected $AX_WBLI_OT01 = 'Stejné okno s navigací prohlížeče';
protected $AX_WBLI_OT02 = 'Nové okno s navigací prohlížeče';
protected $AX_WBLI_OT03 = 'Nové okno bez navigace prohlížeče';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Modul zobrazuje seznam nejnověji publikovaných položek, které jsou ještě aktuální. Položky, které jsou zobrazené na Titulní stránce nejsou zahrnuté v seznamu.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Modul zobrazuje seznam aktuálně přihlášených uživatelů.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Modul zobrazuje seznam populárních publikovaných položek, které jsou ještě aktuální. Položky, které jsou zobrazené na Titulní stránce nejsou zahrnuté v seznamu.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Modul zobrazuje seznam statistiky publikovaných položek, které jsou ještě aktuální. Položky, které jsou zobrazené na Titulní stránce nejsou zahrnuté v seznamu.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Přípona stylu modulu'; 
protected $AX_SM_MCSD = 'Přípona aplikovaná na CSS styl modulu. To dovoluje individuální styl modulu.'; 
protected $AX_SM_MUCSL = 'Přípona stylu menu'; 
protected $AX_SM_MUCSD = 'Přípona aplikovaná na CSS styl modulu. To dovoluje individuální styl položky menu.'; 
protected $AX_SM_ECL = 'Povolit Cache'; 
protected $AX_SM_ECD = 'Povolení cache pro tento modul module.'; 
protected $AX_SM_SMIL = 'Zobrazit ikony menu'; 
protected $AX_SM_SMID = 'Zobrazení Vámi vybraných ikon pro položky menu.'; 
protected $AX_SM_MIAL = 'Umístění ikon menu'; 
protected $AX_SM_MIAD = 'Zarovnání ikon menu'; 
protected $AX_SM_MODL = 'Mód modulu'; 
protected $AX_SM_MODD = 'Řídí typ obsahu zobrazovaného v modulu.'; 
protected $AX_SM_OP01 = 'Pouze články'; 
protected $AX_SM_OP02 = 'Pouze autonomní stránky'; 
protected $AX_SM_OP03 = 'Obojí'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Uživatelský modul.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Vložte URL pro RSS/RDF feed.'; 
protected $AX_SM_CU_FEDL = 'Popis Feedu'; 
protected $AX_SM_CU_FEDD = 'Zobrazit text popisu pro celý Feed.'; 
protected $AX_SM_CU_FEIL = 'Obrázek Feedu'; 
protected $AX_SM_CU_FEDID = 'Zobrazit obrázek asociovaný s Feedem.'; 
protected $AX_SM_CU_ITL = 'Položky'; 
protected $AX_SM_CU_ITD = 'Vložte počet zobrazených RSS položek.'; 
protected $AX_SM_CU_ITDL = 'Popis položky'; 
protected $AX_SM_CU_ITDD = 'Zobrazit popis nebo úvodní text pro položku.'; 
protected $AX_SM_CU_WCL = 'Počet slov'; 
protected $AX_SM_CU_WCD = 'Počet slov - 0 znamená zobrazit celý text.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Modul zobrazuje seznam kalendářních měsíců obsahujících archivní položky. Po změně statusu nějaké položky na archivovat, bude tento seznam automaticky vygenerován.'; 
protected $AX_SM_AR_CNTL = 'Počet'; 
protected $AX_SM_AR_CNTD = 'počet zobrazených položek (výchozí je 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Modul umožní zobrazovat aktivní bannery na Vašich webových stránkách.'; 
protected $AX_SM_BN_CNTL = 'Klient banneru'; 
protected $AX_SM_BN_CNTD = "Odkaz na klientské ID banneru. Více klientů oddělte čárkou bez mezer!"; 
protected $AX_SM_BN_NBSL = 'Počet zobrazených bannerů';
protected $AX_SM_BN_NBPRL = 'Počet bannerů v řadě';
protected $AX_SM_BN_NBPRD = 'Počet bannerů v řadě. Pro blokování nastavte 0. Pro vertikální zobrazení zadejte 1';
protected $AX_SM_BN_UNQBL = 'Unikátní zobrazení banneru';
protected $AX_SM_BN_UNQBD = 'Banner nebude zobrazen více než jednou pro každého návštěvníka. Po zobrazení všech bannerů, bude historie vymazána a cyklus restartován.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Modul zobrazuje seznam nejnověji publikovaných položek, které jsou ještě aktuální. Položky, které jsou zobrazené na Titulní stránce nejsou zahrnuté v seznamu.'; 
protected $AX_SM_LN_FPIL = 'Titulní stránka'; 
protected $AX_SM_LN_FPID = 'Ukázat/Skrýt položky publikované na titulní stránce.'; 
protected $AX_SM_AR_CNT5D = 'Počet zobrazených položek (výchozí počet je 5).'; 
protected $AX_SM_LN_CATIL = 'ID kategorie'; 
protected $AX_SM_LN_CATID = 'Můžete specifikovat kategorie pro zahrnutí do výpisu (více ID kategorií oddělte čárkou bez mezer).'; 
protected $AX_SM_LN_SECIL = 'Sekce ID'; 
protected $AX_SM_LN_SECID = 'Můžete specifikovat sekce pro zahrnutí do výpisu (více ID sekcí oddělte čárkou bez mezer)..'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Modul umožňuje přihlášení uživatele do systému, zaslání zapomenutého hesla a pokud je umožněna registrace nových uživatelů, pak i odkaz na registrační formulář.'; 
protected $AX_SM_LF_PTL = 'Horní text';
protected $AX_SM_LF_PTD = 'Text zobrazovaný nad přihlašovacím formulářem.'; 
protected $AX_SM_LF_PSTL = 'Dolní text'; 
protected $AX_SM_LF_PSTD = 'Text zobrazovaný pod přihlašovacím formulářem.'; 
protected $AX_SM_LF_LRUL = 'URL po přihlášení'; 
protected $AX_SM_LF_LRUD = 'Url stránky, na kterou se automaticky přesměruje po přihlášení do systému. Při nevyplnění zůstává nastavena titulní stránka.'; 
protected $AX_SM_LF_LORUL = 'URL po odhlášení'; 
protected $AX_SM_LF_LORUD = 'Url stránky, na kterou se automaticky přesměruje po odhlášení ze systému. Při nevyplnění zůstává nastavena titulní stránka.'; 
protected $AX_SM_LF_LML = 'Zpráva přihlášení'; 
protected $AX_SM_LF_LMD = 'Ukázat/Skrýt javascript pop-up okno po úspěšném přihlášení do systému.'; 
protected $AX_SM_LF_LOML = 'Zpráva odhlášení'; 
protected $AX_SM_LF_LOMD = 'Ukázat/Skrýt javascript pop-up okno po úspěšném odhlášení ze systému.'; 
protected $AX_SM_LF_GML = 'Pozdrav'; 
protected $AX_SM_LF_GMD = 'Ukázat/Skrýt jednoduchý uvítací text.'; 
protected $AX_SM_LF_NUNL = 'Jméno/Uživatelské jméno'; 
protected $AX_SM_LF_OP01 = 'Uživatelské jméno'; 
protected $AX_SM_LF_OP02 = 'Jméno'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Zobrazuje menu.'; 
protected $AX_SM_MNM_MNL = 'Jméno menu'; 
protected $AX_SM_MNM_MND = 'Jméno pro toto menu (výchozí je \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Styl menu'; 
protected $AX_SM_MNM_MSD = 'Styl tohoto menu'; 
protected $AX_SM_MNM_OP1 = 'Vertikální'; 
protected $AX_SM_MNM_OP2 = 'Horizontální'; 
protected $AX_SM_MNM_OP3 = 'Nabídkový list'; 
protected $AX_SM_MNM_EML = 'Expandovat menu'; 
protected $AX_SM_MNM_EMD = 'Otevřené menu zobrazí ihned i položky submenu.'; 
protected $AX_SM_MNM_IIL = 'Obrázek odsazení'; 
protected $AX_SM_MNM_IID = 'Obrázek pro odsazení submenu.'; 
protected $AX_SM_MNM_OP4 = 'Šablona'; 
protected $AX_SM_MNM_OP5 = 'Výchozí obrázek Elxis'; 
protected $AX_SM_MNM_OP6 = 'Použít volbu níže'; 
protected $AX_SM_MNM_OP7 = 'Žádný'; 
protected $AX_SM_MNM_II1L = 'Obrázek úrovně 1'; 
protected $AX_SM_MNM_II1D = 'Obrázek odsazení pro první úroveň submenu.'; 
protected $AX_SM_MNM_II2L = 'Obrázek úrovně 2'; 
protected $AX_SM_MNM_II2D = 'Obrázek odsazení pro druhou úroveň submenu.'; 
protected $AX_SM_MNM_II3L = 'Obrázek úrovně 3'; 
protected $AX_SM_MNM_II3D = 'Obrázek odsazení pro třetí úroveň submenu.'; 
protected $AX_SM_MNM_II4L = 'Obrázek úrovně 4'; 
protected $AX_SM_MNM_II4D = 'Obrázek odsazení pro čtvrtou úroveň submenu.'; 
protected $AX_SM_MNM_II5L = 'Obrázek úrovně 5'; 
protected $AX_SM_MNM_II5D = 'Obrázek odsazení pro pátou úroveň submenu.'; 
protected $AX_SM_MNM_II6L = 'Indent Image 6'; 
protected $AX_SM_MNM_II6D = 'Obrázek odsazení pro šestou úroveň submenu.'; 
protected $AX_SM_MNM_SPL = 'Oddělovač'; 
protected $AX_SM_MNM_SPD = 'Oddělovač pro horizontální menu.'; 
protected $AX_SM_MNM_ESL = 'Koncový oddělovač'; 
protected $AX_SM_MNM_ESD = 'Koncový oddělovač pro horizontální nenu.';
protected $AX_SM_MNM_IDPR = 'SEO PRO položkové zatížení';
protected $AX_SM_MNM_IDPRD = 'Povolení AJAX zatížení pro položky řeší problém, kdy na jednu stránku odkazuje více položek menu.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Modul zobrazuje nejvíce zobrazené aktuální články..'; 
protected $AX_SM_MRC_MNL = 'Jméno menu'; 
protected $AX_SM_MRC_MND = 'Jméno pro toto menu (Výchozí je mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Položky titulní stránky'; 
protected $AX_SM_MRC_FPID = 'Ukázat/Skrýt položky publikované na titulní stránce.'; 
protected $AX_SM_MRC_CL = 'Počet'; 
protected $AX_SM_MRC_CD = 'Počet zobrazených položek (výchozí je 5).'; 
protected $AX_SM_MRC_CIDL = 'ID kategorie'; 
protected $AX_SM_MRC_CIDD = 'Můžete specifikovat kategorie pro zahrnutí do výpisu (více ID kategorií oddělte čárkou bez mezer).'; 
protected $AX_SM_MRC_SIDL = 'ID sekce'; 
protected $AX_SM_MRC_SIDD = 'Můžete specifikovat sekce pro zahrnutí do výpisu (více ID sekcí oddělte čárkou bez mezer).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Newsflash modul náhodně vybírá na každé stránce článek v kategorii. Výsledky lze zobrazit horizontálně nebo vertikálně.'; 
protected $AX_SM_NWF_CATL = 'Kategorie'; 
protected $AX_SM_NWF_CATD = 'Kategorie článku.'; 
protected $AX_SM_NWF_STL = 'Styl'; 
protected $AX_SM_NWF_STD = 'Styl zobrazení.'; 
protected $AX_SM_NWF_OP1 = 'Náhodně jeden po druhém'; 
protected $AX_SM_NWF_OP2 = 'Horizontálně'; 
protected $AX_SM_NWF_OP3 = 'Vertikálně'; 
protected $AX_SM_NWF_SIL = 'Zobrazit obrázky'; 
protected $AX_SM_NWF_SID = 'Zobrazí obrázky článku.'; 
protected $AX_SM_NWF_LTL = 'Klikatelný titul'; 
protected $AX_SM_NWF_LTD = 'Titul jako odkaz k celému článku.'; 
protected $AX_SM_NWF_RML = 'Čtěte více'; 
protected $AX_SM_NWF_RMD = 'Ukázat/Skrýt tlačítko Čtěte více.'; 
protected $AX_SM_NWF_ITL = 'Titul položky'; 
protected $AX_SM_NWF_ITD = 'Zobrazit titul položky.'; 
protected $AX_SM_NWF_NOIL = 'Ne. Z položky'; 
protected $AX_SM_NWF_NOID = 'Ne z položek k zobrazení.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Modul pro zobrazení konfigurovatelných anket.'; 
protected $AX_SM_POL_CATL = 'Kategorie'; 
protected $AX_SM_POL_CATD = 'Kategorie položky.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Modul zobrazuje náhodný obrázek z adresáře.'; 
protected $AX_SM_RNI_ITL = 'Typ obrázku'; 
protected $AX_SM_RNI_ITD = 'Typ obrázků PNG/GIF/JPG atd. (výchozí je JPG).'; 
protected $AX_SM_RNI_IFL = 'Obrázková složka'; 
protected $AX_SM_RNI_IFD = 'Relativní cesta ke složce s obrázky pro náhodné zobrazení, např.: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Odkaz'; 
protected $AX_SM_RNI_LND = 'URL odkazu po kliknutí na obrázek, např.: http://www.elxis.cz'; 
protected $AX_SM_RNI_WL = 'Šířka (px)'; 
protected $AX_SM_RNI_WD = 'Šířka obrázku (rozměr je jednotný pro všechny obrázky).'; 
protected $AX_SM_RNI_HL = 'Výška (px)'; 
protected $AX_SM_RNI_HD = 'Výška obrázku (rozměr je jednotný pro všechny obrázky).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Modul zobrazuje podobný obsah právě prohlíženému. Porovnávání je založeno na klíčových slovech, které zadáváte do metadat každého článku."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Modul zobrazuje odkazy pro odběr RSS kanálů z Vašich webových stránek.'; 
protected $AX_SM_RSS_TXL = 'Text'; 
protected $AX_SM_RSS_TXD = 'Text, který se zobrazí spolu s odkazem na Vaše RSS kanály.'; 
protected $AX_SM_RSS_091D = 'Ukázat/Skrýt RSS 0.91 Odkaz.'; 
protected $AX_SM_RSS_10D = 'Ukázat/Skrýt RSS 1.0 Odkaz.'; 
protected $AX_SM_RSS_20D = 'Ukázat/Skrýt RSS 2.0 Odkaz.'; 
protected $AX_SM_RSS_03D = 'Ukázat/Skrýt Atom 0.3 Odkaz.'; 
protected $AX_SM_RSS_OPD = 'Ukázat/Skrýt OPML Odkaz.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 Image'; 
protected $AX_SM_RSS_I10L = 'Obrázek RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Obrázek RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Obrázek Atom'; 
protected $AX_SM_RSS_IOPL = 'Obrázek OPML'; 
protected $AX_SM_RSS_CHID = 'Zvolte obrázek k zobrazení.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Modul zobrazuje na stránkách vyhledávací box.';
protected $AX_SM_SEM_TOP = 'Nahoru';
protected $AX_SM_SEM_BTM = 'Dolu';
protected $AX_SM_SEM_BWL = 'Šíře boxu';
protected $AX_SM_SEM_BWD = 'Rozměr textového boxu.';
protected $AX_SM_SEM_TXL = 'Text';
protected $AX_SM_SEM_TXD = 'Text zobrazený ve vyhledávacím boxu jako výchozí. Pro vícejazyčné stránky doporučujeme nechat pole prázdné. V tomto případě se zobrazuje defaultní text z jazykových souborů.';
protected $AX_SM_SEM_BPL = 'Pozice tlačítka';
protected $AX_SM_SEM_BPD = 'Pozice tlačítka hledat vzhledem k vyhledávacímu boxu.';
protected $AX_SM_SEM_BTXL = 'Text tlačítka';
protected $AX_SM_SEM_BTXD = 'Text zobrazený na vyhledávacím tlačítku. Pro vícejazyčné stránky doporučujeme nechat pole prázdné. V tomto případě se zobrazuje defaultní text z jazykových souborů.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Zobrazuje seznam sekcí ve Vaší databázi.'; 
protected $AX_SM_SEC_CL = 'Počet';
protected $AX_SM_SEC_CD = 'Počet zobrazených položek (výchozích je 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Modul zobrazuje informace o Vašem serveru, počtu článků, uživatelů, odkazů....';
protected $AX_SM_STA_SVIL = 'Informace o serveru'; 
protected $AX_SM_STA_SVID = 'Zobrazí informace o serveru.'; 
protected $AX_SM_STA_SIL = 'Systémové informace'; 
protected $AX_SM_STA_SID = 'Zobrazí informace o stránkách.'; 
protected $AX_SM_STA_HCL = 'Počet návštěvníků'; 
protected $AX_SM_STA_HCD = 'Zobrazí počet návštěvníků.'; 
protected $AX_SM_STA_ICL = 'Zvýšit počet'; 
protected $AX_SM_STA_ICD = 'Vložte hodnotu pro navýšení počtu zobrazovaných návštěvníků.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Modul umožní návštěvníkům Vašich stránek změnit šablonu podle svého vkusu.'; 
protected $AX_SM_TMC_MNLL = 'Max. délka jména'; 
protected $AX_SM_TMC_MNLD = 'Omezuje délku zobrazovaného jména šablony (výchozí je 20).'; 
protected $AX_SM_TMC_SPL = 'Zobrazit náhled'; 
protected $AX_SM_TMC_SPD = 'Zobrazí náhled šablony.'; 
protected $AX_SM_TMC_WL = 'Šířka'; 
protected $AX_SM_TMC_WD = 'Šířka obrázku pro náhled šablony (výchozí je 140 px).'; 
protected $AX_SM_TMC_HL = 'Výška'; 
protected $AX_SM_TMC_HD = 'Výška obrázku pro náhled šablony (výchozí je 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Modul zobrazí aktuální počet návštěvníků a přihlášených uživatelů přítomných na vašich stránkách.'; 
protected $AX_SM_WSO_DL = 'Zobrazit'; 
protected $AX_SM_WSO_DD = 'Volba zobrazení.'; 
protected $AX_SM_WSO_OP1 = ' počet Hostů/Uživatelů<br />'; 
protected $AX_SM_WSO_OP2 = 'Jména uživatelů<br />'; 
protected $AX_SM_WSO_OP3 = 'Obojí'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Modul vytvoří IFrame okno ve specifikované oblasti.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL na stránku/soubor pro zobrazení v okně IFrame'; 
protected $AX_SM_WRM_SCBL = 'Posuvné lišta'; 
protected $AX_SM_WRM_SCBD = 'Ukázat/Skrýt Horizontální & Vertikální posuvné lišty.'; 
protected $AX_SM_WRM_WL = 'Šířka'; 
protected $AX_SM_WRM_WD = 'Šířka IFrame okna. Lze zadat absolutní hodnotu v px nebo relativní v %.'; 
protected $AX_SM_WRM_HL = 'Výška'; 
protected $AX_SM_WRM_HD = 'Výška IFrame okna'; 
protected $AX_SM_WRM_AHL = 'Autovýška'; 
protected $AX_SM_WRM_AHD = 'Automatické nastavení výšky okna dle externí stránky. TUTO FUNKCI LZE POUŽÍT POUZE PRO STRÁNKY NA VAŠÍ DOMÉNĚ!.'; 
protected $AX_SM_WRM_ADL = 'Autoprotekt'; 
protected $AX_SM_WRM_ADD = 'Výchozí http:// bude funkční http:// i https://. Toto nastavení dovoluje tuto funkci vypnout.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Funkce'; 
protected $AX_ED_FUNCTD = 'Volba funkcí'; 
protected $AX_ED_FUNSIMPLE = 'Jednoduché'; 
protected $AX_ED_FUNADV = 'Pokročilé';
protected $AX_ED_EDITORWIDTHL = 'Šířka editoru';
protected $AX_ED_EDITORWIDTHD = 'Šířka okna editoru';
protected $AX_ED_EDITORHEIGHTL = 'Výška editoru';
protected $AX_ED_EDITORHEIGHTD = 'Výška okna editoru';
protected $AX_ED_COMPRESSEDVL = 'Kompresní verze';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE editor umožňuje provoz v rychlejším (kompresním módu). Tato funkce však není kompatibilní se všemi prohlížeči. Nejvíce problémů nastává s IE. Ověřte funkčnost s Vaším prohlížečem pro bezproblémový chod.';
protected $AX_ED_OFF = 'Off';
protected $AX_ED_ON = 'On';
protected $AX_ED_COMPRESSL = 'Komprese';
protected $AX_ED_COMPRESSD = 'Komprese TinyMCE Editoru pomocí gzip (nahrávání o 75% rychlejší)';
protected $AX_ED_CONVERTURLL = 'Záměna URL';
protected $AX_ED_CONVERTURLD = 'Záměna absolutní URL za relativní.';
protected $AX_ED_ENTENCODL = 'Kódování entit';
protected $AX_ED_ENTENCODD = 'Nastavení kontroluje entity/znaky zpracované v TinyMCE. Může být nastavena na číselné zobrazení, jména entit nebo prosté, které žádné kódování nemá. Defaultní nastavení je na jména entit.';
protected $AX_ED_TXTDIRL = 'Směr textu';
protected $AX_ED_TXTDIRD = 'Změní směr textu';
protected $AX_ED_CNVFONTSPANL = 'Převod Fontů na Spany';
protected $AX_ED_CNVFONTSPAND = 'Převod elementů fontů na Span elementy.';
protected $AX_ED_FONTSIZETYPEL = 'Velikost písma';
protected $AX_ED_FONTSIZETYPED = 'Nastavení volby zadávání velikosti písma. Všechny délkovou mírou např.: 10pt, nebo absolutní velikost vzor: x-small.';
protected $AX_ED_INLTABLEDITL = 'Úprava tabulky v řadě ';
protected $AX_ED_INLTABLEDITD = 'Dovoluje editovat tabulku v řadě.';
protected $AX_ED_PROHELEMENTSL = 'Zakázané elementy';
protected $AX_ED_PROHELEMENTSD = 'Elementy, které budou při uložení z textu (kódu) vymazány.';
protected $AX_ED_EXTELEMENTSL = 'Přidání elementů';
protected $AX_ED_EXTELEMENTSD = 'Rozšíření TinyMCE funkce o přidávání extra elementů. Formát: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Elementy událostí';
protected $AX_ED_EVELEMENTSD = 'Přidání elementů událostí (např.: onclick a similar). Toto nastavení vyžadují některé prohlížeče pro podporu funkcí při editaci.';
protected $AX_ED_TCSSCLASSESL = 'Šablonové CSS styly';
protected $AX_ED_TCSSCLASSESD = 'Nahrávat CSS styly z template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Uživatelské CSS styly';
protected $AX_ED_CCSSCLASSESD = 'Dovoluje použití vlastních CSS souborů stylu. Tento soubor musí být uložen ve složce /css používané webové šablony.';
protected $AX_ED_NEWLINESL = 'Nové řádky';
protected $AX_ED_NEWLINESD = 'Nový řádek bude vytvořen dle vybrané volby';
protected $AX_ED_TOOLBARL = 'Nástrojová lišta';
protected $AX_ED_TOOLBARD = 'Pozice nástrojové lišty';
protected $AX_ED_HTMLHEIGHTL = 'HTML výška';
protected $AX_ED_HTMLHEIGHTD = 'Výška pop-up okna pro HTML mód.';
protected $AX_ED_HTMLWIDTHL = 'HTML šířka';
protected $AX_ED_HTMLWIDTHD = 'Šířka pop-up okna pro HTML mód.';
protected $AX_ED_PREVIEWHEIGHTL = 'Výška náhledu';
protected $AX_ED_PREVIEWHEIGHTD = 'Výška pop-up okna při náhledu.';
protected $AX_ED_PREVIEWWIDTHL = 'Šířka náhledu';
protected $AX_ED_PREVIEWWIDTHD = 'Šířka pop-up okna při náhledu.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser je uživatelský obrázkový správce';
protected $AX_ED_PLTABLESL = 'Tabulkový Plugin';
protected $AX_ED_PLTABLESD = 'Uvolní tabulkový editor ve WYSIWYG módu.';
protected $AX_ED_PLPASTEL = 'Plugin Vložit';
protected $AX_ED_PLPASTED = 'Uvolní funkce Vložit z Wordu, Vložit prostý text a Vybrat vše.';
protected $AX_ED_PLIMGPLUGINL = 'Manažer obrázků';
protected $AX_ED_PLIMGPLUGIND = 'Uvolní manažera obrázků. Defaultně je modul umožněn.';
protected $AX_ED_PLSEARCHL = 'Plugin Najít/Nahradit';
protected $AX_ED_PLSEARCHD = 'Uvolní plugin pro nalezení nebo nahrazení textu.';
protected $AX_ED_PLLINKSL = 'Plugin Odkaz';
protected $AX_ED_PLLINKSD = 'Uvolní manažera odkazů. Standardně je editor odkazů zapnutý.';
protected $AX_ED_PLEMOTL = 'Emotikony';
protected $AX_ED_PLEMOTD = 'Uvolní modul pro přidávání emotikonů.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Umožní jednoduché přidáváni flash animací do článků.';
protected $AX_ED_PLDTL = 'Datum/Čas Plugin';
protected $AX_ED_PLDTD = 'Umožní vkládat do textu aktuální datum a čas.';
protected $AX_ED_PLPREVL = 'Náhledový Plugin';
protected $AX_ED_PLPREVD = 'Přidá tlačítko pro otevření náhledu rozepsaného článku v pop-up okně.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Přidá zvětšovací tlačítko.';
protected $AX_ED_PLFSCRL = 'Celoobrazový Plugin';
protected $AX_ED_PLFSCRD = 'Plugin umožní celoobrazovou editaci.';
protected $AX_ED_PLPRINTL = 'Plugin Tisk';
protected $AX_ED_PLPRINTD = 'Tlačítko pro tisk.';
protected $AX_ED_PLDIRL = 'Přepínač směru';
protected $AX_ED_PLDIRD = 'Přidá tlačítka pro přepínání směru textu.';
protected $AX_ED_PLFONTSL = 'Volba fontu';
protected $AX_ED_PLFONTSD = 'Umožní změnu fontů písma.';
protected $AX_ED_PLFONTSZL = 'Velikost fontu';
protected $AX_ED_PLFONTSZD = 'Dovoluje měnit velikost fontu písma.';
protected $AX_ED_PLFORMLSL = 'Formát';
protected $AX_ED_PLFORMLSD = 'Dovoluje výběr formátu textu jako H1, H2, atd.';
protected $AX_ED_PLSSLL = 'Výběr CSS stylu';
protected $AX_ED_PLSSLD = 'Plugin dovoluje výběr z CSS souboru šablona a případně Vámi definovaného.';
protected $AX_ED_NAMED = 'Jména';
protected $AX_ED_NUMERIC = 'Čísla';
protected $AX_ED_RAW = 'Prosté';
protected $AX_ED_LTR = 'Z leva do prava';
protected $AX_ED_RTL = 'Z prava do leva';
protected $AX_ED_LENGTH = 'Délková';
protected $AX_ED_ABSSIZE = 'Absolutní';
protected $AX_ED_BRELEMENTS = 'BR tagy';
protected $AX_ED_PELEMENTS = 'P tagy';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Kalkulačka';
protected $AX_TCAL_D = 'Uživatelská javaskriptová kalkulačka';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Dočasná složka';
protected $AX_TEMTEMP_D = 'Vyprázdní dočasnou složku Elxis (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Zkontrolovat jazyk';
protected $AX_TFIXLANG_D = 'Zkontroluje, zda jsou položky stránek správně jazykově umístěny.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizér';
protected $AX_TORGANIZ_D = 'Elxis Organizér spravuje Vaše kontakty, poznámky, záložky a schůzky.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Vyčistit Cache';
protected $AX_TCLEANCACHE_D = 'Vyčistí cache složku.';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'CHMOD';
protected $AX_TCHMOD_D = 'Změní práva danému souboru nebo složce';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Opravit Postgres sekvence';
protected $AX_TFPGSEQ_D = 'Je-li potřeba, opraví Postgres sekvence.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Registrace Elxis';
protected $AX_TELXREG_D = 'Registrace Vaší Elxis instalace na GO UP Inc';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Vytvoří odkaz na Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Nová linka';
protected $AX_SAME_LINE = 'Stejná linka';
protected $AX_INDICATOR = 'Indikátor';
protected $AX_INDICATOR_D = 'Indikuje jazyk textu';
protected $AX_FLAG = 'Vlajka';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Umožňuje změnu jazyka hlavních stránek.';
protected $AX_FLAGS = 'vlajky';
protected $AX_SMARTSW = 'Přepínač';
protected $AX_SMARTSW_D = 'Dovoluje při změně jazyka zůstat na stejné stránce.';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Zobrazuje v profilech náhodné uživatele.';
protected $AX_DISPSTYLE = 'Styl zobrazení';
protected $AX_COMPACT = 'Kompaktní';
protected $AX_EXTENDED = 'Rozšířené';
protected $AX_GENDER = 'Pohlaví';
protected $AX_GENDERDESC = 'Zobrazovat pohlaví uživatele?';
protected $AX_AGE = 'Věk';
protected $AX_AGEDESC = 'Zobrazovat věk uživatele?';
protected $AX_REALUNAME = 'Zobrazovat reálné jméno nebo uživatelské jméno?';
//weblinks item
protected $AX_WBLI_TL = 'Cíl';
//content
protected $AX_RTFICL = 'Ukázat/Skrýt ikonku RTF';
protected $AX_RTFICD = 'Ukázat/Skrýt ikonkové tlačítko RTF - ovlivní pouze tuto stránku.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filtr skupin';
protected $AX_MODWHO_FILGRD = 'Při volbě ano, nebudou hosté a uživatelé s nižší přístupovou úrovní vidět status uživatelů s úrovní vyší.';
//search bots
protected $AX_SEARCH_LIMIT = 'Limit vyhledávání';
protected $AX_MAXNUM_SRES = 'Maximum výsledků pro vyhledávání';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Zobrazuje přehled posledních příspěvků. Ideální pro titulní stránku.'; 
protected $AX_SECTIONS = 'Sekce';
protected $AX_SECTIONSD = 'ID sekce(í) oddělených (,)';
protected $AX_CATEGORIES = 'Kategorie';
protected $AX_CATEGORIESD = 'ID kategorie(í) oddělených (,)';
protected $AX_NUMDAYS = 'Počet dnů';
protected $AX_NUMDAYSD = 'Zobrazit položky vytvořené za posledních x dní (defaultní počet je 900)';
protected $AX_SHOWTHUMBS = 'Zobrazit obrázek';
protected $AX_SHOWTHUMBSD = 'Ukázat/Skrýt zmenšeninu obrázku asociovaného k článku';
protected $AX_THUMBWIDTHD = 'Šířka obrázku v pixelech';
protected $AX_THUMBHEIGHTD = 'Výška obrázku v pixelech';
protected $AX_KEEPRATIO = 'Zachovat poměr stran';
protected $AX_KEEPRATIOD = 'Zachovat poměr stran. Při volbě Ano je výsledná výška n\'t.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog položka';
protected $AX_EBLOGITEMD = 'Vytvoří odkaz k publikované položce v komponentě eBlog ';
protected $AX_COMMENTARY = 'Komentář';
protected $AX_COMMENTARYD = 'Zvolte kdo má povoleno komentovat tento článek.';
protected $AX_NOONE = 'Nikdo';
protected $AX_REGUSERS = 'Registrovaní uživatelé';
protected $AX_ALL = 'Všichní';
//2009.0
protected $AX_COMMENTS = 'Komentáře';
protected $AX_COMMENTSD = 'Zobrazit počet komentářů?';

}

?>