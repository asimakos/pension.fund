<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component media
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = 'Relativní cesta';
public $A_CMP_ME_PMOUSEVD = 'Pro detail najeďte kurzorem na souborovou ikonu';
public $A_CMP_ME_RENAME = 'Přejmenovat';
public $A_CMP_ME_COPYTO = 'Kopírovat do';
public $A_CMP_ME_NEWFOL = 'Nová složka';
public $A_CMP_ME_NEWFIL = 'Nový soubor';
public $A_CMP_ME_OPEN = 'Otevřít';
public $A_CMP_ME_VTHUMBS = 'Zobrazit miniatury';
public $A_CMP_ME_VICONS = 'Zobrazit ikony';
public $A_CMP_ME_DBCLOP = 'Dvojklikem otevřít:';
public $A_CMP_ME_DIRNEX = 'Adresář <strong>%s</strong> neexistuje!';
public $A_CMP_ME_FILNEX = 'Soubor <strong>%s</strong> neexistuje!';
public $A_CMP_ME_PERMS = 'Práva';
public $A_CMP_ME_MODIF = 'Upraveno';
public $A_CMP_ME_ACCESSED = 'Přístup';
public $A_CMP_ME_DOWNZIP = 'Stáhnout jako zip';
public $A_CMP_ME_DODOWN = 'Chcete stáhnout složku';
public $A_CMP_ME_ASZIP = 'jako zip?';
public $A_CMP_ME_EXTHERE = 'Extrahovat zde';
public $A_CMP_ME_SELFNIMG = 'Označený soubor není obrázek!';
public $A_CMP_ME_FSELFCL = 'Nejprve kliknutím zvolte soubor';
public $A_CMP_ME_RENEWFN = 'Přejmenovat - Zadejte nové jméno souboru:';
public $A_CMP_ME_EXFINAME = 'Jméno souboru %s již existuje!';
public $A_CMP_ME_EXFONAME = 'Jméno složky %s již existuje!';
public $A_CMP_ME_FIRENTO = 'Soubor<strong>"%s"</strong> přejmenován na <strong>"%s"</strong>';
public $A_CMP_ME_FORENTO = 'složka <strong>"%s"</strong> přejmenována na <strong>"%s"</strong>';
public $A_CMP_ME_RENFAIL = 'Přejmenování selhalo!';
public $A_CMP_ME_ALLFIFODEL = 'Všechny soubory/složky obsažené v adresáři budou smazány!';
public $A_CMP_ME_DELQUEST = 'Smazat "%s"?';
public $A_CMP_ME_FIDELSUC = 'Soubor úspěšně smazán';
public $A_CMP_ME_FODELSUC = 'Složka úspěšně smazána';
public $A_CMP_ME_DELFAIL = 'Smazání selhalo!';
public $A_CMP_ME_COPYTOFO = 'Kopírovat do složky:';
public $A_CMP_ME_SRCNEX = 'Zdrojový soubor neexistuje!';
public $A_CMP_ME_SRCISDIR = 'ZDROJ JE ADRESÁŘ! ADRESÁŘ NELZE KOPÍROVAT.';
public $A_CMP_ME_EXFIINDIR = 'Jméno souboru <strong>%s</strong> již existuje v adresáři %s';
public $A_CMP_ME_FICOPYSUC = 'Soubor <strong>%s</strong> byl úspěšně zkopírován do adresáře %s';
public $A_CMP_ME_FICOPYSUC2 = 'Soubor <strong>%s</strong> byl úspěšně zkopírován do adresáře %s jako <strong>%s</strong>';
public $A_CMP_ME_FICOPYFAIL = 'Nelze kopírovat <strong>%s</strong> do adresáře %s';
public $A_CMP_ME_NEWFONAME = 'Vložte jméno složky:';
public $A_CMP_ME_CHPERMS = 'Změna práv';
public $A_CMP_ME_SIZE = 'Velikost';
public $A_CMP_ME_DIMS = 'Rozměry';
public $A_CMP_ME_NAMENEWFO = 'Musíte zadat jméno pro novou složku!';
public $A_CMP_ME_FOCRESUC = 'Složka <strong>%s</strong> byla úspěšně vytvořena';
public $A_CMP_ME_CNCRNEWFO = 'Nelze vytvořit novou složku!';
public $A_CMP_ME_INVPERMS = 'Chybné povolení!';
public $A_CMP_ME_PERMCHSUC = 'Povolení souboru bylo úspěšně změněno na <strong>%s</strong>';
public $A_CMP_ME_CHMODFAIL = 'Změna módu selhala!';
public $A_CMP_ME_SELFIUP = 'Zvolte soubor pro uploadování';
public $A_CMP_ME_SELFNFLV = 'Zvolený soubor není flash video (flv)!';
public $A_CMP_ME_PLAY = 'Přehrát';
public $A_CMP_ME_SELFNMP3 = 'Zvolený soubor není mp3!';
public $A_CMP_ME_EXTRZIP = 'Extrahovat Zip';
public $A_CMP_ME_EXTRCUFO = 'Extrahovat všechny soubory z %s do stávající složky?';
public $A_CMP_ME_FINOZIP = 'Soubor <strong>%s</strong> není soubor zip!';
public $A_CMP_ME_UNERREXT = 'Neočekávaná chyba během extrahování!';
public $A_CMP_ME_FIEXTRD = 'soubory byly extrahovány.';
public $A_CMP_ME_REFVIEW = 'Obnovit náhled';
public $A_CMP_ME_DOWNLOAD = 'Stáhnout';
public $A_CMP_ME_TODOWNCL = 'Pro stáhnutí souboru klikněte na jméno souboru pod ikonou.';
public $A_CMP_ME_RESIZE = 'Změna rozměrů';
public $A_CMP_ME_FINORES = 'U vybraného souboru nelze měnit rozměry!';
public $A_CMP_ME_RESTO = 'Změnit rozměry';
public $A_CMP_ME_KEEPRAT = 'Zachovat poměr stran';
public $A_CMP_ME_BASEWID = 'Podle šířky obrázku';
public $A_CMP_ME_INVWNIMG = 'Chybná šířka pro nový obrázek!';
public $A_CMP_ME_INVHNIMG = 'Chybná výška pro nový obrázek!';
public $A_CMP_ME_IMGRESSUC = 'Rozměry obrázku úspěšně změněny!';
public $A_CMP_ME_CNOTRESIMG = 'Nelze změnit rozměry obrázku!';
public $A_CMP_ME_IE6UPGRADE = '<strong>Používáte Internet Explorer 6!</strong> Prosím, aktualizujte na IE7 nebo <a href="http://www.mozilla.com" target="_blank">Firefox</a>.'; 
public $A_CMP_ME_USEFIREFOX = 'Pro nejlepší výkon používejte <a href="http://www.mozilla.com" target="_blank">Firefox</a>.';
public $A_CMP_ME_WATERMARK = 'Vodoznak';
public $A_CMP_ME_CNOTWATERF = 'U tohoto souboru nelze použít vodoznak!';
public $A_CMP_ME_TEXT = 'Text';
public $A_CMP_ME_FONT = 'Font';
public $A_CMP_ME_OPACITY = 'Průhlednost';
public $A_CMP_ME_WATERPOS = 'Pozice vodoznaku';
public $A_CMP_ME_XAXIS = 'X-osa';
public $A_CMP_ME_YAXIS = 'Y-osa';
public $A_CMP_ME_COLOR = 'Barva';
public $A_CMP_ME_IMGQUAL = 'Kvalita obrázku';
public $A_CMP_ME_SAVEAS = 'Uložit jako...';
public $A_CMP_ME_BLACK = 'Černá';
public $A_CMP_ME_WHITE = 'Bílá';
public $A_CMP_ME_RED = 'Červená';
public $A_CMP_ME_BLUE = 'Modrá';
public $A_CMP_ME_ORANGE = 'Oranžová';
public $A_CMP_ME_YELLOW = 'Žlutá';
public $A_CMP_ME_GREEN = 'Zelená';
public $A_CMP_ME_GRAY = 'Šedá';
public $A_CMP_ME_LGRAY = 'Světle šedá';
public $A_CMP_ME_SHADOW = 'Stín';
public $A_CMP_ME_NOSHADOW = 'Beze stínu';
public $A_CMP_ME_NEWFDIFOLD = 'Nový soubor má jinou příponu než originál!';
public $A_CMP_ME_OVERIMGNEX = 'Maskovací obrázek neexistuje!';
public $A_CMP_ME_WATERGENSUC = 'Obrázek s vodoznakem byl úspěšně vytvořen.<br />Zavřete okno a obnovte Správce médií pro načtení nového obrázku.';
public $A_CMP_ME_CNOTGENWAT = '<strong>Nelze vygenerovat obrázek s vodoznakem!</strong><br />tato akce vyžaduje GD a FreeType PHP knihovny.';
public $A_CMP_ME_MEMANG = 'Správa médií';
public $A_CMP_ME_UPLOAD = 'Uploadovat';
public $A_CMP_ME_VALFTYPES = 'Správný typ souboru';
public $A_CMP_ME_VIDEO = 'Video';
public $A_CMP_ME_AUDIO = 'Audio';
public $A_CMP_ME_OTHER = 'Jiné';

}

?>