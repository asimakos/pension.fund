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

<p align="justify">Hash је јединствени отисак фајла. Овај отисак се мења чак и ако је фајл измењен додавањем једног размака. 
На овај начин можемо да одредимо који су од фајлова који чине Elxis инсталацију остали нетакнути или које смо пропустили приликом ажурирања. Они нам такође помажу да поправимо Elxis сајт након напада 
хакера или било чега другог што утиче на Elxis систем. Elxis користи посебан начин калкулације MD5 hash-а. 
Зато, за сваки фајл који чини Elxis постоје два hash-а. Ако је прва провера неуспешна, иста провера ће се извршити и на другом. Уколико и други hash фајл не прође тест, тада Elxis одлучује да је фајл измењен.</p>

<p align="justify">За сваку Elxis верзију постоје три различита hash фајла: <b>нормални</b> (идеалан за сајтове који су већ у функцији),   
<b>проширени</b> (идеалан за тек инсталиране чисте Elxis инсталације), и <b>пун</b> (користан само за посебне намене). <u>Употребите нормални hash фајл на функционалним сајтовима.</u> 
<b>Elxis Team</b> једини има овлашћење за издавање hash фајлова. Не употребњавајте hash фајлове добијене 
из неауторизованих извора. DНемојте ручно мењати, или преименовати hash фајлове. Hash фајлове за своју 
Elxis верзију можете преузети са <a href="http://www.elxis.org" target="blank">elxis.org</a> сајта.</p>

<p align="justify">Да бисте инсталирали hash фајл, једноставно га додајте у hashes директоријум (/administrator/tool/updiag/data/hashes). 
Можете увек извршити проверу интегритета Вашег система, у односу на било који hash фајл који одговара вашој верзији  
Elxis-а, уколико једноставно кликнете дугме "Извршавање".</p>
