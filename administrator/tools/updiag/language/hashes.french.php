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
* @ Description: French help language file for Updiag hashes
*@ Translation by Zepelin57 - elxis-france.com
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );

?>

<p align="justify">Une fonction de hachage est une empreinte de fichier. Cette empreinte vérifie les changements sur le fichier et si il a été modifié par ajout d'espace. 
De cette façon, nous pouvons déterminer si les fichiers qui composent Elxis sont intacts ou si il y a un manque après une 
mise à jour des fichiers, ou un correctif. Le fonction de hachage nous aidera aussi à rétablir un site Elxis après une attaque d'un hacker 
ou toute autre chose qui peut avoir une incidence sur votre système Elxis. Sur Elxis nous utilisons un mode de calcul de fonction de hachage MD5. 
Donc, pour chaque dossier Elxis il ya 2 sortes de fonction de hachage. Si la vérification sur la première fonction de hachage est un échec, un contrôle sera effectué 
sur le second. Si la seconde vérification du fichier échoue également, alors Elxis décidera que le fichier a été modifié.</p>

<p align="justify">Pour chaque version de Elxis il y a 3 fichiers différents un <b>normal</b> (idéal pour la fonctionnalité des sites), un  
<b>étendu</b> (idéal pour les droits du site après une nouvelle installation de Elxis) et un <b>complet</b> (uniquement utilisé pour 
des buts spéciaux). <u>Vous devez utiliser le fichier normal fonctionnel pour les sites en ligne.</u> 
<b>La Team Elxis</b> est la seule autorité habilitée à produire ces fichiers de fonction de hachage. N'utilisez pas les fichiers de fonction de hachage 
venant de personnes non autorisées. Ne pas modifier manuellement ou renommer les fichiers de fonction de hachage. Vous pouvez télécharger les fichiers de fonction de hachage 
pour la version de Elxis à partir du site web <a href="http://www.elxis.org" target="blank">elxis.org</a>.</p>

<p align="justify">Pour installer un fichier de fonction de hachage vous devez le transférer dans le répertoire fonction de hachage (/administrator/tool/updiag/data/hashes). 
Vous pouvez effectuer une vérification de l'intégrité des fichiers à tout moment, pour tous les fichiers de fonction de hachage installés et qui correspond à votre 
version de Elxis en cliquant sur le bouton "Executer".</p>
