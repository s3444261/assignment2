<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class CheckTransfer {
	
	public function init(){
		$account = new Account();
		$account->accountID = $_SESSION['transferAccountID'];
		$account->getAccount();
		$_SESSION['transferAccount'] = $account->accountName;
		
		$accountPayees = new AccountPayees();
		$accountPayees->accountPayeeID = $_SESSION['transferAccountPayeeID']; 
		$accountPayees->userID = $_SESSION['userID'];
		$accountPayees->getAccountPayee(); 
		$_SESSION['transferAccountPayee'] = $accountPayees->accountName;
		$_SESSION['transferType'] = $accountPayees->accountType;
		
		$this->setAccountSelected($_SESSION['transferAccountID']);
		$this->setAccountPayeeSelected($_SESSION['transferAccountPayeeID']); 
	}
	
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['accountPayee']);
	}
	
	public function setAccountSelected($accountID){
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
	
		foreach($accountIDs as $aID){
			unset($_SESSION['transferSelectedAccount' . $aID]);
		}
		$_SESSION['transferSelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	public function setAccountPayeeSelected($accountPayeeID){
		$accountPayees = new AccountPayees();
		$accountPayees->userID = $_SESSION['userID'];
		$toIDs = $accountPayees->getToIDs();
		
		foreach($toIDs as $tID){
			unset($_SESSION['transferSelectedAccountPayee' . $tID]);
		}
		$_SESSION['transferSelectedAccountPayee' . $accountPayeeID] = 'selected="selected"';
	}
}
?>