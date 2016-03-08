<?php
/**
 * @file   Scmd_ctrl.php
 * @brief  command function controller
 * @author simpart
 * @note   MIT License
 */
namespace cmd;

/*** require ***/
require_once( dirname(__FILE__).'/Scmd_check.php' );

try {
  /* check cmd parameter */
  $prm = array();
  $loop = 0;
  for( $loop=1; $loop < count($argv) ; $loop++ ) {
    $prm[] = $argv[$loop];
  }
  /* get exec object */
  $func = check( $prm );
  if( null === $func ) {
    return;
  }
  /* execute function */
  $func->exec();
} catch ( Exception $e ) {
  throw new Exception(
              PHP_EOL.'ERR(File:'.basename(__FILE__).','.
              'Line:'.__line__.'):'.$e->getMessage() );
}
/* end of file */
