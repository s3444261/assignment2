<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentController {
	
	// Display the New Bill Payment Page.
	public function display() {
		$validate = new Validation ();
		
		// Add a Biller if a request is submitted.
		if (isset ( $_POST ['addBiller'] )) {
			$biller = new Billers ();
			$biller->userID = $_SESSION ['userID'];
			if (isset ( $_POST ['addBillerName'] )) {
				
				// Validate the biller name.
				try {
					$validate->billerName ( $_POST ['addBillerName'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['addBillerName'] );
					header ( 'Location: Biller-Add' );
				} else {
					$biller->billerName = strtoupper ( $_POST ['addBillerName'] );
					unset ( $_POST ['addBillerName'] );
					
					// Validate the nickname.
					try {
						$validate->billerNickname ( $_POST ['addBillerNickname'] );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						unset ( $_POST ['addBillerNickname'] );
						header ( 'Location: Biller-Add' );
					} else {
						$biller->billerNickname = strtoupper ( $_POST ['addBillerNickname'] );
						unset ( $_POST ['addBillerNickname'] );
						
						// Validate the biller code.
						try {
							$validate->billerCode ( $_POST ['addBillerCode'] );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['error'] )) {
							unset ( $_POST ['addBillerCode'] );
							header ( 'Location: Biller-Add' );
						} else {
							$biller->billerCode = $_POST ['addBillerCode'];
							unset ( $_POST ['addBillerCode'] );
							
							// Validate the customer reference.
							try {
								$validate->billerCustomerRef ( $_POST ['addBillerCustomerRefNumber'] );
							} catch ( ValidationException $e ) {
								$_SESSION ['error'] = $e->getError ();
							}
							
							if (isset ( $_SESSION ['error'] )) {
								unset ( $_POST ['addBillerCustomerRefNumber'] );
								header ( 'Location: Biller-Add' );
							} else {
								
								// If all is ok, add the biller.
								$biller->customerReference = $_POST ['addBillerCustomerRefNumber'];
								unset ( $_POST ['addBillerCustomerRefNumber'] );
								
								$biller->set ();
							}
						}
					}
				}
			}
		}
		
		// Display the New Bill Payment Page.
		$payment = new Payment ();
		$payment->init ();
		
		include 'view/layout/payment.php';
	}
}
?>