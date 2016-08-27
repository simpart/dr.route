<?php
/**
 * @file   CcomErr.php
 * @brief  syntax error exception
 * @author simpart
 * @note   MIT License 
 */
namespace err\gen;

/*** class ***/
class GenErr extends \err\ComErr
{
#    /**
#     * set error string
#     * 
#     * @param string : error couse
#     */
    public function __construct( $err, $sup )
    {
        try {
            parent::__construct($err, $sup);
            $this->setHeader("Gen ");
        } catch ( \Exception $e ) {
            throw $e;
        }
        #    #parent::__construct($err, $sup);
        #    #$this->setHeader("Gen ");
        #    echo $e->getMessage();
    }
}
