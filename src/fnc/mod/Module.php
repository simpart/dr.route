<?php
/**
 * @file   Module.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;

define('DMOD_FUNC_SEL', 'sel');
define('DMOD_FUNC_ADD', 'add');
define('DMOD_FUNC_DEL', 'del');
define('DMOD_FUNC_LST', 'list');
define('DMOD_FUNC_SHW', 'show');
define('DMOD_FUNC_HLP', 'help');

class Module extends \fnc\rle\ExtFunc implements \fnc\rle\InfFunc
{
    private $func = null;
    private $parm = null;
    private $help = false;
    
    public function exec() {
        try {
            if (null !== $this->func) {
                $this->func->exec();
            }
        } catch ( \Exception $e ) {
            throw $e;
        }
    }
    
    public function setFunc($fnc) {
        try {
            if (0 === strcmp(DMOD_FUNC_SEL, $fnc)) {
                $this->func = new ModSelect();
            } else if (0 === strcmp(DMOD_FUNC_ADD, $fnc)) {
                $this->func = new ModAdd();
            } else if (0 === strcmp(DMOD_FUNC_DEL, $fnc)) {
                $this->func = new ModDelete();
            } else if (0 === strcmp(DMOD_FUNC_LST, $fnc)) {
                $this->func = new ModList();
            } else if (0 === strcmp(DMOD_FUNC_SHW, $fnc)) {
                $this->func = new ModShow();
            } else if (0 === strcmp(DMOD_FUNC_HLP, $fnc)) {
                $this->func = new ModHelp();
            } else {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function getFunc() {
        try {
            if (null === $this->func) {
                return null;
            }
            return $this->func->getName();
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function setPrm($prm) {
        try {
            $this->func->setPrm($prm);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function getPrm() {
        try {
            if (null === $this->func) {
                return null;
            }
            return $this->func->getPrm(); 
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
