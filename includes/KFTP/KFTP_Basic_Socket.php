<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// --------------------------------------------------------------------------------------
// KFTP_Basic : FTP extension implementation.
// author : Olivier BONVALET / bool@boolsite.net
// --------------------------------------------------------------------------------------
// The KFTP_Basic class is a "low level" class for accessing FTP functions.
// This version use the experimental socket extension of PHP. So, it's powerfull but
// not really stable.
// Hidden files should be visibles, FXP is available, and RESUME is possible.
// --------------------------------------------------------------------------------------

// some old version of the extension don't define it
if(!defined('SOL_TCP'))
    define('SOL_TCP',0);

// before PHP 4.2 this function didn't exist
if(!function_exists('socket_select')){
    function socket_select(&$read_sk, &$write_sk, &$except_sk, $tv_sec=0, $tv_usec=0){
        static $read_fd=NULL;
        static $write_fd=NULL;
        static $except_fd=NULL;

        // allocate 2 file descriptors. It should be released by PHP at the end of the script.
        if($read_fd===NULL) $read_fd=socket_fd_alloc();
        if($write_fd===NULL) $write_fd=socket_fd_alloc();
        if($except_fd===NULL) $except_fd=socket_fd_alloc();

        if($read_sk!==NULL) socket_fd_set($read_fd, $read_sk);
        if($write_sk!==NULL) socket_fd_set($write_fd, $write_sk);
        if($except_sk!==NULL) socket_fd_set($except_fd, $except_sk);

        socket_select($read_fd, $write_fd, $except_fd, $tv_sec, $tv_usec);

        $count=0;
        if($read_sk!==NULL) foreach($read_sk as $sock)
            if(socket_fd_isset($read_fd, $sock)) $count++;

        if($write_sk!==NULL) foreach($write_sk as $sock)
            if(socket_fd_isset($write_fd, $sock)) $count++;

        if($except_sk!==NULL) foreach($except_sk as $sock)
            if(socket_fd_isset($except_fd, $sock)) $count++;

        socket_fd_zero($read_fd);
        socket_fd_zero($write_fd);
        socket_fd_zero($except_fd);

        return $count;
        }
    }

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
    public $_pasv_toggle=false;                                        // remember if pasv was toggled or not

    public $local_echo=false;                                          // local echo (can be used for debug)

    public $_cwd=false;                                                // current path (on ftp server)
    public $_last_error=false;                                         // last ftp error
    public $_server_OS=false;                                          // server's operating system (for ASCII concersion)
    public $_type=false;                                               // current transfer mode

    public $_datacnx=false;                                            // datacnx socket
    public $_datacnx_copy=false;                                       // datacnx socket copy (result of accept)
    public $_dataip=false;                                             // datacnx socket ip
    public $_dataport=false;                                           // datacnx socket port
    public $_localip=false;                                            // local ip

    public $_rawlist_avoid_a=false;                                    // does server accept -a parameter ?

    public $_sockbuf=array();                                          // buffer for socket_read()
    public $_sockbuf_last=array();                                     // last stream using socket_read()

    // constructor
    function __construct($ssl=false){
        global $mosConfig_ftp_host, $mosConfig_ftp_user, $mosConfig_ftp_pass, $mosConfig_ftp_port;
        $this->instance_id=$this->instance_count();

        if ($mosConfig_ftp_host !== NULL) {
            $this->connection_settings($mosConfig_ftp_host, $mosConfig_ftp_port, $mosConfig_ftp_user, $mosConfig_ftp_pass, $ssl);
        }
    }

    // constructor, for PHP 4 only
    function KFTP_Basic($host=NULL, $port=21, $login=KFTP_AnonymousLogin, $pass=KFTP_AnonymousLogin, $ssl=false){
        $this->__construct($ssl);
        }

    // destructor
    function __destruct(){
        $this->close();
        }

// ----- FTP Implementation ----

    // _ftp_cmd -- send an FTP command to the server, and return response code
    function _ftp_cmd($cmd,$fctname,$wantedcode=NULL){
        $this->_ftp_flush($fctname);                                // Flush the queue.

        if($this->local_echo){                                      // Send local echo, for debugging.
            echo $this->instance_id,') PUT : ',$cmd;
            if(ini_get('html_errors'))
                echo ' <br />';
            echo "\n";
            }

        // write on the socket
        if(@socket_write($this->stream,$cmd."\r\n")===false){
            $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
            $this->connected=false;
            return false;
            }

        // if wantedcode was given, then check the result
        if($wantedcode!==NULL)
            return $this->_ftp_check_resp($fctname,$wantedcode);

        // return the response code
        return $this->_ftp_resp($fctname);
        }

    // _ftp_flush -- delete all messages in the queue
    function _ftp_flush($fctname){
        do {
            // check if there is data to read on the socket
            if(strlen($this->_sockbuf['control']))
                $changed=true;
            else {
                $read=array($this->stream);
                $changed=@socket_select($read,$write=NULL,$except=NULL,0);
                if($changed===false){
                    $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                    $this->connected=false;
                    return false;
                    }
                }

            // if there is data, then read (and ignore) one line
            if($changed){
                if($this->local_echo)                                       // Send local echo, for debugging.
                    echo $this->instance_id,') FLUSH : ';

                if(($buffer=$this->socket_read($fctname,$this->stream,'control'))===false){
                    $this->connected=false;
                    return false;
                    }

                if($this->local_echo){                                      // Send local echo, for debugging.
                    echo rtrim($buffer);
                    if(ini_get('html_errors'))
                        echo ' <br />';
                    echo "\n";
                    }
                }

            } while($changed);

        return true;
        }

    // _ftp_resp -- wait for the server response
    function _ftp_resp($fctname){
        $multiline=false;
        do {
            if($this->local_echo)                                       // Send local echo, for debugging.
                echo $this->instance_id,') GET : ';

            // read from socket (doesn't use socket_read because of bugs under Win32)
            if(($line=$this->socket_read($fctname,$this->stream,'control'))===false)
                return false;
            $line=rtrim($line,"\r\n");

            if($this->local_echo){                                      // Send local echo, for debugging.
                echo $line;
                if(ini_get('html_errors'))
                    echo ' <br />';
                echo "\n";
                }

            // if the 4th char is '-' then the response is multiline.
            if(($multiline===false) and preg_match('`^[0-9]{3}-`',$line))
                $multiline=array();

            // if multiline, then store data in a buffer
            if($multiline!==false)
                $multiline[]=preg_replace('`^[0-9]{3}[\\- ]`','',$line);

            } while (!preg_match('`^[0-9]{3} `',$line));

        // Return an associative array, with code and info
        return array(
            'code'=>(int)substr($line,0,3),
            'info'=>substr($line,4),
            'multiline'=>$multiline,
            );
        }

    // _ftp_check_resp -- check the server response
    function _ftp_check_resp($fctname,$wantedcode){
        if(($resp=$this->_ftp_resp($fctname))===false)
            return false;

        if(!is_array($wantedcode)){
            if($resp['code']==$wantedcode)
                return $resp;
            }
        elseif(in_array($resp['code'],$wantedcode))
            return $resp;

        $this->trigger_error($fctname,$resp['info'],__FILE__,__LINE__);
        return false;
        }

    // _ftp_datacnx_close -- close the socket for data transfer
    function _ftp_datacnx_close(){
        if($this->_datacnx!==false)
            @socket_close($this->_datacnx);
        if($this->_datacnx_copy!==false)
            @socket_close($this->_datacnx_copy);
        $this->_datacnx=false;
        $this->_datacnx_copy=false;
        $this->_sockbuf['data']='';
        $this->_sockbuf_last['data']='';
        }

    // _ftp_datacnx_xopen -- open the socket for data transfer
    function _ftp_datacnx_xopen(&$KFTP,$fctname){
        do{
            if($this->_pasv){
                $source=& $this;
                $dest=& $KFTP;
                }
            else {
                $source=& $KFTP;
                $dest=& $this;
                }

            if(($result=$source->_ftp_cmd('PASV',$fctname,227))===false){
                // if error on the other server, then copy error in current
                if(!$this->_pasv)
                    $this->trigger_error($fctname,$KFTP->last_error());
                return false;
                }

            $start=strpos($result['info'],'(');
            $end=strpos($result['info'],')',++$start);
            $addr=substr($result['info'],$start,$end-$start);

            if(($result=$dest->_ftp_cmd('PORT '.$addr,$fctname))===false)
                return false;

            if($result['code']!==200){
                if($this->_ftp_datacnx_toggle_pasv())
                    // if PASV toggled, then retry
                    continue;
                $this->trigger_error($fctname,$result['info'],__FILE__,__LINE__);
                return false;
                }

            return true;

            } while(true);
        }

    // _ftp_datacnx_open -- open the socket for data transfer
    function _ftp_datacnx_open($fctname){
        static $lastport=false;
        $this->_ftp_datacnx_close();

        // create socket
        $this->_datacnx=@socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
        if($this->_datacnx===false){
            $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
            return false;
            }
        if(function_exists('socket_set_option') and defined('SO_SNDTIMEO'))
            socket_set_option($this->_datacnx, SOL_SOCKET, SO_SNDTIMEO,
                array('sec'=>$GLOBALS['KFTP_Conf']['Connection_TimeOut'],
                    'usec'=>0));

        // if passive mode, just ask to the server where we've to connect
        if($this->_pasv){
            if(($result=$this->_ftp_cmd('PASV',$fctname,227))===false){
                $this->_ftp_datacnx_close();
                return false;
                }
            $start=strpos($result['info'],'(');
//            if($start===false) return false;
            $end=strpos($result['info'],')',++$start);
//            if($end===false) return false;
            $addr=explode(',',substr($result['info'],$start,$end-$start));
//            if(count($addr)!=6) return false;

            $this->_dataport=((int)$addr[4])<<8;
            $this->_dataport+=(int)$addr[5];
            unset($addr[4]);
            unset($addr[5]);
            $this->_dataip=implode('.',$addr);

            // try to connect
            if(@socket_connect($this->_datacnx,$this->_dataip,$this->_dataport)===false){
                $this->_ftp_datacnx_close();

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false){
                    $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                    return false;
                    }

                return $this->_ftp_datacnx_open($fctname);
                }
            }
        else {
        // normal mode, we have to create a listening socket and give addr to server

            /* ----------------
               To can specified a port range (for firewalling), we have to
               choose the port instead of bind() function.
               ---------------- */

            /* ---------------- We choose ports */

            // initialize starting port
            if($lastport===false)
                $lastport=mt_rand(KFTP_Force_MinPort,KFTP_Force_MaxPort);

            // try max 100 ports.
            $retry=100;
            $this->_dataport=$lastport;
            do {
                $result=@socket_bind($this->_datacnx,'0.0.0.0',$this->_dataport);

                if($result===false){
                    // if the error is "10048", then the port is actually used. so, change it
                    if(socket_last_error($this->_datacnx)===10048){
                        $this->_dataport++;
                        if($this->_dataport>KFTP_Force_MaxPort)
                            $this->_dataport=KFTP_Force_MinPort;
                        }
                    else break;
                    }

                } while($result===false and --$retry);

            if($result===false){
                    $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                    $this->_ftp_datacnx_close();
                    return false;
                    }

            $lastport=$this->_dataport;

//          This 2 lines are set to data port change each time
            if(++$lastport>KFTP_Force_MaxPort)
                $lastport=KFTP_Force_MinPort;

            if(@socket_listen($this->_datacnx)===false){
                $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

            /* ---------------- */


            /* ---------------- socket_bind() choose ports

            if(@socket_bind($this->_datacnx,'0.0.0.0')===false){
                $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

            if(@socket_listen($this->_datacnx)===false){
                $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

            if(@socket_getsockname($this->_datacnx,$ip,$this->_dataport)===false){
                $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

               ---------------- */

            $addr=str_replace('.',',',$this->_localip.','.($this->_dataport>>8).','.($this->_dataport & 0x00FF));

            if(($result=$this->_ftp_cmd('PORT '.$addr,$fctname))===false){
                $this->_ftp_datacnx_close();
                return false;
                }
            if($result['code']!==200){
                $this->_ftp_datacnx_close();

                // addr refused ? maybe a pasv problem we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false){
                    $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                    return false;
                    }

                // toggle pasv mode
                $this->_pasv=true;
                $this->_pasv_toggle=true;

                return $this->_ftp_datacnx_open($fctname);
                }
            }

        return true;
        }

    // _ftp_datacnx_wait -- wait for a connection on the socket
    function _ftp_datacnx_wait($fctname){
        if($this->_pasv)
            return $this->_datacnx;

        $read=array($this->_datacnx);
        $changed=@socket_select($read,$write=NULL,$except=NULL,$GLOBALS['KFTP_Conf']['Connection_TimeOut']);
        if($changed===false){
            $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
            return false;
            }
        elseif(!$changed){
            $this->trigger_error($fctname,'data connection timeout',__FILE__,__LINE__);
            return false;
            }

        $sock=@socket_accept($this->_datacnx);
        if($sock===false)
            $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
        else $this->_datacnx_copy=$sock;

        return $sock;
        }

    // _ftp_datacnx_toggle_pasv -- try to toggle PASV mode on error
    function _ftp_datacnx_toggle_pasv(){
        if(!KFTP_Auto_PASV_Switch or $this->_pasv_toggle){
            // if error and pasv toggled, then retrieve original pasv mode
            if($this->_pasv_toggle)
                $this->_pasv=(!$this->_pasv);
            return false;
            }
        // toggle pasv mode
        $this->_pasv=(!$this->_pasv);
        $this->_pasv_toggle=true;

        return true;
        }

    // socket_read -- replace socket_read which is buggy under Windows
    function socket_read ($fctname,& $stream, $type){
        if(!$stream)
            return false;

        if(!isset($this->_sockbuf[$type])){
            $this->_sockbuf[$type]='';
            $this->_sockbuf_last[$type]=$stream;
            }
        elseif($this->_sockbuf_last[$type]!==$stream){
            $this->_sockbuf[$type]='';
            $this->_sockbuf_last[$type]=$stream;
            }

        $out='';
        $len=strlen($this->_sockbuf[$type]);
        do {
            if(!$len){
                $this->_sockbuf[$type]=@socket_read($stream, 4096, PHP_BINARY_READ);
                if($this->_sockbuf[$type]===false){
                    $this->trigger_error($fctname,@$php_errormsg,__FILE__,__LINE__);
                    return false;
                    }
                $len=strlen($this->_sockbuf[$type]);
                if(!$len) return $out;
                }

            for($i=0;$i<$len;$i++) if($this->_sockbuf[$type]{$i}==="\n"){
                $out.=substr($this->_sockbuf[$type],0,$i);
                $this->_sockbuf[$type]=substr($this->_sockbuf[$type],$i+1);

                return $out;
                }
            $out.=$this->_sockbuf[$type];
            $len=0;

            } while(true);
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

/* TODO : SSL transfert */

            // create stream
            $this->stream=@socket_create(AF_INET,SOCK_STREAM,SOL_TCP);  // Creation du socket.
            if($this->stream===false){
                $this->trigger_error('connect',@$php_errormsg,__FILE__,__LINE__);
                return false;
                }
            if(function_exists('socket_set_option') and defined('SO_SNDTIMEO'))
                socket_set_option($this->stream, SOL_SOCKET, SO_SNDTIMEO,
                    array('sec'=>$GLOBALS['KFTP_Conf']['Connection_TimeOut'],
                        'usec'=>0));

            $this->connected=false;
            $this->_cwd=false;
            $this->_type=false;
            $result=false;
            // try to connect $retry times
            do {
                $result=@socket_connect($this->stream,$this->ip,$this->port);
                } while (!$result and --$retry);

            if(!$result){
                $error=@$php_errormsg;
                if(!$error) $error='can\'t connect';
                $this->trigger_error('connect',$error,__FILE__,__LINE__);
                return false;
                }
            elseif(KFTP_Force_LocalIP!==false)
                $this->_localip=KFTP_Force_LocalIP;
            elseif(@socket_getsockname($this->stream,$this->_localip,$port)===false){
                $this->trigger_error('connect',@$php_errormsg,__FILE__,__LINE__);
                return false;
                }

            if(!$this->_ftp_check_resp('connect',220))
                return false;
            }

        // try to identify
        $result=$this->_ftp_cmd('USER '.$this->login,'connect',array(230,331,332));
        if($result!==false){
            if($result['code']===331)
                $result=$this->_ftp_cmd('PASS '.$this->pass,'connect',array(230,202,232));
            elseif($result['code']===332)
                $result=$this->_ftp_cmd('ACCT '.$this->pass,'connect',array(230,202));
            }

        if($result===false){
            $this->connected=false;
            $this->stream=NULL;
            $this->_sockbuf['control']='';
            $this->_cwd=false;
            $this->_type=false;
            @socket_close($this->stream);
            return false;
            }

        // all is ok.
        $this->connected=true;
        return true;
        }

    // close -- Closes an FTP connection
    function close(){
        if($this->connected and $this->stream)
            $this->_ftp_cmd('QUIT','quit');
        $this->connected=false;
        $this->stream=NULL;
        $this->_sockbuf['control']='';
        $this->_cwd=false;
        $this->_type=false;
        return true;
        }

    // rein -- ReInit an FTP connection
    function rein(){
        return $this->_ftp_cmd('REIN','rein',220);
        }

    // pasv -- Turns passive mode on or off
    function pasv($mode){
        $this->_pasv=(bool)$mode;

        $this->_pasv_toggle=false;

        return true;
        }


// ----- Directories -----

    // pwd -- Returns the current directory name
    function pwd(){
        // this allow a small cache, to avoid multiple ask to the ftp server
        if($this->_cwd!==false)
            return $this->_cwd;

        if(($result=$this->_ftp_cmd('PWD','pwd',257))===false)
            return false;

        $i=strpos($result['info'],'"',1);
        if($i!==false)
            $this->_cwd=substr($result['info'],1,$i-1);

        return $this->_cwd;
        }

    // chdir -- Changes directories on a FTP server
    function chdir($path){
        // clear the PWD cache
        $this->_cwd=false;

        if(($result=$this->_ftp_cmd('CWD '.$path,'chdir',250))===false)
            return false;

        // some servers returns the new current path, so try to use it.
        $start=strpos($result['info'],'"',0);
        if($start!==false){
            $end=strpos($result['info'],'"',++$start);
            $this->_cwd=substr($result['info'],$start,1+$end-$start);
            }

        return true;
        }

    // cdup -- Changes to the parent directory
    function cdup(){
        // clear the PWD cache
        $this->_cwd=false;

        if(($result=$this->_ftp_cmd('CDUP','cdup',250))===false)
            return false;

        // some servers returns the new current path, so try to use it.
        $start=strpos($result['info'],'"',0);
        if($start!==false){
            $end=strpos($result['info'],'"',++$start);
            $this->_cwd=substr($result['info'],$start,1+$end-$start);
            }

        return true;
        }

    // mkdir -- Creates a directory
    function mkdir($path){
        if(($result=$this->_ftp_cmd('MKD '.$path,'mkdir',257))===false)
            return false;

        // some servers returns the created path, so try to use it.
        $res=true;
        $start=strpos($result['info'],'"',0);
        if($start!==false){
            $end=strpos($result['info'],'"',++$start);
            $res=substr($result['info'],$start,1+$end-$start);
            }

        return $res;
        }

    // rmdir -- Removes a directory
    function rmdir($path){
        if(($result=$this->_ftp_cmd('RMD '.$path,'rmdir',250))===false)
            return false;

        return true;
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

        $content=false;
        $retry=1;
        do {
            if($this->type(FTP_ASCII)===false)
                break;

            if($this->_ftp_datacnx_open('rawlist')===false)
                continue;

            $code=false;
            $valid_return_code=array(125,150);
            if($this->_rawlist_avoid_a===false){
                if(($result=$this->_ftp_cmd('LIST -a '.$path,'rawlist'))===false)
                    break;
                $code=$result['code'];
                }

            if($this->_rawlist_avoid_a!==false or $code===501){
                if(($result=$this->_ftp_cmd('LIST -a '.$path,'rawlist'))===false)
                    break;

                if($code and in_array($result['code'],$valid_return_code))
                    $this->_rawlist_avoid_a=true;
                }

            if(!in_array($result['code'],$valid_return_code)){
                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()){
                    // retry
                    ++$retry;
                    continue;
                    }
                }

            $sock=$this->_ftp_datacnx_wait('rawlist');
            if($sock===false){
                $this->_ftp_datacnx_close();

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()){
                    // retry
                    ++$retry;
                    continue;
                    }
                }
            else {
                $content=array();
                do{
                    if(($line=$this->socket_read('rawlist',$sock,'data'))===false){
                        $content=false;
                        break;
                        }
                    if($line!=='')
                        $content[]=$line;

                   } while ($line!=='');

                $this->_ftp_datacnx_close();

                $valide_codes=array(226,250);
                if(($result=$this->_ftp_resp('rawlist'))===false)
                    $content=false;
                elseif(!in_array($result['code'],$valide_codes)){
                    // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                    if($this->_ftp_datacnx_toggle_pasv()){
                        // retry
                        ++$retry;
                        continue;
                        }
                    $this->trigger_error('rawlist',$result['info'],__FILE__,__LINE__);
                    }
                }

            } while ($content===false and --$retry);

        if($olddir!==false)                                             // if we changed path, go to the old path.
            $this->chdir($olddir);

        return $content;
        }

    // get -- Downloads a file from the FTP server
    function get($local_file,$remote_file,$mode=FTP_BINARY,$resume_pos=0){

        do {
            $retry=false;

            // sends the type command.
            if($this->type($mode)===false)
                return false;

            // prepares the data socket
            if($this->_ftp_datacnx_open('get')===false){
                $this->_ftp_datacnx_close();

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                $retry=true;
                continue;
                }

            // we can't RESUME in ASCII mode.
            if($mode===FTP_ASCII)
                $resume_pos=0;
            else $resume_pos=(int)$resume_pos;

            if($resume_pos===0)
                $filemode='wb';
            else $filemode='ab';

            // Open local file.
            if(($fp=@fopen($local_file,$filemode))===false){
                $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

            // Sends the RESUME command.
            if($resume_pos and $this->_ftp_cmd('REST '.$resume_pos,'get',350)===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }

            // Sends the transfer instruction.
            if(($this->_ftp_cmd('RETR '.$remote_file,'get',array(125,150)))===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }

            // Waiting for data connection.
            if(($sock=$this->_ftp_datacnx_wait('get'))===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                $retry=true;
                continue;
                }

            // Transfer data.
            $disque_result=true;
            if($mode===FTP_ASCII){
                // FTP Ascii mode use CRLF end of line. So, no conversion needed for Windows.
                $needtrim=($GLOBALS['KFTP_Conf']['Local_OS']===KFTP_OS_Windows);
                if($needtrim){
                    $newline=$GLOBALS['KFTP_Conf']['New_Line'][$GLOBALS['KFTP_Conf']['Local_OS']];
                    $old_newline="\r\n";
                    }

                while($line=$this->socket_read('get',$sock,'data')){
                    if($needtrim)
                        $line=str_replace($old_newline,$newline,$line);

                    $disque_result=@fwrite($fp,$line);
                    if($disque_result===false){
                        $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
                        break;
                        }
                    }
                $transfert_result=!($line===false);
                }
            else {
                while($block=@socket_read($sock,4096,PHP_BINARY_READ)){
                    $disque_result=@fwrite($fp,$block);
                    if($disque_result===false){
                        $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
                        break;
                        }
                    }
                if($block===false){
                    $this->trigger_error('get',@$php_errormsg,__FILE__,__LINE__);
                    $transfert_result=false;
                    }
                  else $transfert_result=true;
                }
            // Closes the data connection.
            $this->_ftp_datacnx_close();
            @fclose($fp);

            $valide_codes=array(226,250);
            // if can't have server response, or
            if(($result=$this->_ftp_resp('get'))===false or $disque_result===false)
                return false;
            if(!in_array($result['code'],$valide_codes)){
                $this->trigger_error('get',$result['info'],__FILE__,__LINE__);
                $transfert_result=false;
                }
            if($transfert_result===false){
                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                // retry
                $retry=true;
                continue;
                }

            } while($retry);

        return true;
        }

    // put -- Uploads a file to the FTP server
    function put($remote_file,$local_file,$mode=FTP_BINARY,$resume_pos=0){

        do {
            $retry=false;

            // sends the type command.
            if($this->type($mode)===false)
                return false;

            // prepares the data socket
            if($this->_ftp_datacnx_open('put')===false){
                $this->_ftp_datacnx_close();

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                $retry=true;
                continue;
                }

            // we can't RESUME in ASCII mode.
            if($mode===FTP_ASCII)
                $resume_pos=0;
            else $resume_pos=(int)$resume_pos;

            // Open local file.
            if(($fp=@fopen($local_file,'rb'))===false){
                $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                return false;
                }

            if($resume_pos and @fseek($fp,$resume_pos)===-1){
                $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }


            /* ----------------
               To make resume upload, we can use REST+STOR or just APPE.

               In the FTP extension of PHP, REST+STOR are used... but
               FileZilla use APPE command.

               I choose the APPE method, which need only 1 command, but
               I keep here the syntaxe for the REST+STOR method.

               ---------------- */

            /* ---------------- Resume with the APPE method  */

            if($resume_pos)
                // Sends the RESUME command.
                $result=$this->_ftp_cmd('APPE'.$remote_file,'put',array(125,150));
                // Sends the transfer instruction.
            else $result=$this->_ftp_cmd('STOR '.$remote_file,'put',array(125,150));
            if($result===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }

            /* ---------------- */

            /* ---------------- Resume with the REST+STOR

            // Sends the RESUME command.
            if($resume_pos and $this->_ftp_cmd('REST '.$resume_pos,'put',350)===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }

            // Sends the transfer instruction.
            if(($this->_ftp_cmd('STOR '.$remote_file,'get',array(125,150)))===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);
                return false;
                }

               ---------------- */


            // Waiting for data connection.
            if(($sock=$this->_ftp_datacnx_wait('get'))===false){
                $this->_ftp_datacnx_close();
                @fclose($fp);

                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                $retry=true;
                continue;
                }

            // Transfer data.
            $disque_result=true;
            $transfert_result=true;
            if($mode===FTP_ASCII){
                // FTP Ascii mode use CRLF end of line. So, no conversion needed for Windows.
                $needtrim=($GLOBALS['KFTP_Conf']['Local_OS']===KFTP_OS_Windows);

                if($needtrim){
                    $newline=$GLOBALS['KFTP_Conf']['New_Line'][$GLOBALS['KFTP_Conf']['Local_OS']];
                    $old_newline="\r\n";
                    }

                while(!@feof($fp)){
                    $line=fgets($fp,4096);
                    if($line===false and !empty($php_errormsg)){
                        $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                        $disque_result=false;
                        break;
                        }
                    if($needtrim)
                        $line=str_replace($old_newline,$newline,$line);
                    if(($transfert_result=@socket_write($sock,$line))===false){
                        $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                        break;
                        }
                    }
                }
            else {
                while(!@feof($fp)){
                    $block=fread($fp,4096);
                    if($block===false and !empty($php_errormsg)){
                        $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                        $disque_result=false;
                        break;
                        }
                    if(($transfert_result=@socket_write($sock,$block))===false){
                        $this->trigger_error('put',@$php_errormsg,__FILE__,__LINE__);
                        break;
                        }
                    }
                }

            // Closes the data connection.
            $this->_ftp_datacnx_close();
            @fclose($fp);

            $valide_codes=array(226,250);
            // if can't have server response, or
            if(($result=$this->_ftp_resp('put'))===false or $disque_result===false)
                return false;
            if(!in_array($result['code'],$valide_codes)){
                $this->trigger_error('put',$result['info'],__FILE__,__LINE__);
                $transfert_result=false;
                }
            if($transfert_result===false){
                // can't connect ? maybe a pasv problem, we can try to toggle pasv status.
                if($this->_ftp_datacnx_toggle_pasv()===false)
                    return false;

                // retry
                $retry=true;
                continue;
                }

            } while($retry);

        return true;
        }

    // xget -- Transfer a file from an other FTP server to the actual FTP server
    function xget(& $KFTP,$local_file,$remote_file,$mode=FTP_BINARY, $resume_pos=0){
        do {
            $retry=false;

            // sends the type command.
            if($this->type($mode)===false)
                return false;
            if($KFTP->type($mode)===false)
                return false;

            // prepares the data socket
            if($this->_ftp_datacnx_xopen($KFTP,'xget')===false)
                return false;

            // we can't RESUME in ASCII mode.
            if($mode===FTP_ASCII)
                $resume_pos=0;
            else $resume_pos=(int)$resume_pos;


            // Sends the RESUME command.
            if($resume_pos and $KFTP->_ftp_cmd('REST '.$resume_pos,'get',350)===false)
                return false;

            // Sends the transfer instruction.
            if($resume_pos){
                if($this->_ftp_cmd('APPE '.$local_file,'xget',array(125,150))===false)
                    return false;
                }
            elseif($this->_ftp_cmd('STOR '.$local_file,'xget',array(125,150))===false)
                    return false;

            if($KFTP->_ftp_cmd('RETR '.$remote_file,'xget',array(125,150))===false)
                return false;

            // check the first response
            if(($result1=$KFTP->_ftp_resp('xget'))===false)
                return false;
            if(($result2=$this->_ftp_resp('xget'))===false)
                return false;

            $valide_codes=array(226,250);
            if(!in_array($result1['code'],$valide_codes) or !in_array($result2['code'],$valide_codes)){
                return false;
                }

            return true;

            } while(true);

        }

    // xput -- Transfer a file from the actual FTP server to an other FTP server
    function xput(& $KFTP,$remote_file,$local_file,$mode=FTP_BINARY, $resume_pos=0){
        do {
            $retry=false;

            // sends the type command.
            if($this->type($mode)===false)
                return false;
            if($KFTP->type($mode)===false)
                return false;

            // prepares the data socket
            if($this->_ftp_datacnx_xopen($KFTP,'xget')===false)
                return false;

            // we can't RESUME in ASCII mode.
            if($mode===FTP_ASCII)
                $resume_pos=0;
            else $resume_pos=(int)$resume_pos;


            // Sends the RESUME command.
            if($resume_pos and $this->_ftp_cmd('REST '.$resume_pos,'get',350)===false)
                return false;

            // Sends the transfer instruction.
            if($resume_pos){
                if($KFTP->_ftp_cmd('APPE '.$local_file,'xget',array(125,150))===false)
                    return false;
                }
            elseif($KFTP->_ftp_cmd('STOR '.$local_file,'xget',array(125,150))===false)
                    return false;

            if($this->_ftp_cmd('RETR '.$remote_file,'xget',array(125,150))===false)
                return false;

            // check the first response
            if(($result1=$this->_ftp_resp('xget'))===false)
                return false;
            if(($result2=$KFTP->_ftp_resp('xget'))===false)
                return false;

            $valide_codes=array(226,250);
            if(!in_array($result1['code'],$valide_codes) or !in_array($result2['code'],$valide_codes)){
                return false;
                }

            return true;

            } while(true);
        }

// ----- Files -----

    // rename -- Renames a file on the FTP server
    function rename($from,$to){
        if(($result=$this->_ftp_cmd('RNFR '.$from,'rename',350))===false)
            return false;
        if(($result=$this->_ftp_cmd('RNTO '.$to  ,'rename',250))===false)
            return false;

        return true;
        }

    // move -- Move a file on the FTP server -- alias for rename()
    function move($from,$to){
        return $this->rename($from,$to);
        }

    // delete -- Deletes a file on the FTP server
    function delete($file){
        if(($result=$this->_ftp_cmd('DELE '.$file,'delete',250))===false)
            return false;

        return true;
        }

    // mdtm -- Returns the last modified time of the given file
    function mdtm($file){
        if(($result=$this->_ftp_cmd('MDTM '.$file,'mdtm',213))===false)
            return false;

        $timestamp=$result['info'];
        if(preg_match('`^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})?$`',$result['info'],$match)){
            $year=$match[1];
            $month=$match[2];
            $day=$match[3];
            $hour=$match[4];
            $minute=$match[5];
            $second=0;
            if(!empty($match[6]))
                $second=$match[6];
            return @mktime($hour, $minute, $second, $month, $day, $year);
            }

        return $result['info'];
        }

    // size -- Returns the size of the given file
    function size($file){
        if(($result=$this->_ftp_cmd('SIZE '.$file,'size',213))===false)
            return false;

        return $result['info'];
        }

    // chmod -- Changes file mode
    function chmod($file,$mode){
        if(($result=$this->_ftp_cmd('SITE CHMOD '.$mode.' '.$file,'chmod',200))===false)
            return false;

        return true;
        }

// ----- Other FTP commands-----

    // systype -- Returns the system type identifier of the remote FTP server
    function systype(){
        if(($result=$this->_ftp_cmd('SYST','systype',215))===false)
            return false;

        return trim($result['info']);
        }

    // exec -- Requests execution of a program on the FTP server
    function exec($command){
        if(($result=$this->_ftp_cmd('SITE EXEC '.$command,'exec',array(200,202)))===false)
            return false;

        return $result;
        }

    // site -- Sends a SITE command to the server
    function site($command){
        if(($result=$this->_ftp_cmd('SITE '.$command,'site'))===false)
            return false;

        if($result['code'] < 200 or $result['code'] >= 300){
            $this->trigger_error('site',$result['info'],__FILE__,__LINE__);
            return false;
            }

        return $result;
        }

    // type -- change transfer type
    function type($type){

        if($type===FTP_ASCII)
            $arg='A';
        elseif($type===FTP_BINARY)
            $arg='I';
        else {
            $this->trigger_error('type','this is not a valid transfer mode',__FILE__,__LINE__);
            return false;
            }

        // same type as last operation ? so skip it
        if($this->_type===$type and KFTP_Remember_Transfert_Type)
            return true;

        $this->_type=false;

        if(($result=$this->_ftp_cmd('TYPE '.$arg,'type',200))===false)
            return false;

        $this->_type=$type;
        return true;
        }

    // must_break_idle -- Do a FTP command to reset idle time
    function must_break_idle(){
        $rand=time()%4;

        if($rand===0)
            $this->_ftp_cmd('PWD','must_break_idle');
        elseif($rand===1)
            $this->_ftp_cmd('CWD .','must_break_idle');
        elseif($rand===2)
            $this->_ftp_cmd('REST 0','must_break_idle');
        else $this->_ftp_cmd('NOOP','must_break_idle');

        return true;
        }

// ----- Errors -----

    // trigger_error -- Generates an error
    function trigger_error($fct, $msg, $file, $line){
        $msg=trim(preg_replace('`^[a-zA-Z_]+\\(\\):? *`','',$msg));
        if(!$msg) $msg='unknown error';
        $msg.=' in '.basename($file).' line '.$line;

        $this->_last_error='KFTP->'.$fct.'(): '.$msg;
        trigger_error($this->_last_error, E_USER_WARNING);
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

    }
// ----- END -----

?>