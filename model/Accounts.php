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

class Accounts
{		
	// Attribute
	private $_userID = '';
	
	// Constructor
	function __construct($args  = array()){
		foreach($args as $key => $val) {
			$name = '_' . $key;
			if(isset($this->{$name})) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getter
	public function &__get($name)
    {
        $name = '_'.$name;
		return $this->$name;
    }

    // Setter
	public function __set($name, $value)
    {
        $name = '_'.$name;
		$this->$name = $value;
    }
    
    // Retrieves all accounts from the database for a user.
    public function getAccounts(){
    	 
    	$query = "SELECT *
    				FROM Accounts
    				WHERE userID = :userID";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$accounts = array();
    	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	
    		$account = array('accountID' => $row['accountID'],
    				'userID' => $row['userID'],
    				'bsb' => $row['bsb'],
    				'accountNumber' => $row['accountNumber'],
    				'accountName' => $row['accountName'],
    				'accountNickname' => $row['accountNickname'],
		    		'productName' => $row['productName'],
		    		'recordedLimit' => $row['recordedLimit'],
    				'openDate' => $row['openDate'],
    				'openBalance' => $row['openBalance']
    		);
    		
    		$acct = new Account();
    		$acct->accountID = $row['accountID'];
    		$account['currentBalance'] = $acct->currentBalance();
    		$account['availableBalance'] = $acct->availableBalance();
    		
    		$accounts[] = $account;
    	}
    	
    	return $accounts;
    }
    
    // Retrieve the furst account on a users list from the database.
    public function getFirstAccount(){
    
    	$query = "SELECT *
					FROM Accounts
					WHERE userID = :userID
					ORDER BY accountID ASC
					LIMIT 0,1";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$accounts = array();
    	 
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    		 
    	$account = array('accountID' => $row['accountID'],
    				'userID' => $row['userID'],
    				'bsb' => $row['bsb'],
    				'accountNumber' => $row['accountNumber'],
    				'accountName' => $row['accountName'],
    				'accountNickname' => $row['accountNickname'],
    				'productName' => $row['productName'],
    				'recordedLimit' => $row['recordedLimit'],
    				'openDate' => $row['openDate'],
    				'openBalance' => $row['openBalance']
    	);
    	 
    	return $account;
    }
    
    // Retrieves all accountID's for accounts listed for a user in the database.
    public function getAccountIDs(){
    
    	$query = "SELECT accountID
    				FROM Accounts
    				WHERE userID = :userID";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$accountIDs = array();
    	 
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    		$accountIDs[] = $row['accountID'];
    	}
    	 
    	return $accountIDs;
    }
    
    // Retrieves the credit balance for all a users accounts.
    public function getCreditBalance(){
    	$creditBalance = null;
    	$accounts = $this->getAccounts(); 
    	foreach($accounts as $acct){
    		if($acct['currentBalance'] > 0){
    			$creditBalance += $acct['currentBalance'];
    		}
    	}
    	return $creditBalance;
    }
    
    // Retrieve the debit balance for all a users accounts.
    public function getDebitBalance(){
    	$debitBalance = null;
    	$accounts = $this->getAccounts(); 
    	foreach($accounts as $acct){
    		if($acct['currentBalance'] < 0){
    			$debitBalance += $acct['currentBalance'];
    		}
    	}
    	return -($debitBalance);
    }
    
    // Retrieves the net balance for all a users accounts.
    public function getNetBalance(){
    	$netBalance = null;
    	$accounts = $this->getAccounts(); 
    	foreach($accounts as $acct){
    		$netBalance += $acct['currentBalance'];
    	}
    	return $netBalance;
    }
	
    // Display Object Contents
    public function printf()
    {
    	echo '<br /><strong>Accounts Object:</strong><br />';
    	if($this->_userID){
    		echo 'userID => ' . $this->_userID . '<br/>';
    	}
    }
}
?>