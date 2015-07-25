<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentconfController {
	
	public function display()
	{
		if(isset($_POST['next'])){
			
			unset($_POST['next']);
			
			if(isset($_POST['amount'])){
				
				$_SESSION['payAmount'] = $_POST['amount'];
				unset($_POST['amount']);
			}
			
			if(isset($_POST['paymentDate'])){
			
				$_SESSION['payDate'] = $_POST['paymentDate'];
				unset($_POST['paymentDate']);
			}
			
			$paymentconf = new Paymentconf();
			
			$paymentconf->init();
			
			include 'view/layout/paymentconf.php';
			
		} else if(isset($_POST['cancel'])){

			unset($_POST['cancel']);
			
			$payment = new Payment();
			
			$payment->cancelSessions();
			
			$payment->init();
			
			include 'view/layout/payment.php';
		}		
	}
}
?>