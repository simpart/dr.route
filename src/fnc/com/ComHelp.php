<?php
/**
 * @file   Help.php
 * @brief  show cli usage
 * @author simpart
 * @note   MIT License
 */
namespace fnc\com;

/*** class ***/
class ComHelp extends \fnc\rle\ExtFunc implements \fnc\rle\InfFunc
{
    private $prm = null;
    
    /**
     * show cli usage
     */
    public function exec()
    {
        try {
            $this->help();
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.'Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    public function help() {
        try {
            /* help contents is $spac_help */
            echo 'Usage: spac <sub> | [opt]'.PHP_EOL;
            echo '  <sub> : sub command'.PHP_EOL;
            echo '    gen : generate routing'.PHP_EOL;
            echo '    mod : module manager'.PHP_EOL;
            echo '  [opt] : option'.PHP_EOL;
            echo '    -v  : version'.PHP_EOL;
            echo '    -h  : help'.PHP_EOL;
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.'Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}
/* end of file */
