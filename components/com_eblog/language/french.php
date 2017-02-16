<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Elias Fellas
* @link: http://www.shell-networks.com
* @email: anacon@netmail.com.cy
* @description: French language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Blog d\'Elxis';
	public $TAGS = 'Étiquettes';
	public $UNKNOWNTAG = 'Étiquette inconnue';
	public $PERMLINK = 'Lien permanent';
	public $COMMENTS = 'Commentaires';
	public $COMMENT = 'Commentaire';
	public $NOCOMMENTS = 'Il n\'y a aucun commentaire.';
	PUBLIC $MUSTLOGTOCOM = 'Vous devez d\'abord ouvrir une session pour signaler des commentaires.';
	public $POSTCOMMENT = 'Signalez un commentaire';
	public $YOURCOMMENT = 'Votre commentaire';
	public $NALLPOSTCOM = 'On ne te permet pas de signaler des commentaires!';
	public $MUSTWRITEMSG = 'Vous devez écrire un message!';
	public $COMADDSUC = 'Votre commentaire supplémentaire avec succès!';
	public $WAITRETRY = 'Réessayez svp après quelques secondes !';
	public $NALLPERFACT = 'On ne te permet pas d\'effectuer cette action!';
	public $ARTNOFOUND = 'N\'a pas pu fonder le poteau demandé!';
	public $POSTSTAGASAT = "Poteaux étiquetés comme %s à %s";
	public $ARCHIVES = 'Archives';
	public $USERBLOGSAT = "Blogs d\'utilisateur à %s";
	public $USERBLOGS = 'Blogs d\'utilisateur';
	public $THEREAREBLOGS = "Il y a des blogs de %s disponibles";
	public $POSTS = 'Poteaux';

	//control panel
	public $CPANEL = 'Panneau de commande';
	public $MANBLOG = 'Contrôlez votre blog';
	public $ALLPOSTS = 'Tous les poteaux';
	public $LATESTPOSTS = "Les derniers poteaux de %s";
	public $SETTINGS = 'Arrangements';
	public $CSSFILE = 'Dossier de CSS';
	public $RTLCSSFILE = 'Dossier de RTL CSS';
	public $COMMENTARY = 'Commentaire';
	public $NOTALLOWED = 'Non laissé';
	public $REGUSERS = 'Utilisateurs enregistrés';
	public $ALLOWEDALL = 'Permis à tous';
	public $POSTSNUMBER = 'Nombre de poteaux';
	public $POSTSNUMBERD = 'Nombre de la plupart des poteaux récents à montrer dans le blog en première page.';
	public $SHOWTAGSD = 'Choisissez si vous souhaitez montrer des étiquettes sous des poteaux.';
	public $CSSFILED = 'Feuille de modèle à employer dans votre blog. Le CSS prend soin de tous les disposition, polices, couleurs et regard global de votre blog.';
	public $RTLCSSFILED = 'La feuille de modèle à employer dans votre blog pour la droite aux langues gauches aiment le persan et l\'hébreu.';
	public $OPTION = 'Option';
	public $VALUE = 'Valeur';
	public $HELP = 'Aide';
	public $NEWPOST = 'Nouveau poteau';
	public $EDITPOST = 'Éditez le poteau';
	public $TITLENOEMPTY = 'Le titre ne peut pas être vide!';
	public $FOLDERCNOTCR = "Le dossier %s n\'a pas pu être créé!";
	public $DIMENSIONS = 'Dimensions (W x H)';
	public $SIZEKB = 'Taille (KBs)';
	public $LISTVIEW = 'Vue de liste';
	public $THUMBSVIEW = 'Vue d\'ongles du pouce';
	public $UPLOAD = 'Téléchargement';
	public $UPLOADIMG = 'Image de téléchargement';
	public $MEDIAMAN = 'Directeur de médias';
	public $YOUTUBEVIDEO = 'Vidéo de YouTube';
	public $GOOGLEVIDEO = 'Vidéo de Google';
	public $YAHOOVIDEO = 'Vidéo de Yahoo';
	public $COMSEPTAGS = 'Étiquettes séparées par virgule';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan à montrer dans votre en-tête de blog. Vous pouvez écrire le HTML.';
	public $SHOWOWNER = 'Montrez le propriétaire';
	public $SHOWOWNERD = 'Montrez le nom de propriétaire dans l\'en-tête de blog ?';
	public $SHOWARCHIVE = 'Show archive';
	public $SHOWARCHIVED = 'Montrez les archives de mois dans le titre de bas de page de blog ?';

	//SEO titles
	public $SEOTITLE = 'Titre de SEO';
	public $SEOTITLEEMPTY = 'Le titre de SEO ne peut pas être vide !';
	public $INVALID = 'Inadmissible';
	public $VALID = 'Valide';
	public $SEOTEXIST = 'Le titre de SEO existent déjà !';
	public $SEOTLARGER = 'Essayez un plus grand titre !';
	public $SEOTHELP = 'Vous pouvez employer seulement les caractères, les chiffres, les tirets et les soulignages latins minuscules. Le titre de SEO doit être unique ! Essayez d\'insérer des titres uniques et du meaningfull SEO.';
	public $SEOTSUG = 'Titre suggéré de SEO';
	public $SEOTVAL = 'Validez le titre de SEO';

	//languages names
	public $ARMENIAN = 'Arménien';
	public $BOZNIAN = 'Boznian';
	public $BRAZILIAN = 'Brésilien';
	public $BULGARIAN = 'Bulgare';
	public $CREOLE = 'Créole';
	public $CROATIAN = 'Croate';
	public $DANISH = 'Danois';
	public $ENGLISH = 'Anglais';
	public $FRENCH = 'Français';
	public $GERMAN = 'Allemand';
	public $GREEK = 'Grec';
	public $INDONESIAN = 'Indonésien';
	public $ITALIAN = 'Italien';
	public $JAPANESE = 'Japonais';
	public $LATVIAN = 'Letton';
	public $LITHUANIAN = 'Lithuanien';
	public $PERSIAN = 'Persan';
	public $POLISH = 'Polonais';
	public $RUSSIAN = 'Russe';
	public $SERBIAN = 'Serbian';
	public $SPANISH = 'Espagnol';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turc';
	public $VIETNAMESE = 'Vietnamien';

	//backend
	public $BLOGINFO = 'L\'information de blog';
	public $CANCONFIGD = 'Choisissez si vous souhaitez le propriétaire de blog pour pouvoir changer des arrangements de blog de d\'entrée.';
	public $CANUPLOADD = 'Choisissez si vous souhaitez le propriétaire de blog pour pouvoir aux dossiers de médias d\'uplod.';
	public $BLOGOWNMDIR = 'Annuaire de médias de propriétaire de blog';
	public $EXISTING = 'Exister';
	public $NONEXISTING = 'Non-existing';
	public $SIZEKBD = 'Le total a permis la taille de fichier téléchargée pour cet utilisateur en KB. La valeur par défaut est 2000 (2MB).';
	public $BLOGOWNER = 'Propriétaire de blog';
	public $UPLOADDIR = 'Annuaire de téléchargement';
	public $UPLOADEDFILES = 'Dossiers téléchargés';
	public $USEDSPACE = 'L\'espace utilisé';
	public $LASTPOST = 'Dernier poteau';
	public $LASTPOSTDATE = 'La date passée de poteau';
	public $NOTSETYET = 'Non réglé encore';
	public $UNOTALLUPLOADF = 'On ne permet pas à l\'utilisateur de télécharger des dossiers.';

	//elxis 2009.1
	public $INVDATE = 'La date que vous avez sélectionné n\'est pas valide.';
	public $METADESCDAY = "Postes pour %s sur %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Aucun post trouvé pour cette date.';
	public $SHAREPOST = 'Partagez cet article';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>