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
* @ Description: Frech language for Defender tool
*@ Translation by Zepelin57 - elxis-france.com
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );
DEFINE ('_DEFL_CONFIG', 'Configuration de Elxis Defender');
DEFINE ('_DEFL_CONFPERMSUCC', 'Les permissions sur le fichier de configuration de Defender ont été mis avec succès à');
DEFINE ('_DEFL_CONFPERMNO', 'Impossible de mettre à modifiable le fichier de configuration de Defender');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Les permissions du répertoire des logs de Defender ont été mis avec succès à');
DEFINE ('_DEFL_LOGSPERMNO', 'Impossible de mettre à modifiable le répertoire des logs de Defender');
DEFINE ('_DEFL_ENABLEDESC', 'Activation ou pas de Defender (soyez sur que le répertoire /administrator/tools/defender/logs soit mis à modifiable)');
DEFINE ('_DEFL_PROTVARS', 'Variables protégées');
DEFINE ('_DEFL_PROTVARSD', 'Sélectionnez un type de variables a protéger (par défaut: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Log des Attaques');
DEFINE ('_DEFL_LOGATTACKSD', 'Si activé, Defender créera un fichier log contenant chaque attaque');
DEFINE ('_DEFL_MAILALERT', 'EMail pour les Alertes');
DEFINE ('_DEFL_MAILALERTD', 'Si activé, Defender vous enverra un Email pour chaque attaque');
DEFINE ('_DEFL_MAILADDR', 'Adresse email de Notification');
DEFINE ('_DEFL_SITEOFFFOR', 'Site Hors-Ligne pour');
DEFINE ('_DEFL_SECONDS', 'secondes');
DEFINE ('_DEFL_SITEOFFD', 'Après une attaque le site sera hors-ligne pendant X secondes. 0 pour désactiver');
DEFINE ('_DEFL_BLOCKIP', 'Bloquage des IP');
DEFINE ('_DEFL_BLOCKIPD', 'Bloquez l\'adresse IP de l\'attaquant. Notez que Defender bloquera tout le monde et le considérera comme attaquant, même vous!');
DEFINE ('_DEFL_FILTERS', 'Filtres');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Defender est inutile sans filtres.</b><br />
	Pour ajouter un nouveau filtre, saisissez un mot ou une expression que vous ne voulez pas filtrer pour l\'ajoutez dans le champ, puis cliquez sur<b>Ajouter</b>.<br />
	Ne vous donnez pas la peine d\'écrire en capitale ou en petites capitales.<br />
	Cliquez sur <b>DEL</b> pour supprimer un filtre de la Liste.<br />
	Si vous êtes familiarisé avec le <b>mod_Security</b> gardez à l\'esprit que Elxis Defender fonctionne plus ou moins de la même façon, 
	quand vous ajoutez des filtres.<br />
	Quand vous aveez terminé, cliquez sur <b>Save</b> pour sauvegarder la configuration et les filtres de Defender.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Temps de Latence');
DEFINE ('_DEFL_SLOWDOWN', 'L\'utilisation de Defender fera tourner Elxis plus lentement. 
	Ajouter trop de filtres peut augmenter le temps d\'exécution des codes php. Nous vous conseillons de ne pas ajouter plus de 15 filtres mais 
	nous vous invitons aussi à expérimenter le nombres de filtres car cela dépend et du site web et du serveur sur lequel Elxis est hébergé. 
	Ne pas hésiter à demander de l\'aide à si vous rencontrez des difficultés. 
	Notre laboratoire de tests a rencontré des temps de latence de l\'ordre de <b>0.1 à 27 millisecondes</b> selon le nombre de filtres (de 10 jusqu\'à 30) 
	et des variables que Defender devait négocier (pour une navigation normale, pour soumettre de grand article via les méthodes POST ou GET).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Exemple de Filtres');
DEFINE ('_DEFL_DEFCONFIS', 'Le fichier configuration de Defender est');
DEFINE ('_DEFL_DEFLOGSIS', 'Le répertoire des logs de Defender est');
DEFINE ('_DEFL_MAKEWRITE', 'Doit être modifiable');
DEFINE ('_DEFL_CONFSAVESUCC', 'La configuration de Defender a été sauvegardée avec succès!');
DEFINE ('_DEFL_CONFSAVENO', 'Impossible de sauvegarder le fichier de configuration de Defender!');
DEFINE ('_DEFL_ERRONEFILT', 'Erreur: Vous devez ajouter au moins un filtre!');
DEFINE ('_DEFL_ENCKEY', 'Clé d\'Encryptation');
DEFINE ('_DEFL_ENCKEYD', 'Utiliser des information cryptées. La longueur du mot clé doit être comprise entre 8 et 32 caractères. Effacer toute information enregistrée avant de changer la clé de chiffrement!');
DEFINE ('_DEFL_ERRENCKEY', 'Erreur: La longueur du mot clé doit être comprise entre 8 et 32 caractères');
DEFINE ('_DEFL_ENABLEDEF', 'Activer Defender');
DEFINE ('_DEFL_DISABLEDEF', 'Désactiver Defender');
DEFINE ('_DEFL_VIEWLOGS', 'Afficher les Logs');
DEFINE ('_DEFL_CLEARLOGS', 'Nettoyer les Logs');
DEFINE ('_DEFL_VIEWBLOCK', 'Afficher les IP bloquées');
DEFINE ('_DEFL_CLEARBLOCK', 'Nettoyer les IP bloquées');
DEFINE ('_DEFL_DEFENDER', 'Elxis Defender');
DEFINE ('_DEFL_LOGSCLEARED', 'Logs purgés');
DEFINE ('_DEFL_CNOTCLLOGS', 'Impossible de purger les logs. Soyez sur que le fichier soit modifiable.');
DEFINE ('_DEFL_BLOCKCLEARED', 'Toutes les adresses IP ont été supprimées avec succès.');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Impossible de purger les adresses IP bloquées. Soyez sur que le fichier soit modifiable.');
DEFINE ('_DEFL_SUBMITALERT', 'Attention, soumettre des filtres pendant que Defender est activé, sera considéré comme une attaque! Veuillez d\'abord le désactiver, procédez au changements puis réactivez le.');
DEFINE ('_DEFL_GEOLOCATE', 'Geolocalisation');
DEFINE ('_DEFL_PERMSUCC', 'Permissions changées à');
DEFINE ('_DEFL_PERMFAIL', 'Impossible de changer les permissions de');
DEFINE ('_DEFL_ADDIP', 'Ajouter une IP');
DEFINE ('_DEFL_DELETEIP', 'Supprimer une IP');
DEFINE ('_DEFL_BLOCKEDIPS', 'IP bloquées');
DEFINE ('_DEFL_IPRANGES', 'Gamme d\'IP');
DEFINE ('_DEFL_ADDRANGE', 'Ajouter une plage d\'adresse IP');
DEFINE ('_DEFL_DELRANGE', 'Supprimer une plage d\'adresse IP');
DEFINE ('_DEFL_RANGEHELP', 'Pour bloquer un réseau entier, un FAI ou même un pays, Defender vous donne 
la possibilité d\'ajouter une plage d\'adresses IP. Chaque plage est constituée de 2 parties séparées par un underscore (_). La première partie 
est l\'adresse IP de départ et la seconde la dernière adresse ip. Defender bloquera chaque adresse comprise entre ces 2 valeurs.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Exemples d\'Usage');
DEFINE ('_DEFL_BLOCKFROM', 'bloquera les IP de');
DEFINE ('_DEFL_BLOCKTO', 'à');
DEFINE ('_DEFL_ALLOWIPS', 'Adresse IP allouée');
DEFINE ('_DEFL_ALLOWIPSD', 'Si activé, vous serez capable de mettre les adresses IP à qui auront la permission d\'accéder à la partie-public et/ou à l\'administration du site');
DEFINE ('_DEFL_FRONTBACK', 'Partie-Public et Administration.');
DEFINE ('_DEFL_ALLOWDIS', 'L\'allocation d\'adresse IP est désactivé');
DEFINE ('_DEFL_ONLACCADM', 'Seuls les adresses IP ci-dessous ont accès à l\'Administration');
DEFINE ('_DEFL_ONLACCSAD', 'Seuls les adresses IP ci-dessous ont accès à la partie-public et l\'Administration');

?>
