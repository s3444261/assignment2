<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class Paymentlist {
	
	// Initialize the payment list for first viewing.
	public function init() {
		$payment = new Payment ();
		$payment->cancelSessions ();
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		
		$_SESSION['accounts'] = $accounts->getAccounts();
		
		$firstAccount = $accounts->getFirstAccount(); 
		$_SESSION['accountID'] = $firstAccount['accountID'];
		$this->setAccountSelected($_SESSION['accountID']);
		
		$billerPayees = new BillerPayees();
		$billerPayees->userID = $_SESSION['userID'];
		
		if(isset($_SESSION['billPayment'])){
			unset ( $_SESSION ['allPaymentList'] );
			$_SESSION ['billPaymentList'] = 'selected="selected"';
			$_SESSION ['payees'] = $billerPayees->getBillers();
			unset ( $_SESSION ['fundsTransferPaymentList'] );
			unset($_SESSION['fundsTransferPayment']);
		} elseif(isset($_SESSION['fundsTransferPayment'])){
			unset ( $_SESSION ['allPaymentList'] );
			unset ( $_SESSION ['billPaymentList'] );
			unset($_SESSION['billPayment']);
			$_SESSION ['fundsTransferPaymentList'] = 'selected="selected"';
			$_SESSION ['payees'] = $billerPayees->getPayees();
		}
		
		$this->getPayments();
	}
	
	// Initialize sessions from the last view of the payments list.
	public function unsetLast() {
		unset ( $_SESSION ['accounts'] );
		unset ( $_SESSION ['payeeTransactions'] );
		unset ( $_SESSION ['paymentType'] );
		unset ( $_SESSION ['payees'] );
		unset ( $_SESSION ['status'] );
		unset ( $_SESSION ['payListFromAmount'] );
		unset ( $_SESSION ['payListToAmount'] );
		unset ( $_SESSION ['payListFromDate'] );
		unset ( $_SESSION ['payListToDate'] );
	}
	
	// Clear the search filter.
	public function clearFilter() {
		$payees = new Payees();
		$payeeIDs = $payees->getPayeeIDs();
		
		foreach ( $payeeIDs as $pID ) {
			unset ( $_SESSION ['payListSelectedPayee' . $pID] );
		}
		unset ( $_SESSION ['payListName'] );
		unset ( $_SESSION ['payListStatus'] );
		unset ( $_SESSION ['payListFromAmount'] );
		unset ( $_SESSION ['payListToAmount'] );
		unset ( $_SESSION ['payListFromDate'] );
		unset ( $_SESSION ['payListToDate'] );
	}
	
	// Retrieve results based on search.
	public function searchResults($search) {
		$payment = new Payment ();
		$payment->cancelSessions ();
		
		$billerPayees = new BillerPayees();
		$billerPayees->userID = $_SESSION['userID'];
		
		switch ($search ['paymentType']) {
			case 'All Payment Types' :
				$_SESSION ['allPaymentList'] = 'selected="selected"';
				$_SESSION ['payees'] = $billerPayees->getBoth();
				unset ( $_SESSION ['billPaymentList'] );
				unset ( $_SESSION ['fundsTransferPaymentList'] );
				break;
			case 'Bill Payment' :
				unset ( $_SESSION ['allPaymentList'] );
				$_SESSION ['billPaymentList'] = 'selected="selected"';
				$_SESSION ['payees'] = $billerPayees->getBillers();
				unset ( $_SESSION ['fundsTransferPaymentList'] );
				break;
			case 'Funds Transfer' :
				unset ( $_SESSION ['allPaymentList'] );
				unset ( $_SESSION ['billPaymentList'] );
				$_SESSION ['fundsTransferPaymentList'] = 'selected="selected"';
				$_SESSION ['payees'] = $billerPayees->getPayees();
				break;
		}
		
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$_SESSION['accounts'] = $accounts->getAccounts(); 
		
		$_SESSION ['accountID'] = $search ['accountID'];
		$this->setAccountSelected ( $_SESSION ['accountID'] );
		
		$_SESSION ['payListName'] = $search ['payListName'];
		$_SESSION ['payListStatus'] = $search ['payListStatus'];
		$_SESSION ['payListFromAmount'] = $search ['payListFromAmount'];
		$_SESSION ['payListToAmount'] = $search ['payListToAmount'];
		$_SESSION ['payListFromDate'] = $search ['payListFromDate'];
		$_SESSION ['payListToDate'] = $search ['payListToDate'];
		
		$this->getPayments();
	}
	
	// Set the account that had been selected.
	public function setAccountSelected($accountID){
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
	
		foreach($accountIDs as $aID){
			unset ( $_SESSION ['payListSelectedAccount' . $aID] );
		}
		$_SESSION ['payListSelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	// Retrieve payments.
	public function getPayments() {
		$payments = new Transactions();
		$payments->accountID = $_SESSION ['accountID'];
		if (isset ( $_SESSION ['billPaymentList'] )) {
			$payments->transactionType = 'Biller';
		} elseif (isset ( $_SESSION ['fundsTransferPaymentList'] )) {
			$payments->transactionType = 'Payee';
		} elseif (isset ( $_SESSION ['allPaymentList'] )) {
			$payments->transactionType = 'Both';
		}
		$_SESSION ['payeeTransactions'] = $payments->getPayments();
		$_SESSION['numPayments'] = $payments->countPayments(); 
	}
}
?>