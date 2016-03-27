<?php
/**
 * @file   install.php
 * @brief  enable trut command
 * @author simpart
 */

/*** define ***/
define('INSTALLDIR', '/usr/local/bin');

try {
    /* generate trut shell */
    if (false === is_writable(__DIR__.'/../../../')) {
        echo 'could not write \''.__DIR__.'/../../../'.'\''.PHP_EOL;
        return;
    }
    if (true === file_exists (__DIR__.'/../../../trut')) {
        echo 'already exists \''.__DIR__.'/../../../trut\''.PHP_EOL;
        return;
    }
    if (false === genShell()) {
        echo 'could not create \''.__DIR__.'/../../../trut'.'\''.PHP_EOL;
        return;
    }
    if (false === chmod(__DIR__.'/../../../trut', 755)) {
        echo 'could not change mode '.__DIR__.'/../../../trut'.PHP_EOL;
        return;
    }
    
    /* create symbolic link */
    if (false === is_writable(INSTALLDIR)) {
        echo 'could not write \''.INSTALLDIR.'\''.PHP_EOL;
        return;
    }
    if (true === file_exists (INSTALLDIR.'/trut')) {
        echo 'already exists '.INSTALLDIR.'/trut'.PHP_EOL;
        return;
    }
    $lncmd = 'ln -s '.__DIR__.'/../../../trut '.INSTALLDIR.'/trut';
    echo $lncmd.PHP_EOL;
    if (false === system($lncmd)) {
        echo 'could not create link \''.INSTALLDIR.'/trut\''.PHP_EOL;
        return;
    }
    
    echo 'install trut '.PHP_EOL;
} catch (Exception $e) {
    throw new Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
        __FUNCTION__.'()'.$e->getMessage()
    );
}

function genShell() {
    try {
        $conts  = '#!/bin/sh'.PHP_EOL;
        $conts .= 'php '.__DIR__.'/../../../src/php/cmd/ctrl.php $*';
        $ret = file_put_contents( __DIR__.'/../../../trut', $conts );
        if(false === $ret) {
            return false;
        } else {
            return true;
        }
    } catch(Exception $e) {
        throw new Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            __FUNCTION__.'()'.$e->getMessage()
        );
    }
}

/* end of file */
