<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PaymentlistController {
	public function display() {
		if (isset ( $_POST ['paymentType'] )) {
			$paymentType = $_POST ['paymentType'];
			if ($_POST ['paymentType'] == 'All Payment Types') {
				$_SESSION ['allPaymentList'] = 'selected = "selected"';
				unset ( $_SESSION ['billPaymentList'] );
				unset ( $_SESSION ['fundsTransferPaymentList'] );
				unset ( $_SESSION ['billPayment'] );
				unset ( $_SESSION ['fundsTransferPayment'] );
				unset ( $_POST ['paymentType'] );
			} elseif ($_POST ['paymentType'] == 'Bill Payment') {
				unset ( $_SESSION ['allPaymentList'] );
				$_SESSION ['billPaymentList'] = 'selected = "selected"';
				unset ( $_SESSION ['fundsTransferPaymentList'] );
				unset ( $_POST ['paymentType'] );
				unset ( $_SESSION ['billPayment'] );
				unset ( $_SESSION ['fundsTransferPayment'] );
			} elseif ($_POST ['paymentType'] == 'Funds Transfer') {
				unset ( $_SESSION ['allPaymentList'] );
				unset ( $_SESSION ['billPaymentList'] );
				$_SESSION ['fundsTransferPaymentList'] = 'selected = "selected"';
				unset ( $_POST ['paymentType'] );
				unset ( $_SESSION ['billPayment'] );
				unset ( $_SESSION ['fundsTransferPayment'] );
			}
		} elseif (isset ( $_SESSION ['billPayment'] )) {
			unset ( $_SESSION ['allPaymentList'] );
			$_SESSION ['billPaymentList'] = 'selected = "selected"';
			unset ( $_SESSION ['fundsTransferPaymentList'] );
			unset ( $_SESSION ['fundsTransferPayment'] );
		} elseif (isset ( $_SESSION ['fundsTransferPayment'] )) {
			unset ( $_SESSION ['allPaymentList'] );
			unset ( $_SESSION ['billPaymentList'] );
			$_SESSION ['fundsTransferPaymentList'] = 'selected = "selected"';
			unset ( $_SESSION ['billPayment'] );
		} else {
			$_SESSION ['allPaymentList'] = 'selected = "selected"';
			unset ( $_SESSION ['billPaymentList'] );
			unset ( $_SESSION ['fundsTransferPaymentList'] );
			unset ( $_SESSION ['billPayment'] );
			unset ( $_SESSION ['fundsTransferPayment'] );
		}
		
		$paymentlist = new Paymentlist ();
		
		if (isset ( $_POST ['clearFilter'] )) {
			$paymentlist->clearFilter ();
		}
		
		if (isset ( $_POST ['account'] )) {
			$paymentlist->unsetLast ();
			
			$accountID = $_POST ['account'];
			unset ( $_POST ['account'] );
			
			if (isset ( $_POST ['payees'] ) && ($_POST ['payees'] != '--- Select a Payee ---')) {
				$payeeName = $_POST ['payees'];
				unset ( $_POST ['payees'] );
			} else {
				$payeeName = null;
			}
			
			if (isset ( $_POST ['status'] ) && ($_POST ['status'] != '--- Select Status ---')) {
				$status = $_POST ['status'];
				unset ( $_POST ['status'] );
			} else {
				$status = null;
			}
			
			$validate = new Validation();
			
			if (isset ( $_POST ['fromAmount'] )) {
				try {
					$fromAmount = $_POST ['fromAmount'];
					unset ( $_POST ['fromAmount'] );
					$validate->amount ( $fromAmount );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
			}
			
			if (isset ( $_SESSION ['error'] )) {
				$fromAmount = null;
				header ( 'Location: Payment-List' );
			} else {
				if (isset ( $_POST ['toAmount'] )) {
					try {
						$toAmount = $_POST ['toAmount'];
						unset ( $_POST ['toAmount'] );
						$validate->amount ( $toAmount );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
				}
				
				if (isset ( $_SESSION ['error'] )) {
					$toAmount = null;
					header ( 'Location: Payment-List' );
				} else {
					if (isset ( $_POST ['fromDate'] )) {
						try {
							$fromDate = $_POST ['fromDate'];
							unset ( $_POST ['fromDate'] );
							$validate->confirmDate ( $fromDate );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
					}
					
					if (isset ( $_SESSION ['error'] )) {
						$fromDate = null;
						header ( 'Location: Payment-List' );
					} else {
						if (isset ( $_POST ['toDate'] )) {
							try {
								$toDate = $_POST ['toDate'];
								unset ( $_POST ['toDate'] );
								$validate->confirmDate ( $toDate );
							} catch ( ValidationException $e ) {
								$_SESSION ['error'] = $e->getError ();
							}
						}
						
						if (isset ( $_SESSION ['error'] )) {
							$toDate = null;
							header ( 'Location: Payment-List' );
						} else {
							$search = array (
									'accountID' => $accountID,
									'paymentType' => $paymentType,
									'payListName' => $payeeName,
									'payListStatus' => $status,
									'payListFromAmount' => $fromAmount,
									'payListToAmount' => $toAmount,
									'payListFromDate' => $fromDate,
									'payListToDate' => $toDate 
							);
							
							$paymentlist->searchResults ( $search );
						}
					}
				}
			}
		} else {
			$paymentlist->init ();
		}
		
		include 'view/layout/paymentlist.php';
	}
}
?>