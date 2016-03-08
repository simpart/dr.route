<?php
/**
 * @file   Cfnc_help.php
 * @brief  show cli usage
 * @author simpart
 * @note   MIT License
 */
namespace fnc;

/*** require ***/
require_once( dirname(__FILE__).'/Ifnc_exec.php' );
require_once( dirname(__FILE__).'/Cfnc_exec.php' );

/*** class ***/
class Chelp extends Cfnc_exec implements Ifnc_exec {
  private $prm = null;
  
  /**
   * @fn exec
   * @brief show cli usage
   */
  public function exec() {
    try {
      /* fnc-2 : show help */
      echo 'Usage : trut <config> [options]'.PHP_EOL;
      echo '  config : path to config file'.PHP_EOL;
      echo '  option :'.PHP_EOL;
      echo '    -o <path> output destination directory path'.PHP_EOL;
      echo '    -v        varsion'.PHP_EOL;
      echo '    -h        help'.PHP_EOL;
    } catch( \Exception $e ) {
      throw new \Exception(
        PHP_EOL.'ERR(File:'.\basename(__FILE__).','.',Line:'.__line__.'):'.
        \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
}

/* end of file */
