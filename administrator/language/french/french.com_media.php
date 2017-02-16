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
* @description: French language for component Media
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = 'Chemin Relatif';
public $A_CMP_ME_PMOUSEVD = 'Placez votre souris sur une icône pour afficher ses détails';
public $A_CMP_ME_RENAME = 'Renommer';
public $A_CMP_ME_COPYTO = 'Copier vers';
public $A_CMP_ME_NEWFOL = 'Nouveau Dossier';
public $A_CMP_ME_NEWFIL = 'Nouveau Fichier';
public $A_CMP_ME_OPEN = 'Ouvrir';
public $A_CMP_ME_VTHUMBS = 'Voir les vignettes';
public $A_CMP_ME_VICONS = 'Voir les Icônes';
public $A_CMP_ME_DBCLOP = 'Double cliquer pour Ouvrir:';
public $A_CMP_ME_DIRNEX = 'Le dossier <strong>%s</strong> n existe pas!';
public $A_CMP_ME_FILNEX = 'Le fichier <strong>%s</strong> n existe pas!';
public $A_CMP_ME_PERMS = 'Permissions';
public $A_CMP_ME_MODIF = 'Modifié';
public $A_CMP_ME_ACCESSED = 'Accédé';
public $A_CMP_ME_DOWNZIP = 'Téléchargez en zip';
public $A_CMP_ME_DODOWN = 'Voulez-vous télécharger ce dossier';
public $A_CMP_ME_ASZIP = 'en zip?';
public $A_CMP_ME_EXTHERE = 'Extraire ici';
public $A_CMP_ME_SELFNIMG = 'Le fichier sélectionné n est pas une image!';
public $A_CMP_ME_FSELFCL = 'En premier sélectionnez un fichier en cliquant dessus';
public $A_CMP_ME_RENEWFN = 'Renommer - Entrez un nouveau nom de fichier:';
public $A_CMP_ME_EXFINAME = 'Il existe déjà un fichier nommé %s !';
public $A_CMP_ME_EXFONAME = 'Il existe déjà un dossier nommé %s !';
public $A_CMP_ME_FIRENTO = 'Le fichier <strong>"%s"</strong> a été renommé en <strong>"%s"</strong>';
public $A_CMP_ME_FORENTO = 'Le dossier <strong>"%s"</strong> a été renommé en <strong>"%s"</strong>';
public $A_CMP_ME_RENFAIL = 'Echec!';
public $A_CMP_ME_ALLFIFODEL = 'Tous les fichiers/dossiers dans ce répertoire seront supprimés!';
public $A_CMP_ME_DELQUEST = 'Supprimer "%s"?';
public $A_CMP_ME_FIDELSUC = 'Fichier supprimé avec succès';
public $A_CMP_ME_FODELSUC = 'Dossier supprimé avec succès';
public $A_CMP_ME_DELFAIL = 'Echec!';
public $A_CMP_ME_COPYTOFO = 'Copier dans le dossier:';
public $A_CMP_ME_SRCNEX = 'Le fichier source n existe pas!';
public $A_CMP_ME_SRCISDIR = 'LA SOURCE EST UN REPERTOIRE! VOUS NE POUVEZ PAS COPIER UN REPERTOIRE.';
public $A_CMP_ME_EXFIINDIR = 'Il y a déjà un fichier nommé <strong>%s</strong> dans le répertoire %s';
public $A_CMP_ME_FICOPYSUC = 'Le fichier <strong>%s</strong> a été copié avec succès vers le répertoire %s';
public $A_CMP_ME_FICOPYSUC2 = 'Le fichier <strong>%s</strong> a été copié avec succès du répertoire %s vers <strong>%s</strong>';
public $A_CMP_ME_FICOPYFAIL = 'Impossible de copier <strong>%s</strong> vers le répertoire %s';
public $A_CMP_ME_NEWFONAME = 'Entrez un nouveau nom de dossier:';
public $A_CMP_ME_CHPERMS = 'Changer les permissions';
public $A_CMP_ME_SIZE = 'Taille';
public $A_CMP_ME_DIMS = 'Dimensions';
public $A_CMP_ME_NAMENEWFO = 'Vous devez donner un nom pour ce nouveau dossier!';
public $A_CMP_ME_FOCRESUC = 'Le dossier <strong>%s</strong> a été créé avec succès.';
public $A_CMP_ME_CNCRNEWFO = 'Impossible de créer un nouveau dossier!';
public $A_CMP_ME_INVPERMS = 'Permissions invalides!';
public $A_CMP_ME_PERMCHSUC = 'Les permissions sur le fichier ont été changées avec succès à <strong>%s</strong>';
public $A_CMP_ME_CHMODFAIL = 'Echec du changement de mode!';
public $A_CMP_ME_SELFIUP = 'Sélectionnez un fichier à transférer';
public $A_CMP_ME_SELFNFLV = 'Le fichier sélectionné n est pas un fichier flash vidéo (flv)!';
public $A_CMP_ME_PLAY = 'Jouer';
public $A_CMP_ME_SELFNMP3 = 'Le fichier sélectionné n est pas un fichier mp3!';
public $A_CMP_ME_EXTRZIP = 'Extraire le Zip';
public $A_CMP_ME_EXTRCUFO = 'Extraire tous les fichiers de %s dans le dossier courrant?';
public $A_CMP_ME_FINOZIP = 'Le fichier <strong>%s</strong> n est pas un fichier zip!';
public $A_CMP_ME_UNERREXT = 'Erreur inattendue pendant l extraction!';
public $A_CMP_ME_FIEXTRD = 'les fichiers ont été extraits.';
public $A_CMP_ME_REFVIEW = 'Rafraîchissez pour les afficher';
public $A_CMP_ME_DOWNLOAD = 'Téléchargements';
public $A_CMP_ME_TODOWNCL = 'Pour télécharger, cliquez sur le nom du fichier en-dessous de son icône.';
public $A_CMP_ME_RESIZE = 'Redimensionner';
public $A_CMP_ME_FINORES = 'Le fichier sélectionné n est pas redimensionnable';
public $A_CMP_ME_RESTO = 'Redimensionner à';
public $A_CMP_ME_KEEPRAT = 'Ne pas tenir compte du ratio';
public $A_CMP_ME_BASEWID = 'Basé sur la largeur de l\'image';
public $A_CMP_ME_INVWNIMG = 'Largeur Invalide pour cette nouvelle image!';
public $A_CMP_ME_INVHNIMG = 'Hauteur Invalide pour cette nouvelle image!';
public $A_CMP_ME_IMGRESSUC = 'Image redimensionnée avec succès!';
public $A_CMP_ME_CNOTRESIMG = 'Impossible de redimensionner les images!';
public $A_CMP_ME_IE6UPGRADE = '<strong>Vous utilisez Internet Explorer 6!</strong> Veuillez le mettre à jour vers la version7 ou utilisez <a href="http://www.mozilla.com" target="_blank">Firefox</a>.'; 
public $A_CMP_ME_USEFIREFOX = 'Pour de meilleur performance veuillez utiliser si possible <a href="http://www.mozilla.com" target="_blank">Firefox</a>.';
public $A_CMP_ME_WATERMARK = 'Filigrane';
public $A_CMP_ME_CNOTWATERF = 'Vous ne pouvez pas mettre un filigrane sur ce fichier!';
public $A_CMP_ME_TEXT = 'Texte';
public $A_CMP_ME_FONT = 'Police';
public $A_CMP_ME_OPACITY = 'Opacité';
public $A_CMP_ME_WATERPOS = 'Position du filigrane';
public $A_CMP_ME_XAXIS = 'Axe X';
public $A_CMP_ME_YAXIS = 'Axe Y';
public $A_CMP_ME_COLOR = 'Couleurs';
public $A_CMP_ME_IMGQUAL = 'Qualité d\'image';
public $A_CMP_ME_SAVEAS = 'Enregistrer sous...';
public $A_CMP_ME_BLACK = 'Noir';
public $A_CMP_ME_WHITE = 'Blanc';
public $A_CMP_ME_RED = 'Rouge';
public $A_CMP_ME_BLUE = 'Bleu';
public $A_CMP_ME_ORANGE = 'Orange';
public $A_CMP_ME_YELLOW = 'Jaune';
public $A_CMP_ME_GREEN = 'Vert';
public $A_CMP_ME_GRAY = 'Gris';
public $A_CMP_ME_LGRAY = 'Gris Clair';
public $A_CMP_ME_SHADOW = 'Ombre portée';
public $A_CMP_ME_NOSHADOW = 'Pas d\'ombre portée';
public $A_CMP_ME_NEWFDIFOLD = 'Le Nouveau nom de fichier a une extension différente de l\'original!';
public $A_CMP_ME_OVERIMGNEX = 'La superposition d image n existe pas!';
public $A_CMP_ME_WATERGENSUC = 'Filigrane de l image généré avec succès.<br />Fermez cette fenêtre et actualiser le gestionnaire de médias pour voir la nouvelle image.';
public $A_CMP_ME_CNOTGENWAT = '<strong>Impossible de générer le filigrane.</strong><br />Cette fonctionnalité nécessite GD et la bibliothèque PHP FreeType.';
public $A_CMP_ME_MEMANG = 'Gestion des médias';
public $A_CMP_ME_UPLOAD = 'Transfert';
public $A_CMP_ME_VALFTYPES = 'Type de fichiers Valides';
public $A_CMP_ME_VIDEO = 'Vidéo';
public $A_CMP_ME_AUDIO = 'Audio';
public $A_CMP_ME_OTHER = 'Autres';

}

?>