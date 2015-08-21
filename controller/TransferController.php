<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class TransferController {
	
	// Display the New Funds Transfer Page.
	public function display() {
		// Add a new payee if a request is submitted.
		if (isset ( $_POST ['addPayee'] )) {
			
			$payee = new Payees ();
			$payee->userID = $_SESSION ['userID'];
			$validate = new Validation ();
			
			// Validate the account name.
			try {
				$validate->accountName ( $_POST ['addPayeeAccountName'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (isset ( $_SESSION ['error'] )) {
				unset ( $_POST ['addPayeeAccountName'] );
				header ( 'Location: Payee-Add' );
			} else {
				$payee->accountName = $_POST ['addPayeeAccountName'];
				unset ( $_POST ['addPayeeAccountName'] );
				
				// Validate the nickname.
				try {
					$validate->accountNickname ( $_POST ['addPayeeAccountNickname'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['addPayeeAccountNickname'] );
					header ( 'Location: Payee-Add' );
				} else {
					$payee->accountNickname = $_POST ['addPayeeAccountNickname'];
					unset ( $_POST ['addPayeeAccountNickname'] );
					
					// Validate the BSB.
					try {
						$validate->accountBSB ( $_POST ['addPayeeBSB'] );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						unset ( $_POST ['addPayeeBSB'] );
						header ( 'Location: Payee-Add' );
					} else {
						$payee->bsb = $_POST ['addPayeeBSB'];
						unset ( $_POST ['addPayeeBSB'] );
						
						// Validate the account number.
						try {
							$validate->accountNumber ( $_POST ['addPayeeAccountNumber'] );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['error'] )) {
							unset ( $_POST ['addPayeeAccountNumber'] );
							header ( 'Location: Payee-Add' );
						} else {
							$payee->accountNumber = $_POST ['addPayeeAccountNumber'];
							unset ( $_POST ['addPayeeAccountNumber'] );
							
							// If all is ok, add the payee.
							$payee->set ();
						}
					}
				}
			}
		}
		
		// Display the New Funds Transfer Page.
		$transfer = new Transfer ();
		$transfer->init ();
		
		include 'view/layout/transfer.php';
	}
}
?>