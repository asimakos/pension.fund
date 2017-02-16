// =======================
// Edit Ajax Tree
// Copyright: (C) 2006-2008 Elxis.org, All rights reserved.
// Author: Ioannis Sannos
// E-mail:  datahell@elxis.org
//=======================

	var elxis_tree;
	var fileName = 'index3.php';
	var timeoutEdit = 20;

	var ajax = new sack();

	var editCounter = -1;
	var editEl = false;

	function initEditLabel() {
		if(editEl)hideEdit();
		editCounter = 0;
		editEl = this;	// Referenc to a Tag
		startEditLabel();
	}

	function startEditLabel() {
		if(editCounter>=0 && editCounter<10){
			editCounter = editCounter + 1;
			setTimeout('startEditLabel()',timeoutEdit);
			return;
		}
		if(editCounter==10){
			var el = editEl.previousSibling;
			el.value = editEl.innerHTML;
			editEl.style.display='none';
			el.style.display='inline';
			el.select();
			return;
		}
	}

	function showUpdate() {
		document.getElementById('ajaxMessage').innerHTML = ajax.response;
	}

	function hideEdit() {
		var editObj = editEl.previousSibling;
		if(editObj.value.length>0){
			editEl.innerHTML = editObj.value;
			ajax.requestFile = fileName + '?option=content&task=edittree&itype='+editObj.itype.replace(/[^a-z]/g,'')  +'&updateNode='+editObj.id.replace(/[^0-9]/g,'') + '&newValue='+editObj.value;
			ajax.onCompletion = showUpdate;
			ajax.runAJAX();	
		}
		editEl.style.display='inline';
		editObj.style.display='none';
		editEl = false;
		editCounter=-1;
	}

	function mouseUpEvent() {
		editCounter=-1;
	}

	function initTree() {
		elxis_tree = document.getElementById('elxis_tree');
		var menuItems = elxis_tree.getElementsByTagName('LI');	// Get an array of all menu items
		for(var no=0;no<menuItems.length;no++){
			var aTag = menuItems[no].getElementsByTagName('A')[0];
			itype = aTag.id.replace(/[^a-z]/g,'');

			if(aTag.id)numericId = aTag.id.replace(/[^0-9]/g,'');else numericId = (no+1);
			aTag.id = 'elxis_treeNodeLink' + numericId;

			var input = document.createElement('INPUT');
			input.style.width = '200px';
			input.style.color = 'green';
			input.style.display='none';
			menuItems[no].insertBefore(input,aTag);
			input.id = 'elxis_treeNodeInput' + numericId;
			input.itype = itype + numericId;
			input.onblur = hideEdit;
			menuItems[no].id = 'elxis_treeNode' + numericId;
			menuItems[no].itype = itype + numericId;
			aTag.onmousedown = initEditLabel;
		}

		document.documentElement.onmouseup = mouseUpEvent;
	}

	window.onload = initTree;