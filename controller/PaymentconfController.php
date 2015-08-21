<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentconfController {
	
	// Displays the Payment Confirmation Page.
	public function display() { 
		
		// Process if posted to from the Payment Amount Page.
		if (isset ( $_POST ['next'] )) {
			
			unset ( $_POST ['next'] );
			
			// In the event the back button is hit on the browser
			// after the transaction has been processed.
			if(!isset($_SESSION['payBillerCode']) || 
				!isset($_SESSION['payBillerName']) ||
				!isset($_SESSION['payBillerNickname'])){
				header("Location: New-Bill-Payment");
			}
			
			if (isset ( $_POST ['account'] )) {
				$_SESSION ['payAccountID'] = $_POST ['account'];
				unset ( $_POST ['account'] );
			}
			
			$validate = new Validation ();
			
			if (isset ( $_POST ['custref'] )) {
				
				// Validate the customer reference.
				try {
					$custref = $_POST ['custref'];
					unset ( $_POST ['custref'] );
					$validate->custref ( $custref );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset($_SESSION['error'])) {
					$custref = null;
					unset ( $_POST ['next'] );
					header ( 'Location: Bill-Payment-Amount' );
				} else {
					$_SESSION['payCustomerRef'] = $custref;
					
					if (isset ( $_POST ['amount'] )) {
						
						// Validate the amount.
						try {
							$amount = $_POST ['amount'];
							unset ( $_POST ['amount'] );
							$validate->payAmount ( $amount );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset($_SESSION['error'])) {
							$amount = null;
							unset ( $_POST ['next'] );
							header ( 'Location: Bill-Payment-Amount' );
						} else {
							$_SESSION['payAmount'] = $amount;
							
							if (isset ( $_POST ['paymentDate'] )) { 
								
								// Validate the date.
								try {
									$paymentDate = $_POST ['paymentDate'];
									unset ( $_POST ['paymentDate'] );
									$validate->payDate ( $paymentDate );
								} catch ( ValidationException $e ) {
									$_SESSION ['error'] = $e->getError ();
								}
								
								if (isset($_SESSION['error'])) { 
									$paymentDate = null;
									unset ( $_POST ['next'] );
									header ( 'Location: Bill-Payment-Amount' );
								} else {
									
									// If all is OK, display the Payment Confirmation Page.
									$_SESSION['payDate'] = $paymentDate;
									$paymentconf = new Paymentconf ();
									$paymentconf->init ();
									include 'view/layout/paymentconf.php';
								}
							}
						}
					}
				}
			}
			
		// Cancel the Payment	
		} else if (isset ( $_POST ['cancel'] )) {
			
			unset ( $_POST ['cancel'] );
			
			$payment = new Payment ();
			
			$payment->cancelSessions ();
			
			$payment->init ();
			
			include 'view/layout/payment.php';
		} else {
			
			// For any other reason, display the Payment Page.
			$payment = new Payment ();
			$payment->cancelSessions ();
			$payment->init ();
		}
	}
}
?>