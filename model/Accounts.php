<?php
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class Accounts
{		
	private $_userID = '';
	
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