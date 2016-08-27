<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;


class ModHelp extends \fnc\rle\ExtFunc implements \fnc\rle\InfFunc
{
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_HLP;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function exec() {
        try {
            echo 'Usage: spac mod <func> | [-h]'             . PHP_EOL;
            echo '  <func> : module function'                . PHP_EOL;
            echo '    add <dest> : add module.'              . PHP_EOL;
            echo '                 require module directory' . PHP_EOL;
            echo '    del <mod>  : delete module.'           . PHP_EOL;
            echo '                 require module name'      . PHP_EOL;
            echo '    list       : show module list and current module' . PHP_EOL;
            echo '    show <mod> : show module detail'       . PHP_EOL;
            echo '                 require module neme'      . PHP_EOL;
            echo '  -h     : show help'                      . PHP_EOL;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
