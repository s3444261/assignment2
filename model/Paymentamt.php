<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Paymentamt {
	
	public function init(){
		
		if(isset($_SESSION['payAccountID'])){
			$this->setAccountSelected($_SESSION['payAccountID']);
		}
		
		if(isset($_SESSION['payBillerID'])){
			$this->setBillerSelected($_SESSION['payBillerID']);
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
		
		if(isset($_SESSION['payBillerID'])){
			switch($_SESSION['payBillerID']){
				case 1 : 
					$_SESSION['payBillerCode'] = '000004629';
					$_SESSION['payBillerName'] = 'ASIC';
					$_SESSION['payBillerNickname'] = 'ASIC';
					$_SESSION['payCustomerRef'] = '55439987';
					break;
				case 2 :
					$_SESSION['payBillerCode'] = '000008789';
					$_SESSION['payBillerName'] = 'CITY OF YARRA';
					$_SESSION['payBillerNickname'] = 'City of Yarra';
					$_SESSION['payCustomerRef'] = '38769989';
					break;
				case 3 :
					$_SESSION['payBillerCode'] = '000005249';
					$_SESSION['payBillerName'] = 'SRO LANDTAX';
					$_SESSION['payBillerNickname'] = 'Land Tax';
					$_SESSION['payCustomerRef'] = '44349987';
					break;
			}
		}
	}
	
	public function unsetLast(){
		unset($_SESSION['accounts']);
		unset($_SESSION['billers']);
	}
	
	public function setAccountSelected($accountID){
		$accountIDs = array(1,2,3);
		
		foreach($accountIDs as $aID){
			unset($_SESSION['paySelectedAccount' . $aID]);
		}
		$_SESSION['paySelectedAccount' . $accountID] = 'selected="selected"';
	}
	
	public function setBillerSelected($billerID){
		$billerIDs = array(1,2,3);
	
		foreach($billerIDs as $bID){
			unset($_SESSION['paySelectedBiller' . $bID]);
		}
		$_SESSION['paySelectedBiller' . $billerID] = 'selected="selected"';
	}
}
?>