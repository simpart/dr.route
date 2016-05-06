<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;

require_once(__DIR__ . '/modFunc.php');

class ModShow extends \fnc\rle\ExtMod implements \fnc\rle\InfFunc
{
    public function __construct() {
        try {
            $this->name = DMOD_FUNC_SHW;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function exec() {
        try {
           if ( false === isInstalled($this->parm) ) {
                /* target module is already installed */
                throw new \err\ComErr(
                    'specified module is not installed',
                    'please check \'trut mod list\''
                );
           } 
           
           $desc = yaml_parse_file(__DIR__ . '/../../mod/' . $this->getPrm() . '/conf/desc.yml');
           if (false === $desc) {
               throw new \err\ComErr(
                   'could not read module description file',
                   'please check ' . __DIR__ . '/../../mod/' . $this->getPrm() . '/conf/desc.yml'
               );
           }
           $mcnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
           if (false === $mcnf) {
               throw new \err\ComErr(
                   'could not read module config',
                   'please check ' . __DIR__ . '/../../../../conf/module.yml'
               );
           }
           $select = '';
           foreach ($mcnf as $elm) {
               if (true !== $elm['select']) {
                   continue;
               }
               if (0 === strcmp($desc['name'], $elm['name'])) {
                   $select .= '(selected)';
                   break;
               }
           }
           
           echo '<' . $desc['name'] . ' Module' . $select . '>' . PHP_EOL;
           echo 'Version ' . $desc['version'];
           echo ', Author ' . $desc['author'] . PHP_EOL;
           echo 'URL : ';
           
           if (true === isset($desc['url'])) {
               echo $desc['url'];
           }
           echo PHP_EOL;
           
           if (true === isset($desc['desc'])) {
               echo $desc['desc'];
           }
           echo PHP_EOL;
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
