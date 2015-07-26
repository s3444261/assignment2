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
	
	public function init(){
		$payment = new Payment();
		$payment->cancelSessions();
		
		if(!isset($_SESSION['accounts'])){
			$_SESSION['accounts'] = array();
			$_SESSION['accounts'][] = array('accountID' => '1',
					'accountName' => 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)'
			);
			$_SESSION['accounts'][] = array('accountID' => '2',
					'accountName' => 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)'
			);
			$_SESSION['accounts'][] = array('accountID' => '3',
					'accountName' => 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)'
			);
		}
		
		if(!isset($_SESSION['payees'])){
			$_SESSION['payees'] = array();
			$_SESSION['payees'][] = array('payeeID' => '1',
					'payeeNickname' => 'CITY WEST WATER'
			);
			$_SESSION['payees'][] = array('payeeID' => '2',
					'payeeNickname' => 'GLEN EIRA CITY COUNCIL'
			);
			$_SESSION['payees'][] = array('payeeID' => '3',
					'payeeNickname' => 'VICROADS'
			);
		}
		
		if(!isset($_SESSION['payeeTransactions'])){
			$_SESSION['payeeTransactions'] = array();
			$_SESSION['payeeTransactions'][] = array('payeeDate' => '13 Jul 15',
					'payeeType' => 'Bill Payment',
					'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
					'payeePayTo' => 'CITY WEST WATER LIMITED',
					'payeeStatus' => 'Paid',
					'payeeAmount' => '198.48'
			);
			$_SESSION['payeeTransactions'][] = array('payeeDate' => '29 May 15',
					'payeeType' => 'Bill Payment',
					'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
					'payeePayTo' => 'YARRA CITY COUNCIL RATES',
					'payeeStatus' => 'Paid',
					'payeeAmount' => '410.00'
			);
			$_SESSION['payeeTransactions'][] = array('payeeDate' => '26 May 15',
					'payeeType' => 'Bill Payment',
					'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
					'payeePayTo' => 'STATE REVENUE OFFICE VIC LAND TAX',
					'payeeStatus' => 'Paid',
					'payeeAmount' => '626.81'
			);
			$_SESSION['payeeTransactions'][] = array('payeeDate' => '22 May 15',
					'payeeType' => 'Bill Payment',
					'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
					'payeePayTo' => 'RACV INSURANCE PTY LTD',
					'payeeStatus' => 'Paid',
					'payeeAmount' => '159.48'
			);
			$_SESSION['payeeTransactions'][] = array('payeeDate' => '19 May 15',
					'payeeType' => 'Bill Payment',
					'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
					'payeePayTo' => 'RACV INSURANCE PTY LTD',
					'payeeStatus' => 'Paid',
					'payeeAmount' => '137.21'
			);
		}
	}
	
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['payeeTransactions']);
		unset($_SESSION['paymentType']);
		unset($_SESSION['payees']);
		unset($_SESSION['status']);
		unset($_SESSION['payListFromAmount']);
		unset($_SESSION['payListToAmount']);
		unset($_SESSION['payListFromDate']);
		unset($_SESSION['payListToDate']);
	}
	
	public function clearFilter(){
		$payeeIDs = array(1,2,3);
		
		foreach($payeeIDs as $pID){
			unset($_SESSION['payListSelectedPayee' . $pID]);
		}
		unset($_SESSION['paidSelected']);
		unset($_SESSION['pendingSelected']);
		unset($_SESSION['payListFromAmount']);
		unset($_SESSION['payListToAmount']);
		unset($_SESSION['payListFromDate']);
		unset($_SESSION['payListToDate']);
	}
	
	public function searchResults($search){
	
		switch($search['paymentType']){
			case 'All Payment Types' :
				$_SESSION['AllPaymentList'] = 'selected="selected"';
				unset($_SESSION['billPaymentList']);
				unset($_SESSION['fundsTransferPaymentList']);
				break;
			case 'Bill Payment' :
				unset($_SESSION['AllPaymentList']);
				$_SESSION['billPaymentList'] = 'selected="selected"';
				unset($_SESSION['fundsTransferPaymentList']);
				break;
			case 'Funds Transfer' :
				unset($_SESSION['AllPaymentList']);
				unset($_SESSION['billPaymentList']);
				$_SESSION['fundsTransferPaymentList'] = 'selected="selected"';
				break;
		}
		
		if(!isset($_SESSION['accounts'])){
			$_SESSION['accounts'] = array();
			$_SESSION['accounts'][] = array('accountID' => '1',
					'accountName' => 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)'
			);
			$_SESSION['accounts'][] = array('accountID' => '2',
					'accountName' => 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)'
			);
			$_SESSION['accounts'][] = array('accountID' => '3',
					'accountName' => 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)'
			);
		}
	
		$_SESSION['accountID'] = $search['accountID'];
	
		$this->setAccountSelected($_SESSION['accountID']);
		
		if(!isset($_SESSION['payees'])){
			$_SESSION['payees'] = array();
			$_SESSION['payees'][] = array('payeeID' => '1',
					'payeeNickname' => 'CITY WEST WATER'
			);
			$_SESSION['payees'][] = array('payeeID' => '2',
					'payeeNickname' => 'GLEN EIRA CITY COUNCIL'
			);
			$_SESSION['payees'][] = array('payeeID' => '3',
					'payeeNickname' => 'VICROADS'
			);
		}
		
		$_SESSION['payeeID'] = $search['payeeID'];
		
		$this->setPayeeSelected($_SESSION['payeeID']);
		
		switch($search['status']){
			case 'Paid' :
				$_SESSION['paidSelected'] = 'selected="selected"';
				unset($_SESSION['pendingSelected']);
				break;
			case 'Pending' :
				unset($_SESSION['paidSelected']);
				$_SESSION['pendingSelected'] = 'selected="selected"';
				break;
		}
		
		$_SESSION['payListFromAmount'] = $search['payListFromAmount'];
		$_SESSION['payListToAmount'] = $search['payListToAmount'];
		$_SESSION['payListFromDate'] = $search['payListFromDate'];
		$_SESSION['payListToDate'] = $search['payListToDate'];
	
		if(isset($_SESSION['billPaymentList'])){
			if(!isset($_SESSION['payeeTransactions'])){
				$_SESSION['payeeTransactions'] = array();
				$_SESSION['payeeTransactions'][] = array('payeeDate' => '13 Jul 15',
						'payeeType' => 'Bill Payment',
						'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
						'payeePayTo' => 'CITY WEST WATER LIMITED',
						'payeeStatus' => 'Paid',
						'payeeAmount' => '198.48'
				);
				$_SESSION['payeeTransactions'][] = array('payeeDate' => '29 May 15',
						'payeeType' => 'Bill Payment',
						'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
						'payeePayTo' => 'YARRA CITY COUNCIL RATES',
						'payeeStatus' => 'Paid',
						'payeeAmount' => '410.00'
				);
				$_SESSION['payeeTransactions'][] = array('payeeDate' => '26 May 15',
						'payeeType' => 'Bill Payment',
						'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
						'payeePayTo' => 'STATE REVENUE OFFICE VIC LAND TAX',
						'payeeStatus' => 'Paid',
						'payeeAmount' => '626.81'
				);
				$_SESSION['payeeTransactions'][] = array('payeeDate' => '22 May 15',
						'payeeType' => 'Bill Payment',
						'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
						'payeePayTo' => 'RACV INSURANCE PTY LTD',
						'payeeStatus' => 'Paid',
						'payeeAmount' => '159.48'
				);
				$_SESSION['payeeTransactions'][] = array('payeeDate' => '19 May 15',
						'payeeType' => 'Bill Payment',
						'payeePayFrom' => 'Kinkead Family Trust/083-006 45-333-3232',
						'payeePayTo' => 'RACV INSURANCE PTY LTD',
						'payeeStatus' => 'Paid',
						'payeeAmount' => '137.21'
				);
			}
		}
	}
	
	public function setAccountSelected($accountID){
		$accountIDs = array(1,2,3);
	
		foreach($accountIDs as $aID){
			unset($_SESSION['payListSelectedAccount' . $aID]);
		}
		$_SESSION['payListSelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	public function setPayeeSelected($payeeID){
		$payeeIDs = array(1,2,3);
	
		foreach($payeeIDs as $pID){
			unset($_SESSION['payListSelectedPayee' . $pID]);
		}
		$_SESSION['payListSelectedPayee' . $payeeID] = 'selected="selected"';
	}
}
?>