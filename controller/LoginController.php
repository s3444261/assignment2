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
	
	// Log the user in.
	public function login() {
		
		// Process login form.
		if (isset ( $_POST ['fabid'] ) && isset ( $_POST ['password'] )) {
			
			$validate = new Validation ();
			
			// Validate the user name.
			try {
				$validate->userName ( $_POST ['fabid'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (! isset ( $_SESSION ['error'] )) {
				
				// Validate the password
				try {
					$validate->password ( $_POST ['password'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (! isset ( $_SESSION ['error'] )) {
					$user = new Users ();
					$user->user = $_POST ['fabid'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['fabid'] );
					unset ( $_POST ['password'] );
					
					if (! isset ( $_SESSION ['error'] )) {
						
						// Attempt the login.
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
	
	// Log the user out.
	public function logout() {
		$user = new Users ();
		$user->logout ();
		header ( 'Location: Home' );
	}
}
?>