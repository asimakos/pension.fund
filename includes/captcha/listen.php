<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Forms protection
* @author: Ioannis Sannos (datahell@elxis.org)
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


@session_start();
if ((!isset($_SESSION['captchasnd'])) || ($_SESSION['captchasnd'] == '')) {
    exit('Something wrong detected');
}
$ses = $_SESSION['captchasnd'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Elxis Captcha Player</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
function setEmbed() {
    var element = document.getElementById('wavstitch');
    element.style.display = 'inline';
    element.innerHTML = '<embed src="wavstitch.php?ses=<?php echo $ses; ?>" autostart="1" playcount="1" loop="0" height="0" width="0" type="'+getMimeType()+'" enablejavascript="true"></embed>';
}

function getMimeType(){
	var mimeType = "application/x-mplayer2"; //default
	var agt=navigator.userAgent.toLowerCase();
	if (navigator.mimeTypes && agt.indexOf("windows")==-1) { //non-IE, no-Windows
  		var plugin=navigator.mimeTypes["audio/mpeg"].enabledPlugin;
  		if (plugin) { //Mac/Safari & Linux/FFox
		  	mimeType="audio/mpeg";
		}
	}
	return mimeType;
}
</script>
<style type="text/css">
body {
	background-color: #FFFFFF;
	color: #000000;
	margin: 4px 0 0 0;
	padding: 0;
}
a, a:active, a:visited {
    font-family: verdana, arial, helvetica, sans-serif;
    font-size: 10px;
    color: #333333;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
</style>
</head>
<body onload="javascript:setEmbed();">
<center>
    <div id="wavstitch" style="display: none"><img src="loading.gif" border="0" alt="loading" />Loading plugin...</div>
    <a href="javascript:void(0);" onclick="javascript:setEmbed();" title="Play again"><img src="speaker.gif" border="0" alt="Play again" /></a><br /><br />
    <a href="javascript:void(0);" onclick="javascript:window.close();">Close Window</a>
</center>
</body>
</html>