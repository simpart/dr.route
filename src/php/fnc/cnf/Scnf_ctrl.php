<?php
/**
 * @file   Scnf_ctrl.php
 * @brief  config reader
 * @author simpart
 * @note   MIT License
 */
namespace fnc\cnf;

/*** require ***/
require_once( dirname(__FILE__).'/../../err/Ccmd_comErr.php' );
require_once( dirname(__FILE__).'/Scnf_check.php' );
require_once( dirname(__FILE__).'/Ccnf_info.php' );

/*** class ***/
/**
 * @fn     read
 * @brief  parse yaml and check
 * @param  (string) path to config file
 * @return (Ccnf_info) config object
 */
function read( $cpath ) {
  try {
    /* cnf-1 : read yaml file */
    $yml = yaml_parse_file( $cpath );
    if( false === $yml ) {
      throw new Ccmd_comErr( 'invalid config file(is not yaml)' );
    }
    /* check group */
    chkGrp( $yml );
    
    /* check session */
    chkSes( $yml );
    
    /* check url */
    chkUrl( $yml );
    
    return new Ccnf_info( $yml ); 
  } catch ( Ccmd_comErr $ce ) {
    $ce->showErr();
    exit();
  } catch( Exception $e ) {
    throw new Exception(
      PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
      get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
    );
  }
}
  
/* end of file */
