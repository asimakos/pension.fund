<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Vianney Zahner
* @link: http://www.elxis-france.com
* @email: info@elxis-france.com
* @description: French user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_french {

	public $_ON_NEW_CONTENT = "Un nouveau contenu a été soumis par [ %s ] intitulé [ %s ] dans la section [ %s ] et la catégorie [ %s ]";
	public $_E_COMMENTS = 'Commentaires';
	public $_DATE = 'Date';
	public $_E_SUBCONWAIT = 'Articles soumis en attente d\'approbation:';
	public $_E_CONTENTSUB = 'Proposition de Contenu';
	public $_MAIL_SUB = 'Publication soumise par un membre';
	public $_E_HI = 'Bonjour';
	public $_E_NEWSUBBY = "Une nouvelle publication a été soumise par %s";
	public $_E_TYPESUB = 'Type de soumission:';
	public $_E_TITLE = 'Titre';
	public $_E_LOGINAPPR = 'Connectez-vous à votre administration pour afficher et approuver cette soumission.';
	public $_E_DONTRESPOND = 'Veuillez ne pas répondre à ce message, il a été généré automatiquement dans le seul but d\'information.';
	public $_E_NEWPASS_SUB = "Nouveau mot de passe pour %s";
	public $_E_RPASS_NADMIN = "L\'Utilisatuer %s a demandé de lui renvoyer un mot de passe. Un nouveau mot de passe a été généré et envoyé. 
	Si vous ne souhaitez pas être prévenu pour de telles actions changez les paramètres USERS_RPASSMAIL dans SoftDisk en le mettant à Non.";
	public $_E_SEND_SUB = "Profil de %s inscrit à  %s";
	public $_ASEND_MSG = "Bonjour %s,
un nouvel utilisateur s\'est inscrit à %s.
Cet e-mail contient son profil:

Nom - %s
e-mail - %s
Identifiant - %s

Ne répondez pas à ce message, il a été généré automatiquement pour votre information";
	public $_NEW_MESSAGE = 'Un nouveau message privé vient de vous être envoyé';
	public $_NEW_PRMSGF = "Un nouveau message privé est arrivé de %s";
	public $_LOG_READMSG = 'Veuillez vous connecter à l\'administration pour lire ce message.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Section';
	public $_CATEGORY = 'Catégorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Pour que le nouvel utilisateur puissiez vous ouvre une session doit manuellement approuver son enregistrement!';
	public $_ACCUNBLOCK = "Votre compte à %s a été activé par un administrateur d\'emplacement. Vous pouvez maintenant ouvrir une session comme %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Notification d\'un nouveau commentaire';
	public $_E_NEWCOMBYTITLE = "Un nouveau commentaire a été posté par %s sur l\'article avec votre titre %s";
	public $_E_COMSTAYUNPUB = 'Ce commentaire restera dépublié jusqu\'à ce que vous ou un super-administrateur le publiera.';
	public $_E_ACCEXPDATE = 'Date d\'expiration du compte';

	public function __construct() {
	}

}

?>