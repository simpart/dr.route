<?php
/**
 * @file   check.php
 * @brief  syntax check
 * @author simpart
 * @note   MIT license
 */
namespace cmd;

/**
 * get main object
 * 
 * @param  $prm : (index type array)command line parameter
 * @return function object
 */
function subcmd( $prm ) {
    try {
        $ret = null;
        if (0 === strcmp('gen', $prm[0])) {
            /* 'gen' sub command */
            $ret = new \fnc\gen\Generate();
            setGenPrm($ret, $prm);
        } else if (0 === strcmp('mod', $prm[0])) {
            /* 'mod' sub command */
            $ret = new \fnc\mod\Module();
            setModPrm($ret, $prm);
        } else {
            /* invalid sub command */
            throw new \err\SynxErr(
                          'invalid sub command ' . $prm[0]
                      );
        }
        return $ret;
    } catch (\Exception $e) {
        throw $e;
    }
}

function setGenPrm(&$gen,$prm) {
    try {
        if (2 > count($prm)) {
            /* first argument (path) is required */
            throw new \err\gen\GenSynxErr("too few arguments");
        }
        
        if (0 === strcmp('-h', $prm[1])) {
            /* '-h' option */
            $gen->setHelpFlg(true);
            return;
        }
        $gen->setConf($prm[1]);
        $output  = false;
        $opt     = null;
        $loop    = 0;
        for ($loop=2; $loop < count($prm); $loop++) {
            if ( (null === $opt) &&
                 (0 === strpos($prm[$loop], '-')) ) {
                $opt = $prm[$loop];
                if ( 0 === strcmp('-o', $opt) ) {
                    /* '-o' option */
                    $output = true;
                    continue;
                }
                /* invalid option */
                throw new \err\gen\GenSynxErr("invalid option " . $prm[$loop]);
            } else if ( (null !== $opt) &&
                        (0 !== strpos($prm[$loop], '-')) ) {
                if (0 === strcmp('-o', $opt)) {
                    /* output directory */
                    $gen->setOutput($prm[$loop]);
                }
            }
        }
        if ( (true === $output) &&
             (null === $gen->getOutput()) ) {
            /* directory is required if "-o" is specified */
            throw new \err\gen\GenSynxErr("could not find output directory");
        }
    } catch (\Exception $e) {
        throw $e;
    }
}

function setModPrm (&$mod, $prm) {
    try {
        if (2 > count($prm)) {
            /* too few arguments */
            throw new \err\mod\SynxErr("too few arguments");
        }
        
        if (0 === strcmp('-h', $prm[1])) {
            /* '-h' option */
            $mod->setFunc(DMOD_FUNC_HLP);
            return;
        }
        $func = null;
        for ($loop=1; $loop < count($prm); $loop++) {
            if (null === $func) {
                $func = $prm[$loop];
                try {
                    $mod->setFunc($func);
                    continue;
                } catch (\Exception $e) {
                    /* invalid option */
                    throw new \err\mod\SynxErr("invalid function " . $prm[$loop]);
                }
            } else if ( (null !== $mod->getFunc()) &&
                        (null === $mod->getPrm()) ) {
                $mod->setPrm($prm[$loop]);
            } else if (null !== $mod->getPrm()) {
                /* too many arguments */
                throw new \err\mod\SynxErr("too many arguments");
            }
        }
        if ( (0 !== strcmp(DMOD_FUNC_LST, $mod->getFunc())) &&
             (null === $mod->getPrm())) {
            throw new \err\mod\SynxErr("too few arguments");
        }
    } catch (\Exception $e) {
        throw $e;
    }
}
/* end of file */
