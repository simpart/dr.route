<?php

/**
 * generate shell
 * 
 */
function genShell() {
    try {
        if (false === is_writable(__DIR__.'/../../')) {
            throw new \err\ComErr(
                'could not create ' . __DIR__ . '/../../spac file',
                'please check permition at ' . __DIR__ . '/../../'
            );
        }
        if (true === file_exists (__DIR__ . '/../../spac')) {
            throw new \err\ComErr(
                'already exists spac shell',
                'please delete ' . __DIR__ . '/../../../spac'
            );
        }
        
        $conts  = '#!/bin/bash' . PHP_EOL;
        /* call 'cmd' function with parameter */
        $conts .= 'php ' . __DIR__ . '/../../src/command/ctrl.php $*';
        /* create spac shell at spac directory */
        /* write spac shell contents */
        $ret = file_put_contents( __DIR__.'/../../spac', $conts );
        if(false === $ret) {
            throw new \Exception();
        } else {
            /* permition of spac shell is 755 */
            if (false === chmod(__DIR__.'/../../spac', 0755)) {
                throw new \Exception();
            }
        }
    } catch(Exception $e) {
        throw $e;
    }
}

/**
 * set symbolic link
 * 
 * @param $dir : install directory
 */
function setSymLink($dir) {
    try {
        /* cannot create spac by permition */
        if (false === is_writable($dir)) {
            throw new \err\ComErr(
                'failed install spac command',
                'please check permition at ' . $dir
            );
        }
        /* symbolic link is already exists */
        if (true === file_exists ($dir.'/spac')) {
            throw new \err\ComErr(
                'failed install spac command',
                'please delete ' . $dir .'/spac'
            );
        }
        /* create symbolic link spac shell to installation directory */
        $lncmd = 'ln -s '.__DIR__.'/../../spac '.$dir.'/spac';
        if (false === system($lncmd)) {
            throw new \Exception();
        }
    } catch (Exception $e) {
        throw $e;
    }
}
/* end of file */
