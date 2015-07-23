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
include 'controller/HomeController.php';
include 'controller/SummaryController.php';
include 'controller/HistoryController.php';
include 'controller/DetailsController.php';
include 'controller/PaymentController.php';
include 'controller/PaymentamtController.php';
include 'controller/PaymentconfController.php';
include 'controller/PaymentackController.php';
include 'controller/PaymentlistController.php';
include 'controller/PayeelistController.php';
include 'controller/BilleraddController.php';
include 'controller/BillermodifyController.php';
include 'controller/TransferController.php';
include 'controller/ChecktransferController.php';
include 'controller/TransferackController.php';
include 'controller/LoginController.php';

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