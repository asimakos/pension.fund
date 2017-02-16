// =======================
// Component Typedcontent Ajax
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

var tajax = new sack();

function whenLoadingtyp(){
	var e = document.getElementById(tajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedtyp(){
	var e = document.getElementById(tajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivetyp(){
	var e = document.getElementById(tajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeTypedState(elem, id, state){
  ajelem = 'typstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

  tajax.setVar("option", 'com_typedcontent');
  tajax.setVar("task", 'ajaxpublish');
  tajax.setVar("elem", elem);
  tajax.setVar("id", id);
  tajax.setVar("state", state);

	tajax.requestFile = "index3.php";

	tajax.method = 'POST';
	tajax.element = ajelem;
	tajax.onLoading = whenLoadingtyp;
	tajax.onLoaded = whenLoadedtyp;
	tajax.onInteractive = whenInteractivetyp;
	tajax.runAJAX();
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
            http.send('option=com_typedcontent&task=suggestseotitle&cotitle='+cotitle+'&coid='+coid+'&rnd='+rnd);
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


/* VALIDATE SEO TITLE */
function validateSEO() {
    var costitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;

	tajax.setVar("option", 'com_typedcontent');
	tajax.setVar("task", 'valseotitle');
	tajax.setVar("seotitle", costitle);
	tajax.setVar("coid", coid);

	tajax.requestFile = "index3.php";

	tajax.method = 'POST';
	tajax.element = 'valseo';
	tajax.onLoading = whenLoadingtyp;
	tajax.onLoaded = whenLoadedtyp;
	tajax.onInteractive = whenInteractivetyp;
	tajax.runAJAX();
}
