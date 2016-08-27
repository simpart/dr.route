<?php
/**
 * @file   ctrl.php
 * @brief  command function controller
 * @author simpart
 * @note   MIT License
 */
namespace cmd;
require_once(__DIR__ . '/check.php');

try {
    /* get parameter without file name */
    $prm  = array();
    $loop = 0;
    for($loop=1;$loop < count($argv); $loop++) {
        $prm[] = $argv[$loop];
    }
    /* get exec object */
    $func = check( $prm );
    if( null === $func ) {
        return;
    }
    /* execute function */
    $func->exec();
} catch ( \err\ComErr $se ) {
    $se->showConts();
    return;
} catch ( \Exception $e ) {
    $err = new \err\ComErr('unknown','-');
    $err->showConts();
}
/* end of file */
