<?php

/**
* Fast, light and safe Cache Class
*
* Cache_Lite is a fast, light and safe cache system. It's optimized
* for file containers. It is fast and safe (because it uses file
* locking and/or anti-corruption tests).
*
* There are some examples in the 'docs/examples' file
* Technical choices are described in the 'docs/technical' file
*
* A tutorial is available in english at this url :
* http://www.pearfr.org/index.php/en/article/cache_lite
* (big thanks to Pierre-Alain Joye for the translation)
*
* The same tutorial is also available in french at this url :
* http://www.pearfr.org/index.php/fr/article/cache_lite
*
* Memory Caching is from an original idea of
* Mike BENOIT <ipso@snappymail.ca>
*
* @package Cache_Lite
* @category Caching
* @version $Id: Lite.php 1878 2008-01-25 21:26:29Z datahell $
* @author Fabien MARTY <fab@php.net>
*/

define('CACHE_LITE_ERROR_RETURN', 1);
define('CACHE_LITE_ERROR_DIE', 8);

class Cache_Lite
{

    // --- Private properties ---

    /**
    * Directory where to put the cache files
    * (make sure to add a trailing slash)
    *
    * @private string $_cacheDir
    */
    private $_cacheDir = '/tmp/';

    /**
    * Enable / disable caching
    *
    * (can be very usefull for the debug of cached scripts)
    *
    * @private boolean $_caching
    */
    private $_caching = true;

    /**
    * Cache lifetime (in seconds)
    *
    * @private int $_lifeTime
    */
    private $_lifeTime = 3600;

    /**
    * Enable / disable fileLocking
    *
    * (can avoid cache corruption under bad circumstances)
    *
    * @private boolean $_fileLocking
    */
    private $_fileLocking = true;

    /**
    * Timestamp of the last valid cache
    *
    * @private int $_refreshTime
    */
    private $_refreshTime;

    /**
    * File name (with path)
    *
    * @private string $_file
    */
    private $_file;

    /**
    * Enable / disable write control (the cache is read just after writing to detect corrupt entries)
    *
    * Enable write control will lightly slow the cache writing but not the cache reading
    * Write control can detect some corrupt cache files but maybe it's not a perfect control
    *
    * @private boolean $_writeControl
    */
    private $_writeControl = true;

    /**
    * Enable / disable read control
    *
    * If enabled, a control key is embeded in cache file and this key is compared with the one
    * calculated after the reading.
    *
    * @private boolean $_writeControl
    */
    private $_readControl = true;

    /**
    * Type of read control (only if read control is enabled)
    *
    * Available values are :
    * 'md5' for a md5 hash control (best but slowest)
    * 'crc32' for a crc32 hash control (lightly less safe but faster, better choice)
    * 'strlen' for a length only test (fastest)
    *
    * @private boolean $_readControlType
    */
    private $_readControlType = 'crc32';

    /**
    * Pear error mode (when raiseError is called)
    *
    * (see PEAR doc)
    *
    * @see setToDebug()
    * @private int $_pearErrorMode
    */
    private $_pearErrorMode = CACHE_LITE_ERROR_RETURN;
    
    /**
    * Current cache id
    *
    * @private string $_id
    */
    private $_id;

    /**
    * Current cache group
    *
    * @private string $_group
    */
    private $_group;

    /**
    * Enable / Disable "Memory Caching"
    *
    * NB : There is no lifetime for memory caching ! 
    *
    * @private boolean $_memoryCaching
    */
    private $_memoryCaching = false;

    /**
    * Enable / Disable "Only Memory Caching"
    * (be carefull, memory caching is "beta quality")
    *
    * @private boolean $_onlyMemoryCaching
    */
    private $_onlyMemoryCaching = false;

    /**
    * Memory caching array
    *
    * @private array $_memoryCachingArray
    */
    private $_memoryCachingArray = array();

    /**
    * Memory caching counter
    *
    * @private int $memoryCachingCounter
    */
    private $_memoryCachingCounter = 0;

    /**
    * Memory caching limit
    *
    * @private int $memoryCachingLimit
    */
    private $_memoryCachingLimit = 1000;
    
    /**
    * File Name protection
    *
    * if set to true, you can use any cache id or group name
    * if set to false, it can be faster but cache ids and group names
    * will be used directly in cache file names so be carefull with
    * special characters...
    *
    * @private boolean $fileNameProtection
    */
    public $_fileNameProtection = true;
    
    /**
    * Enable / disable automatic serialization
    *
    * it can be used to save directly datas which aren't strings
    * (but it's slower)    
    *
    * @private boolean $_serialize
    */
    private $_automaticSerialization = false;

    /**
    * Cached Language
    *
    * @private string $_cacheLang
    */
    private $_cacheLang = ''; //Elxis Team addition

    // --- Public methods ---

    /**
    * Constructor
    *
    * $options is an assoc. Available options are :
    * $options = array(
    *     'cacheDir' => directory where to put the cache files (string),
    *     'caching' => enable / disable caching (boolean),
    *     'lifeTime' => cache lifetime in seconds (int),
    *     'fileLocking' => enable / disable fileLocking (boolean),
    *     'writeControl' => enable / disable write control (boolean),
    *     'readControl' => enable / disable read control (boolean),
    *     'readControlType' => type of read control 'crc32', 'md5', 'strlen' (string),
    *     'pearErrorMode' => pear error mode (when raiseError is called) (cf PEAR doc) (int),
    *     'memoryCaching' => enable / disable memory caching (boolean),
    *     'onlyMemoryCaching' => enable / disable only memory caching (boolean),
    *     'memoryCachingLimit' => max nbr of records to store into memory caching (int),
    *     'fileNameProtection' => enable / disable automatic file name protection (boolean),
    *     'automaticSerialization' => enable / disable automatic serialization (boolean),
    *     'cacheLang' => cached language, added by Ioannis Sannos (Elxis Team)
    * );
    *
    * @param array $options options
    * @access public
    */
    public function Cache_Lite($options = array(NULL))
    {
        $availableOptions = array('cacheLang', 'automaticSerialization', 'fileNameProtection', 'memoryCaching', 'onlyMemoryCaching', 'memoryCachingLimit', 'cacheDir', 'caching', 'lifeTime', 'fileLocking', 'writeControl', 'readControl', 'readControlType', 'pearErrorMode');
        foreach($options as $key => $value) {
            if(in_array($key, $availableOptions)) {
                $property = '_'.$key;
                $this->$property = $value;
            }
        }
        $this->_refreshTime = time() - $this->_lifeTime;
    }
    
    /**
    * Test if a cache is available and (if yes) return it
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
    * @return string data of the cache (or false if no cache available)
    * @access public
    */
    public function get($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        $this->_id = $id;
        $this->_group = $group;
        $data = false;
        if ($this->_caching) {
            $this->_setFileName($id, $group);
            if ($this->_memoryCaching) {
                if (isset($this->_memoryCachingArray[$this->_file])) {
                    if ($this->_automaticSerialization) {
                        return unserialize($this->_memoryCachingArray[$this->_file]);
                    } else {
                        return $this->_memoryCachingArray[$this->_file];
                    }
                } else {
                    if ($this->_onlyMemoryCaching) {
                        return false;
                    }
                }
            }
            if ($doNotTestCacheValidity) {
                if (file_exists($this->_file)) {
                    $data = $this->_read();
                }
            } else {
                if (file_exists($this->_file) && (@filemtime($this->_file) > $this->_refreshTime)) {
                    $data = $this->_read();
                }
            }
            if (($data) and ($this->_memoryCaching)) {
                $this->_memoryCacheAdd($this->_file, $data);
            }
            if (($this->_automaticSerialization) and (is_string($data))) {
                $data = unserialize($data);
            }
            return $data;
        }
        return false;
    }
    
    /**
    * Save some data in a cache file
    *
    * @param string $data data to put in cache (can be another type than strings if automaticSerialization is on)
    * @param string $id cache id
    * @param string $group name of the cache group
    * @return boolean true if no problem
    * @access public
    */
    public function save($data, $id = NULL, $group = 'default')
    {
        if ($this->_caching) {
            if ($this->_automaticSerialization) {
                $data = serialize($data);
            }
            if (isset($id)) {
                $this->_setFileName($id, $group);
            }
            if ($this->_memoryCaching) {
                $this->_memoryCacheAdd($this->_file, $data);
                if ($this->_onlyMemoryCaching) {
                    return true;
                }
            }
            if ($this->_writeControl) {
                if (!$this->_writeAndControl($data)) {
                    @touch($this->_file, time() - 2*abs($this->_lifeTime));
                    return false;
                } else {
                    return true;
                }
            } else {
                return $this->_write($data);
            }
        }
        return false;
    }

    /**
    * Remove a cache file
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @return boolean true if no problem
    * @access public
    */
    public function remove($id, $group = 'default')
    {
        $this->_setFileName($id, $group);
        if (!@unlink($this->_file)) {
            $this->raiseError('Cache_Lite : Unable to remove cache !', -3);   
            return false;
        }
        return true;
    }

    /**
    * Clean the cache
    *
    * if no group is specified all cache files will be destroyed
    * else only cache files of the specified group will be destroyed
    *
    * @param string $group name of the cache group
    * @return boolean true if no problem
    * @access public
    */
    public function clean($group = false)     
    {
        if ($this->_fileNameProtection) {
            $motif = ($group) ? 'cache_'.md5($group).'_' : 'cache_';
        } else {
            $motif = ($group) ? 'cache_'.$group.'_' : 'cache_';
        }
        if ($this->_memoryCaching) {
            while (list($key, $value) = each($this->_memoryCaching)) {
                if (strpos($key, $motif, 0)) {
                    unset($this->_memoryCaching[$key]);
                    $this->_memoryCachingCounter = $this->_memoryCachingCounter - 1;
                }
            }
            if ($this->_onlyMemoryCaching) {
                return true;
            }
        }
        if (!($dh = opendir($this->_cacheDir))) {
            $this->raiseError('Cache_Lite : Unable to open cache directory !', -4);
            return false;
        }
        while ($file = readdir($dh)) {
            if (($file != '.') && ($file != '..')) {
                $file = $this->_cacheDir . $file;
                if (is_file($file)) {
                    if (strpos($file, $motif, 0)) {
                        if (!@unlink($file)) {
                            $this->raiseError('Cache_Lite : Unable to remove cache !', -3);
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }
    
    /**
    * Set to debug mode
    *
    * When an error is found, the script will stop and the message will be displayed
    * (in debug mode only).
    *
    * @access public
    */
    public function setToDebug()
    {
        $this->_pearErrorMode = CACHE_LITE_ERROR_DIE;
    }

    /**
    * Set a new life time
    *
    * @param int $newLifeTime new life time (in seconds)
    * @access public
    */
    public function setLifeTime($newLifeTime)
    {
        $this->_lifeTime = $newLifeTime;
        $this->_refreshTime = time() - $newLifeTime;
    }

    /**
    *
    * @access public
    */
    public function saveMemoryCachingState($id, $group = 'default')
    {
        if ($this->_caching) {
            $array = array(
                'counter' => $this->_memoryCachingCounter,
                'array' => $this->_memoryCachingState
            );
            $data = serialize($array);
            $this->save($data, $id, $group);
        }
    }

    /**
    *
    * @access public
    */
    public function getMemoryCachingState($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        if ($this->_caching) {
            if ($data = $this->get($id, $group, $doNotTestCacheValidity)) {
                $array = unserialize($data);
                $this->_memoryCachingCounter = $array['counter'];
                $this->_memoryCachingArray = $array['array'];
            }
        }
    }
    
    /**
    * Return the cache last modification time
    *
    * BE CAREFUL : THIS METHOD IS FOR HACKING ONLY !
    *
    * @return int last modification time
    */
    function lastModified() {
        return filemtime($this->_file);
    }
    
    /**
    * Trigger a PEAR error
    *
    * To improve performances, the PEAR.php file is included dynamically.
    * The file is so included only when an error is triggered. So, in most
    * cases, the file isn't included and perfs are much better.
    *
    * @param string $msg error message
    * @param int $code error code
    * @access public
    */
    public function raiseError($msg, $code) {
    	global $mainframe;
        include_once($mainframe->getCfg('absolute_path').'/includes/PEAR/PEAR.php');
        PEAR::raiseError($msg, $code, $this->_pearErrorMode);
    }

    // --- Private methods ---

    /**
    *
    * @access private
    */
    private function _memoryCacheAdd($id, $data)
    {
        $this->_memoryCachingArray[$this->_file] = $data;
        if ($this->_memoryCachingCounter >= $this->_memoryCachingLimit) {
            list($key, $value) = each($this->_memoryCachingArray);
            unset($this->_memoryCachingArray[$key]);
        } else {
            $this->_memoryCachingCounter = $this->_memoryCachingCounter + 1;
        }
    }

    /**
    * Make a file name (with path)
    *
    * @param string $id cache id
    * @param string $group name of the group
    * @access private
    */
    private function _setFileName($id, $group)
    {
        if ($this->_fileNameProtection) {
            $this->_file = ($this->_cacheDir.'cache_'.md5($group).'_'.md5($id.$this->_cacheLang));
        } else {
            $this->_file = $this->_cacheDir.'cache_'.$group.'_'.$id.$this->_cacheLang;
        }
    }
    
    /**
    * Read the cache file and return the content
    *
    * @return string content of the cache file
    * @access private
    */
    private function _read()
    {
        $fp = @fopen($this->_file, "rb");
        if ($this->_fileLocking) @flock($fp, LOCK_SH);
        if ($fp) {
            clearstatcache(); // because the filesize can be cached by PHP itself...
            $length = @filesize($this->_file);
            $mqr = get_magic_quotes_runtime();
            set_magic_quotes_runtime(0);
            if ($this->_readControl) {
                $hashControl = @fread($fp, 32);
                $length = $length - 32;
            } 
            $data = @fread($fp, $length);
            set_magic_quotes_runtime($mqr);
            if ($this->_fileLocking) @flock($fp, LOCK_UN);
            @fclose($fp);
            if ($this->_readControl) {
                $hashData = $this->_hash($data, $this->_readControlType);
                if ($hashData != $hashControl) {
                    @touch($this->_file, time() - 2*abs($this->_lifeTime)); 
                    return false;
                }
            }
            return $data;
        }
        $this->raiseError('Cache_Lite : Unable to read cache !', -2);
        return false;
    }
    
    /**
    * Write the given data in the cache file
    *
    * @param string $data data to put in cache
    * @return boolean true if ok
    * @access private
    */
    private function _write($data)
    {
        $fp = @fopen($this->_file, "wb");
        if ($fp) {
            if ($this->_fileLocking) @flock($fp, LOCK_EX);
            if ($this->_readControl) {
                @fwrite($fp, $this->_hash($data, $this->_readControlType), 32);
            }
            $len = strlen($data);
            @fwrite($fp, $data, $len);
            if ($this->_fileLocking) @flock($fp, LOCK_UN);
            @fclose($fp);
            return true;
        }
        $this->raiseError('Cache_Lite : Unable to write cache !', -1);
        return false;
    }
    
    /**
    * Write the given data in the cache file and control it just after to avoir corrupted cache entries
    *
    * @param string $data data to put in cache
    * @return boolean true if the test is ok
    * @access private
    */
    private function _writeAndControl($data)
    {
        $this->_write($data);
        $dataRead = $this->_read($data);
        return ($dataRead==$data);
    }
    
    /**
    * Make a control key with the string containing datas
    *
    * @param string $data data
    * @param string $controlType type of control 'md5', 'crc32' or 'strlen'
    * @return string control key
    * @access private
    */
    private function _hash($data, $controlType)
    {
        switch ($controlType) {
        case 'md5':
            return md5($data);
        case 'crc32':
            return sprintf('% 32d', crc32($data));
        case 'strlen':
            return sprintf('% 32d', strlen($data));
        default:
            $this->raiseError('Unknown controlType ! (available values are only \'md5\', \'crc32\', \'strlen\')', -5);
        }
    }
    
} 

?>
