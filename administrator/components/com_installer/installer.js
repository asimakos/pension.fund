// =======================
// Component Installer Ajax
// Copyright: (C) 2006-2010 Elxis.org. All rights reserved
// Author: Elxis Team
// E-mail:  info [AT] elxis [DOT] org
// License: GNU/GPL
//=======================

var iajax = new sack();

function whenloadinginst(){
	var e = document.getElementById(iajax.element);
	e.innerHTML = '<img src="images/loading.gif" border="0" alt="loading" />';
}

function loadpackages(elem, client) {
	var e = document.getElementById('edclist');
	e.style.display = "";

    iajax.setVar("option", 'com_installer');
    iajax.setVar("task", 'listpackages');
    iajax.setVar("element", elem);
    iajax.setVar("client", client);
	iajax.requestFile = "index3.php";

	iajax.method = 'POST';
	iajax.element = 'edclist';
	iajax.onLoading = whenloadinginst;
	iajax.onLoaded = whenloadinginst;
	iajax.onInteractive = whenloadinginst;
	iajax.runAJAX();
}

function clearpackages() {
	var e = document.getElementById('edclist');
	e.innerHTML = '';
	e.style.display = "none";
}