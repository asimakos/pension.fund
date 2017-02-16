// =======================
// Component eBlog Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell [AT] elxis [DOT] org
// License: GNU/GPL
//=======================

function newobja() {
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

var ebhttp = newobja();

var eblogajax = new sack();

function whenLoadingeblog(){
	var e = document.getElementById(eblogajax.element);
	e.innerHTML = '<img src=\"/components/com_eblog/images/loading.gif\" border=\"0\" alt=\"loading...\" />';
}

/* VALIDATE SEO TITLE */
function validateeBlogSEO() {
    var seotitle = document.eblogform.seotitle.value;
    var coid = document.eblogform.id.value;
    var coblogid = document.eblogform.blogid.value;
    var Itemid = document.eblogform.Itemid.value;

	eblogajax.setVar("option", 'com_eblog');
	eblogajax.setVar("task", 'validate');
	eblogajax.setVar("coid", coid);
	eblogajax.setVar("seotitle", seotitle);
	eblogajax.setVar("blogid", coblogid);
	eblogajax.setVar("Itemid", Itemid);

	eblogajax.requestFile = "index2.php";

	eblogajax.method = 'POST';
	eblogajax.element = 'valiseo';
	eblogajax.onLoading = whenLoadingeblog;
	eblogajax.onLoaded = whenLoadingeblog;
	eblogajax.onInteractive = whenLoadingeblog;
	eblogajax.runAJAX();
}

/* SUGGEST SEO TITLE */
function suggesteBlogSEO() {
    var cotitle = document.eblogform.title.value;
    var coid = document.eblogform.id.value;
    var coblogid = document.eblogform.blogid.value;
    var Itemid = document.eblogform.Itemid.value;

    if (cotitle == '') {
        alert('Please write a name!');
    } else {
        var rnd = Math.random();
        try{
            ebhttp.open('POST', 'index2.php');
            ebhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ebhttp.setRequestHeader('charset', 'utf-8');
            ebhttp.onreadystatechange = showresultsugg;
            ebhttp.send('option=com_eblog&task=suggest&cotitle='+cotitle+'&coid='+coid+'&blogid='+coblogid+'&Itemid='+Itemid+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}

/* SHOW SUGGESTION RESULTS */
function showresultsugg() {
    var stitle = document.getElementById('seotitlex');
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
