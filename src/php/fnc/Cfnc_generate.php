<?php
/**
 * @file   Cfnc_front.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc;

/*** require ***/
require_once( dirname(__FILE__).'/Ifnc_exec.php' );
require_once( dirname(__FILE__).'/Cfnc_exec.php' );
require_once( dirname(__FILE__).'/../err/Ccmd_comErr.php' );
require_once( dirname(__FILE__).'/cnf/Scnf_ctrl.php' );
require_once( dirname(__FILE__).'/gen/Sgen_func.php' );
//require_once( dirname(__FILE__).'/../../ctl/Sctl_func.php' );

/*** class ***/
class Cgenerate extends Cfnc_exec implements Ifnc_exec {
  private $target    = null;
  private $output    = null;
  private $config    = null;
  private $log       = null;
  private $cnf_obj   = null;
  
  /**
   * @fn    __construct
   * @brief set member
   * @param (string) option
   * @param (string) config
   * @param (bool)   log
   */
  function __construct( $op, $cf, $lg ) {
    try {
      $this->output  = $op;
      $this->config  = $cf;
      $this->log     = $lg;
      $this->chkVal();
      $this->cnf_obj = cnf\read( $this->config ); 
    } catch( \Exception $e ) {
      throw new \Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  /**
   * @fn    chkVal
   * @brief check member value
   */
  private function chkVal() {
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
            throw new \err\CcomErr( 
                          'output is not directory.'.PHP_EOL.
                          '        -> '.$this->output
                      );
        }
        if ( false === is_file( $this->config ) ) {
            /* fnc-3-4 : config must exists file path */
            throw new \err\CcomErr( 'config is not file.'.PHP_EOL );
        }
    } catch ( \err\CcomErr $err ) {
      $err->showConts();
      exit();
    } catch( \Exception $e ) {
      throw new \Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  /**
   * @fn    exec
   * @brief generate routing
   */
  public function exec() {
    try {
      /* fnc-3-3 : pre-check generate */
      gen\preCheck( $this );
      
      /* fnc-3-4 : generate controller */
      gen\rotCtrl( $this );

      /* fnc-3-5 : generate group */
      while( null !== ($grp = $this->cnf_obj->getNextGrp()) ) {
          if (0 === strcmp($grp, '__any__')) {
              gen\anyGrp( $this->output, $this->cnf_obj );
          } else {
              gen\rotGrp( $grp, $this->output, $this->cnf_obj );
          }
      }
    } catch ( \err\CcomErr $err ) {
        $err->showConts();
        exit(-1);
    } catch( \Exception $e ) {
        throw new \Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
        );
    }
  }
  
  /**
   * @fn     getCnfObj
   * @brief  get config object
   * @return config object
   */
  public function getCnfObj() {
    try {
      if( null === $this->cnf_obj ) {
        throw new \Exception('null config object');
      }
      return $this->cnf_obj;
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  /**
   * @fn     getOutput
   * @brief  get output directory
   * @return (string) path to output directory 
   */
  public function getOutput() {
    try {
      if( null === $this->output ) {
        throw new Exception('null config object');
      }
      return $this->output;
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
}

/* end of file */
