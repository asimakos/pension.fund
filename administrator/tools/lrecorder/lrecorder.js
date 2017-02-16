// =======================
// Elxis Login Recorder Ajax
// Copyright: (C) 2006-2008 Elxis.org
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// use ajax_new.js (sack version 1.6.1)
//=======================

var recajax = new sack();

function whenLoadingRec(){
	var e = document.getElementById(recajax.element);
	e.innerHTML = "<img src='tools/lrecorder/images/loading.gif'> Sending Data...<br /><br />";
}

function whenLoadedRec(){
	var e = document.getElementById(recajax.element);
	e.innerHTML = "<img src='tools/lrecorder/images/loading.gif'> Data Sent...<br /><br />";
}

function whenInteractiveRec(){
	var e = document.getElementById(recajax.element);
	e.innerHTML = "<img src='tools/lrecorder/images/loading.gif'> Getting data...<br /><br />";
}

function recChangeStatus(){
	var e = document.getElementById('recStatus');
	e.style.display = "";

    recajax.setVar("option", 'com_admin');
    recajax.setVar("task", 'itools');
    recajax.setVar("tname", 'lrecorder');
    recajax.setVar("act", 'cstatus');

	recajax.requestFile = "index3.php";

	recajax.method = 'POST';
	recajax.element = 'recStatus';
	recajax.onLoading = whenLoadingRec;
	recajax.onLoaded = whenLoadedRec;
	recajax.onInteractive = whenInteractiveRec;
	recajax.runAJAX();
}
