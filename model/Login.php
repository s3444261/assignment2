<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */

class Login {

	// Attributes.
	private $_fabid;
	private $_password;
	
	// Constructor.
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getter.
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	
	// Setter.
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	
	public function login(){
		if($this->_fabid == '123456' && $this->_password == 'blah'){
			$_SESSION['loggedin'] = true;
			$_SESSION['fabid'] = $this->_fabid;
			return true;
		} else {
			$_SESSION['loggedin'] = false;
			return false;
		}
	}
	
	public function logout(){
		$_SESSION = array();
		session_destroy();
		return true;
	}
}
?>