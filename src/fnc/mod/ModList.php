<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;


class ModList extends \fnc\rle\ExtMod implements \fnc\rle\InfFunc
{
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_LST;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function exec() {
        try {
            $mod_cnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
            if (false === $mod_cnf) {
                throw new \err\ComErr(
                    'could not read module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            $max_cnt = 0;
            if (null !== $mod_cnf) {
                foreach ($mod_cnf as $elm) {
                    if ($max_cnt < strlen($elm['name'])) {
                        $max_cnt = strlen($elm['name']);
                    }
                }
            } else {
                echo 'There has not been installed module yet' . PHP_EOL;
                echo 'You can install module \'spac mod add\'' . PHP_EOL;
                return;
            }
            $pad_cnt = 0;
            if ($max_cnt > strlen('Module Name ')) {
                $pad_cnt = $max_cnt - strlen('Module Name ');
            }
            /* show header */
            echo 'Module Name ';
            for($loop=0; $loop <= $pad_cnt ;$loop++) {
                echo ' ';
            }
            echo '| Select' . PHP_EOL;;
            echo '------------';
            for($loop=0; $loop <= $pad_cnt ;$loop++) {
                echo '-';
            }
            echo '----------' . PHP_EOL;
            
            /* show contents */
            foreach ($mod_cnf as $elm) {
                echo $elm['name'];
                $name_pad = strlen('Module Name ') - strlen($elm['name']);
                for($loop=0; $loop < ($name_pad+$pad_cnt) ;$loop++) {
                    echo ' ';
                }
                echo ' |';
                if (true === $elm['select']) {
                    echo ' selected' . PHP_EOL;
                } else {
                    echo PHP_EOL;
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
