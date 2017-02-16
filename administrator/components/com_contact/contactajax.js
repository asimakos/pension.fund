// =======================
// Component Contact Ajax
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

var conajax = new sack();

function whenLoadingcont(){
	var e = document.getElementById(conajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadedcont(){
	var e = document.getElementById(conajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivecont(){
	var e = document.getElementById(conajax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

/* VALIDATE SEO TITLE */
function validateContactSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;
    var cocatid = document.adminForm.catid.options[document.adminForm.catid.selectedIndex].value;

	conajax.setVar("option", 'com_contact');
	conajax.setVar("task", 'validate');
	conajax.setVar("coid", coid);
	conajax.setVar("cocatid", cocatid);
	conajax.setVar("seotitle", seotitle);

	conajax.requestFile = "index3.php";

	conajax.method = 'POST';
	conajax.element = 'valseo';
	conajax.onLoading = whenLoadingcont;
	conajax.onLoaded = whenLoadedcont;
	conajax.onInteractive = whenInteractivecont;
	conajax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggestContactSEO() {
    var cotitle = document.adminForm.name.value;
    var coid = document.adminForm.id.value;
    var cocatid = document.adminForm.catid.options[document.adminForm.catid.selectedIndex].value;

    if (cotitle == '') {
        alert('Please write a name!');
    } else if (cocatid == '0') {
        alert('Please select a category!');
    } else {
        var rnd = Math.random();
        try{
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.setRequestHeader('charset', 'utf-8');
            http.onreadystatechange = showresultsug;
            http.send('option=com_contact&task=suggest&cotitle='+cotitle+'&coid='+coid+'&cocatid='+cocatid+'&rnd='+rnd);
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
