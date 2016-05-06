<?php
/**
 * @file   CanyCtrl.php
 * @brief  not match any group
 * @author simpart
 * @note   MIT Lisence
 */

/*** require ***/
require_once( __DIR__ . '/direct.php' );
require_once( __DIR__ . '/../rot/session/crud.php' );
require_once( __DIR__ . '/../com/define.php' );

try {
    $sts = \session\get( 'state' );
    if (null === $sts ) {
        \session\set( 'state', 'first' );
        header( 'Location: http://'.DCOM_HOST.':'.DCOM_PORT.'/'.DCOM_APPNAME );
        exit;
    }
    
    directRot($_SERVER['REQUEST_URI']);
    
} catch (Exception $e) {
    throw new \Exception(
                   PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:' . __line__ .
                   'Func:' . __FUNCTION__ . ':' . $e->getMessage()
               ); 
}

/* end of file */
