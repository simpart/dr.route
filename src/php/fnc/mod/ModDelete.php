<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;

require_once(__DIR__ . '/modFunc.php');

class ModDelete extends \fnc\rle\ExtMod implements \fnc\rle\InfFunc
{
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_DEL;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function exec() {
        try {
            /* check installed module */
            if ( false === isInstalled($this->parm) ) {
                /* target module is already installed */
                throw new \err\ComErr(
                    'specified module is not installed',
                    'please check \'trut mod list\''
                );
            }
            
            /* confirm */
            echo 'Uninstall ' . $this->parm . ' module.' . PHP_EOL;
            echo 'Are you sure ?(y,n):';
            $line = rtrim(fgets(STDIN), "\n");
            if (!((0 === strcmp($line, 'y')) || 
                  (0 === strcmp($line, 'Y'))) ) {
                exit;
            }
            /* delete module files */
            if (true === isDirExists(__DIR__ . '/../../mod/' . $this->parm)) {
                try {
                    delDir( __DIR__ . '/../../mod/' . $this->parm );
                } catch (\Exception $e) {
                    throw new \err\ComErr(
                        'could not delete ' . __DIR__ . '/../../mod/' . $this->parm,
                        'please check directory'
                    );
                }
            }
            
            /* edit module config */
            $modcnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
            if (false === $modcnf) {
                throw new \err\ComErr(
                    'could not read module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            $newcnf = array();
            foreach ($modcnf as $elm) {
                if (0 === strcmp($this->parm, $elm['name'])) {
                    continue;
                }
                $newcnf[] = $elm;
            }
            if (0 === count($newcnf)) {
                $newcnf = null;
            }
            
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
                               yaml_emit($newcnf)
                           ) ) {
                throw new \err\ComErr(
                    'could not edit module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            unlink(__DIR__ . '/../../../../conf/module.yml_');
            
            echo 'Successful uninstall ' . $this->parm . ' module ' . PHP_EOL;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function setPrm($prm) {
        try {
           $this->parm = $prm; 
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
