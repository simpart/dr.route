<?php
/**
 * @file   Cini_ctrl.php
 * @brief  first request function
 * @author simpart
 * @note   MIT Lisence
 */

/**
 * @class Cini_ctrl
 */
class Cini_ctrl {
  
  
  public function get( $rurl, $prm ) {
    try {
      echo 'get test';
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  public function post( $rurl, $prm ) {
    try {
    
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  public function put( $rurl, $prm ) {
    try {
    
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  public function delete( $rurl, $prm ) {
    try {
    
    } catch ( Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
}
/* end of file */
