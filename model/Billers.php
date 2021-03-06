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

class Billers 
{		
	// Attributes
	private $_billerID = '';
	private $_userID = '';
	private $_billerCode = '';
	private $_billerName = '';
	private $_billerNickname = '';
	private $_customerReference = '';
	private $_billerStatus = '';
	private $_created_at;
	private $_updated_at;
	
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
    
    // Retrieve a biller from the database.
    public function getBiller(){
    	
    	$query = "SELECT *
    				FROM Billers
    				WHERE billerID = :billerID
    				AND billerStatus != 'deleted'";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':billerID', $this->_billerID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->_userID = $row['userID'];
    	$this->_billerCode = $row['billerCode'];
    	$this->_billerName = $row['billerName'];
    	$this->_billerNickname = $row['billerNickname'];
    	$this->_customerReference = $row['customerReference'];
    	$this->_billerStatus = $row['billerStatus'];
    }
    
    // Retrieve all the billers for a user from the database.
    public function getBillers(){
    	 
    	$query = "SELECT *
    				FROM Billers
    				WHERE userID = :userID
    				AND billerStatus != 'deleted'";
    	
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$billers = array();
    	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	
    		$biller = array('billerID' => $row['billerID'],
    				'userID' => $row['userID'],
    				'billerCode' => $row['billerCode'],
			    	'billerName' => $row['billerName'],
			    	'billerNickname' => $row['billerNickname'],
			    	'customerReference' => $row['customerReference'],
			    	'billerStatus' => $row['billerStatus']);
    		 
    		$billers[] = $biller;
    	}
    	
    	return $billers;
    }
    
    // Retrieve the biller ID's for all billers for a particular user
    // stored in the database.
    public function getBillerIDs(){
    
    	$query = "SELECT billerID
    				FROM Billers
    				WHERE userID = :userID
    				AND billerStatus != 'deleted'";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$billerIDs = array();
    
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		 
    		$billerIDs[] = $row['billerID'];
    	}
    
    	return $billerIDs;
    }
    
    // Insert a biller into the database.
    public function set(){
    	 
    	$query = "INSERT INTO Billers
					SET userID = :userID,
    					billerCode = :billerCode,
		    			billerName = :billerName,
		    			billerNickname = :billerNickname,
		    			customerReference = :customerReference,
		    			billerStatus = :billerStatus,
						created_at = NULL";
    		
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->bindParam(':billerCode', $this->_billerCode); 
    	$stmt->bindParam(':billerName', $this->_billerName); 
    	$stmt->bindParam(':billerNickname', $this->_billerNickname); 
    	$stmt->bindParam(':customerReference', $this->_customerReference);
    	$stmt->bindParam(':billerStatus', $this->_billerStatus); 
    	$stmt->execute();
    	$this->_billerID = $db->lastInsertId();
    	if($this->_billerID > 0){
    		return $this->_billerID;
    	} else {
    		return 0;
    	} 
    }
    
    // Update a biller in the database.
    public function update(){
    
    	$query = "UPDATE Billers
					SET billerNickname = :billerNickname,
		    			customerReference = :customerReference
    				WHERE billerID = :billerID";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':billerID', $this->_billerID);
    	$stmt->bindParam(':billerNickname', $this->_billerNickname);
    	$stmt->bindParam(':customerReference', $this->_customerReference);
    	$stmt->execute();
    	return true;
    }
    
    // Set a biller as being deleted in the database.
    public function delete(){
    
    	$query = "UPDATE Billers
					SET billerStatus = 'deleted'
    				WHERE billerID = :billerID";
    
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':billerID', $this->_billerID);
    	$stmt->execute();
    	return true;
    }
	
    // Display Object Contents
    public function printf()
    {
    	echo '<br /><strong>Biller Object:</strong><br />';
    	if($this->_billerID){
    		echo 'billerID => ' . $this->_billerID . '<br/>';
    	}
    	if($this->_userID){
    		echo 'userID => ' . $this->_userID . '<br/>';
    	}
    	if($this->_billerCode){
    		echo 'billerCode => ' . $this->_billerCode . '<br/>';
    	}
    	if($this->_billerName){
    		echo 'billerName => ' . $this->_billerName . '<br/>';
    	}
    	if($this->_billerNickname){
    		echo 'billerNickname => ' . $this->_billerNickname . '<br/>';
    	}
    	if($this->_customerReference){
    		echo 'customerReference => ' . $this->_customerReference . '<br/>';
    	}
    	if($this->_billerStatus){
    		echo 'billerStatus => ' . $this->_billerStatus . '<br/>';
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