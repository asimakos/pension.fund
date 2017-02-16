<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ioannis Sannos
* @ Translator URL: http://www.elxis.org
* # Translator E-mail: info@elxis.org
* @ Description: English language for Updiag tool (hashes help)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

?>

<p align="justify">A hash is a unique footprint of a file. This footprint changes if the file is even modified by adding a space. 
This way we can determine if the files that consist an Elxis installation are intact or if we missed 
updating some files, after an update/patch. Hashes will also help us restore an Elxis site after a hacker 
attack or anything else that may affect our Elxis filesystem. In Elxis we use a special way of calculating MD5 hashes. 
So, for each Elxis file there are 2 different hashes. If the first hash's check fails, then the check is also 
performed on the second. If the second file's hash also fails, then Elxis decides that this file has been modified.</p>

<p align="justify">For each Elxis version there are 3 different hash files a <b>normal</b> (ideal for functional sites), an  
<b>extended</b> (ideal for sites right after a clean Elxis installation) and a <b>full</b> (only useful for 
special purposes). <u>You should use the normal hash file against functional online sites.</u> 
<b>Elxis Team</b> is the only authority authorized to produce these hash files. Do not use hash files from 
unauthorized resources. Do not manually modify or rename hash files. You can download hash files for your 
Elxis version from the <a href="http://www.elxis.org" target="blank">elxis.org</a> website.</p>

<p align="justify">To install a hash file just upload it in the hashes directory (/administrator/tool/updiag/data/hashes). 
You can perform a filesystem integrity check at any time, against any installed hash file that matches your 
Elxis version by clicking the "Execute" button.</p>
