<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentController {
	
	public function display()
	{
		if(isset($_POST['addBiller'])){
			// Create Biller Object
			$_POST['addBillerName'];
			$_POST['addBillerNickname'];
			$_POST['addBillerCode'];
			$_POST['addBillerCustomerRefNumber'];
			// Insert into database
		}
		
		$payment = new Payment();
		$payment->init();
		
		include 'view/layout/payment.php';
	}
}
?>