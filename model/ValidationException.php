<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */

// The ValidationException Class extends the Exception class
// and returns an error message when thrown.

Class ValidationException extends Exception
{
	protected $message;
	
	function __construct($message) {
	
		$this->message = $message;
	
	}
	
	public function getError()
	{
		return $this->message;
	}
}
?>