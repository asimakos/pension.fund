// =======================
// Component Component Poll Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================

function newobj() {
    var ro;
    if(window.XMLHttpRequest){ // Non-IE browsers
        ro = new XMLHttpRequest();
    } else if (window.ActiveXObject){ // IE
        ro=new ActiveXObject("Msxml2.XMLHTTP");
        if (!ro) {
            ro=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return ro;
}

var http = newobj();

var polajax = new sack();

function whenLoadingpol(){
	var e = document.getElementById(polajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedpol(){
	var e = document.getElementById(polajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivepol(){
	var e = document.getElementById(polajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changePollState(elem, id, state){
    ajelem = 'pollstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    polajax.setVar("option", 'com_poll');
    polajax.setVar("task", 'ajaxpub');
    polajax.setVar("elem", elem);
    polajax.setVar("id", id);
    polajax.setVar("state", state);

	polajax.requestFile = "index3.php";

	polajax.method = 'POST';
	polajax.element = ajelem;
	polajax.onLoading = whenLoadingpol;
	polajax.onLoaded = whenLoadedpol;
	polajax.onInteractive = whenInteractivepol;
	polajax.runAJAX();
}

function changePollLock(elem, id, state){
    ajelem = 'polllock'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    polajax.setVar("option", 'com_poll');
    polajax.setVar("task", 'ajaxlock');
    polajax.setVar("elem", elem);
    polajax.setVar("id", id);
    polajax.setVar("state", state);

	polajax.requestFile = "index3.php";

	polajax.method = 'POST';
	polajax.element = ajelem;
	polajax.onLoading = whenLoadingpol;
	polajax.onLoaded = whenLoadedpol;
	polajax.onInteractive = whenInteractivepol;
	polajax.runAJAX();
}

/* VALIDATE SEO TITLE */
function validateSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;

	polajax.setVar("option", 'com_poll');
	polajax.setVar("task", 'validate');
	polajax.setVar("coid", coid);
	polajax.setVar("seotitle", seotitle);

	polajax.requestFile = "index3.php";

	polajax.method = 'POST';
	polajax.element = 'valseo';
	polajax.onLoading = whenLoadingpol;
	polajax.onLoaded = whenLoadedpol;
	polajax.onInteractive = whenInteractivepol;
	polajax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggestSEO() {
    var cotitle = document.adminForm.title.value;
    var coid = document.adminForm.id.value;

    if (cotitle == '') {
        alert('Please write a title!');
    } else {
        var rnd = Math.random();
        try{
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.setRequestHeader('charset', 'utf-8');
            http.onreadystatechange = showresultsug;
            http.send('option=com_poll&task=suggest&cotitle='+cotitle+'&coid='+coid+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* SHOW SUGGESTION RESULTS */
function showresultsug() {
    var stitle = document.getElementById('seotitle');
	if(http.readyState == 4) {
		if(http.status!=200) {
			alert('Error, please retry'); 
		}
        var reply = http.responseText;
        var update = new Array();
        update = reply.split('|');
        if (update[1]==1) {
            stitle.value = update[2];
		} else {
		  alert(update[2]);
		}
	}
}
