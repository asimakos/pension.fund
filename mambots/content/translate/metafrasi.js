/*
Translate bot by Ioannis Sannos (datahell)
Copyright (C) 2006-2010 Elxis.org. All rights reserved.
link: http://www.elxis.org
license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
Elxis CMS is a Free Software
*/


/* TRANSLATE BOT LANGUAGE STRINGS */
function mtflang(idx, lang) {
	if (lang == 'greek') {
		var mtflang = new Array('Μετάφραση σε...', 'Κλείσιμο', 'επιλέξτε γλώσσα', 'Άκυρο άρθρο', 'Παρακαλώ περιμένετε...');
	} else if (lang == 'french') { 
		var mtflang = new Array('Traduire en...', 'Fermer', 'sélection de la langue', 'Article Blancs', 'Sil vous plaît patienter...');
	} else if (lang == 'german') {
		var mtflang = new Array('Übersetzen in...', 'Schließen', 'wählen Sie die Sprache', 'Ungültige Artikel', 'Bitte warten...');
	} else if (lang == 'italian') {
		var mtflang = new Array('Tradurre in...', 'Close', 'selezionare la lingua', 'Illegittimo l art', 'Attendere prego...');
	} else if (lang == 'spanish') {
		var mtflang = new Array('Traducir al...', 'Cerrar', 'seleccionar el idioma', 'Invalidez del artículo', 'Espere por favor...');
	} else if (lang == 'czech') {
		var mtflang = new Array('Přeložit do...', 'Zavřít', 'vybrat jazyk', 'Neplatný článku', 'Čekejte prosím...');
	} else if (lang == 'turkish') {
		var mtflang = new Array('Translate içine...', 'Yakın', 'seçmek dil', 'Geçersiz yazı', 'Lütfen bekleyin...');
	} else if (lang == 'russian') {
		var mtflang = new Array('Перевести на...', 'Закрыть', 'выберите язык', 'Неверный статьи', 'Пожалуйста, подождите...');
	} else if (lang == 'serbian') {
		var mtflang = new Array('Преведи на...', 'Затвори', 'изаберите језик', 'Неважећи чланак', 'Молимо Вас да сачекате...');
	} else if (lang == 'portuguese') {
		var mtflang = new Array('Traduzir para...', 'Fechar', 'Selecione o idioma', 'artigo inválido', 'Aguarde...');
	} else if (lang == 'chinese') {
		var mtflang = new Array('翻译成...', '关闭。', '选择语言。', '无效的文章。', '请稍候...');
	} else if (lang == 'chinese_simplified') {
		var mtflang = new Array('翻译成...', '关闭。', '选择语言。', '无效的文章。', '请稍候...');
	} else if (lang == 'chinese_traditional') {
		var mtflang = new Array('翻译成...', '关闭。', '选择语言。', '无效的文章。', '请稍候...');
	} else if (lang == 'latvian') {
		var mtflang = new Array('Pārvērst...', 'Aizvērt', 'izvēlieties valodu', 'Nederīgs rakstu', 'Lūdzu uzgaidiet...');
	} else if (lang == 'dutch') {
		var mtflang = new Array('Vertaal naar...', 'Sluiten', 'Selecteer de gewenste taal', 'Ongeldige artikel', 'Even geduld aub...');
	} else if (lang == 'hungarian') {
		var mtflang = new Array('Lefordítani...', 'Közel', 'Válasszon nyelvet', 'Érvénytelen a cikk', 'Kérem, várjon...');
	} else if (lang == 'polish') {
		var mtflang = new Array('Przekładają się na...', 'Zamknij', 'Wybierz język', 'Nieprawidłowy artykułu', 'Proszę czekać...');
	} else if (lang == 'bulgarian') {
		var mtflang = new Array('Преведете на...', 'Затвори', 'Избор на език', 'Невалидна статия', 'Моля, изчакайте...');
	} else {
		var mtflang = new Array('Translate into...', 'Close', 'select language', 'Invalid article', 'Please wait...');
	}

	if (mtflang[idx] != undefined) {
		return mtflang[idx]
	} else {
		return '';
	}
}

function mtfajaxobj() {
	if (window.XMLHttpRequest) { return new XMLHttpRequest(); }
	if (window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP"); }
	return null;
}
var mtfhttp = mtfajaxobj();

/* FIND ICON'S POSITION */
function findPosition(oElement) {
	var x2 = 0;
	var y2 = 0;
	var width = oElement.offsetWidth;
	var height = oElement.offsetHeight;
	if ( typeof( oElement.offsetParent ) != 'undefined') {
		for( var posX = 0, posY = 0; oElement; oElement = oElement.offsetParent ) {
			posX += oElement.offsetLeft;
			posY += oElement.offsetTop;
		}
		x2 = posX + width;
		y2 = posY + height;
    	return [ posX, posY ,x2, y2];
	} else{
		x2 = oElement.x + width;
		y2 = oElement.y + height;
		return [ oElement.x, oElement.y, x2, y2];
	}
}


/* UN-POP TRANSLATION WIDJET */
function metafrasiUnpop(elid) {
	var body = document.getElementsByTagName('body')[0];
	if (document.getElementById('metafrasi'+elid)) {
		body.removeChild(document.getElementById('metafrasi'+elid));
	}
}


/* ALL AVAILABLE LANGUAGES FOR TRANSLATION */
function metafrasiAllLangs() {
	var glangs = new Array('afrikanns','albanian','amharic','arabic','armenian','azeri','basque','belarusian','bengali', 
	'bihari','bulgarian', 'burmese','catalan', 'cherokee','chinese','chinese_simplified', 'chinese_traditional','croatian', 
	'czech','danish','dhivehi','dutch','english','esperanto','estonian','filipino','finnish', 'french', 'galician','georgian', 
	'german','greek','guarani','gujarati','hebrew','hindi','hungarian','icelandic','indonesian', 'inuktitut', 'irish','italian', 
	'japanese','kannada','kazakh', 'khmer','korean','kurdish','kyrgyz','laothian','latvian','lithuanian', 'malay', 'malayalam',
	 'maltese','marathi','mongolian','nepali','norwegian','oriya','pashto','persian', 'polish','portuguese','punjabi','romanian',
	 'russian','sanskrit','serbian','sindhi','sinhalese', 'fyrom','slovak', 'slovenian','spanish','swahili', 'swedish','tajik',
	 'tamil','tagalog','telugu','thai','tibetan', 'turkish','ukrainian','urdu','uzbek','uighur','vietnamese','welsh', 'yiddish');
	 return glangs;
}

/* POP TRANSLATION WIDJET */
function metafrasiPop(elid, fromlng, elxlang, livesite) {
	elid = parseInt(elid);
	if (elid < 1) { alert(''+mtflang(3, elxlang)+''); return false; }
	if (!document.getElementById('elxisarticle'+elid)) { alert(''+mtflang(3, elxlang)+''); return false; }
	if (mtfhttp == null) {
		alert ("Your browser does not support XML HTTP Request");
		return false;
	}

	var oElement = document.getElementById('mtf'+elid);
	var position = findPosition(oElement);
	var body = document.getElementsByTagName('body')[0];
	if (document.getElementById('metafrasi'+elid)) {
		body.removeChild(document.getElementById('metafrasi'+elid));
	}

    var a_top = position[1] + oElement.offsetHeight + 5;
    var a_left = position[0] - 120;
    if (a_left < 10) { a_left = 10; }

	var box = document.createElement('DIV');
	box.setAttribute('id', 'metafrasi'+elid);
	box.setAttribute('class', 'mtfbox');
	box.style.display = 'block';
	box.style.position = 'absolute';
	box.style.zIndex = 1000;
	box.style.top = a_top+'px';
	box.style.left = a_left+'px';

	var glangs = metafrasiAllLangs();

	var txtlang = '';
	var txt = '<div class="mtftop">'+mtflang(0, elxlang);
	txt += '<a href="javascript:void(null);" class="mtfclose" title="'+mtflang(1, elxlang)+'" onclick="metafrasiUnpop('+elid+')">X</a>';
	txt += '</div>';
	txt += '<div style="margin: 0; padding: 0 2px;">';
	txt += '<select id="mtftolng'+elid+'" name="tolng" class="mtfselect" dir="ltr" onchange="metafrasiDo('+elid+', \''+fromlng+'\', \''+elxlang+'\', \''+livesite+'\')">';
	txt += '<option value="" selected="selected">- '+mtflang(2, elxlang)+' -</option>';
	for (i=0; i<glangs.length; i++) {
		txtlang = glangs[i].substr(0, 1).toUpperCase() + glangs[i].substr(1);
		txt += '<option value="'+glangs[i]+'">'+txtlang+'</option>';
	}
	txt += '</select>';
	txt += '</div>';
	txt += '<div class="mtfbottom">powered by <a href="http://www.elxis.org/" class="mtfpowerby">Elxis</a> + <a href="http://www.google.com/" class="mtfpowerby">Google</a></div>';
	box.innerHTML = txt;
	body.appendChild(box);
}


/* SET TRANSLATION BOX CONTENTS */
function mtfboxContents(elid, contents, elxlang) {
	var box = document.getElementById('metafrasi'+elid);
	var txt = '<div class="mtftop">'+mtflang(0, elxlang);
	txt += '<a href="javascript:void(null);" class="mtfclose" title="'+mtflang(1, elxlang)+'" onclick="metafrasiUnpop('+elid+')">X</a>';
	txt += '</div>';
	txt += '<div style="margin: 0; padding: 0 2px;">';
	txt += contents;
	txt += '</div>';
	txt += '<div class="mtfbottom">powered by <a href="http://www.elxis.org/" class="mtfpowerby">Elxis</a> + <a href="http://www.google.com/" class="mtfpowerby">Google</a></div>';
	box.innerHTML = txt;
}


/* DO TRANSLATE TEXT */
function metafrasiDo(elid, fromlng, elxlang, livesite) {
	if (!document.getElementById('mtftolng'+elid)) { return false; }
	var toObj = document.getElementById('mtftolng'+elid);
	var tolng = toObj.options[toObj.selectedIndex].value;
	if (tolng == '') { return false; }

	var contents = mtflang(4, elxlang);
	mtfboxContents(elid, contents, elxlang);

    try {
    	var rnd = Math.random();
    	mtfhttp.open("GET", livesite+'/mambots/content/translate/do.php?artid='+elid+'&fromlang='+fromlng+'&tolang='+tolng+'&rnd='+rnd, true);
        mtfhttp.setRequestHeader('Content-Type', 'text/plain');
        mtfhttp.setRequestHeader('charset', 'utf-8');
		mtfhttp.onreadystatechange = function () {
			if (mtfhttp.readyState == 4) {
				if (mtfhttp.status == 200) {
        			var reply = mtfhttp.responseText;
					var update = new Array();
					update = reply.split(':');
					if (update[0] == 'ERROR') {
						mtfboxContents(elid, update[1], elxlang);
					} else {
						metafrasiUnpop(elid);
						document.getElementById('elxisarticle'+elid).innerHTML = reply;						
					}
				}
			}
		};
		mtfhttp.send(null);
    }
    catch(e){}
    finally{}
}