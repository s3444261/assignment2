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
		
		if(!isset($_SESSION['accounts'])){
			$_SESSION['accounts'] = array();
			$_SESSION['accounts'][] = array('accountID' => '1',
					'accountName' => 'Kinkead Family Trust/083-006 45-333-3232'
			);
			$_SESSION['accounts'][] = array('accountID' => '2',
					'accountName' => 'Kinkead Murphy Unit Trust/083-006 45-214-8745'
			);
			$_SESSION['accounts'][] = array('accountID' => '3',
					'accountName' => 'Kinkead Superannuation Fund/083-006 45-546-3298'
			);
		}
		
		if(isset($_SESSION['detAccountID'])){
			$this->setAccountSelected($_SESSION['detAccountID']);
		}
		
		if(!isset($_SESSION['detAccountNickname'])){
			$_SESSION['detAccountNickname'] = 'Kinkead Family Trust';
		}
		if(!isset($_SESSION['detAccountNumber'])){
			$_SESSION['detAccountNumber'] = '89-445-3454';
		}
		if(!isset($_SESSION['detProductName'])){
			$_SESSION['detProductName'] = 'Personal Cheque Account';
		}
		if(!isset($_SESSION['detRecordedLimit'])){
			$_SESSION['detRecordedLimit'] = '0.00';
		}
		if(!isset($_SESSION['detAccruedDebitInterest'])){
			$_SESSION['detAccruedDebitInterest'] = '0.00';
		}
		if(!isset($_SESSION['detAccruedCreditInterest'])){
			$_SESSION['detAccruedCreditInterest'] = '0.00';
		}
		if(!isset($_SESSION['detInterestEarned'])){
			$_SESSION['detInterestEarned'] = '0.00';
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
		
		if(!isset($_SESSION['accounts'])){
			$_SESSION['accounts'] = array();
			$_SESSION['accounts'][] = array('accountID' => '1',
					'accountName' => 'Kinkead Family Trust/083-006 45-333-3232'
			);
			$_SESSION['accounts'][] = array('accountID' => '2',
					'accountName' => 'Kinkead Murphy Unit Trust/083-006 45-214-8745'
			);
			$_SESSION['accounts'][] = array('accountID' => '3',
					'accountName' => 'Kinkead Superannuation Fund/083-006 45-546-3298'
			);
		}
		
		$_SESSION['detAccountID'] = $accountID;
		
		$this->setAccountSelected($_SESSION['detAccountID']);
		
		if(!isset($_SESSION['detAccountNickname'])){
			$_SESSION['detAccountNickname'] = 'Kinkead Other Account';
		}
		if(!isset($_SESSION['detAccountNumber'])){
			$_SESSION['detAccountNumber'] = '43-446-3421';
		}
		if(!isset($_SESSION['detProductName'])){
			$_SESSION['detProductName'] = 'Overdraft Account';
		}
		if(!isset($_SESSION['detRecordedLimit'])){
			$_SESSION['detRecordedLimit'] = '5000 DR';
		}
		if(!isset($_SESSION['detAccruedDebitInterest'])){
			$_SESSION['detAccruedDebitInterest'] = '3.00';
		}
		if(!isset($_SESSION['detAccruedCreditInterest'])){
			$_SESSION['detAccruedCreditInterest'] = '5.00';
		}
		if(!isset($_SESSION['detInterestEarned'])){
			$_SESSION['detInterestEarned'] = '2.00';
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