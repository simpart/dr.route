<?php
/**
 * @file   GenSynxErr.php
 * @brief  syntax error exception
 * @author simpart
 * @note   MIT License 
 */
namespace err\gen;

/*** class ***/
class GenSynxErr extends \err\ComErr
{
    private $err_str = null;
    private $help    = null;
    
    /**
     * @fn    __construct
     * @brief set error string
     * @param string : error couse
     */
    function __construct( $err )
    {
        try {
            parent::__construct(
                $err,
                "please check 'trut gen -h' responce"
            );
            $this->setHeader("Syntax ");
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.'Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}
/* end of file */
