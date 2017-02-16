// =======================
// Elxis Logout Ajax (Sack and Prototype)
// Copyright: (C) 200-2008 Elxis.org. All rights reserved
// Author: Ioannis Sannos (datahell)
// E-mail:  datahell@elxis.org
// License: GNU/GPL
//=======================

function showLightBox(lbox) {
    $('elx_overlay').show();
    centerBox(lbox);
    loadLogoutBox(lbox);
    return false;
}

function hideLightBox(lbox){
    $(lbox).hide();
    $('elx_overlay').hide();
    return false;
}

function centerBox(element){
    try{
        element = $(element);
    }catch(e){
        return;
    }

    var my_width  = 0;
    var my_height = 0;
    if ( typeof( window.innerWidth ) == 'number' ){
        my_width  = window.innerWidth;
        my_height = window.innerHeight;
    }else if ( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ){
        my_width  = document.documentElement.clientWidth;
        my_height = document.documentElement.clientHeight;
    }
    else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ){
        my_width  = document.body.clientWidth;
        my_height = document.body.clientHeight;
    }

    element.style.position = 'absolute';
    element.style.zIndex   = 99;

    var scrollY = 0;
    if ( document.documentElement && document.documentElement.scrollTop ){
        scrollY = document.documentElement.scrollTop;
    }else if ( document.body && document.body.scrollTop ){
        scrollY = document.body.scrollTop;
    }else if ( window.pageYOffset ){
        scrollY = window.pageYOffset;
    }else if ( window.scrollY ){
        scrollY = window.scrollY;
    }

    var elementDimensions = Element.getDimensions(element);
    var setX = ( my_width  - elementDimensions.width  ) / 2;
    var setY = ( my_height - elementDimensions.height ) / 2 + scrollY;

    setX = ( setX > 0 ) ? setX : 0;
    setY = ( setY > 0 ) ? setY : 0;

    element.style.left = setX + "px";
    element.style.top  = setY + "px";    
    element.style.display  = 'block';
}


var loajax = new sack();

function whenLoadingLO(){
	var e = document.getElementById(loajax.element);
	e.innerHTML = "<br /><br /><br /><br /><img src='images/loading_black.gif' border='0' />";
}

function whenLoadedLO(){
	var e = document.getElementById(loajax.element);
	e.innerHTML = "<br /><br /><br /><br /><img src='images/loading_black.gif' border='0' />";
}

function whenInteractiveLO(){
	var e = document.getElementById(loajax.element);
	e.innerHTML = "<br /><br /><br /><br /><img src='images/loading_black.gif' border='0' />";
}

function loadLogoutBox(lbox){
	var e = document.getElementById(lbox);
	e.style.display = "";

    loajax.setVar("option", 'com_admin');
    loajax.setVar("task", 'promptlogout');

	loajax.requestFile = "index3.php";

	loajax.method = 'POST';
	loajax.element = lbox;
	loajax.onLoading = whenLoadingLO;
	loajax.onLoaded = whenLoadedLO;
	loajax.onInteractive = whenInteractiveLO;
	loajax.runAJAX();
}
