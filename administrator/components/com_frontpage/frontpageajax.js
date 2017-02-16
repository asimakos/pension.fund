// =======================
// Component Frontpage Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================

var fajax = new sack();

function whenLoadingfro(){
	var e = document.getElementById(fajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedfro(){
	var e = document.getElementById(fajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivefro(){
	var e = document.getElementById(fajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeFrontState(elem, id, state){
    ajelem = 'frostatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    fajax.setVar("option", 'com_frontpage');
    fajax.setVar("task", 'ajaxpub');
    fajax.setVar("elem", elem);
    fajax.setVar("id", id);
    fajax.setVar("state", state);

	fajax.requestFile = "index3.php";

	fajax.method = 'POST';
	fajax.element = ajelem;
	fajax.onLoading = whenLoadingfro;
	fajax.onLoaded = whenLoadedfro;
	fajax.onInteractive = whenInteractivefro;
	fajax.runAJAX();
}
