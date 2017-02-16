// =======================
// Elxis Weblinks Ajax
// Copyright: (C) 2006-2008 Ioannis Sannos / DataHellas.com. All rights reserved
// Author: Ioannis Sannos
// E-mail:  blackgate@datahellas.com
// use ajax_new.js (sack version 1.6.1)
//=======================

var wajax = new sack();

function whenLoadingscr() {
	var e = document.getElementById(wajax.element); 
	e.innerHTML = "Sending Data...";
}

function whenLoadedscr() {
	var e = document.getElementById(wajax.element); 
	e.innerHTML = "Data Sent...";
}

function whenInteractivescr() {
	var e = document.getElementById(wajax.element); 
	e.innerHTML = "getting data...";
}

function whenLoadingweb(){
	var e = document.getElementById(wajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function whenLoadedweb(){
	var e = document.getElementById(wajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function whenInteractiveweb(){
	var e = document.getElementById(wajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function doit( typ ) {
	var form = document.getElementById('adminForm');

    wajax.setVar("SCR_SUBMIT", typ);
    wajax.setVar("SCR_URL", form.url.value);

	wajax.requestFile = "index3.php?option=com_weblinks&task=ajaxscr";

	wajax.method = 'POST';
	wajax.element = 'ajaxMessage';
	wajax.onLoading = whenLoadingscr;
	wajax.onLoaded = whenLoadedscr;
	wajax.onInteractive = whenInteractivescr;
	wajax.runAJAX();
}

function changeWebState(elem, id, state){
    ajelem = 'webstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    wajax.setVar("option", 'com_weblinks');
    wajax.setVar("task", 'ajaxpub');
    wajax.setVar("elem", elem);
    wajax.setVar("id", id);
    wajax.setVar("state", state);

	wajax.requestFile = "index3.php";

	wajax.method = 'POST';
	wajax.element = ajelem;
	wajax.onLoading = whenLoadingweb;
	wajax.onLoaded = whenLoadedweb;
	wajax.onInteractive = whenInteractiveweb;
	wajax.runAJAX();
}

function showLinkInfo(screenshot, name) {
    if (trim(screenshot) == '') {
        return;
    }

    var src = '../images/screenshots/'+screenshot;
    var html = name;
    var html = '<img src="'+src+'" name="imagelib" border="1" />';
	return overlib(html, CAPTION, name);
}
