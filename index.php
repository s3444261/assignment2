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

// Include config file.
include 'connect/config.php';

// Call a singleton instance of the Driver class.
$driver = Driver::getInstance ();

// Display the required content.
$driver->display ();

?>