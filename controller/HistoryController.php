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
	
	// Displays the layout for the Account-History Page.
	public function display() {
		$history = new History ();
		$validate = new Validation ();
		
		// If the View Transactions button has been clicked.
		if (isset ( $_POST ['viewTransactions'] )) {
			
			// Clear any previous history.
			$history->unsetLast ();
			
			$accountID = $_POST ['account'];
			unset ( $_POST ['account'] );
			
			// Validate submitted search parameters
			if (isset ( $_POST ['searchDetails'] )) {
				
				// Validate search details.
				try {
					$searchDetails = $_POST ['searchDetails'];
					unset ( $_POST ['searchDetails'] );
					$validate->searchDetails ( $searchDetails );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					$searchDetails = null;
					unset ( $_POST ['viewTransactions'] );
					header ( 'Location: Transaction-History' );
				} else {
					if (isset ( $_POST ['fromAmount'] )) {
						
						// Validate From Amount.
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
						unset ( $_POST ['viewTransactions'] );
						header ( 'Location: Transaction-History' );
					} else {
						if (isset ( $_POST ['toAmount'] )) {
							
							// Validate To Amount.
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
							unset ( $_POST ['viewTransactions'] );
							header ( 'Location: Transaction-History' );
						} else {
							if (isset ( $_POST ['fromDate'] )) {
								
								// Validate From Date.
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
								unset ( $_POST ['viewTransactions'] );
								header ( 'Location: Transaction-History' );
							} else {
								if (isset ( $_POST ['toDate'] )) {
									
									// Validate To Date.
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
									
									// If there are no errors, display the results.
									$history->searchResults ( $search );
								}
							}
						}
					}
				}
			}
		} else {
			
			// If the page hasn't been posted to, display the Account History of
			// the first account in the list.
			$history->init ();
		}
		
		include 'view/layout/history.php';
	}
}
?>