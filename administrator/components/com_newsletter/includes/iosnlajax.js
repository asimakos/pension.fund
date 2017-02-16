// =======================
// Component NewsLetter Ajax
// Copyright: (C) 2008-2009 Is Open Source. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  info [AT] isopensource [DOT] com
// Link: http://www.isopensource.com
// License: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
//=======================

function newobjnl() {
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

var nlhttp = newobjnl();


var nlajax = new sack();

function whenLoadingnl(){
	var e = document.getElementById(nlajax.element);
	e.innerHTML = '<img src=\"images/loading.gif\" border=\"0\" alt=\"loading...\" />';
}

/* CONFIRM/UNCONFIRM SUBSCRIBER */
function changeNLState(elem, id, state) {
    ajelem = 'subscribertatus'+elem;
	var e = document.getElementById(ajelem);
	e.style.display = "";

    nlajax.setVar("option", 'com_newsletter');
    nlajax.setVar("task", 'ajaxconfirm');
    nlajax.setVar("elem", elem);
    nlajax.setVar("id", id);
    nlajax.setVar("state", state);

	nlajax.requestFile = "index3.php";

	nlajax.method = 'POST';
	nlajax.element = ajelem;
	nlajax.onLoading = whenLoadingnl;
	nlajax.onLoaded = whenLoadingnl;
	nlajax.onInteractive = whenLoadingnl;
	nlajax.runAJAX();
}

/* LOAD USER DATA */
function iosnluserdata() {
	var userObj = document.getElementById('userid');
	var userid = userObj.options[userObj.selectedIndex].value;

    if (userid == '0') {
        alert('Please select a user!');
    } else {
        var rnd = Math.random();
        try{
            nlhttp.open('POST', 'index3.php');
            nlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            nlhttp.setRequestHeader('charset', 'utf-8');
            nlhttp.onreadystatechange = iosnlupdateuserdata;
            nlhttp.send('option=com_newsletter&task=userdata&userid='+userid+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* UPDATE USER DATA */
function iosnlupdateuserdata() {
    var sname = document.getElementById('subname');
    var subsurname = document.getElementById('subsurname');
    var subemail = document.getElementById('subemail');

	if(nlhttp.readyState == 4) {
		if(nlhttp.status!=200) {
			alert('Error, please retry'); 
		}
        var reply = nlhttp.responseText;
        var update = new Array();
        update = reply.split('|');
        if (update[1]==1) {
            sname.value = update[2];
            subsurname.value = update[3];
            subemail.value = update[4];
		} else {
		  alert(update[2]);
		}
	}
}

