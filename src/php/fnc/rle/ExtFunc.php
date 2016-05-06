<?php
/**
 * @file   ExtFunc.php
 * @brief  exec extends class
 * @author simpart
 * @note   MIT License
 */
namespace fnc\rle;

/*** define ***/
define( 'DFNC_TYPE_CLI', 'cli' );
define( 'DFNC_TYPE_RST', 'rest' );

/*** class ***/
class ExtFunc
{
    protected $call_type = DFNC_TYPE_CLI;
  
    /**
     * set call type
     *
     * @param $type : (string) DFNC_TYPE_CLI,DFNC_TYPE_RST
     */
    public function setCallType( $type ) {
        try {
            if( 0 === strcmp( $type,DFNC_TYPE_CLI ) ) {
                $this->call_type = $type;
            } else if( 0 === strcmp( $type,DFNC_TYPE_RST ) ) {
                $this->call_type = $type;
            } else {
                throw new \Exception( 'invalid type '.$type );
            }
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.',Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
    public function getCallType() {
        try {
            return $this->call_type;
        } catch ( \Exception $e ) {
            throw new \Exception(
                PHP_EOL.'ERR(File:'.\basename(__FILE__).','.',Line:'.__line__.'):'.
                \get_class($this).'->'.__FUNCTION__.'()'.$e->getMessage()
            );
        }
    }
}

/* end of file */
