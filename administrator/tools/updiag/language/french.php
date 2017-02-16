<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Zepelin57
* @translator URL: http://www.elxis-france.com
* @translator E-mail: info@elxis.org
* @description: French language file for Updiag
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );

class updiagLang {

	public $UPDATE = 'Mise à Jour';
	public $CHVERS = 'Vérifier votre Version';
	public $CNOTGETELXD = 'Impossible d\'obtenir des données de elxis.org';
	public $INVXML = 'Rapporter un fichier XML incorrect. Impossible d\'afficher les informations demandées.';
	public $SIZE = 'Taille';
	public $MORE = 'Plus';
	public $DOWNLOAD = 'Télécharger';
	public $INSELXVER = 'Version de Elxis Installée';
	public $CURRENT = 'Actuelle';
	public $OUTDATED = 'Dépassée!';
	public $NEWVERAV = 'Il y a une nouvelle version de Elxis disponnible. Veuillez mettre à jour votre installation de Elxis dès que possible.';
	public $CHPATCHES = 'Vérifier les patches';
	public $NOPATCHES = 'Il n\'y a pas de patches disponibles pour cette version de Elxis';
	public $PROSUPPORT = 'Support Professionnel';
	public $NEWS = 'Nouveautés';
	public $MAINTENANCE = 'Maintenance';
	public $REMOTEERR1 = 'Requêtes Invalides';
	public $REMOTEERR2 = 'Impossible d\'obtenir une liste des scripts';
	public $REMOTEERR3 = 'Aucuns scripts trouvés';
	public $REMOTEERR4 = 'Le fichier demandé est vide';
	public $REMOTEERR5 = 'Impossible d\'avoir une liste de fichiers corrompue';
	public $REMOTEERR6 = 'Pas de fichier corrompu trouvé';
	public $REMOTEERR7 = 'Impossible de télécharger le fichier demandé!';
	public $UNERROR = 'Erreur inconnu';
	public $PROVCODE = 'Fournit le code pour actualiser la version de Elxis';
	public $TOVERSION = 'à la version';
	public $INSTALLED = 'Installé';
	public $REQFEXISTS = 'Les fichiers demandés existent déjà!';
	public $FILDOWNSUC = 'Fichier téléchargé avec succès!';
	public $DFORRUNSCR = 'N\'oubliez pas d\'exécuter ce script au cas où vous souhaitez actualiser votre installation de Elxis.';
	public $CNOTCPDFIL = 'Impossible de copier le fichier téléchargé dans le répertoire de destination.';
	public $PLCHSCRPERM = 'Veuillez vérifier si le dossier /administrator/tools/updiag/data/scripts est modifiable';
	public $PLCHSCRPERM2 = 'euillez vérifier si le dossier /administrator/tools/updiag/data/hashes est modifiable';
	public $EXECUTE = 'Exécuter';
	public $SCRNOTEX = 'Le script demandé n\'existe pas!';
	public $FSCHECK = 'Vérifier les fichiers systèmes';
	public $HIDEHELP = 'Cacher l\'aide';
	public $NORMAL = 'Normal';
	public $EXTENDED = 'Etendu';
	public $FULL = 'Complet';
	public $NOHASHFOUND = 'Pas de fichier corrompu trouvé';
	public $INVHFILE = 'Fichier corrompu Invalide!';
	public $SHFELXVER = 'Le fichier corrompu sélectionné provient d\'une ancienne version de Elxis!';
	public $FNOTEXIST = 'Le fichier n\'existe pas';
	public $WARNING = 'Attention';
	public $FNEEDUP = 'Le fichier a besoin d\'être mis à jour';
	public $SITUP2D = 'Le site est à jour!';
	public $FOUND = 'Trouvé';
	public $OUTFUP = 'fichiers obsolétes. Veuillez les mettre à jour!';
	public $CHFINUS = 'Vérifiez si l\'état du site <b>%s</b> a été mis à jour';
	public $NEWRELEASES = 'Nouvelle version';
	public $NONEWREL = 'Il n\'y a pas de nouvelles versions';
	public $PRICE = 'Prix';
	public $LICENSE = 'Licence';
	public $SECURITY = 'Sécurité';
	public $INSTPATH = 'Chemin d\'Installation';
	public $CREDITS = 'Crédits';
	public $ALERT = 'Alerte';
	public $FSECALWA = 'Alertes et avertissements trouvés <b>%d</b>';
	public $ELXINPAS = 'Votre installation de Elxis a passé avec succès la vérification de sécurité.';
	public $HOME = 'Accueil';
	public $UPDSPAG = 'Centre Updiag';
	public $UPDWELC = 'Bienvenue sur <b>Updiag</b>, l\'outils de diagnostique et de Mise à Jour de Elxis.';
	public $STARTMORE = 'La plupart des fonctions de Updiag exige une connexion distante au site Web elxis.org. 
	Ainsi, vous devez avoir une connexion à l\'internet pour que ces fonctions puissent fonctionner. 
	Sélectionnez un élément du menu supérieur pour naviguer.';
	public $BASCHECKS = 'Vérification de Base <small>(cliquez sur l\'icône pour la lancer)</small>';
	public $FILEREMSUC = 'Fichier supprimé avec succès!';
	public $CNREMSFILE = 'Impossible de supprimer le fichier sélectionné! Veuillez vérifier vos droits.';
	public $HASHNOTEX = 'La requête pour le fichier corrompu n\'existe pas!';
	public $DNHASHFLS = 'Fichiers corrompus Téléchargés';
	public $BUY = 'Acheter';
	public $DOWNLTIME = 'Temps de Téléchargement';
	public $DOWNLSPEED = 'Vitesse de Téléchargement';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Les Aides sur les mises à jour de votre site, vous informe sur les nouvelles versions de Elxis, mais également les correctifs, et vous offre plus de sécurité et des tâches de diagnostic.');

?>