<?php

/*
* Greek Calendar v.1.3 for Elxis CMS
* Copyright (C) 2009 - 2011 www.osw.gr - All rights reserved.
* Licence GNU/GPL
*/
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $_VERSION;
if (version_compare($_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL, '2009.2') >= 0) {
	$greek_calendar_sslurl = $mainframe->getCfg('ssl_live_site');
} else {
	$greek_calendar_ssl = 0;
	$greek_calendar_sslurl = $mainframe->getCfg('live_site');
	if (isset($_SERVER['HTTPS'])) {
		if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { $greek_calendar_ssl = 1; }
	}
	if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) { $greek_calendar_ssl = 1; }
	if ($panorama_ssl == 1) { $panorama_sslurl = preg_replace('@^(http\:)@i', 'https:', $greek_calendar_sslurl); }
	unset($panorama_ssl);
}
$greek_calendar_url = $greek_calendar_sslurl.'/modules/mod_greek_calendar'; 

global $mainframe;

$grcal_bg = $params->get('grcal_bg','1');

$grcal_styleimage = $params->get('grcal_styleimage','BlueBell');

$grcal_date = $params->get('grcal_date','1');

$grcal_display_location = $params->get('grcal_display_location','1');

$grcal_location = $params->get('grcal_location','');

$grcal_sun_moon = $params->get('grcal_sun_moon','1');

$grcal_worlddays = $params->get('grcal_worlddays','1');

$grcal_display_nextnamedays = $params->get('grcal_display_nextnamedays','1');

require_once($mosConfig_absolute_path . '/modules/mod_greek_calendar/namedays.php');
require_once($mosConfig_absolute_path . '/modules/mod_greek_calendar/worlddays.php');
require_once($mosConfig_absolute_path . '/modules/mod_greek_calendar/includes/sun.php');
require_once($mosConfig_absolute_path . '/modules/mod_greek_calendar/includes/moon-phase.cls.php');
require_once($mosConfig_absolute_path . '/modules/mod_greek_calendar/language/greek.php');

//Trexousa imera, minas, etos
$server_now = time();
$local_now = $server_now+($mosConfig_offset*60*60);
$day = date("j", $local_now);
$month = date("n", $local_now);
$year = date("Y", $local_now);

//Ypologismos anatolis kai dysis iliou
$sun = new sun;
$date = mktime( 0, 0, 0, $month, $day, $year );
$timezone = $params->def('grcal_timezone','2');
$latitude = $params->def('grcal_latitude','37.984188');
$longitude = $params->def('grcal_longitude','23.7279');
$zenith = $params->def('grcal_zenith','90');
$sunrise = date( "H.i", $sun->rise( $date, $timezone, $latitude, $longitude, $zenith ) );
$sunset = date( "H.i", $sun->set( $date, $timezone, $latitude, $longitude, $zenith ) );

//Ypologismos fasis selinis
$dateAsTimeStamp = '';
$mp = new moonPhase($dateAsTimeStamp);
$moon = round( $mp->getPeriodInDays() - $mp->getDaysUntilNextNewMoon(), 0);
$moon_name = $mp->getPhaseName();

//Dimiourgia keimenoy gia fasi selinis
if ( $moon_name == "New Moon" or $moon == 0 ) {
	$moon_name = $NEWMOON;
}
elseif ( $moon_name == "First Quarter Moon" ) {
	$moon_name = $FQMOON;
}
elseif ( $moon_name == "Full Moon" ) {
	$moon_name = $FULLMOON;
}
elseif ( $moon_name == "Third Quarter Moon" ) {
	$moon_name = $TQMOON;
}
else {
	$moon_name = '';
}
if ( $moon_name ) {
	$moon_text = $moon_name;
}
else {
	if ( $moon == 1 ) {
		$moon_post = $MOONPOSTSING;
	}
	else {
		$moon_post = $MOONPOSTPLUR;
	}
	$moon_text = $MOONPRE . "<br />" . $moon . "&nbsp;" . $moon_post;
}

//Trexousa imera
$jd_now = gregoriantojd($month, $day, $year);
$day_of_the_week = jddayofweek($jd_now);

//Eyresi pagkosmias imeras an yparxei
$worlddays_now = $worlddays["$day" . "/" . "$month"];

//Oles oi pagkosmies imeres einai statheres ana etos ektos 2

// 1) Ypologismos tis Pagkosmias Imeras tis Miteras poy einai i deyteri Kyriaki toy Maioy kathe etoys
function maysecondsunday($year=0) {
    if (!$year) { $year = date('Y'); }
    $w = date('w', mktime(0, 0, 0, 5, 1, $year));
    return ($w == 0) ? 8 : 15 - $w;
}
$mothersday = maysecondsunday();

// 2) Ypologismos tis Pagkosmias Imeras toy Patera poy einai i triti Kyriaki toy Ioynioy kathe etoys
function junethirdsunday($year=0) {
    if (!$year) { $year = date('Y'); }
    $w = date('w', mktime(0, 0, 0, 6, 1, $year));
    return ($w == 0) ? 8 : 22 - $w;
}
$fathersday = junethirdsunday();

if ($month == 5 && $day == $mothersday) {
    $extra_worlddays = $mother;
}
elseif ($month == 6 && $day == $fathersday) {
    $extra_worlddays = $father;
}
else {
		 $extra_worlddays = "";
		 }

//Ypologismos tis Kyriakis toy Pasxa
$easter = ((19*($year%19)+16)%30)+((2*($year%4))+(4*($year%7))+(6*((19*($year%19)+16)%30)))%7+3;

if ($easter > 30) {
	$month_easter = 5;
	$day_easter = $easter - 30;
}
else {
	$month_easter = 4;
	$day_easter = $easter;
}

//Pasxa sto Ioyliano Imerologio
$jd_easter = gregoriantojd($month_easter, $day_easter, $year);

//Imeres metaxy trexoysas imeras kai Kyriakis toy Pasxa
$difference = abs($jd_now - $jd_easter);
if ($jd_now > $jd_easter) {
	$difference = "+" . $difference;
}
elseif ($jd_now < $jd_easter) {
	$difference = "-" . $difference;
}
else {
	$difference = "0";
}

//Eyresi eorton os pros to Pasxa
if (isset($namedays_pasha[$difference])) {
	$p_namedays = $namedays_pasha[$difference] . "<br />";
}
else {
	$p_namedays = "";
}

//Ypologismos eidikon eorton
$pasha = ("$day_easter"."/"."$month_easter");
$today = ("$day"."/"."$month");

//Xloi - eortazetai tin proti Kyriaki meta tis 13 Febroyarioy
//Ektos an i 13η Febroyarioy einai Kyriaki opote den metatithetai
function firstsundayafter13feb ($year=0) {
    if (!$year) { $year = date('Y'); }
    $w = date('w', mktime(0, 0, 0, 2, 13, $year));
    return ($w == 0) ? 8 : 20 - $w;
}
$chloe_date = firstsundayafter13feb() . "/" . 2;

//Kyriaki ton Propatoron - eortazontai stis 11 Dekembrioy kai pantote Kyriaki
//Ektos ean i 11n Dekembrioy tyxei kathimerini opote i giorti metatithetai tin prosexi Kyriaki    
function sunday11dec ($year=0) {
    if (!$year) { $year = date('Y'); }
    $w = date('w', mktime(0, 0, 0, 12, 11, $year));
    return ($w == 0) ? 11 : 18 - $w;
}
$propatoron_date = sunday11dec() . "/" . 12;

//Agioy Georgioy - eortazetai stis 23 Aprilioy
//Εktos ean to Pasxa peftei meta tis 23 Aprilioy, opote i giorti metatithetai 1 mera meta to Pasxa
$parts = split('/', $pasha);
$pasha_ts = mktime(12, 0, 0, intval(trim($parts[1])), intval(trim($parts[0])), date('Y'));
$april_ts = mktime(12, 0, 0, 4, 23, date('Y'));
$george_date = ($pasha_ts > $april_ts) ? date('j/n', $pasha_ts + 86400) : date('j/n', $april_ts);

//Markoy toy Apostoloy kai Eyaggelisti  - eortazetai stis 25 Aprilioy
//Ektos ean to Pasxa peftei meta tis 23 Aprilioy, opote i giorti metatithetai 2 meres meta to Pasxa
$april_ts = mktime(12, 0, 0, 4, 25, date('Y'));
$markos_date = ($pasha_ts > $april_ts) ? date('j/n', $pasha_ts + 172800) : date('j/n', $april_ts);

if ($today == $chloe_date) {
        $extra = $chloe . ", ";
    }
elseif ($today == $george_date) {
        $extra = $george . ", ";
       }   
elseif ($today == $markos_date) {
        $extra = $markos . ", ";
       }   
elseif ($today == $propatoron_date) {
        $extra = $propatoron . ", ";
       }
else {
		 $extra = "";
		 }
		 
//Eyresi simerinon eorton
$namedays_now = $namedays["$day" . "/" . "$month"];
$namedays_special = $p_namedays . $extra;
$namedays_today = $namedays_special . $namedays_now;
if ($namedays_today != "") {
$all_namedays_today = $namedays_today;
}
else {
$all_namedays_today = 'Δεν υπάρχει σήμερα κάποια γνωστή γιορτή';
}
		 
//Ensomatosi olon ton eorton sto array $namedays

//Ensomatosi Xlois
$namedays[$chloe_date] = isset($namedays[$chloe_date]) ? $namedays[$chloe_date].', Χλόη' : 'Χλόη';

//Ensomatosi Giorgoy
$namedays[$george_date] = isset($namedays[$george_date]) ? $namedays[$george_date].', Γεώργιος, Γεωργία' : 'Γεώργιος, Γεωργία';

//Ensomatosi Markoy
$namedays[$markos_date] = isset($namedays[$markos_date]) ? $namedays[$markos_date].', Μάρκος' : 'Μάρκος';

//Ensomatosi Kyriakis ton Propatoron
$namedays[$propatoron_date] = isset($namedays[$propatoron_date]) ? $namedays[$propatoron_date].', Κυριακή των Προπατόρων (Ααρών, Αβραάμ, Αδάμ, Αδαμάντιος, Διαμαντής, Αδαμαντία, Δαβίδ, Δανάη, Δανιήλ, Δεβόρα, Εσθήρ, Έυα, Ισαάκ, Ιώβ, Νώε, Ραχήλ, Ρεβέκκα, Ρουμπίνη, Σάρα)' : 'Κυριακή των Προπατόρων (Ααρών, Αβραάμ, Αδάμ, Αδαμάντιος, Διαμαντής, Αδαμαντία, Δαβίδ, Δανάη, Δανιήλ, Δεβόρα, Εσθήρ, Έυα, Ισαάκ, Ιώβ, Νώε, Ραχήλ, Ρεβέκκα, Ρουμπίνη, Σάρα)';

//Ensomatosi eorton Pasxa kai syndedemenon me ayto
foreach ($namedays_pasha as $key => $val) {
	//ypologismos hmerominias
	$d = date('j/n', mktime(12, 0, 0, $month_easter, $day_easter + intval($key), date('Y')));
	//ensomatosi sto array $namedays
	$namedays[$d] = isset($namedays[$d]) ? $namedays[$d].', '.$val : $val;
}

//Taxinomisi eorton
function sortnamedays($a, $b) {
    $p = split('/',$a);
    $a = (int)$p[1].sprintf("%02.0f", $p[0]);
    $p2 = split('/',$b);
    $b = (int)$p2[1].sprintf("%02.0f", $p2[0]);
    if ($a == $b) { return 0; }
    return ($a < $b) ? -1 : 1;
}

uksort($namedays, 'sortnamedays');

//print_r($namedays);

//Eyresi epomenon eorton
function nextnamedays($namedays) {
	$c = intval(date('d')).'/'.intval(date('m'));
	if (!isset($namedays[$c])) {
		list($day, $month) = split('/', $c, 2);
		for ($i=$month; $i<13; $i++) {
			$s = ($i == $month) ? $day : 1;
			for ($z=$s; $z<32; $z++) {
				if (isset($namedays[$z.'/'.$i])) {
					return array($z.'/'.$i, $namedays[$z.'/'.$i]);
				}
			}
		}
	} else {
		foreach ($namedays as $k => $v) {
			if (!isset($g)) { $g = next($namedays); }
			if ($k == $c) {
				$hm = key($namedays);
				if ($hm) {
					return array($hm, $g);
				} else {
					break;	
				}
			}
			$g = next($namedays);
		}
	}
	reset($namedays);
	$g = current($namedays);
	$hm = key($namedays);
	return array($hm, $g);
}
$next = nextnamedays($namedays);

?>

<script type="text/javascript">
/* <![CDATA[ */
var header = document.getElementsByTagName("head")[0];
var csslink = document.createElement("link");
csslink.setAttribute("rel", "stylesheet");
csslink.setAttribute("type", "text/css");
csslink.setAttribute("href", "<?php echo $greek_calendar_url; ?>/css/greek_calendar.css");
csslink.setAttribute("media", "all");
header.appendChild(csslink);
/* ]]> */
</script>
 
  <div style="margin: 0 3px; padding-bottom: 3px; color: #FFF;">
  <?php if ($grcal_bg == '1') { ?>
  <div style="background: url(<?php echo $greek_calendar_url; ?>/images/grcal_<?php echo $grcal_styleimage; ?>.gif) top left repeat-x; padding: 40px 0 0 0;">
  </div>
  <?php } ?>
  <div style="background-color: #<?php echo $params->get('grcal_stylecolor','BlueBell') ?>;">
  <?php if ($grcal_date == '1') { ?>
  <div id="grcal_date">
	<div id="grcal_week"><?php echo $DAYGEN[$day_of_the_week]; ?></div>
	<div id="grcal_day"><?php echo $day; ?></div>
	<div id="grcal_month"><?php echo $MONTHGEN[$month-1]; ?></div>
	<div id="grcal_year"><?php echo $year; ?></div>
	</div>
	<?php } ?>
	<?php if ($grcal_display_location == '1') { ?>
	<div id="grcal_location"><?php echo $grcal_location; ?></div>
	<?php } ?>
	<?php if ($grcal_sun_moon == '1') { ?>
  <div id="grcal_sun_moon"> 
	<div id="grcal_sun">
	<div id="grcal_sunrise"><?php echo $RISEPRE . "&nbsp;" . $sunrise ?></div>
	<div id="grcal_sunset"><?php echo $SETPRE . "&nbsp;" . $sunset ?></div>
	</div>
	<div id="grcal_moon"><?php echo $moon_text ?></div>
	<div class="clear"></div>
	</div>
	<?php } ?>
	<?php if ($grcal_worlddays == '1') { ?>
	<div id="grcal_worlddays"><?php if ($worlddays_now != "" || $extra_worlddays != "") echo $worlddays_now . "<br />" . $extra_worlddays; ?></div>
	<?php } ?>
  <div id="grcal_namedays_label"><?php echo $simera_giortazoun; ?></div>
	<div id="grcal_namedays"><?php echo $all_namedays_today; ?></div>
	<?php if ($grcal_display_nextnamedays == '1') { ?>
	<div id="grcal_allnextnamedays">
	<div id="grcal_nextnamedays_label"><?php echo $akolouthei; ?></div>
	<div id="grcal_nextnamedays"><?php echo $next[0] . "<br />" . $next[1]; ?></div>
	</div>
	<?php } ?>
	</div>
	</div>


