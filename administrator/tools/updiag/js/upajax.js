// =======================
// Elxis Update Updiag Script using Ajax
// Copyright: (C) 2006 Goup Inc. All rights reserved
// Author: Ioannis Sannos
// E-mail:  datahell@elxis.org
// License: GNU/LGPL
// use ajax_new.js (sack version 1.6.1)
//=======================

var ajax = new sack();

function whenLoading(){
	var e = document.getElementById(ajax.element);
	e.innerHTML = "<img src='tools/updiag/images/loading.gif'> Sending Data...<br /><br />";
}

function whenLoaded(){
	var e = document.getElementById(ajax.element);
	e.innerHTML = "<img src='tools/updiag/images/loading.gif'> Data Sent...<br /><br />";
}

function whenInteractive(){
	var e = document.getElementById(ajax.element);
	e.innerHTML = "<img src='tools/updiag/images/loading.gif'> Getting data...<br /><br />";
}

function doup(scr, q){
	var e = document.getElementById('ajaxMessage'+q);
	e.style.display = "";

    ajax.setVar("act", 'iscr');
    ajax.setVar("scr", scr);
    ajax.setVar("q", q);

	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage'+q;
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function runup(scr, q){
	var e = document.getElementById('ajaxMessage'+q);
	e.style.display = "";

    ajax.setVar("act", 'runscr');
    ajax.setVar("scr", scr);
    ajax.setVar("q", q);

	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage'+q;
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function removeup(scr, q){
	var e = document.getElementById('ajaxMessage'+q);
	e.style.display = "";

    ajax.setVar("act", 'remscr');
    ajax.setVar("scr", scr);
    ajax.setVar("q", q);

	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage'+q;
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function removehash(hash, q){
	var e = document.getElementById('ajaxMessage'+q);
	e.style.display = "";

    ajax.setVar("act", 'remhash');
    ajax.setVar("hash", hash);
    ajax.setVar("q", q);

	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage'+q;
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function downhash(hash, q){
	var e = document.getElementById('ajaxMessage'+q);
	e.style.display = "";

    ajax.setVar("act", 'downhash');
    ajax.setVar("hash", hash);
    ajax.setVar("q", q);

	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage'+q;
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function dohelp(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'hashhelp');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function doelxisver(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'elxver');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function dophp(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'phpver');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function dodb(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'dbver');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function dosyst(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'sysver');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function docredits(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'credits');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}

function dosec(){
	var e = document.getElementById('ajaxMessage');
	e.style.display = "";

    ajax.setVar("act", 'security');
	ajax.requestFile = "index3.php?option=com_admin&task=itools&tname=updiag";

	ajax.method = 'POST';
	ajax.element = 'ajaxMessage';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded;
	ajax.onInteractive = whenInteractive;
	ajax.runAJAX();
}
