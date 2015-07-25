<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentamtController {
	
	public function display()
	{
		$paymentamt = new Paymentamt();

		if(isset($_POST['account']) && isset($_POST['biller'])){
			$paymentamt->unsetLast();
				
			$_SESSION['payAccountID'] = $_POST['account'];
			unset($_POST['account']);
				
			$_SESSION['payBillerID'] = $_POST['biller'];
			unset($_POST['biller']);
		}
		
		$paymentamt->init();
		
		include 'view/layout/paymentamt.php';
	}
}
?>