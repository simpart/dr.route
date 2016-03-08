<?php
/**
 * @file   CcomErr.php
 * @brief  syntax error exception
 * @author simpart
 * @note   MIT License 
 */
namespace err;

/*** class ***/
class CcomErr extends \Exception {
  private $err_str = null;
  
  /**
   * @fn    __construct
   * @brief set error string
   * @param string : error couse
   */
  function __construct( $err ) {
    try { $this->err_str = $err; }
    catch( \Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
  
  /**
   * @fn    showError
   * @brief show error contents
   */
  public function showConts() {
    try {
      echo 'Error : '.$this->err_str.PHP_EOL;
    } catch ( \Exception $e ) {
      throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
      );
    }
  }
}

/* end of file */
