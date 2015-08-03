<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Summary {
	
	public function getAccounts(){
		
		$accounts = new Accounts(); 
		$accounts->userID = $_SESSION['userID'];
		return $accounts->getAccounts();
	}
	
	public function getCreditBalance(){
		$accounts = new Accounts(); 
		$accounts->userID = $_SESSION['userID'];
		$cb = number_format($accounts->getCreditBalance(), 2);
		if($cb >= 0){
			$cb = $cb . ' CR';
		} else {
			$cb = $cb . ' DR';
		}
		return $cb;
	}
	
	public function getDebitBalance(){
		$accounts = new Accounts(); 
		$accounts->userID = $_SESSION['userID'];
		$db = number_format($accounts->getDebitBalance(), 2);
		if($db >= 0){
			$db = $db . ' CR';
		} else {
			$db = $db . ' DR';
		}
		return $db;
	}
	
	public function getNetBalance(){
		$accounts = new Accounts(); 
		$accounts->userID = $_SESSION['userID'];
		$nb = number_format($accounts->getNetBalance(), 2);
		if($nb >= 0){
			$nb = $nb . ' CR';
		} else {
			$nb = $nb . ' DR';
		}
		return $nb;
	}
}
?>