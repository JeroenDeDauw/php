<?php

error_reporting(E_ALL| E_STRICT);
ini_set("display_errors", 1);

class Foo {

	public $bar;

}


$a = new Foo();
$a->bar = 42; 
$b = new Foo();
$b->bar = 42; 
$c = clone $a;

echo spl_object_hash( $a ) . PHP_EOL;
echo spl_object_hash( $b ) . PHP_EOL;
echo spl_object_hash( $c ) . PHP_EOL;

echo PHP_EOL;

echo var_dump( $a === $b );
echo var_dump( serialize( $a ) === serialize( $b ) );
echo var_dump( spl_object_hash( $a ) === spl_object_hash( $b ) );

echo PHP_EOL;

echo var_dump( $a === $c );
echo var_dump( serialize( $a ) === serialize( $c ) );
echo var_dump( spl_object_hash( $a ) === spl_object_hash( $c ) );

?>