<?php

error_reporting(E_ALL| E_STRICT);
ini_set("display_errors", 1);

class FooException extends Exception {

}

$foo = new FooException( '', 0, new InvalidArgumentException( 'foo bar' ) );

var_dump( $foo->getMessage() );
var_dump( $foo->getPrevious() );

?>