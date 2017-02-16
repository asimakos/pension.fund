<?php 

/*
 * phpGACL - Generic Access Control List
 * Copyright (C) 2002,2003 Mike Benoit
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please join the
 * phpGACL mailing list. http://sourceforge.net/mail/?group_id=57103
 *
 * You may contact the author of phpGACL by e-mail at:
 * ipso@snappymail.ca
 *
 * The latest version of phpGACL can be obtained from:
 * http://phpgacl.sourceforge.net/
 *
 */

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// NOTE, this is a temporary solution until phpGACL libraries are fully implemented

/* -- Code to manually add a group to the ARO Groups
SET @parent_name = 'Registered';
SET @new_name = 'Support';

-- Select the parent node to insert after
SELECT @ins_id := group_id, @ins_lft := lft, @ins_rgt := rgt
FROM mos_core_acl_aro_groups
WHERE name = @parent_name;

SELECT @new_id := MAX(group_id) + 1 FROM mos_core_acl_aro_groups;

-- Make room for the new node
UPDATE mos_core_acl_aro_groups SET rgt=rgt+2 WHERE rgt>=@ins_rgt;
UPDATE mos_core_acl_aro_groups SET lft=lft+2 WHERE lft>@ins_rgt;

-- Insert the new node
INSERT INTO mos_core_acl_aro_groups (group_id,parent_id,name,lft,rgt)
VALUES (@new_id,@ins_id,@new_name,@ins_rgt,@ins_rgt+1);
*/

class gacl {

	// --- Private properties ---

	/*
	 * Enable Debug output.
	 */	
	public $_debug = FALSE; //DEFAULT: FALSE

	/*
	 * Database configuration.
	 */
	public $db=null;
	public $_db_table_prefix = '#__core_acl_';

	/*
	 * NOTE: 	This cache must be manually cleaned each time ACL's are modified.
	 * 		Alternatively you could wait for the cache to expire.
	 */
	public $_caching = FALSE;
	public $_force_cache_expire = TRUE;

	// --- Fudge properties
	public $acl=null;
	public $acl_count=0;

	/*
	* Constructor
	*/
	public function __construct($db=null) {
		global $database;

		$this->db = $db ? $db : $database;

		// ARO value is currently the user type,
		// this changes to user id in proper implementation
		// No hierarchial inheritance so have to do that the long way
        $this->acl = array();

        //load access lists
        $this->db->setQuery("SELECT * FROM #__core_acl_access_lists");
        $rows = $this->db->loadObjectList();
        if ($this->db->getErrorNum()) {
            echo $this->db->stderr();
            return;
        }
        $count = count( $rows );

        for ( $i = 0; $i < $count; $i++ ) {
            $row = &$rows[$i];
            $this->_mos_add_acl( $row->aco_section, $row->aco_value, $row->aro_section, $row->aro_value, $row->axo_section, $row->axo_value );
        }
		$this->acl_count = count( $this->acl );
	}

	/*
		This is a temporary function to allow 3PD's to add basic ACL checks for their
		modules and components.  NOTE: this information will be compiled in the db
		in future versions
	*/
	function _mos_add_acl( $aco_section_value, $aco_value,
		$aro_section_value, $aro_value, $axo_section_value=NULL, $axo_value=NULL ) {

		$this->acl[] = array( $aco_section_value, $aco_value, $aro_section_value, $aro_value, $axo_section_value, $axo_value );
		$this->acl_count = count( $this->acl );
	}

	/*======================================================================*\
		Function:   $gacl_api->debug_text()
		Purpose:    Prints debug text if debug is enabled.
	\*======================================================================*/
	function debug_text($text) {

		if ($this->_debug) {
			echo "$text<br>\n";
		}

		return true;
	}

	/*======================================================================*\
		Function:   $gacl_api->debug_db()
		Purpose:    Prints database debug text if debug is enabled.
	\*======================================================================*/
	function debug_db($function_name = '') {
		if ($function_name != '') {
			$function_name .= ' (): ';
		}

		return $this->debug_text ($function_name .'database error: '. $this->db->getErrorMsg() .' ('. $this->db->getErrorNum() .')');
	}

	/*======================================================================*\
		Function:   acl_check()
		Purpose:	Function that wraps the actual acl_query() function.
						It is simply here to return TRUE/FALSE accordingly.
	\*======================================================================*/
	function acl_check( $aco_section_value, $aco_value,
		$aro_section_value, $aro_value, $axo_section_value=NULL, $axo_value=NULL ) {

		$acl_result = 0;
		for ($i=0; $i < $this->acl_count; $i++) {
			if (strcasecmp( $aco_section_value, $this->acl[$i][0] ) == 0) {
				if (strcasecmp( $aco_value, $this->acl[$i][1] ) == 0) {
					if (strcasecmp( $aro_section_value, $this->acl[$i][2] ) == 0) {
						if (strcasecmp( $aro_value, $this->acl[$i][3] ) == 0) {
							if (strcasecmp( $axo_section_value, $this->acl[$i][4] ) == 0) {
								if (strcasecmp( $axo_value, $this->acl[$i][5] ) == 0) {
									$acl_result = 1;
									break;
								}
							}
						}
					}
				}
			}
		}
		return $acl_result;
	}

}

?>
