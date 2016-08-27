<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;


class ModSelect extends \fnc\rle\ExtMod implements \fnc\rle\InfFunc
{
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_SEL;
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
            for ($loop=0;$loop < count($mod_cnf); $loop++) {
                /* check for the module name(*chkmod) 'select' value is 'true' */
                if ( (true === $mod_cnf[$loop]['select']) &&
                     (0 === strcmp($this->parm, $mod_cnf[$loop]['name'])) ) {
                    /* nothing to do */
                    /* it is already selected if chkmod and specified module name is same */
                    return;
                }
                $mod_cnf[$loop]['select'] = false;
                if (0 === strcmp($this->parm, $mod_cnf[$loop]['name'])) {
                    /* switching 'select' value(true) from module config */
                    $mod_cnf[$loop]['select'] = true;
                }
            }
            /* edit module config from (spac dir)/conf/module.yml */
            if (false === copy(
                              __DIR__ . '/../../../../conf/module.yml',
                              __DIR__ . '/../../../../conf/module.yml_'
                          )) {
                throw new \err\ComErr(
                    'could not create backup of module config',
                    'please check ' . __DIR__ . '/../../../../conf'
                );
            }
            if ( false === file_put_contents(
                               __DIR__ . '/../../../../conf/module.yml',
                               yaml_emit($mod_cnf)
                           ) ) {
                throw new \err\ComErr(
                    'could not edit module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            unlink(__DIR__ . '/../../../../conf/module.yml_');
            
            echo 'switched generater module ' . $this->parm . PHP_EOL;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function setPrm($prm) {
        try {
            $mod_cnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
            if (false === $mod_cnf) {
                throw new \err\ComErr(
                    'could not read module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            
            foreach ($mod_cnf as $elm) {
                if (0 === strcmp($prm, $elm['name'])) {
                    /* specify module name that is already installed */
                    $this->parm = $prm;
                    return;
                }
            }
            throw new \err\ComErr(
                'invalid module name ' . $prm,
                'please specify module name that is already installed'
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
