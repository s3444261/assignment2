<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
if (! class_exists ( 'Database' )) {
	require_once ('connect/Database.php');
}
class Payees {
	// Attributes
	private $_payeeID = '';
	private $_userID = '';
	private $_bsb = '';
	private $_accountNumber = '';
	private $_accountName = '';
	private $_accountNickname = '';
	private $_payeeStatus = '';
	private $_created_at;
	private $_updated_at;
	
	// Constructor
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getters
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	
	// Setters
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	
	// Retrieve the payee from the database.
	public function getPayee() {
		$query = "SELECT *
    				FROM Payees
    				WHERE payeeID = :payeeID
    				AND payeeStatus != 'deleted'";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':payeeID', $this->_payeeID );
		$stmt->execute ();
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		$this->_userID = $row ['userID'];
		$this->_bsb = $row ['bsb'];
		$this->_accountNumber = $row ['accountNumber'];
		$this->_accountName = $row ['accountName'];
		$this->_accountNickname = $row ['accountNickname'];
		$this->_payeeStatus = $row ['payeeStatus'];
	}
	
	// Retrieve the users payees.
	public function getPayees() {
		$query = "SELECT *
    				FROM Payees
    				WHERE userID = :userID
    				AND payeeStatus != 'deleted'";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':userID', $this->_userID );
		$stmt->execute ();
		$payees = array ();
		
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			
			$payee = array (
					'payeeID' => $row ['payeeID'],
					'userID' => $row ['userID'],
					'bsb' => $row ['bsb'],
					'accountNumber' => $row ['accountNumber'],
					'accountName' => $row ['accountName'],
					'accountNickname' => $row ['accountNickname'],
					'payeeStatus' => $row ['payeeStatus'] 
			);
			
			$payees [] = $payee;
		}
		
		return $payees;
	}
	
	// Retrieve the payeeID's for the users payees.
	public function getPayeeIDs() {
		$query = "SELECT payeeID
    				FROM Payees
    				WHERE userID = :userID
    				AND payeeStatus != 'deleted'";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':userID', $this->_userID );
		$stmt->execute ();
		$payeeIDs = array ();
		
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			
			$payeeIDs [] = $row ['payeeID'];
		}
		
		return $payeeIDs;
	}
	
	// Insert a payee into the database for the user.
	public function set() {
		$query = "INSERT INTO Payees
					SET userID = :userID,
    					bsb = :bsb,
    					accountNumber = :accountNumber,
		    			accountName = :accountName,
		    			accountNickname = :accountNickname,
		    			payeeStatus = :payeeStatus,
						created_at = NULL";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':userID', $this->_userID );
		$stmt->bindParam ( ':bsb', $this->_bsb );
		$stmt->bindParam ( ':accountNumber', $this->_accountNumber );
		$stmt->bindParam ( ':accountName', $this->_accountName );
		$stmt->bindParam ( ':accountNickname', $this->_accountNickname );
		$stmt->bindParam ( ':payeeStatus', $this->_payeeStatus );
		$stmt->execute ();
		$this->_payeeID = $db->lastInsertId ();
		if ($this->_payeeID > 0) {
			return $this->_payeeID;
		} else {
			return 0;
		}
	}
	
	// Update a payee in the database.
	public function update() {
		$query = "UPDATE Payees
					SET accountName = :accountName,
		    			accountNickname = :accountNickname,
    					bsb = :bsb,
    					accountNumber = :accountNumber
    				WHERE payeeID = :payeeID";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':payeeID', $this->_payeeID );
		$stmt->bindParam ( ':accountName', $this->_accountName );
		$stmt->bindParam ( ':accountNickname', $this->_accountNickname );
		$stmt->bindParam ( ':bsb', $this->_bsb );
		$stmt->bindParam ( ':accountNumber', $this->_accountNumber );
		$stmt->execute ();
		return true;
	}
	
	// Set a payee as deleted in the database so that the payee can no longer be viewed.
	public function delete() {
		$query = "UPDATE Payees
					SET payeeStatus = 'deleted'
    				WHERE payeeID = :payeeID";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':payeeID', $this->_payeeID );
		$stmt->execute ();
		return true;
	}
	
	// Display Object Contents
	public function printf() {
		echo '<br /><strong>Account Object:</strong><br />';
		if ($this->_payeeID) {
			echo 'payeeID => ' . $this->_payeeID . '<br/>';
		}
		if ($this->_userID) {
			echo 'userID => ' . $this->_userID . '<br/>';
		}
		if ($this->_accountNumber) {
			echo 'accountNumber => ' . $this->_accountNumber . '<br/>';
		}
		if ($this->_accountName) {
			echo 'accountName => ' . $this->_accountName . '<br/>';
		}
		if ($this->_accountNickname) {
			echo 'accountNickname => ' . $this->_accountNickname . '<br/>';
		}
		if ($this->_payeeStatus) {
			echo 'payeeStatus => ' . $this->_payeeStatus . '<br/>';
		}
		if ($this->_created_at) {
			echo '<br/>created_at => ' . $this->_created_at . '<br/>';
		}
		if ($this->_updated_at) {
			echo 'updated_at => ' . $this->_updated_at . '<br/>';
		}
	}
}
?>