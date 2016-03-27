<?php
/**
 * @file   HflFunc.php
 * @brief  half line function
 * @author simpart
 * @note   MIT License
 */
namespace fnc\gen\php\HalfLine;

/*** function ***/
/**
 * @fn    rotCtrl
 * @brief generate routing controller
 */
function rotCtrl( $fnc ) {
    try {
        $cnf_obj = $fnc->getCnfObj();
        /* routing */
        $rot = file_get_contents(
                   __DIR__ . DIRECTORY_SEPARATOR . 
                   'tmpl'  . DIRECTORY_SEPARATOR . 
                   'route.php'
               );
        if ( false === $rot ) { 
            throw new \err\CcomErr( 'failed read route.php file' );
        }
        $rot_code = str_replace('@gen1', $cnf_obj->getGroup('__any__'), $rot );
        $ret = file_put_contents( $fnc->getOutput().'route.php', $rot_code );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create route.php file' );
        }
        /* common */
        $ret = copy(
                   __DIR__ . DIRECTORY_SEPARATOR .
                   'tmpl'  . DIRECTORY_SEPARATOR .
                   'common.php'
                   ,
                   $fnc->getOutput().'common.php'
               );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create common.php file' );
        } 
        /* session */
        $ret = mkdir( $fnc->getOutput().'session' );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create session directory' );
        }
        $ret = copy(
                   __DIR__   . DIRECTORY_SEPARATOR .
                   'tmpl'    . DIRECTORY_SEPARATOR .
                   'session' . DIRECTORY_SEPARATOR . 
                   'crud.php'
                   ,
                   $fnc->getOutput() . 'session' . DIRECTORY_SEPARATOR . 'crud.php'
               );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create crud.php file' );
        }
        $ses_rot = file_get_contents ( 
                       __DIR__  . DIRECTORY_SEPARATOR . 
                      'tmpl'    . DIRECTORY_SEPARATOR . 
                      'session' . DIRECTORY_SEPARATOR . 
                      'route.php'
                   );
        if ( false === $ses_rot ) {
            throw new \err\CcomErr( 'failed create session'.DIRECTORY_SEPARATOR.'route.php file' );
        }
        $grp     = null;
        $ses_lst = array();
        while ( null !== ( $grp = $cnf_obj->getNextGrp() ) ) {
            $ses_lst[$grp] = $cnf_obj->getSession( $grp );
        }
        $ses_tbl      = getArrayCode( $ses_lst );
        $rep1         = '$GsesTbl = '.$ses_tbl;
        $ses_rot_code = str_replace( '@rep1', $rep1, $ses_rot );
        $ret          = file_put_contents( 
                            $fnc->getOutput().'session'.DIRECTORY_SEPARATOR.'route.php',
                            $ses_rot_code
                        );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create session'.DIRECTORY_SEPARATOR.'route.php file' );
        }
    } catch ( Exception $e ) {
        throw $e;
    }
}

/**
 * @fn    getRotGrp
 * @brief get route group 
 * @param (string) group name
 * @param (string) output directory
 * @param 
 */
function rotGrp( $grp, $out, $cnf ) {
    try {
        $ret = null;
        $ret = mkdir( $out.$grp );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create '.$grp.' directory' );
        }
        // set group
        $grp_ctl = file_get_contents (
                       dirname(__FILE__).'/tmpl/group/SgrpCtrl.php'
                   );
        if ( false === $grp_ctl ) {
            throw new \err\CcomErr( 'failed create '.$grp.'/SgrpCtrl.php file' );
        }
        $grp_ctl_code = str_replace( '@gen1', $grp, $grp_ctl ); 
        $grp_ctl_code = str_replace( 
                            '@gen2',
                            getArrayCode( $cnf->getUrimap( $grp ) ),
                            $grp_ctl_code
                        );
        $ret = file_put_contents( $out.$grp.'/SgrpCtrl.php', $grp_ctl_code );
        if ( false === $ret ) {
            throw new \err\CcomErr( 'failed create '.$grp.'/SgrpCtrl.php file' );
        }
        
        // return objct
        
    } catch ( Exception $e ) {
        throw new Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            __FUNCTION__.'()'.$e->getMessage()
        );
    }
}

function getArrayCode( $ary, $cnt=0 ) {
    try {
        $isarr = false;
        if ( false === is_array( $ary ) ) {
            throw new Exception( 'invalid parameter' );
        }
        $ret_str = 'array(';
        if ( 0 === $cnt ) {
            $ret_str .= PHP_EOL;
        }
        if ( array_values( $ary ) === $ary ) {
            foreach ( $ary as $val ) {
                if ( null === $val ) {
                    $ret_str .= 'null';
                } else if ( true === is_array( $val ) ) {
                    $isarr    = true; 
                    $ret_str .= ' '.getArrayCode( $val, $cnt+1 );
                } else {
                    if ( true === is_string( $val ) ) {
                        $ret_str .= '\''. $val .'\'';
                    } else {
                        $ret_str .= $val;
                    }
                }
                $ret_str .= ',';
                if ( (0 === $cnt) && (true === $isarr) ) {
                    $ret_str .= PHP_EOL;
                    $isarr    = false;
                }
            }
        } else {
            foreach ( $ary as $key => $val ) {
                if ( 0 === $cnt ) {
                    $ret_str .= '    ';
                }
                $ret_str .= '\''. $key .'\' =>';
                if ( null === $val ) {
                    $ret_str .= ' null';
                } else if ( true === is_array( $val ) ) {
                    $isarr    = true;
                    $ret_str .= ' '.getArrayCode( $val, $cnt+1 );
                } else {
                    if ( true === is_string( $val ) ) {
                        $ret_str .= '\''. $val .'\'';
                    } else {
                        $ret_str .= $val;
                    }
                }
                $ret_str .= ',';
                if ( (0 === $cnt) && (true === $isarr) ) {
                    $ret_str .= PHP_EOL;
                    $isarr    = false;
                }
            }
        }
        
        if ( 0 === $cnt ) {
            $ret_str .= PHP_EOL.');';
        } else {
            $ret_str .= ')';
        }
        return $ret_str;
    } catch ( Exception $e ) {
        throw new Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
            __FUNCTION__.'()'.$e->getMessage()
        );
    }
}

/* end of file */
