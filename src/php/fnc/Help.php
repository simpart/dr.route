<?php
/**
 * @file   Help.php
 * @brief  show cli usage
 * @author simpart
 * @note   MIT License
 */
namespace fnc;

/*** class ***/
class Help extends ExtFunc implements InfFunc
{
    private $prm = null;
    
    /**
     * show cli usage
     */
    public function exec()
    {
        try {
            /* fnc-2 : show help */
            echo 'Usage : trut <config> [options]'.PHP_EOL;
            echo '  config : path to config file'.PHP_EOL;
            echo '  option :'.PHP_EOL;
            echo '    -o <path> output destination directory path'.PHP_EOL;
            echo '    -v        varsion'.PHP_EOL;
            echo '    -h        help'.PHP_EOL;
        } catch( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.'Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}

/* end of file */
