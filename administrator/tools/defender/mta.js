// ====== Mutliple Text Applicator =======
// Gregory Narain (c)2005
// http://sparkcasting.com
// If you use this code please keep this credit intact.
// A link or email would be nice, but is not required.
// Version 0.2 - June 15, 2005

// Thanks to Aaron Boodman, the youngpup
if (!Function.prototype.apply) {
  // Based on code from http://www.youngpup.net/
  Function.prototype.apply = function(object, parameters) {
    var parameterStrings = new Array();
    if (!object)     object = window;
    if (!parameters) parameters = new Array();
    
    for (var i = 0; i < parameters.length; i++)
      parameterStrings[i] = 'x[' + i + ']';
    
    object.__apply__ = this;
    var result = eval('obj.__apply__(' + 
      parameterStrings[i].join(', ') + ')');
    object.__apply__ = null;
    
    return result;
  }
}
// Modified slightly to NOT pass the object and method name on to apply()
function hitch(obj, methodName) {
    var args = [];
    for (var i = 2; i < arguments.length; i++) {
        args.push(arguments[i]);
    }

  return function() { obj[methodName].apply(obj, args); }
}

function getElementsByClass(className){
	var inc = 0
	var customcollection = [];
	var alltags = (document.all) ? document.all : document.getElementsByTagName("*");
	
	for (i=0; i<alltags.length; i++){
		if (alltags[i].className.indexOf(className)>=0)
		customcollection[inc++]=alltags[i]
	}
	
	return customcollection;
}

function getCustomAttribute(obj, attrib, def) {
	if (def == undefined) def = null;
	var val = ((!document.all && obj.hasAttribute(attrib)) || (document.all && obj[attrib] != undefined)) ? obj.getAttribute(attrib) : def;

	return val;
}

/**
 *   CONSTRUCTOR
 *   @param     varName   name of the JS variable that stores the MTA
 *	 @param		itemClass string indicating the class to apply to items
 *	 @param		delClass  string indicating the class to apply to delete buttons
 *	 @param		delClass  string indicating the class to apply to add button
 *
 *	 HISTORY:
 *		06/10/2005	Added support for max MTA- and Item-Level lengths.
 					To use, simply add maxlength or itemlength attributes to
 					  the element
**/
function MTA(varName, itemClass, delClass, addClass) {
	this.varName   = varName;
	this.mtas      = [];

	// Style properties
	this.itemClass = (itemClass) ? itemClass : '';
	this.delClass  = (delClass) ? delClass : '';
	this.addClass  = (addClass) ? addClass : '';

	this.init = function () {
		// Locate the items with the mta className
		var mtas = getElementsByClass('mta');

		for (var x=0; x<mtas.length; x++) {
			// Extract the id and custom attributes
			var mtaID    = mtas[x].id;
			
			this.mtas[mtaID] = [];
				var delim, maxLength, itemLength
				delim = this.mtas[mtaID].delim = getCustomAttribute(mtas[x],'delim',',');
				maxLength = this.mtas[mtaID].maxLength  = getCustomAttribute(mtas[x],'maxlength');
				itemLength = this.mtas[mtaID].itemLength = getCustomAttribute(mtas[x],'itemlength');
				
			// Locate the object
			var fld = document.getElementById(mtaID);
			
			// Hide the textarea
			fld.style.display = 'none';
		
			// Create the new text fields
			var list = document.createElement('ol');
			list.className = 'addList';
			list.id = 'mta_' + mtaID;
			list.delim = delim;

			/* BUG: Passing in 'newline' for \n arrays - How to fix? */
			if (delim == 'newline') delim = /\n/g;
			var vals = fld.value.split(delim);

			for (var y=0; y<vals.length; y++) {;
				list.appendChild(this.buildItem(vals[y],this.itemClass, itemLength));
			}
			// Append the list to the container
			fld.parentNode.insertBefore(list,fld);
		
			// Create the div to add a new entry
			var addDiv = document.createElement('div');
				addDiv.className  = 'addGroup';				

				// Create the status field for alerting errors, etc
				var addStatus = document.createElement('div');
					addStatus.id = 'mta_' + mtaID + '_addStatus';
					addStatus.className = 'mta_addStatus';

					addDiv.appendChild(addStatus);
									
                // Create the input field
                /*var addFld = document.createElement('input');
                	addFld.type = 'text';
                	addFld.id = 'mta_' + mtaID + '_add';
                	if (this.itemClass.length) addFld.className = this.itemClass;
                	if (itemLength != null) addFld.maxLength = this.maxItemLength;
					//addFld.onkeypress = function(e) { return hitch(this, 'quickAdd', this, e) };
                	addDiv.appendChild(addFld);	
                */
                addDiv.innerHTML  += '<input type="text" class="' + this.itemClass + '"' + ((itemLength != null) ? ' maxlength="' + itemLength + '"' : '') + '" id="mta_' + mtaID + '_' + 'add" onkeypress="return ' + this.varName + '.checkAddField(this,event)" />';

				var addBtn = document.createElement('input');
                	addBtn.type = 'button';
					addBtn.value = 'Add';
					if (this.addClass.length) addBtn.className = this.addClass;
					addBtn.onclick = hitch(this,'addItem',mtaID);
					
					addDiv.appendChild(addBtn);
				//addGroup.innerHTML += '<input type="button" value="Add" class="' + this.addClass + '" onClick="' + this.varName + '.addItem(\'' + id + '\',\'' + itemClass + '\')" />';
				
				fld.parentNode.insertBefore(addDiv,fld);
		}
	}

	/**
     *   Sets the innerHTML for the Add Status field
     *   @param     mtaID     object or string referring to the MTA
     *	 @param		status	  string (''|success|warning|error) indicating status
     *	 @param		html	  string to be inserted into the MTA
    **/
	this.setAddStatus = function(mtaID, status, html) {
		if (status == undefined) status = '';
		if (html == undefined) html = '';
		
		// Retrieve the status field
		stat = document.getElementById('mta_' + mtaID + '_addStatus')
		stat.innerHTML = html;
		stat.className = stat.className.split(' ')[0] + ' ' + status;
	}

	/**
     *   Tracks key presses on the addition field
     *   @param     fld     object for field that fired the event
     *	 @param		event	object for the event
     *	 @return    boolean 0 if enter key was pressed, 1 otherwise
     *
     *	 History:
     *		6/10/2005 Added support for MTA- and Item-Level length restrictions (GN)
    **/
	this.checkAddField = function(fld,event) {
		// Prepare variables and Collapse the event object
	   	var mtaID     = fld.id.split('_')[1];
		var key = (event.which) ? event.which : event.keyCode;
		var escapeKeys = {8:1,37:1,38:1,39:1,40:1,46:1}

		// If the key pressed was backspace (8), delete (46), left (37), right (39)
		if (escapeKeys[key]) {
			// If the key deletes, clear the status
			if (key == 8 || key ==46) this.setAddStatus(mtaID);
    		return true;
		} else {				
			// Check if the field is of the correct length
			// Determine how long the value is
	    	var mtaLength = document.getElementById(mtaID).value.length;
	
			// Check to make sure the limit hasn't been reached
	    	if (this.mtas[mtaID].maxLength != null && (mtaLength + ((this.mtas[mtaID].delim == 'newline') ? 1 : this.mtas[mtaID].delim.length) +  fld.value.length) > this.mtas[mtaID].maxLength) {
	    		this.setAddStatus(mtaID, 'warning', 'Sorry.  Your list is too long.');
	        	return false;
		        	
			// If the enter key was pressed
			} else if (key == 13 || key == 9) {
				if (fld.value.length) {
					this.setAddStatus(mtaID);
				 	fld.nextSibling.click();
				 } else {
				 	this.setAddStatus(mtaID, 'warning', 'Please type something first.');
				 }
				return false;            
	        
	        } else {
				this.setAddStatus(mtaID);
	    		return true;
			}
		}
	}
	
	/**
     *   Updates the original element's value
     *   @param     mta     object or string referring to the MTA
     *
     *	 History:
     *		6/15/2005 Fixed ID bug when using element IDs with _.  (Lucas Chan)
    **/
	this.updateMainValue = function(mta) {
		if (typeof(mta) == 'string') mta = document.getElementById('mta_' + mta);
		var id = mta.id.substr(mta.id.indexOf('_')+1);
	
		// Loop through to get the final value
		var f = [];
		for (var x=0; x<mta.childNodes.length; x++) {
			f[f.length] = mta.childNodes[x].childNodes[1].value;
		}
		document.getElementById(id).value = f.join((mta.delim == 'newline') ? '\n' : mta.delim);
	}

	/**
     *   Removes an item from the applicator
     *   @param     mta     string id of the MTA
    **/
	this.removeItem = function (item) {
		var mta = item.parentNode;
		item.parentNode.removeChild(item);

		// Update the value
		this.updateMainValue(mta);
	}

	/**
     *   Adds an item to the applicator
     *   @param     mtaID     string identifier for the MTA
    **/
	this.addItem = function(mtaID) {
		// Retrieve the mta
		var mta    = document.getElementById('mta_' + mtaID);
		var addFld = document.getElementById('mta_' + mtaID + '_add');

		// Add the item
		mta.appendChild(this.buildItem(addFld.value,this.itemClass));
	
		// Clear the item and focus
		addFld.value = '';
		addFld.focus();
	
		// Update the value
		this.updateMainValue(mta);
	}

	/**
     *   Constructs an list item
     *   @param     mta     string id of the MTA
     *	 @return	object	generated <li> item
    **/
	this.buildItem = function (val, itemClass) {
		var ipt   = document.createElement('input');
			ipt.type = 'text';
			ipt.value = val;
			if (this.maxItemLength != undefined && this.maxItemLength != null) ipt.maxLength = this.maxItemLength;
			if (itemClass) ipt.className = itemClass;
	
		var li    = document.createElement('li');
			li.innerHTML = '<input type="button" class="' + this.delClass + '" value="DEL" onBlur="' + this.varName + '.updateMainValue(this.parentNode.parentNode)" onClick="' + this.varName + '.removeItem(this.parentNode)" />';
			li.appendChild(ipt);

		return li;
	}
	
	// Init the object
	this.init();
}