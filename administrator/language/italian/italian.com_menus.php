<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Roberto D Alessio (theprincy)
* @link: http://www.elxis.it
* @email: info@elxis.it
* @description: Italian language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Gestione Menu';
public $A_CMP_MU_MXLVLS = 'Livelli Massimi';
public $A_CMP_MU_CANTDEL ='* Non puoi \'cancella\' questo menù perché è richiesto da Elxis *';
public $A_CMP_MU_MANHOME = '* La Prima voce pubblicata in questo menù [mainmenu] per il sito deve essere quella di default \'Homepage\' *';
public $A_CMP_MU_MITEM = 'Elemento di Menu';
public $A_CMP_MU_NSMTG = '* Nota che qualche tipo di menu appare in più di un raggruppamento, ma è sempre lo stesso tipo di menu.';
public $A_CMP_MU_MITYP = 'Tipo munu elemento';
public $A_CMP_MU_WBLV = 'Cosa è una vista \'Blog\'';
public $A_CMP_MU_WTLV = 'Cosa è una vista \'Tabella\'';
public $A_CMP_MU_WLIV = 'Cosa è una vista \'Elenco\'';
public $A_CMP_MU_SMTAP = '* Alcuni \'Tipi Menù\' appaiono in più gruppi *';
public $A_CMP_MU_MOVEITS = 'Tipo di elemento di Menu';
public $A_CMP_MU_MOVEMEN = 'Sposta nel Menu';
public $A_CMP_MU_BEINMOV = 'Elementi di Menu che stanno per essere spostati';
public $A_CMP_MU_COPYITS = 'Copia elementi del menu';
public $A_CMP_MU_COPYMEN = 'Copia nel Menu';
public $A_CMP_MU_BCOPIED = 'Elementi di Menu che stanno per essere copiati';
public $A_CMP_MU_EDNEWSF = 'Edita questa Newsfeed';
public $A_CMP_MU_EDCONTA = 'Edita questo Contatto';
public $A_CMP_MU_EDCONTE = 'Edita questo contenuto';
public $A_CMP_MU_EDSTCONTE = 'Edita questo contenuto statico';
public $A_CMP_MU_MSGITSAV = 'Elementi di Menu salvati';
public $A_CMP_MU_MOVEDTO = ' Elementi di Menu Spostati in ';
public $A_CMP_MU_COPITO = ' Elementi di Menu Copiati in ';
public $A_CMP_MU_THMOD = 'il modulo';
public $A_CMP_MU_SCITLKT = 'Selezionare un componente da collegare';
public $A_CMP_MU_COMPLLTO = 'Componente da collegare';
public $A_CMP_MU_ITEMNAME = 'Il collegamento deve avere un nome';
public $A_CMP_MU_PLSELCMP = 'Selezionare un componente da collegare';
public $A_CMP_MU_PARAVAI = 'L&#8217;elenco dei Parametri sarà disponibile quando salverai questo nuovo elemento di menu';
public $A_CMP_MU_YSELCAT = 'Devi selezionare la categoria';
public $A_CMP_MU_TMHTITL = 'Questo Elemento di Menu deve avere un titolo';
public $A_CMP_MU_TABLE = 'Tabella';
public $A_CMP_MU_CCTBLANK = 'Se viene lasciato vuoto, sarà usato automaticamente il nome della Categoria';
public $A_CMP_MU_LNKHNAME = 'Il Collegamento deve avere un nome';
public $A_CMP_MU_SELCONT = 'Devi selezionare un Contatto da collegare';
public $A_CMP_MU_CONLINK = 'Contatto da collegare:';
public $A_CMP_MU_ONCLOPI = 'Al click, apri in';
public $A_CMP_MU_THETITL = 'Titolo:';
public $A_CMP_MU_YMSSECT = 'Devi selezionare la sezione';
public $A_CMP_MU_ILBLSEC = 'Se si lascia vuoto, sarà usato automaticamente il nome della Sezione';
public $A_CMP_MU_YCSMC = 'Puoi selezionare Categorie multiple';
public $A_CMP_MU_YCSMS = 'Puoi fare Sezioni multiple';
public $A_CMP_MU_EDCOI = 'Edit Content Item';
public $A_CMP_MU_YMSLT = 'Devi selezionare un contenuto da collegare a';
public $A_CMP_MU_STACONT = 'Contenuto statico';
public $A_CMP_MU_ONCLOP = 'Al click, apri in';
public $A_CMP_MU_YSNWLT = 'Devi selezionare un Newsfeed da collegare a';
public $A_CMP_MU_NEWTL = 'Newsfeed da collegare';
public $A_CMP_MU_SEPER = '- - - - - - -';
public $A_CMP_MU_PATNAM = 'Motivo/Nome';
public $A_CMP_MU_WRURL = 'Devi inserire un&#8217;URL.';
public $A_CMP_MU_WRLINK = 'Wrapper';
public $A_CMP_MU_MIBGCC = 'Blog - Contenuto Categoria';
public $A_CMP_MU_MITCG = 'Tabella - Contenuto Categoria';
public $A_CMP_MU_MICOMP = 'Componente';
public $A_CMP_MU_MIBGCS = 'Blog - Contenuto Sezione';
public $A_CMP_MU_MILCMPI = 'Link - Componente';
public $A_CMP_MU_MILCI = 'Collegamento a Contatto';
public $A_CMP_MU_MITBCC = 'Tabella - Contenuto Categoria';
public $A_CMP_MU_MILCEI = 'Link - Articolo';
public $A_CMP_MU_COTLINK = 'Articolo a link';
public $A_CMP_MU_MITBCS = 'Tabella - Contenuto Sezione';
public $A_CMP_MU_MILSTC = 'Link - Contenuto Statico';
public $A_CMP_MU_MITBNFC = 'Tabella - Categoria Newsfeed';
public $A_CMP_MU_MILNEW = 'Collegamento - Newsfeed';
public $A_CMP_MU_MISEP = 'Separatore / Spaziatore';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Tabella - Categoria Weblink';
public $A_CMP_MU_MIWRAP = 'Wrapper';
public $A_CMP_MU_ITEM = 'Articoli';
public $A_CMP_MU_UMSBRI = 'Devi selezionare un Bridge';
public $A_CMP_MU_BRINOINS = 'Componente Bridge non è installato!';
public $A_CMP_MU_NOPUBBRI = 'Non ci sono Bridges pubblicati!';
public $A_CMP_MU_CLVSEO = 'Clicca sulle pagine statiche per vedere il titolo SEO';
public $A_CMP_MU_SYSLINK = 'Link di sistema';
public $A_CMP_MU_SYSLINKD = 'Un link di Sistema dovrebbe normalmente appartenere a un menù pubblicato in una posizione modulo che non esiste nel template!';
public $A_CMP_MU_PASSR = 'Ricorda Password';
public $A_CMP_MU_UREG = 'Registrazione Utente';
public $A_CMP_MU_REGCOMP = 'Registrazione completata';
public $A_CMP_MU_ACCACT = 'Attivazione Account';
public $A_CMP_MU_MSLINK = 'Devi selezionare un Link di Sistema.';
public $A_CMP_MU_SELLINK = '- Seleziona link -';
public $A_CMP_MU_DONTDEL ='* Non cancellare questo menù in quantop rende migliore il funzionamento di Elxis. Devi essere sicuro di pubblicarlo in una posizione modulo che non esiste nel template! *';
public $A_CMP_MU_EDPROF = 'Edita profilo';
public $A_CMP_MU_SUBWEBL = 'Invia weblink';
public $A_CMP_MU_CHECKIN = 'Checkin';
public $A_CMP_MU_USERLIST = 'Lista Utenti';
public $A_CMP_MU_POLLS = 'Sondaggi';
//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'È necessario selezionare un blog per collegarsi al';
public $A_CMP_MU_BLOGLINK = 'Blog al Link';

}

?>