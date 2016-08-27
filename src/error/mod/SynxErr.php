<?php
/**
 * @file   SynxErr.php
 * @brief  syntax error exception
 * @author simpart
 * @note   MIT License 
 */
namespace err\mod;

/*** class ***/
class SynxErr extends \err\ComErr
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
                "please check 'spac mod -h' responce"
            );
            $this->setHeader("Syntax ");
        } catch ( \Exception $e ) {
            throw $e;
        }
    }
}
/* end of file */
