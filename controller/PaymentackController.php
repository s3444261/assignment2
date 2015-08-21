<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentackController {
	
	// Display the Payment Acknowledgement Page.
	public function display() {
		if (isset ( $_POST ['next'] )) {
			
			unset ( $_POST ['next'] );
			
			// To prevent unwarranted use of browser back button.
			if (! isset ( $_SESSION ['payAccountID'] )) {
				header ( 'Location: New-Bill-Payment' );
			}
			
			// Process on submission of password.
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
					header ( 'Location: Bill-Payment-Amount' );
				} else {
					$user = new Users ();
					$user->userID = $_SESSION ['userID'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['password'] );
					
					// Check for a password match.
					try {
						$user->confirmPassword ();
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						header ( 'Location: Bill-Payment-Amount' );
					} else {
						
						// Process the payment.
						$account = new Account ();
						$account->accountID = $_SESSION ['payAccountID'];
						if ($account->processPayment ()) {
							
							// Display the Acknowledgement Page.
							$paymentack = new Paymentack ();
							$paymentack->init ();
							include 'view/layout/paymentack.php';
							unset ( $_SESSION ['payCreated'] );
							unset ( $_SESSION ['payDate'] );
							unset ( $_SESSION ['payAccountID'] );
							unset ( $_SESSION ['payAmount'] );
							unset ( $_SESSION ['payStatus'] );
							unset ( $_SESSION ['payConf'] );
							unset ( $_SESSION ['payAccount'] );
							unset ( $_SESSION ['payBillerCode'] );
							unset ( $_SESSION ['payBillerName'] );
							unset ( $_SESSION ['payBillerNickname'] );
							unset ( $_SESSION ['payCustomerRef'] );
						} else {
							
							// Display the Payment Confirmation Page.
							$paymentconf = new Paymentconf ();
							$paymentconf->init ();
							include 'view/layout/paymentconf.php';
						}
					}
				}
			}
			// Cancel the Payment
		} else if (isset ( $_POST ['cancel'] )) {
			unset ( $_POST ['cancel'] );
			$payment = new Payment ();
			$payment->cancelSessions ();
			
			// Return to the Payment Page.
			$payment->init ();
			include 'view/layout/payment.php';
		} else {
			
			// For any other reason, return to the Payment page.
			$payment = new Payment ();
			$payment->init ();
			include 'view/layout/payment.php';
		}
	}
}
?>