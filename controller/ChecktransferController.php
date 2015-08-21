<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class ChecktransferController {
	
	// Displays the layout for the Check Transfer page.
	public function display() {
		
		// Cancels the transfer.
		if (isset ( $_POST ['cancel'] )) {
			$transfer = new Transfer ();
			$transfer->cancelSessions ();
			unset ( $_POST ['cancel'] );
			$pos = strrpos ( $_SERVER ['HTTP_REFERER'], '/' );
			$pos = strlen ( $_SERVER ['HTTP_REFERER'] ) - $pos;
			header ( "Location: " . substr ( $_SERVER ['HTTP_REFERER'], 0, - $pos + 1 ) . "New-Funds-Transfer" );
			
			// Proceeds with the transfer.
		} elseif (isset ( $_POST ['next'] )) {
			
			$checktransfer = new CheckTransfer ();
			
			if (isset ( $_POST ['account'] ) && isset ( $_POST ['accountPayee'] )) {
				$checktransfer->unsetLast ();
				
				$_SESSION ['transferAccountID'] = $_POST ['account'];
				unset ( $_POST ['account'] );
				
				$_SESSION ['transferAccountPayeeID'] = $_POST ['accountPayee'];
				unset ( $_POST ['accountPayee'] );
			}
			
			$validate = new Validation ();
			
			if (isset ( $_POST ['transferAmount'] )) {
				
				// Validates the amount.
				try {
					$transferAmount = $_POST ['transferAmount'];
					unset ( $_POST ['transferAmount'] );
					$validate->transferAmount ( $transferAmount );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					$transferAmount = null;
					unset ( $_POST ['next'] );
					header ( 'Location: New-Funds-Transfer' );
				} else {
					$_SESSION ['transferAmount'] = $transferAmount;
					
					// Validates the description.
					try {
						$transferDescription = $_POST ['transferDescription'];
						unset ( $_POST ['transferDescription'] );
						$validate->transferDescription ( $transferDescription );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						$transferDescription = null;
						unset ( $_POST ['next'] );
						header ( 'Location: New-Funds-Transfer' );
					} else {
						$_SESSION ['transferDescription'] = $transferDescription;
						
						// Validates the remitter.
						try {
							$transferRemitter = $_POST ['transferRemitter'];
							unset ( $_POST ['transferRemitter'] );
							$validate->transferRemitter ( $transferRemitter );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['error'] )) {
							$transferRemitter = null;
							unset ( $_POST ['next'] );
							header ( 'Location: New-Funds-Transfer' );
						} else {
							$_SESSION ['transferRemitter'] = $transferRemitter;
							
							// Validates the date.
							try {
								$transferDate = $_POST ['transferDate'];
								unset ( $_POST ['transferDate'] );
								$validate->transferDate ( $transferDate );
							} catch ( ValidationException $e ) {
								$_SESSION ['error'] = $e->getError ();
							}
							
							if (isset ( $_SESSION ['error'] )) {
								$transferDate = null;
								unset ( $_POST ['next'] );
								header ( 'Location: New-Funds-Transfer' );
							} else {
								$_SESSION ['transferDate'] = $transferDate;
								
								// Displays the Check Transfer Page.
								$checktransfer->init ();
								
								include 'view/layout/checktransfer.php';
							}
						}
					}
				}
			}
		}
	}
}
?>