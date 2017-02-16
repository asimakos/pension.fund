// =======================
// Component Component Sections Ajax
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

var secajax = new sack();

function whenLoadingsec(){
	var e = document.getElementById(secajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedsec(){
	var e = document.getElementById(secajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivesec(){
	var e = document.getElementById(secajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeSectionState(elem, id, state){
    ajelem = 'sectionstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    secajax.setVar("option", 'com_sections');
    secajax.setVar("task", 'ajaxpub');
    secajax.setVar("elem", elem);
    secajax.setVar("id", id);
    secajax.setVar("state", state);

	secajax.requestFile = "index3.php";

	secajax.method = 'POST';
	secajax.element = ajelem;
	secajax.onLoading = whenLoadingsec;
	secajax.onLoaded = whenLoadedsec;
	secajax.onInteractive = whenInteractivesec;
	secajax.runAJAX();
}

/* VALIDATE SEO TITLE */
function validateSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;

	secajax.setVar("option", 'com_sections');
	secajax.setVar("task", 'validate');
	secajax.setVar("coid", coid);
	secajax.setVar("seotitle", seotitle);

	secajax.requestFile = "index3.php";

	secajax.method = 'POST';
	secajax.element = 'valseo';
	secajax.onLoading = whenLoadingsec;
	secajax.onLoaded = whenLoadedsec;
	secajax.onInteractive = whenInteractivesec;
	secajax.runAJAX();
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
            http.send('option=com_sections&task=suggest&cotitle='+cotitle+'&coid='+coid+'&rnd='+rnd);
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
