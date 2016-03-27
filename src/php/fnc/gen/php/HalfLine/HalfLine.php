<?php
/**
 * @file   HflFunc.php
 * @brief  half line function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\gen\php\HalfLine;

/*** require ***/
require_once(__DIR__.'/HflFunc.php');

class HalfLine implements \fnc\gen\InfGen
{
    private $gen = null;
    
    /**
     * set Generator Object
     *
     * @param $g : generator object
     */
    public function __construct($g) {
        try {
            $this->gen = $g;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    /**
     * start php source generate
     */
    public function startGen() {
        try {
            /* fnc-3-4 : generate controller */
            rotCtrl( $this->gen );

            /* fnc-3-5 : generate group */
            while( null !== ($grp = $this->gen->getCnfObj()->getNextGrp()) ) {
                if (0 !== strcmp($grp, '__any__')) {
                    #anyGrp( $this->gen->getOutput(),
                    #        $this->gen->getCnfObj()
                    #      );
                    rotGrp( $grp,
                            $this->gen->getOutput(),
                            $this->gen->getCnfObj()
                          );
                }
            } 
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
/* end of file */
