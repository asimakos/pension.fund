// =======================
// Component Categories Ajax
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

var ccajax = new sack();

function whenLoadingcat(){
	var e = document.getElementById(ccajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedcat(){
	var e = document.getElementById(ccajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivecat(){
	var e = document.getElementById(ccajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

/* PUBLISH/UNPUBLISH CATEGORY */
function changeCategoryState(elem, id, state){
    ajelem = 'catstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    ccajax.setVar("option", 'com_categories');
    ccajax.setVar("task", 'ajaxpub');
    ccajax.setVar("elem", elem);
    ccajax.setVar("id", id);
    ccajax.setVar("state", state);

	ccajax.requestFile = "index3.php";

	ccajax.method = 'POST';
	ccajax.element = ajelem;
	ccajax.onLoading = whenLoadingcat;
	ccajax.onLoaded = whenLoadedcat;
	ccajax.onInteractive = whenInteractivecat;
	ccajax.runAJAX();
}

/* VALIDATE SEO TITLE */
function validateSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;
    var secid = document.adminForm.sectionid.value;

    if (secid.indexOf('com_') == -1) { //content
        if (secid == 'content') { //new category
            var cosec = document.adminForm.section.options[document.adminForm.section.selectedIndex].value;
        } else { //existing category
            var cosec = document.adminForm.section.value;
        }
    } else { //component
        var cosec = secid;
    }

	ccajax.setVar("option", 'com_categories');
	ccajax.setVar("task", 'validate');
	ccajax.setVar("coid", coid);
	ccajax.setVar("cosec", cosec);
	ccajax.setVar("seotitle", seotitle);

	ccajax.requestFile = "index3.php";

	ccajax.method = 'POST';
	ccajax.element = 'valseo';
	ccajax.onLoading = whenLoadingcat;
	ccajax.onLoaded = whenLoadedcat;
	ccajax.onInteractive = whenInteractivecat;
	ccajax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggestSEO() {
    var cotitle = document.adminForm.title.value;
    var coid = document.adminForm.id.value;
    var secid = document.adminForm.sectionid.value;

    if (secid.indexOf('com_') == -1) { //content
        if (secid == 'content') { //new category
            var cosec = document.adminForm.section.options[document.adminForm.section.selectedIndex].value;
        } else { //existing category
            var cosec = document.adminForm.section.value;
        }
    } else { //component
        var cosec = secid;
    }

    if (cotitle == '') {
        alert('Please write a title!');
    } else if (cosec == '') {
        alert('Please select a section!');
    } else {
        var rnd = Math.random();
        try{
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.setRequestHeader('charset', 'utf-8');
            http.onreadystatechange = showresultsug;
            http.send('option=com_categories&task=suggest&cotitle='+cotitle+'&coid='+coid+'&cosec='+cosec+'&rnd='+rnd);
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
