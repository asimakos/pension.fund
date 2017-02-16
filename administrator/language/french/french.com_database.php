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
* @description: French language for component Database
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\' est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Nom des Tables';
public $A_CMP_DB_ACTIONS = 'Actions';
public $A_CMP_DB_TDESCR = 'Description des Tables';
public $A_CMP_DB_BROWSE = 'Parcourir';
public $A_CMP_DB_STRUCTURE = 'Structure';
public $A_CMP_DB_INFO = 'Information';
public $A_CMP_DB_DUMPDB = 'Dump de la Base de Données';
public $A_CMP_DB_XDUMPDB = 'Dump XML/SQL de la Base de Données';
public $A_CMP_DB_BACTYPE = 'Type de Backup';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Créer un Backup XML';
public $A_CMP_DB_XFULL = 'Structure &amp; Données';
public $A_CMP_DB_XSTRUONL = 'Structure Uniquement';
public $A_CMP_DB_XSAVSERV = 'Sauvegarde sur le Serveur';
public $A_CMP_DB_DOWNLD = 'Télécharger';
public $A_CMP_DB_XMLBACK = 'Backup XML';
public $A_CMP_DB_SCRBACK = 'Créér un Backup SQL';
public $A_CMP_DB_SFULL = 'Structure &amp; Données';
public $A_CMP_DB_SDATAONL = 'Données Uniquement';
public $A_CMP_DB_SLOCTBL = 'Bloquer les Tables';
public $A_CMP_DB_SFSYNTX = 'Syntaxe Compléte';
public $A_CMP_DB_SDRTBL = 'Dropper les Tables';
public $A_CMP_DB_STBLS = 'Tables';
public $A_CMP_DB_ATBLS = 'Tous';
public $A_CMP_DB_SELTBLS = 'Sélectionné';
public $A_CMP_DB_SQLBACK = 'Backup SQL';
public $A_CMP_DB_TDESC = 'Description des Tables';
public $A_CMP_DB_CLNAME = 'Nom de la Colonne';
public $A_CMP_DB_CLTYPE = 'Type de la Colonne';
public $A_CMP_DB_ADOTYPE = 'Type ADOdb';
public $A_CMP_DB_MAXLEN = 'Longueur Max';
public $A_CMP_DB_BRTBL = 'Parcourir les Tables';
public $A_CMP_DB_BCKDB = 'Retour à la Base de Données';
public $A_CMP_DB_DBTYPE = 'Type de Base de Données';
public $A_CMP_DB_DBDESCR = 'Description de la Base de Données';
public $A_CMP_DB_DBVER = 'Version de la Base de Données';
public $A_CMP_DB_DBHOST = 'Serveur de la Base de Données';
public $A_CMP_DB_DBNAME = 'Nom de la Base de Données';
public $A_CMP_DB_DBUSER = 'Identifiant';
public $A_CMP_DB_DBERRF = 'Raise Erreur FN';
public $A_CMP_DB_DBDBG = 'Deboguer';
public $A_CMP_DB_TBLSTR = 'Table Structure';
public $A_CMP_DB_DBBACK = 'Backup de la Base de Données';
public $A_CMP_DB_NOEXISTS = 'Aucun Backup existant';
public $A_CMP_DB_FOOTER= "<u>Note</u>: Pour télécharger, faire un clic de bouton droit sur le fichier puis enregistrer-sous. <u>Attention</u>: Les Fichiers sont encodés en UTF-8.";
public $A_CMP_DB_DBMONIT = 'Ecran de la Base de Données';
public $A_CMP_DB_TBLNOT = 'Aucune Table existante!';
public $A_CMP_DB_BACKSUCC = 'Backup terminé avec succès';
public $A_CMP_DB_NOTSUPPO = 'Dump SQL n\'est pas supporté pour';
public $A_CMP_DB_NOTBLSEL = 'Aucunes tables sélectionnées!';
public $A_CMP_DB_NOTDWNL = 'Impossible de créer/télécharger un Dump SQL';
public $A_CMP_DB_NOTCRSV = 'Impossible de créer/sauvegarder un Dump SQL';
public $A_CMP_DB_DUMPSUCC = 'Dump SQL créé avec succès';
public $A_CMP_DB_DTUNKN = 'Date Inconnue';
public $A_CMP_DB_TXMLSCHEM = 'Schéma XML';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Type Inconnu';
public $A_CMP_DB_UNKOWN = 'Taille Inconnue';
public $A_CMP_DB_NOFSELDEL = 'Pas de fichier sélectionné à supprimer!';
public $A_CMP_DB_FSDELETED = 'fichier supprimé avec succès';
public $A_CMP_DB_FDELETED = 'Fichiers supprimés avec succès';
public $A_CMP_DB_TLMANBACK = 'Gestion des Backups';
public $A_CMP_DB_TLDELSLBCK = 'Supprimer les Backups sélectionnés';
public $A_CMP_DB_TLNEWFXML = 'Nouveau Backup Complet en XML';
public $A_CMP_DB_TLNEWFSQL = 'Nouveau Backup Complet en SQL';
public $A_CMP_DB_MAINTEN = 'Maintenance';
public $A_CMP_DB_MAINTEND = 'Maintenance de la base de données';
public $A_CMP_DB_OPTIM = 'Optimiser';
public $A_CMP_DB_REPAIR = 'Réparer';
public $A_CMP_DB_TBLOPTED = 'tables optimisées';
public $A_CMP_DB_FRUOPTINCP = 'Fréquemment utilisé pour <strong>optimiser</strong> les performances de la base de données.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Réparer</strong>, répare les erreurs potentielles des tables de la base de données.';
public $A_CMP_DB_FAVMYSQL = 'Cette fonctionnalité n\'est disponible que pour les bases de données MySQL!';
public $A_CMP_DB_TBLREPED = 'tables réparées';
public $A_CMP_DB_SIZE = 'Taille';

}

?>