<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class History {
	public function init() {
		
		// Retrieves the initial values to be displayed in the Account History Page.
		$accounts = new Accounts ();
		$accounts->userID = $_SESSION ['userID'];
		
		if (! isset ( $_SESSION ['accounts'] )) {
			$_SESSION ['accounts'] = $accounts->getAccounts ();
		}
		
		if (! isset ( $_SESSION ['accountID'] )) {
			$account = $accounts->getFirstAccount ();
			$_SESSION ['accountID'] = $firstAccount ['accountID'];
		} else {
			$acct = new Account();
			$acct->accountID = $_SESSION ['accountID'];
			$acct->getAccount();
			$openBalance = $acct->openBalance;
			$account = array('openBalance' => $openBalance);
		}
		
		$this->setAccountSelected ( $_SESSION ['accountID'] );
		
		$_SESSION ['toDate'] = date ( 'Y-m-d' );
		$_SESSION ['fromDate'] = date ( "Y-m-d", strtotime ( "-1 months" ) );
		
		$transactions = new Transactions ();
		$transactions->accountID = $_SESSION ['accountID'];
		$arr = array (
				'openBalance' => $account ['openBalance'] 
		);
		$_SESSION ['history'] = $transactions->getTransactions ( $arr );
		$_SESSION ['found'] = $transactions->countTransactions ( $arr );
		$_SESSION ['historyDebit'] = $transactions->getDebits ( $arr );
		$_SESSION ['historyCredit'] = $transactions->getCredits ( $arr );
		$_SESSION ['historyFee'] = $transactions->getFees ( $arr );
		$_SESSION ['historyNet'] = $transactions->getNet ( $arr );
		$_SESSION ['period'] = date ( 'd/m/Y', strtotime ( $_SESSION ['fromDate'] ) ) . ' to ' . date ( 'd/m/Y', strtotime ( $_SESSION ['toDate'] ) );
	}
	public function unsetLast() {
		unset ( $_SESSION ['accounts'] );
		unset ( $_SESSION ['history'] );
		unset ( $_SESSION ['fromDate'] );
		unset ( $_SESSION ['toDate'] );
		unset ( $_SESSION ['period'] );
		unset ( $_SESSION ['found'] );
		unset ( $_SESSION ['historyDebit'] );
		unset ( $_SESSION ['historyFee'] );
		unset ( $_SESSION ['historyCredit'] );
		unset ( $_SESSION ['historyNet'] );
	}
	
	// Displays Account History based on search results.
	public function searchResults($search) {
		$accounts = new Accounts ();
		$accounts->userID = $_SESSION ['userID'];
		
		$_SESSION ['accounts'] = $accounts->getAccounts ();
		$_SESSION ['accountID'] = $search ['accountID'];
		$this->setAccountSelected ( $_SESSION ['accountID'] );
		$account = new Account ();
		$account->accountID = $_SESSION ['accountID'];
		$account->getAccount ();
		
		$_SESSION ['searchDetails'] = $search ['searchDetails'];
		
		$_SESSION ['fromAmount'] = $search ['fromAmount'];
		$_SESSION ['toAmount'] = $search ['toAmount'];
		
		if (strlen ( $search ['toDate'] ) != 0) {
			$_SESSION ['toDate'] = $search ['toDate'];
		} else {
			$_SESSION ['toDate'] = date ( 'Y-m-d' );
		}
		if (strlen ( $search ['fromDate'] ) != 0) {
			$_SESSION ['fromDate'] = $search ['fromDate'];
		} else {
			$_SESSION ['fromDate'] = date ( "Y-m-d", strtotime ( "-1 months" ) );
		}
		$_SESSION ['period'] = date ( 'd/m/Y', strtotime ( $_SESSION ['fromDate'] ) ) . ' to ' . date ( 'd/m/Y', strtotime ( $_SESSION ['toDate'] ) );
		
		$transactions = new Transactions ();
		$transactions->accountID = $_SESSION ['accountID'];
		$arr = array (
				'openBalance' => $account->openBalance 
		);
		$_SESSION ['history'] = $transactions->getTransactions ( $arr );
		$_SESSION ['found'] = $transactions->countTransactions ( $arr );
		$_SESSION ['historyDebit'] = $transactions->getDebits ( $arr );
		$_SESSION ['historyCredit'] = $transactions->getCredits ( $arr );
		$_SESSION ['historyFee'] = $transactions->getFees ( $arr );
		$_SESSION ['historyNet'] = $transactions->getNet ( $arr );
	}
	
	// Sets the Account selected.
	public function setAccountSelected($accountID) {
		$accounts = new Accounts ();
		$accounts->userID = $_SESSION ['userID'];
		$accountIDs = $accounts->getAccountIDs ();
		
		foreach ( $accountIDs as $aID ) {
			unset ( $_SESSION ['selectedAccount' . $aID] );
		}
		$_SESSION ['selectedAccount' . $accountID] = 'selected="selected"';
	}
}
?>