<?php
/**
 * @file   Scmd_check.php
 * @brief  syntax check
 * @author simpart
 * @note   MIT license
 */
namespace cmd;

/*** require ***/
require_once( dirname(__FILE__).'/../err/Ccmd_synxErr.php' );
require_once( dirname(__FILE__).'/../fnc/Cfnc_varsion.php' );
require_once( dirname(__FILE__).'/../fnc/Cfnc_help.php' );
require_once( dirname(__FILE__).'/../fnc/Cfnc_generate.php' );

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
      /* @cmd-6-3 : target directory is require parameter */
      throw new \err\CcmdSynx( 'could not find target directory.' );
      return null;
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
    /* main */
    $ret_val = mainFunc($prm);
    if( null !== $ret_val ) {
      return $ret_val;
    }
    throw new \err\CcmdSynx( 'unknown' );
  } catch ( \err\CcmdSynx $syn ) {
    $syn->showConts();
    return;
  } catch ( Exception $e ) {
    throw new Exception( 
      PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
      __FUNCTION__.'()'.$e->getMessage()
    );
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
      /* @cmd-5 : '-h' parameter (option) */
      if( 0 === strcmp( '-h' , $prm[0] ) ) {
        return new \fnc\Chelp( $prm );
      }
    } else {
      foreach( $prm as $elm ) {
        if( 0 === strcmp( '-h' , $elm ) ) {
          /* @cmd-6-2 : '-h' parameter specified single */
          throw new CcmdSynx( 'invalid parameter.' );
        }
      }
      return null;
    }
  } catch ( Exception $e ) {
    throw new Exception(
      PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
      __FUNCTION__.'()'.$e->getMessage()
    );
  }
}

/**
 * @fn     Fcmd_varsion
 * @param  command line parameter
 *         index type array
 * @return function object
 */
function varsion( $prm ) {
  try {
    $ret_val = null;
    if( 1 === count( $prm ) ) {
      /* @cmd-4 : '-v' parameter (option) */
      if( 0 === strcmp( '-v' , $prm[0] ) ) {
        $ret_val = new \fnc\Cvarsion( $prm );
        $ret_val->setCallType( DFNC_TYPE_CLI );
        return $ret_val;
      }
    } else {
      foreach( $prm as $elm ) {
        if( 0 === strcmp( '-v' , $elm ) ) {
          /* @cmd-6-1 : '-v' parameter specified single */
          throw new \err\CcmdSynx( 'invalid parameter.' );
        }
      }
    }
    return $ret_val;
  } catch ( Exception $e ) {
    throw new Exception(
      PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
      __FUNCTION__.'()'.$e->getMessage()
    );
  }
}

/**
 * @fn     mainFunc
 * @param  command line parameter
 *         index type array
 * @return function object
 */
function mainFunc( $prm ) {
  try {
    $opt    = null;
    $output = null;
    $config = null;
    $target = null;
    $log    = false;
    foreach( $prm as $elm ) {
      if( null === $opt ) {
        if( (2 === strlen( $elm )) &&
            (0 === strcmp( '-o', $elm )) ) {
          /* cmd-3-1 : '-o' parameter */
          $opt = $elm;
        } else if( (2 === strlen( $elm )) &&
                   (0 === strcmp( '-l', $elm )) ) {
          /* cmd-7 : '-l' option */
          /* cmd-8-4 : input log */
          $log = true;
        } else {
          /* cmd-8-1 : input config */
          if( null !== $config ) {
            continue;
          }
          $config = $elm;
        }
      } else if( 0 === strcmp( '-o', $opt ) ) {
        /* cmd-8-3 : input config */
        $output = $elm;
        $opt    = null;
      }
    }
    /* null check */
    if( null === $config ) {
      /* cmd-3-2  : this option is require arguments */
      throw new \err\CcmdSynx( 'could not find config argument.' );
    }
    if( null !== $opt ) {
      /* cmd-2-2 : this option is require arguments */
      throw new \err\CcmdSynx( 'could not find '.$opt.' argument value.' );
    }
    $ret_val = new \fnc\Cgenerate( $output,$config,$log );
    
    $ret_val->setCallType( DFNC_TYPE_CLI );
    return $ret_val;
  } catch ( \err\CcmdSynx $snx ) { 
    $snx->showConts();
    exit();
  } catch ( Exception $e ) {
    throw new Exception(
      PHP_EOL.'ERR(File:'.basename(__FILE__).','.',Line:'.__line__.'):'.
      __FUNCTION__.'()'.$e->getMessage()
    );
  }
}

/* end of file */
