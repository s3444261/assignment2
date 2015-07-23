<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * index.php
 * This is the only file that is accessed in the application.
 * It calls the appropriate views as required.
 */

// Start a session if one hasn't already been started.
if (! isset ( $_SESSION )) {
	session_start ();
}

// Include required files.
include 'connect/config.php';
include 'controller/Driver.php';
include 'controller/Home.php';
include 'controller/Summary.php';
include 'controller/History.php';
include 'controller/Details.php';
include 'controller/Payment.php';
include 'controller/Paymentamt.php';
include 'controller/Paymentconf.php';
include 'controller/Paymentack.php';
include 'controller/Paymentlist.php';
include 'controller/Payeelist.php';
include 'controller/Billeradd.php';
include 'controller/Billermodify.php';
include 'controller/Transfer.php';
include 'controller/Checktransfer.php';
include 'controller/Transferack.php';

// Call a singleton instance of the Driver class.
$driver = Driver::getInstance ();

// Set the basepath for the site.
if (! isset ( $_SESSION['basepath']) ) {
	$_SESSION['basepath'] = str_replace(substr($_SERVER['SCRIPT_NAME'], -9), "", $_SERVER['SCRIPT_NAME']);
}
$driver->basepath = $_SESSION['basepath'];

// Display the required content.
$driver->display ();

?>