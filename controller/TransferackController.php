<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class TransferackController {
	
	// Display the Funds Transfer Acknowledgement Page.
	public function display() {
		// Cancel the transfer if a request is submitted.
		if (isset ( $_POST ['cancel'] )) {
			$transfer = new Transfer ();
			$transfer->cancelSessions ();
			unset ( $_POST ['cancel'] );
			$pos = strrpos ( $_SERVER ['HTTP_REFERER'], '/' );
			$pos = strlen ( $_SERVER ['HTTP_REFERER'] ) - $pos;
			header ( "Location: " . substr ( $_SERVER ['HTTP_REFERER'], 0, - $pos + 1 ) . "New-Funds-Transfer" );
			
			// Otherwise process the transfer.
		} elseif (isset ( $_POST ['submit'] )) {
			unset ( $_POST ['submit'] );
			
			// To negate any back button issues.
			if (! isset ( $_SESSION ['transferDate'] ) || ! isset ( $_SESSION ['transferDescription'] ) || ! isset ( $_SESSION ['transferRemitter'] ) || ! isset ( $_SESSION ['transferAmount'] )) {
				header ( 'Location: New-Funds-Transfer' );
			}
			
			if (isset ( $_POST ['password'] )) {
				
				$validate = new Validation ();
				
				// Validate the password.
				try {
					$validate->password ( $_POST ['password'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['password'] );
					header ( 'Location: New-Funds-Transfer' );
				} else {
					$user = new Users ();
					$user->userID = $_SESSION ['userID'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['password'] );
					
					// Confirm the password is corredt.
					try {
						$user->confirmPassword ();
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						header ( 'Location: New-Funds-Transfer' );
					} else {
						
						// If everything is ok, process the transfer and display
						// the Transfer Acknowledgement Page
						$account = new Account ();
						$account->accountID = $_SESSION ['transferAccountID'];
						if ($account->processTransfer ()) {
							include 'view/layout/transferack.php';
						} else {
							
							// Otherwise return to the Check Transfer page.
							$checkTransfer = new CheckTransfer ();
							$checkTransfer->init ();
							include 'view/layout/checktransfer.php';
						}
					}
				}
			}
		}
	}
}
?>