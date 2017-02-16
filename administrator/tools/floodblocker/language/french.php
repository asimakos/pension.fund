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
* @ Description: French language for FloodBlocker tool
*@ Translation by Zepelin57 - elxis-france.com
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );
DEFINE ('_FLOODL_CONFIG', 'Configuration de FloodBlocker');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Les permissions sur le fichier de configuration de FloodBlocker ont été mise avec succès à');
DEFINE ('_FLOODL_CONFPERMNO', 'Impossible de modifier le fichier de configuration de FloodBlocker');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Le répertoire des Logs de FloodBlocker a été mis avec succès à');
DEFINE ('_FLOODL_LOGSPERMNO', 'Impossible de modifier le répertoire des logs de FloodBlocker');
DEFINE ('_FLOODL_INVINTER', 'Intervale de tâche Cron Invalide!');
DEFINE ('_FLOODL_INVTIME', 'Temps dépassé pour les Logs Invalide!');
DEFINE ('_FLOODL_ONEPAIR', 'Vous devez donner une paire de temps d\'intervalle valide!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Le fichier de configuration de FloodBlocker a été sauvegardé avec succès!');
DEFINE ('_FLOODL_CONFSAVENO', 'Impossible de sauvegarder le fichier de configuration de FloodBlocker!');
DEFINE ('_FLOODL_ENABLEDESC', 'Activer ou pas la protection flood mais (soyez sur que le répertoire des logs /tools/floodblocker/logs soit modifiable avant de l\'activer.)');
DEFINE ('_FLOODL_CRONINT', 'Intervale des Crons');
DEFINE ('_FLOODL_CRONINTDESC', 'Intervale d\'exécution des tâches Crons en secondes. 1800 secs (30 mins) par défaut');
DEFINE ('_FLOODL_LOGSTIME', 'Limite de temps des Logs');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'Après combien de secondes considérez-vous le fichier logs comme ancien? Par défaut les fichiers seront considérés comme ancien après 7200 secs (2 heures)');
DEFINE ('_FLOODL_FLOODRULES', 'Règles du FloodBlocker');
DEFINE ('_FLOODL_INTSECS', 'Intervale (en secondes)');
DEFINE ('_FLOODL_LIMREQS', 'Limite (requêtes)');
DEFINE ('_FLOODL_FLOODCONFIS', 'Le fichier de configuration de FloodBlocker est');
DEFINE ('_FLOODL_FLOODLOGSIS', 'Le répertoire des logs de FloodBlocker est');
DEFINE ('_FLOODL_MAKEWRITE', 'Mettre à modifiable');
DEFINE ('_FLOODL_PAIRSDESC', 'Une association de {INTERVAL} => {LIMIT} , 
	ou de {LIMIT} sera un nombre de requêtes possibles durant cette espace temps {INTERVAL} en secondes.</br> 
	Utilisez autant de paires que vous souhaitez.<p> Indication des règles:<br>
	&nbsp; &nbsp; - règle 1: 10=>10 (maximum de 10 requêtes en 10 sec)<br>
	&nbsp; &nbsp; - règle 2: 60=>30 (maximum de 30 requêtes en 60 sec)<br>
	&nbsp; &nbsp; - règle 3: 300=>50 (maximum de 50 requêtes en 300 sec)<br>
	&nbsp; &nbsp; - règle 4: 3600=>200 (maximum de 200 requêtes en 1 heure)<br><br>
	6 Règles maximum');
DEFINE ('CX_LFLOODBD', 'FloodBlocker empêche les attaques de flood sur votre site Elxis.');

?>
