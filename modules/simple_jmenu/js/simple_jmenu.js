
/**
*	This function expands or collapses the given submenu
*
*	\param	item_id	The DOM id of the subsection to be toggled
*/	
function toggleMenu(item_id) {
	// Get the handle to the item
	var section = document.getElementById(item_id);
	// Get the handle to the parent of the item
	var parent_section = document.getElementById('parent_' + item_id);
	// Make sure that this section should be toggled
	if (parent_section.className != 'jmenu_section_image_nosub') {
		// Toggle the item
		if (section.style.display != 'none') {
			// Hide the section
			section.style.display = 'none';
			// Show the plus image
			parent_section.className = 'jmenu_section_image_contracted';
		}	else {
			// Show the section
			section.style.display = '';
			// Show the minus image
			parent_section.className = 'jmenu_section_image_expanded';
		}
	}
}