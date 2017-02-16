<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Vianney Zahner (Zepelin57)
* @link: http://www.elxis-france.com
* @email: info@elxis-france.com
* @description: French language for component Installer
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Veuillez sélectionner un répertoire';
public $A_CMP_INS_UPF = 'Fichier compressé à transférer';
public $A_CMP_INS_PF = 'Fichier compressé';
public $A_CMP_INS_UFI = "Envoyer le Fichier à installer";
public $A_CMP_INS_FDIR = 'Installer à partir d\'un répertoire';
public $A_CMP_INS_IDIR = 'Répertoire';
public $A_CMP_INS_DOIN = 'Installer';
public $A_CMP_INS_CONT = 'Continuer ...';
public $A_CMP_INS_NF = 'Installation non trouvée pour l\'élément';
public $A_CMP_INS_NA = 'Installation indisponible pour cet élément';
public $A_CMP_INS_EFU = 'L\'installation ne peut continuer tant que le transfert (upload) de fichier n\'est pas activé. En attendant, utilisez la méthode "Installer depuis."';
public $A_CMP_INS_ERTL = 'Installation - Erreur';
public $A_CMP_INS_ERZL = 'L\'installation ne peut continuer tant que zlib n\'est pas installé';
public $A_CMP_INS_ERNF = 'Aucun fichier sélectionné';
public $A_CMP_INS_ERUM = 'Erreur de transfert d\'un nouveau module';
public $A_CMP_INS_UPTL = 'Envoyer ';
public $A_CMP_INS_UPE1 = ' - Echec du Transfert';
public $A_CMP_INS_UPE2 = ' -  Erreur Transfert';
public $A_CMP_INS_SUCC = 'Succès';
public $A_CMP_INS_ER = 'Erreur';
public $A_CMP_INS_ERFL = 'Echec';
public $A_CMP_INS_UPNW = 'Nouveau Transfert ';
public $A_CMP_INS_FP = 'Echec lors de l\'attribution des nouvelles permissions sur ce fichier.';
public $A_CMP_INS_FM = 'Echec lors du transfert du fichier vers le répertoire <code>/media</code>.';
public $A_CMP_INS_FW = 'Echec lors du transfert du fichier vers le répertoire <code>/media</code> celui-ci n\'est pas modifiable.';
public $A_CMP_INS_FE = 'Echec lors du transfert du fichier vers le répertoire <code>/media</code> car celui-ci n\'existe pas.';
public $A_CMP_INST_ERUNR = 'Erreur irrécupérable';
public $A_CMP_INST_EREXT = 'Erreur lors de la décompression!';
public $A_CMP_INST_ERMXM = 'ERREUR:  Impossible de trouver un fichier XML Elxis dans ce pack!';
public $A_CMP_INST_ERXML = 'ERREUR:  Impossible de trouver un fichier XML d\'installation dans ce pack!';
public $A_CMP_INST_ERNFN = 'Aucun nom de fichier spécifié';
public $A_CMP_INST_ERVLD = 'n\'est pas un fichier d\'installation pour Elxis';
public $A_CMP_INST_ERINC = 'La méthode "installe" ne peut pas être appelée par la classe';
public $A_CMP_INST_ERUIC = 'La méthode "désinstalle" ne peut pas être appelée par la classe';
public $A_CMP_INST_ERIFN = 'Impossible de trouver le fichier d\'installation';
public $A_CMP_INST_ERSXM = 'Impossible de trouver un fichier d\'installation XML valide pour';
public $A_CMP_INST_ERCDR = 'Echec pour créer un répertoire';
public $A_CMP_INST_FNOTE = 'n\'existe pas!';
public $A_CMP_INST_TAFC = 'Il y a déjà un fichier nommé';
public $A_CMP_INST_AYIT = '- Êtes vous sur de vouloir installer le même CMT deux fois ?';
public $A_CMP_INST_FCPF = 'Echec de copie du fichier';
public $A_CMP_INST_CPTO = 'à';
public $A_CMP_INST_UNINSTALL = 'Désinstaller';
public $A_CMP_INST_CUDIR = 'Un autre composant utilise déjà ce répertoire';
public $A_CMP_INST_SQLER = 'Erreur SQL';
public $A_CMP_INST_CCPHP = 'Impossible de copier le fichier d\'installation PHP.';
public $A_CMP_INST_CCUNPHP = 'Impossible de copier le fichier de désinstallation PHP.';
public $A_CMP_INST_UNERR = 'Désinstallation -  erreur';
public $A_CMP_INST_THCOM = 'Composant';
public $A_CMP_INST_ISCOR = 'est un composant vital, et ne peut-être désinstallé.<br />Vous pouvez le dépublier si vous ne voulez plus en faire usage.';
public $A_CMP_INST_XMLINV = 'Fichier XML invalide';
public $A_CMP_INST_OFEMP = 'Le champ répertoire étant vide, il est impossible de supprimer des fichiers';
public $A_CMP_INST_INCOM = 'Composants Installés';
public $A_CMP_INST_CURRE = 'Actuellement Installé';
public $A_CMP_INST_MENL = 'Lien de menu vers un composant';
public $A_CMP_INST_AUURL = 'URL de l\'auteur';
public $A_CMP_INST_NCOMP = 'Il n\'y a aucun composant personnalisé d\'installé';
public $A_CMP_INST_INSCO = 'Installer un nouveau Composant';
public $A_CMP_INST_DELE = 'Suppression';
public $A_CMP_INST_LIDE = 'ID de langue vide, impossible de supprimer les fichiers';
public $A_CMP_INST_ALL = 'tous';
public $A_CMP_INST_BKLM = 'Retour au gestionnaire de Langues';
public $A_CMP_INST_NWLA = 'Installer une nouvelle Langue';
public $A_CMP_INST_NFMM = 'Aucun fichier n\'est marqué comme fichier de plugin';
public $A_CMP_INST_MAMB = 'Manbot';
public $A_CMP_INST_AXST = 'existe déjà!';
public $A_CMP_INST_IOID = 'ID Objet Invalide';
public $A_CMP_INST_FFEM = 'Le champ répertoire étant vide, il est impossible de supprimer des fichiers';
public $A_CMP_INST_DXML = 'Suppression du fichier XML';
public $A_CMP_INST_ICMO = 'est un élément vital, qui ne peut pas être désinstallé.<br />Vous pouvez le dépublier si vous ne voulez plus en faire usage.';
public $A_CMP_INST_IMBT = 'Bots Installés';
public $A_CMP_INST_OMBT = 'Seuls les Bots affichés peuvent être désinstallés - Les Bots viraux ne peuvent pas être supprimés.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Type';
public $A_CMP_INST_NMBT = 'Il n\'y a aucun plugins qui ne soit pas essentiel ou personnalisé.';
public $A_CMP_INST_INMT = 'Installer un nouveau Bot';
public $A_CMP_INST_UCTP = 'Type de client inconnu';
public $A_CMP_INST_NFMD = 'Aucun fichier n\'est marqué comme fichier de module';
public $A_CMP_INST_MODULE = 'Module';
public $A_CMP_INST_ICMDL = 'est un module vital, qui ne peut pas être désinstallé.<br />Vous pouvez le dépublier si vous ne voulez plus en faire usage.';
public $A_CMP_INST_IMDL = 'Modules Installés';
public $A_CMP_INST_OMDL = 'Seuls les Modules affichés peuvent être désinstallés - Les Modules viraux ne peuvent pas être supprimés.';
public $A_CMP_INST_MDLF = 'Fichiers Modules';
public $A_CMP_INST_NMDL = 'Il n\'y a aucun Module qui ne soit pas essentiel ou personnalisé.';
public $A_CMP_INST_NWMDL = 'Installer un nouveau Module';
public $A_CMP_INST_ALLC = 'Tous';
public $A_CMP_INST_STMDL = 'Modules du Site';
public $A_CMP_INST_ADMDL = 'Modules Admin';
public $A_CMP_INST_DDEX = 'Répertoire inexistant, impossible de supprimer le(s) fichier(s)';
public $A_CMP_INST_TIDE = 'ID Template est vide, impossible de supprimer le(s) fichier(s)';
public $A_CMP_INST_TINS = 'Installer une nouvelle Template';
public $A_CMP_INST_BATP = 'Retour aux Templates';
public $A_CMP_INST_INSBR = 'Installer un nouveau Pont';
public $A_CMP_INST_BABR = 'Retour aux Ponts';
public $A_CMP_INST_ΒIDE = 'L\'ID du Pont est vide, impossible de supprimer le(s) fichier(s)';
public $A_INST_INCOM = 'Il a été détecté une incompatibilité éventuelle entre la version de Elxis que vous utilisez et l\'extension installée. 
En dehors de cela, le logiciel peut parfaitement fonctionner sans erreurs. Il s\'agit juste d\'un avertissement.';
public $A_INST_INCOMJOO = 'Ce paquet installé est pour le CMS Joomla!';
public $A_INST_INCOMMAM = 'Ce paquet installé est pour le CMS Mambo!';
public $A_INST_OLDER = 'L\'installation du paquet est pour une ancienn version de Elxis (%s) que la vôtre (%s)';
public $A_INST_NEWER = 'L\'installation du paquet est pour une nouvelle version de Elxis (%s) que la vôtre (%s)';
//2009.0
public $A_INST_DOINEDC = 'Télécharger et installer à partir du centre Elxis Downloads';
public $A_INST_FETCHAVEXTS = 'Récupérer la liste des extensions disponibles';
public $A_INST_MORE = 'Plus';
public $A_INST_LESS = 'Moins';
public $A_INST_SIZE = 'Taille';
public $A_INST_DOWNLOAD = 'Télécharger';
public $A_INST_DOWNLOADS = 'Télécharger';
public $A_INST_DOWNINST = 'Télécharger et installer';
public $A_INST_LICENSE = 'Licence';
public $A_INST_COMPAT = 'Compatibilité';
public $A_INST_DATESUB = 'Date de présentation';
public $A_INST_SUREINST = 'Êtes-vous sur de vouloir installer %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Up-to-date';
public $A_INST_OUTDATED = 'Désuet';
public $A_INST_INSTVERS = 'Version installée';
public $A_INST_UNLOAD = 'Décharger';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed."; //translators help: filled in be extension type (i.e. module)

}

?>