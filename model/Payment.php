<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Payment {
	
	public function init(){
		
		if(isset($_POST['payNewBillPayment'])){
			$payment = new Payment();
			$payment->cancelSessions();
			unset($_POST['payNewBillPayment']);
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
		
		if(!isset($_SESSION['billers'])){
			$_SESSION['billers'] = array();
			$_SESSION['billers'][] = array('billerID' => '1',
					'billerNickname' => 'ASIC'
			);
			$_SESSION['billers'][] = array('billerID' => '2',
					'billerNickname' => 'CITY OF YARRA RATES'
			);
			$_SESSION['billers'][] = array('billerID' => '3',
					'billerNickname' => 'SRO LANDTAX'
			);
		}
	}
	
	public function cancelSessions(){
		
		unset($_SESSION['payAccountID']);
		unset($_SESSION['payBillerID']);
		unset($_SESSION['payBillerCode']);
		unset($_SESSION['payBillerName']);
		unset($_SESSION['payBillerNickname']);
		unset($_SESSION['payCustomerRef']);
		
		$accountIDs = array(1,2,3);
		
		foreach($accountIDs as $aID){
			unset($_SESSION['paySelectedAccount' . $aID]);
		}
		
		$billerIDs = array(1,2,3);
		
		foreach($billerIDs as $bID){
			unset($_SESSION['paySelectedBiller' . $bID]);
		}
		
		if(isset($_SESSION['payAmount'])){
		
			unset($_SESSION['payAmount']);
		}
			
		if(isset($_SESSION['payDate'])){
				
			unset($_SESSION['payDate']);
		}
		
		if(isset($_SESSION['payAccount'])){
		
			unset($_SESSION['payAccount']);
		}
		
		if(isset($_SESSION['payStatus'])){
		
			unset($_SESSION['payStatus']);
		}
		
		if(isset($_SESSION['payConf'])){
		
			unset($_SESSION['payConf']);
		}
		
		if(isset($_SESSION['payCreated'])){
		
			unset($_SESSION['payCreated']);
		}
	}
}
?>