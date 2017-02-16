
//Animated Window- By Rizwan Chand (rizwanchand@hotmail.com)
//Modified by DD for NS compatibility
//Visit http://www.dynamicdrive.com for this script

function expandingWindow(website) {
    var windowprops='width=450,height=300,scrollbars=auto,status=no,resizable=no'
    var heightspeed = 3; // vertical scrolling speed (higher = slower)
    var widthspeed = 7;  // horizontal scrolling speed (higher = slower)
    var leftdist = 300;    // distance to left edge of window
    var topdist = 300;     // distance to top edge of window

    if (window.resizeTo&&navigator.userAgent.indexOf("Opera")==-1) {
        //var winwidth = window.screen.availWidth - leftdist;
        //var winheight = window.screen.availHeight - topdist;
        var winwidth = 450;
        var winheight = 300;
        
        var sizer = window.open("","","left=" + leftdist + ",top=" + topdist +","+ windowprops);
        for (sizeheight = 1; sizeheight < winheight; sizeheight += heightspeed)
        sizer.resizeTo("1", sizeheight);
        for (sizewidth = 1; sizewidth < winwidth; sizewidth += widthspeed)
        sizer.resizeTo(sizewidth, sizeheight);
        sizer.location = website;
    } else {
        window.open(website,'mywindow');
    }
}


function resetNewSection() {
	var el = document.getElementById('newsection');
	el.value = '';
}

function changevtype() {
	var el = document.getElementById('valuetype');
	var clayer = 'v' + el.value;
	document.getElementById('vTEXT').style.display = 'none';
	document.getElementById('vSTRING').style.display = 'none';
	document.getElementById('vURL').style.display = 'none';
	document.getElementById('vEMAIL').style.display = 'none';
	document.getElementById('vIMAGE').style.display = 'none';
	document.getElementById('vTIME').style.display = 'none';
	document.getElementById('vYESNO').style.display = 'none';
	document.getElementById('vINTEGER').style.display = 'none';
	document.getElementById('vDECIMAL').style.display = 'none';
	showLayer(clayer);
}
