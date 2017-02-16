// =======================
// Component Banners Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================


var banajax = new sack();

function whenLoadingban(){
	var e = document.getElementById(banajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedban(){
	var e = document.getElementById(banajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractiveban(){
	var e = document.getElementById(banajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

/* PUBLISH/UNPUBLISH BANNER */
function changeBannerState(elem, id, state){
    ajelem = 'banstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    banajax.setVar("option", 'com_banners');
    banajax.setVar("task", 'ajaxpub');
    banajax.setVar("elem", elem);
    banajax.setVar("id", id);
    banajax.setVar("state", state);

	banajax.requestFile = "index3.php";

	banajax.method = 'POST';
	banajax.element = ajelem;
	banajax.onLoading = whenLoadingban;
	banajax.onLoaded = whenLoadedban;
	banajax.onInteractive = whenInteractiveban;
	banajax.runAJAX();
}