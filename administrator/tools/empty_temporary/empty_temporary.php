<?php 
/**
* @ Version: $Id: empty_temporary.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Ioannis Sannos
* @ E-mail: datahell@elxis.org
* @ URL: http://www.elxis.org
* @ Description: Tool EmptyTemporary empties Elxis temporary folder (/tmpr)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $fmanager, $mosConfig_absolute_path, $mosConfig_ftp, $alang;

$emptempbase = $mosConfig_absolute_path.'/administrator/tools/empty_temporary/';

if (file_exists( $emptempbase.'language'.SEP.$alang.'.php')) {
    include_once( $emptempbase.'language'.SEP.$alang.'.php' );
} else {
    include_once( $emptempbase.'language'.SEP.'english.php' );
}

$tmpdir = $fmanager->PathName( $mosConfig_absolute_path.'/tmpr' );
$canwrite = is_writable( $tmpdir );
$finalmsg = '';

//is /tmpr writable or ftp enabled?
if ( $canwrite | $mosConfig_ftp == '1') {

    $errors = array();
    $dirsindir = $fmanager->listFolders( $tmpdir, '', false, true );
    $numdirs = count($dirsindir);

    if ( $numdirs >0 ) {
        foreach ( $dirsindir as $ddir ) {
            if (!$fmanager->deleteFolder( $ddir )) {
                array_push( $errors, $fmanager->last_error() );
            }
        }
    }

    $filesindir = $fmanager->listFiles( $tmpdir, '', false, true );
    $numfiles = count($filesindir)-1;

    if ( $numfiles >0 ) {
        if (!$fmanager->deleteFile( $filesindir )) {
            array_push( $errors, $fmanager->last_error() );
        }

        if (!file_exists( $tmpdir.SEP.'index.html' )) {
            $data = '<html><body></body></html>';
            if (!$fmanager->createFile( $tmpdir.SEP.'index.html', $data )) {
                array_push( $errors, $fmanager->last_error() );
            }
        }
    }

    if ( $numdirs >0 ) {
        $finalmsg .= _TEMPTEMP_FOUND.' '.$numdirs.' ' ._TEMPTEMP_DIRS;
        if ( $numfiles >0 ) {
            $finalmsg .= ' '._TEMPTEMP_AND.$numfiles.' '._TEMPTEMP_FILES;
        }
    } else if ($numfiles >0) {
        $finalmsg .= _TEMPTEMP_FOUND.' '.$numfiles.' '._TEMPTEMP_FILES;
    } else {
        $finalmsg .= _TEMPTEMP_NFOUND;
    }
    $finalmsg .= ' '._TEMPTEMP_FORDEL.'<br /><br />';
    
    if ( count($errors) > 0 && trim($errors[0]) != '') {
        $finalmsg .= '<strong>'._TEMPTEMP_AWERRORS.'</strong><br /><br />'._TEMPTEMP_ERRORLST.':<br />';
        foreach ($errors as $error) {
            $finalmsg .= '&nbsp; &nbsp; &nbsp; &raquo; '.$error.'<br />';
        }
    } else {
        $finalmsg .= '<strong>'._TEMPTEMP_ACOMPSUCC.'</strong>';
    }
} else {
    $finalmsg .= '<strong>'._TEMPTEMP_CRITERR.'</strong><br /><br />';
    $finalmsg .= _TEMPTEMP_ERRDESC;
}
?>

<table class="adminlist">
	<tr>
		<th class="title"><?php echo _TEMPTEMP_REPORT; ?></th>
	</tr>
	<tr>
		<td>
			<?php echo $finalmsg; ?>
		</td>
	</tr>
</table>
