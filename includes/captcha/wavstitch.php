<?php 
/**
* $Id: wavstitch.php 2558 2009-10-07 17:25:24Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Forms protection
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @note: Modified for Elxis by Ioannis Sannos (aka DataHell) on 04.10.2006
*/


$ChunkID_ = array(0x52, 0x49, 0x46, 0x46);       //"RIFF" big endian
$FileFormat_ = array(0x57, 0x41, 0x56, 0x45);    //"WAVE" big endian
$Subchunk1ID_ = array(0x66, 0x6D, 0x74, 0x20);   //"fmt" big endian
$AudioFormat_ = array(0x1, 0x0);                 //PCM = 1 little endian
$Stereo_ = array(0x1, 0x0);                      //Stereo = 2 little endian -->turned to 1, inital was: 0x2
$Mono_ = array(0x1, 0x0);                        //Mono = 1 little endian
$SampleRate_ = array(0x40, 0x1F, 0x0, 0x0);      //44100 little endian -->turned to 8000, initial was: (0x44, 0xAC, 0x0, 0x0);
$BitsPerSample_ = array(0x8, 0x0);              //16 little endian --> turned to 8, initial was: 0x10, 0x0
$Subchunk2ID_ = array(0x64, 0x61, 0x74, 0x61);   //"data" big endian

$files = array();
if(isset($_GET['ses'])) {
    $ses = base64_decode($_GET['ses']);
    $elxis_root = str_replace( '/includes/captcha', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
	if (file_exists($elxis_root.'/configuration.php')) {
		include($elxis_root.'/configuration.php');
		$ses = preg_replace('/'.$mosConfig_secret.'/', '', $ses);
	}
    $ses = preg_replace('/'.date('Ymd').'/', '', $ses);
    $Chars = preg_split('//', $ses, -1, PREG_SPLIT_NO_EMPTY);

    if (count($Chars) >0) {
        foreach($Chars as $Char) {
            if (!preg_match("/^[a-z]+$/i", $Char)) {
                return;
            }
            $files[] = $elxis_root.'/includes/captcha/sound/'.strtolower($Char).'.wav';
        }
    } else { return; }
} else { return; }

$Stitcher = new CStitcher();
$file = new FILESTRUCT();
$Stitcher->StitchFiles($file, $files);

header('Content-type: audio/wav', true);
header('Content-Disposition: attachment;filename=elxisstitch.wav');

foreach($file->ChunkID as $val) {
    print chr($val);
} 
foreach($file->ChunkSize as $val) {
    print chr($val);
} 
foreach($file->Format as $val) {
    print chr($val);
} 
foreach($file->Subchunk1ID as $val) {
    print chr($val);
} 
foreach($file->Subchunk1Size as $val) {
    print chr($val);
} 
foreach($file->AudioFormat as $val) {
    print chr($val);
} 
foreach($file->NumChannels as $val) {
    print chr($val);
} 
foreach($file->SampleRate as $val) {
    print chr($val);
} 
foreach($file->ByteRate as $val) {
    print chr($val);
} 
foreach($file->BlockAlign as $val) {
    print chr($val);
} 
foreach($file->BitsPerSample as $val) {
    print chr($val);
} 
foreach($file->Subchunk2ID as $val) {
    print chr($val);
} 
foreach($file->Subchunk2Size as $val) {
    print chr($val);
} 
foreach($file->Data as $val) {
    print chr($val);
} 

class FILESTRUCT {
    public $ChunkID;
    public $ChunkSize;
    public $Format;
    public $Subchunk1ID;
    public $Subchunk1Size;
    public $AudioFormat;
    public $NumChannels;
    public $SampleRate;
    public $ByteRate;
    public $BlockAlign;
    public $BitsPerSample;
    public $Subchunk2ID;
    public $Subchunk2Size;
    public $Data;

    function FILESTRUCT() {
        $this->ChunkID = array(0x0, 0x0, 0x0, 0x0);      //4
        $this->ChunkSize = array(0x0, 0x0, 0x0, 0x0);    //4
        $this->Format = array(0x0, 0x0, 0x0, 0x0);       //4
        $this->Subchunk1ID = array(0x0, 0x0, 0x0, 0x0);  //4
        $this->Subchunk1Size = array(0x0, 0x0, 0x0, 0x0);//4
        $this->AudioFormat = array(0x0, 0x0);            //2
        $this->NumChannels = array(0x0, 0x0);            //2
        $this->SampleRate = array(0x0, 0x0, 0x0, 0x0);   //4
        $this->ByteRate = array(0x0, 0x0, 0x0, 0x0);     //4
        $this->BlockAlign = array(0x0, 0x0);             //2
        $this->BitsPerSample = array(0x0, 0x0);          //2
        $this->Subchunk2ID = array(0x0, 0x0, 0x0, 0x0);  //4
        $this->Subchunk2Size = array(0x0, 0x0, 0x0, 0x0);//4
        $this->Data = array();
    }
}

class CStitcher {

    function StitchFiles(&$fsFile, &$sFiles) {

        $fsFiles = array(); //() As FILESTRUCT
        $lFileSize = 0;
	$lOffset = 0;
        $bData = array(); //() As Byte
        
        for ($i = 0; $i < count($sFiles); $i++) {
            $fsFiles[$i] = new FILESTRUCT();
            SetFile($fsFiles[$i], $sFiles[$i]);
            $lSize = CalcLittleEndianValue($fsFiles[$i]->Subchunk2Size);
            $lFileSize = $lFileSize + $lSize;
            $bData = array_merge($bData, $fsFiles[$i]->Data);
            $lOffset = $lOffset + $lSize;
        }
        $fsFile->ChunkID = $GLOBALS["ChunkID_"];
        $fsFile->ChunkSize = GetLittleEndianByteArray(36 + $lFileSize);
        $fsFile->Format = $GLOBALS["FileFormat_"];
        $fsFile->Subchunk1ID = $GLOBALS["Subchunk1ID_"];
        $fsFile->Subchunk1Size = array(0x10, 0x0, 0x0, 0x0);
        $fsFile->AudioFormat = $GLOBALS["AudioFormat_"];
        $fsFile->NumChannels = $GLOBALS["Stereo_"];
        $fsFile->SampleRate = $GLOBALS["SampleRate_"];
        $fsFile->ByteRate = GetLittleEndianByteArray(
                                            CalcLittleEndianValue($GLOBALS["SampleRate_"]) *
                                            CalcLittleEndianValue($GLOBALS["Stereo_"]) *
                                            (CalcLittleEndianValue($GLOBALS["BitsPerSample_"]) / 8));
        $fsFile->BlockAlign = array_splice(GetLittleEndianByteArray(CalcLittleEndianValue($GLOBALS["Stereo_"]) *
                                                                    (CalcLittleEndianValue($GLOBALS["BitsPerSample_"]) / 8)), 0, 2);
        $fsFile->BitsPerSample = $GLOBALS["BitsPerSample_"];
        $fsFile->Subchunk2ID = $GLOBALS["Subchunk2ID_"];
        $fsFile->Subchunk2Size = GetLittleEndianByteArray($lFileSize);
	$fsFile->Data = $bData;
    }
}

function SetFile(&$fsFile_, $sFileName) {
    $lSize = 1;
    if (file_exists($sFileName)) {
        $fil = fopen($sFileName, "rb");
        $contents = fread($fil, count($fsFile_->ChunkID));
	$fsFile_->ChunkID = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->ChunkSize));
	$fsFile_->ChunkSize = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->Format));
	$fsFile_->Format = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->Subchunk1ID));
	$fsFile_->Subchunk1ID = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->Subchunk1Size));
	$fsFile_->Subchunk1Size = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->AudioFormat));
	$fsFile_->AudioFormat = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->NumChannels));
	$fsFile_->NumChannels = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->SampleRate));
	$fsFile_->SampleRate = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->ByteRate));
	$fsFile_->ByteRate = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->BlockAlign));
	$fsFile_->BlockAlign = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->BitsPerSample));
	$fsFile_->BitsPerSample = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->Subchunk2ID));
	$fsFile_->Subchunk2ID = bin_split($contents, 1);
        $contents = fread($fil, count($fsFile_->Subchunk2Size));
	$fsFile_->Subchunk2Size = bin_split($contents, 1);
        $lSize = CalcLittleEndianValue($fsFile_->Subchunk2Size);
	$contents = fread($fil, $lSize);
	$fsFile_->Data = bin_split($contents, 1);
        fclose($fil);
    }
}

function CalcLittleEndianValue(&$bValue) {
    $lSize_ = 0;
    for ($iByte = 0; $iByte < count($bValue); $iByte++) {
        $lSize_ += ($bValue[$iByte] * pow(16, ($iByte * 2)));
    }
    return $lSize_;
}

function GetLittleEndianByteArray($lValue) {
    $running = 0;
    $b = array(0, 0, 0, 0);
    $running = $lValue / pow(16,6);
    $b[3] = floor($running);
    $running -= $b[3];
    $running *= 256;
    $b[2] = floor($running);
    $running -= $b[2];
    $running *= 256;
    $b[1] = floor($running);
    $running -= $b[1];
    $running *= 256;
    $b[0] = round($running);
    return $b;
}


function bin_split($text, $c) {
 $arr = array();
 $len = strlen($text);
 $a = 0;
 while($a < $len)
 {
  if ($a + $c > $len)
  {
   $c = $len - $a;
  }
  $arr[$a] = ord(substr($text, $a, $c));
  $a += $c;
 }
 return $arr;
}

?>