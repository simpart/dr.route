<?php
/**
 * @file   check.php
 * @brief  syntax check
 * @author simpart
 * @note   MIT license
 */
namespace cmd;

/**
 * check command
 * 
 * @param $prm : command parameter
 */
function module( $prm ) {
    try {
        $help    = false;
        $mod_prm = array(
                       'func'     => null,
                       'dest'     => null,
                       'mod_name' => null
                   );

        if( 0 !== strcmp( 'mod' , $prm[0] ) ) {
            return null;
        }
        if( (0 === strcmp('add' , $prm[1])) ||
            (0 === strcmp('del' , $prm[1])) ||
            (0 === strcmp('list', $prm[1])) ) {

            $func = $prm[1];
        } else if ( 0 === strcmp('-h', $prm[1] ) ) {
            $mod_prm['func'] = 'help';
            $mod = new \fnc\mod\Module($mod_prm);
            return $mod;
        } else {
            echo 'aaaa';
            throw new \err\cmd\SynxErr(
                          'invalid argument \''.$prm[1] . '\'',
                          new \fnc\mod\ModHelp()
                      );
        }

        foreach( $prm as $elm ) {
            if ( (0 === strcmp('mod', $elm)) ||
                 (0 === strcmp($func, $elm)) ) {
                /* do nothing */
            } else {
                if(0 === strcmp('add', $func)) {
                    if ( null !== $mod_prm['dest'] ) {

                    }

                } else if (0 === strcmp('del', $func)) {
                    if (null !== $mod_prm['mod_name']) {

                    }

                }
            }
        }
        return new \fnc\mod\Module($mod_prm);
    } catch ( \Exception $e ) {
        throw $e;
    }
}
/* end of file */
