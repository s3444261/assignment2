<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Payeelist {
	
	// Initializes the Payee List based on which type of list is required.
	public function init(){
		$payment = new Payment();
		$payment->cancelSessions();
		
		if(isset($_SESSION['billPayee']) || isset($_SESSION['billPayeeList'])){
			$billers = new BillerPayees();
			$billers->userID = $_SESSION['userID'];
			$_SESSION ['payeeList'] = $billers->getBillersList();
		} elseif(isset($_SESSION['fundsTransferPayee']) || isset($_SESSION['fundsTransferPayeeList'])){
			$payees = new BillerPayees();
			$payees->userID = $_SESSION['userID'];
			$_SESSION ['payeeList'] = $payees->getPayeesList();
		} elseif(isset($_SESSION['allPayeeList'])){
			$both = new BillerPayees();
			$both->userID = $_SESSION['userID'];
			$_SESSION ['payeeList'] = $both->getBothList();
		}
	}
}
?>