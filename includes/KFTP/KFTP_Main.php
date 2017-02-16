<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// --------------------------------------------------------------------------------------
// KFTP : the KioobFTP Class
// author : Olivier BONVALET / bool@boolsite.net
// --------------------------------------------------------------------------------------
// KFTP is the main class of KioobFTP. Based on the KFTP_Basic, it give
// high-level functions as automatic ASCII/BINARY transfert, recursive transfert,
// overwriting rules, rawlist parsing, directory caching, etc.
//
// It should have the same functions with all implementations of KFTP_Basic.
// --------------------------------------------------------------------------------------

if(!function_exists('file_get_contents')){
    function & file_get_contents($filename){
        if($fp=fopen($filename,'rb')){
            $buffer='';
            while(!feof($fp))
                $buffer.=fread($fp,4096);
            fclose($fp);
            return $buffer;
            }
          else return false;
        }
    }

if(!function_exists('file_put_contents')){
    function file_put_contents($filename,$data){
        if($fp=fopen($filename,'wb')){
            $ok=fwrite($fp,$data);
            fclose($fp);
            return $ok;
            }
          else return false;
        }
    }

class KFTP extends KFTP_Basic {

    public $verbose=false;

    public $default_onerror_rule=KFTP_OnError_Default;                             // Initialize default onerror rule.
    public $default_overwrite_rule=KFTP_OR_Default;                                // Initialize default overwrite rule.

    public $time_offset=0;                                                         // Time offset for "date_parser"

    public $_cnxid=false;                                                          // connexion ident (for cache).

    public $_cachedir_last_content=false;                                          // content of the last dir in cache.
    public $_cachedir_last_path=false;                                             // path of the last dir in cache.

    public $_parser_model=false;                                                   // modele utilisé pour le parser.

    public $_idle=false;                                                           // last ftp command time.

    // constructor
    function __construct($host=NULL, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousLogin, $ssl=false, $verbose=KFTP_Verbose){
        // set verbose mode
        $this->verbose=KFTP_Verbose;

        // display versions informations
        $this->send_msg('Starting KFTP v'.KFTP_Version
            .' ('.$GLOBALS['KFTP_Conf']['implementation'].' implementation)'
            .' under PHP v'.phpversion());

        parent::__construct($host,$port,$login,$pass,$ssl);
        }

    // constructor, for PHP 4 only
    function KFTP($host=NULL, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousLogin, $ssl=false, $verbose=KFTP_Verbose){
        $this->__construct($host,$port,$login,$pass,$ssl,$verbose);
        }

    // destructor
    function __destruct(){
        $this->close();
        parent::__destruct();
        }

// ----- connection -----

    // connection_settings -- set actual connection settings
    function connection_settings($host, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousPass, $ssl=false){
        parent::connection_settings($host,$port,$login,$pass,$ssl);

        $this->_cnxid=false;
        $this->_parser_model=false;

        $this->send_msg('Initialized to '.$this->host.':'.$this->port);

        // if already connected, reinitialize the connection
        if($this->connected)
            $this->rein();
        }

    // identify -- change connection login and pass
    function identify($login,$pass){
        $this->login=$login;
        $this->pass=$pass;

        $this->_cnxid=false;
        $this->_parser_model=false;

        // if already connected, reinitialize the connection
        if($this->connected)
            $this->rein();
        }

    // connect -- Opens an FTP connection
    function connect($retry=KFTP_ConnectionRetry){
        $this->send_msg('Connection...');

        return parent::connect($retry);
        }

    // close -- Closes an FTP connection
    function close(){
        if($this->connected)
            $this->send_msg('Disconnect');

        $result=parent::close();

        $this->cache_clean();

        return $result;
        }

    // rein -- ReInit an FTP connection
    function rein(){
        $this->send_msg('Reinitialize connection');

        return parent::rein();
        }

    // pasv -- Turns passive mode on or off
    function pasv($mode=false){
        $pasv=array(false=>'Off',true=>'On');
        $this->send_msg('PASV '.$pasv[(bool)$mode]);

        return parent::pasv($mode);
        }


// ----- Directories -----

    // fullpath -- this function build the server full path from relative path
    // it is important for directory caching
    function fullpath($path){
        $len=strlen($path);
        if($len===0 or $path==='.')
            return $this->pwd();

        if($path{0}!=='/' and ($len===1 or $path{1}!==':'))
            $path=$this->pwd().'/'.$path;

        $tmp=explode('/',$path);

        $out=array();
        $max=count($tmp)-1;
        foreach($tmp as $i => $val){
            if($val===''){
                if($i===0 or $i===$max)
                    array_push($out,$val);
                }
            elseif($val==='..')
                @array_pop($out);
            elseif($val!=='.')
                array_push($out,$val);
            }
        $path=implode('/',$out);

        if($path==='')
            return '/';

        return $path;
        }


    // pwd -- Returns the current directory name
    function pwd(){
        if(!$this->connected) {
            $this->trigger_error('pwd','not connected !',__FILE__,__LINE__);
            return false;
            }
        return parent::pwd();
        }

    // chdir -- Changes directories on a FTP server
    function chdir($path){
        if(!$this->connected) {
            $this->trigger_error('chdir','not connected !',__FILE__,__LINE__);
            return false;
            }
        $this->idle_breaked();
        return parent::chdir($path);
        }

    // cdup -- Changes to the parent directory
    function cdup(){
        if(!$this->connected) {
            $this->trigger_error('cdup','not connected !',__FILE__,__LINE__);
            return false;
            }
        $this->idle_breaked();
        return parent::cdup();
        }

    // mkdir -- Creates a directory
    function mkdir($path){
        if(!$this->connected) {
            $this->trigger_error('mkdir','not connected !',__FILE__,__LINE__);
            return false;
            }

        $result=parent::mkdir($path);

        $this->predict_file_info($path,array('is_dir'=>true));

        $this->idle_breaked();
        return $result;
        }

    // rmdir -- Removes a directory
    function rmdir($path){
        if(!$this->connected) {
            $this->trigger_error('rmdir','not connected !',__FILE__,__LINE__);
            return false;
            }

        $result=parent::rmdir($path);

        $this->cache_del($path);
        $this->predict_file_info($path,false);

        $this->idle_breaked();
        return $result;
        }

// ----- Rawlist parsing -----

    // set_time_offset -- fix time offset for date_parser()
    function set_time_offset($seconds){
        $this->time_offset=$seconds;
        return true;
        }

    // date_parser -- try to convert a rawlist date to a timestamp

    // thanks to : D.J. Bernstein, djb@cr.yp.to (http://cr.yp.to/ftpparse.html)
    // and Tim Kosse <tim.kosse@gmx.de> (http://sourceforge.net/projects/filezilla)
    // for their code to made this function.
    function date_parser($string_date){

        // short conversion table for months
        static $months=array(
            'jan' => 1,'feb' => 2,'mar' => 3,'apr' => 4,'may' => 5,'jun' => 6, // Noms anglais
            'jul' => 7,'aug' => 8,'sep' => 9,'oct' =>10,'nov' =>11,'dec' =>12
            ,
            'janv'=> 1,'fév' => 2,'fev' => 2,'févr'=> 2,'fevr'=> 2,'mars'=> 3, // Ajouts français
            'avr' => 4,'mai' => 5,'juin'=> 6,'juil'=> 7,'aoû' => 8,'aou' => 8,
            'août'=> 8,'aout'=> 8,'sept'=> 9,'déc' =>12
            ,
            '01'  => 1,'1'   => 1,'02'  => 2,'2'   => 2,'03'  => 3,'3'   => 3, // Ajouts numeric
            '04'  => 4,'4'   => 4,'05'  => 5,'5'   => 5,'06'  => 6,'6'   => 6,
            '07'  => 7,'7'   => 7,'08'  => 8,'8'   => 8,'09'  => 9,'9'   => 9,
            '10'  =>10,'11'  =>11,'12'  =>12
            ,
            'mrz' => 3,'mär' => 3,'okt' => 5,'okt' =>10,'dez' =>12             // Ajouts allemand
            ,
            'gen' => 1,'mag' => 5,'giu' => 6,'lug' => 7,'ago' => 8,'set' => 9, // Ajouts italiens
            'ott' =>10,'dic' =>12
            ,
            'ene' => 1,'abr' => 4                                              // Ajouts espagnols
            ,
            'sty' => 1,'lut' => 2,'kwi' => 4,'maj' => 5,'cze' => 6,'lip' => 7, // Ajouts "Polish"
            'sie' => 8,'wrz' => 9,'paŸ' =>10,'lis' =>11,'gru' =>12
            ,
            'ÿíâ' => 1,'ÿíâ' => 2,'ìàð' => 3,'àïð' => 4,'ìàé' => 5,'èþí' => 6, // Ajouts russes
            'èþë' => 7,'àâã' => 8,'ñåí' => 9,'îêò' =>10,'íîÿ' =>11,'äåê' =>12
            ,
            'mrt' => 3,'mei' => 5                                              // Ajouts "Netherlandish"
            );

        // default return (on error)
        $return=array(
            'time'=>0,
            'time_precision'=>KFTP_TimPrec_NotFound,
            );

        // split cols
        $date=preg_split('`[ .,\\-/]+`',$string_date);

        // check column number : we should have 3 or 4 cols
        $nb=count($date);
        if($nb<3 or $nb>4)
            return $return;

        $hour=false;
        $minute=false;
        $day=false;
        $month=false;
        $year=false;

        // check all cols, for evidence match
        $year_idx=false;
        foreach($date as $idx => $col){
            // Numeric = year, month or day
            if(is_numeric($col)){
                if($col > 31){
                    $year_idx=$idx;
                    $year=$col;
                    unset($date[$idx]);
                    continue;
                    }
                if($col>12){
                    $day=$col;
                    unset($date[$idx]);
                    continue;
                    }
                }
            // Not numeric = hour or month
            else {
                if(preg_match('`^([0-9]{1,2}):([0-9]{2})(:[0-9]{2})?(AM|PM)?$`',$col,$match)){
                    $hour=$match[1];
                    $minute=$match[2];
                    if(isset($match[4]) and $match[4]==='PM')
                        $hour+=12;
                    unset($date[$idx]);
                    continue;
                    }

                $month=strtolower($col);
                unset($date[$idx]);
                }
            }

        // day or month not found ?
        if($day===false or $month===false){
            // both are missing ? problem : can't know in which order they're placed.
            // So we suppose month placed before day, except if format is DD-MM-YYYY
            if($day===false and $month==false and count($date)===2
                and isset($date[0]) and isset($date[1]) and $year_idx===3){

                $day=$date[0];
                $month=$date[1];
                }
            else {
                foreach($date as $idx => $col){
                    if($month===false){
                        $month=$col;
                        continue;
                        }
                    if($day===false){
                        $day=$col;
                        continue;
                        }
                    }
                }

            if($day===false or $month===false)
                return $return;
            }

        // month is not numeric ? try to convert it
        if(!is_numeric($month)){
            // can't have conversion ? exit
            if(!isset($months[$month]))
                return $return;
            $month=$months[$month];
            }

        // if year is not given, try to found it
        if($year===false){
            $actual_month=date('m');
            $actual_year=date('Y');
            if($month>$actual_month)
                $year=$actual_year-1;
            else $year=$actual_year;
            }

        // here, we have all infos
        $time=@mktime($hour, $minute, 0, $month, $day, $year);

        // if invalid time, then exit
        if(!$time) return $return;

        $return['time']=$time;

        if($hour!==false){
            $return['time']+=$this->time_offset;
            $return['time_precision']=KFTP_TimPrec_Hour;
            }
        else $return['time_precision']=KFTP_TimPrec_Day;

        return $return;
        }

    // ftptime -- converts a timestamp to the same with a specific precision
    // (to be able to compare with a result of date_parser/rawlist_parser)
    function ftptime($time,$precision){
        if(!$time) return false;

        // split the date
        $tmp=explode(' ',@date('Y n j G i',$time));

        // if hour was not given then erase it
        if($precision!=KFTP_TimPrec_Hour){
            $tmp[3]=0;
            $tmp[4]=0;
            }

        // return the new timestamp
        return mktime($tmp[3],$tmp[4],0,$tmp[1],$tmp[2],$tmp[0]);
        }


    // rawlist_parser -- try to analyze the return of the rawlist function

    // thanks to : D.J. Bernstein, djb@cr.yp.to (http://cr.yp.to/ftpparse.html)
    // and Tim Kosse <tim.kosse@gmx.de> (http://sourceforge.net/projects/filezilla)
    // for their code to made this function.
    function rawlist_parser($content){
        if(!is_array($content))
            return false;

        $result=array(
            'files'=>array(),
            'size_total'=>0,
            );

        $name=false;
        $dirs=array();
        $files=array();
        foreach($content as $idx=> $line){
            $line=rtrim($line,"\r\n");
            if(!$line) continue;

//            echo '[',$line,"]\n";

            // like UNIX standard, but group not given
            if((!$this->_parser_model or $this->_parser_model===2)
                and preg_match('`^([bcdlps\\-][a-zA-Z\\-]{9}) +([0-9]+) +(\\S{1,8}) +([0-9]+) +(\\S{1,4}[,.]?\\s +\\S{1,4}[,.]? +[0-9:]{4,5}) (.*)`',$line,$match)){
                $this->_parser_model=2;

                $name=$match[6];
                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    'permission'=>$match[1],
                    'sub_dir'=>$match[2],
                    'owner'=>$match[3],
                    'size'=>$match[4],
                    'date'=>$match[5],
                    );
                }
            // the standard UNIX format
            elseif((!$this->_parser_model or $this->_parser_model===1)
                and preg_match('`^([bcdlps\\-][a-zA-Z\\-]{9}) +([0-9]+) +(\\S{1,8}) *(\\S{1,8}) *([0-9]+) +(\\S{1,4}[,.]? +\\S{1,4}[,.]? +[0-9:]{4,5}) (.*)`',$line,$match)){
                $this->_parser_model=1;

                $name=$match[7];
                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    'permission'=>$match[1],
                    'sub_dir'=>$match[2],
                    'owner'=>$match[3],
                    'group'=>$match[4],
                    'size'=>$match[5],
                    'date'=>$match[6],
                    );
                }
            // a Windows format, with user, group and domain given
            elseif((!$this->_parser_model or $this->_parser_model===4)
                and preg_match('`^([bcdlps\\-][a-zA-Z\\-]{9}) +([0-9]+) +(\\S{1,8}) *(\\S{1,8}) *(\\S{1,8}) *([0-9]+) +(\\S{1,4}[,.]? +\\S{1,4}[,.]? +[0-9:]{4,5}) (.*)`',$line,$match)){
                $this->_parser_model=4;

                $name=$match[8];
                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    'permission'=>$match[1],
                    'sub_dir'=>$match[2],
                    'group'=>$match[3],
                    'domain'=>$match[4],
                    'owner'=>$match[5],
                    'size'=>$match[6],
                    'date'=>$match[7],
                    );
                }
            // a DOS format, used by IIS
            elseif((!$this->_parser_model or $this->_parser_model===3)
                and preg_match('`^([0-9]{2,4}-[0-9]{2}-[0-9]{2} +[0-9]{2}:[0-9]{2}[A-Z]+) +(<DIR>|[0-9,]+) +(.*)`',$line,$match)){
                $this->_parser_model=3;

                $name=$match[3];
                $info=array(
                    'is_dir'=>($match[2]==='<DIR>'),
                    'size'=>(int)str_replace(',','',$match[2]),
                    'date'=>$match[1],
                    );
                }
            // like standard UNIX format, but with full date
            elseif((!$this->_parser_model or $this->_parser_model===5)
                and preg_match('`^([bcdlps\\-][a-zA-Z\\-]{9}) +([0-9]+) +(\\S{1,8}) *(\\S{1,8}) *([0-9]+) +([0-9]{2,4}[\\-/][0-9]{2}[\\-/][0-9]{2,4} [0-9]{2}:[0-9]{2}) (.*)`',$line,$match)){
                $this->_parser_model=5;

                $name=$match[7];
                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    'permission'=>$match[1],
                    'sub_dir'=>$match[2],
                    'owner'=>$match[3],
                    'group'=>$match[4],
                    'size'=>$match[5],
                    'date'=>$match[6],
                    );
                }
            // like standard UNIX format, but with short date
            elseif((!$this->_parser_model or $this->_parser_model===6)
                and preg_match('`^([bcdlps\\-][a-zA-Z\\-]{9}) +([0-9]+) +(\\S{1,8}) *(\\S{1,8}) *([0-9]+) +([0-9]{2}-[0-9]{2} [0-9:]{4,5}) (.*)`',$line,$match)){
                $this->_parser_model=6;

                $name=$match[7];
                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    'permission'=>$match[1],
                    'sub_dir'=>$match[2],
                    'owner'=>$match[3],
                    'group'=>$match[4],
                    'size'=>$match[5],
                    'date'=>$match[6],
                    );
                }
            // unknown format, try to extract some info
            elseif(strtolower(substr($line,0,5))!=='total'){
                $name=$line;
                if(preg_match('`\\S+$`',rtrim($line),$match))
                    $name=$match[0];

                $info=array(
                    'is_dir'=>($line{0}==='d'),
                    );
                }

            if($name!==false){
                if(isset($info['size']) and !@$info['is_dir'])
                    $result['size_total']+=$info['size'];

                if(isset($info['date']))
                    $info=array_merge($GLOBALS['KFTP_Conf']['Rawlist_Model'],$info,KFTP::date_parser($info['date']));
                else $info=array_merge($GLOBALS['KFTP_Conf']['Rawlist_Model'],$info);

                if(@$info['is_dir'])
                    $files[$name]=$info;
                else $dirs[$name]=$info;
                }

//            echo '[',implode(' / ',$info),"]\n\n";

            }

        uksort($dirs, 'strnatcasecmp');
        uksort($files, 'strnatcasecmp');
        $result['files']=$files + $dirs;

        $result['parser_model']=$this->_parser_model;

        return $result;
        }

// ----- Recursive directories functions -----

    // downloaddir -- download all the content of a directory
    function downloaddir($source, $dest=false, $mode=FTP_AUTO,
            $overwrite_rule=KFTP_OR_LookSettings, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if(!$this->connected) {
            $this->trigger_error('downloaddir','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the dest is not given, then take current path
        if(!$dest) $dest='.';

        $msg='Download ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') directory '
            .$source.' to '.$dest;

        $this->send_msg($msg);

        if(($list=$this->readdir($source))===false)
            return false;

        foreach($list['files'] as $name => $info){
            if($name==='.' or $name==='..')
                continue;

            $full_source=$source.'/'.$name;
            $full_dest=$dest.'/'.$name;

            if($info['is_dir']){
                if($max_level===0)
                    continue;
                if(!is_dir($full_dest)){
                    if(!@mkdir($full_dest, $GLOBALS['KFTP_Conf']['Dirs_Mode'])){
                        $this->trigger_error('downloaddir',@$php_errormsg,__FILE__,__LINE__);

                        if($on_error===KFTP_ContinueOnError)
                            continue;
                        return false;
                        }
                    }

                $result=$this->downloaddir($full_source, $full_dest, $mode,
                    $overwrite_rule, $on_error, $max_level-1);
                }
            else {
                $result=$this->download($full_source, $full_dest, $mode, $overwrite_rule);
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }
        return true;
        }

    // uploaddir -- upload all the content of a directory
    function uploaddir($source, $dest=false, $mode=FTP_AUTO,
            $overwrite_rule=KFTP_OR_LookSettings, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if(!$this->connected) {
            $this->trigger_error('uploaddir','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the dest is not given, then take current path
        if(!$dest) $dest='.';

        $msg='Upload ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') directory '
            .$source.' to '.$dest;

        $this->send_msg($msg);

        if(!$dir=@opendir($source)){
            $this->trigger_error('uploaddir',@$php_errormsg);
            return false;
            }

        while($name=readdir($dir)){
            if($name==='.' or $name==='..')
                continue;

            $full_source=$source.'/'.$name;
            $full_dest=$dest.'/'.$name;

            if(is_dir($full_source)){
                if($max_level===0)
                    continue;

                if(!$this->is_dir($full_dest))
                    if($this->mkdir($full_dest)===false){
                        if($on_error===KFTP_BreakOnError)
                            return false;
                        continue;
                        }

                $result=$this->uploaddir($full_source, $full_dest, $mode,
                    $overwrite_rule, $on_error, $max_level-1);
                }
            else {
                $result=$this->put($full_dest, $full_source, $mode, $overwrite_rule);
                }

            if($result===false and $on_error===KFTP_BreakOnError){
                closedir($dir);
                return false;
                }
            }
        closedir($dir);

        return true;
        }

    // deltree -- remove a directory and all its content
    function deltree($source, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){
        if(!$this->connected) {
            $this->trigger_error('deltree','not connected !',__FILE__,__LINE__);
            return false;
            }

        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;

        $this->send_msg('Delete directory '.$source);

        if(($list=$this->readdir($source))===false)
            return false;

        foreach($list['files'] as $name => $info){
            if($name==='.' or $name==='..')
                continue;

            $full_source=$source.'/'.$name;

            if($info['is_dir']){
                if($max_level===0)
                    continue;

                $result=$this->deltree($full_source, $on_error, $max_level-1);
                }
            else $result=$this->delete($full_source);

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }
        @$this->rmdir($source);
        return true;
        }

    // deltree_local -- remove a local directory and all its content
    function deltree_local($source, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;

        $this->send_msg('Delete local directory '.$source);

        if(($dir=@opendir($source))===false){
            $this->trigger_error('deltree_local',@$php_errormsg);
            return false;
            }
        while($name=readdir($dir)){
            if($name==='.' or $name==='..')
                continue;
            $full_source=$source.'/'.$name;

            if(is_dir($full_source)){
                if($max_level===0)
                    continue;

                $result=$this->deltree_local($full_source, $on_error, $max_level-1);
                }
            else {
                $result=@unlink($full_source);
                if($result===false)
                    $this->trigger_error('deltree_local',@$php_errormsg);
                }

            if($result===false and $on_error===KFTP_BreakOnError){
                closedir($dir);
                return false;
                }
            }

        closedir($dir);

        @rmdir($source);
        return true;
        }

    // xdownloaddir -- download all the content of a directory of an other
    // server in a directory of the actual server.
    function xdownloaddir(& $KFTP, $source, $dest=false, $mode=FTP_AUTO,
            $overwrite_rule=KFTP_OR_LookSettings, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if(!$this->connected or !$KFTP->connected) {
            $this->trigger_error('xdownloaddir','not connected !',__FILE__,__LINE__);
            return false;
            }

        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the dest is not given, then take current path
        if(!$dest) $dest='.';

        $msg='Download ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') directory '
            .$source.' (cnx '.$KFTP->instance_id.') to '.$dest.' cnx '.$this->instance_id.')';

        $this->send_msg($msg);

        if(($list=$KFTP->readdir($source))===false)
            return false;

        foreach($list['files'] as $name => $info){
            if($name==='.' or $name==='..')
                continue;

            $full_source=$source.'/'.$name;
            $full_dest=$dest.'/'.$name;

            if($info['is_dir']){
                if($max_level===0)
                    continue;

                if(!$this->is_dir($full_dest))
                    if(!$this->mkdir($full_dest)){
                        if($on_error===KFTP_ContinueOnError)
                            continue;
                        return false;
                        }

                $result=$this->xdownloaddir($KFTP, $full_source, $full_dest, $mode,
                    $overwrite_rule, $on_error, $max_level-1);
                }
            else {
                $result=$this->xdownload($KFTP, $full_source, $full_dest, $mode, $overwrite_rule);
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }
        return true;
        }


    // xuploaddir -- download all the content of a directory of an other
    // server in a directory of the actual server.
    function xuploaddir(& $KFTP, $source, $dest=false, $mode=FTP_AUTO,
            $overwrite_rule=KFTP_OR_LookSettings, $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if(!$this->connected or !$KFTP->connected) {
            $this->trigger_error('xdownloaddir','not connected !',__FILE__,__LINE__);
            return false;
            }

        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the dest is not given, then take current path
        if(!$dest) $dest='.';

        $msg='Download ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') directory '
            .$source.' (cnx '.$this->instance_id.') to '.$dest.' cnx '.$KFTP->instance_id.')';

        $this->send_msg($msg);

        if(($list=$this->readdir($source))===false)
            return false;

        foreach($list['files'] as $name => $info){
            if($name==='.' or $name==='..')
                continue;

            $full_source=$source.'/'.$name;
            $full_dest=$dest.'/'.$name;

            if($info['is_dir']){
                if($max_level===0)
                    continue;

                if(!$KFTP->is_dir($full_dest))
                    if(!@$KFTP->mkdir($full_dest)){
                        $this->trigger_error('xuploaddir',$KFTP->last_error());
                        if($on_error===KFTP_ContinueOnError)
                            continue;
                        return false;
                        }

                $result=$this->xuploaddir($KFTP, $full_source, $full_dest, $mode,
                    $overwrite_rule, $on_error, $max_level-1);
                }
            else {
                $result=$this->xupload($KFTP, $full_source, $full_dest, $mode, $overwrite_rule);
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }
        return true;
        }


    // synchronize -- synchronizes a local directory with a distant one.
    function synchronize ($local_dir, $remote_dir, $mode=FTP_AUTO,
            $local_option=KFTP_Synchro_Ignore, $remote_option=KFTP_Synchro_Ignore, $ignore_list=false,
            $on_error=KFTP_OnError_LookSettings, $max_level=KFTP_InfiniteRecurs){

        if(!$this->connected) {
            $this->trigger_error('synchronize','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($on_error===KFTP_OnError_LookSettings)
            $on_error=$this->default_onerror_rule;

        $this->send_msg('Synchronize ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') directory '
            .$local_dir.' with '.$remote_dir);

        // load the remote directory
        if(($list=$this->readdir($remote_dir))===false)
            return false;
        $remote_list=$list['files'];
        unset($remote_list['.']);
        unset($remote_list['..']);
        $remote_files=array_keys($remote_list);

        // load the local directory
        $local_files=array();
        if(!$dir=@opendir($local_dir)){
            $this->trigger_error('synchronize',@$php_errormsg);
            return false;
            }
        while($file=readdir($dir)){
            if($file==='.' or $file==='..')
                continue;
            $local_files[]=$file;
            }
        closedir($dir);


        // build files list
        $common_files=array_intersect($local_files,$remote_files);

        if($local_option===KFTP_Synchro_Ignore)
            $local_files_to_check=array();
        else $local_files_to_check=array_diff($local_files,$remote_files);

        if($remote_option===KFTP_Synchro_Ignore)
            $remote_files_to_check=array();
        else $remote_files_to_check=array_diff($remote_files,$local_files);

        // Non common local files :
        foreach($local_files_to_check as $name){
            $local_fullname=$local_dir.'/'.$name;

            $ignore=false;
            if(is_array($ignore_list))
                foreach($ignore_list as $filter)
                    if(preg_match($filter,$local_fullname)){
                        $ignore=true;
                        break;
                        }
            if($ignore)
                continue;

            // Directory
            if(is_dir($local_fullname)){
                if($max_level===0)
                    continue;
                // Erase
                if($local_option===KFTP_Synchro_Erase)
                    $result=$this->deltree_local($local_fullname,$on_error,$max_level-1);
                // Transfer
                else {
                    $dest=$remote_dir.'/'.$name;
                    if(($result=$this->mkdir($dest))!==false)
                        $result=$this->uploaddir($local_fullname.'/',$dest.'/',$mode,KFTP_OR_Overwrite,$on_error,$max_level-1);
                    }
                }
            // File
            else {
                // Erase
                if($local_option===KFTP_Synchro_Erase){
                    $result=@unlink($local_fullname);
                    if($result===false)
                        $this->trigger_error('synchronize',@$php_errormsg);
                    }
                // Transfer
                else {
                    $dest=$remote_dir.'/'.$name;
                    $result=$this->put($dest, $local_fullname, $mode, KFTP_OR_Overwrite);
                    }
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }

        // Non common remote files :
        foreach($remote_files_to_check as $name){
            $remote_fullname=$remote_dir.'/'.$name;

            $ignore=false;
            if(is_array($ignore_list))
                foreach($ignore_list as $filter)
                    if(preg_match($filter,$remote_fullname)){
                        $ignore=true;
                        break;
                        }
            if($ignore)
                continue;

            $info=$remote_list[$name];

            // Directory
            if($info['is_dir']){
                if($max_level===0)
                    continue;
                // Erase
                if($remote_option===KFTP_Synchro_Erase)
                    $result=$this->deltree($remote_fullname,$on_error,$max_level-1);
                // Transfer
                else {
                    $dest=$local_dir.'/'.$name;
                    if(($result=@mkdir($dest))===false)
                        $this->trigger_error('synchronize',@$php_errormsg);
                    else $result=$this->downloaddir($remote_fullname.'/',$dest.'/',$mode,KFTP_OR_Overwrite,$on_error,$max_level-1);
                    }
                }
            // File
            else {
                // Erase
                if($remote_option===KFTP_Synchro_Erase)
                    $result=$this->delete($remote_fullname);
                // Transfer
                else {
                    $dest=$local_dir.'/'.$name;
                    $result=$this->get($dest, $remote_fullname, $mode, KFTP_OR_Overwrite);
                    }
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;

            }

        // Common files
        foreach($common_files as $name){
            $local_fullname=$local_dir.'/'.$name;
            $remote_fullname=$remote_dir.'/'.$name;

            $ignore=false;
            if(is_array($ignore_list))
                foreach($ignore_list as $filter)
                    if(preg_match($filter,$local_fullname) or preg_match($filter,$remote_fullname)){
                        $ignore=true;
                        break;
                        }
            if($ignore)
                continue;

            $local_info=array(
                'is_dir'=>@is_dir($local_fullname),
                'time'=>@filemtime($local_fullname),
                'size'=>@filesize($local_fullname),
                );

            $remote_info=$remote_list[$name];

            if($local_info['is_dir'] xor $remote_info['is_dir']){
                $this->trigger_error('synchronize','unable to synchronize a file with a directory');
                $result=false;
                }
            // Directory
            elseif($local_info['is_dir']){
                if($max_level===0)
                    continue;
                $result=$this->synchronize($local_fullname, $remote_fullname, $mode, $local_option, $remote_option,
                    $ignore_list, $on_error, $max_level-1);
                }
            // File
            else {
                $transfer_mode=$this->get_transfer_mode($name);

                // If ASCII transfer mode, can't check file size
                if($transfer_mode===FTP_ASCII){
                    // local file is newer ? then upload it
                    if($local_info['time']>$remote_info['time'])
                        $result=$this->put($remote_fullname, $local_fullname, $transfer_mode, KFTP_OR_Overwrite);
                    // remote file is newer ? then download it
                    elseif($local_info['time']<$remote_info['time'])
                        $result=$this->get($local_fullname, $remote_fullname, $transfer_mode, KFTP_OR_Overwrite);
                    // local and remote files have same date ? then ignore it
                    else $result=true;
                    }
                else {
                    // local file is newer ? then upload it
                    if($local_info['time']>$remote_info['time'])
                        $result=$this->put($remote_fullname, $local_fullname, $transfer_mode, KFTP_OR_Overwrite);
                    // remote file is newer ? if size change, then download it
                    elseif($local_info['time']<$remote_info['time'] and $local_info['size']<>$remote_info['size'])
                        $result=$this->get($local_fullname, $remote_fullname, $transfer_mode, KFTP_OR_Overwrite);
                    // size change ? then we should synchronize.... but in which direction ?
                    elseif($local_info['size']<>$remote_info['size']){
                        // by looking for option, we try to determine which file we should keep
                        if($local_option===KFTP_Synchro_Transfer or $remote_option!==KFTP_Synchro_Transfer)
                            $result=$this->put($remote_fullname, $local_fullname, $transfer_mode, KFTP_OR_Overwrite);
                        else $result=$this->get($local_fullname, $remote_fullname, $transfer_mode, KFTP_OR_Overwrite);
                        }
                    else $result=true;
                    }
                }

            if($result===false and $on_error===KFTP_BreakOnError)
                return false;
            }

        return true;
        }

// ----- Transfer -----

    // readdir -- read the content of the directory and returns it in an associative array
    function readdir($path=false, $flag=false){
        if(!$this->connected) {
            $this->trigger_error('readdir','not connected !',__FILE__,__LINE__);
            return false;
            }

        $nocache=(($flag & KFTP_NoCache) === KFTP_NoCache);
        $acceptpredict=(($flag & KFTP_AcceptPredict) === KFTP_AcceptPredict);

        if($nocache or ($content=$this->cache_read($path))===false
            or (!$acceptpredict and isset($content['predict']))) {
            $this->send_msg('Read dir');
            $content=parent::rawlist($path);
            $content=$this->rawlist_parser($content);

            $this->cache_write($path,$content);
            }
        else $this->check_idle();

        return $content;
        }

    // rawlist -- Returns a detailed list of files in the given directory (brute result)
    function rawlist($path=false){
        if(!$this->connected) {
            $this->trigger_error('rawlist','not connected !',__FILE__,__LINE__);
            return false;
            }

        $this->idle_breaked();
        return parent::rawlist($path);
        }

    // get_transfer_mode -- detect the transfer mode corresponding to the file type
    function get_transfer_mode($filename){
        $mode=FTP_BINARY;
        $pos=strrpos($filename,'.');
        if($pos!==false){
            $ext=strtoupper(substr($filename,$pos+1));                      // get the extension of the filename

            if(in_array($ext,$GLOBALS['KFTP_Conf']['Ascii_File_Types']))    // look at the list of "ascii file types"
                $mode=FTP_ASCII;
            }

        return $mode;
        }

    // get -- Downloads a file from the FTP server
    function get($local_file,$remote_file,$mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        if(!$this->connected) {
            $this->trigger_error('get','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the path or filename are not given, then build full path
        if(!$local_file)
            $local_file='./'.basename($remote_file);
        elseif($local_file{strlen($local_file)-1}==='/'
            or $local_file{strlen($local_file)-1}==='\\')
            $local_file.=basename($remote_file);
        elseif(is_dir($local_file))
            $local_file.='/'.basename($remote_file);

        // if transfer mode is AUTO, then search for the appropriate transfer mode
        if($mode===FTP_AUTO)
            $mode=KFTP::get_transfer_mode($remote_file);

        // check overwrite rules
        $skip=false;
        $overwrite=false;
        $resume_pos=0;
        $msg=false;
        if($overwrite_rule!==KFTP_OR_Overwrite and file_exists($local_file)){
            $msg='overwrite';
            if($overwrite_rule===KFTP_OR_Skip){
                $skip=true;
                $msg='skipping : file exists';
                }
            elseif($overwrite_rule===KFTP_OR_Resume){
                if($mode===FTP_BINARY and $info=$this->get_file_info($remote_file)){
                    $local_size=filesize($local_file);
                    if($info['size']>$local_size){
                        $resume_pos=$local_size;
                        $msg='at position '.$resume_pos;
                        }
                    else {
                        $skip=true;
                        $msg='skipping : file ok';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSize){
                $skip=true;
                $msg='skipping : same size';
                if($info=$this->get_file_info($remote_file)){
                    $local_size=filesize($local_file);
                    if($info['size']!=$local_size){
                        $skip=false;
                        $msg='overwrite : different size';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfNewer){
                $skip=true;
                $msg='skipping : not newer';
                if($info=$this->get_file_info($remote_file)){
                    $local_time=KFTP::ftptime(@filemtime($local_file),$info['time_precision']);
                    if($info['time']>$local_time){
                        $skip=false;
                        $msg='overwrite : newer';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSizeOrNewer){
                $skip=true;
                $msg='skipping : same size and not newer';
                if($info=$this->get_file_info($remote_file)){
                    $local_size=filesize($local_file);
                    $local_time=KFTP::ftptime(@filemtime($local_file),$info['time_precision']);
                    if($info['size']!=$local_size or $info['time']>$local_time){
                        $skip=false;
                        $msg='overwrite : newer or different size';
                        }
                    }
                }
            }

        if($msg) $msg=' ('.$msg.')';
        $msg='Download ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') '
            .$remote_file.' to '.$local_file.$msg;

        $this->send_msg($msg);

        if($skip){
            $this->check_idle();
            return true;
            }

        $result=parent::get($local_file,$remote_file,$mode,$resume_pos);

        if($result and KFTP_KeepRemoteTime){
            $info=$this->get_file_info($remote_file);
            if($info['time'])
                @touch($local_file,$info['time']);
            }

        $this->idle_breaked();

        return $result;
        }

    // download -- downloads a file from the FTP server
    // same as get() : the only change is the parameters order.
    function download($source, $dest=false, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        return $this->get($dest, $source, $mode, $overwrite_rule);
        }

    // put -- Uploads a file to the FTP server
    function put($remote_file,$local_file,$mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        if(!$this->connected) {
            $this->trigger_error('put','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the path or filename are not given, then build full path
        if(!$remote_file)
            $remote_file='./'.basename($local_file);
        elseif($remote_file{strlen($remote_file)-1}==='/'
            or $remote_file{strlen($remote_file)-1}==='\\')
            $remote_file.='/'.basename($local_file);
        elseif($this->is_dir($remote_file))
            $remote_file.='/'.basename($local_file);

        // if transfer mode is AUTO, then search for the appropriate transfer mode
        if($mode===FTP_AUTO)
            $mode=KFTP::get_transfer_mode($local_file);

        // check overwrite rules
        $skip=false;
        $overwrite=false;
        $resume_pos=0;
        $msg=false;
        if($overwrite_rule!==KFTP_OR_Overwrite and $info=$this->get_file_info($remote_file)){
            $msg='overwrite';
            if($overwrite_rule===KFTP_OR_Skip){
                $skip=true;
                $msg='skipping : file exists';
                }
            elseif($overwrite_rule===KFTP_OR_Resume){
                if($mode===FTP_BINARY){
                    $local_size=filesize($local_file);
                    if($info['size']<$local_size){
                        $resume_pos=$info['size'];
                        $msg='at position '.$resume_pos;
                        }
                    else {
                        $skip=true;
                        $msg='skipping : file ok';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSize){
                $skip=true;
                $msg='skipping : same size';
                $local_size=filesize($local_file);
                if($info['size']!=$local_size){
                    $skip=false;
                    $msg='overwrite : different size';
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfNewer){
                $skip=true;
                $msg='skipping : not newer';
                $local_time=KFTP::ftptime(@filemtime($local_file),$info['time_precision']);
                if($info['time']<$local_time){
                    $skip=false;
                    $msg='overwrite : newer';
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSizeOrNewer){
                $skip=true;
                $msg='skipping : same size and not newer';
                $local_size=filesize($local_file);
                $local_time=KFTP::ftptime(@filemtime($local_file),$info['time_precision']);
                if($info['size']!=$local_size or $info['time']<$local_time){
                    $skip=false;
                    $msg='overwrite : newer or different size';
                    }
                }
            }

        if($msg) $msg=' ('.$msg.')';
        $msg='Upload ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') '
            .$local_file.' to '.$remote_file.$msg;

        $this->send_msg($msg);

        if($skip){
            $this->check_idle();
            return true;
            }

        $result=parent::put($remote_file,$local_file,$mode,$resume_pos);

        if($result)
            $this->predict_file_info($remote_file,
                array('time'=>time(),'size'=>@filesize($local_file)));
        else $this->cache_del(dirname($remote_file));

        $this->idle_breaked();

        return $result;
        }

    // upload -- Uploads a file to the FTP server
    // same as put() : the only change is the parameters order.
    function upload($source, $dest=false, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        return $this->put($dest, $source, $mode, $overwrite_rule);
        }

    // xget -- Transfer a file from an other FTP server to the actual FTP server
    function xget(& $KFTP, $local_file, $remote_file, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        if(!$this->connected or !$KFTP->connected) {
            $this->trigger_error('xget','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the path or filename are not given, then build full path
        if(!$local_file)
            $local_file='./'.basename($remote_file);
        elseif($local_file{strlen($local_file)-1}==='/'
            or $local_file{strlen($local_file)-1}==='\\')
            $local_file.='/'.basename($remote_file);
        elseif(is_dir($local_file))
            $local_file.='/'.basename($remote_file);

        // if transfer mode is AUTO, then search for the appropriate transfer mode
        if($mode===FTP_AUTO)
            $mode=KFTP::get_transfer_mode($remote_file);


        // check overwrite rules
        $skip=false;
        $overwrite=false;
        $resume_pos=0;
        $msg=false;
        if($overwrite_rule!==KFTP_OR_Overwrite and $local_info=$this->get_file_info($local_file)){
            $msg='overwrite';
            if($overwrite_rule===KFTP_OR_Skip){
                $skip=true;
                $msg='skipping : file exists';
                }
            elseif($overwrite_rule===KFTP_OR_Resume){
                if($mode===FTP_BINARY and $remote_info=$KFTP->get_file_info($remote_file)){
                    if($remote_info['size']>$local_info['size']){
                        $resume_pos=$local_info['size'];
                        $msg='at position '.$resume_pos;
                        }
                    else {
                        $skip=true;
                        $msg='skipping : file ok';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSize){
                $skip=true;
                $msg='skipping : same size';
                if($remote_info=$KFTP->get_file_info($remote_file)){
                    if($remote_info['size']!=$local_info['size']){
                        $skip=false;
                        $msg='overwrite : different size';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfNewer){
                $skip=true;
                $msg='skipping : not newer';
                if($remote_info=$KFTP->get_file_info($remote_file)){
                    if($remote_info['time']>$local_info['time']){
                        $skip=false;
                        $msg='overwrite : newer';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSizeOrNewer){
                $skip=true;
                $msg='skipping : same size and not newer';
                if($remote_info=$KFTP->get_file_info($remote_file)){
                    if($remote_info['size']!=$local_info['size'] or $remote_info['time']>$local_info['time']){
                        $skip=false;
                        $msg='overwrite : newer or different size';
                        }
                    }
                }
            }

        if($msg) $msg=' ('.$msg.')';
        $msg='Download ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') '
            .$remote_file.' (cnx '.$KFTP->instance_id.') to '.$local_file.' (cnx '.$this->instance_id.')'
            .$msg;

        $this->send_msg($msg);

        if($skip){
            $this->check_idle();
            $KFTP->check_idle();
            return true;
            }

        $result=parent::xget($KFTP, $local_file, $remote_file, $mode, $resume_pos);

        if($result){
            $info=$KFTP->get_file_info($remote_file);
            $this->predict_file_info($local_file,
                array('time'=>time(),'size'=>@$info['size']));
            }
        else $this->cache_del(@dirname($local_file));

        $this->idle_breaked();
        $KFTP->idle_breaked();

        return $result;
        }

    // xdownload -- Transfer a file from an other FTP server to the actual FTP server
    // same as xget() : the only change is the parameters order.
    function xdownload(& $KFTP, $source, $dest=false, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        return $this->xget($KFTP, $dest, $source, $mode, $overwrite_rule);
        }

    // xput -- Transfer a file from the actual FTP server to an other FTP server
    function xput(& $KFTP, $remote_file, $local_file, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        if(!$this->connected or !$KFTP->connected) {
            $this->trigger_error('xput','not connected !',__FILE__,__LINE__);
            return false;
            }
        if($overwrite_rule===KFTP_OR_LookSettings)
            $overwrite_rule=$this->default_overwrite_rule;

        // if the path or filename are not given, then build full path
        if(!$remote_file)
            $remote_file='./'.basename($local_file);
        elseif($remote_file{strlen($remote_file)-1}==='/'
            or $remote_file{strlen($remote_file)-1}==='\\')
            $remote_file.='/'.basename($local_file);
        elseif($this->is_dir($remote_file))
            $remote_file.='/'.basename($local_file);

        // if transfer mode is AUTO, then search for the appropriate transfer mode
        if($mode===FTP_AUTO)
            $mode=KFTP::get_transfer_mode($local_file);

        // check overwrite rules
        $skip=false;
        $overwrite=false;
        $resume_pos=0;
        $msg=false;
        if($overwrite_rule!==KFTP_OR_Overwrite and $remote_info=$KFTP->get_file_info($remote_file)){
            $msg='overwrite';
            if($overwrite_rule===KFTP_OR_Skip){
                $skip=true;
                $msg='skipping : file exists';
                }
            elseif($overwrite_rule===KFTP_OR_Resume){
                if($mode===FTP_BINARY and $local_info=$this->get_file_info($local_file)){
                    if($local_info['size']>$remote_info['size']){
                        $resume_pos=$remote_info['size'];
                        $msg='at position '.$resume_pos;
                        }
                    else {
                        $skip=true;
                        $msg='skipping : file ok';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSize){
                $skip=true;
                $msg='skipping : same size';
                if($local_info=$this->get_file_info($local_file)){
                    if($remote_info['size']!=$local_info['size']){
                        $skip=false;
                        $msg='overwrite : different size';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfNewer){
                $skip=true;
                $msg='skipping : not newer';
                if($local_info=$this->get_file_info($local_file)){
                    if($local_info['time']>$remote_info['time']){
                        $skip=false;
                        $msg='overwrite : newer';
                        }
                    }
                }
            elseif($overwrite_rule===KFTP_OR_OverwriteIfDifferentSizeOrNewer){
                $skip=true;
                $msg='skipping : same size and not newer';
                if($local_info=$this->get_file_info($local_file)){
                    if($local_info['size']!=$remote_info['size'] or $local_info['time']>$remote_info['time']){
                        $skip=false;
                        $msg='overwrite : newer or different size';
                        }
                    }
                }
            }

        if($msg) $msg=' ('.$msg.')';
        $msg='Upload ('.$GLOBALS['KFTP_Conf']['Transfer_Name'][$mode].') '
            .$local_file.' (cnx '.$this->instance_id.') to '.$remote_file.' (cnx '.$KFTP->instance_id.')'
            .$msg;

        $this->send_msg($msg);

        if($skip){
            $this->check_idle();
            $KFTP->check_idle();
            return true;
            }

        $result=parent::xput($KFTP, $remote_file, $local_file, $mode, $resume_pos);

        if($result){
            $info=$this->get_file_info($local_file);
            $KFTP->predict_file_info($remote_file,
                array('time'=>time(),'size'=>@$info['size']));
            }
        else $KFTP->cache_del(@dirname($remote_file));

        $this->idle_breaked();
        $KFTP->idle_breaked();

        return $result;
        }

    // xupload -- Transfer a file from the actual FTP server to an other FTP server
    // same as xput() : the only change is the parameters order.
    function xupload(& $KFTP, $source, $dest=false, $mode=FTP_AUTO, $overwrite_rule=KFTP_OR_LookSettings){
        return $this->xput($KFTP, $dest, $source, $mode, $overwrite_rule);
        }


// ----- Files -----

    // rename -- Renames a file on the FTP server
    function rename($from,$to){
        if(!$this->connected) {
            $this->trigger_error('rename','not connected !',__FILE__,__LINE__);
            return false;
            }
        $result=parent::rename($from,$to);

        $this->predict_file_info($from,false);
        $path=dirname($this->fullpath($to));
        if($path==='\\') $path='/';
        $this->cache_del($path);

        $this->idle_breaked();

        return $result;
        }

    // delete -- Deletes a file on the FTP server
    function delete($file){
        if(!$this->connected) {
            $this->trigger_error('delete','not connected !',__FILE__,__LINE__);
            return false;
            }

        $this->send_msg('Delete '.$file);

        $result=parent::delete($file);

        $this->predict_file_info($file,false);

        $this->idle_breaked();

        return $result;
        }

    // mdtm -- Returns the last modified time of the given file
    function mdtm($file){
        if(!$this->connected) {
            $this->trigger_error('mdtm','not connected !',__FILE__,__LINE__);
            return false;
            }

        $this->idle_breaked();

        return parent::mdtm($file);
        }

    // size -- Returns the size of the given file
    function size($file){
        if(!$this->connected) {
            $this->trigger_error('size','not connected !',__FILE__,__LINE__);
            return false;
            }

        $this->idle_breaked();

        return parent::size($file);
        }

    // chmod -- Changes file mode
    function chmod($file,$mode){
        if(!$this->connected) {
            $this->trigger_error('chmod','not connected !',__FILE__,__LINE__);
            return false;
            }
        $result=parent::chmod($file,$mode);

        if($info=$this->get_file_info($file))
            unset($info['permission']);
        $this->predict_file_info($file,$info);

        $this->idle_breaked();

        return $result;
        }

    // file_exists -- Returns true if file exists, else false
    function file_exists($path){
        $info=$this->get_file_info($path);
        if($info===false)
            return false;
        return true;
        }

    // is_dir -- Returns true if it is a directory, else false
    function is_dir($path){
        $info=$this->get_file_info($path);
        if($info===false)
            return false;
        return $info['is_dir'];
        }

    // is_file -- Returns true if it is a file, else false
    function is_file($path){
        $info=$this->get_file_info($path);
        if($info===false)
            return false;
        return !$info['is_dir'];
        }

    // filemtime -- Returns the last modified time of the given file (based on rawlist result)
    function filemtime($path){
        $info=$this->get_file_info($path);
        if($info===false)
            return false;
        return $info['time'];
        }

    // filesize -- Returns the size of the given file (based on rawlist result)
    function filesize($path){
        $info=$this->get_file_info($path);
        if($info===false)
            return false;
        return $info['size'];
        }

    // get_file_info -- get file information from cache (from prediction or not)
    function get_file_info($file){
        $file=$this->fullpath($file);

        $path=dirname($file);
        if($path==='\\') $path='/';
        $key=basename($file);

        if($list=$this->readdir($path,KFTP_AcceptPredict) and isset($list['files'][$key]))
            return $list['files'][$key];
        return false;
        }

    // predict_file_info -- change file information in cache (for prediction)
    // This allow a much faster check of overwriting rules, by predicting the result
    // of the FTP commands. (inspired by FileZilla, which add '????' cols before refresh)
    function predict_file_info($file,$info){
        $file=$this->fullpath($file);
        $path=dirname($file);
        if($path==='\\') $path='/';

        // If there is no cache file actually, then return
        if(($list=$this->cache_read($path))===false)
            return true;

        // Add this to know this is a prediction only
        $list['predict']=true;

        $key=basename($file);
        // if "$info" then update this files info, else erase it
        if($info!==false)
            $list['files'][$key]=array_merge($GLOBALS['KFTP_Conf']['Rawlist_Model'],$info);
        else unset($list['files'][$key]);

        // Write updated data
        $this->cache_write($path,$list);
        }

// ----- Idle control -----

    // check_idle -- checks if we have to break idle
    function check_idle(){
        if($this->_idle + KFTP_AntiIdleTime < time()){
            parent::must_break_idle();
            $this->_idle=time();
            }
        }

    // idle_breaked -- called each time an ftp command is done
    function idle_breaked(){
        $this->_idle=time();
        }


// ----- Directory Caching -----

    // cache_file -- returns the file name corresponding to a path in cache
    function cache_file($path){
        if($this->_cnxid===false)
            $this->_cnxid=crc32($this->host.'|'.$this->port.'|'.$this->login.'|'.$this->pass);

        $cache_file=$GLOBALS['KFTP_Conf']['Tmp_Dir']
            .'/kftp '.$this->_cnxid
            .' '.md5($this->fullpath($path)).'.cache';

        return $cache_file;
        }

    // cache_read -- reads a directory content from cache
    function cache_read($path){
        if(!$GLOBALS['KFTP_Conf']['Use_Cache'])
            return false;

        $cachefile=$this->cache_file($path);

        clearstatcache();
        $time=@filemtime($cachefile);

        if($time + $GLOBALS['KFTP_Conf']['Cache_Dir_Time'] < time())
            return false;

        if($this->_cachedir_last_path===$cachefile)
            return $this->_cachedir_last_content;

        if(!$buffer=file_get_contents($cachefile))
            return false;

        return @unserialize($buffer);
        }

    // cache_write -- writes a directory content in cache
    function cache_write($path,& $content){
        if(!$GLOBALS['KFTP_Conf']['Use_Cache'])
            return false;

        $cachefile=$this->cache_file($path);
        $tmpfile=tempnam($GLOBALS['KFTP_Conf']['Tmp_Dir'],'kftp ');

        $this->_cachedir_last_content=$content;
        $this->_cachedir_last_path=$cachefile;

        if(!@file_put_contents($tmpfile,serialize($content))){
            $this->trigger_error('cache_write',@$php_errormsg,__FILE__,__LINE__);
            @unlink($tmpfile);
            return false;
            }
        else {
            if($GLOBALS['KFTP_Conf']['Local_OS']===KFTP_OS_Windows)
                @unlink($cachefile);
            if(!@rename($tmpfile,$cachefile)){
                $this->trigger_error('cache_write',@$php_errormsg,__FILE__,__LINE__);
                @unlink($tmpfile);
                return false;
                }
            }
        return true;
        }

    // cache_del -- removes a directory from cache
    function cache_del($path){
        if(!$GLOBALS['KFTP_Conf']['Use_Cache'])
            return false;

        @unlink($this->cache_file($path));
        }

    // cache_clean -- removes old files from cache
    function cache_clean($path=NULL){
        if(!$GLOBALS['KFTP_Conf']['Use_Cache'])
            return false;

        if($path===NULL){
            $path=$GLOBALS['KFTP_Conf']['Tmp_Dir'];
            clearstatcache();
            }

        if($dir=@opendir($path)){
            while($file=readdir($dir)){
                if($file==='.' or $file==='..')
                    continue;
                $full=$path.'/'.$file;
                if(is_dir($full)){
                    $this->cache_clean($full);
                    @rmdir($path);
                    }
                elseif(substr($file,0,3)==='kft' and filemtime($full)+$GLOBALS['KFTP_Conf']['Cache_Dir_Time']+3600<time())
                    @unlink($full);
                }
            closedir($dir);
            }
        else $this->trigger_error('cache_clean',@$php_errormsg,__FILE__,__LINE__);
        }


// ----- Serialisation -----

    // __sleep -- called by the function serialize(), backups the connection
    function __sleep(){
        $this->send_msg('Backup the connection');

        $this_list=array(
            'verbose',
            'time_offset',
            );
        $parent_list=parent::__sleep();

        return array_merge($this_list, $parent_list);
        }

    // __wakeup -- called by the function unserialize(), restores the connection
    function __wakeup(){
        $this->send_msg('Restore the connection');

        parent::__wakeup();
        }


// ----- Other -----

    // send_msg -- display an information msg if the verbose mode is enable
    function send_msg($msg){
        if($this->verbose){
            echo $msg;
            if(ini_get('html_errors'))
                echo ' <br />';
            echo "\n";
            }
        }


    }
// ----- END -----

?>