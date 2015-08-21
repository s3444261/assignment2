<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Paymentconf {
	
	// Initialize the payment confirmation page.
	public function init(){
		
		$account = new Account();
		$account->accountID = $_SESSION['payAccountID'];
		$account->getAccount();
		$_SESSION['payAccount'] = $account->accountName;
	}
}
?>