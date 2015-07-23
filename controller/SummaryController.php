<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
include 'model/Summary.php';

class SummaryController {
	
	private $_summary;
	
	// Constructor.
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getter.
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	
	// Setter.
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	
	public function display() {
		include 'view/layout/summary.php';
	}
	
	public function summary(){
		return $this->_summary->accounts();
	}
	
	public function summaryCredit(){
		return $this->_summary->credit();
	}
	
	public function summaryDebit(){
		return $this->_summary->debit();
	}
	
	public function summaryNet(){
		return $this->_summary->net();
	}
}
?>