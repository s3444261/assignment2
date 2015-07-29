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
		
		switch($_SESSION['transferAccountID']){
				case 1 : 
				$_SESSION['transferAccount'] = 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)';
				break;
			case 2 :
				$_SESSION['transferAccount'] = 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)';
				break;
			case 3 :
				$_SESSION['transferAccount'] = 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)';
				break;
		}
		
		switch($_SESSION['transferAccountPayeeID']){
			case 1 :
				$_SESSION['transferAccountPayee'] = 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)';
				break;
			case 2 :
				$_SESSION['transferAccountPayee'] = 'M. Kinkead/083-332 22-123-9876 ($3,345.87)';
				break;
			case 3 :
				$_SESSION['transferAccountPayee'] = 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)';
				break;
			case 4 :
				$_SESSION['transferAccountPayee'] = 'C. K. Kinkead/083-554 21-445-543 ($8,456.45)';
				break;
			case 5 :
				$_SESSION['transferAccountPayee'] = 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)';
				break;
		}
		
		$this->setAccountSelected($_SESSION['transferAccountID']);
		$this->setAccountPayeeSelected($_SESSION['transferAccountPayeeID']);
	}
	
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['accountPayees']);
	}
	
	public function setAccountSelected($accountID){
		$accountIDs = array(1,2,3);
	
		foreach($accountIDs as $aID){
			unset($_SESSION['transferSelectedAccount' . $aID]);
		}
		$_SESSION['transferSelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	public function setAccountPayeeSelected($accountPayeeID){
		$accountPayeeIDs = array(1,2,3,4,5);
	
		foreach($accountPayeeIDs as $pID){
			unset($_SESSION['transferSelectedAccountPayee' . $pID]);
		}
		$_SESSION['transferSelectedAccountPayee' . $accountPayeeID] = 'selected="selected"';
	}
}
?>