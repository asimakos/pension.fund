<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Francesco Venuti (Amigamerlin)
* @link: http://www.pcbsd.it
* @email: Amigamerlin@gmail.com
* @description: Italian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_italian {

	public $_ON_NEW_CONTENT = "Un nuovo oggetto di contenuto è stato presentato da [ %s ] con titolo [ %s ] per la sezione [ %s ] e la categoria [ %s ]";
	public $_E_COMMENTS = 'Commenti';
	public $_DATE = 'Data';
	public $_E_SUBCONWAIT = 'Articoli già presentati che sono in attesa di approvazione:';
	public $_E_CONTENTSUB = 'Presentazione di contenuto';
	public $_MAIL_SUB = 'Utente presentato';
	public $_E_HI = 'Ciao';
	public $_E_NEWSUBBY = "Un nuovo contributo è stato inviato da utente %s";
	public $_E_TYPESUB = 'Tipo di contributo:';
	public $_E_TITLE = 'Titolo';
	public $_E_LOGINAPPR = 'Entra nella sezione di amministrazione del sito per approvare questo contributo.';
	public $_E_DONTRESPOND = 'Ti preghiamo di non rispondere a questo messaggio perché è stato generato automaticamente dal sistema ed è a soli fini informativi.';
	public $_E_NEWPASS_SUB = "Nuova password per %s";
	public $_E_RPASS_NADMIN = "L\' utente %s ha presentato richiesta per ricordare la Password. Una nuova Password è creata ed è inviata. 
	Se non desideri essere informato su questo tipo di azioni cambia il parametro USERS_RPASSMAIL in SoftDisk a No.";
	public $_E_SEND_SUB = "Dettagli Profilo per %s a %s";
	public $_ASEND_MSG = "Ciao %s,
Un nuovo utente è stato registrato a %s.
Questa Email contiene le sue informazioni:

Nome - %s
e-mail - %s
Nominativo (nome utente) - %s

Ti preghiamo di non rispondere a questo messaggio perché è stato generato automaticamente dal sistema ed è a soli fini informativi.";
	public $_NEW_MESSAGE = 'Un nuovo messaggio privato è arrivato';
	public $_NEW_PRMSGF = "Un nuovo messggio privato è arrivato da %s";
	public $_LOG_READMSG = 'Per leggere il messaggio devi fare il login nella console amministrativa.';
	public $_SUBCON_APPRNTF = 'La notifica di approvazione dei contenuti è stata inserita';
	public $_SUBCON_ATAPPR = 'Il vostro contenuto inserito il %s è stato approvato.';
	public $_SECTION = 'Sezione';
	public $_CATEGORY = 'Categoria';

	//elxis 2008.1
	public $_MANAPPROVE = 'Il nuovo utente per essere in grado di fare login è necessario approvare manualmente la sua registrazione!';
	public $_ACCUNBLOCK = "Il tuo account in %s è stato attivato da un amministratore del sito. Adesso puoi accedere come %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Notifica nuovo commento';
	public $_E_NEWCOMBYTITLE = "Un nuovo commento è stato inserito da %s nell'articolo titolato %s";
	public $_E_COMSTAYUNPUB = 'Questo commento rimarrà non pubblicato fino a quanto tu o un Super Amministratore non lo pubblicherà.';
	public $_E_ACCEXPDATE = 'Data scdenza Account';

	public function __construct() {
	}

}

?>