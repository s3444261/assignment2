<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PayeedeleteController {
	
	public function display()
	{
		$payee = new Payees();
		$payee->payeeID = $_SESSION['payeeDeleteID'];
		$payee->getPayee();
		$_SESSION['accountName'] = $payee->accountName;
		$_SESSION['accountNickname'] = $payee->accountNickname;
		$_SESSION['bsb'] = $payee->bsb;
		$_SESSION['accountNumber'] = $payee->accountNumber;
		
		include 'view/layout/payeedelete.php';
	}
}
?>