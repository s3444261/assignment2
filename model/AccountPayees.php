<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class AccountPayees
{
	// Attributes
	private $_accountPayeeID = '';
	private $_userID = '';
	private $_accountName = '';
	private $_accountType = '';
	private $_toID = '';

	// Constructor
	function __construct($args  = array()){
		foreach($args as $key => $val) {
			$name = '_' . $key;
			if(isset($this->{$name})) {
				$this->{$name} = $val;
			}
		}
	}

	// Getters
	public function &__get($name)
	{
		$name = '_'.$name;
		return $this->$name;
	}

	// Setters
	public function __set($name, $value)
	{
		$name = '_'.$name;
		$this->$name = $value;
	}
	
	// Retrieves either an accountID or a payeeID from the database
	// as required.
	public function getAccountPayee()
	{
		$id = explode('-', $this->_accountPayeeID);
		if($id[0] == 'a'){
			$this->_accountType = 'Account';
			
		} elseif($id[0] == 'p'){
			$this->_accountType = 'Payee';
		}
		$id = $id[1];
		
		if($this->_accountType == 'Account'){
			$query = "SELECT accountID AS toID, accountName
						FROM Accounts
						WHERE accountID = :accountID";
		} elseif($this->_accountType == 'Payee'){
			$query = "SELECT payeeID AS toID, accountName
						FROM Payees
						WHERE payeeID = :accountID";
		}
		
		$db = Database::getInstance();
		$stmt = $db->prepare($query);
		$stmt->bindParam(':accountID', $id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->_toID = $row['toID'];
		$this->_accountName = $row['accountName'];
	}
    
	// Retrieves both accountID's and payeeID's from the database.
    public function getBoth()
    {
    	$query = "SELECT CONCAT('a-', accountID) AS toID, accountName
					FROM Accounts
					WHERE userID = :userID
					UNION
					SELECT CONCAT('p-', payeeID) AS toID, accountName
					FROM Payees
					WHERE userID = :userID
					AND payeeStatus != 'deleted'
					ORDER BY accountName ASC";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$accountPayees = array();
    	 
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		$accountPayee = array('toID' => $row['toID'],
    								'accountName' => $row['accountName']
    							);
    		$accountPayees[] = $accountPayee;
    	}
    	 
    	return $accountPayees;
    }
    
    // Retrieves either account or payeeID's of an account a transfer is
    // to be made to.
    public function getToIDs()
    {
    	$query = "SELECT CONCAT('a-', accountID) AS toID
					FROM Accounts
					WHERE userID = :userID
					UNION
					SELECT CONCAT('p-', payeeID) AS toID
					FROM Payees
					WHERE userID = :userID
					AND payeeStatus != 'deleted'
					ORDER BY toID ASC";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$toIDs = array();
    
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		$toIDs[] = $row['toID'];
    	}
    
    	return $toIDs;
    }
}
?>