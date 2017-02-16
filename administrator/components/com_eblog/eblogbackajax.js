// =======================
// Component eBlog back-end Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell [AT] elxis [DOT] org
// License: GNU/GPL
//=======================

function newobjeb() {
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

var ebhttp = newobjeb();

var ebajax = new sack();

function whenLoadingeblog(){
	var e = document.getElementById(ebajax.element);
	e.innerHTML = '<img src=\"images/loading.gif\" border=\"0\" alt=\"loading...\" />';
}

function changeBlogState(elem, id, state) {
    ajelem = 'blogstatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    ebajax.setVar("option", 'com_eblog');
    ebajax.setVar("task", 'ajaxpub');
    ebajax.setVar("elem", elem);
    ebajax.setVar("blogid", id);
    ebajax.setVar("state", state);

	ebajax.requestFile = "index3.php";

	ebajax.method = 'POST';
	ebajax.element = ajelem;
	ebajax.onLoading = whenLoadingeblog;
	ebajax.onLoaded = whenLoadingeblog;
	ebajax.onInteractive = whenLoadingeblog;
	ebajax.runAJAX();
}

/* VALIDATE BLOG SEO TITLE */
function validateebSEO() {
    var seotitle = document.adminForm.seotitle.value;
    var coid = document.adminForm.blogid.value;

	ebajax.setVar("option", 'com_eblog');
	ebajax.setVar("task", 'validate');
	ebajax.setVar("blogid", coid);
	ebajax.setVar("seotitle", seotitle);

	ebajax.requestFile = "index3.php";

	ebajax.method = 'POST';
	ebajax.element = 'valseo';
	ebajax.onLoading = whenLoadingeblog;
	ebajax.onLoaded = whenLoadingeblog;
	ebajax.onInteractive = whenLoadingeblog;
	ebajax.runAJAX();
}

/* SUGGEST BLOG SEO TITLE */
function suggestebSEO() {
    var cotitle = document.adminForm.title.value;
    var coid = document.adminForm.blogid.value;

    if (cotitle == '') {
        alert('Please write a title!');
    } else {
        var rnd = Math.random();
        try{
            ebhttp.open('POST', 'index3.php');
            ebhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ebhttp.setRequestHeader('charset', 'utf-8');
            ebhttp.onreadystatechange = showebresultsug;
            ebhttp.send('option=com_eblog&task=suggest&cotitle='+cotitle+'&blogid='+coid+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* SHOW SUGGESTION RESULTS */
function showebresultsug() {
    var stitle = document.getElementById('seotitle');
	if(ebhttp.readyState == 4) {
		if(ebhttp.status!=200) {
			alert('Error, please retry'); 
		}
        var reply = ebhttp.responseText;
        var update = new Array();
        update = reply.split('|');
        if (update[1]==1) {
            stitle.value = update[2];
		} else {
		  alert(update[2]);
		}
	}
}
