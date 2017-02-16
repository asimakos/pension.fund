<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Vianney Zahner (Zepelin57)
* @link: http://www.elxis-france.com
* @email: info@elxis-france.com
* @description: French language for component Config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Site hors ligne';
	public $A_COMP_CONF_OFFMESSAGE = 'Message';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Message affiché lorsque le site est hors ligne/indisponible.';
	public $A_COMP_CONF_ERR_MESSAGE = 'Message d\'erreur du système';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Message affiché lorsque le site n\'arrive pas à se connecter à la base de données.';
	public $A_COMP_CONF_SITE_NAME = 'Nom du site';
	public $A_COMP_CONF_UN_LINKS = 'Afficher les liens non autorisés';
	public $A_COMP_CONF_UN_TIP = 'Si oui, affichera les liens vers le contenu, même si vous n\'êtes pas connecté. L\'utilisateur devra se connecter pour voir l\'article en entier.';
	public $A_COMP_CONF_USER_REG = 'Autoriser l\'enregistrement des utilisateurs';
	public $A_COMP_CONF_TIP_USER_REG = 'Si actif, ceci permet aux utilisateurs de s\'auto-enregistrer.';
	public $A_COMP_CONF_REQ_EMAIL = 'Email unique Requis';
	public $A_COMP_CONF_REQTIP = 'Si oui, les utilisateurs ne pourront pas utiliser deux fois la même adresse email';
	public $A_COMP_CONF_DEBUG = 'Débogage du Site';
	public $A_COMP_CONF_DEBTIP = 'Si oui, affiche un diagnostic et les erreurs SQL éventuellement présentes.';
	public $A_COMP_CONF_EDITOR = 'Editeur WYSIWYG';
	public $A_COMP_CONF_LENGTH = 'Longueur de Liste';
	public $A_COMP_CONF_LENTIP = 'Fixer pour tous les utilisateurs, la valeur de la longueur des listes utilisés dans l\'administration.';
	public $A_COMP_CONF_FAV_ICON = 'Icone de Favoris du Site';
	public $A_COMP_CONF_FAVTIP = 'Si laissé vide aucun fichier ne sera trouvé, le fichier favicon.ico par défaut sera utilisé';
	public $A_COMP_CONF_CLINKACC = 'Composants liés aux Système d\'Accès';
	public $A_COMP_CONF_CLACCDESC = 'Choisissez le type de composants que vous voulez voir sur le système pour la partie Public (Valeur ACO = voir). Lire le fichier aide si vous n\êtes pas sur.';
	public $A_COMP_CONF_CORECOMPS = 'Composants Fondamentaux';
	public $A_COMP_CONF_3RDCOMPS = 'Composants Tiers';
	public $A_COMP_CONF_ALLCOMPS = 'Tous les Composants';
	public $A_COMP_CONF_CAPTCHA = 'Utiliser les images sécurits';
	public $A_COMP_CONF_CAPTCHATIP = 'Oui, si vous voulez utiliser les images de sécurité (Captcha) dans les formulaires de votre site. Le mot pourra être dicté pour que les personnes puissent bien le saisir.';
	public $A_COMP_CONF_LOCALE = 'Localisation';
	public $A_COMP_CONF_LANG = 'Language par défaut pour la partie public';
	public $A_COMP_CONF_ALANG = 'Language par défaut pour la partie administration';
	public $A_COMP_CONF_TIME_SET = 'Décalage horaire';
	public $A_COMP_CONF_DATE = 'Configuration actuelle des dates/heures et de l\'affichage';
	public $A_COMP_CONF_LOCAL = 'Paramètre du pays (exemple: fr_FR pour la France)';
	public $A_COMP_CONF_LOCRECOM = 'Nous vous recommandons de le laisser en Auto-Select. Elxis chargera le lieu le plus approprié pour votre OS ainsi que la langue choisie. Windows supportant mal les languages en UTF-8.';
	public $A_COMP_CONF_LOCCHECK = 'Contrôle du lieu';
	public $A_COMP_CONF_LOCCHECK2 = 'Si cette date est bien formatée alors cel est excellent pour votre système et votre langue.<br><strong>Attention!</strong> Sous Windows le site est mis automatiquement en anglais.';
	public $A_COMP_CONF_AUTOSEL = 'Auto-Select';
	public $A_COMP_CONF_CONTROL = '* Ces Paramètres contrôlent les éléments de Production *';
	public $A_COMP_CONF_LINK_TITLES = 'Titres liés';
	public $A_COMP_CONF_LTITLES_TIP = 'Si oui, le titre de l\'article s\'affichera comme un lien vers l\'article.';
	public $A_COMP_CONF_MORE_LINK = 'Lien Lire la suite';
	public $A_COMP_CONF_MLINK_TIP = 'Si mis à l\'affichage, le lien \'Lire la suite\' s\'affichera si l\'article à un texte principal.';
	public $A_COMP_CONF_RATE_VOTE = 'Evaluation/Vote des éléments';
	public $A_COMP_CONF_RVOTE_TIP = 'Si mis à l\'affichage, un système de vote sera mis en place pour chaque article.';
	public $A_COMP_CONF_AUTHOR = 'Nom de l\'Auteur';
	public $A_COMP_CONF_AUTHORTIP = 'Si mis à l\'affichage, le nom de l\'auteur devient visible. Ceci est un réglage global, mais qui peut être changé au niveau du menu et des éléments.';
	public $A_COMP_CONF_CREATED = 'Date et Heure de création';
	public $A_COMP_CONF_CREATEDTIP = 'Si mis à l\'affichage, la date et l\'heure de création d\'un élément seront affichées. Ceci est un réglage global, mais qui peut être modifié au niveau du menu et des éléments.';
	public $A_COMP_CONF_MOD_DATE = 'Date et Heure de modification';
	public $A_COMP_CONF_MDATETIP = 'Si mis à l\'affichage, la date et l\'heure de la dernière modification d\'un élément seront affichées. Ceci est un réglage global, mais qui peut être modifié au niveau du menu et des éléments.';
	public $A_COMP_CONF_HITS = 'Clics';
	public $A_COMP_CONF_HITSTIP = 'Si mis à l\'affichage, le nombre de visites pour chaque élément sera affiché. Ceci est un réglage global, mais qui peut être modifié au niveau du menu et des éléments.';
	public $A_COMP_CONF_PDF = 'Icône PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Option non valable si le répertoire /tmpr n\'est pas modifiable';
	public $A_COMP_CONF_PRINT_ICON = 'Icône Imprimer';
	public $A_COMP_CONF_EMAIL_ICON = 'Icône Email';
	public $A_COMP_CONF_ICONS = 'Icônes';
	public $A_COMP_CONF_USE_OR_TEXT = 'Imprimer, PDF et Email utiliseront soit des icônes, soit du texte.';
	public $A_COMP_CONF_TBL_CONTENTS = 'Table des matières pour les articles multi-pages';
	public $A_COMP_CONF_BACK_BUTTON = 'Boutton Retour';
	public $A_COMP_CONF_CONTENT_NAV = 'Eléments de navigation';
	public $A_COMP_CONF_HYPER = 'Utiliser les titres hyperliens';
	public $A_COMP_CONF_DBTYPE = 'Base de Données';
	public $A_COMP_CONF_DBWARN = 'Ne pas modifier, à moins d\'avoir fait une sauvegarde de la base de données de Elxis!';
	public $A_COMP_CONF_HOSTNAME = 'Nom du serveur';
	public $A_COMP_CONF_DB_PW = 'Mot de Passe';
	public $A_COMP_CONF_DB_NAME = 'Base de Données';
	public $A_COMP_CONF_DB_PREFIX = 'Préfix de la base de données';
	public $A_COMP_CONF_NOT_CH = '!! NE PAS MODIFIER A MOINS D\'AVOIR AU PREALABLE UNE BASE DE DONNEES DANS LAQUELLE LES TABLES ONT LE MÊME PREFIXE !!';
	public $A_COMP_CONF_ABS_PATH = 'Chemin absolu';
	public $A_COMP_CONF_LIVE = 'Site public';
	public $A_COMP_CONF_SECRET = 'Mot secret';
	public $A_COMP_CONF_GZIP = 'Compression GZIP des pages';
	public $A_COMP_CONF_CP_BUFFER = 'Activez la compression du tampon d\'affichage, si pris en charge';
	public $A_COMP_CONF_SESSION_TIME = 'Durée de la session';
	public $A_COMP_CONF_SEC = 'secondes';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Déconnexion automatique après cette durée d\'inactivité.';
	public $A_COMP_CONF_ERR_REPORT = 'Rapport d\'erreurs';
	public $A_COMP_CONF_HELP_SERVER = 'Serveur d\'aide';
	public $A_COMP_CONF_META_PAGE = 'Métadonnées';
	public $A_COMP_CONF_META_DESC = 'Méta description du site';
	public $A_COMP_CONF_META_KEY = 'Mots clés du site (Meta keywords)';
	public $A_COMP_CONF_HPS1 = 'Fichiers d\'aide en Local';
	public $A_COMP_CONF_HPS2 = 'Elxis Serveur Aide';
	public $A_COMP_CONF_HPS3 = 'Site Officiel Elxis pour le serveur d\'aide';
	public $A_COMP_CONF_PERMFLES = 'Choisissez cette option pour définir les droits de permission pour les nouveaux fichiers.';
	public $A_COMP_CONF_PERMDIRS = 'Choisissez cette option pour définir les droits de permission pour des nouveaux répertoires.';
	public $A_COMP_CONF_NCHMODDIRS = 'Ne pas mettre en CHMOD les nouveaux répertoires (utiliser le serveur par défaut)';
	public $A_COMP_CONF_CHAPFLAGS = 'La vérification appliquera les changements de permission à <em>tous les fichiers existants </em> du site.<br/><b>L\'UTILISATION INOPPORTUNE DE CETTE OPTION PEUT RENDRE LE SITE INOPERANT!</b>';
	public $A_COMP_CONF_CHAPDLAGS = 'La vérification appliquera les changements de permission à <em>tous les répertoires existants</em> du site.<br/><b>L\'UTILISATION INOPPORTUNE DE CETTE OPTION PEUT RENDRE LE SITE INOPERANT!</b>';
	public $A_COMP_CONF_APPEXDIRS = 'Appliquer aux répertoires existants';
	public $A_COMP_CONF_APPEXFILES = 'Appliquer aux fichiers existants';
	public $A_COMP_CONF_WORLD = 'Monde';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD des nouveaux répertoires';
	public $A_COMP_CONF_MAIL = 'Serveur de mail';
	public $A_COMP_CONF_MAIL_FROM = 'Adresse de l\'expéditeur';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Nom de l\'expéditeur';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'Identification SMTP requise';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'Utilisateur SMTP';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'Mot de passe SMTP';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'Hôte SMTP';
	public $A_COMP_CONF_CACHE = 'Mettre en cache';
	public $A_COMP_CONF_CACHE_FOLDER = 'Répertoire du cache';
	public $A_COMP_CONF_CACHE_DIR = 'Le Répertoire actuel du cache est';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Le répertoire du cache n\'est pas MODIFIABLE - veuillez mettre le répertoire en CHMOD755 avant de l\'activer.';
	public $A_COMP_CONF_CACHE_TIME = 'Durée de vie du cache';
	public $A_COMP_CONF_STATS = 'Statistiques';
	public $A_COMP_CONF_STATS_ENABLE = 'Activer/désactiver la collecte de statistique de votre site';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Log des Contenus par Date';
	public $A_COMP_CONF_STATS_WARN_DATA = 'ATTENTION : Ces remontés d\'info prennent beaucoup de place dans la base de données.';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Logs des Recherches';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Optimisation du Moteur de recherche';
	public $A_COMP_CONF_SEO_SEFU = 'Moteur de recherche URL';
	public $A_COMP_CONF_SEOBASIC = 'SEO de Base';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache et IIS. Apache: renommer le fichier htaccess.txt en .htaccess avant d\'activer le mode SEO (mod_rewrite activé). IIS: utiliser le filtre Ionic Isapi Rewriter. Pour maximiser les performances préparez les contenus de votre site avant de passer à SEO PRO. Sélectionnez SEO de base si vous souhaitez utiliser un composant SEF tiers.";
	public $A_COMP_CONF_SEO_DYN = 'Titre de page dynamique';
	public $A_COMP_CONF_SEO_DYN_TITLE = 'Changement dynamique du titre de la page afin de refléter le contenu actuellement consulté';
	public $A_COMP_CONF_SERVER = 'Serveur';
	public $A_COMP_CONF_METADATA = 'Meta données';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Paramètres FTP';
	public $A_COMP_CONF_FTP_ENB = 'Activer le FTP';
	public $A_COMP_CONF_FTP_HST = 'Serveur FTP';
	public $A_COMP_CONF_FTP_HSTTP = 'Le plus probablement';
	public $A_COMP_CONF_FTP_USR = 'Identifiant FTP';
	public $A_COMP_CONF_FTP_USRTP = 'Le plus probablement';
	public $A_COMP_CONF_FTP_PAS = 'Mot de passe FTP';
	public $A_COMP_CONF_FTP_PRT = 'Port FTP';
	public $A_COMP_CONF_FTP_PRTTP = 'Valeur par défaut: 21';
	public $A_COMP_CONF_FTP_PTH = 'Chemin FTP';
	public $A_COMP_CONF_FTP_PTHTP = 'Chemin de la racine FTP de votre installation de Elxis. homme/www/elxis';
	public $A_COMP_CONF_HIDE = 'Cacher';
	public $A_COMP_CONF_SHOW = 'Afficher';
	public $A_COMP_CONF_DEFAULT = 'Système par Défaut';
	public $A_COMP_CONF_NONE = 'Aucun';
	public $A_COMP_CONF_SIMPLE = 'Simple';
	public $A_COMP_CONF_MAX = 'Maximum';
	public $A_COMP_CONF_MAIL_FC = 'Fontion PHP mail';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Chemin Sendmail';
	public $A_COMP_CONF_SMTP = 'Serveur SMTP';
	public $A_COMP_CONF_UPDATED = 'Les détails de la configuration ont été <strong>mis à jour!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Une erreur est survenue!</strong> Impossible d\'ouvrir le fichier config pour le modifier!';
	public $A_COMP_CONF_READ = 'lecture';
	public $A_COMP_CONF_WRITE = 'écriture';
	public $A_COMP_CONF_EXEC = 'executer';
	public $A_COMP_CONF_FCRE = 'Créer un Fichier';
	public $A_COMP_CONF_FPERM = 'Permissions des Fichiers';
	public $A_COMP_CONF_DCRE = 'Créer un Répertoire';
	public $A_COMP_CONF_DPERM = 'Permissions des Répertoires';
	public $A_COMP_CONF_OFFEX = 'Oui (excepter pour les Super Administrateurs)';
	public $A_COMP_CONF_RTF = 'Icône RTF';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Activation des comptes';
	public $A_C_CONF_NOACT = 'Aucune activation';
	public $A_C_CONF_EMACT = 'Activation par l\'intermédiaire d\'un email';
	public $A_C_CONF_MANACT = 'Activation manuelle';
	public $A_C_CONF_AC_ACTD = 'Choisissez comment vous souhaitez que les nouveaux comptes d\'utilisateur soient activés. Directement, par l\'intermédiaire du lien d\'activation dans l\'email ou manuellement par l\'administrateur du site.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Commentaires';
	public $A_C_CONF_COMMENTSTIP = 'Si défini à afficher, le nombre de commentaires d\'un élément de contenu sera affiché. Ceci est un paramètre global, mais peuvent être modifiés aux niveaux des menus';
	public $A_C_CONF_CHKFTP = 'Vérifier les paramètres FTP';
	public $A_C_CONF_STDCACHE = 'Cache standard';
	public $A_C_CONF_STATCACHE = 'Cache statique';
	public $A_C_CONF_CACHED = 'Le cache standard met partiellement en cache les pages, alors que le cache statique met en cache la page entière. Le cache statique est recommandée pour les gros sites. Pour utiliser le cache statique, vous devez avoir activé SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO est désactivé!';

	public function __construct() {	
	}

}

?>