<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */

class LoginController {
	
	public function login(){
		if(isset($_POST['fabid']) && isset($_POST['password'])){
			$user = new Users();
			$user->user = $_POST['fabid'];
			$user->password = $_POST['password'];
			unset($_POST['fabid']);
			unset($_POST['password']);
			$user->login();
			if(isset($_SESSION['loggedin'])){
				header('Location: Account-Summary');
			} else {
				header('Location: Home');
			}
		}
	}
	
	public function logout(){
		$user = new Users();
		$user->logout();
		header('Location: Home');
	}
}
?>