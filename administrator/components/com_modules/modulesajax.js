// =======================
// Component Modules Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================


var majax = new sack();

function whenLoadingmod(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedmod(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivemod(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeModuleState(elem, id, state){
    ajelem = 'constatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    majax.setVar("option", 'com_modules');
    majax.setVar("task", 'ajaxpub');
    majax.setVar("elem", elem);
    majax.setVar("id", id);
    majax.setVar("state", state);

	majax.requestFile = "index3.php";

	majax.method = 'POST';
	majax.element = ajelem;
	majax.onLoading = whenLoadingmod;
	majax.onLoaded = whenLoadedmod;
	majax.onInteractive = whenInteractivemod;
	majax.runAJAX();
}
