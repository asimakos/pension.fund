/* 
Component Media Javascript
Created by Ioannis Sannos (datahell)
Author URL: http://www.goup.gr
Author email: i.sannos@goup.gr
Copyright: GO UP Inc 2007-2008. All rights reserved.
License: GNU/GPL
Elxis CMS is a free software
*/

var ficon, oldficon, tempY, tempX;
if(!document.rightClickDisabled) document.rightClickDisabled = true;
document.oncontextmenu = showcontext;
document.onclick= hidecontext;
document.onblur= hidecontext;


function mm_gotodir() {
    var goval = document.adminForm.go.value;
    window.location.href="index2.php?option=com_media&reldir="+goval;
}

function mm_fullurl(file) {
	var fdiv = document.getElementById('fullurl');
	fdiv.innerHTML = '<span dir="ltr">URL (Ctl+C to copy): <strong>'+file+'</strong></span>';
}

function mm_loadfile(ficon, xtitle, lindex, spec, ftype) {
    if (oldficon) { oldficon.style.background="#FFFFFF"; } //clear old icon
    var lic = document.getElementById('sli');
    var oldlic = document.getElementById('sliold');
    document.getElementById('sfname').value = xtitle;
    if (lic.value != lindex) {
        oldlic.value = lic.value;
        lic.value = lindex;
    }
    document.getElementById('sftype').value = ftype;
    document.getElementById('sfspec').value = spec;

    var thestatus = document.getElementById('thestatus');
    thestatus.innerHTML = mShowMessage('0', xtitle)

    ficon.style.background="Highlight";
    oldficon = ficon;
    screenSize();
}


function mm_download(filen) {
    var confmsg = mShowMessage(1, filen);
    if (confirm(confmsg)) {
        el = document.getElementById('reldir');
        window.location.href="index3.php?option=com_media&task=download&file="+filen+"&reldir="+el.value;
    }
}


/* Right click context menu */
function showcontext(evt) {
    fname = document.getElementById('sfname').value;
    if (!fname) { return true; }
    if (!evt) { evt = event; }
    var cont = document.getElementById('context');
    getMouseXY(evt);

    span=document.body.clientHeight+document.body.scrollTop;

    if ((tempY+150)>span) { //ensure full y-visibilty
        span-=162;
        cont.style.top=span+"px";
    } else {
        cont.style.top=tempY+"px";
	}
	
    span=document.body.clientWidth+document.body.scrollLeft;
    if ((tempX+90)>span) { //ensure full x-visibilty
        tempX-=90;
        cont.style.left=tempX+"px";
    } else {
	    cont.style.left=tempX+"px";
	}

    cont.style.visibility="visible";

    //remove customization
    for (i=1;i<cont.rows.length-7;i++) {
        cont.deleteRow(i);
    }
    var spec = document.getElementById('sfspec').value;

    //customize context menu
    if (spec.length>=2) {
	   cont.insertRow(1);
	   cont.rows[1].insertCell(0);
	   cont.rows[1].insertCell(1);
	   cont.rows[1].cells[0].className="mm_contbar";
	}

    if (spec.indexOf("z")>0) {
        var etxt = mShowMessage(2);
        cont.rows[1].cells[0].innerHTML='<img src="components/com_media/images/extract.gif" height="16" width="16" class="mm_contbar">';
        cont.rows[1].cells[1].innerHTML='<a href="javascript:mm_extract()" class="mm_contitem">' + etxt + '</a>';
	} else if (spec.indexOf("t")>0) {
        var ptxt = mShowMessage(3);
        cont.rows[1].cells[0].innerHTML='<img src="components/com_media/images/view.gif" height="16" width="16" class="mm_contbar">';
        cont.rows[1].cells[1].innerHTML='<a href="javascript:mm_preview()" class="mm_contitem">' + ptxt + '</a>';
    } else if (spec.indexOf("v")>0) {
        var ptxt = mShowMessage(3);
        cont.rows[1].cells[0].innerHTML='<img src="components/com_media/images/view.gif" height="16" width="16" class="mm_contbar">';
        cont.rows[1].cells[1].innerHTML='<a href="javascript:mm_vpreview()" class="mm_contitem">' + ptxt + '</a>';
	} else if (spec.indexOf("3")>0) {
        var ptxt = mShowMessage(14);
        cont.rows[1].cells[0].innerHTML='<img src="components/com_media/images/play.png" height="16" width="16" class="mm_contbar">';
        cont.rows[1].cells[1].innerHTML='<a href="javascript:mm_playmp3()" class="mm_contitem">' + ptxt + '</a>';
	}

    var resizerow = document.getElementById('resizerow');
    var watermarkrow = document.getElementById('watermarkrow');
    if (spec.indexOf("e")>0) {
        resizerow.style.display="";
        watermarkrow.style.display="";
    } else {
        resizerow.style.display="none";
        watermarkrow.style.display="none";
    }

    return false;
}


function getMouseXY(e)	{ //get mouse position
if(!e) e=event;
  if (document.all) { 
    tempX = event.clientX + document.body.scrollLeft
    tempY = event.clientY + document.body.scrollTop
  } else {  
    tempX = e.pageX
    tempY = e.pageY
  }  
  if (tempX < 0){tempX = 0}
  if (tempY < 0){tempY = 0}  
  return true
}


function hidecontext() {
    var cont = document.getElementById('context');
    cont.style.visibility="hidden";
}


function screenSize() {
    var wel = document.getElementById('scrwidth');
    if (wel.value == '0') {
        wel.value = getWindowWidth();
        hel = document.getElementById('scrheight');
        hel.value = getWindowHeight();
    }
} 


function getWindowWidth() {
    if (window.innerWidth) {
        return window.innerWidth;
    } else if (document.body && document.body.clientWidth) {
        return document.body.clientWidth;
    } else {
        return 1024;
    }
}


function getWindowHeight() {
    if (window.innerHeight) {
        return window.innerHeight;
    } else if (document.body && document.body.clientHeight) {
        return document.body.clientHeight;
    } else {
        return 768;
    }
}


function mm_upload() {
    flag=0;
    for (i=0; i<6; i++) {
        el = document.mm_upload_fm.upfile[i].value;
        if (el != '') { flag=1; }
    }

    if (!flag) {
        var umsg = mShowMessage(12);
        alert(umsg);
        return false;
    } else {
        return true;
    }
}


function mm_opendir(reldir, ex) {
    //spec = oldficon.getAttribute("spec");
    spec = document.getElementById('sfspec').value;
    if (spec.indexOf("d")>0) {
        if (ex) { 
            reldir = reldir + '/' +fname; 
        }
        window.location.href="index2.php?option=com_media&reldir="+reldir;
    } else {
        mm_todownload();
    }
}


function mm_thumbnail(cview) {
    window.location.href="index2.php?option=com_media&reldir="+document.adminForm.reldir.value+"&vthumbs="+cview;
}


function mm_todownload() {
    document.getElementById('thestatus').innerHTML = mShowMessage(17);
}


function mm_isValInteger(s){
    if(isNaN(parseInt(s))) {
        return false;
    } else {
        return (s>0) ? true : false;
    }
}


function mm_prepare_watermark() {
    spec = document.getElementById('sfspec').value;
    if (spec.indexOf("e")>0) {
        reldir = document.getElementById('reldir').value;
        file = document.getElementById('sfname').value;

	   var winl = (screen.width - 600) / 2;
	   var wint = (screen.height - 400) / 2;
	   winprops = 'height=400,width=600,top='+wint+',left='+winl+',scrollbars=yes,resizable';
	   mypage = 'index3.php?option=com_media&task=prewatermark&reldir='+reldir+'&file='+file;
	   win = window.open(mypage, 'WaterMark', winprops)
	   if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
    } else {
        alert('This is not a valid image file!');
    }
}

