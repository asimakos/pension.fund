<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2008 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Ioannis Sannos
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @description: English language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterLang {


	public $NEWSLETTER = 'Bulletin';
	public $NEWSLMAILLIST = 'Liste d\'adresses de bulletin';
	public $SUBSCRIBE = 'Souscrivez';
	public $UNSUBSCRIBE = 'Se désinscrire';
	public $SUBLEWSL = 'Souscrivez à notre bulletin';
	public $UNSUBLEWSL = 'Se désinscrire de notre bulletin';
	public $NAME = 'Nom';
	public $SURNAME = 'Nom de famille';
	public $RECIEVEIN = "Recevez les messages dedans"; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'toute langue';
	public $SUBINFO = 'Complétez vos informations personnelles pour souscrire à notre liste de bulletin. Tous les champs sont exigés. Vous pourrez un-subscribe n\'importe quand de notre liste de bulletin si vous souhaitez ne recevoir plus des email d\'avis.';
	public $SUBEMAILVAL = 'Votre email address sera automatiquement vérifié pour que votre abonnement aproved.';
	public $SECCODE = 'Code de sécurité';
	public $UNSUBINFO = 'D\'appoint votre email address à un-subscribe de notre bulletin. Un URL spécial de déplacement sera envoyé à votre email address. Cliquez sur-le à enlever de notre liste d\'adresses.';
	public $JSDISABLED = 'Vous devez permettre au Javascript en votre navigateur d\'employer ce dispositif !';
	public $NAMEEMPTY = 'Le nom ne peut pas être vide !';
	public $SURNAMEEMPTY = 'Le nom de famille ne peut pas être vide !';
	public $PROVALIDEMAIL = 'Vous devez fournir un email address valide !';
	public $SECCODEWRONG = 'Le code de sécurité est erroné !';
	public $EMAILEXISTS = 'L\'email address soumis existe déjà en notre liste d\'adresses !';
	public $NOTACCDOM = 'Désolés, nous n\'acceptons pas des email de votre domaine d\'email.';
	public $FLOODWAIT = 'Protection d\'inondation ! Veuillez attendre quelques secondes et réessayez.';
	public $NEWSLSUBNTF = 'Avis d\'abonnement de bulletin';
	public $DEAR = 'Cher'; //translators help: followed by name surname
	public $THANKSUB = 'Merci de votre abonnement à notre liste d\'adresses.';
	public $SUBCOMPVISIT = 'Pour que votre abonnement lui soit accompli est prié de visiter le beuglement de lien. En visitant ce lien vous vérifiez que vous êtes le propriétaire de cet email address et votre abonnement est activé.';
	public $NEVERSUBIGN = 'Si vous ne souscriviez svp jamais à notre ingore de liste d\'adresses cet email.';
	public $GREETINGS = 'Salutations';
	public $SUBCONFIRM = 'Confirmation d\'abonnement';
	public $CONFLINKSENT = 'Un lien spécial de confirmation a été envoyé à votre email address. Vérifiez vos messages et cliquez sur dessus le lien de confirmation pour accomplir votre abonnement à notre liste d\'adresses.'; 
	public $SUBCOMPLETE = 'Votre abonnement a été accompli';
	public $SUBCOMPLETED = 'Votre abonnement à notre liste d\'adresses a été accompli avec succès. Si vous souhaitez ne recevoir plus des messages électroniques par nous, vous pouvez n\'importe quand un-subscribe de notre liste d\'adresses en écrivant votre email address à la forme de se désinscrire.';
	public $CONFFAILED = 'Confirmation échouée';
	public $CONFFAILEDD = 'La confirmation d\'abonnement a échoué ! Votre abonnement ou est confirmé ou le code de confirmation est inadmissible.';
	public $SUBLOGIN = 'Afin de souscrire à notre liste d\'adresses que vous devez d\'abord ouvrir une session !';
	public $SUBNALLOWED = 'On ne nous laisse pas sommes des abonnements désolés et nouveaux.';
	public $MAILNFOUND = 'Votre email address n\'a pas été trouvé en notre liste d\'adresses ou votre abonnement est encore non confirmé';
	public $UNSUBCONFIRM = 'Confirmation d\'Unsubscription';
	public $WISHUNSCLICK = 'Nous avons reçu une demande d\'unsubscription de notre liste d\'adresses par vous. Pour confirmer que vous souhaitez se désinscrire de notre visite de liste d\'adresses le beuglement de lien.';
	public $UNSUBINGORE = 'Si vous ne demandiez jamais d\'obtenir un-subscribed de notre liste d\'adresses ou vous ne souscriviez jamais à elle, ignorez svp ce message.';
	public $UNSUBCOMPLETE = 'Votre unsubscription a été accompli';
	public $UNSUBCOMPLETED = 'Vous obtenez avec succès enlevé de notre liste d\'adresses.';
	public $RCONFLINKSENT = 'Votre déplacement demandé a été soumis avec succès. Un lien spécial de confirmation a été envoyé à votre email address. Vérifiez vos messages et cliquez sur dessus le lien de confirmation pour obtenir enlevé de notre liste d\'adresses.'; 
	public $RCONFFAILEDD = 'La confirmation d\'Unsubscription a échoué ! Votre abonnement ou n\'est pas confirmé ou le code de confirmation est inadmissible.';
	public $NOTHSPECIAL = 'Il n\'y a rien spécial pour voir ici.';
	public $STATISTICS = 'Statistiques';
	public $TOTALSENT = 'Messages envoyés par total';
	public $LASTSUBSCRIBER = 'Dernier abonné';

	/* BACK-END */
	public $CONFIGURE = 'Configurez';
	public $SUBSCRIBERS = 'Abonnés';
	public $CONFIRMED = 'Confirmé';
	public $UNCONFIRMED = 'Non confirmé';
	public $GUEST = 'Invité';
	public $SUBSCRIPTIONS = 'Abonnements';
	public $REGUSERS = 'Utilisateurs enregistrés';
	public $EVERYONE = 'Chacun';
	public $CANSUBSCRIBED = 'Choisissez qui est admis souscrire à votre liste d\'adresses de d\'entrée.';
	public $EMAILVALID = 'Validation d\'email';
	public $EMAILVALIDD = 'Si permis alors après un nouvel abonnement un email spécial est envoyé à l\'abonné avec un lien de confirmation. Le nouvel abonnement est seulement activé une fois les clics d\'utilisateur ce lien. De cette façon que vous vous assurez que l\'utilisateur est le propriétaire de l\'email address soumis et que l\'email address est valide.';
	public $LANGSD = 'Si vous souhaitez envoyer les messages électroniques spécifiques à une langue alors choisissent ici les langues que vous souhaitez permettre. Les utilisateurs pendant leur abonnement pourront également choisir leur langue désirée à partir de celle que vous permettez ici. Si vous faites éditer seulement une langue alors ne choisissez aucune langue.';
	public $EXCLUDEDTLDS = 'TLDs exclu';
	public $EXCLUDEDTLDSD = 'La virgule a séparé la liste de domaines de niveau supérieur (comme COM, filet, org) pour nier de l\'souscription à votre liste d\'adresses.';
	public $EXCLUDEDDOMS = 'Domaines exclus';
	public $EXCLUDEDDOMSD = 'La virgule a séparé la liste de Domain Name (comme badsite.com, hackers.cn) pour nier de l\'souscription à votre liste d\'adresses.';
	public $ALLOWEDTLDS = 'TLDs permis';
	public $ALLOWEDTLDSD = 'La virgule a séparé la liste de domaines de niveau supérieur (comme COM, filet, org) pour lesquels des abonnements sont seulement permis. Laissez ce champ vide pour permettre de tous.';
	public $ALLOWEDDOMS = 'Domaines permis';
	public $ALLOWEDDOMSD = 'La virgule a séparé la liste de Domain Name (comme mysite.com, friendlysite.gr) pour lesquels des abonnements sont seulement permis. Laissez ce champ vide pour permettre de tous.';
	public $SHOWSTATSD = 'Montrez les statistiques de bulletin dans les composants en première page ?';
	public $RECPERSTEP = 'Destinataires par étape';
	public $RECPERSTEPD = 'Le bulletin d\'IOS pour limiter la charge de serveur expédie des messages dans les étapes. Placez ici le nombre d\'email qui seront introduits chaque étape. Abaissez cette limite si vous voyez que chaque étape prend trop de temps d\'être executed.';
	public $ONEPERREC = 'Un par destinataire';
	public $ONEPERRECD = 'Envoyez un message par destinataire. Travaille seulement si envoyez la méthode est courrier de PHP! Si ceci est permis, les bulletins d\'IOS veulent envoyé un email par destinataire. Ainsi, si vous envoyez des messages à 50 personnes, 50 email seront envoyés. Si vous employez ce dispositif plus bas les destinataires par étape. Si ce dispositif est handicapé, 1 email sera introduit chaque étape pour tous les destinataires.';
	public $CNOTSAVESETS = 'N\'a pas pu sauver des arrangements!';
	public $EXPORT = 'Exportation';
	public $EXPORTSUB = 'Abonnés d\'exportation';
	public $IMPORT = 'Importation';
	public $IMPORTSUB = 'Abonnés d\'importation';
	public $IMPORTUNIQUE = 'Importez seulement les email address qui n\'existent pas (exige une question supplémentaire de DB par abonné. N\'importez pas trop d\'abonnés immédiatement).';
	public $IMPORTD = 'Choisissez le dossier de secours de bulletin que vous souhaitez importer.';
	public $IMPORTCUSTOM = 'Si vous employez un dossier fait sur commande d\'importation alors vous assurez que ce dossier est UTF-8 codé et les abonnés sont dans ce format (un abonné par la ligne) :';
	public $IMPORTGIDL = 'Pour des invités l\'identification de l\'utilisateur est 0. La langue et group peut être vide.';
	public $IMPORTEDSUBS = "des abonnés de %s ont été fondés. %s de eux ont été importés."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Code de confirmation';
	public $GETUSERDATA = 'Obtenez les données de l\'utilisateur';
	public $NEWSLETTERS = 'Bulletins';
	public $SUBJECT = 'Sujet';
	public $RECIPIENTS = 'Destinataires';
	public $PLAINTEXT = 'Texte plat';
	public $TEXTHTML = 'Texte de HTML';
	public $HTMLFILE = 'Dossier de HTML';
	public $LASTSENT = 'Bout envoyé'; //translators help: date newsletter last sent
	public $SELECTFILE = 'Choisissez le dossier';
	public $HTMLFILED = 'Vous pouvez télécharger et employer un dossier de HTML pré-fait au lieu d\'écrire un texte de HTML.';
	public $SUBJECTEMPTY = 'Le sujet ne peut pas être vide !';
	public $FIRSTSAVEPR = 'Vous devez d\'abord sauver le bulletin pour le visionner préalablement!';
	public $NEWSLNEMPTY = 'Le bulletin ne peut pas être vide !';
	public $SENDNEWSLETTER = 'Envoyez le bulletin';
	public $MAILFORMAT = 'Format de courrier';
	public $FORCESEND = 'Force-envoyez ce message également aux utilisateurs qui ont choisi pour recevoir des email dans une autre langue.';
	public $SUBSTOTAL = 'Total d\'abonnés';
	public $SUBSCRIBERSIN = "Abonnés dans %s"; //translators help: filled in by language
	public $SENDNOW = 'Envoyez maintenant !';
	public $SENDMSGSWAIT = "En envoyant des messages de %s, attendez svp..."; //translators help: filled in by messages number
	public $PLEASEWAIT = 'Attendez svp…';
	public $MSGOFSENT = "%s des messages de %s a envoyé avec succès."; //translators help: filled in by number / total number
	public $DISPATCHCOM = 'L\'expédition a accompli';
	public $SENDERNAME = 'Nom d\'expéditeur';
	public $SENDEREMAIL = 'Email d\'expéditeur';
	public $SENDMETHOD = 'Envoyez la méthode';
	public $READCONFIRM = 'Confirmation de lecture';
	public $SENDMAILPATH = 'Chemin de Sendmail';
	public $SENDMAILPATHD = 'Utilisé si Sendmail est l\'email choisi envoyez la méthode (valeur par défaut : /usr/sbin/sendmail).';
	public $SMTPHOST = 'Centre serveur de smtp';
	public $SMTPPORT = 'Port de smtp';
	public $SECURESMTP = 'Fixez le smtp';
	public $SMTPAUTH = 'Authentification de smtp';
	public $SMTPUSER = 'Username de smtp';
	public $SMTPPASS = 'Mot de passe de smtp';
	public $ADDREPLYTO = 'Réponse à';
	public $ADDREPLYTOD = 'Ajoutez la réponse à l\'email address dans des en-têtes de courrier ?';
	public $THECOPY = 'Copie'; //translators help: THE copy (material, a copied newsletter)
	public $SHOWCOPYRIGHT = 'Montrez copyright';
	public $SHOWCOPYRIGHTD = 'Choisissez si vous souhaitez un message de copyright à montrer dans le composant en première page. C\'est mon seulement rewarn pour te donner pour libre ce composant!';
	public $UPHTMLTEMP = 'Téléchargez un dossier de HTML pour l\'employer comme calibre de bulletin';
	public $UPLOADHTMLTEMP = 'Calibre de HTML de téléchargement';
	public $SENDNEWSLET = 'Envoyez le bulletin';
	public $IMPORTELXUS = 'Utilisateurs d\'Elxis d\'importation';
	public $IMPORTELXUSD = 'Importation dans les utilisateurs existants de CMS d\'Elxis de bulletin. Seulement des utilisateurs avec les email address qui n\'existent pas dans la liste d\'abonnés de bulletin seront importés.';
	public $FOUNDELXUIMP = "des utilisateurs de %s Elxis ont été trouvés. %s de eux ont été importés dans le bulletin."; //translators help: filled in by numbers

	//languages names
	public $ARMENIAN = 'Arménien';
	public $BOZNIAN = 'Bosnien';
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

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>