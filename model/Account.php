<?php
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class Account 
{		
	private $_accountID = '';
	private $_userID = '';
	private $_bsb = '';
	private $_accountNumber = '';
	private $_accountName = '';
	private $_accountNickname = '';
	private $_productName = '';
	private $_recordedLimit = '';
	private $_openDate = '';
	private $_openBalance = '';
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
		$this->_recordedLimit = $row['recordedLimit'];
		$this->_openDate = $row['openDate'];
		$this->_openBalance = $row['openBalance'];
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
		    			openDate = :openDate,
		    			openBalance = :openBalance,
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
    	$stmt->bindParam(':openDate', $this->_openDate);
    	$stmt->bindParam(':openBalance', $this->_openBalance);
    	$stmt->execute();
    	$this->_accountID = $db->lastInsertId();
    	if($this->_accountID > 0){
    		return $this->_accountID;
    	} else {
    		return 0;
    	}
    }
    
    public function accountTransaction($arr){
    	$arr['accountID'] = $this->_accountID;
    	$transaction = new Transactions($arr);
    	$transaction->set();
    }
    
    public function getTransactions(){
    
    	$query = "SELECT *
    				FROM Transactions
    				WHERE accountID = :accountID";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':accountID', $this->_accountID);
    	$stmt->execute();
    	$transactions = array();
    	 
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		 
    		$transaction = array('transactionID' => $row['transactionID'],
    				'accountID' => $row['accountID'],
    				'transactionDate' => $row['transactionDate'],
    				'transactionDescription' => $row['transactionDescription'],
    				'transactee' => $row['transactee'],
    				'transactionStatus' => $row['transactionStatus'],
    				'debits' => $row['debits'],
    				'credits' => $row['credits']);
    		 
    		$transactions[] = $transaction;
    	}
    	 
    	return $transactions;
    }
    
    public function currentBalance(){
    	$query = "SELECT SUM(credits) - SUM(debits) as currentBalance
					FROM Transactions 
					WHERE accountID = :accountID";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':accountID', $this->_accountID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	$this->getAccount();
    	
    	return $row['currentBalance'] + $this->_openBalance;
    }
    
    public function availableBalance(){
    	$query = "SELECT SUM(credits) - SUM(debits) as availableBalance
					FROM Transactions 
					WHERE accountID = :accountID
					AND transactionStatus != 'pending'";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':accountID', $this->_accountID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	$this->getAccount();
    	
    	return $row['availableBalance'] + $this->_openBalance;
    }
    
    public function sufficientFunds()
    {
    	if(($this->availableBalance() - $this->_recordedLimit ) >= $_SESSION['payAmount']){
    		return true;
    	} else {
    		return false;
    	}
    }
    
    public function processPayment()
    {
    	$this->getAccount();
    	if($this->sufficientFunds()){
    		$transaction = new Transactions();
    		$transaction->accountID = $this->_accountID;
    		$transaction->transactionDate = $_SESSION['payDate'];
    		$transaction->transactionDescription = 'Customer Ref: ' . $_SESSION['payCustomerRef'];
    		$transaction->transactee = $_SESSION['payBillerName']; 
    		if(isset($_SESSION['payDate'])){
    			$date = date_create ( $_SESSION['payDate'] );
    			$paymentDate = date_format ( $date, 'zY' );
    			$paymentDate = intval($paymentDate);
    			date_default_timezone_set('Australia/Melbourne');
    			$currentDate = date_create (date('m/d/Y h:i:s a', time()));
    			$currentDate = date_format ( $currentDate, 'zY' );
    			$currentDate = intval($currentDate); 
    			if($paymentDate == $currentDate){
    				$_SESSION['payStatus'] = 'Paid'; 
    			} elseif($paymentDate > $currentDate){
    				$_SESSION['payStatus'] = 'Future Payment';
    			} else {
    				return false;
    			}
    		}
    		$transaction->transactionStatus = $_SESSION['payStatus'];
    		$transaction->debits = $_SESSION['payAmount'];
    		
    		$transaction->transactionID = $transaction->set();
    		if($transaction->transactionID > 0){
    			$transaction->getTransaction(); 
    			$conf = 'B' . $paymentDate . $transaction->transactionID;
    			$_SESSION['payConf'] = $conf;
    			$_SESSION['payCreated'] = $transaction->transactionDate;
    			return true;
    		} else {
    			return false;
    		}
    	} else {
    		return false;
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
    	if($this->_openDate){
    		echo 'openDate => ' . $this->_openDate . '<br/>';
    	}
    	if($this->_openBalance){
    		echo 'openBalance => ' . $this->_openBalance . '<br/>';
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