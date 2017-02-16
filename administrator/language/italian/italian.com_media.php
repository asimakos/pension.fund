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
* @description: Italian language for component media
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = 'Path relativa ';
public $A_CMP_ME_PMOUSEVD = 'Muovi il mouse sopra l\'icona di un file per visualizzarne i dettagli';
public $A_CMP_ME_RENAME = 'Rinomina';
public $A_CMP_ME_COPYTO = 'Copia in';
public $A_CMP_ME_NEWFOL = 'Nuova Cartella';
public $A_CMP_ME_NEWFIL = 'Nuovo File';
public $A_CMP_ME_OPEN = 'Apri';
public $A_CMP_ME_VTHUMBS = 'Vedi Thumbnails';
public $A_CMP_ME_VICONS = 'Vedi icona';
public $A_CMP_ME_DBCLOP = 'Doppio click per aprire:';
public $A_CMP_ME_DIRNEX = 'Directory <strong>%s</strong> non esiste!';
public $A_CMP_ME_FILNEX = 'File <strong>%s</strong> non esiste!';
public $A_CMP_ME_PERMS = 'Permessi';
public $A_CMP_ME_MODIF = 'Modificato';
public $A_CMP_ME_ACCESSED = 'Accesso';
public $A_CMP_ME_DOWNZIP = 'Download come zip';
public $A_CMP_ME_DODOWN = 'Vuoi scaricare la cartella?';
public $A_CMP_ME_ASZIP = 'come zip?';
public $A_CMP_ME_EXTHERE = 'Estrai qui';
public $A_CMP_ME_SELFNIMG = 'Il file selezionato non è un immagine!';
public $A_CMP_ME_FSELFCL = 'First select a file by clicking on it';
public $A_CMP_ME_RENEWFN = 'Rinomina - scrivi un nuovo nome per il file:';
public $A_CMP_ME_EXFINAME = 'Esiste già un altro file con lo stesso nome %s !';
public $A_CMP_ME_EXFONAME = 'Esiste già una cartella con lo stesso nome %s !';
public $A_CMP_ME_FIRENTO = 'File <strong>"%s"</strong> è stato rinominato in <strong>"%s"</strong>';
public $A_CMP_ME_FORENTO = 'La cartella <strong>"%s"</strong> è stata rinominata in  <strong>"%s"</strong>';
public $A_CMP_ME_RENFAIL = 'Rename failed!';
public $A_CMP_ME_ALLFIFODEL = 'Tutti i file/cartelle in questa cartella saranno cancellate!';
public $A_CMP_ME_DELQUEST = 'Cancello "%s"?';
public $A_CMP_ME_FIDELSUC = 'File cancellato con successo';
public $A_CMP_ME_FODELSUC = 'Cartella cancellata con successo';
public $A_CMP_ME_DELFAIL = 'Cancellazione fallita!';
public $A_CMP_ME_COPYTOFO = 'Copia nella cartella:';
public $A_CMP_ME_SRCNEX = 'File sorgente non esiste!';
public $A_CMP_ME_SRCISDIR = 'LA SORGENTE È UNA CARTELLA! NON POTETE COPIARE LE CARTELLE.';
public $A_CMP_ME_EXFIINDIR = 'C\'è già un file con nome <strong>%s</strong> nella cartella %s';
public $A_CMP_ME_FICOPYSUC = 'File <strong>%s</strong> copiato con successo nella cartella %s';
public $A_CMP_ME_FICOPYSUC2 = 'File <strong>%s</strong> copiato con seccesso nella cartella %s come <strong>%s</strong>';
public $A_CMP_ME_FICOPYFAIL = 'Non posso copiare <strong>%s</strong> nella cartella %s';
public $A_CMP_ME_NEWFONAME = 'Inserisci un nuovo nome per la cartella:';
public $A_CMP_ME_CHPERMS = 'Cambia permessi';
public $A_CMP_ME_SIZE = 'Size';
public $A_CMP_ME_DIMS = 'Dimensioni';
public $A_CMP_ME_NAMENEWFO = 'Devi dare un nome alla nuova cartella!';
public $A_CMP_ME_FOCRESUC = 'Cartella  <strong>%s</strong> creata con successo';
public $A_CMP_ME_CNCRNEWFO = 'Impossibile creare una cartella!';
public $A_CMP_ME_INVPERMS = 'Permessi errati!';
public $A_CMP_ME_PERMCHSUC = 'Chmod del file cambiati con successo <strong>%s</strong>';
public $A_CMP_ME_CHMODFAIL = 'Cambio mode fallito!';
public $A_CMP_ME_SELFIUP = 'Seleziona il file video da caricare';
public $A_CMP_ME_SELFNFLV = 'Il file video non è un file flash(flv)!';
public $A_CMP_ME_PLAY = 'Play';
public $A_CMP_ME_SELFNMP3 = 'File selezionato non è mp3!';
public $A_CMP_ME_EXTRZIP = 'Estrai Zip';
public $A_CMP_ME_EXTRCUFO = 'Estrarre tutti i file  %s nella cartella corrente?';
public $A_CMP_ME_FINOZIP = 'File <strong>%s</strong> non è un file zip!';
public $A_CMP_ME_UNERREXT = 'Errore inaspettato durante estrazione!';
public $A_CMP_ME_FIEXTRD = 'i files sono stati estratti.';
public $A_CMP_ME_REFVIEW = 'Refresh to view them';
public $A_CMP_ME_DOWNLOAD = 'Download';
public $A_CMP_ME_TODOWNCL = 'per scaricare questo file clicca sul nome del file posto sotto la sua icona.';
public $A_CMP_ME_RESIZE = 'Ridimensiomna';
public $A_CMP_ME_FINORES = 'Il file selezionato non è ridimensionabile!';
public $A_CMP_ME_RESTO = 'Ridimensiona in';
public $A_CMP_ME_KEEPRAT = 'Mantieni proporzioni';
public $A_CMP_ME_BASEWID = 'Basato sulla larghezza della immagine';
public $A_CMP_ME_INVWNIMG = 'Larghezza invalida per la nuova immagine!';
public $A_CMP_ME_INVHNIMG = 'Altezza invalida per la nuova immagine!';
public $A_CMP_ME_IMGRESSUC = 'Immagine ridimensionato con successo!';
public $A_CMP_ME_CNOTRESIMG = 'Non è possibile ridimensionare immagine!';
public $A_CMP_ME_IE6UPGRADE = '<strong>Stai usando Internet Explorer 6!</strong> Per favore fai l\'aggiornamento a IE7 oppure usa <a href="http://www.mozilla.com" target="_blank">Firefox</a>.'; 
public $A_CMP_ME_USEFIREFOX = 'Per una migliore performance usa <a href="http://www.mozilla.com" target="_blank">Firefox</a>.';
public $A_CMP_ME_WATERMARK = 'Filigrana';
public $A_CMP_ME_CNOTWATERF = 'Non puoi posizionare la filigrana su questo file!';
public $A_CMP_ME_TEXT = 'Testo';
public $A_CMP_ME_FONT = 'Carattere';
public $A_CMP_ME_OPACITY = 'Opacittà';
public $A_CMP_ME_WATERPOS = 'Posizione Filigrana';
public $A_CMP_ME_XAXIS = 'Asse X';
public $A_CMP_ME_YAXIS = 'Asse Y';
public $A_CMP_ME_COLOR = 'Colore';
public $A_CMP_ME_IMGQUAL = 'Qualità immagine';
public $A_CMP_ME_SAVEAS = 'Salva in...';
public $A_CMP_ME_BLACK = 'Nero';
public $A_CMP_ME_WHITE = 'Bianco';
public $A_CMP_ME_RED = 'Rosso';
public $A_CMP_ME_BLUE = 'Blue';
public $A_CMP_ME_ORANGE = 'Arancione';
public $A_CMP_ME_YELLOW = 'Giallo';
public $A_CMP_ME_GREEN = 'Verde';
public $A_CMP_ME_GRAY = 'Grigio';
public $A_CMP_ME_LGRAY = 'Grigio Chiaro';
public $A_CMP_ME_SHADOW = 'Ombra';
public $A_CMP_ME_NOSHADOW = 'Non ombreggiato';
public $A_CMP_ME_NEWFDIFOLD = 'Il nuovo nome file ha una estensione differente dall\'originale!';
public $A_CMP_ME_OVERIMGNEX = 'La sovrapposizione immagine non esiste!';
public $A_CMP_ME_WATERGENSUC = 'immagine Filigrana generata con successo.<br />Chiudi questa finstra e aggiorna (refresh F5) media manager per vedere la nuova immagine.';
public $A_CMP_ME_CNOTGENWAT = '<strong>Non posso generare l\'Immagine Filigrana!</strong><br />Questa caratteristica richiede le librerie PHP \'GD\' e \'FreeType PHP\'.';
public $A_CMP_ME_MEMANG = 'Gestione Media';
public $A_CMP_ME_UPLOAD = 'Carica';
public $A_CMP_ME_VALFTYPES = 'tIPO FILE VALIDO';
public $A_CMP_ME_VIDEO = 'Video';
public $A_CMP_ME_AUDIO = 'Audio';
public $A_CMP_ME_OTHER = 'Altro';

}

?>
