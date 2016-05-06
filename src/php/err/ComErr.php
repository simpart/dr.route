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
    private $err_hdr   = "";
    private $err_conts = null;
    private $sup_str   = null;
    
    /**
     * set error string
     * 
     * @param string : error couse
     */
    function __construct( $err, $sup ) {
        try {
            $this->err_conts = $err;
            $this->sup_str   = $sup;
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
                get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    /**
     * show error contents
     */
    public function showConts() {
        try {
            echo $this->err_hdr . 'Error   : ' . $this->err_conts . PHP_EOL;
            $cnt  = strlen($this->err_hdr);
            $pad  = "";
            $loop = 0;
            for($loop=0;$loop < $cnt;$loop++) {
                $pad .= ' ';
            }
            echo 'Support '. $pad .': ' . $this->sup_str . PHP_EOL;
        } catch ( \Exception $e ) {
            echo $e->getMessage();
        }
    }
    
    protected function setHeader($hdr) {
        try {
            $this->err_hdr = $hdr;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
/* end of file */
