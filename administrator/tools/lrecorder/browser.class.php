<?php 
/**
* @version: $Id$
* @copyright: (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Logins Recorder tool
* @author: Ioannis Sannos
* @email: datahell [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @description: Logs login attempts to Elxis administration (successful or not)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
**/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


	class browserClass {

		public $OS = '';
		public $OS_Version = '';
		public $Browser = '';
		public $Browser_Version = '';
		protected $NET_CLR = false;
		protected $USER_AGENT = '';
		protected $Type = '';


		/***************/
		/* CONSTRUCTOR */
		/***************/
		public function __construct() {
			$this->USER_AGENT = $_SERVER["HTTP_USER_AGENT"];
			$this->getOS();
			$this->getBrowser();
			$this->getNET_CLR();
		}


		protected function getNET_CLR() {
			if (preg_match('/NET CLR/i',$this->USER_AGENT)) {$this->NET_CLR = true;}
		}
		

        /**********/
        /* GET OS */
        /**********/
		protected function getOS() {
			if (preg_match('/win/i',$this->USER_AGENT)) {
				$this->OS = "Windows";
				if ((preg_match('/Windows 95/i',$this->USER_AGENT)) || (preg_match('/Win95/i',$this->USER_AGENT))) {$this->OS_Version = "95";}
				elseif (preg_match('/Windows ME/i',$this->USER_AGENT) || (preg_match('/Win 9x 4\.90/i',$this->USER_AGENT))) {$this->OS_Version = "ME";}
				elseif ((preg_match('/Windows 98/i',$this->USER_AGENT)) || (preg_match('/Win98/i',$this->USER_AGENT))) {$this->OS_Version = "98";}
				elseif ((preg_match('/Windows NT 5\.0/i',$this->USER_AGENT)) || (preg_match('/WinNT5\.0/i',$this->USER_AGENT)) || (preg_match('/Windows 2000/i',$this->USER_AGENT)) || (preg_match('/Win2000/i',$this->USER_AGENT))) {$this->OS_Version = "2000";}
				elseif ((preg_match('/Windows NT 5\.1/i',$this->USER_AGENT)) || (preg_match('/WinNT5\.1/i',$this->USER_AGENT)) || (preg_match('/Windows XP/i',$this->USER_AGENT))) {$this->OS_Version = "XP";}
				elseif ((preg_match('/Windows NT 5\.2/i',$this->USER_AGENT)) || (preg_match('/WinNT5\.2/i',$this->USER_AGENT))) {$this->OS_Version = ".NET 2003";}
				elseif ((preg_match('/Windows NT 6\.0/i',$this->USER_AGENT)) || (preg_match('/WinNT6\.0/i',$this->USER_AGENT))) {$this->OS_Version = "Vista";}
                elseif (preg_match('/Windows CE/i',$this->USER_AGENT)) {$this->OS_Version = "CE";}
				elseif (preg_match('/Win3\.11/i',$this->USER_AGENT)) {$this->OS_Version = "3.11";}
				elseif (preg_match('/Win3\.1/i',$this->USER_AGENT)) {$this->OS_Version = "3.1";}
				elseif ((preg_match('/Windows NT/i',$this->USER_AGENT)) || (preg_match('/WinNT/i',$this->USER_AGENT))) {$this->OS_Version = "NT";}
			} elseif (preg_match('/lindows/i',$this->USER_AGENT)) {
				$this->OS = "LindowsOS";
			} elseif (preg_match('/mac/i',$this->USER_AGENT)) {
				$this->OS = "MacIntosh";
				if ((preg_match('/Mac OS X/i',$this->USER_AGENT)) || (preg_match('/Mac 10/i',$this->USER_AGENT))) {$this->OS_Version = "OS X";}
				elseif ((preg_match('/PowerPC/i',$this->USER_AGENT)) || (preg_match('/PPC/i',$this->USER_AGENT))) {$this->OS_Version = "PPC";}
				elseif ((preg_match('/68000/i',$this->USER_AGENT)) || (preg_match('/68k/i',$this->USER_AGENT))) {$this->OS_Version = "68K";}
			} elseif (preg_match('/linux/i',$this->USER_AGENT)) {
				$this->OS = "Linux";
				if (preg_match('/i686/i',$this->USER_AGENT)) {$this->OS_Version = "i686";}
				elseif (preg_match('/i586/i',$this->USER_AGENT)) {$this->OS_Version = "i586";}
				elseif (preg_match('/i486/i',$this->USER_AGENT)) {$this->OS_Version = "i486";}
				elseif (preg_match('/i386/i',$this->USER_AGENT)) {$this->OS_Version = "i386";}
				elseif (preg_match('/ppc/i',$this->USER_AGENT)) {$this->OS_Version = "ppc";}
			} elseif (preg_match('/sunos/i',$this->USER_AGENT)) {
				$this->OS = "SunOS";
			} elseif (preg_match('/hp\-ux/i',$this->USER_AGENT)) {
				$this->OS = "HP-UX";
			} elseif (preg_match('/osf1/i',$this->USER_AGENT)) {
				$this->OS = "OSF1";
			} elseif (preg_match('/freebsd/i',$this->USER_AGENT)) {
				$this->OS = "FreeBSD";
				if (preg_match('/i686/i',$this->USER_AGENT)) {$this->OS_Version = "i686";}
				elseif (preg_match('/i586/i',$this->USER_AGENT)) {$this->OS_Version = "i586";}
				elseif (preg_match('/i486/i',$this->USER_AGENT)) {$this->OS_Version = "i486";}
				elseif (preg_match('/i386/i',$this->USER_AGENT)) {$this->OS_Version = "i386";}
			} elseif (preg_match('/netbsd/i',$this->USER_AGENT)) {
				$this->OS = "NetBSD";
				if (preg_match('/i686/i',$this->USER_AGENT)) {$this->OS_Version = "i686";}
				elseif (preg_match('/i586/i',$this->USER_AGENT)) {$this->OS_Version = "i586";}
				elseif (preg_match('/i486/i',$this->USER_AGENT)) {$this->OS_Version = "i486";}
				elseif (preg_match('/i386/i',$this->USER_AGENT)) {$this->OS_Version = "i386";}
			} elseif (preg_match('/irix/i',$this->USER_AGENT)) {
				$this->OS = "IRIX";
			} elseif (preg_match('/os/2/i',$this->USER_AGENT)) {
				$this->OS = "OS/2";
				if (preg_match('/Warp 4\.5/i',$this->USER_AGENT)) {$this->OS_Version = "Warp 4.5";}
				elseif (preg_match('/Warp 4/i',$this->USER_AGENT)) {$this->OS_Version = "Warp 4";}
			} elseif (preg_match('/amiga/i',$this->USER_AGENT)) {
				$this->OS = "Amiga";
			} elseif (preg_match('/liberate/i',$this->USER_AGENT)) {
				$this->OS = "Liberate";
			} elseif (preg_match('/qnx/i',$this->USER_AGENT)) {
				$this->OS = "QNX";
				if (preg_match('/photon/i',$this->USER_AGENT)) {$this->OS_Version = "Photon";}
			} elseif (preg_match('/dreamcast/i',$this->USER_AGENT)) {
				$this->OS = "Sega Dreamcast";
			} elseif (preg_match('/palm/i',$this->USER_AGENT)) {
				$this->OS = "Palm";
			} elseif (preg_match('/powertv/i',$this->USER_AGENT)) {
				$this->OS = "PowerTV";
			} elseif (preg_match('/prodigy/i',$this->USER_AGENT)) {
				$this->OS = "Prodigy";
			} elseif (preg_match('/symbian/i',$this->USER_AGENT)) {
				$this->OS = "Symbian";
				if (preg_match('/symbianos/6.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
			} elseif (preg_match('/unix/i',$this->USER_AGENT)) {
				$this->OS = "Unix";
			} elseif (preg_match('/webtv/i',$this->USER_AGENT)) {
				$this->OS = "WebTV";
			} elseif (preg_match('/sie\-cx35/i',$this->USER_AGENT)) {
				$this->OS = "Siemens CX35";
			}
		}


        /***************/
        /* GET BROWSER */
        /***************/
		protected function getBrowser() {
			//bots
			if (preg_match('/msnbot/i',$this->USER_AGENT)) {
				$this->Browser = "MSN Bot";
				$this->Type = "robot";
				if (preg_match('/msnbot\/0\.11/i',$this->USER_AGENT)) {$this->Browser_Version = "0.11";}
				elseif (preg_match('/msnbot\/0\.30/i',$this->USER_AGENT)) {$this->Browser_Version = "0.3";}
				elseif (preg_match('/msnbot\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			} elseif (preg_match('/almaden/i',$this->USER_AGENT)) {
				$this->Browser = "IBM Almaden Crawler";
				$this->Type = "robot";
			}
			elseif (preg_match('/BecomeBot/i',$this->USER_AGENT)) {
				$this->Browser = "BecomeBot";
				if (preg_match('/becomebot\/1\.23/i',$this->USER_AGENT)) {$this->Browser_Version = "1.23";}
				$this->Type = "robot";
			}
			elseif (preg_match('/Link\-Checker\-Pro/i',$this->USER_AGENT)) {
				$this->Browser = "Link Checker Pro";
				$this->Type = "robot";
			}
			elseif (preg_match('/ia\_archiver/i',$this->USER_AGENT)) {
				$this->Browser = "Alexa";
				$this->Type = "robot";
			}
			elseif ((preg_match('/googlebot/i',$this->USER_AGENT)) || (preg_match('/google/i',$this->USER_AGENT))) {
				$this->Browser = "Google Bot";
				$this->Type = "robot";
				if ((preg_match('/googlebot\/2\.1/i',$this->USER_AGENT)) || (preg_match('/google\/2\.1/i',$this->USER_AGENT))) {$this->Browser_Version = "2.1";}
			}
			elseif (preg_match('/surveybot/i',$this->USER_AGENT)) {
				$this->Browser = "Survey Bot";
				$this->Type = "robot";
				if (preg_match('/surveybot\/2\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "2.3";}
			}
			elseif (preg_match('/zyborg/i',$this->USER_AGENT)) {
				$this->Browser = "ZyBorg";
				$this->Type = "robot";
				if (preg_match('/zyborg\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			}
			elseif (preg_match('/w3c\-checklink/i',$this->USER_AGENT)) {
				$this->Browser = "W3C Checklink";
				$this->Type = "robot";
				if (preg_match('/checklink\/3\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "3.6";}
			}
			elseif (preg_match('/linkwalker/i',$this->USER_AGENT)) {
				$this->Browser = "LinkWalker";
				$this->Type = "robot";
			}
			elseif (preg_match('/fast\-webcrawler/i',$this->USER_AGENT)) {
				$this->Browser = "Fast WebCrawler";
				$this->Type = "robot";
				if (preg_match('/webcrawler\/3\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "3.8";}
			}
			elseif ((preg_match('/yahoo/i',$this->USER_AGENT)) && (preg_match('/slurp/i',$this->USER_AGENT))) {
				$this->Browser = "Yahoo! Slurp";
				$this->Type = "robot";
			}
			elseif (preg_match('/naverbot/i',$this->USER_AGENT)) {
				$this->Browser = "NaverBot";
				$this->Type = "robot";
				if (preg_match('/dloader\/1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
			}
			elseif (preg_match('/converacrawler/i',$this->USER_AGENT)) {
				$this->Browser = "ConveraCrawler";
				$this->Type = "robot";
				if (preg_match('/converacrawler\/0\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.5";}
			}
			elseif (preg_match('/w3c\_validator/i',$this->USER_AGENT)) {
				$this->Browser = "W3C Validator";
				$this->Type = "robot";
				if (preg_match('/w3c\_validator\/1\.305/i',$this->USER_AGENT)) {$this->Browser_Version = "1.305";}
			}
			elseif (preg_match('/innerprisebot/i',$this->USER_AGENT)) {
				$this->Browser = "Innerprise";
				$this->Type = "robot";
				if (preg_match('/innerprise\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			}
			elseif (preg_match('/topicspy/i',$this->USER_AGENT)) {
				$this->Browser = "Topicspy Checkbot";
				$this->Type = "robot";
			}
			elseif (preg_match('/poodle predictor/i',$this->USER_AGENT)) {
				$this->Browser = "Poodle Predictor";
				$this->Type = "robot";
				if (preg_match('/poodle predictor 1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			}
			elseif (preg_match('/ichiro/i',$this->USER_AGENT)) {
				$this->Browser = "Ichiro";
				$this->Type = "robot";
				if (preg_match('/ichiro\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			}
			elseif (preg_match('/link checker pro/i',$this->USER_AGENT)) {
				$this->Browser = "Link Checker Pro";
				$this->Type = "robot";
				if (preg_match('/link checker pro 3\.2\.16/i',$this->USER_AGENT)) {$this->Browser_Version = "3.2.16";}
			}
			elseif (preg_match('/grub\-client/i',$this->USER_AGENT)) {
				$this->Browser = "Grub client";
				$this->Type = "robot";
				if (preg_match('/grub\-client\-2\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "2.3";}
			}
			elseif (preg_match('/gigabot/i',$this->USER_AGENT)) {
				$this->Browser = "Gigabot";
				$this->Type = "robot";
				if (preg_match('/gigabot\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
			}
			elseif (preg_match('/psbot/i',$this->USER_AGENT)) {
				$this->Browser = "PSBot";
				$this->Type = "robot";
				if (preg_match('/psbot\/0\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.1";}
			}
			elseif (preg_match('/mj12bot/i',$this->USER_AGENT)) {
				$this->Browser = "MJ12Bot";
				$this->Type = "robot";
				if (preg_match('/mj12bot\/v0\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.5";}
			}
			elseif (preg_match('/nextgensearchbot/i',$this->USER_AGENT)) {
				$this->Browser = "NextGenSearchBot";
				$this->Type = "robot";
				if (preg_match('/nextgensearchbot 1/i',$this->USER_AGENT)) {$this->Browser_Version = "1";}
			}
			elseif (preg_match('/tutorgigbot/i',$this->USER_AGENT)) {
				$this->Browser = "TutorGigBot";
				$this->Type = "robot";
				if (preg_match('/bot\/1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
			}
			elseif (preg_match('/NG/i',$this->USER_AGENT)) {
				$this->Browser = "Exabot NG";
				$this->Type = "robot";
				if (preg_match('/ng\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
			}
			elseif (preg_match('/gaisbot/i',$this->USER_AGENT)) {
				$this->Browser = "Gaisbot";
				$this->Type = "robot";
				if (preg_match('/gaisbot\/3\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
			}
			elseif (preg_match('/xenu link sleuth/i',$this->USER_AGENT)) {
				$this->Browser = "Xenu Link Sleuth";
				$this->Type = "robot";
				if (preg_match('/xenu link sleuth 1\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "1.2";}
			}
			elseif (preg_match('/turnitinbot/i',$this->USER_AGENT)) {
				$this->Browser = "TurnitinBot";
				$this->Type = "robot";
				if (preg_match('/turnitinbot\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
			}
			elseif (preg_match('/iconsurf/i',$this->USER_AGENT)) {
				$this->Browser = "IconSurf";
				$this->Type = "robot";
				if (preg_match('/iconsurf\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
			}
			elseif (preg_match('/zoe indexer/i',$this->USER_AGENT)) {
				$this->Browser = "Zoe Indexer";
				$this->Type = "robot";
				if (preg_match('/v1.x/i',$this->USER_AGENT)) {$this->Browser_Version = "1";}
			}
			elseif (preg_match('/amaya/i',$this->USER_AGENT)) {
				$this->Browser = "amaya";
				$this->Type = "browser";
				if (preg_match('/amaya/5.0/i',$this->USER_AGENT)) {$this->Browser_Version = "5.0";}
				elseif (preg_match('/amaya\/5\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "5.1";}
				elseif (preg_match('/amaya\/5\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "5.2";}
				elseif (preg_match('/amaya\/5\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "5.3";}
				elseif (preg_match('/amaya\/6\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "6.0";}
				elseif (preg_match('/amaya\/6\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
				elseif (preg_match('/amaya\/6\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "6.2";}
				elseif (preg_match('/amaya\/6\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "6.3";}
				elseif (preg_match('/amaya\/6\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "6.4";}
				elseif (preg_match('/amaya\/7\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "7.0";}
				elseif (preg_match('/amaya\/7\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "7.1";}
				elseif (preg_match('/amaya\/7\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "7.2";}
				elseif (preg_match('/amaya\/8\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "8.0";}
			}
			elseif ((preg_match('/aol/i',$this->USER_AGENT)) && !(preg_match('/msie/i',$this->USER_AGENT))) {
				$this->Browser = "AOL";
				$this->Type = "browser";
				if ((preg_match('/aol 7\.0/i',$this->USER_AGENT)) || (preg_match('/aol\/7\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "7.0";}
			}
			elseif ((preg_match('/aweb/i',$this->USER_AGENT)) || (preg_match('/amigavoyager/i',$this->USER_AGENT))) {
				$this->Browser = "AWeb";
				$this->Type = "browser";
				if (preg_match('/voyager\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
				elseif (preg_match('/voyager\/2\.95/i',$this->USER_AGENT)) {$this->Browser_Version = "2.95";}
				elseif ((preg_match('/voyager\/3/i',$this->USER_AGENT)) || (preg_match('/aweb\/3\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "3.0";}
				elseif (preg_match('/aweb\/3\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "3.1";}
				elseif (preg_match('/aweb\/3\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "3.2";}
				elseif (preg_match('/aweb\/3\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "3.3";}
				elseif (preg_match('/aweb\/3\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "3.4";}
				elseif (preg_match('/aweb\/3\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "3.9";}
			}
			elseif (preg_match('/beonex/i',$this->USER_AGENT)) {
				$this->Browser = "Beonex";
				$this->Type = "browser";
				if (preg_match('/beonex\/0\.8\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "0.8.2";}
				elseif (preg_match('/beonex\/0\.8\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.8.1";}
				elseif (preg_match('/beonex\/0\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "0.8";}
			}
			elseif (preg_match('/camino/i',$this->USER_AGENT)) {
				$this->Browser = "Camino";
				$this->Type = "browser";
				if (preg_match('/camino\/0\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "0.7";}
			}
			elseif (preg_match('/cyberdog/i',$this->USER_AGENT)) {
				$this->Browser = "Cyberdog";
				$this->Type = "browser";
				if (preg_match('/cybergog\/1\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "1.2";}
				elseif (preg_match('/cyberdog\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
				elseif (preg_match('/cyberdog\/2\.0b1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0b1";}
			}
			elseif (preg_match('/dillo/i',$this->USER_AGENT)) {
				$this->Browser = "Dillo";
				$this->Type = "browser";
				if (preg_match('/dillo\/0\.6\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "0.6.6";}
				elseif (preg_match('/dillo/0\.7\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "0.7.2";}
				elseif (preg_match('/dillo/0\.7\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "0.7.3";}
				elseif (preg_match('/dillo\/0\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "0.8";}
			}
			elseif (preg_match('/doris/i',$this->USER_AGENT)) {
				$this->Browser = "Doris";
				$this->Type = "browser";
				if (preg_match('/doris\/1\.10/i',$this->USER_AGENT)) {$this->Browser_Version = "1.10";}
			}
			elseif (preg_match('/emacs/i',$this->USER_AGENT)) {
				$this->Browser = "Emacs";
				$this->Type = "browser";
				if (preg_match('/emacs\/w3\/2/i',$this->USER_AGENT)) {$this->Browser_Version = "2";}
				elseif (preg_match('/emacs\/w3\/3/i',$this->USER_AGENT)) {$this->Browser_Version = "3";}
				elseif (preg_match('/emacs\/w3\/4/i',$this->USER_AGENT)) {$this->Browser_Version = "4";}
			}
			elseif (preg_match('/firebird/i',$this->USER_AGENT)) {
				$this->Browser = "Firebird";
				$this->Type = "browser";
				if ((preg_match('/firebird\/0\.6/i',$this->USER_AGENT)) || (preg_match('/browser\/0\.6/i',$this->USER_AGENT))) {$this->Browser_Version = "0.6";}
				elseif (preg_match('/firebird\/0\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "0.7";}
			}
			elseif (preg_match('/firefox/i',$this->USER_AGENT)) {
				$this->Browser = "Firefox";
				$this->Type = "browser";
				if (preg_match('/firefox\/0\.9\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.9.1";}
				elseif (preg_match('/firefox\/0\.10/i',$this->USER_AGENT)) {$this->Browser_Version = "0.10";}
				elseif (preg_match('/firefox\/0\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "0.9";}
				elseif (preg_match('/firefox\/0\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "0.8";}
				elseif (preg_match('/firefox\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
				elseif (preg_match('/firefox\/1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
				elseif (preg_match('/firefox\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
				elseif (preg_match('/firefox\/2\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.1";}
				elseif (preg_match('/firefox\/2\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "2.5";}
				elseif (preg_match('/firefox\/3\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
				elseif (preg_match('/firefox\/3\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "3.5";}
				elseif (preg_match('/firefox\/4\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "4.0";}
			}
			elseif (preg_match('/frontpage/i',$this->USER_AGENT)) {
				$this->Browser = "FrontPage";
				$this->Type = "browser";
				if ((preg_match('/express 2/i',$this->USER_AGENT)) || (preg_match('/frontpage 2/i',$this->USER_AGENT))) {$this->Browser_Version = "2";}
				elseif (preg_match('/frontpage 3/i',$this->USER_AGENT)) {$this->Browser_Version = "3";}
				elseif (preg_match('/frontpage 4/i',$this->USER_AGENT)) {$this->Browser_Version = "4";}
				elseif (preg_match('/frontpage 5/i',$this->USER_AGENT)) {$this->Browser_Version = "5";}
				elseif (preg_match('/frontpage 6/i',$this->USER_AGENT)) {$this->Browser_Version = "6";}
			}
			elseif (preg_match('/galeon/i',$this->USER_AGENT)) {
				$this->Browser = "Galeon";
				$this->Type = "browser";
				if (preg_match('/galeon 0\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.1";}
				elseif (preg_match('/galeon\/0\.11\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.11.1";}
				elseif (preg_match('/galeon\/0\.11\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "0.11.2";}
				elseif (preg_match('/galeon\/0\.11\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "0.11.3";}
				elseif (preg_match('/galeon\/0\.11\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.11.5";}
				elseif (preg_match('/galeon\/0\.12\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.8";}
				elseif (preg_match('/galeon\/0\.12\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.7";}
				elseif (preg_match('/galeon\/0\.12\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.6";}
				elseif (preg_match('/galeon\/0\.12\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.5";}
				elseif (preg_match('/galeon\/0\.12\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.4";}
				elseif (preg_match('/galeon\/0\.12\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.3";}
				elseif (preg_match('/galeon\/0\.12\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.2";}
				elseif (preg_match('/galeon\/0\.12\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12.1";}
				elseif (preg_match('/galeon\/0\.12/i',$this->USER_AGENT)) {$this->Browser_Version = "0.12";}
				elseif ((preg_match('/galeon\/1/i',$this->USER_AGENT)) || (preg_match('/galeon 1\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "1.0";}
			}
			elseif (preg_match('/ibm web browser/i',$this->USER_AGENT)) {
				$this->Browser = "IBM Web Browser";
				$this->Type = "browser";
				if (preg_match('/rv:1.0.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0.1";}
			}
			elseif (preg_match('/chimera/i',$this->USER_AGENT)) {
				$this->Browser = "Chimera";
				$this->Type = "browser";
				if (preg_match('/chimera\/0\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "0.7";}
				elseif (preg_match('/chimera\/0\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "0.6";}
				elseif (preg_match('/chimera\/0\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.5";}
				elseif (preg_match('/chimera\/0\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "0.4";}
			}
			elseif (preg_match('/icab/i',$this->USER_AGENT)) {
				$this->Browser = "iCab";
        		$this->Type = "browser";
				if (preg_match('/icab\/2\.7\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.7.1";}
				elseif (preg_match('/icab\/2\.8\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.8.1";}
				elseif (preg_match('/icab\/2\.8\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "2.8.2";}
				elseif (preg_match('/icab 2\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "2.9";}
				elseif (preg_match('/icab 3\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
			}
			elseif (preg_match('/konqueror/i',$this->USER_AGENT)) {
				$this->Browser = "Konqueror";
				$this->Type = "browser";
				if (preg_match('/konqueror\/3\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "3.1";}
				elseif (preg_match('/konqueror\/3\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "3.5";}
				elseif (preg_match('/konqueror\/3\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "3.4";}
				elseif (preg_match('/konqueror\/3\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "3.3";}
				elseif (preg_match('/konqueror\/3\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "3.2";}
				elseif (preg_match('/konqueror\/3/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
				elseif (preg_match('/konqueror\/2\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "2.2";}
				elseif (preg_match('/konqueror\/2\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.1";}
				elseif (preg_match('/konqueror\/1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
			}
			elseif (preg_match('/liberate/i',$this->USER_AGENT)) {
				$this->Browser = "Liberate";
				$this->Type = "browser";
				if (preg_match('/dtv 1\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "1.2";}
				elseif (preg_match('/dtv 1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
			}
			elseif (preg_match('/desktop\/lx/i',$this->USER_AGENT)) {
				$this->Browser = "Lycoris Desktop/LX";
				$this->Type = "browser";
			}
			elseif (preg_match('/netbox/i',$this->USER_AGENT)) {
				$this->Browser = "NetBox";
				$this->Type = "browser";
				if (preg_match('/netbox\/3\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "3.5";}
			}
			elseif (preg_match('/netcaptor/i',$this->USER_AGENT)) {
				$this->Browser = "Netcaptor";
				$this->Type = "browser";
				if (preg_match('/netcaptor 7\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "7.0";}
				elseif (preg_match('/netcaptor 7\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "7.1";}
				elseif (preg_match('/netcaptor 7\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "7.2";}
				elseif (preg_match('/netcaptor 7\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "7.5";}
				elseif (preg_match('/netcaptor 6\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
			}
			elseif (preg_match('/netpliance/i',$this->USER_AGENT)) {
				$this->Browser = "Netpliance";
				$this->Type = "browser";
			}
			elseif (preg_match('/netscape/i',$this->USER_AGENT)) {
				$this->Browser = "Netscape";
				$this->Type = "browser";
				if (preg_match('/netscape\/7\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "7.1";}
				elseif (preg_match('/netscape\/7\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "7.2";}
				elseif (preg_match('/netscape\/7\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "7.0";}
				elseif (preg_match('/netscape6\/6\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "6.2";}
				elseif (preg_match('/netscape6\/6\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
				elseif (preg_match('/netscape6\/6\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "6.0";}
			}
			elseif ((preg_match('/mozilla\/5\.0/i',$this->USER_AGENT)) && (preg_match('/rv\:/i',$this->USER_AGENT)) && (preg_match('/gecko\//i',$this->USER_AGENT))) {
				$this->Browser = "Mozilla";
				$this->Type = "browser";
				if (preg_match('/rv\:1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
				elseif (preg_match('/rv\:1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
				elseif (preg_match('/rv\:1\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "1.2";}
				elseif (preg_match('/rv\:1\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "1.3";}
				elseif (preg_match('/rv\:1\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "1.4";}
				elseif (preg_match('/rv\:1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
				elseif (preg_match('/rv\:1\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "1.6";}
				elseif (preg_match('/rv\:1\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "1.7";}
				elseif (preg_match('/rv\:1\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "1.8";}
			}
			elseif (preg_match('/offbyone/i',$this->USER_AGENT)) {
				$this->Browser = "OffByOne";
				$this->Type = "browser";
				if (preg_match('/mozilla\/4\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "3.4";}
			}
			elseif (preg_match('/omniweb/i',$this->USER_AGENT)) {
				$this->Browser = "OmniWeb";
				$this->Type = "browser";
				if (preg_match('/omniweb\/4\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "4.5";}
				elseif (preg_match('/omniweb\/4\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "4.4";}
				elseif (preg_match('/omniweb\/4\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "4.3";}
				elseif (preg_match('/omniweb\/4\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "4.2";}
				elseif (preg_match('/omniweb\/4\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "4.1";}
			}
			elseif (preg_match('/opera/i',$this->USER_AGENT)) {
				$this->Browser = "Opera";
				$this->Type = "browser";
				if ((preg_match('/opera\/7\.21/i',$this->USER_AGENT)) || (preg_match('/opera 7\.21/i',$this->USER_AGENT))) {$this->Browser_Version = "7.21";}
				elseif ((preg_match('/opera\/8\.3/i',$this->USER_AGENT)) || (preg_match('/opera 8\.3/i',$this->USER_AGENT))) {$this->Browser_Version = "8.3";}
				elseif ((preg_match('/opera\/8\.2/i',$this->USER_AGENT)) || (preg_match('/opera 8\.2/i',$this->USER_AGENT))) {$this->Browser_Version = "8.2";}
				elseif ((preg_match('/opera\/8\.1/i',$this->USER_AGENT)) || (preg_match('/opera 8\.1/i',$this->USER_AGENT))) {$this->Browser_Version = "8.1";}
				elseif ((preg_match('/opera\/8\.0/i',$this->USER_AGENT)) || (preg_match('/opera 8\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "8.0";}
				elseif ((preg_match('/opera\/7\.60/i',$this->USER_AGENT)) || (preg_match('/opera 7\.60/i',$this->USER_AGENT))) {$this->Browser_Version = "7.60";}
				elseif ((preg_match('/opera\/7\.54/i',$this->USER_AGENT)) || (preg_match('/opera 7\.54/i',$this->USER_AGENT))) {$this->Browser_Version = "7.54";}
				elseif ((preg_match('/opera\/7\.53/i',$this->USER_AGENT)) || (preg_match('/opera 7\.53/i',$this->USER_AGENT))) {$this->Browser_Version = "7.53";}
				elseif ((preg_match('/opera\/7\.52/i',$this->USER_AGENT)) || (preg_match('/opera 7\.52/i',$this->USER_AGENT))) {$this->Browser_Version = "7.52";}
				elseif ((preg_match('/opera\/7\.51/i',$this->USER_AGENT)) || (preg_match('/opera 7\.51/i',$this->USER_AGENT))) {$this->Browser_Version = "7.51";}
				elseif ((preg_match('/opera\/7\.50/i',$this->USER_AGENT)) || (preg_match('/opera 7\.50/i',$this->USER_AGENT))) {$this->Browser_Version = "7.50";}
				elseif ((preg_match('/opera\/7\.23/i',$this->USER_AGENT)) || (preg_match('/opera 7\.23/i',$this->USER_AGENT))) {$this->Browser_Version = "7.23";}
				elseif ((preg_match('/opera\/7\.22/i',$this->USER_AGENT)) || (preg_match('/opera 7\.22/i',$this->USER_AGENT))) {$this->Browser_Version = "7.22";}
				elseif ((preg_match('/opera\/7\.20/i',$this->USER_AGENT)) || (preg_match('/opera 7\.20/i',$this->USER_AGENT))) {$this->Browser_Version = "7.20";}
				elseif ((preg_match('/opera\/7\.11/i',$this->USER_AGENT)) || (preg_match('/opera 7\.11/i',$this->USER_AGENT))) {$this->Browser_Version = "7.11";}
				elseif ((preg_match('/opera\/7\.10/i',$this->USER_AGENT)) || (preg_match('/opera 7\.10/i',$this->USER_AGENT))) {$this->Browser_Version = "7.10";}
				elseif ((preg_match('/opera\/7\.03/i',$this->USER_AGENT)) || (preg_match('/opera 7\.03/i',$this->USER_AGENT))) {$this->Browser_Version = "7.03";}
				elseif ((preg_match('/opera\/7\.02/i',$this->USER_AGENT)) || (preg_match('/opera 7\.02/i',$this->USER_AGENT))) {$this->Browser_Version = "7.02";}
				elseif ((preg_match('/opera\/7\.01/i',$this->USER_AGENT)) || (preg_match('/opera 7\.01/i',$this->USER_AGENT))) {$this->Browser_Version = "7.01";}
				elseif ((preg_match('/opera\/7\.0/i',$this->USER_AGENT)) || (preg_match('/opera 7\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "7.0";}
				elseif ((preg_match('/opera\/6\.12/i',$this->USER_AGENT)) || (preg_match('/opera 6\.12/i',$this->USER_AGENT))) {$this->Browser_Version = "6.12";}
				elseif ((preg_match('/opera\/6\.11/i',$this->USER_AGENT)) || (preg_match('/opera 6\.11/i',$this->USER_AGENT))) {$this->Browser_Version = "6.11";}
				elseif ((preg_match('/opera\/6\.1/i',$this->USER_AGENT)) || (preg_match('/opera 6\.1/i',$this->USER_AGENT))) {$this->Browser_Version = "6.1";}
				elseif ((preg_match('/opera\/6\.0/i',$this->USER_AGENT)) || (preg_match('/opera 6\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "6.0";}
				elseif ((preg_match('/opera\/5\.12/i',$this->USER_AGENT)) || (preg_match('/opera 5\.12/i',$this->USER_AGENT))) {$this->Browser_Version = "5.12";}
				elseif ((preg_match('/opera\/5\.0/i',$this->USER_AGENT)) || (preg_match('/opera 5\.0/i',$this->USER_AGENT))) {$this->Browser_Version = "5.0";}
				elseif ((preg_match('/opera\/4/i',$this->USER_AGENT)) || (preg_match('/opera 4/i',$this->USER_AGENT))) {$this->Browser_Version = "4";}
			}
			elseif (preg_match('/oracle/i',$this->USER_AGENT)) {
				$this->Browser = "Oracle PowerBrowser";
				$this->Type = "browser";
				if (preg_match('/\(tm\)\/1\.0a/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0a";}
				elseif (preg_match('/oracle 1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
			}
			elseif (preg_match('/phoenix/i',$this->USER_AGENT)) {
				$this->Browser = "Phoenix";
				$this->Type = "browser";
				if (preg_match('/phoenix\/0\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "0.4";}
				elseif (preg_match('/phoenix\/0\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.5";}
			}
			elseif (preg_match('/planetweb/i',$this->USER_AGENT)) {
				$this->Browser = "PlanetWeb";
				$this->Type = "browser";
				if (preg_match('/planetweb\/2\.606/i',$this->USER_AGENT)) {$this->Browser_Version = "2.6";}
				elseif (preg_match('/planetweb\/1\.125/i',$this->USER_AGENT)) {$this->Browser_Version = "3";}
			}
			elseif (preg_match('/powertv/i',$this->USER_AGENT)) {
				$this->Browser = "PowerTV";
				$this->Type = "browser";
				if (preg_match('/powertv\/1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
			}
			elseif (preg_match('/prodigy/i',$this->USER_AGENT)) {
				$this->Browser = "Prodigy";
				$this->Type = "browser";
				if (preg_match('/wb\/3\.2e/i',$this->USER_AGENT)) {$this->Browser_Version = "3.2e";}
				elseif (preg_match('/rv\: 1\./i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
			}
			elseif ((preg_match('/voyager/i',$this->USER_AGENT)) || ((preg_match('/qnx/i',$this->USER_AGENT))) && (preg_match('/rv\: 1\./i',$this->USER_AGENT))) {
				$this->Browser = "Voyager";
                $this->Type = "browser";
				if (preg_match('/2\.03b/i',$this->USER_AGENT)) {$this->Browser_Version = "2.03b";}
				elseif (preg_match('/wb\/win32\/3\.4g/i',$this->USER_AGENT)) {$this->Browser_Version = "3.4g";}
			}
			elseif (preg_match('/quicktime/i',$this->USER_AGENT)) {
				$this->Browser = "QuickTime";
				$this->Type = "browser";
				if (preg_match('/qtver\=5/i',$this->USER_AGENT)) {$this->Browser_Version = "5.0";}
				elseif (preg_match('/qtver\=6\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "6.0";}
				elseif (preg_match('/qtver\=6\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
				elseif (preg_match('/qtver\=6\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "6.2";}
				elseif (preg_match('/qtver\=6\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "6.3";}
				elseif (preg_match('/qtver\=6\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "6.4";}
				elseif (preg_match('/qtver\=6\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "6.5";}
			}
			elseif (preg_match('/safari/i',$this->USER_AGENT)) {
				$this->Browser = "Safari";
				$this->Type = "browser";
				if (preg_match('/safari\/48/i',$this->USER_AGENT)) {$this->Browser_Version = "0.48";}
				elseif (preg_match('/safari\/49/i',$this->USER_AGENT)) {$this->Browser_Version = "0.49";}
				elseif (preg_match('/safari\/51/i',$this->USER_AGENT)) {$this->Browser_Version = "0.51";}
				elseif (preg_match('/safari\/60/i',$this->USER_AGENT)) {$this->Browser_Version = "0.60";}
				elseif (preg_match('/safari\/61/i',$this->USER_AGENT)) {$this->Browser_Version = "0.61";}
				elseif (preg_match('/safari\/62/i',$this->USER_AGENT)) {$this->Browser_Version = "0.62";}
				elseif (preg_match('/safari\/63/i',$this->USER_AGENT)) {$this->Browser_Version = "0.63";}
				elseif (preg_match('/safari\/64/i',$this->USER_AGENT)) {$this->Browser_Version = "0.64";}
				elseif (preg_match('/safari\/65/i',$this->USER_AGENT)) {$this->Browser_Version = "0.65";}
				elseif (preg_match('/safari\/66/i',$this->USER_AGENT)) {$this->Browser_Version = "0.66";}
				elseif (preg_match('/safari\/67/i',$this->USER_AGENT)) {$this->Browser_Version = "0.67";}
				elseif (preg_match('/safari\/68/i',$this->USER_AGENT)) {$this->Browser_Version = "0.68";}
				elseif (preg_match('/safari\/69/i',$this->USER_AGENT)) {$this->Browser_Version = "0.69";}
				elseif (preg_match('/safari\/70/i',$this->USER_AGENT)) {$this->Browser_Version = "0.70";}
				elseif (preg_match('/safari\/71/i',$this->USER_AGENT)) {$this->Browser_Version = "0.71";}
				elseif (preg_match('/safari\/72/i',$this->USER_AGENT)) {$this->Browser_Version = "0.72";}
				elseif (preg_match('/safari\/73/i',$this->USER_AGENT)) {$this->Browser_Version = "0.73";}
				elseif (preg_match('/safari\/74/i',$this->USER_AGENT)) {$this->Browser_Version = "0.74";}
				elseif (preg_match('/safari\/80/i',$this->USER_AGENT)) {$this->Browser_Version = "0.80";}
				elseif (preg_match('/safari\/83/i',$this->USER_AGENT)) {$this->Browser_Version = "0.83";}
				elseif (preg_match('/safari\/84/i',$this->USER_AGENT)) {$this->Browser_Version = "0.84";}
				elseif (preg_match('/safari\/85/i',$this->USER_AGENT)) {$this->Browser_Version = "0.85";}
				elseif (preg_match('/safari\/90/i',$this->USER_AGENT)) {$this->Browser_Version = "0.90";}
				elseif (preg_match('/safari\/92/i',$this->USER_AGENT)) {$this->Browser_Version = "0.92";}
				elseif (preg_match('/safari\/93/i',$this->USER_AGENT)) {$this->Browser_Version = "0.93";}
				elseif (preg_match('/safari\/94/i',$this->USER_AGENT)) {$this->Browser_Version = "0.94";}
				elseif (preg_match('/safari\/95/i',$this->USER_AGENT)) {$this->Browser_Version = "0.95";}
				elseif (preg_match('/safari\/96/i',$this->USER_AGENT)) {$this->Browser_Version = "0.96";}
				elseif (preg_match('/safari\/97/i',$this->USER_AGENT)) {$this->Browser_Version = "0.97";}
				elseif (preg_match('/safari\/125/i',$this->USER_AGENT)) {$this->Browser_Version = "1.25";}
			}
			elseif (preg_match('/sextatnt/i',$this->USER_AGENT)) {
				$this->Browser = "Tango";
				$this->Type = "browser";
				if (preg_match('/sextant v3\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
			}
			elseif (preg_match('/sharpreader/i',$this->USER_AGENT)) {
				$this->Browser = "SharpReader";
				$this->Type = "browser";
				if (preg_match('/sharpreader\/0\.9\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "0.9.5";}
			}
			elseif (preg_match('/elinks/i',$this->USER_AGENT)) {
				$this->Browser = "ELinks";
				$this->Type = "browser";
				if (preg_match('/0\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "0.3";}
				elseif (preg_match('/0\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "0.4";}
				elseif (preg_match('/0\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "0.9";}
			}
			elseif (preg_match('/links/i',$this->USER_AGENT)) {
				$this->Browser = "Links";
				$this->Type = "browser";
				if (preg_match('/0\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "0.9";}
				elseif (preg_match('/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
				elseif (preg_match('/2\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "2.1";}
			}
			elseif (preg_match('/lynx/i',$this->USER_AGENT)) {
				$this->Browser = "Lynx";
				$this->Type = "browser";
				if (preg_match('/lynx\/2\.3/i',$this->USER_AGENT)) {$this->Browser_Version = "2.3";}
				elseif (preg_match('/lynx\/2\.4/i',$this->USER_AGENT)) {$this->Browser_Version = "2.4";}
				elseif ((preg_match('/lynx\/2\.5/i',$this->USER_AGENT)) || (preg_match('/lynx 2.5/i',$this->USER_AGENT))) {$this->Browser_Version = "2.5";}
				elseif (preg_match('/lynx\/2\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "2.6";}
				elseif (preg_match('/lynx\/2\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "2.7";}
				elseif (preg_match('/lynx\/2\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "2.8";}
			}
			elseif (preg_match('/webexplorer/i',$this->USER_AGENT)) {
				$this->Browser = "WebExplorer";
				$this->Type = "browser";
				if (preg_match('/dll\/v1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
			}
			elseif (preg_match('/wget/i',$this->USER_AGENT)) {
				$this->Browser = "WGet";
				$this->Type = "browser";
				if (preg_match('/Wget\/1\.9/i',$this->USER_AGENT)) {$this->Browser_Version = "1.9";}
				if (preg_match('/Wget\/1\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "1.8";}
			}
			elseif (preg_match('/webtv/i',$this->USER_AGENT)) {
				$this->Browser = "WebTV";
				$this->Type = "browser";
				if (preg_match('/webtv\/1\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "1.0";}
				elseif (preg_match('/webtv\/1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
				elseif (preg_match('/webtv\/1\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "1.2";}
				elseif (preg_match('/webtv\/2\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "2.2";}
				elseif (preg_match('/webtv\/2\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "2.5";}
				elseif (preg_match('/webtv\/2\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "2.6";}
				elseif (preg_match('/webtv\/2\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "2.7";}
				elseif (preg_match('/webtv\/2\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "2.8";}
			}
			elseif (preg_match('/yandex/i',$this->USER_AGENT)) {
				$this->Browser = "Yandex";
				$this->Type = "browser";
				if (preg_match('/\/1\.01/i',$this->USER_AGENT)) {$this->Browser_Version = "1.01";}
				elseif (preg_match('/\/1\.03/i',$this->USER_AGENT)) {$this->Browser_Version = "1.03";}
			}
			elseif ((preg_match('/mspie/i',$this->USER_AGENT)) || ((preg_match('/msie/i',$this->USER_AGENT))) && (preg_match('/windows ce/i',$this->USER_AGENT))) {
				$this->Browser = "Pocket Internet Explorer";
				$this->Type = "browser";
				if (preg_match('/mspie 1\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "1.1";}
				elseif (preg_match('/mspie 2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
				elseif (preg_match('/msie 3\.02/i',$this->USER_AGENT)) {$this->Browser_Version = "3.02";}
			}
			elseif (preg_match('/UP\.Browser/i',$this->USER_AGENT)) {
				$this->Browser = "UP Browser";
				$this->Type = "browser";
				if (preg_match('/Browser\/7\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "7.0";}
			}
			elseif (preg_match('/msie/i',$this->USER_AGENT)) {
				$this->Browser = "Internet Explorer";
				$this->Type = "browser";
				if (preg_match('/msie 6\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "6.0";}
				elseif (preg_match('/msie 6\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "6.1";}
				elseif (preg_match('/msie 6\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "6.2";}
				elseif (preg_match('/msie 7\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "7.0";}
				elseif (preg_match('/msie 7\.1/i',$this->USER_AGENT)) {$this->Browser_Version = "7.1";}
				elseif (preg_match('/msie 7\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "7.2";}
				elseif (preg_match('/msie 8\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "8.0";}
				elseif (preg_match('/msie 9\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "9.0";}
				elseif (preg_match('/msie 5\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "5.5";}
				elseif (preg_match('/msie 5\.01/i',$this->USER_AGENT)) {$this->Browser_Version = "5.01";}
				elseif (preg_match('/msie 5\.23/i',$this->USER_AGENT)) {$this->Browser_Version = "5.23";}
				elseif (preg_match('/msie 5\.22/i',$this->USER_AGENT)) {$this->Browser_Version = "5.22";}
				elseif (preg_match('/msie 5\.2\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "5.2.2";}
				elseif (preg_match('/msie 5\.1b1/i',$this->USER_AGENT)) {$this->Browser_Version = "5.1b1";}
				elseif (preg_match('/msie 5\.17/i',$this->USER_AGENT)) {$this->Browser_Version = "5.17";}
				elseif (preg_match('/msie 5\.16/i',$this->USER_AGENT)) {$this->Browser_Version = "5.16";}
				elseif (preg_match('/msie 5\.12/i',$this->USER_AGENT)) {$this->Browser_Version = "5.12";}
				elseif (preg_match('/msie 5\.0b1/i',$this->USER_AGENT)) {$this->Browser_Version = "5.0b1";}
				elseif (preg_match('/msie 5\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "5.0";}
				elseif (preg_match('/msie 5\.21/i',$this->USER_AGENT)) {$this->Browser_Version = "5.21";}
				elseif (preg_match('/msie 5\.2/i',$this->USER_AGENT)) {$this->Browser_Version = "5.2";}
				elseif (preg_match('/msie 5\.15/i',$this->USER_AGENT)) {$this->Browser_Version = "5.15";}
				elseif (preg_match('/msie 5\.14/i',$this->USER_AGENT)) {$this->Browser_Version = "5.14";}
				elseif (preg_match('/msie 5\.13/i',$this->USER_AGENT)) {$this->Browser_Version = "5.13";}
				elseif (preg_match('/msie 4\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "4.5";}
				elseif (preg_match('/msie 4\.01/i',$this->USER_AGENT)) {$this->Browser_Version = "4.01";}
				elseif (preg_match('/msie 4\.0b2/i',$this->USER_AGENT)) {$this->Browser_Version = "4.0b2";}
				elseif (preg_match('/msie 4\.0b1/i',$this->USER_AGENT)) {$this->Browser_Version = "4.0b1";}
				elseif (preg_match('/msie 4/i',$this->USER_AGENT)) {$this->Browser_Version = "4.0";}
				elseif (preg_match('/msie 3/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
				elseif (preg_match('/msie 2/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
				elseif (preg_match('/msie 1\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "1.5";}
			}
			elseif (preg_match('/iexplore/i',$this->USER_AGENT)) {
				$this->Browser = "Internet Explorer";
				$this->Type = "browser";
			}
			elseif (preg_match('/mozilla/i',$this->USER_AGENT)) {
				$this->Browser = "Netscape";
				$this->Type = "browser";
				if (preg_match('/mozilla\/4\.8/i',$this->USER_AGENT)) {$this->Browser_Version = "4.8";}
				elseif (preg_match('/mozilla\/4\.7/i',$this->USER_AGENT)) {$this->Browser_Version = "4.7";}
				elseif (preg_match('/mozilla\/4\.6/i',$this->USER_AGENT)) {$this->Browser_Version = "4.6";}
				elseif (preg_match('/mozilla\/4\.5/i',$this->USER_AGENT)) {$this->Browser_Version = "4.5";}
				elseif (preg_match('/mozilla\/4\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "4.0";}
				elseif (preg_match('/mozilla\/3\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "3.0";}
				elseif (preg_match('/mozilla\/2\.0/i',$this->USER_AGENT)) {$this->Browser_Version = "2.0";}
			}
		}
	}
?>