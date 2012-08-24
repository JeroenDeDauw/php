<?php

/**
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

error_reporting(E_ALL| E_STRICT);
ini_set("display_errors", 1);

function a() {
	global $array;
	foreach ( range( 0, 99 ) as $i ) {
		$a = count( $array ) == 0;
	}
}

function b() {
	global $array;
	foreach ( range( 0, 99 ) as $i ) {
		$a = $array === array();
	}
}

function c() {
	global $array;
	foreach ( range( 0, 99 ) as $i ) {
		$a = empty( $array );
	}
}

function profile( $callable ) {
	$then = microtime();
	call_user_func( $callable );
	$now = microtime();
	echo sprintf("Elapsed:  %f<br />\n\n", $now-$then);
}

foreach ( array( 1, 5, 100, 10000 ) as $size ) {
	echo "<br />SIZE $size:<br />";
	$array = array_fill( 0, $size, 0 );

	$array = array_map( function() { return mt_rand(); }, $array );
	//$hash = array_fill_keys( $array, true );

	


	// profile( 'findArray' );
	// 
	// profile( 'findHash' );

	xhprof_enable();

	a();
	b();
	c();

	$data = xhprof_disable();

	$a = $data['main()==>a']['wt'];
	$b = $data['main()==>b']['wt'];
	$c = $data['main()==>c']['wt'];

	echo 'a: ' . $a . '<br/>';
	echo 'b: ' . $b . '<br/>';
	echo 'c: ' . $c . '<br/>';
	echo 'b wins over a: ' . ( $a - $b ) . ' (' . round( $a / $b, 2 ) . 'x faster)' . '<br/>';
	echo 'c wins over b: ' . ( $b - $c ) . ' (' . round( $b / $c, 2 ) . 'x faster)' . '<br/>';
	echo 'c wins over a: ' . ( $a - $c ) . ' (' . round( $a / $c, 2 ) . 'x faster)' . '<br/>';
}

/*
SIZE 1:
a: 341
b: 76
c: 48
b wins over a: 265 (4.49x faster)
c wins over b: 28 (1.58x faster)
c wins over a: 293 (7.1x faster)

SIZE 5:
a: 369
b: 63
c: 45
b wins over a: 306 (5.86x faster)
c wins over b: 18 (1.4x faster)
c wins over a: 324 (8.2x faster)

SIZE 100:
a: 1002
b: 72
c: 43
b wins over a: 930 (13.92x faster)
c wins over b: 29 (1.67x faster)
c wins over a: 959 (23.3x faster)

SIZE 10000:
a: 109808
b: 51
c: 30
b wins over a: 109757 (2153.1x faster)
c wins over b: 21 (1.7x faster)
c wins over a: 109778 (3660.27x faster)
*/

?>