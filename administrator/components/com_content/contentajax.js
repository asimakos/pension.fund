// =======================
// Component Content Ajax
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

var cajax = new sack();

function whenLoadingcon(){
	var e = document.getElementById(cajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedcon(){
	var e = document.getElementById(cajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivecon(){
	var e = document.getElementById(cajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeContentState(elem, id, state){
    ajelem = 'constatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    cajax.setVar("option", 'com_content');
    cajax.setVar("task", 'ajaxpub');
    cajax.setVar("elem", elem);
    cajax.setVar("id", id);
    cajax.setVar("state", state);

	cajax.requestFile = "index3.php";

	cajax.method = 'POST';
	cajax.element = ajelem;
	cajax.onLoading = whenLoadingcon;
	cajax.onLoaded = whenLoadedcon;
	cajax.onInteractive = whenInteractivecon;
	cajax.runAJAX();
}

function changeFrontState(elem, id, state){
    ajelem = 'frontpage'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    cajax.setVar("option", 'com_content');
    cajax.setVar("task", 'ajaxfront');
    cajax.setVar("elem", elem);
    cajax.setVar("id", id);
    cajax.setVar("state", state);

	cajax.requestFile = "index3.php";

	cajax.method = 'POST';
	cajax.element = ajelem;
	cajax.onLoading = whenLoadingcon;
	cajax.onLoaded = whenLoadedcon;
	cajax.onInteractive = whenInteractivecon;
	cajax.runAJAX();
}

/* VALIDATE SEO TITLE */
function validateSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;
    var cocatid = document.adminForm.catid.options[document.adminForm.catid.selectedIndex].value;

	cajax.setVar("option", 'com_content');
	cajax.setVar("task", 'validate');
	cajax.setVar("coid", coid);
	cajax.setVar("cocatid", cocatid);
	cajax.setVar("seotitle", seotitle);

	cajax.requestFile = "index3.php";

	cajax.method = 'POST';
	cajax.element = 'valseo';
	cajax.onLoading = whenLoadingcon;
	cajax.onLoaded = whenLoadedcon;
	cajax.onInteractive = whenInteractivecon;
	cajax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggestSEO() {
    var cotitle = document.adminForm.title.value;
    var coid = document.adminForm.id.value;
    var cocatid = document.adminForm.catid.options[document.adminForm.catid.selectedIndex].value;

    if (cotitle == '') {
        alert('Please write a title!');
    } else {
        var rnd = Math.random();
        try{
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.setRequestHeader('charset', 'utf-8');
            http.onreadystatechange = showresultsug;
            http.send('option=com_content&task=suggest&cotitle='+cotitle+'&coid='+coid+'&cocatid='+cocatid+'&rnd='+rnd);
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
