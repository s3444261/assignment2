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
	public function display() { 
		if (isset ( $_POST ['next'] )) {
			
			unset ( $_POST ['next'] );
			
			if (isset ( $_POST ['account'] )) {
				$_SESSION ['payAccountID'] = $_POST ['account'];
				unset ( $_POST ['account'] );
			}
			
			$validate = new Validation ();
			
			if (isset ( $_POST ['custref'] )) {
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
		} else if (isset ( $_POST ['cancel'] )) {
			
			unset ( $_POST ['cancel'] );
			
			$payment = new Payment ();
			
			$payment->cancelSessions ();
			
			$payment->init ();
			
			include 'view/layout/payment.php';
		}
	}
}
?>