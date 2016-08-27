<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;

require_once(__DIR__ . '/modFunc.php');

class ModAdd extends \fnc\rle\ExtMod implements \fnc\rle\InfFunc
{
    
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_ADD;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function exec() {
        try {
            /* check specified directory */
            chkRequireConts($this->getPrm());
            
            $desc = yaml_parse_file($this->getPrm() . 'conf/desc.yml');
            if (false === $desc) {
                throw new \err\ComErr(
                    'could not read module description file',
                    'please check ' . $tgt . 'conf/desc.yml'
                );
            }
            /* check installed module */
            if ( true === isInstalled($desc['name']) ) {
                /* target module is already installed */
                throw new \err\ComErr(
                    'specified module is already installed',
                    'please check \'spac mod list\''
                );
            }
            /* copy module contents */
            copyDir( $this->getPrm(), __DIR__ . '/../../mod/' . $desc['name'] );
            
            /* add module name to module config file */
            $modcnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
            $first  = false;
            if (null === $modcnf) {
                $first  = true;
                $modcnf = array();
            }
            $add = array(
                       'name'   => $desc['name'],
                       'select' => false
                   );
            if (true === $first) {
                $add['select'] = true;
            }
            
            $modcnf[] = $add;
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
                               yaml_emit($modcnf)
                           ) ) {
                throw new \err\ComErr(
                    'could not edit module config file',
                    'please check ' . __DIR__ . '/../../../../conf/module.yml'
                );
            }
            unlink(__DIR__ . '/../../../../conf/module.yml_');
            
            echo 'Successful install ' . $desc['name'] . ' module' . PHP_EOL;
            echo 'You can check installed module \'spac mod list\',' . PHP_EOL;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function setPrm($prm) {
        try {
            if (true !== file_exists($prm)) {
                throw new \err\ComErr(
                    'could not find ' . $prm . ' directory',
                    'please specify directory that is exists'
                );
            }
            $ftype = filetype($prm);
            if (0 !== strcmp($ftype, 'dir')) {
                throw new \err\gen\GenErr(
                    'could not find ' . $prm . ' directory',
                    'please specify directory that is exists'
                );
            }
            $tail = substr($prm, strlen($prm)-1);
            if (0 !== strcmp($tail, DIRECTORY_SEPARATOR)) {
                $this->parm = $prm . DIRECTORY_SEPARATOR;
            } else {
                $this->parm = $prm;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
