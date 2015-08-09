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
		
		if (isset ( $_SESSION ['billPaymentList'] )) {
			$this->getBillPayments ();
		} elseif (isset ( $_SESSION ['fundsTransferPaymentList'] )) {
			$this->getFundsTransferPayments ();
		} elseif (isset ( $_SESSION ['allPaymentList'] )) {
			$this->getAllPayments ();
		}
	}
	
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
		
		if (isset ( $_SESSION ['billPaymentList'] )) {
			$this->getBillPayments ();
		} elseif (isset ( $_SESSION ['fundsTransferPaymentList'] )) {
			$this->getfundsTransferPayments ();
		} elseif (isset ( $_SESSION ['allPaymentList'] )) {
			$this->getAllPayments ();
		}
		
		
	}
	
	public function setAccountSelected($accountID){
		$accounts = new Accounts();
		$accounts->userID = $_SESSION['userID'];
		$accountIDs = $accounts->getAccountIDs();
	
		foreach($accountIDs as $aID){
			unset ( $_SESSION ['payListSelectedAccount' . $aID] );
		}
		$_SESSION ['payListSelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	public function getBillPayments() {
		$payments = new Transactions();
		$payments->accountID = $_SESSION ['accountID'];
		$payments->transactionType = 'Biller';
		$_SESSION ['payeeTransactions'] = $payments->getPayments();
		$_SESSION['numPayments'] = $payments->countPayments(); 
	}
	public function getFundsTransferPayments() {
		$payments = new Transactions();
		$payments->accountID = $_SESSION ['accountID'];
		$payments->transactionType = 'Payee';
		$_SESSION ['payeeTransactions'] = $payments->getPayments();
		$_SESSION['numPayments'] = $payments->countPayments();
	}
	public function getAllPayments() {
		$payments = new Transactions();
		$payments->accountID = $_SESSION ['accountID'];
		$payments->transactionType = 'Both';
		$_SESSION ['payeeTransactions'] = $payments->getPayments();
		$_SESSION['numPayments'] = $payments->countPayments();
	}
}
?>