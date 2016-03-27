<?php
/**
 * @file   Generate.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc;

require_once(__DIR__.'/cnf/ctrl.php');

/*** class ***/
class Generate extends ExtFunc implements InfFunc
{
    private $target    = null;
    private $output    = null;
    private $config    = null;
    private $log       = null;
    private $cnf_obj   = null;
    
    /**
     * set member
     *
     * @param $op : (string) option
     * @param $cf : (string) config
     * @param $lg : (bool)   log
     */
    function __construct( $op, $cf, $lg ) {
        try {
            $this->output  = $op;
            $this->config  = $cf;
            $this->log     = $lg;
            $this->chkVal();
            $this->cnf_obj = cnf\read( $this->config ); 
        } catch (\errComErr $ce) {
            $ce->showConts($this->getCallType());
            exit();
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * check member value
     */
    private function chkVal()
    {
        try {
            if ( null === $this->output ) {
                /* fnc-3-3 : default output is current */
                $this->output = getcwd();
            }
            if ( 0 === strpos( $this->output, '.' ) ) {
                $this->output = getcwd().'/'.$this->output;
            }
            if ( strlen($this->output) !== strpos( $this->output, '\\' ) ) {
                $this->output .= '/';
            }
            
            if ( false === is_dir( $this->output ) ) {
                /* fnc-3-2 : output must exists directory path */
                throw new \err\ComErr( 
                              'output is not directory.'.PHP_EOL.
                              '        -> '.$this->output
                          );
            }
            if ( false === is_file( $this->config ) ) {
                /* fnc-3-4 : config must exists file path */
                throw new \err\ComErr( 'config('.$this->config.') is not file.' );
            }
        } catch ( \err\ComErr $err ) {
            $err->showConts( $this->getCallType() );
            exit();
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * execute Generate function
     * 
     * @brief generate routing
     */
    public function exec() {
        try {
            /* check auth */
            if( false === is_writable( $this->getOutput() ) ) {
                throw new \err\CcomErr( 'output directory is not writable' );
            }
            $cnf = yaml_parse_file( 
                       __DIR__ . DIRECTORY_SEPARATOR . 
                      '..' .  DIRECTORY_SEPARATOR . 
                      '..' .  DIRECTORY_SEPARATOR . 
                      '..' .  DIRECTORY_SEPARATOR . 
                      'cnf' . DIRECTORY_SEPARATOR . 
                      'conf.yml' );
            /* check source type */
            if(false === array_key_exists ( 'srctype', $cnf )) {
                throw new \err\ComErr('invalid trut config : could not find srctype');
            }
            if(false === file_exists(
                             __DIR__ . DIRECTORY_SEPARATOR .
                            'gen'    . DIRECTORY_SEPARATOR . $cnf['srctype'])) {
                throw new \err\ComErr('invalid trut config : invalid srctype value('.$cnf['srctype'].')');
            }
            /* check algorithm */
            if(false === array_key_exists('algo', $cnf) ) {
                throw new \err\ComErr('invalid trut config : could not find algo');
            }
            if(false === file_exists(
                             __DIR__ . DIRECTORY_SEPARATOR . 
                             'gen'   . DIRECTORY_SEPARATOR . 
                             $cnf['srctype'] . DIRECTORY_SEPARATOR . 
                             $cnf['algo'])) {
                throw new \err\ComErr('invalid trut config : '.$cnf['algo'].' is not installed');
            }
            $clname =  '\\fnc\\gen\\' . $cnf['srctype'] . '\\' . $cnf['algo'] . '\\' . $cnf['algo'];
            $gen    = new $clname( $this );
            $gen->startGen();
        } catch ( \err\ComErr $err ) {
            $err->showConts($this->getCallType());
            exit();
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
  
    /**
     * get config object
     * 
     * @return config object
     */
    public function getCnfObj() {
        try {
            if( null === $this->cnf_obj ) {
                throw new \Exception('null config object');
            }
            return $this->cnf_obj;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
  
    /**
     * get output directory
     * 
     * @return (string) path to output directory 
     */
    public function getOutput() {
        try {
            if( null === $this->output ) {
                throw new \Exception('null config object');
            }
            return $this->output;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}
/* end of file */
