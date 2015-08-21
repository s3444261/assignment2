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
	
	// Retrive all accounts for the user.
	public function getAccounts(){
		
		$accounts = new Accounts(); 
		$accounts->userID = $_SESSION['userID'];
		return $accounts->getAccounts();
	}
	
	// Retrieve the credit balance for the accounts.
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
	
	// Retrieve the debit balance for the accounts.
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
	
	// Retrieve the net balance for the accounts.
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