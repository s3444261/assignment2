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
	public function login() {
		if (isset ( $_POST ['fabid'] ) && isset ( $_POST ['password'] )) {
			
			$validate = new Validation ();
			try {
				$validate->userName ( $_POST ['fabid'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (!isset($_SESSION['error'])) {
				try {
					$validate->password ( $_POST ['password'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (!isset($_SESSION['error'])) {
					$user = new Users ();
					$user->user = $_POST ['fabid'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['fabid'] );
					unset ( $_POST ['password'] );
					
					if (!isset($_SESSION['error'])) {
						try {
							$user->login ();
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['loggedin'] )) {
							header ( 'Location: Account-Summary' );
						} else {
							header ( 'Location: Home' );
						}
					} else {
						header ( 'Location: Home' );
					}
				} else {
					header ( 'Location: Home' );
				}
			} else {
				header ( 'Location: Home' );
			}
		}
	}
	public function logout() {
		$user = new Users ();
		$user->logout ();
		header ( 'Location: Home' );
	}
}
?>