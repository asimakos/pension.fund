/* 
Component Media Watermark Javascript
Created by Ioannis Sannos (datahell)
Author URL: http://www.goup.gr
Author email: i.sannos@goup.gr
Copyright: GO UP Inc 2007-2008. All rights reserved.
License: GNU/GPL
Elxis CMS is a free software
*/


function mm_wmswitchtype(t) {
	tl = document.getElementById('istextdiv');
	il = document.getElementById('isimagediv');
	wm = document.getElementById('wmdiv');
	wmi = document.getElementById('wmidiv');
    if (t==1) {
        tl.style.display = 'none';
        wm.style.display = 'none';
        il.style.display = '';
        wmi.style.display = '';
    } else {
        il.style.display = 'none';
        wmi.style.display = 'none';
        tl.style.display = '';
        wm.style.display = '';
    }
}


function isInt(myNum) {
    var myMod = myNum % 1;
    if (myMod == 0) {
        return true;
    } else {
        return false;
    }
}


function mm_moveWatermark() {
    var x = document.getElementById('xaxis').value;
    var y = document.getElementById('yaxis').value;
    wm = document.getElementById('wmdiv');
    wmi = document.getElementById('wmidiv');

    if (isInt(x)) {
        wm.style.left = x+'px';
        wmi.style.left = x+'px';
    }
    if (isInt(y)) {
        wm.style.top = y+'px';
        wmi.style.top = y+'px';
    }
}


function mm_changeWatermark() {
    wm = document.getElementById('wmdiv');
    var wmtext = document.getElementById('wmtext').value;
    wm.innerHTML = wmtext;
}


function mm_sizeWatermark() {
    wm = document.getElementById('wmdiv');
    wmsel = document.getElementById('wmfontsize');

    var selectedItem = wmsel.selectedIndex;
    var selectedValue = wmsel.options[selectedItem].value;
    wm.style.fontSize = selectedValue+'px';
}


function mm_colorWatermark() {
    wm = document.getElementById('wmdiv');
    wmsel = document.getElementById('wmfontcolor');

    var selectedItem = wmsel.selectedIndex;
    var selectedValue = wmsel.options[selectedItem].value;
    wm.style.color = 'rgb('+selectedValue+')';
}


function mm_changeiWatermark() {
    wmi = document.getElementById('wmidiv');
    var wmimage = document.getElementById('wmimage').value;
    var dirurl = document.getElementById('dirurl').value;
    wmi.innerHTML = '<img src="'+dirurl+'/'+wmimage+'" border="0" id="wmimg" style="z-index: 30" />';
}


function mm_changeOpacity() {
    var wmtype = 'text';
    for (i=0;i<document.adminForm.textimg.length;i++) {
        if (document.adminForm.textimg[i].checked==true) {
            wmtype = document.adminForm.textimg[i].value;
            break;
        }
    }

    var wmdiv = document.getElementById('wmdiv');
    wmsel = document.getElementById('wmopacity');
    var selectedItem = wmsel.selectedIndex;
    var opac = wmsel.options[selectedItem].value;

    if (navigator.appName.indexOf("Netscape")!=-1 && parseInt(navigator.appVersion)>=5) {
        wmdiv.style.MozOpacity=opac/100;
        if ((wmtype == 'image') || (document.getElementById('wmimg') != null)) {
            document.getElementById('wmimg').style.MozOpacity=opac/100;
        }
    } else if (navigator.appName.indexOf("Microsoft")!= -1 && parseInt(navigator.appVersion)>=4) {
        wmdiv.filters.alpha.opacity=opac;
        if ((wmtype == 'image') || (document.getElementById('wmimg') != null)) {
            document.getElementById('wmimg').filters.alpha.opacity=opac;
        }
    }
}


function submitwmform(pressbutton){
    if (pressbutton=='wmsaveas') {
        var fold = document.adminForm.file.value;
        newname=window.prompt('Enter a new name:',fold);
        if (newname&&(newname!=fold)) {
            document.adminForm.fileas.value = newname;
        } else {
            alert('Please enter a valid new filename!');
            return false;
        }
    }

	document.adminForm.task.value=pressbutton;
	try {
		document.adminForm.onsubmit();
		}
	catch(e){}
	document.adminForm.submit();
}
