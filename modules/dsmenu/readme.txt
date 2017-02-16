You must insert this piece of code into your templete's index.php just before this tag: </head>

<?php echo '<link href="'.$mainframe->getCfg('live_site').'/modules/dsmenu/dsmenu_h.css" rel="stylesheet" type="text/css" />'; ?>

or this, for vertical menu:

<?php echo '<link href="'.$mainframe->getCfg('live_site').'/modules/dsmenu/dsmenu_v.css" rel="stylesheet" type="text/css" />'; ?>

Have fun!
