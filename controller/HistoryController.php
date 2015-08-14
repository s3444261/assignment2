<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class HistoryController {
	public function display() {
		$history = new History ();
		$validate = new Validation ();
		
		if (isset ( $_POST ['viewTransactions'] )) {
			$history->unsetLast ();
			
			$accountID = $_POST ['account'];
			unset ( $_POST ['account'] );
			
			if (isset ( $_POST ['searchDetails'] )) {
				try {
					$searchDetails = $_POST ['searchDetails'];
					unset ( $_POST ['searchDetails'] );
					$validate->searchDetails ( $searchDetails );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset($_SESSION['error'])) {
					$searchDetails = null;
					unset ( $_POST ['viewTransactions'] );
					header ( 'Location: Transaction-History' );
				} else {
					if (isset ( $_POST ['fromAmount'] )) {
						try {
							$fromAmount = $_POST ['fromAmount'];
							unset ( $_POST ['fromAmount'] );
							$validate->amount ( $fromAmount );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
					}
					
					if (isset($_SESSION['error'])) {
						$fromAmount = null;
						unset ( $_POST ['viewTransactions'] );
						header ( 'Location: Transaction-History' );
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
						
						if (isset($_SESSION['error'])) {
							$toAmount = null;
							unset ( $_POST ['viewTransactions'] );
							header ( 'Location: Transaction-History' );
						} else {
							if (isset ( $_POST ['fromDate'] )) {
								try {
									$fromDate = $_POST ['fromDate'];
									unset ( $_POST ['fromDate'] );
									$validate->confirmDate( $fromDate );
								} catch ( ValidationException $e ) {
									$_SESSION ['error'] = $e->getError ();
								}
							}
							
							if (isset($_SESSION['error'])) {
								$fromDate = null;
								unset ( $_POST ['viewTransactions'] );
								header ( 'Location: Transaction-History' );
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
								
								if (isset($_SESSION['error'])) {
									$toDate = null;
									unset ( $_POST ['viewTransactions'] );
									header ( 'Location: Transaction-History' );
								} else {
									$search = array (
											'accountID' => $accountID,
											'searchDetails' => $searchDetails,
											'fromAmount' => $fromAmount,
											'toAmount' => $toAmount,
											'fromDate' => $fromDate,
											'toDate' => $toDate 
									);
									
									$history->searchResults ( $search );
								}
							}
						}
					}
				}
			}
		} else {
			$history->init ();
		}
		
		include 'view/layout/history.php';
	}
}
?>