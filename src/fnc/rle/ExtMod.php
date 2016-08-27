<?php
/**
 * @file   ExtFunc.php
 * @brief  exec extends class
 * @author simpart
 * @note   MIT License
 */
namespace fnc\rle;

/*** class ***/
class ExtMod
{
    protected $name = null;
    protected $parm = null;
    
    /**
     * get 'spac mod' function name
     * 
     * @return (string) function name
     */
    public function getName() {
        try {
            return $this->name;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.',Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    
    public function getPrm() {
        try {
            return $this->parm;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

/* end of file */
