<?php
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class Transactions 
{		
	private $_transactionID = '';
	private $_accountID = '';
	private $_transactionDate = '';
	private $_transactionDescription = '';
	private $_transactee = '';
	private $_accountNickname = '';
	private $_transactionStatus = '';
	private $_debits = '';
	private $_credits = '';
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
    
    public function getTransaction(){
    	
    	$query = "SELECT *
    				FROM Transactions
    				WHERE transactionID = :transactionID";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':transactionID', $this->_transactionID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->_accountID = $row['accountID'];
    	$this->_transactionDate = $row['transactionDate'];
    	$this->_transactionDescription = $row['transactionDescription'];
    	$this->_transactee = $row['transactee'];
    	$this->_transactionStatus = $row['transactionStatus'];
		$this->_debits = $row['debits'];
		$this->_credits = $row['credits'];
    }
    
    public function set(){
    	 
    	$query = "INSERT INTO Transactions
					SET accountID = :accountID,
    					transactionDate = :transactionDate,
    					transactionDescription = :transactionDescription,
		    			transactee = :transactee,
		    			transactionStatus = :transactionStatus,
		    			debits = :debits,
		    			credits = :credits,
						created_at = NULL";
    		
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':accountID', $this->_accountID);
    	$stmt->bindParam(':transactionDate', $this->_transactionDate);
    	$stmt->bindParam(':transactionDescription', $this->_transactionDescription);
    	$stmt->bindParam(':transactee', $this->_transactee);
    	$stmt->bindParam(':transactionStatus', $this->_transactionStatus);
    	$stmt->bindParam(':debits', $this->_debits);
    	$stmt->bindParam(':credits', $this->_credits);
    	$stmt->execute();
    	$this->_transactionID = $db->lastInsertId();
    	if($this->_transactionID > 0){
    		return $this->_transactionID;
    	} else {
    		return 0;
    	}
    }
	
    // Display Object Contents
    public function printf()
    {
    	echo '<br /><strong>Transaction Object:</strong><br />';
    	if($this->_transactionID){
    		echo 'transactionID => ' . $this->_transactionID . '<br/>';
    	}
    	if($this->_accountID){
    		echo 'accountID => ' . $this->_accountID . '<br/>';
    	}
    	if($this->_transactionDate){
    		echo 'transactionDate => ' . $this->_transactionDate . '<br/>';
    	}
    	if($this->_transactionDescription){
    		echo 'transactionDescription => ' . $this->_transactionDescription . '<br/>';
    	}
    	if($this->_transactee){
    		echo 'transactee => ' . $this->_transactee . '<br/>';
    	}
    	if($this->_transactionStatus){
    		echo 'transactionStatus => ' . $this->_transactionStatus . '<br/>';
    	}
    	if($this->_debits){
    		echo 'debits => ' . $this->_debits . '<br/>';
    	}
    	if($this->_credits){
    		echo 'credits => ' . $this->_credits . '<br/>';
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