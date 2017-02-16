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
* @description: French language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Noyau';
public $A_ASTATS = 'Stats Administration';
public $A_VALUE = 'Valeur';
public $A_LASTMOD = 'Dernière modification ';
public $A_OS = 'Système d\'exploitation';
public $A_ELXIS_VERSION = 'Version de Elxis';
public $A_SELECT = 'Sélectionner';
public $NOEDITSYS = 'Vous n\'êtes pas autorisés à modifier les entrées du système';
public $A_RESTORE = 'Restaurer';
public $SOFTDISK_HELP = 'SoftDisk est une zone de la mémoire virtuelle pour variables et paramètres en tout genre.<br />
  	Vous pouvez ajouter ou modifier/supprimer des entrées dans SoftDisk, sauf celles étiquetés comme faisant partie du système. 
	Les entrées marquées comme "Non-Supprimable" ne peuvent être qu\'éditées. Pour nommer les sections de SoftDisk et les noms de valeur 
	vous êtes autorisés à n\'utiliser que <strong>des lettres latin en capitales, éléments numérique et des underscore (_)</strong>.';
public $YCNOTEDITP = 'Vous ne pouvez pas éditer les paramètres';
public $UNDELETABLE = 'Non-Supprimable';
public $SOFTENTRYEXIST = 'Il existe déjà une entrée avec ce nom dans SoftDisk!';
public $INVSECTNAME = 'Nom de section invalide!';
public $INVNAME = 'Nom invalide!';
public $INVEMAIL = 'La valeur fournie n\'est pas une adresse de courriel valide!';
public $INVURL = 'La valeur fournie n\'est pas une adresse URL valide!';
public $INVDEC = 'La valeur fournie n\'est pas une valeur décimale!';
public $INVTSTAMP = 'La valeur fournie n\'est pas une valeur logique UNIX!';
public $UPSYSTEM = 'Mise à Jour du système';
public $A_USERPROFILE = 'Profil utilisateur';
public $UPROF_WEBSITE = 'Site Web';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Téléphone';
public $UPROF_MOBILE = 'Portable';
public $UPROF_BIRTHDATE = 'Date de naissance';
public $UPROF_GENDER = 'Genre';
public $UPROF_LOCATION = 'Lieu';
public $UPROF_OCCUPATION = 'Occupation';
public $UPROF_SIGNATURE = 'Signature';
public $UPROF_ARTICLES = 'Nombre d\'articles';
public $UPROF_USERGROUP = 'Groupe Utilisateur';
public $UPROF_RANDUSERS = 'Affichage aléatoirement des utilisateurs dans la page profile';
public $USERS_RPASSMAIL = 'Notifier aux administrateurs lors d\'une demande de mot de passe oublié';
public $SUBMIT_CATEGORIES = 'Catégories qui sont autorisées à avoir des soumissions de contenu (suggéré). Si vide toutes seront autorisées. (ID des catégories, séparées par des virgules)';
public $SUBMIT_SECTIONS = 'Sections qui sont autorisées à avoir des soumissions de contenu (suggéré). Si vide toutes seront autorisées. (ID des catégories, séparées par des virgules)';
public $REG_AGREE = 'ID autonome de la page d\'enregistrement. Zéro (0) pour désactiver. Pour un accord spécifique pour une langue, crée une entrée SoftDisk dans la section UTILISATEURS pour chaque langue intégrée dans REG_AGREE_LANGUAGE-HERE';
public $A_WEBLINKS = 'Liens Web';
public $TOP_WEBLINK = 'Contrôle l\'affichage ou pas, du module Liens Web à l\'intérieur du composant Liens web';
public $A_USERSLIST = 'Liste des Utilisateurs';
public $ULIST_ONLINE = 'Etat En-ligne';
public $ULIST_USERNAME = 'Identifiant';
public $ULIST_NAME = 'Nom';
public $ULIST_REGDATE = 'Date d\'enregistrement';
public $ULIST_PREFLANG = 'Langue Préférée';
//2009.0
public $STATICCACHE = 'Cache statique';

}

?>