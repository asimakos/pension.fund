<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Duilio Lupini (speck)
* @link: http://www.elxisitalia.com
* @email: info@elxisitalia.com
* @description: Italian language for Chmod tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Accesso Limitato.' );


define('_CMOD_CHMOD', 'Cambia Mode');
define('_CMOD_PATH', 'Path');
define('_CMOD_MSGSERVER', 'Messaggio dal server');
define('_CMOD_PATHNOTEXIST', 'La path non esiste!');
define('_CMOD_PATHNOTELXIS', 'La path data non appartiene a Elxis!'); 
define('_CMOD_NOTALLOWED1', 'Non hai l\'autorizzazione per cambiare il Mode a');
define('_CMOD_NOTALLOWED2FI', 'al file.<br>Potrebbero insorgere problemi accedendo al file.');
define('_CMOD_NOTALLOWED2FO', 'alla cartella.<br>Potrebbero insorgere problemi accedendo al cartella.');
define('_CMOD_CHMODSUCC', 'Mode cambiato con successo a');
define('_CMOD_CHMODCNOT', 'Non puoi cambiare il Mode a');
define('_CMOD_ONLYUNIX', 'Disponibile solo per UNIX');
define('_CMOD_LOAD', 'Carica');
define('_CMOD_CHMODTO', 'Chmod a');
define('_CMOD_OWNER', 'Proprietario');
define('_CMOD_READ', 'Leggi');
define('_CMOD_WRITE', 'Scrivi');
define('_CMOD_EXECUTE', 'Esegui');
define('_CMOD_USER', 'Utente');
define('_CMOD_GROUP', 'Gruppo');
define('_CMOD_WORLD', 'mondo');
define('_CMOD_SHOWHELP', 'Mostra Help');
define('_CMOD_HIDEHELP', 'Nascondi Help');
define('_CMOD_HELPTEXT', 'Scrivi la path completa a un file esistente o a una cartella di Elxis. 
	Premi Carica se vuoi vedere i permessi esistenti e il proprietario della path inserita. 
	Cambia Mode alla path inserita premendo il bottone CHMOD. Caratteristica disponibile solo per sistemi UNIX.
	<br /><br />Raccomandiamo di utilizzare i seguenti permessi:<br />
	cartelle scrivibili: 0777, cartelle non scrivibili: 0755, files scrivibili: 0666, files non scrivibili: 0644');

?>