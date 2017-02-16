<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Francesco Venuti (Amigamerlin)
* @link: http://www.pcbsd.it
* @email: amigamerlin@gmail.com
* @description: Italian Language for XML files
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

	public function get($a) {
		if ( is_numeric($a) ) { return $a; }
		$pref = strtoupper(substr($a,0,3));
    	if ($pref == 'AX_') {
        	return $this->$a;
    	} elseif (($pref == 'CX_') && defined($a)) {
        	return constant($a);
		} else { return $a; }
	}

protected $AX_MENUIMGL = 'Menu Immagini';
protected $AX_MENUIMGD = 'Una piccola immagine da inserire a sinistra o a destra dei tuoi elementi di menu. Le immagini devono essere presenti nella cartella images/stories/ .';
protected $AX_MENUIMGONLYL = 'Usa solo le Immagini Menu';
protected $AX_MENUIMGONLYD = 'Se scegli <strong>SI</strong> il tuo elemento di menu verrà rappresentato SOLO dall\'immagine selezionata.<br /><br /> Se scegli <strong>No</strong> l\'elemento del menu sarà rappresentato dall\'immagine che hai selezionato unitamente al testo.';
protected $AX_MENUIMG2D = 'Una piccola immagine da inserire a sinistra o a destra dei tuoi elementi di menu. Le immagini devono essere presenti nella cartella  /images .';
protected $AX_PAGCLASUFL = 'Suffisso Classe Pagina';
protected $AX_PAGCLASUFD = 'Un suffisso da applicare alla classe css della pagina. Questo permetterà uno stile individuale delle pagine.';
protected $AX_TEXTPAGECL = 'Suffisso Articolo';
protected $AX_TEXTPAGECLD = 'Un suffisso da applicare alla classe css dell\'articolo, Questo permetterà uno stile individuale deli elementi contenuti in Article/Content .';
protected $AX_BACKBUTL = 'Bottone Indietro';
protected $AX_BACKBUTD = 'Mostra/Nascondi il Bottone Indietro. Permette di ritornare alla precedente pagina visitata.';
protected $AX_USEGLB = 'Usa Globale';
protected $AX_HIDE = 'Nascondi';
protected $AX_SHOW = 'Mostra';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Mostra il Titolo della Pagina';
protected $AX_PAGTITLSD = 'Mostra/Nascondi il titolo della pagina.';
protected $AX_PAGTITLL = 'Titolo Pagina';
protected $AX_PAGTITLD = 'Testo da mostrare in alto nella pagina. Se lasciato in bianco verrà utilizato il nome del Menu.';
protected $AX_PAGTITL2D = 'Testo da mostrare nella pagina in alto.';
protected $AX_LEFT = 'Sinistra';
protected $AX_RIGHT = 'Destra';
protected $AX_PRNTICOL = 'Icona Stampa';
protected $AX_PRNTICOD = 'Mostra/Nascondi l\'elemento Bottone Stampa - Ha solo effetto su questa pagina.';
protected $AX_YES = 'Si';
protected $AX_NO = 'No';
protected $AX_SECNML = 'Nome Sezione';
protected $AX_SECNMD = 'Mostra/Nascondi gli elementi appartenenti alla sezione.';
protected $AX_SECNMLL = 'Nome selezione Collegabile';
protected $AX_SECNMLD = 'Crea dal Testo Sezione un link all\'attuale pagina di sezione.';
protected $AX_CATNML = 'Nome Categoria';
protected $AX_CATNMD = 'Mostra/Nascondi gli elementi appartenti alla Categoria .';
protected $AX_CATNMLL = 'Mome Categoria Collegabile';
protected $AX_CATNMLD = 'Crea dal Testo Categoria un link all\'attuale pagina di Categoria.';
protected $AX_LNKTTLL = 'Titoli collegati';
protected $AX_LNKTTLD = 'Crea i titoli degli elementi collegabili.';
protected $AX_ITMRATL = 'Rating Elementi';
protected $AX_ITMRATD = 'Mostra/Nascondi il rating degli elementi - Ha effetto solo su questa pagina.';
protected $AX_AUTNML = 'Nomi Autori';
protected $AX_AUTNMD = 'Mostra/Nascondi gli Elementi dell\'autore - Ha effetto solo su questa pagina.';
protected $AX_CTDL = 'Data ed ora di creazione';
protected $AX_CTDD = 'Mostra/Nascondi la data\ora di creazione dell\'elemento - Ha effetto solo su questa pagina.';
protected $AX_MTDL = 'Data ed ora Modifica';
protected $AX_MTDD = 'Mostra/Nascondi la data\ora di modifica dell\'elemento - Ha effetto solo su questa pagina.';
protected $AX_PDFICL = 'Icona PDF';
protected $AX_PDFICD = 'Mostra Nascondi l\'elemento Bottone PDF - Ha effetto solo su questa pagina.';
protected $AX_PRICL = 'Icona Stampa';
protected $AX_PRICD = 'Mostra/Nascondi l\'elemento Bottone Stampa - Ha effetto solo su questa pagina.';
protected $AX_EMICL = 'Icona Email';
protected $AX_EMICD = 'Mostra Nascondi l\'elemento Bottone Email - Ha effetto solo su questa pagina.';
protected $AX_FTITLE = 'Titolo';
protected $AX_FAUTH = 'Autore';
protected $AX_FHITS = 'Hits';
protected $AX_DESCRL = 'Descrizione';
protected $AX_DESCRD = 'Mostra/Nascondi la descrizione sottostante.';
protected $AX_DESCRTXL = 'Testo Descrizione';
protected $AX_DESCRTXD = 'Descrizione per la pagina. Se lasciata in bianco verrà caricato il valore  _WEBLINKS_DESC dal tuo file lingua.';
protected $AX_IMAGEL = 'Immagine';
protected $AX_IMGFRPD = 'Immagine per pagina, deve essere presente nella cartella /images/stories . Di default verrà caricata web_links.jpg. - Non usare un\'immagine - significa che nessuna imagine verrà caricata.';
protected $AX_IMGALL = 'Allineamento Immagine';
protected $AX_IMGALD = 'Allineamento dell\'immagine.';
protected $AX_TBHEADL = 'Tabella Rubrica';
protected $AX_TBHEADD = 'Mostra/Nascondi la Tabella Rubrica.';
protected $AX_POSCOLL = 'Colonna Posizione';
protected $AX_POSCOLD = 'Mostra/Nascondi la Colonna Posizione.';
protected $AX_EMAILCOLL = 'Colona Email';
protected $AX_EMAILCOLD = 'Mostra/Nascondi la Colonna Email.';
protected $AX_TELCOLL = 'Colonna Telefono';
protected $AX_TELCOLD = 'Mostra/Nascondi la Colonna Telefono.';
protected $AX_FAXCOLL = 'Colonna Fax';
protected $AX_FAXCOLD = 'Mostra/Nascondi la Colonna Fax.';
protected $AX_LEADINGL = '# Leading';
protected $AX_LEADINGD = 'Numero di Elementi da mostrare come introduzione (larghezza piena). 0 significa che non verrà mostrato nessun testo introduttivo.';
protected $AX_INTROL = '# Introduzione';
protected $AX_INTROD = 'Numero di elementi da mostrare con testo introduttivo.';
protected $AX_COLSL = 'Colonne';
protected $AX_COLSD = 'Selezionare quante colonne devono essere usate per riga quando viene mostrato il testo introduttivo.';
protected $AX_LNKSL = '# Collegamenti';
protected $AX_LNKSD = 'Numero di elementi da mostrare come collegamenti.';
protected $AX_CATORL = 'Ordine Categoria';
protected $AX_CATORD = 'Ordina gli elementi per categoria.';
protected $AX_OCAT01 = 'No, ordina solo come Ordine Primario';
protected $AX_OCAT02 = 'Titolo in ordine Alfabetico';
protected $AX_OCAT03 = 'Titolo in ordine Alfabetico inverso';
protected $AX_OCAT04 = 'Ordinamento';
protected $AX_PRMORL = 'Ordinamento Primario';
protected $AX_PRMORD = 'Ordine in cui gli elementi verranno mostrati.';
protected $AX_OPRM01 = 'Default';
protected $AX_OPRM02 = 'Ordinamento Pagina Principale';
protected $AX_OPRM03 = 'Prima I più Vecchi';
protected $AX_OPRM04 = 'Prima I più Recenti';
protected $AX_OPRM07 = 'Alfabetico in funzione dell\'Autore';
protected $AX_OPRM08 = 'Alfabetico inverso in funzione dall\'Autore';
protected $AX_OPRM09 = 'Most Hits';
protected $AX_OPRM10 = 'Least Hits';
protected $AX_PAGL = 'Paginazione';
protected $AX_PAGD = 'Mostra/Nascondi Supporto paginazione.';
protected $AX_PAGRL = 'Risultato Paginazione';
protected $AX_PAGRD = 'Mostra/Nascondi informazioni sul risultato della paginazione ( e.g 1-4 of 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Mostra {mosimages}.';
protected $AX_ITMTL = 'Titoli Elemento';
protected $AX_ITMTD = 'Mostra/Nascondi Titolo Elementi.';
protected $AX_REMRL = 'Approfondisci';
protected $AX_REMRD = 'Mostra/Nascondi il collegamento Approfondisci';
protected $AX_OTHCATL = 'Altre Categorie';
protected $AX_OTHCATD = 'Quando una categoria viene visitata, Mostra/Nascondi La lista delle altre Categorie.';
protected $AX_TDISTPD = 'Testo Da mostrare in alto sulla pagina.';
protected $AX_ORDBYL = 'Ordina per';
protected $AX_ORDBYD = 'Questo sovrascrive l\'ordinaeto degli elementi.';
protected $AX_MCS_DESCL = 'Descrizione';
protected $AX_SHCDESD = 'Mostra/Nascondi la Descrizione della Categoria.';
protected $AX_DESCIL = 'Descrizione Immagine';
protected $AX_MUDATFL = 'Formato Data';
protected $AX_MUDATFD = "Il Formato data verrà mostrato usando l'istruzione PHP strftime - se lasciato in bianco verrà caricato dal formato del tuo file lingua.";
protected $AX_MUDATCL = 'Colonna Data';
protected $AX_MUDATCD = 'Mostra/Nascondi la Colonna Data.';
protected $AX_MUAUTCL = 'Colonna Autore';
protected $AX_MUAUTCD = 'Mostra/Nascondi la Colonna Autore.';
protected $AX_MUHITCL = 'Colonna Hits';
protected $AX_MUHITCD = 'Mostra/Nascondi la Colonna Hits.';
protected $AX_MUNAVBL = 'Barra Navigazione';
protected $AX_MUNAVBD = 'Mostra/Nascondi la Barra Navigazione.';
protected $AX_MUORDSL = 'Seleziona Ordine';
protected $AX_MUORDSD = 'Mostra/Nascondi il menu a discesa Seleziona Ordine.';
protected $AX_MUDSPSL = 'Seleziona Visualizzazione';
protected $AX_MUDSPSD = 'Mostra/Nascondi il menu a discesa Seleziona Visualizzazione.';
protected $AX_MUDSPNL = 'Mostra Numero';
protected $AX_MUDSPND = 'Numero di elementi di default da mostrare.';
protected $AX_MUFLTL = 'Filtro';
protected $AX_MUFLTD = 'Mostra/Nascondi il Filtro.';
protected $AX_MUFLTFL = 'Campo Filtro';
protected $AX_MUFLTFD = 'Su quale campo deve essere applicato il filtro.';
protected $AX_MUOCATL = 'Ordine Categorie';
protected $AX_MUOCATD = 'Mostra/Nascondi la capacità di visualizzare la lista di altre categorie.';
protected $AX_MUECATL = 'Categorie Vuote';
protected $AX_MUECATD = 'Mostra/Nscondi Categorie vuote (senza Elementi).';
protected $AX_CATDSCL = 'Descrizione Categoria';
protected $AX_CATDSBLND = 'Mostra/Nascondi Descrizione Categoria, apparirà sotto il Nome Categoria .';
protected $AX_NAMCOLL = 'Nome Colonna';
protected $AX_LINKDSCL = 'Descrizione Collegamento';
protected $AX_LINKDSCD = 'Mostra/Nascondi il testo decrittivo dei collegamenti.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Questo componente mostra l\'elenco delle informazioni dei Contatti.';
protected $AX_CCT_CATLISTSL = 'Elenco Categoria - Sezione';
protected $AX_CCT_CATLISTSD = 'Mostra/Nascondi l\'elenco delle categorie nella pagina Elenco.';
protected $AX_CCT_CATLISTCL = 'Elenco Categoria - Categoria';
protected $AX_CCT_CATLISTCD = 'Mostra Nascondi l\'elenco delle Categoria nella pagina Tabella.';
protected $AX_CCT_CATDSCD = 'Mostra/Nascondi la Descrizione per l\'elenco delle Altre Categorie.';
protected $AX_CCT_NOCATITL = '# Elementi Categoria';
protected $AX_CCT_NOCATITD = 'Mostra/Nascondi il numero di elementi in ogni categoria.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parametri Individuali per gli elementi Contatti.';
protected $AX_CIT_NAMEL = 'Nome';
protected $AX_CIT_NAMED = 'Mostra/Nascondi l\'informazione Nome.';
protected $AX_CIT_POSITL = 'Posizione';
protected $AX_CIT_POSITD = 'Mostra/Nascondi l\'informazione Posizione.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Mostra/Nascondi l\'informazione Email. Se impostato su mostra l\'indirizzo verrà protetto da Spambots da un cloaking javascript.';
protected $AX_CIT_SADDREL = 'Indizzo ';
protected $AX_CIT_SADDRED = 'Mostra/Nascondi l\'informazione Indirizzo.';
protected $AX_CIT_TOWNL = 'Città';
protected $AX_CIT_TOWND = 'Mostra/Nascondi l\'informazione Città.';
protected $AX_CIT_STATEL = 'Stato';
protected $AX_CIT_STATED = 'Mostra/Nascondi l\'informazione Stato.';
protected $AX_CIT_COUNTRL = 'Nazione';
protected $AX_CIT_COUNTRD = 'Mostra/Nascondi l\'informazione Nazione.';
protected $AX_CIT_ZIPL = 'Codice postale';
protected $AX_CIT_ZIPD = 'Mostra/Nascondi l\'informazione Codice Postale.';
protected $AX_CIT_TELL = 'Telefono';
protected $AX_CIT_TELD = 'Mostra/Nascondi l\'informazione Telefono.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Mostra/Nascondi l\'informazione Fax.';
protected $AX_CIT_MISCL = 'Altre Informazioni';
protected $AX_CIT_MISCD = 'Mostra/Nascondi l\'informazione Altre informazioni.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Mostra/Nascondi Vcard.';
protected $AX_CIT_CIMGL = 'Imagine';
protected $AX_CIT_CIMGD = 'Mostra/Nascondi l\' Immagine.';
protected $AX_CIT_DEMAILL = 'Descrizione Email';
protected $AX_CIT_DEMAILD = 'Mostra/Nascondi il testo descrittivo sottostante.';
protected $AX_CIT_DTXTL = 'Testo Descrittivo';
protected $AX_CIT_DTXTD = 'Il testo descrittivo per il form Email. Se lasciato in bianco verrà utilizzato il contenuto della variabile _EMAIL_DESCRIPTION dal tuo file lingua.';
protected $AX_CIT_EMFRML = 'Email Form';
protected $AX_CIT_EMFRMD = 'Mostra/Nascondi l\'email form.';
protected $AX_CIT_EMCPYL = 'Copia Email ';
protected $AX_CIT_EMCPYD = 'Mostra/Nascondi Il checkbox email una copia all\'indirizzo di chi spedisce.';
protected $AX_CIT_DDL = 'Drop Down';
protected $AX_CIT_DDD = 'Mostra/Nascondi la lista di selezione Drop Down nella pagina Mostra Conatti.';
protected $AX_CIT_ICONTXL = 'Icona/testo';
protected $AX_CIT_ICONTXD = 'Use Icona, testo o niente vicino le informazioni mostrate in Informazioni Contatto.';
protected $AX_CIT_ICONS = 'Icone';
protected $AX_CIT_TEXT = 'Testo';
protected $AX_CIT_NONE = 'Niente';
protected $AX_CIT_ADICONL = 'Icona Indirizzo';
protected $AX_CIT_ADICOND = 'Icona per l\'informazione indirizzo.';
protected $AX_CIT_EMICONL = 'Icona Email ';
protected $AX_CIT_EMICOND = 'Icona per l\'informazione Email.';
protected $AX_CIT_TLICONL = 'Icona Telefono ';
protected $AX_CIT_TLICOND = 'Icon per l\'informazione Telefono.';
protected $AX_CIT_FXICONL = 'Icona Fax';
protected $AX_CIT_FXICOND = 'Icon per l\'informazione Fax.';
protected $AX_CIT_MCICONL = 'Icona Altre Informazioni';
protected $AX_CIT_MCICOND = 'Icona per l\'informazione Altre Informazioni.';
protected $AX_CCT_NAMEL = 'Nome';
protected $AX_CCT_NAMED = 'Mostra/Nascondi l\'informazione Nome.';
protected $AX_CCT_POSITL = 'Posizione';
protected $AX_CCT_POSITD = 'Mostra/Nascondi l\'informazione Posizione.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Mostra/Nascondi l\'informazione E-mail. Se impostato su mostra, l\'indirizzo verrà protetto da Spambots da un cloaking javascript.';
protected $AX_CCT_SADDREL = 'Indirizzo ';
protected $AX_CCT_SADDRED = 'Mostra/Nascondi l\'informazione Indirizzo.';
protected $AX_CCT_TOWNL = 'Città';
protected $AX_CCT_TOWND = 'Mostra/Nascondi l\'informazione Città.';
protected $AX_CCT_STATEL = 'Stato';
protected $AX_CCT_STATED = 'Mostra/Nascondi l\'informazione Stato.';
protected $AX_CCT_COUNTRL = 'Nazione';
protected $AX_CCT_COUNTRD = 'Mostra/Nascondi l\'informazione Nazione.';
protected $AX_CCT_ZIPL = 'Codice Postale';
protected $AX_CCT_ZIPD = 'Mostra/Nascondi l\'informazione Codice Postale.';
protected $AX_CCT_TELL = 'Telefono';
protected $AX_CCT_TELD = 'Mostra/Nascondi l\'informazione Telefono.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Mostra/Nascondi l\'informazione Fax.';
protected $AX_CCT_MISCL = 'Altre Informazioni';
protected $AX_CCT_MISCD = 'Mostra/Nascondi l\'informazione Altre Informazioni.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Mostra/Nascondi la Vcard.';
protected $AX_CCT_CIMGL = 'Immagine';
protected $AX_CCT_CIMGD = 'Mostra/Nascondi l\'immagine.';
protected $AX_CCT_DEMAILL = 'Descrizione Email';
protected $AX_CCT_DEMAILD = 'Mostra/Nascondi il testo descrittivo sottostante.';
protected $AX_CCT_DTXTL = 'Testo Descrittivo';
protected $AX_CCT_DTXTD = 'Il testo per il form Email. Se lasciato in bianco verrà utilizzato la definizione _EMAIL_DESCRIPTION dal tuo file lingua.';
protected $AX_CCT_EMFRML = 'Email Form';
protected $AX_CCT_EMFRMD = 'Mostra/Nascondi il form email a.';
protected $AX_CCT_EMCPYL = 'Copia Email';
protected $AX_CCT_EMCPYD = 'Mostra/Nascondi Il checkbox email una copia all\'indirizzo di chi spedisce.';
protected $AX_CCT_DDL = 'Drop Down';
protected $AX_CCT_DDD = 'Mostra/Nascondi la lista di selezione Drop Down nella pagina Mostra Conatti';
protected $AX_CCT_ICONTXL = 'Icone/testo';
protected $AX_CCT_ICONTXD = 'Usa Icona, testo, niente vicino le informazioni mostrate in informazioni Contatto.';
protected $AX_CCT_ICONS = 'Icone';
protected $AX_CCT_TEXT = 'Testo';
protected $AX_CCT_NONE = 'Niente';
protected $AX_CCT_ADICONL = 'Icona Indirizzo';
protected $AX_CCT_ADICOND = 'Icona per l\'informazione Indirizzo.';
protected $AX_CCT_EMICONL = 'Icona Email';
protected $AX_CCT_EMICOND = 'Icona per l\'informazione Email.';
protected $AX_CCT_TLICONL = 'Icona Telefono';
protected $AX_CCT_TLICOND = 'Icona per l\'informazione Telefono.';
protected $AX_CCT_FXICONL = 'Icona Fax';
protected $AX_CCT_FXICOND = 'Icona per l\'informazione Fax.';
protected $AX_CCT_MCICONL = 'Icona Altre Informazioni';
protected $AX_CCT_MCICOND = 'Icona per l\'informazione Altre Informazioni.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Questo Mostra il contenuto di una pagina singola.';
protected $AX_CNT_INTEXTL = 'Testo Introduttivo';
protected $AX_CNT_INTEXTD = 'Mostra/Nascondi il testo introduttivo.';
protected $AX_CNT_KEYRL = 'Chiave Riferimento';
protected $AX_CNT_KEYRD = 'Una Chiave alla quale un elemento può essere messo in relazione (come un riferimento di aiuto).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Questo componente mostra tutti i contenuti pubblicati sul sito indicati come Da Mostrare nella Pagina Pincipale.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parametri individuali per gli elementi Contatto.';
protected $AX_LG_LPTL = 'Titolo Pagina Login';
protected $AX_LG_LPTD = 'Testo da mostrare in alto nella pagina. Se non specificato verrà utilizzato il nome del Menu.';
protected $AX_LG_LRURLL = 'URL Ridirezione Login';
protected $AX_LG_LRURLD = 'Su quale Pagina verrà ridiretto dopo il Login. Se non specificato verrà caricata la pagina principale.';
protected $AX_LG_LJSML = 'Messaggio JS di Login';
protected $AX_LG_LJSMD = 'Mostra/Nascondi il pop-up javascript indicante l\'avvenuto Login con successo.';
protected $AX_LG_LDESCL = 'Descrizione Login';
protected $AX_LG_LDESCD = 'Mostra/Nascondi la descrizione sottostante al Login.';
protected $AX_LG_LDESTL = 'Testo Descrizione Login';
protected $AX_LG_LDESTD = 'Il testo da visualizzare nella pagina di Login. Se non specificato verrà utilizzata il valore della variabile _LOGIN_DESCRIPTION. dal tuo file lingua';
protected $AX_LG_LIMGL = 'Immagine Login';
protected $AX_LG_LIMGD = 'Immagine per la pagina di Login.';
protected $AX_LG_LIMGAL = 'Allineamento Immagine Login';
protected $AX_LG_LIMGAD = 'Allineamento per l\'immagine di Login.';
protected $AX_LG_LOPTL = 'Titolo pagina Logout';
protected $AX_LG_LOPTD = 'Il testo da visualizzare nella pagina di Logout. Se non specificato verrà utilizzato il nome del menu.';
protected $AX_LG_LORURLL = 'URL Ridirezione Logout';
protected $AX_LG_LORURLD = 'Su quale Pagina verrà ridiretto dopo il Login. Se non specificato verrà caricata la pagina principale.';
protected $AX_LG_LOJSML = 'Messaggio JS di Logout';
protected $AX_LG_LOJSMD = 'Mostra/Nascondi il pop-up javascript indicante l\'avvenuto Logout con successo';
protected $AX_LG_LODSCL = 'Descrizione Logout';
protected $AX_LG_LODSCD = 'Mostra/Nascondi la descrizione sottostante al Logout.';
protected $AX_LG_LODSTL = 'Testo Descrizione Logout';
protected $AX_LG_LODSTD = 'Il testo da visualizzare nella pagina di Logout. Se non specificato verrà utilizzata il valore della variabile _LOGOUT_DESCRIPTION dal tuo file lingua.';
protected $AX_LG_LOGOIL = 'Immagine Logout';
protected $AX_LG_LOGOID = 'Immagine per la pagina di Logout.';
protected $AX_LG_LOGOIAL = 'Allineamento Immagine Logout';
protected $AX_LG_LOGOIAD = 'Allineamento per l\'immagine di Logout.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Questo componente permette l\'invio di una email ad alcuni gruppi di utenti.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Questo componente gestisce i formati multimediali del sito.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Questo componente gestisce i tuoi Menù.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - Elemento Componente';
protected $AX_MUCIL_CDESC = 'Crea un link ad un componente Elxis esistente.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Componente';
protected $AX_MUCOMP_CDESC = 'Visualizza l\'interfaccia di frontend per un Componente.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabella - Categoria Contatti';
protected $AX_MUCCT_CDESC = 'Mostra una tabella degli elementi Contatto per la Categoria specificata.';
protected $AX_MUCCT_CATDL = 'Descrizione Categoria';
protected $AX_MUCCT_CATDD = 'Mostra/Nascondi la descrizione per l\'elenco Altre Categorie.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Elementi Contatto';
protected $AX_MUCTIL_CDESC = 'Crea un link ad un Elemento Contatto Pubblicato';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Archivio Contenuti Categoria';
protected $AX_MUCAC_CDESC = 'Mostra l\'elenco dei Elementi archiviati per la categoria specificata.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Archivio Contenuti Sezione';
protected $AX_MUCAS_CDESC = 'Mostra l\'elenco degli Elementi archiviati per la sezione specificata.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Contenuto Categoria';
protected $AX_MUCBC_CDESC = 'Visualizza una pagina di Elementi da categorie multiple usando un format tipo Blog .';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Contenuto Sezione';
protected $AX_MUCBS_CDESC = 'Mostra una pagina di elementi contenuti per sezioni multiple usando un format tipo Blog.';
protected $AX_MUCBS_SHSD = 'Mostra/Nascondi la Descrizione di Sezione.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabella - Contenuti Categoria';
protected $AX_MUCC_CDESC = 'Mostra una tabella con gli elementi contenuti per la Categoria Selezionata.';
protected $AX_MUCC_SHLOCD = 'Mostra/Nascondi la lista delle Altre Categorie.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - Elemento Contenuto';
protected $AX_MCIL_CDESC = 'Crea un link ad un elemento pubblicato in modalità pagina piena.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabella - Contenuti Sezione';
protected $AX_MCS_CDESC = 'Crea un elenco dei contenuti delle Categorie per la Sezione selezionata.';
protected $AX_MCS_STL = 'Titolo Sezione';
protected $AX_MCS_STD = 'Mostra/Nascondi il Titolo Sezione.';
protected $AX_MCS_SHCTID = 'Mostra/Nascondi l\'immagine della Descrizione della Categoria.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - Pagina Autonoma';
protected $AX_MLSC_CDESC = 'Crea un link ad un elemento di Pagina Autonama.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabella - Categoria Novità';
protected $AX_MNSFC_CDESC = 'Mostra una Tabella delle novità per la Categoria Selezionata.';
protected $AX_MNSFC_SHNCD = 'Mostra/Nascondi il Nome Colonna.';
protected $AX_MNSFC_ACL = 'Colonna Articoli';
protected $AX_MNSFC_ACD = 'Mostra/Nascondi la colonna Articoli.';
protected $AX_MNSFC_LCL = 'Colonna Link';
protected $AX_MNSFC_LCD = 'Mostra/Nascondi la colonna Link.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - Novità';
protected $AX_MNSFL_CDESC = 'Crea un link ad una singola novità pubblicata.';
protected $AX_MNSFL_FDIML = 'Immagine Feed';
protected $AX_MNSFL_FDIMD = 'Mostra/Nascondi l\'immagine feed.';
protected $AX_MNSFL_FDDSL = 'Descrizione Feed';
protected $AX_MNSFL_FDDSD = 'Mostra/Nascondi il testo descrittivo per i feed.';
protected $AX_MNSFL_WDCL = 'Conteggio Parole';
protected $AX_MNSFL_WDCD = 'Permette di limitare la quantità di testo descrittivo di un elmento. 0 mostrerà tutto il testo.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separatore / Contenitore';
protected $AX_MSEP_CDESC = 'Crea un menù Contenitore o separatore.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Collegamento - Url';
protected $AX_MURL_CDESC = 'Crea un collegamento ad una URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabella - Categoria Weblink';
protected $AX_MWLC_CDESC = 'Mostra una tabella degli elementi Weblink per una particolare categoria selezionata.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Crea un IFrame che effettuerà il Wrapper di una Pagina/Sito Esterno in Elxis.';
protected $AX_MWRP_SCRBL = 'Barra di scorrimento';
protected $AX_MWRP_SCRBD = 'Mostra/Nascondi barre di scorrimento Orizzontale & Verticale.';
protected $AX_MWRP_WDTL = 'Larghezza';
protected $AX_MWRP_WDTD = 'Larghezza della finestra IFrame. Puoi inserire un valore assoluto in pixels od un valore relativo in %.';
protected $AX_MWRP_HEIL = 'Altezza';
protected $AX_MWRP_HEID = 'Altezza della Finestra IFrame.';
protected $AX_MWRP_AHL = 'Altezza Auto';
protected $AX_MWRP_AHD = 'L\'altezza verrà automaticamente impostata alla misura della pagina esterna. Questo funzionerà unicamente per le pagine presenti sul tuo dominio.';
protected $AX_MWRP_AADL = 'Aggiungi Automaticamente';
protected $AX_MWRP_AADD = 'Di default http:// verrà aggiunto fin quando http:// o https:// è individuato nell\'url del link inserito. Questa opzione permette di disabilitare questa feature.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'System link';
protected $AX_MSYS_CDESC = 'Crea un collegamento ad una Feature di Sistema';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Questo Componente Gestice le novità RSS/RDF.';
protected $AX_NFE_DPD = 'Descrizione per pagina';
protected $AX_NFE_SHFNCD = 'Mostra/Nascondi il nome della colonna Feed.';
protected $AX_NFE_NOACL = '# Colonna Articoli';
protected $AX_NFE_NOACD = 'Mostra/Nascondi il # degli articoli nel feed.';
protected $AX_NFE_LCL = 'Colonna Collegamenti';
protected $AX_NFE_LCD = 'Mostra/Nascondi Collegamento Colonna Feed.';
protected $AX_NFE_IDL = 'Descrizione Elemento';
protected $AX_NFE_IDD = 'Mostra/Nascondi la Descrizione o testo introduttivo di un elemento.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Questo componente gestisce la funzionalità di Ricerca.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Questo componente controlla i parametri delle Syndication.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache i files feed.';
protected $AX_SYN_CACHTL = 'Cache Time';
protected $AX_SYN_CACHTD = 'I file presenti nella Cache verranno aggiornati ogni x secondi.';
protected $AX_SYN_ITMSL = '# Elementi';
protected $AX_SYN_ITMSD = 'Numeri Elementi syndicate.';
protected $AX_SYN_ITMSDFLT = 'Elxis Syndication';
protected $AX_SYN_TITLE = 'Titolo Syndication ';
protected $AX_SYN_DESCD = 'Descrizione Syndication.';
protected $AX_SYN_DESCDFLT = 'Elxis site syndication';
protected $AX_SYN_IMGD = 'Immagine da includere nel feed.';
protected $AX_SYN_IMGAL = 'Immagine Alternativa';
protected $AX_SYN_IMGAD = 'Testo alternativo per l\'immagine.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Limite Testo';
protected $AX_SYN_LMTD = 'Limita il testo dell\'articolo al valore indicato di sotto.';
protected $AX_SYN_TLENL = 'Lunghezza Testo';
protected $AX_SYN_TLEND = 'Permette di limitare la quantità di testo descrittivo di un elmento. 0 mostrerà tutto il testo.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Attivare il supporto per Firefox Live Bookmarks.';
protected $AX_SYN_BFL = 'Bookmark file';
protected $AX_SYN_BFD = 'Nome Speciale del File. Se vuoto verrà utilizzato il nome di default.';
protected $AX_SYN_ORDL = 'Ordine';
protected $AX_SYN_ORDD = 'Ordine secondo il quale gli elementi verranno visualizzati.';
protected $AX_SYN_MULTIL = 'Feeds Multi-Lingua';
protected $AX_SYN_MULTILD = 'Se Si, Elxis genererà feeds specifici per ogni lingua.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Questo Componente gestice la funzionalità del cestino.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Questo Mostrerà il contenuto su una singola pagina.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Questo componente mostrerà un lista di Weblinks con screenshots dei siti.';
protected $AX_WBL_LDL = 'Descrizione Collegamenti';
protected $AX_WBL_LDD = 'Mostra/Nascondi il testo descrittivo dei collegamenti.';
protected $AX_WBL_ICL = 'Icona';
protected $AX_WBL_ICD = 'Icona da usarsi, nella tabella, sulla sinistra dei collegamenti url.';
protected $AX_WBL_SCSL = 'Screenshots';
protected $AX_WBL_SCSD = 'Mostra gli Screenshot dei siti collegati. Se usato, le icone dei Weblink non verranno visualizzate.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Finestra Target quando il collegamento è cliccato';
protected $AX_WBLI_OT01 = 'Nuova Scheda Con Browser Navigation ';
protected $AX_WBLI_OT02 = 'Nuova Finestra con Browser Navigation ';
protected $AX_WBLI_OT03 = 'Nuova Finestra senza Browser Navigation ';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Questo modulo mostra una lista degli elementi più recenti pubblicati o che sono ancora correnti (alcuni possono essere scaduti sebbene siano molto recenti). Gli elementi che sono mostrati nella pagina principale non sono inclusi in questa lista.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Questo Modulo mostra una lista di utenti correntemente loggati.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Questo modulo mostra una lista di elementi che sono ancora correnti (alcuni possono essere scaduti sebbene siano molto recenti). Gli elementi che sono mostrati nella pagina principale non sono inclusi in questa lista.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Questo modulo mostra le statistiche degli elementi che sono ancora correnti (alcuni possono essere scaduti sebbene siano molto recenti). Gli elementi che sono mostrati nella pagina principale non sono inclusi in questa lista.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Suffisso Classe Moduli'; 
protected $AX_SM_MCSD = 'Un suffisso da applicare alla classe CSS del modulo (table.moduletable), Questo permetterà un styling del modulo individuale.'; 
protected $AX_SM_MUCSL = 'Suffisso Classe Menu'; 
protected $AX_SM_MUCSD = 'Un suffisso da applicare alla classe CSS dell\'elemento Menu.'; 
protected $AX_SM_ECL = 'Abilita Cache'; 
protected $AX_SM_ECD = 'Seleziona se effettuare il chaching del contenuto di questo modulo.'; 
protected $AX_SM_SMIL = 'Mostra Icone Menu'; 
protected $AX_SM_SMID = 'Mostra le icone selezionate per l\'elemento Menu.'; 
protected $AX_SM_MIAL = 'Allineamento Icone Menu'; 
protected $AX_SM_MIAD = 'Allineamento delle Icone Menu'; 
protected $AX_SM_MODL = 'Modalità Modulo'; 
protected $AX_SM_MODD = 'Permette il controllo sul tipo di contenuto da mostrare nel modulo.'; 
protected $AX_SM_OP01 = 'Solo Elementi Contenuto'; 
protected $AX_SM_OP02 = 'Solo Pagine Autonome'; 
protected $AX_SM_OP03 = 'Entrambi'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Moduli Custom.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Inserisci l URL del feed RSS/RDF.'; 
protected $AX_SM_CU_FEDL = 'Descrizione Feed'; 
protected $AX_SM_CU_FEDD = 'Mostra un testo Descrittivo dell\'intero Feed.'; 
protected $AX_SM_CU_FEIL = 'Immagine Feed'; 
protected $AX_SM_CU_FEDID = 'Mostra l\'immagine associata per l\'intero Feed.'; 
protected $AX_SM_CU_ITL = 'Elementi'; 
protected $AX_SM_CU_ITD = 'Inserisci il numero di Elementi RSS da mostrare.'; 
protected $AX_SM_CU_ITDL = 'Descrizione Elemento'; 
protected $AX_SM_CU_ITDD = 'Mostra la descrizione oppure un testo introduttivo per ogni elemento News.'; 
protected $AX_SM_CU_WCL = 'Conteggio Parole'; 
protected $AX_SM_CU_WCD = 'Permette di limitare la quantità di testo descrittivo di un elemento. 0 mostrerà tutto il testo.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Questo modulo mostra una lista dei mesi del calendario che contengono Elementi Archiviati. Non appena avrai combiato lo stato di un elemento in \'Archived\' questa lista verrà generata automaticamente'; 
protected $AX_SM_AR_CNTL = 'Conteggio'; 
protected $AX_SM_AR_CNTD = 'Il numero di elementi da mostrare (default è 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Il Modulo Banner permette di visualizzare Banner all\'interno del tuo sito.'; 
protected $AX_SM_BN_CNTL = 'Cliente Banner'; 
protected $AX_SM_BN_CNTD = "Identificativo di riferimento del Cliente Banner. Inserire separando con ','!"; 
protected $AX_SM_BN_NBSL = 'Numero di Banner Visualizzati';
protected $AX_SM_BN_NBPRL = 'Numero di Banner per Riga';
protected $AX_SM_BN_NBPRD = 'Numero di Banner per riga. Per disabilitare impostare 0. Per visualizzare banner verticalmente, imposta questo parametro a 1';
protected $AX_SM_BN_UNQBL = 'Banner Univoco';
protected $AX_SM_BN_UNQBD = 'Nessun Banner verrà visualizzato più di una volta (per sessione). Se tutti i banner sono stati visualizzati, lo storico verrà pulito e riavviato.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Questo modulo visulizza una lista degli elementi validi più recenti pubblicati (alcuni possono essere scaduti sebbene siano molto recenti). Elementi visualizzati nella Pagina Pricipale non sono inclusi in questa lista.'; 
protected $AX_SM_LN_FPIL = 'Elementi Pagina Principale'; 
protected $AX_SM_LN_FPID = 'Mostra/Nascondi elementi designati per la Pagina Pricipale - funziona solo se elemento Contenuto.'; 
protected $AX_SM_AR_CNT5D = 'Numero di elementi da visualizzare (default è 5).'; 
protected $AX_SM_LN_CATIL = 'ID Categoria'; 
protected $AX_SM_LN_CATID = 'Seleziona Elementi da una Categoria specifica o un set di Categorie (per specificare più di una Categoria, separate le stesse con una virgola , ).'; 
protected $AX_SM_LN_SECIL = 'ID Sezione'; 
protected $AX_SM_LN_SECID = 'Seleziona elementi da una Sezione specifica o un set di Sezioni (per specificare più di una Sezione, separate le stesse con una virgola , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Questo Modulo permette di visualizzare il form di Login con Nome utente e Password. Visualizza anche un link per richiedere la password se dimenticata. Se la registrazione automatica utente è abilitata, (fai riferimento ai parametri di Configurazione), un\'altro link verrà visualizzato invitante l\'utente ad auto registrarsi.'; 
protected $AX_SM_LF_PTL = 'Testo Precedente'; 
protected $AX_SM_LF_PTD = 'Questo è il testo o codice HTML che è visualizzato sopra il form di login.'; 
protected $AX_SM_LF_PSTL = 'Testo Successivo'; 
protected $AX_SM_LF_PSTD = 'Questo è il testo o codice HTML che è visualizzato sotto il form di login.'; 
protected $AX_SM_LF_LRUL = 'URL di Ridirezione Login'; 
protected $AX_SM_LF_LRUD = 'Su quale pagina verrà ridirezionato l\'utente che effettua il login dopo il logout. Se lasciato in bianco verrà caricata la pagina principale.'; 
protected $AX_SM_LF_LORUL = 'URL di Ridirezione Logout'; 
protected $AX_SM_LF_LORUD = 'Su quale pagina verrà ridirezionato l\'utente che effettua il login dopo il login. Se lasciato in bianco verrà caricata la pagina principale.'; 
protected $AX_SM_LF_LML = 'Messaggio di Login'; 
protected $AX_SM_LF_LMD = 'Mostra/Nascondi il Pop-up javascript pop-up indicate l\'avvenuto login con successo.'; 
protected $AX_SM_LF_LOML = 'Logout Message'; 
protected $AX_SM_LF_LOMD = 'Mostra/Nascondi il Pop-up javascript pop-up indicate l\'avvenuto logout con successo.'; 
protected $AX_SM_LF_GML = 'Congratulazioni'; 
protected $AX_SM_LF_GMD = 'Mostra/Nascondi un semplice testo di Congratulazioni.'; 
protected $AX_SM_LF_NUNL = 'Nome/Nome Utente'; 
protected $AX_SM_LF_OP01 = 'Nome Utente'; 
protected $AX_SM_LF_OP02 = 'Nome'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Visualizza un Menu.'; 
protected $AX_SM_MNM_MNL = 'Nome Menu'; 
protected $AX_SM_MNM_MND = 'Il nome del menu (default è \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Stile Menu'; 
protected $AX_SM_MNM_MSD = 'Lo stile del menu'; 
protected $AX_SM_MNM_OP1 = 'Verticale'; 
protected $AX_SM_MNM_OP2 = 'Orizzontale'; 
protected $AX_SM_MNM_OP3 = 'Lista'; 
protected $AX_SM_MNM_EML = 'Menu Espansione'; 
protected $AX_SM_MNM_EMD = 'Espande il menu e rende i suoi sub-menu sempre visibili.'; 
protected $AX_SM_MNM_IIL = 'Trattino Immagine'; 
protected $AX_SM_MNM_IID = 'Scegli quale sistema di Rietro Immagine da utilizzare.'; 
protected $AX_SM_MNM_OP4 = 'Template'; 
protected $AX_SM_MNM_OP5 = 'Elxis Immagini di default'; 
protected $AX_SM_MNM_OP6 = 'Usa i parametri sottostanti'; 
protected $AX_SM_MNM_OP7 = 'Nessuna'; 
protected $AX_SM_MNM_II1L = 'Trattino Immagine 1'; 
protected $AX_SM_MNM_II1D = 'L\'immagine per il primo sotto livello.'; 
protected $AX_SM_MNM_II2L = 'Trattino Immagine 2'; 
protected $AX_SM_MNM_II2D = 'L\'immagine per il secondo sotto livello.'; 
protected $AX_SM_MNM_II3L = 'Trattino Immagine 3'; 
protected $AX_SM_MNM_II3D = 'L\'immagine per il terzo sotto livello.'; 
protected $AX_SM_MNM_II4L = 'Trattino Immagine 4'; 
protected $AX_SM_MNM_II4D = 'L\'immagine per il quarto sotto livello.'; 
protected $AX_SM_MNM_II5L = 'Trattino Immagine 5'; 
protected $AX_SM_MNM_II5D = 'L\'immagine per il quito sotto livello'; 
protected $AX_SM_MNM_II6L = 'Trattino immagine 6'; 
protected $AX_SM_MNM_II6D = 'L\'immagine per il sesto sotto livello'; 
protected $AX_SM_MNM_SPL = 'Spaziatura'; 
protected $AX_SM_MNM_SPD = 'Spaziatura per il il Menu Orizzonatle.'; 
protected $AX_SM_MNM_ESL = 'Spaziatura Fine'; 
protected $AX_SM_MNM_ESD = 'Fine Spaziatura per il Menu Orizzontale.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Precarico ID Elementi';
protected $AX_SM_MNM_IDPRD = 'Abilita il precaricamento AJAX dell\'elemento ID risolvendo la problematica relativa ad un elemento, impostato nel menu, con più di un collegamento puntante alla stessa pagina.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Questo modulo visualizza una lista degli elementi correnti pubblicati aventi il maggior numero di visite determinato dal numero delle volte la stessa pagina è stata visitata.'; 
protected $AX_SM_MRC_MNL = 'Nome Menu'; 
protected $AX_SM_MRC_MND = 'Il nome del menu (default è mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Elementi Pagina Principale'; 
protected $AX_SM_MRC_FPID = 'Mostra/Nascondi Elementi designati per la pagina principale. Funziona solo con gli Elementi Contenuto.'; 
protected $AX_SM_MRC_CL = 'Conta'; 
protected $AX_SM_MRC_CD = 'Il numero di Elementi da visualizzare (default è 5).'; 
protected $AX_SM_MRC_CIDL = 'ID Categoria'; 
protected $AX_SM_MRC_CIDD = 'Selezione di Elementi di una Specifica Categoria o set di Categorie (Per specificare più di una Categoria è necessario separare le stesse con una virgola , ).'; 
protected $AX_SM_MRC_SIDL = 'ID Sezione'; 
protected $AX_SM_MRC_SIDD = 'Selezione di Elementi di una Specifica Sezione o set di Sezioni (Per specificare più di una Sezione è necessario separare le stessa con una virgola , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Il modulo Newsflash seleziona a caso uno degli elementi pubblicati da una categoria ogni volta che avviene il refresh della pagina. Permette anche di configurare la visualizzazione in Orizzontale od in Verticale di più elementi.'; 
protected $AX_SM_NWF_CATL = 'Categoria'; 
protected $AX_SM_NWF_CATD = 'Contenuto della Categoria.'; 
protected $AX_SM_NWF_STL = 'Stile'; 
protected $AX_SM_NWF_STD = 'Lo stille della Categoria visualizzata.'; 
protected $AX_SM_NWF_OP1 = 'Scelta casuale una tantum'; 
protected $AX_SM_NWF_OP2 = 'Orizzontale'; 
protected $AX_SM_NWF_OP3 = 'Verticale'; 
protected $AX_SM_NWF_SIL = 'Visualizza Immagini'; 
protected $AX_SM_NWF_SID = 'Visualizza Elementi Immagini nei contenuti.'; 
protected $AX_SM_NWF_LTL = 'Ticoli Collegati'; 
protected $AX_SM_NWF_LTD = 'Crea l\'elemento Titolo collegabile.'; 
protected $AX_SM_NWF_RML = 'Approfondisci'; 
protected $AX_SM_NWF_RMD = 'Mostra/Nascondi Il Bottone Approfondisci.'; 
protected $AX_SM_NWF_ITL = 'Titolo Elemento'; 
protected $AX_SM_NWF_ITD = 'Mostra l\'elemento Titolo.'; 
protected $AX_SM_NWF_NOIL = 'No. di Elementi'; 
protected $AX_SM_NWF_NOID = 'No di Elementi da visualizzare.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Questo modulo riguarda il componente Sondaggi. E\' usato per mostrare tutti i sondaggi configurati. Questo modulo differisce dagli altri moduli in quanto tale componente supporta il collegamento tra Elementi del Menu e Sondaggi. Questo significa che questo modulo visualizza solo quei sondaggi che sono configurati per un certo elemento del Menu.'; 
protected $AX_SM_POL_CATL = 'Categoria'; 
protected $AX_SM_POL_CATD = 'Una Categoria di Contenuto.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Questo modulo visualizza una immagine casuale dalla cartella scelta.'; 
protected $AX_SM_RNI_ITL = 'Tipo Immagine'; 
protected $AX_SM_RNI_ITD = 'Tipo di immagine PNG/GIF/JPG etc. (default è JPG).'; 
protected $AX_SM_RNI_IFL = 'Cartella Immagine'; 
protected $AX_SM_RNI_IFD = 'Percorso della cartella contenente le immagini relative all\' URL del sito; es: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Collegamento'; 
protected $AX_SM_RNI_LND = 'Una URL a cui ridirezionare se l\'immagine è cliccata; es: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Larghezza (px)'; 
protected $AX_SM_RNI_WD = 'Larghezza Immagine (Forza tutte le immagini ad essere visualizzate con questa larghezza).'; 
protected $AX_SM_RNI_HL = 'Altezza (px)'; 
protected $AX_SM_RNI_HD = 'Altezza Immagine (forza tutte le immagini ad essere visualizzate con questa altezza).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Questo modulo visualizza gli elementi contenuti in Altri Contenuti che sono relativi ad elementi correntemente visualizzati. E' Basato su parole chiave in Metadata. Tutte le parole chiave del corrente contenuto sono cercate raffrontandole con tutte le parole chiave di tutti gli altri elementi pubblicati. Per esempio tu puoi avere un elemento sulla 'Grecia' ed un altro sul 'Partenone'. Se includi le parole chiave 'Grecia' in entrambi gli elementi, Il modulo Elementi Relativi visualizzerà una lista con l'Elemento 'Grecia' quando verrà visualizzato 'Partenone' e vice-versa."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Il modulo Syndicate visualizzerà un collegamento dove le persone potranno effettuare il syndicate del tuo sito per tutte le tue ultime news. Quando cliccherai sulla icona RSS, verrai ridirezionato su una nuova pagina che visualizzerà una lista di tutte le ultime novità in formato XML. Per poter utilizzare il Newsfeed in un altro sito ELXIS od in un lettore di Newsfeed, hai bisogno di tagliare ed incollare l\'URL.'; 
protected $AX_SM_RSS_TXL = 'Testo'; 
protected $AX_SM_RSS_TXD = 'Inserisci il testo da visualizzare unitamente al collegamento RSS.'; 
protected $AX_SM_RSS_091D = 'Mostra/Nascondi il collegamento RSS 0.91.'; 
protected $AX_SM_RSS_10D = 'Mostra/Nascondi il collegamento RSS 1.0.'; 
protected $AX_SM_RSS_20D = 'Mostra/Nascondi il collegamento RSS 2.0.'; 
protected $AX_SM_RSS_03D = 'Mostra/Nascondi il collegamento Atom 0.3.'; 
protected $AX_SM_RSS_OPD = 'Mostra/Nascondi il collegamento OPML.'; 
protected $AX_SM_RSS_I091L = 'Immagine RSS 0.91'; 
protected $AX_SM_RSS_I10L = 'Immagine RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Immagine RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Immagine Atom'; 
protected $AX_SM_RSS_IOPL = 'Immagine OPML'; 
protected $AX_SM_RSS_CHID = 'Scegli l\'immagine da usare.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Questo modulo Visualizza un Box Ricerca.';
protected $AX_SM_SEM_TOP = 'Alto';
protected $AX_SM_SEM_BTM = 'Basso';
protected $AX_SM_SEM_BWL = 'Larghezza Box';
protected $AX_SM_SEM_BWD = 'Misura del Box Ricerca.';
protected $AX_SM_SEM_TXL = 'Testo';
protected $AX_SM_SEM_TXD = 'Il testo che apparirà nel Box Ricerca, Se lasciato in bianco verrà visualizzato il valore della variabile _SEARCH_BOX caricata dal tuo linguaggio.';
protected $AX_SM_SEM_BPL = 'Posizione bottone';
protected $AX_SM_SEM_BPD = 'Posizione del Bottone relativa al Box di Ricerca.';
protected $AX_SM_SEM_BTXL = 'Testo Bottone';
protected $AX_SM_SEM_BTXD = 'Il testo che dovrà apparire nel Bottone Ricerca. Se lasciato in bianco verrà visualizzato il valore della varibile _SEARCH_TITLE caricata dal tuo file lingua.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'La Sezione Moduli visualizza una lista di tutte le Sezioni configurate nel tuo database. Le sezioni presenti sono solo relative ad Elementi Sezione. Se la configurazione \'Mostra Collegamenti non Autorizzati\' non è settata, la lista delle sezioni verrà limitata a quella che è possibile visualizzare da parte dell\'utente.'; 
protected $AX_SM_SEC_CL = 'Conteggio';
protected $AX_SM_SEC_CD = 'Il numero di elementi da visualizzare (default è 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Il modulo Statistiche mostra informazioni sulla tua installazione sul server e statistiche, mumero di elementi contenuti nel tuo database ed i lnumero dei collegamenti web.';
protected $AX_SM_STA_SVIL = 'informazioni Server'; 
protected $AX_SM_STA_SVID = 'Visualizza le informazioni sul Server.'; 
protected $AX_SM_STA_SIL = 'Informazioni Sito'; 
protected $AX_SM_STA_SID = 'Visualizza le informazioni sul sito.'; 
protected $AX_SM_STA_HCL = 'Conteggio Hits'; 
protected $AX_SM_STA_HCD = 'Vsualizza il Conteggio Hits.'; 
protected $AX_SM_STA_ICL = 'Incrementa Contatore'; 
protected $AX_SM_STA_ICD = 'Inserisci il valore da incrementare per l\'elemento hits.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Il modulo Scelta Template permette agli utenti (visitatori) di cambiare al volo il template del sito attraverso un menu a tendina contenente la lista dei template.'; 
protected $AX_SM_TMC_MNLL = 'Lungezza Max. Nome'; 
protected $AX_SM_TMC_MNLD = 'Questa è la lunghezza massima del nome del template da visualizzare (default 20).'; 
protected $AX_SM_TMC_SPL = 'Mostra Preview'; 
protected $AX_SM_TMC_SPD = 'La preview del Template verrà visualizzata.'; 
protected $AX_SM_TMC_WL = 'Larghezza'; 
protected $AX_SM_TMC_WD = 'Questa è la larghezza dell\'immagine di preview (default 140 px).'; 
protected $AX_SM_TMC_HL = 'Altezza'; 
protected $AX_SM_TMC_HD = 'Questa è l\'altezza della immagine di preview (default 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Il Modulo Chi è Online visualizza il numero degli utenti anonimi (visitatori) ed utenti registrati che stanno correntemente avendo accesso al sito web.'; 
protected $AX_SM_WSO_DL = 'Visualizzazione'; 
protected $AX_SM_WSO_DD = 'Seleziona cosa dovrebbe essere visualizzato.'; 
protected $AX_SM_WSO_OP1 = '# di Visitatori/Utenti<br />'; 
protected $AX_SM_WSO_OP2 = 'Nome Utente<br />'; 
protected $AX_SM_WSO_OP3 = 'Entrambi'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Questo Modulo visualizza una finestra IFrame nella locazione specificata.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL di un sito/file tu vuoi venga visualizzato nell\'IFrame'; 
protected $AX_SM_WRM_SCBL = 'Barre di Scorrimento'; 
protected $AX_SM_WRM_SCBD = 'Mostra/Nascondi le barre di scorrimento Orizzontale & Verticale'; 
protected $AX_SM_WRM_WL = 'Larghezza'; 
protected $AX_SM_WRM_WD = 'Larghezza della finestra IFrame. Puoi inserire un valore assoluto in pixels oppure un valore relativo in %.'; 
protected $AX_SM_WRM_HL = 'Altezza'; 
protected $AX_SM_WRM_HD = 'Altezza della finestra IFrame'; 
protected $AX_SM_WRM_AHL = 'Altezza Automatica'; 
protected $AX_SM_WRM_AHD = 'L\'altezza verrà automaticamente impostata a quella della pagina esterna. Funziona solo per le pagine presenti sul tuo dominio.'; 
protected $AX_SM_WRM_ADL = 'Auto Add'; 
protected $AX_SM_WRM_ADD = 'Di default http:// verrà aggiunto fin quando http:// o https:// è individuato nell\'url del link inserito. Questa opzione permette di disabilitare questa feature.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Funzionalità'; 
protected $AX_ED_FUNCTD = 'Seleziona il tipo di funzionalità'; 
protected $AX_ED_FUNSIMPLE = 'Semplice'; 
protected $AX_ED_FUNADV = 'Avanzata';
protected $AX_ED_EDITORWIDTHL = 'Larghezza Editr';
protected $AX_ED_EDITORWIDTHD = 'Larghezza della finestra di Editing';
protected $AX_ED_EDITORHEIGHTL = 'Altezza Editor';
protected $AX_ED_EDITORHEIGHTD = 'Altezza della finestra di Editing';
protected $AX_ED_COMPRESSEDVL = 'Versione compressa';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE può essere lanciato in versione compressa per un caricamente più veloce. Tuttavia questa modalità non funziona sempre specialmente IE, quindi di default è immpostata su OFF. State attenti quando la abilitate assicurandovi che questa funzioni sul vostro sistema.';
protected $AX_ED_OFF = 'Off';
protected $AX_ED_ON = 'On';
protected $AX_ED_COMPRESSL = 'Compressione';
protected $AX_ED_COMPRESSD = 'Comprime l\'editor TinyMCE usando gzip (loads 75% faster)';
protected $AX_ED_CONVERTURLL = 'URLs Converter';
protected $AX_ED_CONVERTURLD = 'Converte URLs da Assolute in Relative.';
protected $AX_ED_ENTENCODL = 'Entity Encoding';
protected $AX_ED_ENTENCODD = 'Questa opzione controlla come le entità caratteri vengono processati da parte di TinyMCE. Questo valore può essere impostato come rappresetazione numerica, entità identificate o generica, quando nessuna codifica è effettauta. Il valore di The default per questa opzione è generica.';
protected $AX_ED_TXTDIRL = 'Text Direction';
protected $AX_ED_TXTDIRD = 'Capacità di Cambiare la direzione del testo';
protected $AX_ED_CNVFONTSPANL = 'Convert Fonts to Spans';
protected $AX_ED_CNVFONTSPAND = 'Converte gli elementi Font in elementi Span. Il valore di default è SI in quanto gli elementi FOnts sono deprecati.';
protected $AX_ED_FONTSIZETYPEL = 'Font Size Type';
protected $AX_ED_FONTSIZETYPED = 'Permette di scegliere il tipo di misura Fonts da utilizzare, se sia lunghezza es: 10pt, o dimensioni assolute es: x-small.';
protected $AX_ED_INLTABLEDITL = 'Inline Table Editing';
protected $AX_ED_INLTABLEDITD = 'Permette la modifica inline delle tabelle.';
protected $AX_ED_PROHELEMENTSL = 'Prohibited Elements';
protected $AX_ED_PROHELEMENTSD = 'Elementi che verrano puliti dal testo';
protected $AX_ED_EXTELEMENTSL = 'Extended Elements';
protected $AX_ED_EXTELEMENTSD = 'Funzionalità estese di TinyMCE che permette l\'aggiunta di elementi extra. Formato: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Event Elements';
protected $AX_ED_EVELEMENTSD = 'Questa opzione dovrebbe contenere una lista di elementi separati da virgola che possono avere attibuti come l\'on-click e similari. Questa opzione è necessaria in quanto alcuni browsers eseguono questi eventi durante la modifica dei contenuti.';
protected $AX_ED_TCSSCLASSESL = 'Template CSS classes';
protected $AX_ED_TCSSCLASSESD = 'Carica la classe CSS dal template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Custom CSS Classes';
protected $AX_ED_CCSSCLASSESD = 'Permette di specificare il caricamento di un file CSS customizzato - Semplicemente inserendo il nome del file CSS. Questo file DEVE essere presente nella stessa cartella del file CSS del template.';
protected $AX_ED_NEWLINESL = 'Newlines';
protected $AX_ED_NEWLINESD = 'Newlines verrà inserita nella opzione selezionata';
protected $AX_ED_TOOLBARL = 'Toolbar';
protected $AX_ED_TOOLBARD = 'Posizione della toolbar';
protected $AX_ED_HTMLHEIGHTL = 'HTML Height';
protected $AX_ED_HTMLHEIGHTD = 'Altezza della finestra Pop-Up in HTML.';
protected $AX_ED_HTMLWIDTHL = 'HTML Width';
protected $AX_ED_HTMLWIDTHD = 'Larghezza della finestra Pop-Up in HTML.';
protected $AX_ED_PREVIEWHEIGHTL = 'Preview Altezza';
protected $AX_ED_PREVIEWHEIGHTD = 'Altezza della finestra Pop-Up di Preview.';
protected $AX_ED_PREVIEWWIDTHL = 'Preview Width';
protected $AX_ED_PREVIEWWIDTHD = 'Larghezza della finestra Pop-Up di Preview.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser è un gestore avanzato di immagini';
protected $AX_ED_PLTABLESL = 'Tables Plugin';
protected $AX_ED_PLTABLESD = 'Abilita la creazione di Tabelle in modalità WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Paste Plugin';
protected $AX_ED_PLPASTED = 'Abilita l\'incolla da Word, da Testo e da Seleziona Tutto.';
protected $AX_ED_PLIMGPLUGINL = 'Adv. Image Plugin';
protected $AX_ED_PLIMGPLUGIND = 'Abilita il Manager di immagini avanzato. Di default è abilitato l\'editor semplice.';
protected $AX_ED_PLSEARCHL = 'Trova/Sostituisci Plugin';
protected $AX_ED_PLSEARCHD = 'Abilita il plugin Trova/Sostituisci.';
protected $AX_ED_PLLINKSL = 'Adv. Links Plugin';
protected $AX_ED_PLLINKSD = 'Abilita il Gestore Avanzato Collegamenti. Di default l\'editor semplice è abilitato.';
protected $AX_ED_PLEMOTL = 'Emotions Plugin';
protected $AX_ED_PLEMOTD = 'Abilita l\'emotion Plugin. Puoi facilmente inserire Emoticons.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Abilita il Plugin Flash. Sarai in grado di inserire contenuti multimediali in formato Flash .';
protected $AX_ED_PLDTL = 'Data/Ora Plugin';
protected $AX_ED_PLDTD = 'Abilita il Data/Ora Plugin. Sarai in grado di inderire la data e l\'ora corrente.';
protected $AX_ED_PLPREVL = 'Preview Plugin';
protected $AX_ED_PLPREVD = 'Questo Plugin aggiunge un bottone di preview a TinyMCE. Premendo tale bottone verrà aperto un popup visualizzante il contenuto corrente.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Aggiunge la funzionalità di zoom drop list in MSIE5.5+. Questo plugin è stato creato principalmente per mostrare come aggiungere delle droplist customizzate come plugins.';
protected $AX_ED_PLFSCRL = 'FullScreen Plugin';
protected $AX_ED_PLFSCRD = 'Questo plugin aggiunge a TinyMCE la modalità di editing fullscreen .';
protected $AX_ED_PLPRINTL = 'Print Plugin';
protected $AX_ED_PLPRINTD = 'Questo plugin aggiunge a TinyMCE un bottone per la stampa.';
protected $AX_ED_PLDIRL = 'Directionality Plugin';
protected $AX_ED_PLDIRD = 'Questo plugin aggiunge a a TinyMCE directionality icons che permette a TinyMCE di gestire meglio idiomi scritti da destra verso sinistra.';
protected $AX_ED_PLFONTSL = 'Font Selection List';
protected $AX_ED_PLFONTSD = 'Questo plugin aggiunge la selezione dei caratteri da una drop-down list.';
protected $AX_ED_PLFONTSZL = 'Font Size List';
protected $AX_ED_PLFONTSZD = 'Questo plugin aggiunge una drop-down list per la selezione delle dimensioni dei caratteri.';
protected $AX_ED_PLFORMLSL = 'Format List';
protected $AX_ED_PLFORMLSD = 'Questo plugin aggiunge una drop-down list per la selezione del formato e.s. H1, H2, etc.';
protected $AX_ED_PLSSLL = 'Style Select List';
protected $AX_ED_PLSSLD = 'Questo plugin aggiunge la selezione degli stili basandosi sul template corrente o da un file CSS da te selezionato.';
protected $AX_ED_NAMED = 'Named';
protected $AX_ED_NUMERIC = 'Numerico';
protected $AX_ED_RAW = 'Raw';
protected $AX_ED_LTR = 'Left to Right';
protected $AX_ED_RTL = 'Right to Left';
protected $AX_ED_LENGTH = 'Lunghezza';
protected $AX_ED_ABSSIZE = 'Absolute-Size';
protected $AX_ED_BRELEMENTS = 'BR Elements';
protected $AX_ED_PELEMENTS = 'P Elements';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Calcolatrice';
protected $AX_TCAL_D = 'Una Calcolatrice scientifica in javascript';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Svuota File Temporanei';
protected $AX_TEMTEMP_D = 'Svuota la Cartella (/tmpr) di Elxis.';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Fix Linguaggi';
protected $AX_TFIXLANG_D = 'Effettua un verifica nelle taballe del database multilinguggio ed applica i fix dove necessari.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizer';
protected $AX_TORGANIZ_D = 'L\'organizer di Elxis mantiene i tuoi contatti, note, bookmarks e appuntamenti.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Pulitura Cache';
protected $AX_TCLEANCACHE_D = 'Pulisce la cartella cache dai contenuti, elementi ed immagini';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Change mode';
protected $AX_TCHMOD_D = 'Cambia la modalità per file e cartelle';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Fix Sequenze Postgres';
protected $AX_TFPGSEQ_D = 'Corregge le sequenze Postgres se necessario.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Registra Elxis';
protected $AX_TELXREG_D = 'Registra la tua installazione di Elxis presso GO UP Inc';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Crea un collegamento al Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Nuova linea';
protected $AX_SAME_LINE = 'Stessa Linea';
protected $AX_INDICATOR = 'Indicatore';
protected $AX_INDICATOR_D = 'Mostra l\'indicatore della lingua';
protected $AX_FLAG = 'Flag';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Visualizza la selezione della lingua come dropdown list, links list, or serie di bandiere nella Pagina Principale .';
protected $AX_FLAGS = 'Bandiere';
protected $AX_SMARTSW = 'Smart Switch';
protected $AX_SMARTSW_D = 'Permette di cambiare la lingua restando,in alcune condizioni, nella stessa pagina ';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Visualizza randomicamente profili utente';
protected $AX_DISPSTYLE = 'Stile Visualizzazione';
protected $AX_COMPACT = 'Compatta';
protected $AX_EXTENDED = 'Estesa';
protected $AX_GENDER = 'Sesso';
protected $AX_GENDERDESC = 'Mostra il sesso dell\'utente?';
protected $AX_AGE = 'Età';
protected $AX_AGEDESC = 'Mostra l\'età dell\'utente?';
protected $AX_REALUNAME = 'Mostra il Nome Reale o il Nome Utente ?';
//weblinks item
protected $AX_WBLI_TL = 'Target';
//content
protected $AX_RTFICL = 'Icona RTF ';
protected $AX_RTFICD = 'Mostra/Nascondi il bottone RTF - Ha effetto solo su questa pagina.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filtro Gruppi';
protected $AX_MODWHO_FILGRD = 'Se Si gli utenti con livello di accesso basso (i.e. visitatori) non saranno in grado di vedere lo stato di login di utenti con un livello di accesso più alto.';
//search bots
protected $AX_SEARCH_LIMIT = 'Limiti ricerca';
protected $AX_MAXNUM_SRES = 'Numero massimo risultati di ricerca.';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Mostra un sommario delle ultime aggiunte. Ideale per la pagina principale.'; 
protected $AX_SECTIONS = 'Sezioni';
protected $AX_SECTIONSD = 'IDs Sezione Separate dalla virgola (,)';
protected $AX_CATEGORIES = 'Categorie';
protected $AX_CATEGORIESD = 'IDs Categorie separate dalla virgola (,)';
protected $AX_NUMDAYS = 'Numeri di giorni';
protected $AX_NUMDAYSD = 'Mostra elementi creati negli ultimei X Giorni (Valore di default 900)';
protected $AX_SHOWTHUMBS = 'Mostra Miniature';
protected $AX_SHOWTHUMBSD = 'Mostra/nascondi le immagini nel testo';
protected $AX_THUMBWIDTHD = 'Larghezza della miniatura dell\'immagine in pixels';
protected $AX_THUMBHEIGHTD = 'Altezza della miniatura dell\'immagine in Pixels';
protected $AX_KEEPRATIO = 'Mantieni il ratio';
protected $AX_KEEPRATIOD = 'Preserva l\'aspetto dell\'immagine. Se Si, i parametri di altezza qui sopra non avranno importanza.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog oggetto';
protected $AX_EBLOGITEMD = 'Crea un collegamento ad un eblog pubblicato';

protected $AX_COMMENTARY = 'Commento';
protected $AX_COMMENTARYD = 'Selezioni chi è ammesso di commentare questo articolo.';
protected $AX_NOONE = 'Nessuno';
protected $AX_REGUSERS = 'Utenti registrati';
protected $AX_ALL = 'Tutti';
protected $AX_COMMENTS = 'Osservazioni';
protected $AX_COMMENTSD = 'Mostri il numero delle osservazioni?';

}

?>