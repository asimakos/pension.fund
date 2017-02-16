// =======================
// Rename Acl Group using Ajax
// Copyright: (C) 2006-2008 Elxis.org. All rights reserved.
// Author: Ioannis Sannos
// E-mail:  datahell@elxis.org
//=======================

	var elxis_groups;
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
			ajax.requestFile = fileName + '?option=com_access&task=rename&rgid='+editObj.id.replace(/[^0-9]/g,'') + '&rname='+editObj.value;
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
		elxis_groups = document.getElementById('elxis_groups');
		var menuItems = elxis_groups.getElementsByTagName('DIV');	// Get an array of all menu items
		for(var no=0;no<menuItems.length;no++){
			var aTag = menuItems[no].getElementsByTagName('A')[0];

			if(aTag.id)numericId = aTag.id.replace(/[^0-9]/g,'');else numericId = (no+1);
			aTag.id = 'elxis_groupsNodeLink' + numericId;

			var input = document.createElement('INPUT');
			input.style.width = '200px';
			input.style.color = 'green';
			input.style.display='none';
			menuItems[no].insertBefore(input,aTag);
			input.id = 'elxis_groupsNodeInput' + numericId;
			input.onblur = hideEdit;
			menuItems[no].id = 'elxis_groupsNode' + numericId;
			aTag.onmousedown = initEditLabel;
		}

		document.documentElement.onmouseup = mouseUpEvent;
	}

	window.onload = initTree;