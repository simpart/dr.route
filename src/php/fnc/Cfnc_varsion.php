<?php
/**
 * @file   Cfnc_varsion.php
 * @brief  show varsion
 * @author simpart
 * @note   MIT License
 */
namespace fnc;

/*** require ***/
require_once( dirname(__FILE__).'/Ifnc_exec.php' );
require_once( dirname(__FILE__).'/Cfnc_exec.php' );

/*** class ***/
class Cvarsion extends Cfnc_exec implements Ifnc_exec {
  /**
   * @fn exec
   * @brief show varsion
   */
  public function exec() {
    try {
      if( 0 === strcmp( DFNC_TYPE_CLI, $this->call_type ) ) {
        /* fnc-1 : show varsion */
        echo 'Trut varsion 0.1 (beta)'.PHP_EOL;
        echo 'Copyright (c) 2016 simpart'.PHP_EOL;
      }
    } catch( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
}

/* end of file */
