<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Transfer {
	
	public function init(){
		
		if(isset($_POST['transferNewFundsTransfer'])){
			$transfer = new Transfer();
			$transfer->cancelSessions();
			unset($_POST['transferNewFundsTransfer']);
		}
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		$accountPayees = new AccountPayees();
		$accountPayees->userID = $_SESSION['userID'];
		$_SESSION['accountPayee'] = $accountPayees->getBoth();
	}
	
	public function cancelSessions(){
		
		unset($_SESSION['accountID']);
		unset($_SESSION['toID']);
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
		
		foreach($accountIDs as $aID){
			unset($_SESSION['transferSelectedAccount' . $aID]);
		}
		
		$accountPayees = new AccountPayees();
		$accountPayees->userID = $_SESSION['userID'];
		$toIDs = $accountPayees->getToIDs();
		
		foreach($toIDs as $tID){
			unset($_SESSION['transferSelectedAccountPayee' . $tID]);
		}
		
		if(isset($_SESSION['transferAmount'])){
		
			unset($_SESSION['transferAmount']);
		}
			
		if(isset($_SESSION['transferDescription'])){
		
			unset($_SESSION['transferDescription']);
		}
		
		if(isset($_SESSION['transferRemitter'])){
		
			unset($_SESSION['transferRemitter']);
		}
		
		if(isset($_SESSION['transferDate'])){
		
			unset($_SESSION['transferDate']);
		}
	}
}
?>