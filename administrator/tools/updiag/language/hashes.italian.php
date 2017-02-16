<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Duilio Lupini (Speck)
* @link: http://www.elxisitalia.com
* @email: info@elxisitalia.com
* @description: Italian  language for Updiag tool (hashes help)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

?>

<p align="justify">Un "hash" è una unica impronta di archivio di un file. Questa impronta cambia se il file è stato modificato 
per l'aggiunta di uno spazio. In questo modo noi possiamo determinare se, dopo un'aggiornamento/patch, i files che compongono una 
installazione di Elxis sono intatti o mancanti aggiornando così alcuni files. Hashes ci aiuterà anche a ripristinare un sito Elxis 
dopo un attacco hacker o per qualsiasi cosa che ha un effetto negativo nel nostro file system di Elxis. In Elxis viene utilizzato 
uno speciale modo di calcolo "MD5 hashes". Per ogni file di Elxis ci sono due differenti hashes. Se il controllo del primo file hash 
non va a buon termine, sarà controllato anche il secondo e se anche questo controllo ha esito negativo, per Elxis questo file è stato modificato.</p>

<p align="justify">Per ciascuna versione di Elxis ci sono tre files hash differenti: <b>normale</b> (ideale per il funzionamento del 
sito), <b>extended</b> (ideale per siti regolari dopo una installazione pulita di Elxis, <b>completa</b> (utile solo per scopi 
speciali). <u>Voi dovreste utilizzare il file hash "normale" per siti online funzionali.</u> <b>Elxis Team di Elxis.org</b> è 
l'unico ente autorizzato a produrre questi file hash. Non utilizzate questi files da fonti non autorizzate alla produzione di 
questa tipologia di file. I files hash non vanno modificati e rinominati. Potete scaricare i files hash per la vostra versione di 
Elxis dal sito <a href="http://www.elxis.org" target="blank">elxis.org</a> website.</p>

<p align="justify">Per installare un file hash dovete giustamente caricarlo nella cartella /administrator/tool/updiag/data/hashes. 
Potete eseguire il controllo dell'integrità del file system in qualsiasi momento, contro ogni file hash installato corrispondente 
alla vostra versione di Elxis cliccando sul tasto "Esegui".</p>
