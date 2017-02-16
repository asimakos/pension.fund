<?php 
/**
* @version: $Id$
* @copyright: (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Logins Recorder tool
* @author: Ioannis Sannos
* @email: datahell [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @description: Logs login attempts to Elxis administration (successful or not)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mosConfig_absolute_path;
require_once($mosConfig_absolute_path.'/administrator/tools/lrecorder/recorder.class.php');

$eRecorder = new elxisLRecorder();
$act = mosGetParam($_REQUEST, 'act', '');
switch ($act) {
    case 'del':
        $eRecorder->deleteLogs();
    break;
    case 'cstatus':
        $eRecorder->changeStatus();
        exit();
    break;
    default:
    break;
}

$eRecorder->showRecords();

?>