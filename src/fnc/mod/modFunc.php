<?php
/**
 * @file   modFunc.php
 * @brief  call main function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\mod;

require_once(__DIR__ . '/../../com/file/file.php');

function chkRequireConts($path) {
    try {
        /* check existing conf directory */
        if ( false === isDirExists($path . 'conf') ) {
            throw new \Exception();
        }
        /* check existing file directory */
        if ( false === isDirExists($path . 'file') ) {
            throw new \Exception();
        }
        /* check existing src directory */
        if ( false === isDirExists($path . 'src') ) {
            throw new \Exception();
        }
        /* check existing conf/desc.yml file */
        if ( false === isFileExists($path . 'conf/desc.yml') ) {
            throw new \Exception();
        }
    } catch (\Exception $e) {
        throw new \err\ComErr(
            $path . ' is not module directory',
            'please specify module directory'
        );
    }
}

function isInstalled ($mod_name) {
    try {
        
        $mcnf = yaml_parse_file(__DIR__ . '/../../../../conf/module.yml');
        if (false === $mcnf) {
            throw new \err\ComErr(
                'could not read module config file',
                'please check ' . __DIR__ . '/../../../../conf/module.yml'
            );
        } else if (null === $mcnf) {
            return false;
        }
        
        foreach ($mcnf as $elm) {
            if (0 === strcmp( $elm['name'], $mod_name )) {
                return true;
            }
        }
        return false;
    } catch (\Exception $e) {
        throw new $e;
    }
}
