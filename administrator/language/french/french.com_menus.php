<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Vianney Zahner (Zepelin57)
* @link: http://www.elxis-france.com
* @email: info@elxis-france.com
* @description: French language for components Menus
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Gestion des Menus';
public $A_CMP_MU_MXLVLS = 'Niveaux max.';
public $A_CMP_MU_CANTDEL ='* Vous ne pouvez pas \'supprimer\' ce menu car il est obligatoire au bon fonctionnement de Elxis*';
public $A_CMP_MU_MANHOME = '* La page d\'accueil - Frontpage - est un composant particulier qui est chargé de l\'affichage des articles que l\'on a choisi d\'afficher sur la page d\'accueil*';
public $A_CMP_MU_MITEM = 'Eléments de menu';
public $A_CMP_MU_NSMTG = '* Notez que certains types de menus apparaissent dans plusieurs groupes, mais qu\'ils dépendent néanmoins de ce seul type de menu.';
public $A_CMP_MU_MITYP = 'Type d\'élément de menu';
public $A_CMP_MU_WBLV = 'Ceci est une vue du Blog';
public $A_CMP_MU_WTLV = 'Ceci est une vue de la Tableau';
public $A_CMP_MU_WLIV = 'Ceci est une vue de la Liste';
public $A_CMP_MU_SMTAP = '*Certains `Types de Menu apparaissent dans plus d\'un groupe *';
public $A_CMP_MU_MOVEITS = 'Déplacer les liens';
public $A_CMP_MU_MOVEMEN = 'Déplacer vers le menu';
public $A_CMP_MU_BEINMOV = 'Liens en cours déplacé';
public $A_CMP_MU_COPYITS = 'Copier les liens';
public $A_CMP_MU_COPYMEN = 'Copier le menu';
public $A_CMP_MU_BCOPIED = 'Liens en cours de copie';
public $A_CMP_MU_EDNEWSF = 'Modifier ce fil d\'actualité';
public $A_CMP_MU_EDCONTA = 'Modifier ce contact';
public $A_CMP_MU_EDCONTE = 'Modifier ce contenu';
public $A_CMP_MU_EDSTCONTE = 'Modifier ce contenu statique';
public $A_CMP_MU_MSGITSAV = 'Lien de menu sauvegardé';
public $A_CMP_MU_MOVEDTO = ' Liens de menu déplacés vers ';
public $A_CMP_MU_COPITO = ' Liens de menu copiés vers ';
public $A_CMP_MU_THMOD = 'Les modules';
public $A_CMP_MU_SCITLKT = 'Vous devez choisir un composant à lier à';
public $A_CMP_MU_COMPLLTO = 'Composant à lier';
public $A_CMP_MU_ITEMNAME = 'L\'élément doit avoir un nom';
public $A_CMP_MU_PLSELCMP = 'Veuillez choisir un composant !';
public $A_CMP_MU_PARAVAI = 'La liste des Paramètres ne sera disponible qu\'une fois le menu sauvegardé';
public $A_CMP_MU_YSELCAT = 'Vous devez choisir une catégorie';
public $A_CMP_MU_TMHTITL = 'Cet élément du menu doit avoir un titre';
public $A_CMP_MU_TABLE = 'Table';
public $A_CMP_MU_CCTBLANK = 'Si vous laissez ce champ vide, le nom de la catégorie sera automatiquement utilisé';
public $A_CMP_MU_LNKHNAME = 'Un lien doit avoir un nom';
public $A_CMP_MU_SELCONT = 'Vous devez choisir un contact à lier à';
public $A_CMP_MU_CONLINK = 'Contact à lier:';
public $A_CMP_MU_ONCLOPI = 'En cliquant, ouvrir dans';
public $A_CMP_MU_THETITL = 'Titre:';
public $A_CMP_MU_YMSSECT = 'Vous devez choisir une Section';
public $A_CMP_MU_ILBLSEC = 'Si vous laissez ce champ vide, le nom de la section sera automatiquement utilisé';
public $A_CMP_MU_YCSMC = 'Vous pouvez choisir plusieurs Catégories';
public $A_CMP_MU_YCSMS = 'Vous pouvez choisir plusieurs Sections';
public $A_CMP_MU_EDCOI = 'Modifier l\'article';
public $A_CMP_MU_YMSLT = 'Vous devez sélectionner un contenu à lier';
public $A_CMP_MU_STACONT = 'Contenu statique';
public $A_CMP_MU_ONCLOP = 'En cliquant, ouvrir';
public $A_CMP_MU_YSNWLT = 'Vous devez choisir un fil d\'actualité à lier à';
public $A_CMP_MU_NEWTL = 'Lien de menu :: Lien - Fil d\'actualité';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Modéle/Nom';
public $A_CMP_MU_WRURL = 'Vous devez fournir une adresse (URL).';
public $A_CMP_MU_WRLINK = 'Lien de menu :: Encapsulateur';
public $A_CMP_MU_MIBGCC = 'Blog - Contenu de la catégorie';
public $A_CMP_MU_MITCG = 'Lien de menu :: Tableau - Catégorie de contact';
public $A_CMP_MU_MICOMP = 'Composants';
public $A_CMP_MU_MIBGCS = 'Blog - Contenu de la section';
public $A_CMP_MU_MILCMPI = 'Lien - Composant';
public $A_CMP_MU_MILCI = 'Lien - Contact';
public $A_CMP_MU_MITBCC = 'Lien de menu :: Tableau - Catégorie';
public $A_CMP_MU_MILCEI = 'Lien - Contenu de l\'élément';
public $A_CMP_MU_COTLINK = 'Contenu à lier';
public $A_CMP_MU_MITBCS = 'Lien de menu :: Tableau - Section';
public $A_CMP_MU_MILSTC = 'Lien - Contenu statique';
public $A_CMP_MU_MITBNFC = 'Lien de menu :: Tableau - Catégories Fils d\'actualités';
public $A_CMP_MU_MILNEW = 'Lien - Fil d\'actualité';
public $A_CMP_MU_MISEP = 'Separateur / Endroit';
public $A_CMP_MU_MILIURL = 'Lien - Url';
public $A_CMP_MU_MITBWC = 'Lien de menu :: Tableau - Catégorie de liens';
public $A_CMP_MU_MIWRAP = 'Encapsulateur';
public $A_CMP_MU_ITEM = 'Eléments';
public $A_CMP_MU_UMSBRI = 'Vous devez fournir un Pont.';
public $A_CMP_MU_BRINOINS = 'Le Composant de gestion des Ponts n\'est pas installé!';
public $A_CMP_MU_NOPUBBRI = 'Il n y a pas de Ponts publiés!';
public $A_CMP_MU_CLVSEO = 'Cliquez sur une page autonome pour l\'afficher en titre SEO';
public $A_CMP_MU_SYSLINK = 'Lien Système';
public $A_CMP_MU_SYSLINKD = 'Un Lien Système devrait appartenir normalement à un menu publié dans une position du module qui n\'existe PAS dans le template!';
public $A_CMP_MU_PASSR = 'Rappel du mot de passe';
public $A_CMP_MU_UREG = 'Enregistrement des utilisateurs';
public $A_CMP_MU_REGCOMP = 'Enregistrement terminé';
public $A_CMP_MU_ACCACT = 'Activation du compte';
public $A_CMP_MU_MSLINK = 'Vous devez choisir un lien système.';
public $A_CMP_MU_SELLINK = '- Choix du lien -';
public $A_CMP_MU_DONTDEL ='* Ne pas effacer ce menu, il fait partie intégrente de Elxis. Assurez-vous avant de publier que la position du module n\'existe pas dans le template! *';
public $A_CMP_MU_EDPROF = 'Editer le profil';
public $A_CMP_MU_SUBWEBL = 'Soumettre un lien web';
public $A_CMP_MU_CHECKIN = 'Enregistrement';
public $A_CMP_MU_USERLIST = 'Listes des Utilisateurs';
public $A_CMP_MU_POLLS = 'Sondages';
//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'Vous devez choisir un blog pour lier à';
public $A_CMP_MU_BLOGLINK = 'Blog à lier';

}

?>