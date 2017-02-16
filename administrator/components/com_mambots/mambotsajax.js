// =======================
// Component Mambots Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================


var botajax = new sack();

function whenLoadingbot(){
	var e = document.getElementById(botajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function whenLoadedbot(){
	var e = document.getElementById(botajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function whenInteractivebot(){
	var e = document.getElementById(botajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0' />";
}

function changeBotState(elem, id, state){
    ajelem = 'botstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    botajax.setVar("option", 'com_mambots');
    botajax.setVar("task", 'ajaxpub');
    botajax.setVar("elem", elem);
    botajax.setVar("id", id);
    botajax.setVar("state", state);

	botajax.requestFile = "index3.php";

	botajax.method = 'POST';
	botajax.element = ajelem;
	botajax.onLoading = whenLoadingbot;
	botajax.onLoaded = whenLoadedbot;
	botajax.onInteractive = whenInteractivebot;
	botajax.runAJAX();
}
