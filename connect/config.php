<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * Config.php
 * This file was supplied in the course lab notes and is used to
 * display errors during development where the php.ini file has
 * not been hard coded to do so. (I didn't write this.)
 */
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

function __autoload($class) {
	$dir = array (
			'controller/',
			'model/' 
	);
	
	foreach ( $dir as $directory ) {
		if (file_exists ( $directory . $class . '.php' )) {
			require_once ($directory . $class . '.php');
			return;
		}
	}
}

// Call a singleton instance of the Driver class.
$driver = Driver::getInstance ();

// Set the basepath for the site.
if (! isset ( $_SESSION['basepath']) ) {
	$_SESSION['basepath'] = str_replace(substr($_SERVER['SCRIPT_NAME'], -9), "", $_SERVER['SCRIPT_NAME']);
}
$driver->basepath = $_SESSION['basepath'];

?>