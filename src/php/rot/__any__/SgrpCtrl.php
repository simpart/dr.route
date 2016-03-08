<?php
/** 
 * Copyright (c) 2016 simpart
 *  
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 * @file   SgrpCtrl.php
 * @brief  group controll function
 * @author simpart
 * @note   generated by trut
 */
namespace __any__;

/*** global ***/

/*** function ***/
/**
 * execute target 
 *
 * @brief  
 * @param  (string)
 * @return 
 */
function execTgt( $uri ) {
    try {
        require_once( '/var/www/html/trut/src/php/any/CanyCtrl.php' );
        return true;
    } catch ( \Exception $e ) {
        throw new \Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            __FUNCTION__.'()'.$e->getMessage()
        );
    }
}


function setContsType( $type ) {
    try {
        if ( 0 === strcmp( $type, 'html' ) ) {
            header("Content-Type: text/html; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'css' ) ) {
            header("Content-Type: text/css; charset=utf-8");
        } else if( 0 === strcmp( $type, 'js' ) ) {
            header("Content-Type: text/javascript; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'gif' ) ) {
            header("Content-Type: image/gif; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'png' ) ) {
            header("Content-Type: image/png; charset=utf-8");
        } else if ( (0 === strcmp( $type, 'jpg' ))  ||
                    (0 === strcmp( $type, 'jpeg' )) ||
                    (0 === strcmp( $type, 'jpe' ))  ||
                    (0 === strcmp( $type, 'jfif' )) ||
                    (0 === strcmp( $type, 'jfi' )) ) {
            header("Content-Type: image/jpeg; charset=utf-8");
        }
    } catch ( \Exception $e )  {
        throw new \Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            __FUNCTION__.'()'.$e->getMessage()
        );
    }
}

/* end of file */
