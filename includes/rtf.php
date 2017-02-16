<?php
/**
* @version: $Id: rtf.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: RTF
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Creates utf-8 encoded RTF files on the fly using phprtf class
* Should be considered as Beta Version!
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $database, $lang, $mosConfig_absolute_path, $mosConfig_sitename, $mosConfig_hideCreateDate;
global $mosConfig_hideModifyDate, $mosConfig_hideAuthor, $mosConfig_live_site, $_VERSION, $my;


/******************************/
/* REPLACE NOT SUPPORTED TAGS */
/******************************/
function rtfReplacer($text) {
    $regex = "#{mosflv\s*.*?}(.*?){/mosflv}#s";
	$text = str_replace( '{mosimage}', '', $text );
	$text = str_replace( '{mospagebreak}', '', $text );
    $text = preg_replace( $regex, '', $text );
	$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
	$text = preg_replace( "'<form[^>]*>.*?</form>'si", '', $text );
	$text = preg_replace( "'<object[^>]*>.*?</object>'si", '', $text );
	$text = preg_replace('#<img.*?>#si', '', $text );
	$text = preg_replace( "'<embed[^>]*>.*?</embed>'si", '', $text );
	$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
	$text = preg_replace( '/<!--.+?-->/', '', $text );
	$text = preg_replace( '/{.+?}/', '', $text );
	$text = preg_replace( '/&nbsp;/', ' ', $text );
	$text = preg_replace( '/&amp;/', '&', $text );
	$text = preg_replace( '/&quot;/', '\"', $text );

	$tags = array('table', 'tbody', 'tr', 'font');
	$text = stripSelectedTags($text, $tags);
    $text = replaceSomeTags($text);
    return $text;
}


function replaceSomeTags($text) {
    $text = preg_replace('/<h1.*?>/', '<br /><b>', $text );
    $text = preg_replace('/<\/h1>/', '</b><br />', $text );
    $text = preg_replace('/<h2.*?>/', '<br /><b>', $text );
    $text = preg_replace('/<\/h2>/', '</b><br />', $text );
    $text = preg_replace('/<h3.*?>/', '<br /><b>', $text );
    $text = preg_replace('/<\/h3>/', '</b><br />', $text );
    $text = preg_replace('/<h4.*?>/', '<br /><b>', $text );
    $text = preg_replace('/<\/h4>/', '</b><br />', $text );
    $text = preg_replace('/<sup>/', '', $text );
    $text = preg_replace('/<\/sup/', '', $text );
    $text = preg_replace('/<sub>/', '', $text );
    $text = preg_replace('/<\/sub/', '', $text );
	$text = preg_replace('/<hr>/', '_____________________________________________________<br />', $text );
	$text = preg_replace('/<hr \/>/', '_____________________________________________________<br />', $text );
    $text = preg_replace('/<strike.*?>/', '', $text );
    $text = preg_replace('/<\/strike>/', '', $text );
    $text = preg_replace('/<td.*?>/', '<p>', $text );
    $text = preg_replace('/<\/td>/', '</p>', $text );
    $text = preg_replace('/<span.*?>/', '', $text );
    $text = preg_replace('/<\/span>/', '', $text );
	$text = preg_replace('/<div.*?>/', '<p>', $text );
	$text = preg_replace('/<\/div>/', '</p>', $text );
    $text = preg_replace('/<p.*?>/', '<p>', $text );
    $text = preg_replace('/<ul.*?>/', '<br />', $text );
    $text = preg_replace('/<\/ul>/', '<br />', $text );
    $text = preg_replace('/<ol.*?>/', '<br />', $text );
    $text = preg_replace('/<\/ol>/', '<br />', $text );
    $text = preg_replace('/<li.*?>/', '- ', $text );
    $text = preg_replace('/<\/li>/', '<br />', $text );
    $text = preg_replace('/<address.*?>/', '<em>', $text );
    $text = preg_replace('/<\/address>/', '</em>', $text );
    $text = str_replace('<p></p>', '<br />', $text);
	return $text;
}


/***********************/
/* STRIP SELECTED TAGS */
/***********************/
function stripSelectedTags($text, $tags = array()) {
    $args = func_get_args();
    $text = array_shift($args);
    $tags = func_num_args() > 2 ? array_diff($args,array($text))  : (array)$tags;
    foreach ($tags as $tag){
        if(preg_match_all('/<'.$tag.'[^>]*>(.*)<\/'.$tag.'>/iU', $text, $found)){
            $text = str_replace($found[0],$found[1],$text);
        }
    }
    return $text;
}


$id = intval( mosGetParam( $_REQUEST, 'id', 1 ) );
$now = date('Y-m-d H:i:s');

$query = "SELECT c.id, c.title, c.seotitle, c.introtext, c.maintext, c.created_by, c.modified, c.images, c.metakey, u.name AS author"
."\n FROM #__content c"
."\n LEFT JOIN #__users u ON u.id= c.created_by"
."\n WHERE c.id='$id' AND c.state='1' AND c.access IN (".$my->allowed.")"
."\n AND ( c.publish_up = '1979-12-19 00:00:00' OR c.publish_up <= '$now' )"
."\n AND ( c.publish_down = '2060-01-01 00:00:00' OR c.publish_down >= '$now' )";
$database->setQuery($query, '#__', 1, 0);
$database->loadObject($row);

if (!$row) {
	echo 'Document not found or you are not allowed to access it!';
	exit(404);
}

$article = $row->introtext.$row->maintext;

preg_match_all('#<img\s(.*)>#iU', $article, $images, PREG_SET_ORDER);

$text = rtfReplacer($article);

$parts = preg_split('/<p>/', $text, -1, PREG_SPLIT_NO_EMPTY);

require_once($mosConfig_absolute_path.'/includes/rtf/Rtf.php');

$rtf = new Rtf();
$verdana9 = new Font(9, 'Verdana', '#333333');
$tahoma10 = new Font(10, 'Tahoma', '#666666');
$times11 = new Font(11, 'Times new Roman');
$tahoma12 = new Font(12, 'Tahoma', '#000099');
$arial14 = new Font(14, 'Arial', '#000099');

$parFormat = new ParFormat();

$rtf->setInfo('title', $row->title);
$rtf->setInfo('subject', $row->title);
$rtf->setInfo('author', $row->author);
$rtf->setInfo('company', $mosConfig_sitename);
$rtf->setInfo('keywords', $row->metakey);
$rtf->setInfo('title', $row->title);

//headers
//$rtf->setOddEvenDifferent();
$null=null;
$header = &$rtf->addHeader();
//$header->addImage($mosConfig_absolute_path.'/images/logo.png', $parFormat, '0.1', '0.1');
$header->addImage($mosConfig_absolute_path.'/images/logo-print.png', $null);
$header->emptyParagraph($tahoma10, $parFormat);
$header->writeText($row->title, $arial14, $parFormat);
$header->writeText(_WRITTEN_BY.' '.$row->author, $tahoma10, $parFormat);
$header->writeText(_LAST_UPDATED.': '.mosFormatDate($row->modified), $tahoma10, $parFormat);
$header->writeText($mosConfig_sitename.' ('.$mosConfig_live_site.')', $tahoma10, $parFormat);
$header->emptyParagraph($tahoma10, $parFormat);

$sect = &$rtf->addSection();
$sect->setColumnsCount(1);
foreach ($parts as $part) {
    $part = str_replace('</p>', '', $part);
    $sect->writeText($part, $verdana9, $parFormat);
    $sect->setBorders(new BorderFormat(0));
    $sect->emptyParagraph($times11, $parFormat);
}

//mambot images
$botimages = array();
if (trim($row->images) != '') {
	$bimages = explode( "\n", trim($row->images));
	for ( $i = 0; $i < count($bimages); $i++ ) {
	   $img = trim( $bimages[$i] );
        if ($img) {
            $attrib = explode('|', trim( $img ));
            if ($attrib[0] != '') {
                $botimages[] = $mosConfig_absolute_path.'/images/stories/'.$attrib[0];
            }
        }
    }
}

if (count($images) || count($botimages)) {
	$sect = &$rtf->addSection();
	$sect->setBorders(new BorderFormat(0));
	$sect->emptyParagraph($tahoma12, $parFormat);
	$sect->writeText('<b>'._E_IMAGES.':</b><br />', $tahoma12, $parFormat);

	if (count($images)) {
        foreach ($images as $image) {
            preg_match('/src\=\".*?\"/', $image[0], $m);
            if ($m && $m != '') {
			    $img = str_replace('src="', '', $m[0]);
			    $img = str_replace('"', '', $img);
                $img = str_replace($mosConfig_live_site, $mosConfig_absolute_path, $img);
			    if (!preg_match('/http\:\/\//', $img)) {
				    $sect->addImage($img, $parFormat);
				    $sect->writeText('<br />', $verdana9, $parFormat);
                }
		    }
        }
    }
    if (count($botimages)) {
        foreach ($botimages as $img) {
			$sect->addImage($img, $parFormat);
			$sect->writeText('<br />', $verdana9, $parFormat);
		}
    }
}

if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die(); }
if (!preg_match('/eLXiS/i', $_VERSION->COPYRIGHT)) { die(); }

//$rtf->setOddEvenDifferent();
$foot = &$rtf->addFooter();
$ver = 'Powered by '.$_VERSION->PRODUCT.' '.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' ('.$_VERSION->CODENAME.'). '.$_VERSION->COPYRIGHT;
$foot->writeText($ver, new Font(8, 'Verdana'), $parFormat);

$rtf->prepare();

$doctitle = ($row->seotitle != '') ? $row->seotitle : 'elxis-rtf-document';
$rtf->sendRtf($doctitle);

?>
