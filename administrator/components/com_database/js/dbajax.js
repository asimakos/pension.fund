// =======================
// Component Database Ajax
// Copyright: (C) 2007 Goup Inc. All rights reserved
// Author: Ioannis Sannos (Elxis Team)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================

var ajaxdb = new sack();

function whenLoadingComdb(){
	var e = document.getElementById(ajaxdb.element);
	e.innerHTML = "<img src='images/loading.gif'> Sending Data...<br /><br />";
}

function whenLoadedComdb(){
	var e = document.getElementById(ajaxdb.element);
	e.innerHTML = "<img src='images/loading.gif'> Data Sent...<br /><br />";
}

function whenInteractiveComdb(){
	var e = document.getElementById(ajaxdb.element);
	e.innerHTML = "<img src='images/loading.gif'> Getting data...<br /><br />";
}

function comdbOptimize(){
	var e = document.getElementById('ajaxdbMessage');
	e.style.display = "";

    ajaxdb.setVar("option", 'com_database');
    ajaxdb.setVar("task", 'optimize');

	ajaxdb.requestFile = "index3.php";

	ajaxdb.method = 'POST';
	ajaxdb.element = 'ajaxdbMessage';
	ajaxdb.onLoading = whenLoadingComdb;
	ajaxdb.onLoaded = whenLoadedComdb;
	ajaxdb.onInteractive = whenInteractiveComdb;
	ajaxdb.runAJAX();
}

function comdbRepair(){
	var e = document.getElementById('ajaxdbMessage');
	e.style.display = "";

    ajaxdb.setVar("option", 'com_database');
    ajaxdb.setVar("task", 'repair');

	ajaxdb.requestFile = "index3.php";

	ajaxdb.method = 'POST';
	ajaxdb.element = 'ajaxdbMessage';
	ajaxdb.onLoading = whenLoadingComdb;
	ajaxdb.onLoaded = whenLoadedComdb;
	ajaxdb.onInteractive = whenInteractiveComdb;
	ajaxdb.runAJAX();
}
