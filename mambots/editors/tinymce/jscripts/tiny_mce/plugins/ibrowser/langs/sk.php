<?php
	// ================================================
	// PHP image browser - iBrowser 
	// ================================================
	// iBrowser - language file: Czech
	// Translated by Tomas Vaverka (Pche)
	// ================================================
	// Developed: net4visions.com
	// Copyright: net4visions.com
	// License: GPL - see license.txt
	// (c)2005 All rights reserved.
	// ================================================
	// Revision: 1.1                   Date: 17/02/2006
	// ================================================
	
	//-------------------------------------------------------------------------
	// charset to be used in dialogs
	// pouzita znakova sada
	$lang_charset = 'utf-8';
	// text direction for the current language to be used in dialogs
	// smer textu v danem jazyce
	$lang_direction = 'ltr';
	//-------------------------------------------------------------------------
	
	// language text data array
	// first dimension - block, second - exact phrase
	//-------------------------------------------------------------------------
	// iBrowser
	$lang_data = array (  
		'ibrowser' => array (
		//-------------------------------------------------------------------------
		// common - im
		'im_001' => 'Image browser',
		'im_002' => 'iBrowser',
		'im_003' => 'Menu',
		'im_004' => 'Vitajte',
		'im_005' => 'Vloit',
		'im_006' => 'Storno',
		'im_007' => 'Vloi',		
		'im_008' => 'Vloit/Zmeni',
		'im_009' => 'Vlastnosti',
		'im_010' => 'Vlastnosti obrαzku',
		'im_013' => 'Vyskakovacie oknα',
		'im_014' => 'Obrαzok vo vyskakovacom okne;',
		'im_015' => 'O programe',
		'im_016' => 'Sekcie',
		'im_097' => 'ChviΎku strpenia, nahrαvam...',
		'im_098' =>	'Otvori sekciu',
		'im_099' => 'Zatvori sekciu',
		//-------------------------------------------------------------------------
		// insert/change screen - in	
		'in_001' => 'Vloi/Zmeni obrαzok',
		'in_002' => 'Kninica',
		'in_003' => 'Vyberte kninicu obrαzkov',
		'in_004' => 'Obrαzky',
		'in_005' => 'NαhΎad',
		'in_006' => 'Zmaza obrαzok',
		'in_007' => 'Kliknite pre zvδθenie obrαzku',
		'in_008' => 'Otvori upload obrαzku, premenovanie, alebo zmazanie sekcie',	
		'in_009' => 'Informαcie',
		'in_010' => 'Vyskakovacie okno',		
		'in_013' => 'Vytvorenie odkazu na obrαzok otvαranύ v novom okne.',
		'in_014' => 'Odstrani odkaz na vyskakovacie okno',	
		'in_015' => 'Sϊbor',	
		'in_016' => 'Premenova',
		'in_017' => 'Premenova obrαzok',
		'in_018' => 'Upload',
		'in_019' => 'Uploadova obrαzok',	
		'in_020' => 'VeΎkos(i)',
		'in_021' => 'Zakrtnite poadovanι veΎkosti pre upload obrαzkov',
		'in_022' => 'Originαl',
		'in_023' => 'Obrαzok bude orezanύ',
		'in_024' => 'Zmaza',
		'in_025' => 'Adresαr',
		'in_026' => 'Kliknite pre vytvorenie adresαra',
		'in_027' => 'Vytvori adresαr',
		'in_028' => 'νrka',
		'in_029' => 'Vύka',
		'in_030' => 'Typ',
		'in_031' => 'VeΎkos',
		'in_032' => 'Meno',
		'in_033' => 'Vytvorenι',
		'in_034' => 'Zmenenι',
		'in_035' => 'Informαcie o obrαzku',
		'in_036' => 'Kliknite na obrαzok pre zazatvorenie okna',
		'in_037' => 'Otoθit',
		'in_038' => 'Automatickι otoθenie: nastavi na EXIF informαcie, pre pouitie EXIF orientαcie uloenι fotoaparαtom. Mτe by tie nastavenι na +180&deg; alebo -180&deg; pre obrαzok na νrku, alebo +90&deg; alebo -90&deg; pre obrαzok na vύku. Kladnι hodnoty pre posun v smere hodinovύch ruθiθiek, zαpornι proti smeru.',
		'in_041' => '',
		'in_042' => 'iadny',		
		'in_043' => 'na vύku',
		'in_044' => '+ 90&deg;',	
		'in_045' => '- 90&deg;',
		'in_046' => 'na νrku',	
		'in_047' => '+ 180&deg;',	
		'in_048' => '- 180&deg;',
		'in_049' => 'fotoaparαt',	
		'in_050' => 'exif informαcie',
		'in_051' => 'POZOR: Tento obrαzok je dynamickύ nαhΎad vytvorenύ iManagerom - parametre budϊ stratenι pri zmmene obrαzku.',
		'in_052' => 'Kliknite pre zmenu nαhΎadu vybranιho obrαzka',
		'in_053' => 'Nαhodnύ',
		'in_054' => 'Ak je zakrtnutι, bude vybrnύ nαhodnύ obrαzok',
		'in_055' => 'Zakrtnite pre vloenie nαhodnιho obrαzku',
		'in_056' => 'Parametre',
		'in_057' => 'Kliknite pre nastavenie vύchodzνch parametrov',
		'in_099' => 'vύchodzie',	
		//-------------------------------------------------------------------------
		// properties, attributes - at
		'at_001' => 'Vlastnosti obrαzku',
		'at_002' => 'Zdroj',
		'at_003' => 'Titulok',
		'at_004' => 'TITLE - titulok obrαzku, zobrazν sa po prejdenν myou nad obrαzok',
		'at_005' => 'Popis',
		'at_006' => 'ALT -  alternatνvny text obrαzku, zobrazν sa pri nenaθνtanν obrαzku',
		'at_007' => 'tύl',
		'at_008' => 'Uistite sa, e zadanύ tύl existuje vo vaej definνcii tύlov.',
		'at_009' => 'CSS-tύl',	
		'at_010' => 'Atribuϊy',
		'at_011' => 'Atribuϊy \'umiestnenie\', \'okraj\', \'horiz_medzera\' a \'vert_medzera\' elementu IMAGE niesϊ podporovanι v XHTML 1.0 Strict DTD. Pouite namiesto toho CSS tύly.',
		'at_012' => 'Zarovnanie',	
		'at_013' => 'vύchodzie',
		'at_014' => 'vΎavo',
		'at_015' => 'vpravo',
		'at_016' => 'nahor',
		'at_017' => 'doprostred',
		'at_018' => 'dole',
		'at_019' => 'stred obrαzku zarovnanύ so stredom textu',
		'at_020' => 'vrch obrαzku zarovnanύ s vrchom textu',
		'at_021' => 'na θiaru',		
		'at_022' => 'veΎkos',
		'at_023' => 'νrka',
		'at_024' => 'Vύka',
		'at_025' => 'Rαmθek',
		'at_026' => 'V-odsadenie',
		'at_027' => 'H-odsadenie',
		'at_028' => 'NαhΎad',	
		'at_029' => 'Kliknite pre vloenie peciαlnych znakov do poΎa titulku',
		'at_030' => 'Kliknite pre vloenie peciαlnych znakov do poΎa popisu',
		'at_031' => 'Nastavi vύchodzie rozmery obrαzku',
		'at_032' => 'Zαhlavie',
		'at_033' => 'zakrtnutι: nastavi zαhlavie obrαzku / nezakrtnutι: bez zαhlavia alebo zruenie zαhlavia',
		'at_034' => 'nastavi zαhlavie obrαzku',
		'at_099' => 'vύchodzie',	
		//-------------------------------------------------------------------------		
		// error messages - er
		'er_001' => 'Chyba',
		'er_002' => 'Nie je vybranύ obrαzok!',
		'er_003' => 'νrka nie je θνslo',
		'er_004' => 'Vύka nie je θνslo',
		'er_005' => 'Rαmθek nie je θνslo',
		'er_006' => 'Horizontαlne odsadenie nie je θνslo',
		'er_007' => 'Vertikαlne odsadenie nie je θνslo',
		'er_008' => 'Kliknite na OK pre zmazanie obrαzku',
		'er_009' => 'Premenovanie nαhΎadu nie je dovolenι! Premenujte obrαzok, ak chcete premenovat jeho nαhΎad.',
		'er_010' => 'Kliknite na OK pre premenovanie obrαzku na',
		'er_011' => 'Novι meno je prαzdne, alebo nebolo zmenenι!',
		'er_014' => 'Zadajte novι meno sϊboru!',
		'er_015' => 'Zadajte validnν meno sϊboru!',
		'er_016' => 'NαhΎad nie je k dispozνcii! Pre zapnutie nαhΎadov nastavte veΎkost nαhΎadov v konfiguraθnom sϊbore.',
		'er_021' => 'Kliknite na OK pre upload obrαzku.',
		'er_022' => 'Upload obrαzku - prosνm vydrte...',
		'er_023' => 'Nebol vybranύ iadnz obrαzok, alebo nebol oznaθenύ iadnz sϊbor.',
		'er_024' => 'sϊbor',
		'er_025' => 'u existuje! Kliknite na OK pre prepνsanie...',
		'er_026' => 'zadajte novι meno sϊboru!',
		'er_027' => 'Adresαr fyzicky neexistuje',
		'er_028' => 'Dolo k chybe pri obsluhe uploadu sϊboru. Skϊste to prosνm znovu.',
		'er_029' => 'Naplatnύ typ obrazovιho sϊboru',
		'er_030' => 'Mazanie zlyhalo! Skϊste to prosνm znovu.',
		'er_031' => 'Prepνsa',
		'er_032' => 'NαhΎad skutoθnej veΎkosti funguje len pre obrαzky vδθνch rozmerov ako okno nαhΎadu',
		'er_033' => 'Premenovanie sϊboru zlyhalo! Skϊste to prosνm znovu.',
		'er_034' => 'Vytvorenν adresαre zlyhalo! Skϊste to prosνm znovu.',
		'er_035' => 'Zvδθenie nie je podporovanι!',
		'er_036' => 'Chyba pri vytvαranν zoznamu obrαzkov!',
	  ),	  
	  //-------------------------------------------------------------------------
	  // symbols
		'symbols'		=> array (
		'title' 		=> 'Symboly',
		'ok' 			=> 'OK',
		'cancel' 		=> 'Storno',
	  ),	  
	)
?>
