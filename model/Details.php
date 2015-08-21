<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Details {
	
	// Retireves the initial values for the first account in the list to
	// be displayed in the Account Details Page.
	public function init(){
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		if(!isset($_SESSION['detAccountID'])){
			$firstAccount = $accounts->getFirstAccount();
			$_SESSION['detAccountID'] = $firstAccount['accountID'];
		}
		
		$this->setAccountSelected($_SESSION['detAccountID']);
		
		$account = new Account();
		$account->accountID =  $_SESSION['detAccountID'];
		$account->getAccount(); 
		
		$_SESSION['detAccountNickname'] = $account->accountNickname;
		$_SESSION['detAccountNumber'] = $account->accountNumber;
		$_SESSION['detProductName'] = $account->productName;
		$_SESSION['detRecordedLimit'] = $account->recordedLimit;
		
		if(strlen($account->accruedDebitInterest()) == 0){
				$_SESSION['detAccruedDebitInterest'] = '$0.00';
			} else {
				$_SESSION['detAccruedDebitInterest'] = '$' . number_format($account->accruedDebitInterest(),2);
			}
		if(strlen($account->accruedCreditInterest()) == 0){
				$_SESSION['detAccruedCreditInterest'] = '$0.00';
			} else {
				$_SESSION['detAccruedCreditInterest'] = '$' . number_format($account->accruedCreditInterest(),2);
			}
		if(strlen($account->creditInterestLFY()) == 0){
				$_SESSION['detInterestEarned'] = '$0.00';
			} else {
				$_SESSION['detInterestEarned'] = '$' . number_format($account->creditInterestLFY(),2);
			}
	}
	
	// Clears any settings previously displayed on the Account Details page.
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['detAccountNickname']);
		unset($_SESSION['detAccountNumber']);
		unset($_SESSION['detProductName']);
		unset($_SESSION['detRecordedLimit']);
		unset($_SESSION['detAccruedDebitInterest']);
		unset($_SESSION['detAccruedCreditInterest']);
		unset($_SESSION['detInterestEarned']);
	}
	
	// Retrieves details to be displayed on the Account Details page based on
	// the account selected.
	public function getDetails($accountID){
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		$_SESSION['detAccountID'] = $accountID;
		
		$this->setAccountSelected($_SESSION['detAccountID']);
		
		$account = new Account();
		$account->accountID =  $accountID;
		$account->getAccount();
		
		$_SESSION['detAccountNickname'] = $account->accountNickname;
		$_SESSION['detAccountNumber'] = $account->accountNumber;
		$_SESSION['detProductName'] = $account->productName;
		$_SESSION['detRecordedLimit'] = $account->recordedLimit;
		if(!isset($_SESSION['detAccruedDebitInterest'])){
			if(strlen($account->accruedDebitInterest()) == 0){
				$_SESSION['detAccruedDebitInterest'] = '$0.00';
			} else {
				$_SESSION['detAccruedDebitInterest'] = '$' . number_format($account->accruedDebitInterest(),2);
			}
		}
		if(!isset($_SESSION['detAccruedCreditInterest'])){
			if(strlen($account->accruedCreditInterest()) == 0){
				$_SESSION['detAccruedCreditInterest'] = '$0.00';
			} else {
				$_SESSION['detAccruedCreditInterest'] = '$' . number_format($account->accruedCreditInterest(),2);
			}
		}
		if(!isset($_SESSION['detInterestEarned'])){
			if(strlen($account->creditInterestLFY()) == 0){
				$_SESSION['detInterestEarned'] = '$0.00';
			} else {
				$_SESSION['detInterestEarned'] = '$' . number_format($account->creditInterestLFY(),2);
			}
		}
	}
	
	// Sets the account selected.
	public function setAccountSelected($accountID){
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
		
		foreach($accountIDs as $aID){
			unset($_SESSION['detSelectedAccount' . $aID]);
		}
		$_SESSION['detSelectedAccount' . $accountID] = 'selected="selected"';
	}
}
?>