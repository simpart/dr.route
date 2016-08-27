<?php
/**
 * @file   install.php
 * @brief  enable spac command
 * @author simpart
 */

namespace ini;

/*** require ***/
require_once(__DIR__ . '/../com/loader/class.php');
require_once(__DIR__ . '/param.php');
require_once(__DIR__ . '/genShell.php');

try {
    $prm = getParam($argv);
    if (0 === strcmp('-h', $prm)) {
        /* display help of install.sh, if specified '-h' option */
        showHelp();
        return;
    }
    /* check directory */
    chkDir($prm);
    
    /* create spac shell script */
    genShell();
    
    setSymLink($prm);
    
    echo 'successful install spac' . PHP_EOL;
} catch (\err\ComErr $ce) {
    $ce->showConts();
} catch (\Exception $e) {
    $err = new \err\ComErr(
               /* summary -> "unknown" */
               'unknown',
               /* support -> "-" */
               '-'
           );
    $err->showConts();
}

function showHelp() {
    try {
        echo 'Usage : install.sh [dir]'.PHP_EOL;
        echo '        dir  Installation directory'.PHP_EOL;
        echo '             default is /usr/local/bin'.PHP_EOL;
    } catch (\Exception $e) {
        throw $e;
    }
}

/* end of file */
