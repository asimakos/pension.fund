<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// --------------------------------------------------------------------------------------
// KFTP_Basic : FTP extension implementation.
// author : Olivier BONVALET / bool@boolsite.net
// --------------------------------------------------------------------------------------
// The KFTP_Basic class is a "low level" class for accessing FTP functions.
// This version use the "FTP extension" of PHP. So, it's stable but functionnality
// depending of PHP version. Hidden files are not visibles, FXP doesn't exists, and
// before PHP 4.3 RESUME is not possible.
// --------------------------------------------------------------------------------------

class KFTP_Basic {
    public $connected=false;                                           // connection status

    public $instance_id=0;                                             // Instance ident, for FXP debugging

    public $stream=false;                                              // resource identifier

    public $host='localhost';                                          // server host
    public $ip;                                                        // server ip
    public $port=21;                                                   // server port
    public $login=KFTP_AnonymousLogin;                                 // login
    public $pass=KFTP_AnonymousLogin;                                  // password

    public $ssl=false;                                                 // use SSL or not

    public $_pasv=KFTP_DefaultPASV;                                    // pasv mode

    public $_cwd=false;                                                // current path (on ftp server)
    public $_last_error=false;                                         // last ftp error
    public $_server_OS=false;                                          // server's operating system (for ASCII concersion)

/*
    // constructor
    function __construct($ssl=false){
        global $mosConfig_ftp_host, $mosConfig_ftp_user, $mosConfig_ftp_pass, $mosConfig_ftp_port;
        $this->instance_id=$this->instance_count();

        if ($mosConfig_ftp_host !== NULL) {
            $this->connection_settings($mosConfig_ftp_host, $mosConfig_ftp_port, $mosConfig_ftp_user, $mosConfig_ftp_pass, $ssl);
        }
    }
*/
    // constructor
    function __construct($host=NULL, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousLogin, $ssl=false){
        $this->instance_id=$this->instance_count();

        if($host!==NULL)
            $this->connection_settings($host,$port,$login,$pass,$ssl);
        }



    // constructor, for PHP 4 only
    function KFTP_Basic($host=NULL, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousLogin, $ssl=false){
        $this->__construct($ssl);
        }

    // destructor
    function __destruct(){
        $this->close();
        }


// ----- Connection -----

    // connection_settings -- set actual connection settings
    function connection_settings($host, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousPass, $ssl=false){
        $this->host=trim($host);
        $this->port=(int)$port;
        $this->login=$login;
        $this->pass=$pass;
        $this->ssl=(bool)$ssl;
        }

    // connect -- Opens an FTP connection
    function connect($retry=KFTP_ConnectionRetry){
        // if already connected, return
        if($this->connected and $this->stream)
            return true;

        // if stream does not exist, then try to connect
        if(!$this->stream){

            // try to resolve host
            $this->ip=@gethostbyname($this->host);
            if(!$this->ip){
                $this->trigger_error('connect',@$php_errormsg,__FILE__,__LINE__);
                return false;
                }

            $this->connected=false;
            $this->_cwd=false;
            // try to connect $retry times
            do {
                if($this->ssl and function_exists('ftp_connect_ssl')) {
                    $this->stream=@ftp_connect_ssl($this->ip,$this->port,$GLOBALS['KFTP_Conf']['Connection_TimeOut']);
                } elseif(phpversion()<'4.2') {
                    $this->stream=@ftp_connect($this->ip,$this->port);
                } else { $this->stream=@ftp_connect($this->ip,$this->port,$GLOBALS['KFTP_Conf']['Connection_TimeOut']); }
                } while (!$this->stream and --$retry);

            if(!$this->stream){
                $error=@$php_errormsg;
                if(!$error) $error='can\'t connect';
                $this->trigger_error('connect',$error,__FILE__,__LINE__);
                return false;
                }
            }

        // try to identify
        if(!@ftp_login($this->stream,$this->login,$this->pass)){
            $this->trigger_error('connect',@$php_errormsg,__FILE__,__LINE__);
            $this->connected=false;
            $this->stream=NULL;
            $this->_cwd=false;
            @ftp_close($this->stream);
            return false;
            }

        // all is ok.
        if($this->_pasv)
            $this->pasv($this->_pasv);
        $this->connected=true;
        return true;
        }

    // close -- Closes an FTP connection
    function close(){
        if($this->connected)
            @ftp_close($this->stream);
        $this->connected=false;
        $this->stream=NULL;
        $this->_cwd=false;
        return true;
        }

    // rein -- ReInit an FTP connection
    function rein(){
        // the FTP extension of PHP does not support this feature.
        // So we close and re-open the connection.
        //
        // PS : as you can see in the PHP source, the function
        // exists in "ftp.c" but not in "php_ftp.c" ...

        $this->close();

        return $this->connect();
        }

    // pasv -- Turns passive mode on or off
    function pasv($mode){
        $mode=(bool)$mode;

        if(($result=@ftp_pasv($this->stream,$mode))===false)
            $this->trigger_error('pasv',@$php_errormsg,__FILE__,__LINE__);
        else $this->_pasv=$mode;

        return $result;
        }


// ----- Directories -----

    // pwd -- Returns the current directory name
    function pwd(){
        // this allow a small cache, to avoid multiple ask to the ftp server
        if($this->_cwd!==false)
            return $this->_cwd;

        if(($this->_cwd=@ftp_pwd($this->stream))===false)
            $this->trigger_error('pwd',@$php_errormsg,__FILE__,__LINE__);

        return $this->_cwd;
        }

    // chdir -- Changes directories on a FTP server
    function chdir($path){
        // clear the PWD cache
        $this->_cwd=false;

        if(($result=@ftp_chdir($this->stream,$path))===false)
            $this->trigger_error('chdir',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // cdup -- Changes to the parent directory
    function cdup(){
        // clear the PWD cache
        $this->_cwd=false;

        if(($result=@ftp_cdup($this->stream))===false)
            $this->trigger_error('cdup',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // mkdir -- Creates a directory
    function mkdir($path){
        if(($result=@ftp_mkdir($this->stream, $path))===false)
            $this->trigger_error('mkdir',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // rmdir -- Removes a directory
    function rmdir($path){
        if(($result=@ftp_rmdir($this->stream, $path))===false)
            $this->trigger_error('rmdir',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }


// ----- Transfer -----

    // rawlist -- Returns a detailed list of files in the given directory
    function rawlist($path=false){

        $olddir=false;
        if(strpos($path,' ')!==false and $path!==$this->pwd()){         // if path contain a space, we have to change dir.
            $olddir=$this->pwd();
            $this->chdir($path);
            $path=NULL;
            }
        elseif($path===$this->_cwd)                                     // if path is same as current, does not give parameter.
            $path=NULL;

        $retry=1;
        do {
            $result=@ftp_rawlist($this->stream,$path);                  // try to get list $retry times
            } while ($result===false and --$retry);

        if($result===false)
            $this->trigger_error('rawlist',@$php_errormsg,__FILE__,__LINE__);

        if($olddir!==false)                                             // if we changed path, go to the old path.
            $this->chdir($olddir);

        return $result;
        }

    // get -- Downloads a file from the FTP server
    function get($local_file,$remote_file,$mode=FTP_BINARY,$resume_pos=0){

        // have we to simulate ASCII transfer ?
        if($mode===FTP_ASCII and $GLOBALS['KFTP_Conf']['Simul_Ascii'] and
            $GLOBALS['KFTP_Conf']['Local_OS']!=$this->server_os()) {

            $tmpfile=tempnam($GLOBALS['KFTP_Conf']['Tmp_Dir'],'kftp ');

            $result=@ftp_get($this->stream,$tmpfile,$remote_file,FTP_BINARY);
            if($result===false)
                $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
            else {
                $result=$this->ascii_convert($tmpfile,$local_file,$GLOBALS['KFTP_Conf']['Local_OS']);
                @unlink($tmpfile);
                }

            return $result;
            }

        if(phpversion()<'4.3')
            $result=@ftp_get($this->stream,$local_file,$remote_file,$mode);
          else $result=@ftp_get($this->stream,$local_file,$remote_file,$mode,$resume_pos);

        if($result===false)
            $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // put -- Uploads a file to the FTP server
    function put($remote_file,$local_file,$mode=FTP_BINARY,$resume_pos=0){

        // have we to simulate ASCII transfer ?
        if($mode===FTP_ASCII and $GLOBALS['KFTP_Conf']['Simul_Ascii'] and
            $GLOBALS['KFTP_Conf']['Local_OS']!=$this->server_os()){

            $tmpfile=tempnam($GLOBALS['KFTP_Conf']['Tmp_Dir'],'kftp ');

            $result=$this->ascii_convert($local_file,$tmpfile);
            if($result!==false){
                $result=@ftp_put($this->stream,$remote_file,$tmpfile,FTP_BINARY);
                if($result===false)
                    $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
                }
            @unlink($tmpfile);

            return $result;
            }

        if(phpversion()<'4.3')
            $result=@ftp_put($this->stream,$remote_file,$local_file,$mode);
          else $result=@ftp_put($this->stream,$remote_file,$local_file,$mode,$resume_pos);

        if($result===false)
            $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // xget -- Transfer a file from an other FTP server to the actual FTP server
    function xget(& $KFTP,$local_file,$remote_file,$mode=FTP_BINARY, $resume_pos=0){
        // PHP doesn't allow to do this... so, we simulate it, but it's slower.

        $tmpfile=tempnam($GLOBALS['KFTP_Conf']['Tmp_Dir'],'kftp ');
        if(($result=$KFTP->get($tmpfile, $remote_file, $mode))!==false)
            $result=$this->put($local_file, $tmpfile, $mode, $resume_pos);
        @unlink($tmpfile);

        return $result;
        }

    // xput -- Transfer a file from the actual FTP server to an other FTP server
    function xput(& $KFTP,$remote_file,$local_file,$mode=FTP_BINARY, $resume_pos=0){
        // PHP doesn't allow to do this... so, we simulate it, but it's slower.

        $tmpfile=tempnam($GLOBALS['KFTP_Conf']['Tmp_Dir'],'kftp ');
        if(($result=$this->get($tmpfile, $remote_file, $mode))!==false)
            $result=$KFTP->put($local_file, $tmpfile, $mode, $resume_pos);
        @unlink($tmpfile);

        return $result;
        }

// ----- Files -----

    // rename -- Renames a file on the FTP server
    function rename($from,$to){
        if(($result=@ftp_rename($this->stream,$from,$to))===false)
            $this->trigger_error('rename',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // move -- Move a file on the FTP server -- alias for rename()
    function move($from,$to){
        return $this->rename($from,$to);
        }

    // delete -- Deletes a file on the FTP server
    function delete($file){
        if(($result=@ftp_delete($this->stream,$file))===false)
            $this->trigger_error('delete',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // mdtm -- Returns the last modified time of the given file
    function mdtm($file){
        if(($result=@ftp_mdtm($this->stream,$file))===false)
            $this->trigger_error('mdtm',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // size -- Returns the size of the given file
    function size($file){
        if(($result=@ftp_size($this->stream,$file))===false)
            $this->trigger_error('size',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // chmod -- Changes file mode
    function chmod($file,$mode){
        if(($result=@ftp_site($this->stream,'CHMOD '.$mode.' '.$file))===false)
            $this->trigger_error('chmod',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

// ----- Other FTP commands-----

    // systype -- Returns the system type identifier of the remote FTP server
    function systype(){

        if(($result=@ftp_systype($this->stream))===false)
            $this->trigger_error('systype',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // exec -- Requests execution of a program on the FTP server
    function exec($command){
        if(($result=@ftp_systype($this->stream,$command))===false)
            $this->trigger_error('exec',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // site -- Sends a SITE command to the server
    function site($command){
        if(($result=@ftp_site($this->stream,$command))===false)
            $this->trigger_error('site',@$php_errormsg,__FILE__,__LINE__);

        return $result;
        }

    // must_break_idle -- Do a FTP command to reset idle time
    function must_break_idle(){
        $rand=time()%2;

        if($rand===0){
            if(($this->_cwd=@ftp_pwd($this->stream))===false)
                $this->trigger_error('must_break_idle',@$php_errormsg,__FILE__,__LINE__);
            }
        else{
            if(@ftp_chdir($this->stream,'.')===false)
                $this->trigger_error('must_break_idle',@$php_errormsg,__FILE__,__LINE__);
            }

        return true;
        }

// ----- Errors -----

    // trigger_error -- Generates an error
    function trigger_error($fct, $msg, $file, $line){
        $msg=trim(preg_replace('`^[a-zA-Z_]+\\(\\):? *`','',$msg));
        if(!$msg) $msg='unknown error';
        $msg.=' in '.basename($file).' line '.$line;

        $this->_last_error='KFTP->'.$fct.'(): '.$msg;
        //trigger_error($this->_last_error, E_USER_WARNING);
        }

    // last_error -- Return the last error
    function last_error(){
        return $this->_last_error;
        }

// ----- Serialisation -----

    // __sleep -- called by the function serialize(), backups the connection
    function __sleep(){
        $was_connected=$this->connected;
        if($this->connected)
            $this->pwd();

        $this->close();
        $this->connected=$was_connected;

        return array('connected',
            'host', 'port', 'login', 'pass', 'ssl',
            '_pasv');
        }

    // __wakeup -- called by the function unserialize(), restores the connection
    function __wakeup(){
        $this->instance_id=$this->instance_count();
        if($this->connected){
            $this->connect();
            if($this->_cwd)
                $this->chdir($this->_cwd);
            }
        }

// ----- Other -----

    // instance_count -- return the number of instances
    function instance_count(){
        static $InstanceCount=0;

        return ++$InstanceCount;
        }

    // server_os -- returned the OS of the FTP server
    function server_os(){
        if($this->_server_OS!==false)
            return $this->_server_OS;

        $path=$this->pwd();$len=strlen($path);
        if($len>=3 and $path{1}===':')
            $this->_server_OS=KFTP_OS_Windows;
        else {
            $sys=strtolower($this->systype());
            if(strpos($sys,'win')!==false)
                $this->_server_OS=KFTP_OS_Windows;
            elseif(strpos($sys,'mac')!==false)
                $this->_server_OS=KFTP_OS_Mac;
            else $this->_server_OS=KFTP_OS_Unix;
            }

        return $this->_server_OS;
        }

    // ascii_convert -- try to convert an ascii file to the wanted OS format
    function ascii_convert($source_file, $dest_file, $wanted_OS){
        $str_rep_search=$GLOBALS['KFTP_Conf']['New_Line'];
        $str_rep_replace=$GLOBALS['KFTP_Conf']['New_Line'][$wanted_OS];

        if(!$f_out=@fopen($dest_file,'wb')){
            $this->trigger_error('ascii_convert',@$php_errormsg,__FILE__,__LINE__);
            return false;
            }

        if(!$f_in=@fopen($source_file,'rb')){
            fclose($f_out);
            @unlink($dest_file);
            $this->trigger_error('ascii_convert',@$php_errormsg,__FILE__,__LINE__);
            return false;
            }

        $error=false;
        while(!feof($f_in)){
            $buf=@fread($f_in,32768);
            if($buf===false){
                $error=true;
                break;
                }
            $result=@fwrite($f_out,str_replace($str_rep_search,$str_rep_replace,$buf));
            if($result===false){
                $error=true;
                break;
                }
            }

        fclose($f_in);
        fclose($f_out);

        if($error)
            @unlink($dest_file);

        return !$error;
        }

    }
// ----- END -----

?>