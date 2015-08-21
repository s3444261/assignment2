<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Paymentamt {
	
	// Retrieves the initial values for the Payment Amount Page.
	public function init(){
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		
		if(!isset($_SESSION['accounts'])){
			$_SESSION['accounts'] = $accounts->getAccounts();
		}
		
		if(isset($_SESSION['payAccountID'])){
			$this->setAccountSelected($_SESSION['payAccountID']);
		}
		
		if(isset($_SESSION['payBillerID'])){
			$biller = new Billers();
			$biller->billerID = $_SESSION['payBillerID'];
			$biller->getBiller();
			$_SESSION['payBillerCode'] = $biller->billerCode;
			$_SESSION['payBillerName'] = $biller->billerName;
			$_SESSION['payBillerNickname'] = $biller->billerNickname;
			$_SESSION['payCustomerRef'] = $biller->customerReference;
		}
	}
	
	// Clears any previous values for the Payment Amount Page.
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['billers']);
	}
	
	// Sets the account selected.
	public function setAccountSelected($accountID){
		$accounts = new Accounts();
		$accountIDs = $accounts->getAccountIDs();
		
		foreach($accountIDs as $aID){
			unset($_SESSION['paySelectedAccount' . $aID]);
		}
		$_SESSION['paySelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	// Sets the biller selected.
	public function setBillerSelected($billerID){
		$billers = new Billers();
		$billerIDs = $billers->getBillerIDs();
	
		foreach($billerIDs as $bID){
			unset($_SESSION['paySelectedBiller' . $bID]);
		}
		$_SESSION['paySelectedBiller' . $billerID] = 'selected="selected"';
	}
}
?>