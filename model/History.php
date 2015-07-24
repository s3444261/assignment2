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
		
		if(isset($_SESSION['accountID'])){
			$this->setAccountSelected($_SESSION['accountID']);
		}
		
		if(!isset($_SESSION['history'])){
			$_SESSION['history'] = array();
			$_SESSION['history'][] = array('date' => '30 Jun 15',
					'transaction' => 'FEE ACCOUNT 083006 866784433',
					'type' => 'FEES',
					'debit' => '1.00 DR',
					'credit' => null,
					'balance' => '58.47 CR'
			);
			$_SESSION['history'][] = array('date' => '22 Jun 15',
					'transaction' => 'TT40W444234 IB Ref D2343244 TRANSFER',
					'type' => 'MISCELLANEOUS DEBIT',
					'debit' => '2022.00 DR',
					'credit' => null,
					'balance' => '59.47 CRR'
			);
			$_SESSION['history'][] = array('date' => '19 Jun 15',
					'transaction' => 'Transfer BANKVIC',
					'type' => 'INTER-BANK CREDIT',
					'debit' => null,
					'credit' => '2000.00 CR',
					'balance' => '2081.47 CR'
			);
		}
		if(!isset($_SESSION['period'])){
			$_SESSION['period'] = '04/04/15 to 13/07/15';
		}
		if(!isset($_SESSION['found'])){
			$_SESSION['found'] = '3 Transactions';
		}
		if(!isset($_SESSION['historyDebit'])){
			$_SESSION['historyDebit'] = '2022 DR';
		}
		if(!isset($_SESSION['historyFee'])){
			$_SESSION['historyFee'] = '1.00 DR';
		}
		if(!isset($_SESSION['historyCredit'])){
			$_SESSION['historyCredit'] = '2000 CR';
		}
		if(!isset($_SESSION['historyNet'])){
			$_SESSION['historyNet'] = '23 DR';
		}
	}
	
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['history']);
		unset($_SESSION['period']);
		unset($_SESSION['found']);
		unset($_SESSION['historyDebit']);
		unset($_SESSION['historyFee']);
		unset($_SESSION['historyCredit']);
		unset($_SESSION['historyNet']);
	}
	
	public function searchResults($search){
		
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
		
		$_SESSION['accountID'] = $search['accountID'];
		
		$this->setAccountSelected($_SESSION['accountID']);
		
		if(!isset($_SESSION['history'])){
			$_SESSION['history'] = array();
			$_SESSION['history'][] = array('date' => '29 May 15',
					'transaction' => 'FEE ACCOUNT 082014 435689876',
					'type' => 'FEES',
					'debit' => '2.00 DR',
					'credit' => null,
					'balance' => '53.47 CR'
			);
			$_SESSION['history'][] = array('date' => '22 May 15',
					'transaction' => 'XX40W444234 IB Ref D2343244 TRANSFER',
					'type' => 'MISCELLANEOUS DEBIT',
					'debit' => '2046.00 DR',
					'credit' => null,
					'balance' => '324.47 CRR'
			);
			$_SESSION['history'][] = array('date' => '19 May 15',
					'transaction' => 'Transfer BANKQLD',
					'type' => 'INTER-BANK CREDIT',
					'debit' => null,
					'credit' => '3000.00 CR',
					'balance' => '3081.82 CR'
			);
		}
		if(!isset($_SESSION['period'])){
			$_SESSION['period'] = '07/05/15 to 16/05/15';
		}
		if(!isset($_SESSION['found'])){
			$_SESSION['found'] = '3 Transactions';
		}
		if(!isset($_SESSION['historyDebit'])){
			$_SESSION['historyDebit'] = '4892 DR';
		}
		if(!isset($_SESSION['historyFee'])){
			$_SESSION['historyFee'] = '2.00 DR';
		}
		if(!isset($_SESSION['historyCredit'])){
			$_SESSION['historyCredit'] = '3000 CR';
		}
		if(!isset($_SESSION['historyNet'])){
			$_SESSION['historyNet'] = '57 DR';
		}
	}
	
	public function setAccountSelected($accountID){
		$accountIDs = array(1,2,3);
		
		foreach($accountIDs as $aID){
			unset($_SESSION['selectedAccount' . $aID]);
		}
		$_SESSION['selectedAccount' . $accountID] = 'selected="selected"';
	}
}
?>