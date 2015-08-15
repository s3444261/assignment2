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
	
	public function init(){
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		$firstAccount = $accounts->getFirstAccount();
		$_SESSION['detAccountID'] = $firstAccount['accountID'];
		$this->setAccountSelected($_SESSION['detAccountID']);
		
		$account = new Account();
		$account->accountID =  $firstAccount['accountID'];
		$account->getAccount();
		
		if(!isset($_SESSION['detAccountNickname'])){
			$_SESSION['detAccountNickname'] = $account->accountNickname;
		}
		if(!isset($_SESSION['detAccountNumber'])){
			$_SESSION['detAccountNumber'] = $account->accountNumber;
		}
		if(!isset($_SESSION['detProductName'])){
			$_SESSION['detProductName'] = $account->productName;
		}
		if(!isset($_SESSION['detRecordedLimit'])){
			$_SESSION['detRecordedLimit'] = $account->recordedLimit;
		}
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
	
	public function setAccountSelected($accountID){
		$accountIDs = array(1,2,3);
		
		foreach($accountIDs as $aID){
			unset($_SESSION['detSelectedAccount' . $aID]);
		}
		$_SESSION['detSelectedAccount' . $accountID] = 'selected="selected"';
	}
}
?>