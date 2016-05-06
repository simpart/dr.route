<?php
/**
 * @file   Cfnc_varsion.php
 * @brief  show varsion
 * @author simpart
 * @note   MIT License
 */
namespace fnc\com;

/*** class ***/
class Version extends \fnc\rle\ExtFunc implements \fnc\rle\InfFunc
{
    /**
     * show varsion
     */
    public function exec() {
        try {
            if( 0 === strcmp( DFNC_TYPE_CLI, $this->call_type ) ) {
                /* fnc-1 : show varsion */
                echo 'Trut varsion 0.2 (beta)'.PHP_EOL;
                echo 'Copyright (c) 2016 simpart'.PHP_EOL;
            }
        } catch( Exception $e ) {
            throw $e;
        }
    }
}
/* end of file */
