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
	
	public function display() {
		include 'view/layout/summary.php';
	}
	
	public function summary(){
		$summary = new Summary();
		return $summary->getAccounts();
	}
	
	public function getCreditBalance(){
		$summary = new Summary();
		return $summary->getCreditBalance();
	}
	
	public function getDebitBalance(){
		$summary = new Summary();
		return $summary->getDebitBalance();
	}
	
	public function getNetBalance(){
		$summary = new Summary();
		return $summary->getNetBalance();
	}
}
?>