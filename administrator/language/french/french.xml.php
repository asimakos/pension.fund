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
* @description: French Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'L\'accès direct à cet endroit n\'est pas autorisé.' );

class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Image du Menu';
protected $AX_MENUIMGD = 'Une petite image à placer à gauche ou à doite de votre élément de menu. Elle doit être enregistrée dans le répertoire images/stories/';
protected $AX_MENUIMGONLYL = 'Utilisez seulement Image de Menu';
protected $AX_MENUIMGONLYD = 'Si vous sélectionnez <strong>Oui</strong> alors les articles de menu seront représentés SEULEMENT par l image que vous avez choisie.<br><br>Si vous sélectionnez <strong>Non</strong> Alors les articles de menu seront représentés par l image que vous avez choisie PLUS le texte.';
protected $AX_MENUIMG2D = 'Une petite image va être placée à gauche ou directement dans votre article de menu, les images doivent être dans le répertoire images/.';
protected $AX_PAGCLASUFL = 'Suffixe CSS de Page';
protected $AX_PAGCLASUFD = 'Un suffixe à appliquer aux classes CSS de la page, ceci permet d attribuer un style individuel aux pages';
protected $AX_TEXTPAGECL = 'Article Suffix';
protected $AX_TEXTPAGECLD = 'Un suffixe à appliquer aux classes CSS de l article, ceci permet d attribuer un style individuel aux Articles/Contenu.';
protected $AX_BACKBUTL = 'Bouton Retour';
protected $AX_BACKBUTD = 'Afficher/Masquer un bouton Retour pour revenir à la page précédente.';
protected $AX_USEGLB = 'Utilisation Globale';
protected $AX_HIDE = 'Masquer';
protected $AX_SHOW = 'Afficher';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Afficher le Titre de la Page';
protected $AX_PAGTITLSD = 'Afficher/Masquer le Titre de la Page.';
protected $AX_PAGTITLL = 'Titre de la Page';
protected $AX_PAGTITLD = 'Texte à afficher sur le haut de la page. Si laissé vide, le Nom du Menu sera utilisé à la place.';
protected $AX_PAGTITL2D = 'Texte à afficher en haut de page.';
protected $AX_LEFT = 'Gauche';
protected $AX_RIGHT = 'Droit';
protected $AX_PRNTICOL = 'Icône Imprimer';
protected $AX_PRNTICOD = 'Afficher/Masquer le bouton Imprimer - Le changement n affecte que cette page.';
protected $AX_YES = 'Oui';
protected $AX_NO = 'Non';
protected $AX_SECNML = 'Nom de Section';
protected $AX_SECNMD = 'Afficher/Masquer la section à laquelle appartient l article.';
protected $AX_SECNMLL = 'Nom de section cliquable';
protected $AX_SECNMLD = 'Rendre cliquable le nom de section à laquelle appartient l article.';
protected $AX_CATNML = 'Nom de Catégorie';
protected $AX_CATNMD = 'Afficher/Masquer la catégorie à laquelle appartient l article.';
protected $AX_CATNMLL = 'Nom de catégorie cliquable';
protected $AX_CATNMLD = 'Rendre cliquable le nom de catégorie à laquelle appartient l article.';
protected $AX_LNKTTLL = 'Titres cliquables';
protected $AX_LNKTTLD = 'Rendre les titres des articles cliquables.';
protected $AX_ITMRATL = 'Evaluation des articles';
protected $AX_ITMRATD = 'Afficher/Masquer le système d évaluation des articles - Le changement n affecte que cette page.';
protected $AX_AUTNML = 'Nom Auteur';
protected $AX_AUTNMD = 'Afficher/Masquer le nom de l auteur - Le changement n affecte que cette page';
protected $AX_CTDL = 'Date/Heure de création';
protected $AX_CTDD = 'Afficher/Masquer la Date de Création - Le changement n affecte que cette page.';
protected $AX_MTDL = 'Date/Heure de modification';
protected $AX_MTDD = 'Afficher/Masquer la Date de Modification - Le changement n affecte que cette page.';
protected $AX_PDFICL = 'Icône PDF';
protected $AX_PDFICD = 'Afficher/Masquer le bouton PDF - Le changement n affecte que cette page.';
protected $AX_PRICL = 'Icône Imprimer';
protected $AX_PRICD = 'Afficher/Masquer le bouton Imprimer - Le changement n affecte que cette page.';
protected $AX_EMICL = 'Icône Email';
protected $AX_EMICD = 'Afficher/Masquer le bouton Email - Le changement n affecte que cette page.';
protected $AX_FTITLE = 'Titre';
protected $AX_FAUTH = 'Auteur';
protected $AX_FHITS = 'Clics';
protected $AX_DESCRL = 'Description';
protected $AX_DESCRD = 'Afficher/Masquer la description ci-dessous.';
protected $AX_DESCRTXL = 'Description du Texte';
protected $AX_DESCRTXD = 'Description pour la page, si laissé vide il chargera _WEBLINKS_DESC de votre fichier de langue';
protected $AX_IMAGEL = 'Image';
protected $AX_IMGFRPD = 'Image pour la page, doit être localisé dans le répertoire /images/stories folder. Par défaut web_links.jpg, Aucune image signifiera qu aucune image n est chargée.';
protected $AX_IMGALL = 'Alignement Image';
protected $AX_IMGALD = 'Alignement de l image.';
protected $AX_TBHEADL = 'En-têtes du tableau';
protected $AX_TBHEADD = 'Afficher/Masquer les en-têtes du tableau.';
protected $AX_POSCOLL = 'Colonne Position';
protected $AX_POSCOLD = 'Afficher/Masquer la colonne Position/Titre.';
protected $AX_EMAILCOLL = 'Colonne Email';
protected $AX_EMAILCOLD = 'Afficher/Masquer la colonne Email.';
protected $AX_TELCOLL = 'Colonne Téléphone';
protected $AX_TELCOLD = 'Afficher/Masquer la colonne Téléphone.';
protected $AX_FAXCOLL = 'Colonne Fax';
protected $AX_FAXCOLD = 'Afficher/Masquer la colonne Fax.';
protected $AX_LEADINGL = '# Principal';
protected $AX_LEADINGD = 'Nombre d articles à afficher en pleine largeur en haut de page. Si 0 est saisi, aucun article ne sera affiché en Principal.';
protected $AX_INTROL = '# Intro';
protected $AX_INTROD = 'Nombre d articles à afficher avec le texte d introduction uniquement. Si un texte principal a été saisi pour l article, le lien Lire la suite sera affiché.';
protected $AX_COLSL = 'Colonnes';
protected $AX_COLSD = 'Nombre de colonnes pour l affichage des articles avec texte d introduction.';
protected $AX_LNKSL = '# Liens';
protected $AX_LNKSD = 'Nombre d articles à afficher sous forme de liens.';
protected $AX_CATORL = 'Trier par Catégorie';
protected $AX_CATORD = 'Ce paramètre prend le pas sur le tri défini dans le gestionnaire d articles..';
protected $AX_OCAT01 = 'Non, ordre de tri simple uniquement';
protected $AX_OCAT02 = 'Tri alphabétique (A-Z) sur le titre';
protected $AX_OCAT03 = 'Tri alphabétique inverse (Z-A) sur le titre';
protected $AX_OCAT04 = 'Ordre';
protected $AX_PRMORL = 'Ordre Principal';
protected $AX_PRMORD = 'L ordre dans lequel les articles seront montrés.';
protected $AX_OPRM01 = 'Défaut';
protected $AX_OPRM02 = 'Tri du gestionnaire de la Page Accueil';
protected $AX_OPRM03 = 'Plus ancien en tête';
protected $AX_OPRM04 = 'Plus récent en tête';
protected $AX_OPRM07 = 'Tri alphabétique (A-Z) par Auteur';
protected $AX_OPRM08 = 'Tri alphabétique inverse (Z-A) par Auteur';
protected $AX_OPRM09 = 'Le plus de clics';
protected $AX_OPRM10 = 'Le moins de clics';
protected $AX_PAGL = 'Pagination';
protected $AX_PAGD = 'Afficher/Masquer la Pagination.';
protected $AX_PAGRL = 'Résultats de la pagination';
protected $AX_PAGRD = 'Afficher/Masquer les résultats de la pagination (par ex. 1-4 sur 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Afficher {mosimages}.';
protected $AX_ITMTL = 'Titre Article';
protected $AX_ITMTD = 'Afficher/Masquer le titre des articles.';
protected $AX_REMRL = 'Lire la suite';
protected $AX_REMRD = 'Afficher/Masquer le lien Lire la suite.';
protected $AX_OTHCATL = 'Autres Catégories';
protected $AX_OTHCATD = 'En voyant une Catégorie, Afficher/Masquer la liste des autres Catégories.';
protected $AX_TDISTPD = 'Texte à afficher sur le ahut de la page.';
protected $AX_ORDBYL = 'Trier par';
protected $AX_ORDBYD = 'Cela ignorera l ordre des articles.';
protected $AX_MCS_DESCL = 'Description';
protected $AX_SHCDESD = 'Afficher/Masquer la description de la Catégorie.';
protected $AX_DESCIL = 'Description Image';
protected $AX_MUDATFL = 'Format de la Date';
protected $AX_MUDATFD = 'Format de date affiché en utilisant la commande strftime PHP - si le champ est vierge, c est le format de date correspondant au fichier de langue qui sera affiché.';
protected $AX_MUDATCL = 'Colonne Date';
protected $AX_MUDATCD = 'Afficher/Masquer la colonne Date.';
protected $AX_MUAUTCL = 'Colonne Auteur';
protected $AX_MUAUTCD = 'Afficher/Masquer la colonne Auteur.';
protected $AX_MUHITCL = 'Colonne Clics';
protected $AX_MUHITCD = 'Afficher/Masquer la colonne Clics.';
protected $AX_MUNAVBL = 'Barre de Navigation';
protected $AX_MUNAVBD = 'Afficher/Masquer la Barre de Navigation.';
protected $AX_MUORDSL = 'Menu déroulant Trier';
protected $AX_MUORDSD = 'Afficher/Masquer le menu déroulant permettant de trier les articles.';
protected $AX_MUDSPSL = 'Menu déroulant Afficher';
protected $AX_MUDSPSD = 'Afficher/Masquer le menu déroulant permettant de définir le nombre d articles à afficher par page.';
protected $AX_MUDSPNL = 'Valeur des listes';
protected $AX_MUDSPND = 'Nombre d articles par défaut à afficher par page.';
protected $AX_MUFLTL = 'Filtre';
protected $AX_MUFLTD = 'Afficher/Masquer le champ permttant de filtrer les articles.';
protected $AX_MUFLTFL = 'Filtre Champs';
protected $AX_MUFLTFD = 'A quel champ le filtre peut-il être appliqué.';
protected $AX_MUOCATL = 'Autres catégories';
protected $AX_MUOCATD = 'Afficher/Masquer la liste des autres catégories.';
protected $AX_MUECATL = 'Catégories vides';
protected $AX_MUECATD = 'Afficher/Masquer la catégories vides (ne comprenant pas d articles).';
protected $AX_CATDSCL = 'Description de la catégorie';
protected $AX_CATDSBLND = 'Afficher/Masquer la description de la catégorie, elle sera afichée au-dessous du nom de la catégorie.';
protected $AX_NAMCOLL = 'Nom de la Colonne';
protected $AX_LINKDSCL = 'Descriptions des Liens';
protected $AX_LINKDSCD = 'Afficher/Masquer la Description des Liens.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Ce composant montre une liste des Coordonnées des contacts.';
protected $AX_CCT_CATLISTSL = 'Catégories - Vue en Section';
protected $AX_CCT_CATLISTSD = 'Afficher/Masquer la liste des catégories dans la vue en Section de la page.';
protected $AX_CCT_CATLISTCL = 'Catégories - Vue en Catégorie';
protected $AX_CCT_CATLISTCD = 'fficher/Masquer la liste des catégories dans la vue en Tableau de la page.';
protected $AX_CCT_CATDSCD = 'Afficher/Masquer la description des catégories dans la liste des autres catégories.';
protected $AX_CCT_NOCATITL = '# Eléments dans la catégorie';
protected $AX_CCT_NOCATITD = 'Afficher/Masquer le nombre d éléments dans la catégorie.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Paramètres pour les Articles de Contact.';
protected $AX_CIT_NAMEL = 'Nom';
protected $AX_CIT_NAMED = 'Afficher/Masquer le champ Nom.';
protected $AX_CIT_POSITL = 'Fonction';
protected $AX_CIT_POSITD = 'Afficher/Masquer le champ Fonction.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Afficher/Masquer le champ email. Si vous choisissez Afficher l adresse sera encodée pour la protéger contre les robots collecteurs et le Spam.';
protected $AX_CIT_SADDREL = 'Adresse';
protected $AX_CIT_SADDRED = 'Afficher/Masquer le champ Adresse.';
protected $AX_CIT_TOWNL = 'Ville';
protected $AX_CIT_TOWND = 'Afficher/Masquer le champ Ville.';
protected $AX_CIT_STATEL = 'Départ/Région';
protected $AX_CIT_STATED = 'Afficher/Masquer le champ Départ./Région.';
protected $AX_CIT_COUNTRL = 'Pays';
protected $AX_CIT_COUNTRD = 'Afficher/Masquer le champs Pays.';
protected $AX_CIT_ZIPL = 'Code Postal';
protected $AX_CIT_ZIPD = 'Afficher/Masquer le champs Code Postal.';
protected $AX_CIT_TELL = 'Téléphone';
protected $AX_CIT_TELD = 'Afficher/Masquer le champs téléphone.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Afficher/Masquer le champs fax.';
protected $AX_CIT_MISCL = 'Autres Informations';
protected $AX_CIT_MISCD = 'Afficher/Masquer le champs Autres Informations.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Afficher/Masquer l option VCard. Elle permet de télécharger la fiche contact au format MS Outlook';
protected $AX_CIT_CIMGL = 'Images';
protected $AX_CIT_CIMGD = 'Afficher/Masquer les images.';
protected $AX_CIT_DEMAILL = 'Description des Emails';
protected $AX_CIT_DEMAILD = 'Afficher/Masquer la description en dessous du texte.';
protected $AX_CIT_DTXTL = 'Texte de Description';
protected $AX_CIT_DTXTD = 'Le texte de Description pour le formulaire d Email, laissez le champs vide si vous voulez utiliser _EMAIL_DESCRIPTION dans la définition du fichier langue.';
protected $AX_CIT_EMFRML = 'Formulaire Email';
protected $AX_CIT_EMFRMD = 'Afficher/Masquer le champs formulaire.';
protected $AX_CIT_EMCPYL = 'Copie des Emails';
protected $AX_CIT_EMCPYD = 'Afficher/Masquer La case à cocher pour envoyer par courrier électronique une copie à l adresse des expéditeurs.';
protected $AX_CIT_DDL = 'Menu Déroulant';
protected $AX_CIT_DDD = 'Afficher/Masquer le champs Voir les Contacts en menu déroulant.';
protected $AX_CIT_ICONTXL = 'Icône/texte';
protected $AX_CIT_ICONTXD = 'Afficher des Icônes, du texte ou rien à côté des informations du contact. Voir ci-dessous.';
protected $AX_CIT_ICONS = 'Icônes';
protected $AX_CIT_TEXT = 'Texte';
protected $AX_CIT_NONE = 'Aucun';
protected $AX_CIT_ADICONL = 'Icône Adresse';
protected $AX_CIT_ADICOND = 'Icône pour l adresse.';
protected $AX_CIT_EMICONL = 'Icône Email';
protected $AX_CIT_EMICOND = 'Icône pour l Email.';
protected $AX_CIT_TLICONL = 'Icône Téléphone';
protected $AX_CIT_TLICOND = 'Icône pour le Téléphone';
protected $AX_CIT_FXICONL = 'Icône Fax';
protected $AX_CIT_FXICOND = 'Icône pour le Fax.';
protected $AX_CIT_MCICONL = 'Icône Informations';
protected $AX_CIT_MCICOND = 'Icône pour les Autres Informations.';
protected $AX_CCT_NAMEL = 'Nom';
protected $AX_CCT_NAMED = 'Afficher/Masquer le nom.';
protected $AX_CCT_POSITL = 'Fonction';
protected $AX_CCT_POSITD = 'Afficher/Masquer la fonction.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Afficher/Masquer le champ email. Si vous choisissez Afficher l adresse sera encodée pour la protéger contre les robots collecteurs et le Spam.';
protected $AX_CCT_SADDREL = 'Adresse';
protected $AX_CCT_SADDRED = 'Afficher/Masquer le champ Adresse.';
protected $AX_CCT_TOWNL = 'Ville';
protected $AX_CCT_TOWND = 'Afficher/Masquer le champ Ville.';
protected $AX_CCT_STATEL = 'Départ/Région';
protected $AX_CCT_STATED = 'Afficher/Masquer le champ Départ./Région.';
protected $AX_CCT_COUNTRL = 'Pays';
protected $AX_CCT_COUNTRD = 'Afficher/Masquer le champs Pays.';
protected $AX_CCT_ZIPL = 'Code Postal';
protected $AX_CCT_ZIPD = 'Afficher/Masquer le champs Code Postal.';
protected $AX_CCT_TELL = 'Téléphone';
protected $AX_CCT_TELD = 'Afficher/Masquer le champs téléphone.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Afficher/Masquer le champs fax.';
protected $AX_CCT_MISCL = 'Autres Informations';
protected $AX_CCT_MISCD = 'Afficher/Masquer le champs Autres Informations.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Afficher/Masquer l option VCard. Elle permet de télécharger la fiche contact au format MS Outlook.';
protected $AX_CCT_CIMGL = 'Images';
protected $AX_CCT_CIMGD = 'Afficher/Masquer les images.';
protected $AX_CCT_DEMAILL = 'Description des Emails';
protected $AX_CCT_DEMAILD = 'Afficher/Masquer la description en dessous du texte.';
protected $AX_CCT_DTXTL = 'Texte de Description';
protected $AX_CCT_DTXTD = 'Le texte de Description pour le formulaire d Email, laissez le champs vide si vous voulez utiliser _EMAIL_DESCRIPTION dans la définition du fichier langue.';
protected $AX_CCT_EMFRML = 'Formulaire Email';
protected $AX_CCT_EMFRMD = 'Afficher/Masquer le champs formulaire.';
protected $AX_CCT_EMCPYL = 'Copie des Emails';
protected $AX_CCT_EMCPYD = 'Afficher/Masquer La case à cocher pour envoyer par courrier électronique une copie à l adresse des expéditeurs.';
protected $AX_CCT_DDL = 'Menu Déroulant';
protected $AX_CCT_DDD = 'Afficher/Masquer le champs Voir les Contacts en menu déroulant.';
protected $AX_CCT_ICONTXL = 'Icône/texte';
protected $AX_CCT_ICONTXD = 'Afficher des Icônes, du texte ou rien à côté des informations du contact. Voir ci-dessous.';
protected $AX_CCT_ICONS = 'Icônes';
protected $AX_CCT_TEXT = 'Texte';
protected $AX_CCT_NONE = 'Aucun';
protected $AX_CCT_ADICONL = 'Icône Adresse';
protected $AX_CCT_ADICOND = 'Icône pour l adresse.';
protected $AX_CCT_EMICONL = 'Icône Email';
protected $AX_CCT_EMICOND = 'Icône pour l Email.';
protected $AX_CCT_TLICONL = 'Icône Téléphone';
protected $AX_CCT_TLICOND = 'Icône pour le Téléphone.';
protected $AX_CCT_FXICONL = 'Icône Fax';
protected $AX_CCT_FXICOND = 'Icône pour le Fax.';
protected $AX_CCT_MCICONL = 'Icône Informations';
protected $AX_CCT_MCICOND = 'Icône pour les Autres Informations.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Cela affichera une page de contenu simple.';
protected $AX_CNT_INTEXTL = 'Texte d Intro';
protected $AX_CNT_INTEXTD = 'Afficher/Masquer le texte d Intro.';
protected $AX_CNT_KEYRL = 'Texte Clé de Référence';
protected $AX_CNT_KEYRD = 'Texte clé qui peut servir à référencer un article (Utilisé par exemple dans l Aide en ligne).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Ce composant affiche tous les articles publiés et paramétrés pour être affiché en page d accueil du site.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Paramètres pour le composant de Connexion.';
protected $AX_LG_LPTL = 'Titre Page Connexion';
protected $AX_LG_LPTD = 'Texte placé en haut de page de connexion. Si le champ reste vide le nom du menu sera utilisé à la place.';
protected $AX_LG_LRURLL = 'URL de redirection';
protected $AX_LG_LRURLD = 'Adresse de la page à atteindre une fois connecté. Si se champ reste vide le renvoi sera fait vers la page d accueil.';
protected $AX_LG_LJSML = 'Message javascript de Connexion';
protected $AX_LG_LJSMD = 'Afficher/Masquer le Pop-up javascript indiquant le succès de la connexion.';
protected $AX_LG_LDESCL = 'Texte de Description';
protected $AX_LG_LDESCD = 'Afficher/Masquer le texte de description ci-dessous.';
protected $AX_LG_LDESTL = 'Texte de Description';
protected $AX_LG_LDESTD = 'Texte à afficher sur la page de connexion. Si ce champ reste vide la variable _LOGIN_DESCRIPTION sera utilisée.';
protected $AX_LG_LIMGL = 'Image Connexion';
protected $AX_LG_LIMGD = 'Image de la page de connexion.';
protected $AX_LG_LIMGAL = 'Alignement Image';
protected $AX_LG_LIMGAD = 'Alignement de l image.';
protected $AX_LG_LOPTL = 'Titre Page Déconnexion';
protected $AX_LG_LOPTD = 'Texte placé en haut de page de déconnexion. Si le champ reste vide le nom du menu sera utilisé à la place.';
protected $AX_LG_LORURLL = 'URL de redirection';
protected $AX_LG_LORURLD = 'Adresse de la page à atteindre une fois déconnecté. Si se champ reste vide le renvoi sera vers la page d accueil.';
protected $AX_LG_LOJSML = 'Message javascript de Déconnexion';
protected $AX_LG_LOJSMD = 'Afficher/Masquer le Pop-up javascript indiquant le succès de la déconnexion.';
protected $AX_LG_LODSCL = 'Texte de Description';
protected $AX_LG_LODSCD = 'Afficher/Masquer le texte de description ci-dessous.';
protected $AX_LG_LODSTL = 'Texte de Description';
protected $AX_LG_LODSTD = 'Texte à afficher sur la page de connexion. Si ce champ reste vide la variable _LOGOUT_DESCRIPTION sera utilisée.';
protected $AX_LG_LOGOIL = 'Image Déconnexion';
protected $AX_LG_LOGOID = 'Image de la page de déconnexion.';
protected $AX_LG_LOGOIAL = 'Alignement Image';
protected $AX_LG_LOGOIAD = 'Alignement Image.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Ce composant vous permet d envoyer un email de masse à certains groupes d utilisateur.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Ce composant gère les médias de site.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Ce composant gère vos Menus.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Lien - Article Composant';
protected $AX_MUCIL_CDESC = 'Crée un lien vers un article publié.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Composants';
protected $AX_MUCOMP_CDESC = 'Permet d afficher l interface publique d un composant que vous avez installé.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tableau - Catégorie Contact';
protected $AX_MUCCT_CDESC = 'Affiche une vue en tableau des contacts d une catégorie donnée.';
protected $AX_MUCCT_CATDL = 'Description de la catégorie';
protected $AX_MUCCT_CATDD = 'Afficher/Masquer la description pour la liste des autres catégories.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Lien - Lien vers un Contact';
protected $AX_MUCTIL_CDESC = 'Crée un lien vers un contact publié';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Contenu Catégorie Archive';
protected $AX_MUCAC_CDESC = 'Affichage un type de blog d une liste d articles archivés pour une catégorie donnée.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Contenu Section Archive';
protected $AX_MUCAS_CDESC = 'Affichage type blog d une liste d articles archivés pour une section donnée.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Contenu Catégorie';
protected $AX_MUCBC_CDESC = 'Affichage type blog d articles appartenant à une ou plusieurs catégories.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Contenu Section';
protected $AX_MUCBS_CDESC = 'Affichage type blog d articles appartenant à une ou plusieurs sections.';
protected $AX_MUCBS_SHSD = 'Afficher/Masquer la description de la Section.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tableau - Contenu Catégorie';
protected $AX_MUCC_CDESC = 'Affiche une vue en tableau des articles d une catégorie donnée.';
protected $AX_MUCC_SHLOCD = 'Afficher/Masquer la liste des autres Catégories.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Lien - Article de Contenu';
protected $AX_MCIL_CDESC = 'Crée un lien vers un article publié.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tableau - Contenu Section';
protected $AX_MCS_CDESC = 'Crée une liste des catégories pour une section donnée.';
protected $AX_MCS_STL = 'Titre de la Section';
protected $AX_MCS_STD = 'Afficher/Masquer le titre de la section.';
protected $AX_MCS_SHCTID = 'Afficher/Masquer une image pour la description de la section Description.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Lien - Article Statique';
protected $AX_MLSC_CDESC = 'Crée un lien vers un article statique.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tableau - Flux RSS';
protected $AX_MNSFC_CDESC = 'Affiche une vue en tableau des flux RSS d une catégorie donnée.';
protected $AX_MNSFC_SHNCD = 'Afficher/Masquer le nom de la colonne.';
protected $AX_MNSFC_ACL = 'Colonne Articles';
protected $AX_MNSFC_ACD = 'Afficher/Masquer la colonne Article.';
protected $AX_MNSFC_LCL = 'Colonne Lien';
protected $AX_MNSFC_LCD = 'Afficher/Masquer la colonne Lien.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Lien - Flux RSS';
protected $AX_MNSFL_CDESC = 'Crée un lien vers un flux RSS individuel publié.';
protected $AX_MNSFL_FDIML = 'Image du flux RSS';
protected $AX_MNSFL_FDIMD = 'Afficher/Masquer l image du flux RSS.';
protected $AX_MNSFL_FDDSL = 'Description du flux RSS';
protected $AX_MNSFL_FDDSD = 'Afficher/Masquer la description du flux RSS.';
protected $AX_MNSFL_WDCL = 'Nombre de mots';
protected $AX_MNSFL_WDCD = 'Permet de limiter en nombre de mots l affichage du texte de description d un article. Si la valeur est 0, l intégralité de la description sera affichée.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separateurs';
protected $AX_MSEP_CDESC = 'Permet d insérer un séparateur entre 2 liens.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Lien - Url';
protected $AX_MURL_CDESC = 'Crée un lien à partir d une URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tableau - Liens Web Catégorie';
protected $AX_MWLC_CDESC = 'Affiche une vue en tableau des liens web d une catégorie donnée.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Crée un IFrame pour encapsuler une page ou un site externe dans le site.';
protected $AX_MWRP_SCRBL = 'Barres de défilement';
protected $AX_MWRP_SCRBD = 'Afficher/Masquer les barres de défillement horizontale & verticale.';
protected $AX_MWRP_WDTL = 'Largeur';
protected $AX_MWRP_WDTD = 'Largeur de l Iframe, vous pouvez entre une valeur en pixels ou un pourcentage en utilisant le symbole %.';
protected $AX_MWRP_HEIL = 'Hauteur';
protected $AX_MWRP_HEID = 'Hauteur de la fenêtre de l IFrame.';
protected $AX_MWRP_AHL = 'Hauteur automatique	';
protected $AX_MWRP_AHD = 'La hauteur s ajustera automatiquement à celle de la page externe. Fonctionnera seulement pour les pages externes de votre propore domaine. Si vous relevez une erreur javascript, assurez vous que ce paramètre est désactivé. La compatibilité XHTML pour cette page sera rompue.';
protected $AX_MWRP_AADL = 'Auto';
protected $AX_MWRP_AADD = 'Par défaut http:// sera ajouté à moins que ne soit détectée la présence de http:// ou https:// dans l URL saisie, cela vous permet de désactiver cette fonctionnalité.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Lien Système';
protected $AX_MSYS_CDESC = 'Crée un lien vers une caractéristique du système';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Ce composant gére les Flux RSS/RDF.';
protected $AX_NFE_DPD = 'Description';
protected $AX_NFE_SHFNCD = 'Afficher/Masquer le texte de description du flux.';
protected $AX_NFE_NOACL = 'colonne # Articles';
protected $AX_NFE_NOACD = 'Afficher/Masquer la colonne du nombre d articles dans le flux.';
protected $AX_NFE_LCL = 'Colonne Liens';
protected $AX_NFE_LCD = 'Afficher/Masquer la colonne Liens.';
protected $AX_NFE_IDL = 'Description Elément';
protected $AX_NFE_IDD = 'Afficher/Masquer la description ou le texte d introduction de l élément.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Ce composant gére les fonctions de Recherche.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Ce composant contrôle les paramètrages de Syndication.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Mise en cache des fichiers de syndication.';
protected $AX_SYN_CACHTL = 'Durée de vie du cache';
protected $AX_SYN_CACHTD = 'Les fichiers en cache seront rafraîchis toutes les x secondes.';
protected $AX_SYN_ITMSL = '# Eléments';
protected $AX_SYN_ITMSD = 'Nombre d éléments à syndiquer.';
protected $AX_SYN_ITMSDFLT = 'Syndication Elxis';
protected $AX_SYN_TITLE = 'Titre de la syndication';
protected $AX_SYN_DESCD = 'Description de la syndication.';
protected $AX_SYN_DESCDFLT = 'Syndication du site Elxis';
protected $AX_SYN_IMGD = 'Image à inclure dans la syndication.';
protected $AX_SYN_IMGAL = 'Texte alternatif pour l image';
protected $AX_SYN_IMGAD = 'Texte alternatif pour l image.';
protected $AX_SYN_IMGADFLT = 'Motorisé par Elxis';
protected $AX_SYN_LMTL = 'Limite de texte';
protected $AX_SYN_LMTD = 'Limiter le texte de l article à la valeur indiquée ci-dessous.';
protected $AX_SYN_TLENL = 'Longueur du texte';
protected $AX_SYN_TLEND = 'Nombre de mots - 0 pour ne rien afficher du tout.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Activer la prise en charge des Live Bookmarks pour Firefox.';
protected $AX_SYN_BFL = 'Fichier Bookmark';
protected $AX_SYN_BFD = 'Nom spécial du fichier, si vide le nom par défaut sera utilisé.';
protected $AX_SYN_ORDL = 'Ordre';
protected $AX_SYN_ORDD = 'Ordre dans lequel les éléments doivent être affichés.';
protected $AX_SYN_MULTIL = 'Fils Multilingues';
protected $AX_SYN_MULTILD = 'Si à oui, Elxis générera un fil de langue spécifique.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Ce composant gére les fonctionnalités de la Corbeille.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Cela affichera une page de contenu simple.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Ce composant affiche une liste de liens web avec capture d écran.';
protected $AX_WBL_LDL = 'Description du Lien';
protected $AX_WBL_LDD = 'Afficher/Masquer le texte de description du lien.';
protected $AX_WBL_ICL = 'Icône';
protected $AX_WBL_ICD = 'L Icône sera utilisée à gauche du lien de l url dans la vue en Tableau.';
protected $AX_WBL_SCSL = 'Capture d Ecran';
protected $AX_WBL_SCSD = 'Affiche un lien vers la capture d écran. Si utilisé l Icône vers le lien sera affiché.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Cible de la fenêtre pour le clic du lien.';
protected $AX_WBLI_OT01 = 'Fenêtre parente avec barre de navigation';
protected $AX_WBLI_OT02 = 'Nouvelle fenêtre avec barre de navigation';
protected $AX_WBLI_OT03 = 'Nouvelle fenêtre sans barre de navigation';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Ce module montre une liste des Articles les plus récemment publiés qui sont toujours d actualités (certains peuvent avoir expiré bien qu ils soient les plus récents). Les articles qui sont montrés sur le Composant de la Page d Accueil ne sont pas inclus dans cette liste.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Ce module montre une liste des utilisateurs actuellement connectés.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Ce module montre une liste des Articles Populaires qui sont toujours d actualités (certains peuvent avoir expiré bien qu ils soient les plus récents). Les articles qui sont montrés sur le Composant de la Page d Accueil ne sont pas inclus dans cette liste.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Ce module montre les stats des Articles qui sont toujours d actualités (certains peuvent avoir expiré bien qu ils soient les plus récents). Les articles qui sont montrés sur le Composant de la Page d Accueil ne sont pas inclus dans cette liste.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Suffixe CSS de module'; 
protected $AX_SM_MCSD = 'Un suffixe à appliquer à la classe CSS du module (table.moduletable). Cela permet une mise en page individualisée.'; 
protected $AX_SM_MUCSL = 'Suffixe CSS du Menu'; 
protected $AX_SM_MUCSD = 'n suffixe à appliquer à la classe CSS du menu.'; 
protected $AX_SM_ECL = 'Activer le Cache'; 
protected $AX_SM_ECD = 'Choisir de placer le contenu du module en cache.'; 
protected $AX_SM_SMIL = 'Afficher l Icône Menu'; 
protected $AX_SM_SMID = 'Montre les Icônes de Menu que vous avez choisies pour vos articles.'; 
protected $AX_SM_MIAL = 'Alignement de l Icône Menu'; 
protected $AX_SM_MIAD = 'Alignment des Icônes du Menu'; 
protected $AX_SM_MODL = 'Mode du Module'; 
protected $AX_SM_MODD = 'Vous permet de contrôler quel type de Contenu à montrer dans le module.'; 
protected $AX_SM_OP01 = 'Seulement les Articles de Contenu'; 
protected $AX_SM_OP02 = 'Seulement pour les articles statiques'; 
protected $AX_SM_OP03 = 'Les deux'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Module Personnalisé.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Entrer l URL du flux RSS/RDF.'; 
protected $AX_SM_CU_FEDL = 'Description du Flux'; 
protected $AX_SM_CU_FEDD = 'Affiche le texte de description de la totalité du flux.'; 
protected $AX_SM_CU_FEIL = 'Image du Flux'; 
protected $AX_SM_CU_FEDID = 'Affiche l image associée au flux.'; 
protected $AX_SM_CU_ITL = 'Eléments'; 
protected $AX_SM_CU_ITD = 'Entrer le nombre d éléments à afficher.'; 
protected $AX_SM_CU_ITDL = 'Description Elément'; 
protected $AX_SM_CU_ITDD = 'Afficher la description ou le texte d introduction de l élément.'; 
protected $AX_SM_CU_WCL = 'Nombre de Mots'; 
protected $AX_SM_CU_WCD = 'Vous permet de limiter de limiter le texte de decription visible. 0 affiche tout le texte.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Ce module affiche une liste des Mois comportants des éléments archivés. Cette liste est automatiquement générée lorsque vous archivez des articles.'; 
protected $AX_SM_AR_CNTL = 'Nombre'; 
protected $AX_SM_AR_CNTD = 'Le nombre d éléments à afficher (par défaut 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Ce module vous permet d afficher les bannières actives du composant bannière sur votre site.'; 
protected $AX_SM_BN_CNTL = 'Client de Bannières'; 
protected $AX_SM_BN_CNTD = 'Entrer les ID des clients séparées par des ,!'; 
protected $AX_SM_BN_NBSL = 'Nombre de Bannières Affichées';
protected $AX_SM_BN_NBPRL = 'Nombre de Bannières Par Rangée';
protected $AX_SM_BN_NBPRD = 'Nombre de banners par rangée, pour désactiver mettre à 0. Pour afficher en mode vertical, mettre à 1';
protected $AX_SM_BN_UNQBL = 'Bannières Uniques';
protected $AX_SM_BN_UNQBD = 'On n affiche jamais une bannière plus d une fois (par session), l historique sera vidé et relancé.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Ce module affiche une liste des articles publiés récemments qui sont encore actifs (certains peuvent avoir expirés même s ils sont plus récents). Les éléments affichés en page d accueil peuvent être inclus ou non dans la liste.'; 
protected $AX_SM_LN_FPIL = 'Page d accueil'; 
protected $AX_SM_LN_FPID = 'Afficher/Masquer les éléments affichés en page d accueil - ne fonctionne qu en mode Articles seulement.'; 
protected $AX_SM_AR_CNT5D = 'Le nombre d éléments à afficher (par défaut 5)'; 
protected $AX_SM_LN_CATIL = 'ID Catégorie'; 
protected $AX_SM_LN_CATID = 'Sélectionner les articles d une catégorie ou d un groupe de catégories spécifique (Pour spécifier plus d une catégorie, séparez les avec une virgule).'; 
protected $AX_SM_LN_SECIL = 'ID Section'; 
protected $AX_SM_LN_SECID = 'Sélectionner les articles d une section ou d un groupe de sections spécifiques (Pour spécifier plus d une section, séparez les avec une virgule).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Ce module affiche formulaire de connexion comportant les éléments : nom d utilisateur, mot de passe, Perdu votre mot de passe, Enregistrez-vous (si l enregistrement des visiteurs est activé).'; 
protected $AX_SM_LF_PTL = 'Pré-texte'; 
protected $AX_SM_LF_PTD = 'Le texte ou code HTML au dessus du formulaire de connexion.'; 
protected $AX_SM_LF_PSTL = 'Post-texte'; 
protected $AX_SM_LF_PSTD = 'Le texte ou code HTML au dessus du formulaire de connexion.'; 
protected $AX_SM_LF_LRUL = 'Connexion URL'; 
protected $AX_SM_LF_LRUD = 'Adresse de la page à atteindre une fois connecté. Si se champ reste vide le renvoi sera vers la page d accueil.'; 
protected $AX_SM_LF_LORUL = 'Déconnexion URL'; 
protected $AX_SM_LF_LORUD = 'Adresse de la page à atteindre une fois déconnecté. Si se champ reste vide le renvoi sera vers la page d accueil.'; 
protected $AX_SM_LF_LML = 'Message javascript de Connexion'; 
protected $AX_SM_LF_LMD = 'Afficher/Masquer le Pop-up javascript indiquant le succès de la connexion.'; 
protected $AX_SM_LF_LOML = 'Message javascript de Déconnexion'; 
protected $AX_SM_LF_LOMD = 'Afficher/Masquer le Pop-up javascript indiquant le succès de la déconnexion.'; 
protected $AX_SM_LF_GML = 'Bonjour'; 
protected $AX_SM_LF_GMD = 'Afficher/Masquer le texte bonjour.'; 
protected $AX_SM_LF_NUNL = 'Nom/Utilisateur'; 
protected $AX_SM_LF_OP01 = 'Identifiant'; 
protected $AX_SM_LF_OP02 = 'Nom'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Affiche un menu.'; 
protected $AX_SM_MNM_MNL = 'Nom du Menu'; 
protected $AX_SM_MNM_MND = 'Le nom du menu (par défaut `mainmenu`).'; 
protected $AX_SM_MNM_MSL = 'Style de Menu'; 
protected $AX_SM_MNM_MSD = 'Le style de Menu'; 
protected $AX_SM_MNM_OP1 = 'Vertical'; 
protected $AX_SM_MNM_OP2 = 'Horizontal'; 
protected $AX_SM_MNM_OP3 = 'Liste'; 
protected $AX_SM_MNM_EML = 'Dérouler le Menu'; 
protected $AX_SM_MNM_EMD = 'Dérouler le menu et rendre les sous-menus toujour visibles.'; 
protected $AX_SM_MNM_IIL = 'Image Indentation'; 
protected $AX_SM_MNM_IID = 'Choisir l image d indentation à utiliser.'; 
protected $AX_SM_MNM_OP4 = 'Template';
protected $AX_SM_MNM_OP5 = 'Image par défaut de Elxis'; 
protected $AX_SM_MNM_OP6 = 'Utiliser les paramètres ci-dessous'; 
protected $AX_SM_MNM_OP7 = 'Aucun'; 
protected $AX_SM_MNM_II1L = 'Image 1'; 
protected $AX_SM_MNM_II1D = 'Image pour le premier sous-niveau.'; 
protected $AX_SM_MNM_II2L = 'Image 2'; 
protected $AX_SM_MNM_II2D = 'Image pour le second sous-niveau.'; 
protected $AX_SM_MNM_II3L = 'Image 3'; 
protected $AX_SM_MNM_II3D = 'Image pour le troisième sous-niveau.'; 
protected $AX_SM_MNM_II4L = 'Image 4'; 
protected $AX_SM_MNM_II4D = 'Image pour le quatrième sous-niveau.'; 
protected $AX_SM_MNM_II5L = 'Image 5'; 
protected $AX_SM_MNM_II5D = 'Image pour le cinquième sous-niveau.'; 
protected $AX_SM_MNM_II6L = 'Image 6'; 
protected $AX_SM_MNM_II6D = 'Image pour le sixième sous-niveau.'; 
protected $AX_SM_MNM_SPL = 'Séparateur'; 
protected $AX_SM_MNM_SPD = 'Séparateur pour les menus horizontaux.'; 
protected $AX_SM_MNM_ESL = 'Fin de Séparateur'; 
protected $AX_SM_MNM_ESD = 'Fin de séparateur pour les menus horizontaux.';
protected $AX_SM_MNM_IDPR = 'ID élément pour SEO PRO Itemid préchargé';
protected $AX_SM_MNM_IDPRD = 'Active le préchargement des ID élément avec AJAX, ceci résoud les éléments de menu qui ont plus d un lien qui pointent vers la même page.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Ce module affiche une liste des articles publiés et actifs qui ont été le plus consultés - déterminés par le nombre de fois où le page a été affichée.'; 
protected $AX_SM_MRC_MNL = 'Nom du Menu'; 
protected $AX_SM_MRC_MND = 'Le nom du menu (par défaut est mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Page d accueil'; 
protected $AX_SM_MRC_FPID = 'Afficher/Masquer les éléments affichés en page d accueil - ne fonctionne qu en mode Articles seulement.'; 
protected $AX_SM_MRC_CL = 'Nombre'; 
protected $AX_SM_MRC_CD = 'Le nombre d éléments à afficher (par défaut 5).'; 
protected $AX_SM_MRC_CIDL = 'ID Catégorie'; 
protected $AX_SM_MRC_CIDD = 'Sélectionner les articles d une catégorie ou d un groupe de catégories spécifique (Pour spécifier plus d une catégorie, séparez les avec une virgule).'; 
protected $AX_SM_MRC_SIDL = 'ID Section'; 
protected $AX_SM_MRC_SIDD = 'Sélectionner les articles d une section ou d un groupe de sections spécifiques (Pour spécifier plus d une section, séparez les avec une virgule).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Ce module sélectionne aléatoirement un article publié d une catégorie à cahque rafraichissement de page. Il peut aussi afficher plusieurs articles en configuration horizontale ou verticale.'; 
protected $AX_SM_NWF_CATL = 'Catégorie'; 
protected $AX_SM_NWF_CATD = 'Une Catégorie d articles.'; 
protected $AX_SM_NWF_STL = 'Style'; 
protected $AX_SM_NWF_STD = 'Le style d affichage.'; 
protected $AX_SM_NWF_OP1 = 'Afficher les images des articles'; 
protected $AX_SM_NWF_OP2 = 'Horizontal'; 
protected $AX_SM_NWF_OP3 = 'Vertical'; 
protected $AX_SM_NWF_SIL = 'Afficher images'; 
protected $AX_SM_NWF_SID = 'Afficher les images des articles.'; 
protected $AX_SM_NWF_LTL = 'Titres cliquables'; 
protected $AX_SM_NWF_LTD = 'Rendre les titres des articles cliquables.'; 
protected $AX_SM_NWF_RML = 'Lire la suite'; 
protected $AX_SM_NWF_RMD = 'Afficher/Masque le lien Lire la suite.'; 
protected $AX_SM_NWF_ITL = 'Titre Article'; 
protected $AX_SM_NWF_ITD = 'Afficher/Masquer le titre des articles.'; 
protected $AX_SM_NWF_NOIL = 'Nomb. Articles'; 
protected $AX_SM_NWF_NOID = 'Nombre d articles à afficher.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Ce module complète le composant sondage. Il affiche les sondages configurés. Ce module diffère des autres modules pour autant que les Composants liés entre les Articles de Menu et les Sondages soient actifs. Cela signifie que le module montre seulement les Sondages, qui sont configurés pour certain Article de Menu.'; 
protected $AX_SM_POL_CATL = 'Catégorie'; 
protected $AX_SM_POL_CATD = 'Une catégorie de contenu.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Ce module affiche aléatoirement une image du répertoire choisi.'; 
protected $AX_SM_RNI_ITL = 'Type Image'; 
protected $AX_SM_RNI_ITD = 'Type d image PNG/GIF/JPG etc. (par defaut JPG).'; 
protected $AX_SM_RNI_IFL = 'Répertoire'; 
protected $AX_SM_RNI_IFD = 'Chemin du répertoire relatif à l url du site. Par ex.: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Lien'; 
protected $AX_SM_RNI_LND = 'Une URL de redirection si l image est cliquée, par ex.: http://www.elxis.net'; 
protected $AX_SM_RNI_WL = 'Largeur (px)'; 
protected $AX_SM_RNI_WD = 'Largeur de l image (pour toutes les images).'; 
protected $AX_SM_RNI_HL = 'Hauteur (px)'; 
protected $AX_SM_RNI_HD = 'Hauteur  de l image (pour toutes les images).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = 'Ce module affiche les articles en relation avec le sujet de l article affiché. Cela fonctionne avec les mots clés des métadonnées.'; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Ce module affiche un lien par lequel les visiteurs peuvent se syndiquer aux denières informations diffusées sur votre site. Lorsqu un visiteur clique sur l Icône RSS, il est redirigé vers une nouvelle page au format XML. Pour utiliser votre flux dans un autre site ou sur un lecteur de flux, il doit Copier/Coller l URL.'; 
protected $AX_SM_RSS_TXL = 'Texte'; 
protected $AX_SM_RSS_TXD = 'Entrer le texte à afficher avec les liens RSS.'; 
protected $AX_SM_RSS_091D = 'Afficher/Masquer le lien RSS 0.91.'; 
protected $AX_SM_RSS_10D = 'Afficher/Masquer le lien RSS 1.0.'; 
protected $AX_SM_RSS_20D = 'Afficher/Masquer le lien RSS 2.0.'; 
protected $AX_SM_RSS_03D = 'Afficher/Masquer le lien Atom 0.3.'; 
protected $AX_SM_RSS_OPD = 'Afficher/Masquer le lien OPML.'; 
protected $AX_SM_RSS_I091L = 'Image RSS 0.91'; 
protected $AX_SM_RSS_I10L = 'Image RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Image RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Image Atom'; 
protected $AX_SM_RSS_IOPL = 'Image OPML'; 
protected $AX_SM_RSS_CHID = 'Choisir l image à utiliser.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Ce module affiche un champ de recherche.';
protected $AX_SM_SEM_TOP = 'Haut'; //also in tinymce
protected $AX_SM_SEM_BTM = 'Bas'; //also in tinymce
protected $AX_SM_SEM_BWL = 'Largeur du champ';
protected $AX_SM_SEM_BWD = 'Largeur du champ de recherche.';
protected $AX_SM_SEM_TXL = 'Texte';
protected $AX_SM_SEM_TXD = 'Un texte à afficher dans le champ de recherche. Si ce champ est vide la variable _SEARCH_BOX de votre fichier de langue sera utilisée.';
protected $AX_SM_SEM_BPL = 'Position du Bouton';
protected $AX_SM_SEM_BPD = 'Position du bouton par rapport au champ de recherche.';
protected $AX_SM_SEM_BTXL = 'Texte du Bouton';
protected $AX_SM_SEM_BTXD = 'Un texte à afficher sur le bouton de recherche. Si ce champ reste vide la variable _SEARCH_TITLE de votre fichier de langue sera utilisée.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Le module sections affiche une liste des sections de votre base de donnée. Si vous avez choisi de ne pas affichier les liens non autorisés dans votre configuration générale, la liste sera limitée aux sections autorisées pour l utilisateur.'; 
protected $AX_SM_SEC_CL = 'Nombre';
protected $AX_SM_SEC_CD = 'Le nombre d éléments à afficher (par défaut 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Ce module affiche des information sur votre serveur, vos visiteurs, le nombre d articles, etc...'; //DOUBLE
protected $AX_SM_STA_SVIL = 'Informations Serveur'; 
protected $AX_SM_STA_SVID = 'Affiche les informations sur le serveur.'; 
protected $AX_SM_STA_SIL = 'Informations Site'; 
protected $AX_SM_STA_SID = 'Affiche les informations sur le site.'; 
protected $AX_SM_STA_HCL = 'Compteur de Clics'; 
protected $AX_SM_STA_HCD = 'Affiche un compteur des Clics.'; 
protected $AX_SM_STA_ICL = 'Augmenter le Compteur'; 
protected $AX_SM_STA_ICD = 'Augmenter le nombre de hits du compteur de.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Ce module permet au visiteur de changer à la volée le template de votre site par un menu déroulant.'; 
protected $AX_SM_TMC_MNLL = 'Largeur Max. du Nom'; 
protected $AX_SM_TMC_MNLD = 'Largeur maximum à afficher pour le nom du Template (Par défaut 20).'; 
protected $AX_SM_TMC_SPL = 'Afficher un Aperçu'; 
protected $AX_SM_TMC_SPD = 'Afficher un Aperçu du Template.'; 
protected $AX_SM_TMC_WL = 'Largeur'; 
protected $AX_SM_TMC_WD = 'Largeur de l image d aperçu (Par défaut 140 px).'; 
protected $AX_SM_TMC_HL = 'Hauteur'; 
protected $AX_SM_TMC_HD = 'Hauteur de l image d aperçu (Par défaut 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Ce module affiche le nombre d utilisateurs en ligne.'; 
protected $AX_SM_WSO_DL = 'Affichage'; 
protected $AX_SM_WSO_DD = 'Sélectionnez ce que vous voulez afficher.'; 
protected $AX_SM_WSO_OP1 = '# de Visiteurs/Membres'; 
protected $AX_SM_WSO_OP2 = 'Nom des membres'; 
protected $AX_SM_WSO_OP3 = 'Les deux'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Ce module positionne à un emplacement choisi une IFrame qui permet d inclure une page/site externe.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL de la page/site que vous souhaitez inclure dans l IFrame'; 
protected $AX_SM_WRM_SCBL = 'Défilement'; 
protected $AX_SM_WRM_SCBD = 'Afficher/Masquer les barres de défilement Horizontales & Verticales.'; 
protected $AX_SM_WRM_WL = 'Largeur'; 
protected $AX_SM_WRM_WD = 'Largeur de l IFrame en pixels ou pourcentage.'; 
protected $AX_SM_WRM_HL = 'Hauteur'; 
protected $AX_SM_WRM_HD = 'Hauteur de l IFrame en pixels ou pourcentage'; 
protected $AX_SM_WRM_AHL = 'Hauteur Automatique'; 
protected $AX_SM_WRM_AHD = 'La hauteur sera automatiquement ajustée à la hauteur de la page externe. Cela ne fonctionne que sur des pages appartenant à votre domaine.'; 
protected $AX_SM_WRM_ADL = 'Ajout Automatique'; 
protected $AX_SM_WRM_ADD = 'Par défaut http:// sera ajouté à moins qu il ne détecte http:// ou https:// dans l URL que vous inscrivez. Ce paramètre vous permet de désactiver cette fonction.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Fonctionnalité'; 
protected $AX_ED_FUNCTD = 'Choix des Fonctions'; 
protected $AX_ED_FUNSIMPLE = 'Simple'; 
protected $AX_ED_FUNADV = 'Avancé';
protected $AX_ED_EDITORWIDTHL = 'Largeur Editeur';
protected $AX_ED_EDITORWIDTHD = 'Largeur de la fenêtre de l éditeur';
protected $AX_ED_EDITORHEIGHTL = 'Hauteur Editeur';
protected $AX_ED_EDITORHEIGHTD = 'Hauteur de la fenêtre de l éditeur';
protected $AX_ED_COMPRESSEDVL = 'Version Compressée';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE peut fonctionner en mode compressé, ce qui le rendra un peu plus rapide au chargement. Cependant, ce mode ne marche pas toujours, particulièrement avec IE, donc par défaut il est désactivé. Soyez prudent en utilisant ce mode et assuez-vous que cela fonctionne sur votre système';
protected $AX_ED_OFF = 'Off';
protected $AX_ED_ON = 'On';
protected $AX_ED_COMPRESSL = 'Compression';
protected $AX_ED_COMPRESSD = 'Utiliser Gzip pour la compression de TinyMCE (chargement + rapide de 75%)';
protected $AX_ED_CONVERTURLL = 'Convertir les liens URLS';
protected $AX_ED_CONVERTURLD = 'Convertir les liens URLs de absolu à relative.';
protected $AX_ED_ENTENCODL = 'Codage Entité';
protected $AX_ED_ENTENCODD = 'Cette option contrôle comment les entités/caractères sont traitées par TinyMCE. La valeur peut être mise en numérique, par nom ou brut, où aucun codage à exécuter. La valeur par défaut de cette option est par nom.';
protected $AX_ED_TXTDIRL = 'Direction du Texte';
protected $AX_ED_TXTDIRD = 'Capacité de changer la direction de texte';
protected $AX_ED_CNVFONTSPANL = 'Convertir Fonts en Spans';
protected $AX_ED_CNVFONTSPAND = 'Convertir les éléments des polices en éléments Span. Par défaut est sur Oui.';
protected $AX_ED_FONTSIZETYPEL = 'Taille des type de Police';
protected $AX_ED_FONTSIZETYPED = 'Choisissez la taille du type de police, un ou autre de longueur ex: 10pt, ou taille-absolue ex: x-small.';
protected $AX_ED_INLTABLEDITL = 'Rédaction des Tableaux Intégrées';
protected $AX_ED_INLTABLEDITD = 'Permet la rédaction intégrée de Tableaux.';
protected $AX_ED_PROHELEMENTSL = 'Éléments Interdits';
protected $AX_ED_PROHELEMENTSD = 'Eléments qui seront nettoyés dans le texte';
protected $AX_ED_EXTELEMENTSL = 'Éléments Étendus';
protected $AX_ED_EXTELEMENTSD = 'Étendez la fonctionnalité de JCE en ajoutant des éléments supplémentaires ici. Format: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Éléments Événement';
protected $AX_ED_EVELEMENTSD = 'Cette option doit contenir des éléments séparés par une virgule et peut avoir des attributs événement comme onclick et autres. Cette option est nécessaire puisque certains navigateurs exécutent ces événements en éditant le contenu.';
protected $AX_ED_TCSSCLASSESL = 'Classe CSS du Template';
protected $AX_ED_TCSSCLASSESD = 'Charge le fichier CSS du template template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Personnaliser le CSS';
protected $AX_ED_CCSSCLASSESD = 'Vous pouvez spécifier le chargement d un fichier CSS personnalisé - entrez simplement le nom de remplacement du fichier css. Le fichier DOIT être placé dans le même répertoire que le gabarit du fichier CSS.';
protected $AX_ED_NEWLINESL = 'Retours à la ligne';
protected $AX_ED_NEWLINESD = 'Les retours à la ligne seront faits dans l option choisie';
protected $AX_ED_TOOLBARL = 'Barre d outils';
protected $AX_ED_TOOLBARD = 'Position de la Barre d outils';
protected $AX_ED_HTMLHEIGHTL = 'HTML Height';
protected $AX_ED_HTMLHEIGHTD = 'Height of HTML mode pop-up window.';
protected $AX_ED_HTMLWIDTHL = 'Largeur HTML';
protected $AX_ED_HTMLWIDTHD = 'Largeur de la fenêtre pop-up.';
protected $AX_ED_PREVIEWHEIGHTL = 'Hauteur de l Aperçu';
protected $AX_ED_PREVIEWHEIGHTD = 'Hauteur de la fenêtre pop-up.';
protected $AX_ED_PREVIEWWIDTHL = 'Largeur de l Aperçu';
protected $AX_ED_PREVIEWWIDTHD = 'Largeur de la fenêtre pop-up.';
protected $AX_ED_IBROWSERL = 'Plugin iBrowser';
protected $AX_ED_IBROWSERD = 'iBrowser est un gestionnaire avancé des images';
protected $AX_ED_PLTABLESL = 'Plugin Tableaux';
protected $AX_ED_PLTABLESD = 'Active les Tableaux dans le mode WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Plugin Coller ';
protected $AX_ED_PLPASTED = 'Active les fonctions Coller depuis Word, Coller en texte plein et tous sélectionner.';
protected $AX_ED_PLIMGPLUGINL = 'Plugin Images Avan.';
protected $AX_ED_PLIMGPLUGIND = 'Active la gestion avancée pour la gestion des Images. Par défaut le mode simple est activé.';
protected $AX_ED_PLSEARCHL = 'Plugin Rechercher/Remplacer';
protected $AX_ED_PLSEARCHD = 'Active la fonction de Recherche et de remplacement.';
protected $AX_ED_PLLINKSL = 'Plugin Gestion des Liens Avan.';
protected $AX_ED_PLLINKSD = 'Active la gestion avancée des Liens. Par défaut le mode simple est activé.';
protected $AX_ED_PLEMOTL = 'Plugin Emotion';
protected $AX_ED_PLEMOTD = 'Active le plugin des Emotions. Vous pouvez y ajouter des Emoticons ou smiley.';
protected $AX_ED_PLFLASHL = 'Plugin Flash';
protected $AX_ED_PLFLASHD = 'Active le mode Flash. Vous pouvez ajouter un fichier ou lien en Flash dans vos contenus.';
protected $AX_ED_PLDTL = 'Plugin Date/Heure';
protected $AX_ED_PLDTD = 'Active la Date/Heure. Vous pouvez ajouter la date/heure dans vos articles.';
protected $AX_ED_PLPREVL = 'Plugin Aperçu';
protected $AX_ED_PLPREVD = 'Ce plugin ajoute un Icône aperçu dans TinyMCE, cliquez dessus et vous ouvrirez une fenêtre popup de votre article.';
protected $AX_ED_PLZOOML = 'Plugin Zoom';
protected $AX_ED_PLZOOMD = 'Ajoute le zoom Menu Déroulant dans IE5.5 et +, Ce plugin a été surtout créé pour montrer comment ajouter un menu déroulant personnalisées.';
protected $AX_ED_PLFSCRL = 'Plugin Plein Ecran';
protected $AX_ED_PLFSCRD = 'Ce plugin ajoute un Icône pour editer en plein écran avec TinyMCE.';
protected $AX_ED_PLPRINTL = 'Plugin Imprimer';
protected $AX_ED_PLPRINTD = 'Ce plugin ajoute un Icône Imprimer dans TinyMCE.';
protected $AX_ED_PLDIRL = 'Plugin Direction';
protected $AX_ED_PLDIRD = 'Ce plugin ajoute des icônes de direction à TinyMCE, ce qui permet à TinyMCE de mieux traiter les langues qui sont écrites de droite à gauche.';
protected $AX_ED_PLFONTSL = 'Liste des Polices';
protected $AX_ED_PLFONTSD = 'Ce plugin ajoute un menu déroulant pour le choix des polices.';
protected $AX_ED_PLFONTSZL = 'Taille des Polices';
protected $AX_ED_PLFONTSZD = 'Ce plugin ajoute un menu déroulant pour la taille des polices.';
protected $AX_ED_PLFORMLSL = 'Liste de Formatage';
protected $AX_ED_PLFORMLSD = 'Ce plugin ajoute un menu déroulant pour le formatage du texte, exp. H1, H2, etc.';
protected $AX_ED_PLSSLL = 'Style';
protected $AX_ED_PLSSLD = 'Ce plugin ajoute une liste de sélection de style CSS de la Template en cours.';
protected $AX_ED_NAMED = 'Nommé';
protected $AX_ED_NUMERIC = 'Numérique';
protected $AX_ED_RAW = 'Raw';
protected $AX_ED_LTR = 'De gauche à droite';
protected $AX_ED_RTL = 'De droite à gauche';
protected $AX_ED_LENGTH = 'Longueur';
protected $AX_ED_ABSSIZE = 'Taille-Absolue';
protected $AX_ED_BRELEMENTS = 'Elément BR';
protected $AX_ED_PELEMENTS = 'Elément P';
//Tools
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Calculatrice';
protected $AX_TCAL_D = 'Une calculatrice avancée en javascript.';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Vide le répertoire Temp';
protected $AX_TEMTEMP_D = 'Vide le dossier temp de Elxis (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Réparation des Langues';
protected $AX_TFIXLANG_D = 'Exécute un contrôle des tables de la base de données multilingues et applique des  corrections si besoin.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Agenda';
protected $AX_TORGANIZ_D = 'L Agenda Elxis garde vos contacts, notes, signets et vos rendez-vous.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Nettoyage du Cache';
protected $AX_TCLEANCACHE_D = 'Nettoie le répertoire des caches de tous leurs contenus, articles et images';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Changement de mode';
protected $AX_TCHMOD_D = 'Changements des droits sur les fichiers et répertoires';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Fixage de Postgres';
protected $AX_TFPGSEQ_D = 'Fixes les séquences de Postgres si besoin.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Enregistrement de Elxis';
protected $AX_TELXREG_D = 'Enregistre votre installation de Elxis sur elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Ponts';
protected $AX_BRIDGE_CDESC = 'Créer un lien vers le Pont.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Nouvelle ligne';
protected $AX_SAME_LINE = 'Même ligne';
protected $AX_INDICATOR = 'Indicateur';
protected $AX_INDICATOR_D = 'Montrer la Langue comme un Indicateur';
protected $AX_FLAG = 'Drapeau';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Affichages du sélectionneur de langue sur la partie public en liste déroulante, liste de liens ou drapeaux.';
protected $AX_FLAGS = 'Drapeaux';
protected $AX_SMARTSW = 'Commutateur';
protected $AX_SMARTSW_D = 'Vous permet de changer la langue et rester dans la même page sous n importe quelles conditions';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Affiche les profils utilisateurs aléatoirement';
protected $AX_DISPSTYLE = 'Affichage du Style';
protected $AX_COMPACT = 'Compact';
protected $AX_EXTENDED = 'Etendue';
protected $AX_GENDER = 'Genre';
protected $AX_GENDERDESC = 'Afficher le genre de l Utilisateur?';
protected $AX_AGE = 'Age';
protected $AX_AGEDESC = 'Afficher l âge de l utilisateur?';
protected $AX_REALUNAME = 'Afficher le nom réél de l utilisateur ou simplement son surnom?';
//weblinks item
protected $AX_WBLI_TL = 'Cible';
//content
protected $AX_RTFICL = 'Icône RTF';
protected $AX_RTFICD = 'Afficher/Cacher le bouton RTF - affecte seulement cette page.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filtrage des Groupes';
protected $AX_MODWHO_FILGRD = 'Si à oui, alors les utilisateurs avec un niveau d accès inférieur (i.e. visiteurs) ne seront pas capable de voir l état de connexion des utilisateurs avec un accès supérieur.';
//search bots
protected $AX_SEARCH_LIMIT = 'Limite de Recherche';
protected $AX_MAXNUM_SRES = 'Nombre maximum de la limite de recherche';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Affiche un résumé des articles récemment ajoutés. Idéal pour la première page.'; 
protected $AX_SECTIONS = 'Sections';
protected $AX_SECTIONSD = 'ID des Sections séparées par des virgules (,)';
protected $AX_CATEGORIES = 'Catégories';
protected $AX_CATEGORIESD = 'ID des Catégories séparées par des virgules (,)';
protected $AX_NUMDAYS = 'Nombre de jours';
protected $AX_NUMDAYSD = 'Affiche les éléments créés depuis X jours (valeur par défaut 900)';
protected $AX_SHOWTHUMBS = 'Afficher les vignettes';
protected $AX_SHOWTHUMBSD = 'Affiche/Cache une vignette image dans le texte d introduction';
protected $AX_THUMBWIDTHD = 'Largeur de la vignette en pixels';
protected $AX_THUMBHEIGHTD = 'Hauteur de la vignette en pixels';
protected $AX_KEEPRATIO = 'Garder le ratio';
protected $AX_KEEPRATIOD = 'Préserver le ratio des images. Si à oui, alors le paramètre de la hauteur sera pris en compte.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'article d\'eBlog';
protected $AX_EBLOGITEMD = 'Crée un lien vers un blog édité de l\'eBlog';
//2009.0
protected $AX_COMMENTARY = 'Commentaire';
protected $AX_COMMENTARYD = 'Sélectionnez qui est autorisé à commenter cet article.';
protected $AX_NOONE = 'Personne';
protected $AX_REGUSERS = 'Utilisateurs enregistrés';
protected $AX_ALL = 'Tous';
protected $AX_COMMENTS = 'Commentaires';
protected $AX_COMMENTSD = 'Afficher le nombre de commentaires?';

}

?>