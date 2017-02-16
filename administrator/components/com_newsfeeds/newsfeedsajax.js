// =======================
// Component NewsFeeds Ajax
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

var najax = new sack();

function whenLoadingnew(){
	var e = document.getElementById(najax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenLoadednew(){
	var e = document.getElementById(najax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function whenInteractivenew(){
	var e = document.getElementById(najax.element);
	e.innerHTML = "<img src='images/loading.gif' border='0'>";
}

function changeFeedState(elem, id, state){
    ajelem = 'feedstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    najax.setVar("option", 'com_newsfeeds');
    najax.setVar("task", 'ajaxpub');
    najax.setVar("elem", elem);
    najax.setVar("id", id);
    najax.setVar("state", state);

	najax.requestFile = "index3.php";

	najax.method = 'POST';
	najax.element = ajelem;
	najax.onLoading = whenLoadingnew;
	najax.onLoaded = whenLoadednew;
	najax.onInteractive = whenInteractivenew;
	najax.runAJAX();
}

/* VALIDATE SEO TITLE */
function validateSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.id.value;
    var cocatid = document.adminForm.catid.options[document.adminForm.catid.selectedIndex].value;

	najax.setVar("option", 'com_newsfeeds');
	najax.setVar("task", 'validate');
	najax.setVar("coid", coid);
	najax.setVar("cocatid", cocatid);
	najax.setVar("seotitle", seotitle);

	najax.requestFile = "index3.php";

	najax.method = 'POST';
	najax.element = 'valseo';
	najax.onLoading = whenLoadingnew;
	najax.onLoaded = whenLoadednew;
	najax.onInteractive = whenInteractivenew;
	najax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggestSEO() {
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
            http.send('option=com_newsfeeds&task=suggest&cotitle='+cotitle+'&coid='+coid+'&cocatid='+cocatid+'&rnd='+rnd);
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
