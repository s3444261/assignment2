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
	
	// Attributes.
	private static $_instance;
	
	// Singleton Pattern.
	public static function getInstance() {
		if (! isset ( self::$_instance )) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	
	public function accounts(){
		
		$results = array();
		
		$results[] = array('account' => 'Kinkead Family Trust',
				'currentBalance' => '58.47 CR',
				'availableBalance' => '58.47',
				'bsb' => '083-016',
				'accountNo' => '87-456-8734'
		);
		
		$results[] = array('account' => 'Kinkead Murphy Unit Trust',
				'currentBalance' => '48183.10 CR',
				'availableBalance' => '48183.10',
				'bsb' => '083-016',
				'accountNo' => '87-456-8874'
		);
		
		$results[] = array('account' => 'Kinkead Super Fund',
				'currentBalance' => '14483.10 CR',
				'availableBalance' => '14483.10',
				'bsb' => '083-016',
				'accountNo' => '87-456-8721'
		);
		
		return $results;
	}
	
	public function credit(){
		$credit = '68768.10 CR';
		return $credit;
	}
	
	public function debit(){
		$debit = '0.00 DR';
		return $debit;
	}
	
	public function net(){
		$net = '68768.10 CR';
		return $net;
	}
}
?>