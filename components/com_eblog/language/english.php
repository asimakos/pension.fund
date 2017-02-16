<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Tags';
	public $UNKNOWNTAG = 'Unknown tag';
	public $PERMLINK = 'Permanent link';
	public $COMMENTS = 'Comments';
	public $COMMENT = 'Comment'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'There are no comments.';
	PUBLIC $MUSTLOGTOCOM = 'You must first login to post comments.';
	public $POSTCOMMENT = 'Post a comment';
	public $YOURCOMMENT = 'Your comment';
	public $NALLPOSTCOM = 'You are not allowed to post comments!';
	public $MUSTWRITEMSG = 'You must write a message!';
	public $COMADDSUC = 'Your comment added successfully!';
	public $WAITRETRY = 'Please retry after some seconds!';
	public $NALLPERFACT = 'You are not allowed to perform this action!';
	public $ARTNOFOUND = 'Could not found requested post!';
	public $POSTSTAGASAT = "Posts tagged as %s at %s"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'Archives';
	public $USERBLOGSAT = "User blogs at %s"; //s: site name
	public $USERBLOGS = 'User blogs';
	public $THEREAREBLOGS = "There are %s blogs available"; //s: number of available blogs
	public $POSTS = 'Posts';

	//control panel
	public $CPANEL = 'Control panel';
	public $MANBLOG = 'Manage your blog';
	public $ALLPOSTS = 'All posts';
	public $LATESTPOSTS = "Latest %s posts";
	public $SETTINGS = 'Settings';
	public $CSSFILE = 'CSS file';
	public $RTLCSSFILE = 'RTL CSS file';
	public $COMMENTARY = 'Commentary';
	public $NOTALLOWED = 'Not allowed'; //Commentary
	public $REGUSERS = 'Registered users'; //Commentary
	public $ALLOWEDALL = 'Allowed to all'; //Commentary
	public $POSTSNUMBER = 'Posts number';
	public $POSTSNUMBERD = 'Number of most recent posts to display in blog front-page.';
	public $SHOWTAGSD = 'Select if you wish to display tags under posts.';
	public $CSSFILED = 'Style sheet to use in your blog. CSS takes care of all the layout, fonts, colours and overall look of your blog.';
	public $RTLCSSFILED = 'Style sheet to use in your blog for Right To Left languages like Persian and Hebrew.';
	public $OPTION = 'Option';
	public $VALUE = 'Value';
	public $HELP = 'Help';
	public $NEWPOST = 'New post';
	public $EDITPOST = 'Edit post';
	public $TITLENOEMPTY = 'Title can not be empty!';
	public $FOLDERCNOTCR = "Folder %s could not be created!"; //%s: folder name
	public $DIMENSIONS = 'Dimensions (W x H)';
	public $SIZEKB = 'Size (KB)';
	public $LISTVIEW = 'List view';
	public $THUMBSVIEW = 'Thumbnails view';
	public $UPLOAD = 'Upload';
	public $UPLOADIMG = 'Upload Image';
	public $MEDIAMAN = 'Media manager';
	public $YOUTUBEVIDEO = 'YouTube video';
	public $GOOGLEVIDEO = 'Google video';
	public $YAHOOVIDEO = 'Yahoo video';
	public $COMSEPTAGS = 'Comma separated tags';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan to display in your blog header. You can write html.';
	public $SHOWOWNER = 'Show owner';
	public $SHOWOWNERD = 'Show owner name in the blog header?';
	public $SHOWARCHIVE = 'Show archive';
	public $SHOWARCHIVED = 'Show months archive in blog footer?';

	//SEO titles
	public $SEOTITLE = 'SEO title';
	public $SEOTITLEEMPTY = 'SEO title cannot be empty!';
	public $INVALID = 'Invalid';
	public $VALID = 'Valid';
	public $SEOTEXIST = 'SEO title already exist!';
	public $SEOTLARGER = 'Try a larger title!';
	public $SEOTHELP = 'You can use only lowercase latin characters, digits, dashes and underscores. SEO title must be unique! Try to insert unique and meaningful SEO titles.';
	public $SEOTSUG = 'Suggested SEO title';
	public $SEOTVAL = 'Validate SEO title';

	//languages names
	public $ARMENIAN = 'Armenian';
	public $BOZNIAN = 'Bosnian';
	public $BRAZILIAN = 'Brazilian';
	public $BULGARIAN = 'Bulgarian';
	public $CREOLE = 'Creole';
	public $CROATIAN = 'Croatian';
	public $DANISH = 'Danish';
	public $ENGLISH = 'English';
	public $FRENCH = 'French';
	public $GERMAN = 'German';
	public $GREEK = 'Greek';
	public $INDONESIAN = 'Indonesian';
	public $ITALIAN = 'Italian';
	public $JAPANESE = 'Japanese';
	public $LATVIAN = 'Latvian';
	public $LITHUANIAN = 'Lithuanian';
	public $PERSIAN = 'Persian';
	public $POLISH = 'Polish';
	public $RUSSIAN = 'Russian';
	public $SERBIAN = 'Serbian';
	public $SPANISH = 'Spanish';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turkish';
	public $VIETNAMESE = 'Vietnamese';

	//backend
	public $BLOGINFO = 'Blog information';
	public $CANCONFIGD = 'Select if you wish the blog owner to be able to change blog settings from front-end.';
	public $CANUPLOADD = 'Select if you wish the blog owner to be able to upload media files.';
	public $BLOGOWNMDIR = 'Blog owner media directory';
	public $EXISTING = 'Existing';
	public $NONEXISTING = 'Non-existing';
	public $SIZEKBD = 'Total allowed uploaded files size for this user in KB. Default value is 2000 (2MB).';
	public $BLOGOWNER = 'Blog owner';
	public $UPLOADDIR = 'Upload directory';
	public $UPLOADEDFILES = 'Uploaded files';
	public $USEDSPACE = 'Used space';
	public $LASTPOST = 'Last post';
	public $LASTPOSTDATE = 'Last post date';
	public $NOTSETYET = 'Not set yet';
	public $UNOTALLUPLOADF = 'User is not allowed to upload files.';

	//elxis 2009.1
	public $INVDATE = 'The date you selected is invalid.';
	public $METADESCDAY = "Posts for %s on %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'No posts found for this date.';
	public $SHAREPOST = 'Share this post';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>