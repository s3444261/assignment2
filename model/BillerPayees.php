<?php
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

class BillerPayees
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
	
	public function getBillers()
	{
    	 
    	$query = "SELECT billerName
    				FROM Billers
    				WHERE userID = :userID
    				AND billerStatus != 'deleted'";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$billers = array();
    	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	
    		$billers[] = $row['billerName'];
    	}
    	
    	return $billers;
	}
    	
	public function getPayees()
	{
    	 
    	$query = "SELECT accountName
    				FROM Payees
    				WHERE userID = :userID
    				AND payeeStatus != 'deleted'";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$payees = array();
    	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	
    		$payees[] = $row['accountName'];
    	}
    	
    	return $payees;
    }
    
    public function getBoth()
    {
    	$query = "SELECT accountName AS payeeName
					FROM payees
					WHERE userID = :userID
					AND payeeStatus != 'deleted'
					UNION
					SELECT billerName AS payeeName
					FROM Billers
					WHERE userID = :userID
					AND billerStatus != 'deleted'
					ORDER BY payeeName ASC";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$payees = array();
    	 
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		 
    		$payees[] = $row['payeeName'];
    	}
    	 
    	return $payees;
    }
    
    public function getBillersList()
    {
    	$query = "SELECT billerNickname AS payeeNickname,
    				billerName AS payeeName,
    				'Biller' AS payeeType,
    				CONCAT('<a href=\"Biller-Modify/', billerID, '\">Modify</a>') AS payeeModify,
    				CONCAT('<a href=\"Biller-Delete/', billerID, '\">Delete</a>') AS payeeDelete
    				FROM Billers
    				WHERE userID = :userID
    				AND billerStatus != 'deleted'
    				ORDER BY payeeNickname ASC";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	
    	$billersList = array();
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		$biller = array('payeeNickname' => $row['payeeNickname'],
					'payeeName' =>  $row['payeeName'],
					'payeeType' => $row['payeeType'],
					'payeeModify' => $row['payeeModify'],
					'payeeDelete' => $row['payeeDelete']
    				);
    		$billers[] = $biller;
    	}
    	return $billers;
    }
    
    public function getPayeesList()
    {
    	$query = "SELECT accountNickname AS payeeNickname,
    				accountName AS payeeName,
    				'Payee' AS payeeType,
    				CONCAT('<a href=\"Payee-Modify/', payeeID, '\">Modify</a>') AS payeeModify,
    				CONCAT('<a href=\"Payee-Delete/', payeeID, '\">Delete</a>') AS payeeDelete
    				FROM Payees
    				WHERE userID = :userID
    				AND payeeStatus != 'deleted'
    				ORDER BY payeeNickname ASC";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	 
    	$payeesList = array();
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		$payee = array('payeeNickname' => $row['payeeNickname'],
					'payeeName' =>  $row['payeeName'],
					'payeeType' => $row['payeeType'],
					'payeeModify' => $row['payeeModify'],
					'payeeDelete' => $row['payeeDelete']
    				);
    		$payeesList[] = $payee;
    	}
    
    	return $payeesList;
    }
    
    public function getBothList()
    {
    	$query = "SELECT billerNickname AS payeeNickname,
    				billerName AS payeeName,
    				'Biller' AS payeeType,
    				CONCAT('<a href=\"Biller-Modify/', billerID, '\">Modify</a>') AS payeeModify,
    				CONCAT('<a href=\"Biller-Delete/', billerID, '\">Delete</a>') AS payeeDelete
    				FROM Billers
    				WHERE userID = :userID
    				AND billerStatus != 'deleted'
    			UNION
    			SELECT accountNickname AS payeeNickname,
    				accountName AS payeeName,
    				'Payee' AS payeeType,
    				CONCAT('<a href=\"Payee-Modify/', payeeID, '\">Modify</a>') AS payeeModify,
    				CONCAT('<a href=\"Payee-Delete/', payeeID, '\">Delete</a>') AS payeeDelete
    				FROM Payees
    				WHERE userID = :userID
    				AND payeeStatus != 'deleted'
    			ORDER BY payeeNickname ASC";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    
    	$bothList = array();
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		$both = array('payeeNickname' => $row['payeeNickname'],
					'payeeName' =>  $row['payeeName'],
					'payeeType' => $row['payeeType'],
					'payeeModify' => $row['payeeModify'],
					'payeeDelete' => $row['payeeDelete']
    				);
    		$bothList[] = $both;
    	}
    
    	return $bothList;
    }
}
?>