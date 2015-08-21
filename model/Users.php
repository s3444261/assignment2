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

class Users 
{		
	// Attributes
	private $_userID = '';
	private $_user = '';
	private $_email = '';
	private $_password = '';
	private $_created_at;
	private $_updated_at;
	
	// Constructer
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
    
    // Salt
    private static function salt(){
    	return 'TongalaMooroopnaTatura';
    }
    
    // Insert instance ino the database.
    public function set(){
    	$this->_password = $this->encryptPassword();
    	
    	$query = "INSERT INTO Users 
					SET user = :user,
    					email = :email,
    					password = :password,
						created_at = NULL"; 
			
		$db = Database::getInstance();
		$stmt = $db->prepare($query);
		$stmt->bindParam(':user', $this->_user);
		$stmt->bindParam(':email', $this->_email);
		$stmt->bindParam(':password', $this->_password);
		$stmt->execute();	
		$this->_userID = $db->lastInsertId();
    	if($this->_userID > 0){
    		return $this->_userID;
    	} else {
    		return 0;
    	}
    }
    
    // Salt & Encrypt the password.
    private function encryptPassword(){
    	return sha1($this->_password . $this->salt());
    }
    
    // Login.
    public function login(){

    	$this->_password = $this->encryptPassword();
    			
    	$query = "SELECT *
					FROM Users
					WHERE user = :user
    				AND password = :password";
    			
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':user', $this->_user);
    	$stmt->bindParam(':password', $this->_password);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if(strcmp($this->_password, $row['password']) == 0){
    		if(isset($_SESSION)){
    			$_SESSION['loggedin'] = true;
    			$_SESSION['userID'] = $row['userID'];
    			$_SESSION['fabid'] = $row['user'];
    		}
    	} else {
    		throw new ValidationException('FAB ID and Password did not match!');
    	}
    }
    
    // Confirm a password.
    public function confirmPassword(){
    
    	$this->_password = $this->encryptPassword();
    	 
    	$query = "SELECT *
					FROM Users
					WHERE userID = :userID";
    	 
    	$db = Database::getInstance();
    	$stmt = $db->prepare($query);
    	$stmt->bindParam(':userID', $this->_userID);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if(strcmp($this->_password, $row['password']) == 0){
    		return true;
    	} else {
    		throw new ValidationException('FAB ID and Password did not match!');
    	}
    }
    
    // Lougout.
	public function logout(){
		$_SESSION = array();
		session_destroy(); 
		return true;
	}
	
    // Display Object Contents
    public function printf()
    {
    	echo '<br /><strong>User Object:</strong><br />';
    	if($this->_userID){
    		echo 'userID => ' . $this->_userID . '<br/>';
    	}
    	if($this->_user){
    		echo 'user => ' . $this->_user . '<br/>';
    	}
    	if($this->_email){
    		echo 'email => ' . $this->_email . '<br/>';
    	}
    	if($this->_password){
    		echo 'password => ' . $this->_password . '<br/>';
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