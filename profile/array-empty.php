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

?>