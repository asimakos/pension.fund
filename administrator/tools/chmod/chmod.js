// =======================
// Change mode to a file or folder using Ajax
// Copyright: (C) 2006-2008 Elxis.org, All rights reserved.
// Author: Ioannis Sannos
// E-mail:  datahell@elxis.org
// use ajax_new.js (sack version 1.6.1)
//=======================

var ajax = new sack();

function whenLoading(){
	var e = document.getElementById('ajaxMessage'); 
	e.innerHTML = "Sending Data...";
}

function whenLoaded(){
	var e = document.getElementById('ajaxMessage'); 
	e.innerHTML = "Data Sent...";
}

function whenInteractive(){
	var e = document.getElementById('ajaxMessage'); 
	e.innerHTML = "getting data...";
}

function doit(){
	var form = document.getElementById('formCHMOD');
    ajax.setVar("submit", 'submit');
    ajax.setVar("fifopath", form.fifopath.value);
    ajax.setVar("mode", form.mode.value);
    ajax.setVar("tname", 'chmod');
    
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=chmod";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded; 
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}
