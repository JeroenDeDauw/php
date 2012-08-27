<?php

class Foo implements Countable {

	public function count() {
		return 42;
	}

}

$foo = new Foo();

var_dump( count( $foo ) );

echo '<br />';

class Bar extends ArrayObject {

	public function count() {
		return 42;
	}

}

$bar = new Bar( array( 'foo' ) );

$bar['bar'] = 'baz';

var_dump( count( $bar ) );

?>