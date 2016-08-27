<?php
/**
 * @file   Generate.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\gen;

/*** require ***/
require_once(
    __DIR__ . DIRECTORY_SEPARATOR . 
    '..'    . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 
    'com'   . DIRECTORY_SEPARATOR . 
    'file'  . DIRECTORY_SEPARATOR . 
    'file.php');

/*** class ***/
class Generate extends \fnc\rle\ExtFunc implements \fnc\rle\InfFunc
{
    private $target = null;
    private $out    = null;
    private $help   = false;
    private $cnf    = null;
    
    /**
     * execute Generate function
     * 
     * @brief generate routing
     */
    public function exec() {
        try {
            if(true === $this->help) {
                /* show help of 'spac gen' */
                $this->help();
                return;
            }
            if (null === $this->getOutput()) {
                /* deafult output directory is current */
                $this->setOutput( getcwd() );
            }
            $this->chkOutputEmpty( $this->getOutput() );
            $gen = $this->getAlgo();
            $gen->generate();
        } catch ( \Exception $e ) {
            throw $e;
        }
    }
    
    private function chkOutputEmpty( $output ) {
        try {
            $odir = scandir( $output );
            if (2 < count($odir)) {
                echo 'file or directory exists in the directory.'.PHP_EOL;
                echo 'Are you sure you want to delete the directory contents?(y,n):';
                $line = rtrim(fgets(STDIN), "\n");
                if (!((0 === strcmp($line, 'y')) ||
                      (0 === strcmp($line, 'Y'))) ) {
                    exit;
                }
            }
            delDirConts( $output );
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    private function getAlgo() {
        try {
            /* load config from (spac directory)/conf/module.yml */
            $mod_cnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
            if (false === $mod_cnf) {
                throw new \err\gen\GenErr(
                    'could not read module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            foreach ($mod_cnf as $elm) {
                if ( true === $elm['select'] ) {
                     //return new SesRot\SesRot();
                     $clname = "mod\\" . $elm['name'] . "\\src\\" . $elm['name'];
                     return new $clname($this->cnf, $this);
                }
            }
            throw new \Exception();
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    /**
     * get output directory
     * 
     * @return (string) path to output directory 
     */
    public function getOutput() {
        try {
            if (null !== $this->out) {
                $tail = substr($this->out, strlen($this->out)-1);
                if (0 !== strcmp($tail, DIRECTORY_SEPARATOR)) {
                    return $this->out . DIRECTORY_SEPARATOR;
                }
            }
            return $this->out;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * set help flag
     * 
     * @param $flg : (bool) set enable help property
     */
    public function setHelpFlg($flg) {
        try {
            $this->help = $flg;
        } catch (\Exception $e) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * show help
     */
    private function help() {
        try {
            /*  */
            echo 'Usage : spac gen [-h] | <cnf> [opt]'.PHP_EOL;
            echo '          -h          : \'spac gen\' help'.PHP_EOL;
            echo '          <cnf>       : path to config file'.PHP_EOL;
            echo '          [opt]       : option'.PHP_EOL;
            echo '            -o <path> : output destination directory path'.PHP_EOL;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * set path to config file
     * 
     * @param $cnf : (string) path to config file
     */
    public function setConf($cnf) {
        try {
            /* could not find path to config file */
            if (true !== file_exists($cnf)) {
                throw new \err\gen\GenErr(
                    'could not find ' . $cnf . ' file',
                    'please specify file that is exists'
                );
            }
            $ftype = filetype($cnf); 
            if (0 !== strcmp($ftype, 'file')) {
                throw new \err\gen\GenErr(
                    'could not find ' . $cnf . ' file',
                    'please specify file that is exists'
                );
            }
            $this->cnf = yaml_parse_file($cnf);
            if (false === $this->cnf) {
                throw new \err\gen\GenErr(
                    'specified file is not yaml type',
                    'please check config file'
                );
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function getConf() {
        try {
            return $this->cnf;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function setOutput($out) {
        try {
            if (true !== file_exists($out)) {
                throw new \err\gen\GenErr(
                    'could not find ' . $out . ' directory',
                    'please specify directory that is exists'
                );
            }
            $ftype = filetype($out);
            if (0 !== strcmp($ftype, 'dir')) {
                throw new \err\gen\GenErr(
                    'could not find ' . $out . ' directory',
                    'please specify directory that is exists'
                );
            }
            if( false === is_writable( $out ) ) {
                throw new \err\gen\GenErr( 
                    'output directory is not writable',
                    'please check output directory'
                );
            }
            $this->out = $out;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
