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
			$biller = new Billers();
			$biller->userID = $_SESSION['userID'];
			if(isset($_POST['addBillerName'])){
				$biller->billerName = $_POST['addBillerName'];
				unset($_POST['addBillerName']);
			}
			if(isset($_POST['addBillerNickname'])){
				$biller->billerNickname = $_POST['addBillerNickname'];
				unset($_POST['addBillerNickname']);
			}
			if(isset($_POST['addBillerCode'])){
				$biller->billerCode = $_POST['addBillerCode'];
				unset($_POST['addBillerCode']);
			}
			if(isset($_POST['addBillerCustomerRefNumber'])){
				$biller->customerReference = $_POST['addBillerCustomerRefNumber'];
				unset($_POST['addBillerCustomerRefNumber']);
			}
			$biller->set(); 
		} 
		
		$payment = new Payment();
		$payment->init();
		
		include 'view/layout/payment.php';
	}
}
?>