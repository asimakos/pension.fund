// =======================
// Component Menus Ajax and javascript
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell [AT] elxis [DOT] org
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

var majax = new sack();

function whenLoadingmen(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}


function whenLoadedmen(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}


function whenInteractivemen(){
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}


/* SUGGEST SEO TITLE (used in menus com_wrapper) */
function suggestSEO() {
    var cotitle = document.adminForm.name.value;
    var coid = document.adminForm.id.value;
    var cooption = document.adminForm.type.value;

    if (cotitle == '') {
        alert('Please write a title!');
    } else {
        var rnd = Math.random();
        try{
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.setRequestHeader('charset', 'utf-8');
            http.onreadystatechange = showresultsug;
            http.send('option=com_menus&task=suggest&type='+cooption+'&cotitle='+cotitle+'&coid='+coid+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* SHOW SUGGESTION RESULTS (used in menus com_wrapper) */
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


/* VALIDATE SEO TITLE */
function validateSEO() {
    var costitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;
    var cooption = document.adminForm.type.value;

	majax.setVar("option", 'com_menus');
	majax.setVar("task", 'validate');
	majax.setVar("type", cooption);
	majax.setVar("coid", coid);
	majax.setVar("costitle", costitle);

	majax.requestFile = "index3.php";

	majax.method = 'POST';
	majax.element = 'valseo';
	majax.onLoading = whenLoadingmen;
	majax.onLoaded = whenLoadedmen;
	majax.onInteractive = whenInteractivemen;
	majax.runAJAX();
}


/* DISPLAY SEO TITLE IN EDIT LINK FORM */
function viewseotitle(el) {
    var e = document.getElementById('seotitlediv');
    e.innerHTML = "";

	var selObj = eval('document.adminForm.'+el);
	var conid = selObj.options[selObj.selectedIndex].value;

    majax.setVar("option", 'com_menus');
    majax.setVar("task", 'viewseotitle');
    majax.setVar("conid", conid);

	majax.requestFile = "index3.php";

	majax.method = 'POST';
	majax.element = 'seotitlediv';
	majax.onLoading = whenLoadingmen;
	majax.onLoaded = whenLoadedmen;
	majax.onInteractive = whenInteractivemen;
	majax.runAJAX();

}

/* PUBLISH / UNPUBLISH A MENU ITEM */
function changeMenuState(elem, id, state) {
    ajelem = 'menustatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    majax.setVar("option", 'com_menus');
    majax.setVar("task", 'ajaxpub');
    majax.setVar("elem", elem);
    majax.setVar("id", id);
    majax.setVar("state", state);

	majax.requestFile = "index3.php";

	majax.method = 'POST';
	majax.element = ajelem;
	majax.onLoading = whenLoadingmen;
	majax.onLoaded = whenLoadedmen;
	majax.onInteractive = whenInteractivemen;
	majax.runAJAX();
}
