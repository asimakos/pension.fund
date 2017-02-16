/* eforms bot by Ioannis Sannos, http://www.isopensource.com */

function eformsCheckEmail(efel) {
	var efemail = document.getElementById(efel).value;
	if (efemail == '') { return true; } //not required field, let pass empty value
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if (efemail.search(emailPattern) == -1) { return false; }
    return true;
}

function eformsCheckDate(efel) {
	var efstr = document.getElementById(efel).value;
	if (efstr == '') { return true; } //not required field, let pass empty value
	if (efstr.search(/^\d{4}[\-]\d{1,2}[\-]\d{1,2}/g) != 0) { return false; }
    efstr = efstr.replace(/[\-]/g, "/");
    var dt = new Date(Date.parse(efstr));
    var arrDateParts = efstr.split("/");
    return (dt.getMonth() == arrDateParts[1]-1 && dt.getDate() == arrDateParts[2] && dt.getFullYear() == arrDateParts[0]);
}

function eformsCheckNumeric(efel) {
	var efstr = document.getElementById(efel).value;
	if (efstr == '') { return true; } //not required field, let pass empty value
	var strValidChars = "0123456789.-";
	var strChar;
	var blnResult = true;
	for (i = 0; i < efstr.length && blnResult == true; i++) {
		strChar = efstr.charAt(i);
		if (strValidChars.indexOf(strChar) == -1) { blnResult = false; }
	}
	return blnResult;
}

function eformsCheckUrl(efel) {
	var efstr = document.getElementById(efel).value;
	if (efstr == '') { return true; } //not required field, let pass empty value
	var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(efstr);
}

function eformsChangeColor(efel) {
	document.getElementById(efel).style.backgroundColor = '#FFFFFF';
	document.getElementById(efel).style.borderColor = '#999999';
}

function eformsFocus(efel) {
	var element = document.getElementById(efel);
	if (element == null) { return; }
	element.style.backgroundColor = '#feeded'; //FBE3D9';
	element.style.borderColor = '#f7c2c2';
	element.focus();
	setTimeout("eformsChangeColor('" + efel + "')", 1000);
}
