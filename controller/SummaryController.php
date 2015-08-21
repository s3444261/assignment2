<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */

class SummaryController {
	
	// Display the Account Summary Page
	public function display() {
		$_SESSION['summaryAccounts'] = $this->summary();
		$_SESSION['summaryCreditBalance'] = $this->getCreditBalance();
		$_SESSION['summaryDebitBalance'] = $this->getDebitBalance();
		$_SESSION['summaryNetBalance'] = $this->getNetBalance();
		include 'view/layout/summary.php';
	}
	
	// Retrieve the summary of accounts.
	public function summary(){
		$summary = new Summary();
		return $summary->getAccounts();
	}
	
	// Retrieve the Credit Balance of the accounts.
	public function getCreditBalance(){
		$summary = new Summary();
		return $summary->getCreditBalance();
	}
	
	// Retrieve the Debit balance of the accounts.
	public function getDebitBalance(){
		$summary = new Summary();
		return $summary->getDebitBalance();
	}
	
	// Retrieve the Net Balance of the accounts.
	public function getNetBalance(){
		$summary = new Summary();
		return $summary->getNetBalance();
	}
}
?>