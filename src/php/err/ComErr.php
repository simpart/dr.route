<?php
/**
 * @file   CcomErr.php
 * @brief  syntax error exception
 * @author simpart
 * @note   MIT License 
 */
namespace err;

/*** class ***/
class ComErr extends \Exception {
    private $err_str = null;
    
    /**
     * set error string
     * 
     * @param string : error couse
     */
    function __construct( $err ) {
        try { $this->err_str = $err; }
        catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * show error contents
     */
    public function showConts($type) {
        try {
            echo 'Error : '.$this->err_str.PHP_EOL;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}
/* end of file */
