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
	
	// Initialize the New Funds Transfer Page.
	public function init() {
		if (isset ( $_POST ['transferNewFundsTransfer'] )) {
			$this->cancelSessions ();
			unset ( $_POST ['transferNewFundsTransfer'] );
		}
		
		$accounts = new Accounts ();
		$accounts->userID = $_SESSION ['userID'];
		$_SESSION ['accounts'] = $accounts->getAccounts ();
		
		$accountPayees = new AccountPayees ();
		$accountPayees->userID = $_SESSION ['userID'];
		$_SESSION ['accountPayee'] = $accountPayees->getBoth ();
	}
	
	// Cancel any extraneous sessions for a funds transfer.
	public function cancelSessions() {
		unset ( $_SESSION ['accountID'] );
		unset ( $_SESSION ['toID'] );
		
		$accounts = new Accounts ();
		$accounts->userID = $_SESSION ['userID'];
		$accountIDs = $accounts->getAccountIDs ();
		
		foreach ( $accountIDs as $aID ) {
			unset ( $_SESSION ['transferSelectedAccount' . $aID] );
		}
		
		$accountPayees = new AccountPayees ();
		$accountPayees->userID = $_SESSION ['userID'];
		$toIDs = $accountPayees->getToIDs ();
		
		foreach ( $toIDs as $tID ) {
			unset ( $_SESSION ['transferSelectedAccountPayee' . $tID] );
		}
		
		if (isset ( $_SESSION ['transferAmount'] )) {
			
			unset ( $_SESSION ['transferAmount'] );
		}
		
		if (isset ( $_SESSION ['transferDescription'] )) {
			
			unset ( $_SESSION ['transferDescription'] );
		}
		
		if (isset ( $_SESSION ['transferRemitter'] )) {
			
			unset ( $_SESSION ['transferRemitter'] );
		}
		
		if (isset ( $_SESSION ['transferDate'] )) {
			
			unset ( $_SESSION ['transferDate'] );
		}
	}
}
?>