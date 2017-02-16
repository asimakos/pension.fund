/* 
Component Media Ajax
Created by Ioannis Sannos (datahell)
Author URL: http://www.goup.gr
Author email: i.sannos@goup.gr
Copyright: GO UP Inc 2007-2008. All rights reserved.
License: GNU/GPL
Elxis CMS is a free software
*/


function newobj() {
    var ro;
    if(window.XMLHttpRequest){ // Non-IE browsers
        ro = new XMLHttpRequest();
    } else if (window.ActiveXObject){ // IE
        ro=new ActiveXObject("Msxml2.XMLHTTP");
        if (!ro){
            ro=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return ro;
}

var http = newobj();

var majax = new sack();

function whenLoadingM() {
	var e = document.getElementById(majax.element);
	e.innerHTML = "<img src='components/com_media/images/majaxloading.gif' border='0'>";
}


/* DELETE FILE OR FOLDER */
function mm_delete() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
		msg = '';
		var filetype = 'file';
		if (oldficon.getAttribute("spec").indexOf("d")>0) {
			msg = mShowMessage(7);
			filetype = 'folder';
		}

		var cmsg = mShowMessage(8, fname);
		if (confirm(cmsg+"\n"+msg)) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;

            var rnd = Math.random();
            try{
                http.open('POST', 'index3.php');
                http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = showresultdel;
                http.send('option=com_media&task=delete&lic='+lic+'&file='+fname+'&reldir='+reldir+'&filetype='+filetype+'&rnd='+rnd);
            }
            catch(e){}
            finally{}
		}
    }
}


/* DISPLAY DELETE RESULT */
function showresultdel() {
    var thestatus = document.getElementById('thestatus');
	if(http.readyState == 4) {
		if(http.status!=200) {
			thestatus.innerHTML = "<font color=red><b>HTTP Error!:</b>  "+http.status+" "+http.statusText+". Please retry.</font>"; 
		}
        var reply = http.responseText;
        var update = new Array();
        update = reply.split('|');
        thestatus.innerHTML = update[3];
        if (update[1]==1) {
            var delli = document.getElementById('mediabox'+update[2]);
            delli.innerHTML = "";
            delli.style.display = "none";
            document.getElementById('sfname').value = "";
            document.getElementById('sli').value = "0";
            document.getElementById('sliold').value = "0";
            document.getElementById('sftype').value = "";
            document.getElementById('sfspec').value = "";
		}
	} else {
		thestatus.innerHTML = "<img src='components/com_media/images/majaxloading.gif' border='0'>";
	}
}


/* PREVIEW AN IMAGE */
function mm_preview() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
		if (oldficon.getAttribute("spec").indexOf("t")>0) {

            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;
            scrwidth = document.getElementById('scrwidth').value;
            scrheight = document.getElementById('scrheight').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'previewimage');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("scrwidth", scrwidth);
            majax.setVar("scrheight", scrheight);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
		} else {
		    nofilemsg = mShowMessage(4);
		    alert(nofilemsg);
		}
    }
}


/* PREVIEW A FLASH VIDEO (FLV) */
function mm_vpreview() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
		if (oldficon.getAttribute("spec").indexOf("v")>0) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;
            scrwidth = document.getElementById('scrwidth').value;
            scrheight = document.getElementById('scrheight').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'previewflv');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("scrwidth", scrwidth);
            majax.setVar("scrheight", scrheight);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
		} else {
		    noflvmsg = mShowMessage(13);
		    alert(noflvmsg);
		}
    }
}


/* LISTEN AN MP3 AUDIO FILE */
function mm_playmp3() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
		if (oldficon.getAttribute("spec").indexOf("3")>0) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;
            scrwidth = document.getElementById('scrwidth').value;
            scrheight = document.getElementById('scrheight').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'listenmp3');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("scrwidth", scrwidth);
            majax.setVar("scrheight", scrheight);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
		} else {
		    nomp3msg = mShowMessage(15);
		    alert(nomp3msg);
		}
    }
}


/* RENAME FILE OR FOLDER */
function mm_rename() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
        oldname=fname;
        renmsg = mShowMessage(6);
        newname=window.prompt(renmsg,oldname);
        if (newname&&(newname!=oldname)) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;
            var rnd = Math.random();
            try{
                http.open('POST', 'index3.php');
                http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = showresultren;
                http.send('option=com_media&task=rename&lic='+lic+'&file='+fname+'&reldir='+reldir+'&newname='+newname+'&rnd='+rnd);
            }
            catch(e){}
            finally{}
        }
    }
}


/* DISPLAY RENAME RESULT */
function showresultren() {
    var thestatus = document.getElementById('thestatus');
	if(http.readyState == 4) {
		if(http.status!=200) {
			thestatus.innerHTML = "<font color=red><b>HTTP Error!:</b>  "+http.status+" "+http.statusText+". Please retry.</font>"; 
		}
        var reply = http.responseText;
        var update = new Array();
        update = reply.split('|');
        thestatus.innerHTML = update[3];
        if(update[1]==1) {
            document.getElementById('mediabox'+update[2]).innerHTML = update[4];
            document.getElementById('sfname').value = "";
            document.getElementById('sli').value = "0";
            document.getElementById('sliold').value = "0";
            document.getElementById('sftype').value = "";
            document.getElementById('sfspec').value = "";
		}
	} else {
		thestatus.innerHTML = "<img src='components/com_media/images/majaxloading.gif' border='0'>";
	}
}


/* COPY A FILE */
function mm_copy() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    var sfspec = document.getElementById('sfspec').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else if (sfspec.indexOf("d")>0) {
        specmsg = mShowMessage(10);
        alert(specmsg);
    } else {
        reldir = document.getElementById('reldir').value;
        var cmsg = mShowMessage(9);
        destdir = window.prompt(cmsg,reldir);
        if (destdir&&(destdir!=reldir)) {
            majax.setVar("option", 'com_media');
            majax.setVar("task", 'copy');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("destdir", destdir);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
        }
    }
}


/* CREATE NEW FOLDER */
function mm_newfolder() { 
    var nfmsg = mShowMessage(11);
    foldername = window.prompt(nfmsg,"new_folder");
    if (foldername) {
        var e = document.getElementById('thestatus');
        e.style.display = "";
        reldir = document.getElementById('reldir').value;
        lastlic = document.getElementById('lastlic').value;
        var rnd = Math.random();
        try {
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = shownewfolder;
            http.send('option=com_media&task=newfolder&lastlic='+lastlic+'&foldername='+foldername+'&reldir='+reldir+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* DISPLAY NEW FOLDER CREATION RESULT */
function shownewfolder() {
    var thestatus = document.getElementById('thestatus');
	if (http.readyState == 4) {
		if(http.status!=200) {
			thestatus.innerHTML = "<font color=red><b>HTTP Error!:</b>  "+http.status+" "+http.statusText+". Please retry.</font>"; 
		}
        var reply = http.responseText;
        var update = new Array();
        update = reply.split('|');
        thestatus.innerHTML = update[3];
        if (update[1]==1) {
            dom_newbox(update[4], update[2]);
            document.getElementById('sfname').value = "";
            document.getElementById('sli').value = "0";
            document.getElementById('sliold').value = "0";
            document.getElementById('sftype').value = "";
            document.getElementById('sfspec').value = "";
            document.getElementById('lastlic').value = update[2];
		}
	} else {
		thestatus.innerHTML = "<img src='components/com_media/images/majaxloading.gif' border='0'>";
	}
}


/* CREATE NEW FILE OR FOLDER (<li> element) */
function dom_newbox(file_status, nlic)	{
    var ul=document.getElementById('medialist');
    var newLi = document.createElement('li');
    newLi.setAttribute("id","mediabox"+nlic);
    newLi.innerHTML = file_status;
    ul.appendChild(newLi);
    ul.insertBefore(newLi, ul.firstChild);
}


/* CHANGE MODE */
function mm_chmode() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    var sfspec = document.getElementById('sfspec').value;
    var cmode = document.adminForm.mode.value;

    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
        var e = document.getElementById('thestatus');
        e.style.display = "";
        reldir = document.getElementById('reldir').value;
        var rnd = Math.random();
        try {
            http.open('POST', 'index3.php');
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = showresultcmod;
            http.send('option=com_media&task=cmode&lic='+lic+'&file='+fname+'&reldir='+reldir+'&mode='+cmode+'&rnd='+rnd);
        }
        catch(e){}
        finally{}
    }
}


/* DISPLAY CHANGE MODE RESULT */
function showresultcmod() {
	var thestatus = document.getElementById('thestatus');
	if(http.readyState == 4) {
		if(http.status!=200) {
			thestatus.innerHTML = "<font color=red><b>HTTP Error!:</b>  "+http.status+" "+http.statusText+". Please retry.</font>"; 
		}
        var reply = http.responseText;
        var update = new Array();
        update = reply.split('|');
        thestatus.innerHTML = update[3];
        if(update[1]==1) {
            document.getElementById('mediabox'+update[2]).innerHTML = update[4];
            document.getElementById('sfname').value = "";
            document.getElementById('sli').value = "0";
            document.getElementById('sliold').value = "0";
            document.getElementById('sftype').value = "";
            document.getElementById('sfspec').value = "";
		}
	} else {
		thestatus.innerHTML = "<img src='components/com_media/images/majaxloading.gif' border='0'>";
	}
}


/* EXTRACT A ZIP FILE */
function mm_extract() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    var sfspec = document.getElementById('sfspec').value;

    if ((fname == '') || (lic == '0')) {
        szipmsg = mShowMessage(5);
        alert(szipmsg);
    } else if (sfspec.indexOf("z")>0) {
        var cexmsg = mShowMessage(16, fname);
        if (confirm(cexmsg)) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'extract');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
        }
    } else {
        var nozipmsg = mShowMessage(18, fname);
        document.getElementById('thestatus').innerHTML = nozipmsg;
    }
}


/* PREPARE TO RESIZE AN IMAGE */
function mm_prepare_resize() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    var spec = document.getElementById('sfspec').value;
    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else {
		if (spec.indexOf("e")>0) {
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;
            scrwidth = document.getElementById('scrwidth').value;
            scrheight = document.getElementById('scrheight').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'preresize');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("scrwidth", scrwidth);
            majax.setVar("scrheight", scrheight);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
		} else {
		    noresmsg = mShowMessage(19);
		    alert(noresmsg);
		}
    }
}


/* TRIGGER IMAGE RESIZE PROCESS */
function mm_doresize() {
    var lic = document.getElementById('sli').value;
    var fname = document.getElementById('sfname').value;
    var spec = document.getElementById('sfspec').value;
    var reswidth = document.getElementById('reswidth').value;
    var resheight = document.getElementById('resheight').value;
    var keep = document.getElementById('keepratio');
    var keepratio = (keep.checked == true) ? 1 : 0;

    if ((fname == '') || (lic == '0')) {
        sfilemsg = mShowMessage(5);
        alert(sfilemsg);
    } else if (mm_isValInteger(reswidth) == false) {
        siwmsg = mShowMessage(20);
        alert(siwmsg);
    } else if (mm_isValInteger(resheight) == false) {
        sihmsg = mShowMessage(21);
        alert(sihmsg);
    } else {
		if (spec.indexOf("e")>0) {
		    hideLayer('imgresize');
            var e = document.getElementById('thestatus');
            e.style.display = "";
            reldir = document.getElementById('reldir').value;

            majax.setVar("option", 'com_media');
            majax.setVar("task", 'doresize');
            majax.setVar("file", fname);
            majax.setVar("reldir", reldir);
            majax.setVar("keepratio", keepratio);
            majax.setVar("reswidth", reswidth);
            majax.setVar("resheight", resheight);

            majax.requestFile = "index3.php";
            majax.method = 'POST';
            majax.element = 'thestatus';
            majax.onLoading = whenLoadingM;
            majax.onLoaded = whenLoadingM;
            majax.onInteractive = whenLoadingM;
            majax.runAJAX();
		} else {
		    noresmsg = mShowMessage(19);
		    alert(noresmsg);
		}
    }
}
