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
	public function display() {
		if (isset ( $_POST ['next'] )) {
			
			unset ( $_POST ['next'] );
			
			if (isset ( $_POST ['password'] )) {
				
				$validate = new Validation ();
				
				try {
					$validate->password ( $_POST ['password'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset($_SESSION['error'])) {
					unset ( $_POST ['password'] );
					header ( 'Location: Bill-Payment-Amount' );
				} else {
					$user = new Users ();
					$user->userID = $_SESSION ['userID'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['password'] );
					
					try {
						$user->confirmPassword ();
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset($_SESSION['error'])) {
						header ( 'Location: Bill-Payment-Amount' );
					} else {
						$account = new Account ();
						$account->accountID = $_SESSION ['payAccountID'];
						if ($account->processPayment ()) {
							$paymentack = new Paymentack ();
							$paymentack->init ();
							include 'view/layout/paymentack.php';
							unset($_SESSION['payCreated']);
							unset($_SESSION['payDate']);
							unset($_SESSION['payAccountID']);
							unset($_SESSION['payAmount']);
							unset($_SESSION['payStatus']);
							unset($_SESSION['payConf']);
							unset($_SESSION['payAccount']);
							unset($_SESSION['payBillerCode']);
							unset($_SESSION['payBillerName']);
							unset($_SESSION['payBillerNickname']);
							unset($_SESSION['payCustomerRef']);
						} else {
							$paymentconf = new Paymentconf ();
							$paymentconf->init ();
							include 'view/layout/paymentconf.php';
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
		} else {
			$payment = new Payment ();
			$payment->init ();
			include 'view/layout/payment.php';
		}
	}
}
?>