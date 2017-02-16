<?php
/**
* @ Version: $Id: pdf.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: PDF
* @ Author: Ioannis Sannos
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: Creates utf-8 encoded PDF files on the fly using tcpdf
* @ Added changes to compatibility with RTL languages by Farhad Sakhaei (farhad0@gmail.com)
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*
validate item, check acccess and publish status before creating PDF
For security reasons if validation fails we do not return the reason why the PDF did not created
*/
function validatePDF ( &$row ) {
	global $my, $mosConfig_offset;

	if ((trim($row->title) == '') || (trim($row->introtext) == '') || (intval($row->created_by) == 0)) {
		return _NOT_AUTH; //Item does not exist
	}
	$allarr = explode(',', $my->allowed);
	if (!in_array($row->access, $allarr)) {
		return _HIGHER_ACCESS;
	}
	if (intval($row->state) != 1) {
		return _NOT_AUTH; //Item is unpublished
	}
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
	if ($row->publish_up > $now) {
		return _NOT_AUTH; //Item is not yet published
	}
	if ($row->publish_down < $now) {
		return _NOT_AUTH; //Item has expired
	}
	return 'OK';
}

/*
* Counts tables in given html string and max number of columns for each table 
* and outputs the results as an array
*/
function tableProccessor($html) {
    $tbl = 0;
    $td = 0;
    $iRow = array();
    $out = array();

	$html=strip_tags($html,"<td><th><tr><table>"); //remove all non-table related tags
	$pattern = '/(<[^>]+>)/Uu';
	$a = preg_split($pattern, $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY); //explodes the string

	foreach($a as $key=>$element) {
		if (preg_match($pattern, $element)) {
            $element = substr($element, 1, -1);
			if($element{0} !='/' ) { //tag open
				$a2 = explode(' ',$element);
				$tag = strtolower(array_shift($a2));
                switch ($tag ) {
                    case 'table':
                    $tbl++;
                    break;
                    case 'td':
                    case 'th':
                    $td++;
                    break;
                    default:
                    break;
			    }
			} else { //tag close
                $tag = strtolower(substr($element, 1));
                switch ($tag ) {
                    case 'table':
                        array_push($out, max($iRow));
                        unset($iRow);
                        $iRow = array();
                    break;
                    case 'tr':
                        array_push($iRow, $td);
                        $td = 0;
                    break;
                    default:
                    break;
			    }
			}
		}
	}
	return $out;
}

/**
* Strips outs selected tags or array of tags from an html string
* Example: strip_selected_tags('Today is <b>Suturday:</b> <p align="center">What a nice <b>day</b></p>!', 'p');
* Will output: Today is <b>Suturday:</b> What a nice <b>day</b>!
*
* Not in use but we may use it in the future
*/
function strip_selected_tags($text, $tags = array()) {
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

/*
* Remove paragraphs and line breaks inside table cells
* Ioannis Sannos note:
* HTML tags inside table cells produce error output by creating new cells
* Other html entities are also a problem inside cells.
* If we used writeHTMLCell just for the content of TDs we could make it appear much better -> Future TO DO
*/
function cellCleaner($html) {
    $out = '';
    $celltags = array('td','th');
    $striptags = array('p','br','a','strong','b','img');
    $tdopen = false;

    $pattern = '/(<[^>]+>)/Uu';
	$a = preg_split($pattern, $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    foreach($a as $key=>$element) {
        if (preg_match($pattern, $element)) { //tag
            $element = substr($element, 1, -1);
            if($element{0}=='/') { //close tag
                $tag = strtolower(substr($element, 1));
                if(in_array($tag, $celltags)) {
                    $tdopen = false;
                }
    			if(!in_array($tag, $striptags)) {
    			    $out .= '<'.$element.'>'; //contains '/'
    			}
    		} else { //open tag
    			$a2 = explode(' ',$element);
    			$tag = strtolower(array_shift($a2));
    			
    			if ($tdopen) {
    			    if(!in_array($tag, $striptags)) {
    			        $out .= '<'.$element.'>';
    			    }
    			} else {
                    if (in_array($tag, $celltags)) {
    			        $tdopen = true;
    			    }
    			    $out .= '<'.$element.'>';
    			}
    		}
    	} else { //text
    	    $out .= $element;
    	}
    }
    return $out;
}

function elxisPDF ( $database ) {
	global $lang, $mosConfig_absolute_path, $mosConfig_sitename, $mosConfig_hideCreateDate;
    global $mosConfig_hideModifyDate, $mosConfig_hideAuthor;
	
	$id = intval( mosGetParam( $_REQUEST, 'id', 1 ) );

	$row = new mosContent( $database );
	$row->load( $id );
	
	$vPDF = validatePDF($row);
	if ($vPDF != 'OK') {
		die ($vPDF);
	}
	
	//Find Author Name
	$users_rows = new mosUser( $database );
	$users_rows->load( $row->created_by );
	$row->author = $users_rows->name;

    $regex = "#{mosflv\s*.*?}(.*?){/mosflv}#s";
	$row->introtext = str_replace( '{mosimage}', '', $row->introtext );
	$row->introtext = str_replace( '{mospagebreak}', '', $row->introtext );
    $row->introtext = preg_replace( $regex, '', $row->introtext );
	$row->maintext 	= str_replace( '{mosimage}', '', $row->maintext );
	$row->maintext 	= str_replace( '{mospagebreak}', '', $row->maintext );
    $row->maintext = preg_replace( $regex, '', $row->maintext );

	$htmlcontent = cellCleaner($row->introtext).cellCleaner($row->maintext);
	
	$tcpath = $mosConfig_absolute_path.SEP."includes".SEP."tcpdf".SEP;
	if (file_exists($tcpath."config".SEP."lang".SEP.$lang.".php")) {
		require_once($tcpath."config".SEP."lang".SEP.$lang.".php");
	} else {
	  	require_once($tcpath."config".SEP."lang".SEP."english.php");
	}
	require_once($tcpath."tcpdf.php");

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

    $pdf->proccessTables(tableProccessor($htmlcontent));
    
	// set document information
	$pdf->SetCreator($users_rows->name);
	$pdf->SetAuthor($users_rows->name);
	$pdf->SetTitle($row->title);
	$pdf->SetSubject($row->metadesc);
	$pdf->SetKeywords($row->metakey);

	$header_string = $mosConfig_sitename;
	$mod_date = NULL; 
	$create_date = NULL;
	
	if (file_exists('../../../images/logo.png')) {
		$header_logo = '../../../images/logo.png';
	} else {
		$header_logo = PDF_HEADER_LOGO;
	}
	$header_logo_width = '50';

	if ( $mosConfig_hideAuthor == "0" ) {
		if ( $row->author != '' ) {
			$header_string .= "\n"._WRITTEN_BY .' '.$row->author;
		} else if ($row->created_by_alias != '') {
			$header_string .= "\n"._AUTHOR_BY .' '.$row->created_by_alias;
		}
	}

	if ($mosConfig_hideCreateDate == '0') {
		if ( intval( $row->created ) <> 0 ) {
			$create_date = mosFormatDate( $row->created,_GEM_DATE_FORMLC );
			$header_string .= "\n"._E_CREATED." ".$create_date;
		}
	}
	if ( $mosConfig_hideModifyDate == '0' ) {
		if ( intval( $row->modified ) <> 0 ) {
			$mod_date = mosFormatDate( $row->modified ,_GEM_DATE_FORMLC);
			$header_string .= "\n"._E_LAST_MOD." ".$mod_date;
		}
	}

	$pdf->setHeaderData($header_logo, $header_logo_width, $row->title, $header_string);

	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	$pdf->setLanguageArray($l); //set language items
	

	//initialize document
	$pdf->AliasNbPages();
	$pdf->AddPage();

	// set font
	// Added by Farhad Sakhaei (farhad0@gmail.com) to compatibility with RTL languages
	$pdf->SetFont("dejavusans", "", 8);	
	
	// output some HTML code
	$pdf->writeHTML($htmlcontent, true, 0, true, 0);
	$pdf->Output();
}

elxisPDF( $database );

?>