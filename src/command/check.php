<?php
/**
 * @file   check.php
 * @brief  syntax check
 * @author simpart
 * @note   MIT license
 */
namespace cmd;

require_once(__DIR__ . '/../com/loader/class.php');
require_once(__DIR__ . '/subcmd.php' );

/*** function ***/
/**
 * @fn     check
 * @param  command line parameter
 *         index type array
 * @return function object    
 */
function check( $prm ) {
    try {
        if( 0 === count( $prm ) ) {
            /* cannnot find sub command */
            throw new \err\SynxErr(
                          'cannnot find sub command'
                      );
        }
        
        /* varsion */
        $ret_val = varsion($prm);
        if( null !== $ret_val ) {
            return $ret_val;
        }
        
        /* help */
        $ret_val = help($prm);
        if( null !== $ret_val ) {
            return $ret_val;
        }
        
        /* sub command */
        $ret_val = subcmd($prm);
        if( null !== $ret_val ) {
            return $ret_val;
        }
        
        throw new \Exception();
    } catch ( \Exception $e ) {
        throw $e;
    }
}

/**
 * @fn     help
 * @param  command line parameter
 *         index type array
 * @return function object
 */
function help( $prm ) {
    try {
        if( 1 === count( $prm ) ) {
            /* '-h' option */
            if( 0 === strcmp( '-h' , $prm[0] ) ) {
                /* show help of 'spac' */
                return new \fnc\com\ComHelp();
            } else {
                /* this option is not required */
            }
        }
        return null;
    } catch ( Exception $e ) {
        throw $e;
    }
}

/**
 * get version object
 * 
 * @param  command line parameter
 *         index type array
 * @return function object
 */
function varsion( $prm ) {
    try {
        if( 1 === count( $prm ) ) {
            /* '-v' option */
            if( 0 === strcmp( '-v' , $prm[0] ) ) {
                /* show spac version */
                return new \fnc\com\Version( $prm );
            } else {
                /* this option is not required */
            }
        }
        return null;
    } catch ( \Exception $e ) {
        throw $e;
    }
}
/* end of file */
