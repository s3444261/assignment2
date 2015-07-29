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

		if(!isset($_SESSION['accountPayee'])){
			$_SESSION['accountPayee'] = array();
			$_SESSION['accountPayee'][] = array('accountPayeeID' => '1',
					'accountPayeeName' => 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)'
			);
			$_SESSION['accountPayee'][] = array('accountPayeeID' => '2',
					'accountPayeeName' => 'M. Kinkead/083-332 22-123-9876 ($3,345.87)'
			);
			$_SESSION['accountPayee'][] = array('accountPayeeID' => '3',
					'accountPayeeName' => 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)'
			);
			$_SESSION['accountPayee'][] = array('accountPayeeID' => '4',
					'accountPayeeName' => 'C. K. Kinkead/083-554 21-445-543 ($8,456.45)'
			);
			$_SESSION['accountPayee'][] = array('accountPayeeID' => '5',
					'accountPayeeName' => 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)'
			);
		}
	}
	
	public function cancelSessions(){
		
		unset($_SESSION['accountID']);
		unset($_SESSION['accountPayeeID']);
		
		$accountIDs = array(1,2,3);
		
		foreach($accountIDs as $aID){
			unset($_SESSION['transferSelectedAccount' . $aID]);
		}
		
		$accountPayeeIDs = array(1,2,3,4,5);
		
		foreach($accountPayeeIDs as $pID){
			unset($_SESSION['transferSelectedAccountPayee' . $pID]);
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