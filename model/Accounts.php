<?php
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class Accounts 
{		
	private $_accountID = '';
	private $_userID = '';
	private $_bsb = '';
	private $_accountNumber = '';
	private $_accountName = '';
	private $_accountNickname = '';
	private $_productName = '';
	private $_recordedLimit = '';
	private $_created_at;
	private $_updated_at;
	
	function __construct($args  = array()){
		foreach($args as $key => $val) {
			$name = '_' . $key;
			if(isset($this->{$name})) {
				$this->{$name} = $val;
			}
		}
	}
	
	public function &__get($name)
    {
        $name = '_'.$name;
		return $this->$name;
    }

	public function __set($name, $value)
    {
        $name = '_'.$name;
		$this->$name = $value;
    }
    
    public function getAccount(){
    	
    	$query = "SELECT *
    				FROM Accounts
    				WHERE accountID = :accountID";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':accountID', $this->_accountID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->_userID = $row['userID'];
    	$this->_bsb = $row['bsb'];
    	$this->_accountNumber = $row['accountNumber'];
    	$this->_accountName = $row['accountName'];
    	$this->_accountNickname = $row['accountNickname'];
		$this->_productName = $row['productName'];
		$this->_recordedLimit = $row['recordLimit'];
    }
    
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
		    		'recordedLimit' => $row['recordLimit']);
    		 
    		$accounts[] = $account;
    	}
    	
    	return $accounts;
    }
    
    public function set(){
    	 
    	$query = "INSERT INTO Accounts
					SET userID = :userID,
    					bsb = :bsb,
    					accountNumber = :accountNumber,
		    			accountName = :accountName,
		    			accountNickname = :accountNickname,
		    			productName = :productName,
		    			recordedLimit = :recordedLimit,
						created_at = NULL";
    		
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->bindParam(':bsb', $this->_bsb);
    	$stmt->bindParam(':accountNumber', $this->_accountNumber);
    	$stmt->bindParam(':accountName', $this->_accountName);
    	$stmt->bindParam(':accountNickname', $this->_accountNickname);
    	$stmt->bindParam(':productName', $this->_productName);
    	$stmt->bindParam(':recordedLimit', $this->_recordedLimit);
    	$stmt->execute();
    	$this->_accountID = $db->lastInsertId();
    	if($this->_accountID > 0){
    		return $this->_accountID;
    	} else {
    		return 0;
    	}
    }
	
    // Display Object Contents
    public function printf()
    {
    	echo '<br /><strong>Account Object:</strong><br />';
    	if($this->_accountID){
    		echo 'accountID => ' . $this->_accountID . '<br/>';
    	}
    	if($this->_userID){
    		echo 'userID => ' . $this->_userID . '<br/>';
    	}
    	if($this->_accountNumber){
    		echo 'accountNumber => ' . $this->_accountNumber . '<br/>';
    	}
    	if($this->_accountName){
    		echo 'accountName => ' . $this->_accountName . '<br/>';
    	}
    	if($this->_accountNickname){
    		echo 'accountNickname => ' . $this->_accountNickname . '<br/>';
    	}
    	if($this->_productName){
    		echo 'productName => ' . $this->_productName . '<br/>';
    	}
    	if($this->_recordedLimit){
    		echo 'recordedLimit => ' . $this->_recordedLimit . '<br/>';
    	}
    	if($this->_created_at){
    		echo '<br/>created_at => ' . $this->_created_at . '<br/>';
    	}
    	if($this->_updated_at){
    		echo 'updated_at => ' . $this->_updated_at . '<br/>';
    	}
    }
}
?>