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
* @description: French language for component Access manager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ACC_GROUP = 'Groupes';
public $A_CMP_ACC_GRUSR = 'Utilisateurs des groupes';
public $A_CMP_ACC_BCKASS = 'Accès administrateur';
public $A_CMP_ACC_PHREN = 'Appuyez et tenir pour renommer';
public $A_CMP_ACC_GRHIE = 'Hiérarchie des groupes';
public $A_CMP_ACC_GGRNM = 'Vous devez donner un nom au groupe';
public $A_CMP_ACC_GGNSO = 'Le groupe parent que vous avez choisi n\'est pas une option sélectionnable';
public $A_CMP_ACC_MANG = 'Gestion des Groupes';
public $A_CMP_ACC_GDTL = 'Détails du Groupe';
public $A_CMP_ACC_GNAME = 'Nom du Groupe';
public $A_CMP_ACC_PRGR = 'Groupe Parent';
public $A_CMP_ACC_EXUG = 'Utilisateur existant du groupe';
public $A_CMP_ACC_PRMFOR = 'Permissions pour'; 
public $A_CMP_ACC_ACO = 'ACO'; 
public $A_CMP_ACC_ACOV = 'Valuer ACO'; 
public $A_CMP_ACC_AXO = 'AXO'; 
public $A_CMP_ACC_AXOV = 'Valeur AXO'; 
public $A_CMP_ACC_ADNP = 'Ajouter une nouvelle permission'; 
public $A_CMP_ACC_ARO = 'ARO'; 
public $A_CMP_ACC_AROV = 'Valeur ARO'; 
public $A_CMP_ACC_SEL = '-CHOIX-'; 
public $A_CMP_ACC_ACT = 'Action';
public $A_CMP_ACC_ADM = 'Administration';
public $A_CMP_ACC_WKF = 'Workflow';
public $A_CMP_ACC_YMSGR = 'Vous devez spécifier un groupe pour renommer'; 
public $A_CMP_ACC_TSAGN = 'Il y a déjà un groupe ayant ce nom'; 
public $A_CMP_ACC_YANARG = 'Vous n\avez pas l\'autorisation de renommer ce groupe!'; 
public $A_CMP_ACC_CNUTACL = 'Vous ne pouvez pas mettre à jour la table _core_acl_aro_groups'; 
public $A_CMP_ACC_CNUTUS = 'Vous ne pouvez pas mettre à jour la table _users'; 
public $A_CMP_ACC_CNUTCAL = 'Vous ne pouvez pas mettre à jour la table _core_acl_access_lists'; 
public $A_CMP_ACC_YHTLA = 'VOUS DEVEZ VOUS RECONNECTER!'; 
public $A_CMP_ACC_MFS = 'Message à partir du serveur'; 
public $A_CMP_ACC_WID = 'avec l\'id'; 
public $A_CMP_ACC_UGWID = 'Utiliser ce groupe avec l\'id'; 
public $A_CMP_ACC_RNMTO = 'renommer en'; 
public $A_CMP_ACC_YCNEDGR = 'Vous n\avez pas l\'autorisation d\'éditer ce groupe!'; 
public $A_CMP_ACC_YMSPNGR = 'Vous devez donner un nom à ce groupe'; 
public $A_CMP_ACC_IPGR = 'Groupe parent invalide'; 
public $A_CMP_ACC_YCCGPY = 'Vous ne pouvez pas créer de groupe parent à votre groupe!'; 
public $A_CMP_ACC_YCNUSGR = 'Vous ne pouvez pas utiliser ce groupe comme parent!'; 
public $A_CMP_ACC_TIAGTN = 'Il y a un autre groupe portant ce nom!'; 
public $A_CMP_ACC_GADDSUC = 'Groupe ajouté avec succès avec l\'id'; 
public $A_CMP_ACC_CNADDNG = 'Vous ne pouvez pas ajouter un nouveau groupe.'; 
public $A_CMP_ACC_THGRP = 'Groupe';
public $A_CMP_ACC_UPSUCC = 'mis à jour avec succès'; 
public $A_CMP_ACC_CNUPGR = 'Vous ne pouvez pas mettre à jour le groupe'; 
public $A_CMP_ACC_GESLAG = 'Groupe édité avec succès mais vous devez vous reconnecter!'; 
public $A_CMP_ACC_NGSDEL = 'Pas de groupe sélectionné à supprimer'; 
public $A_CMP_ACC_YCNDELG = 'Vous ne pouvez pas supprimer ce groupe!'; 
public $A_CMP_ACC_YANALDG = 'Vous n\'êtes pas autorisé à supprimer ce groupe!'; 
public $A_CMP_ACC_CNDLGR = 'Vous ne pouvez pas supprimer ce groupe'; 
public $A_CMP_ACC_GRSDEL = 'Groupe supprimé avec succès'; 
public $A_CMP_ACC_BCNDGP = 'mais vous ne pouvez pas supprimer les permissions de ce groupe!'; 
public $A_CMP_ACC_BCNDUS = 'mais vous ne pouvez pas supprimer les utilisateurs!'; 
public $A_CMP_ACC_NOGRSEL = 'Pas de groupe sélectionné!'; 
public $A_CMP_ACC_PERMADD = 'Permission ajoutée avec succès pour'; 
public $A_CMP_ACC_PERDSUC = 'Permission supprimée avec succès'; 
public $A_CMP_ACC_CNDELPER = 'Vous ne pouvez pas supprimer cette permission!'; 
public $A_CMP_ACC_PERMEXIST = 'Cette permission existe déjà!'; 
public $A_CMP_ACC_TEDITGR = 'Editer le groupe'; 
public $A_CMP_ACC_TGUPALD = 'Les groupes, les utilisateurs ainsi que les permissions seront tous supprimés!'; 
public $A_CMP_ACC_TEDITPR = 'Editer les permissions'; 
public $A_CMP_ACC_VIEW = 'Voir';
public $A_CMP_ACC_UPLOAD = 'Transfert';
public $A_CMP_ACC_CONTENT = 'Contenu';
public $A_CMP_ACC_OWN = 'Propriétaire';
public $A_CMP_ACC_PROF = 'Profil';
public $A_CMP_ACC_FILES = 'Fichiers';
public $A_CMP_ACC_AVATARS = 'Avatars';
public $A_CMP_ACC_MANAGE = 'Gérer';
public $A_CMP_ACC_USERP = 'Propriétés de l\utilisateur';

}

?>