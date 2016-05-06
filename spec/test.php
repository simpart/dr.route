<?php
try {
    $yml = yaml_parse_file( 'install_trut.yml' );
    var_dump($yml);
} catch (Exception $e) {
    echo $e->getMessage();  
}
