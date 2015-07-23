<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
include 'model/Login.php';

class LoginController {
	
	public function login(){
		$login = new Login();
		$login->fabid = $_POST['fabid'];
		$login->password = $_POST['password'];
		if($login->login()){
			header('Location: Account-Summary');
		} else {
			header('Location: Home');
		}
	}
	
	public function logout(){
		$logout = new Login();
		if($logout->logout()){
			header('Location: Home');
		} else {
			header('Location: Account-Summary');
		}
	}
}
?>