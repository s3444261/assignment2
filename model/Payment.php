<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Payment {
	
	public function init(){
		
		if(isset($_POST['payNewBillPayment'])){
			$payment = new Payment();
			$payment->cancelSessions();
			unset($_POST['payNewBillPayment']);
		}
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		$billers = new Billers();
		$billers->userID = $_SESSION['userID'];
		$_SESSION['billers'] = $billers->getBillers();
		
	}
	
	public function cancelSessions(){
		
		unset($_SESSION['payAccountID']);
		unset($_SESSION['payBillerID']);
		unset($_SESSION['payBillerCode']);
		unset($_SESSION['payBillerName']);
		unset($_SESSION['payBillerNickname']);
		unset($_SESSION['payCustomerRef']);
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
		
		foreach($accountIDs as $aID){
			unset($_SESSION['paySelectedAccount' . $aID]);
		}
		
		$billers = new Billers();
		$billers->userID = $_SESSION['userID'];
		$billerIDs = $billers->getBillerIDs();
		
		foreach($billerIDs as $bID){
			unset($_SESSION['paySelectedBiller' . $bID]);
		}
		
		if(isset($_SESSION['payAmount'])){
		
			unset($_SESSION['payAmount']);
		}
			
		if(isset($_SESSION['payDate'])){
				
			unset($_SESSION['payDate']);
		}
		
		if(isset($_SESSION['payAccount'])){
		
			unset($_SESSION['payAccount']);
		}
		
		if(isset($_SESSION['payStatus'])){
		
			unset($_SESSION['payStatus']);
		}
		
		if(isset($_SESSION['payConf'])){
		
			unset($_SESSION['payConf']);
		}
		
		if(isset($_SESSION['payCreated'])){
		
			unset($_SESSION['payCreated']);
		}
	}
}
?>