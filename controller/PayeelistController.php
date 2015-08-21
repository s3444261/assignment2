<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class PayeelistController {
	
	// Display the Payee List.
	public function display() {
		
		// Process an update request if submitted.
		if (isset ( $_POST ['updateBiller'] )) {
			unset ( $_POST ['updateBiller'] );
			
			$validate = new Validation ();
			$biller = new Billers ();
			$biller->billerID = $_SESSION ['billerModifyID'];
			
			// Validate the nickname.
			try {
				$validate->billerNickname ( $_POST ['updateBillerNickname'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (isset ( $_SESSION ['error'] )) {
				unset ( $_POST ['updateBillerNickname'] );
				header ( 'Location: Biller-Modify' );
			} else {
				$biller->billerNickname = strtoupper ( $_POST ['updateBillerNickname'] );
				unset ( $_POST ['updateBillerNickname'] );
				
				// Validate the customer reference.
				try {
					$validate->billerCustomerRef ( $_POST ['updateBillerCustomerRef'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['updateBillerCustomerRef'] );
					header ( 'Location: Biller-Modify' );
				} else {
					$biller->customerReference = $_POST ['updateBillerCustomerRef'];
					unset ( $_POST ['updateBillerCustomerRef'] );
					
					// If all is ok, make the update.
					$biller->update ();
					unset ( $_SESSION ['billerModifyID'] );
					unset ( $_SESSION ['billerCode'] );
					unset ( $_SESSION ['billerName'] );
					unset ( $_SESSION ['billerNickname'] );
					unset ( $_SESSION ['customerReference'] );
				}
			}
		}
		
		// Delete the Biller if a request is submitted.
		if (isset ( $_POST ['deleteBiller'] )) {
			unset ( $_POST ['deleteBiller'] );
			$biller = new Billers ();
			$biller->billerID = $_SESSION ['billerDeleteID'];
			$biller->delete ();
			unset ( $_SESSION ['billerDeleteID'] );
			unset ( $_SESSION ['billerCode'] );
			unset ( $_SESSION ['billerName'] );
			unset ( $_SESSION ['billerNickname'] );
			unset ( $_SESSION ['customerReference'] );
		}
		
		// Update a payee if a request is submitted.
		if (isset ( $_POST ['updatePayee'] )) {
			unset ( $_POST ['updatePayee'] );
			$payee = new Payees ();
			$payee->payeeID = $_SESSION ['payeeModifyID'];
			
			$validate = new Validation ();
			
			// Validate the account name.
			try {
				$validate->accountName ( $_POST ['updatePayeeAccountName'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (isset ( $_SESSION ['error'] )) {
				unset ( $_POST ['updatePayeeAccountName'] );
				header ( 'Location: Payee-Modify' );
			} else {
				$payee->accountName = $_POST ['updatePayeeAccountName'];
				unset ( $_POST ['updatePayeeAccountName'] );
				
				// Validate the account nickname
				try {
					$validate->accountNickname ( $_POST ['updatePayeeAccountNickname'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['updatePayeeAccountNickname'] );
					header ( 'Location: Payee-Modify' );
				} else {
					$payee->accountNickname = $_POST ['updatePayeeAccountNickname'];
					unset ( $_POST ['updatePayeeAccountNickname'] );
					
					// Validate the BSB.
					try {
						$validate->accountBSB ( $_POST ['updatePayeeBSB'] );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
					
					if (isset ( $_SESSION ['error'] )) {
						unset ( $_POST ['updatePayeeBSB'] );
						header ( 'Location: Payee-Modify' );
					} else {
						$payee->bsb = $_POST ['updatePayeeBSB'];
						unset ( $_POST ['updatePayeeBSB'] );
						
						// Validate the account number.
						try {
							$validate->accountNumber ( $_POST ['updatePayeeAccountNumber'] );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['error'] )) {
							unset ( $_POST ['updatePayeeAccountNumber'] );
							header ( 'Location: Payee-Modify' );
						} else {
							$payee->accountNumber = $_POST ['updatePayeeAccountNumber'];
							unset ( $_POST ['updatePayeeAccountNumber'] );
							
							// If all is OK, update the payee.
							$payee->update ();
							unset ( $_SESSION ['payeeModifyID'] );
						}
					}
				}
			}
		}
		
		// Delete the payee if the request is submitted.
		if (isset ( $_POST ['deletePayee'] )) {
			unset ( $_POST ['deletePayee'] );
			$payee = new Payees ();
			$payee->payeeID = $_SESSION ['payeeDeleteID'];
			$payee->delete ();
			unset ( $_SESSION ['payeeDeleteID'] );
			unset ( $_SESSION ['accountName'] );
			unset ( $_SESSION ['accountNickname'] );
			unset ( $_SESSION ['bsb'] );
			unset ( $_SESSION ['accountNumber'] );
		}
		
		// Set the payee type as selected in the drop down list.
		if (isset ( $_POST ['payeeType'] )) {
			if ($_POST ['payeeType'] == 'All Payment Types') {
				$_SESSION ['allPayeeList'] = 'selected = "selected"';
				unset ( $_SESSION ['billPayeeList'] );
				unset ( $_SESSION ['fundsTransferPayeeList'] );
				unset ( $_SESSION ['billPayee'] );
				unset ( $_SESSION ['fundsTransferPayee'] );
				unset ( $_POST ['payeeType'] );
			} elseif ($_POST ['payeeType'] == 'Bill Payment') {
				unset ( $_SESSION ['allPayeeList'] );
				$_SESSION ['billPayeeList'] = 'selected = "selected"';
				unset ( $_SESSION ['fundsTransferPayeeList'] );
				unset ( $_POST ['payeeType'] );
				unset ( $_SESSION ['billPayee'] );
				unset ( $_SESSION ['fundsTransferPayee'] );
			} elseif ($_POST ['payeeType'] == 'Funds Transfer') {
				unset ( $_SESSION ['allPayeeList'] );
				unset ( $_SESSION ['billPayeeList'] );
				$_SESSION ['fundsTransferPayeeList'] = 'selected = "selected"';
				unset ( $_POST ['payeeType'] );
				unset ( $_SESSION ['billPayee'] );
				unset ( $_SESSION ['fundsTransferPayee'] );
			}
		} elseif (isset ( $_SESSION ['billPayee'] )) {
			unset ( $_SESSION ['allPayeeList'] );
			$_SESSION ['billPayeeList'] = 'selected = "selected"';
			unset ( $_SESSION ['fundsTransferPayeeList'] );
			unset ( $_SESSION ['fundsTransferPayee'] );
		} elseif (isset ( $_SESSION ['fundsTransferPayee'] )) {
			unset ( $_SESSION ['allPayeeList'] );
			unset ( $_SESSION ['billPayeeList'] );
			$_SESSION ['fundsTransferPayeeList'] = 'selected = "selected"';
			unset ( $_SESSION ['billPayee'] );
		} else {
			$_SESSION ['allPayeeList'] = 'selected = "selected"';
			unset ( $_SESSION ['billPayeeList'] );
			unset ( $_SESSION ['fundsTransferPayeeList'] );
			unset ( $_SESSION ['billPayee'] );
			unset ( $_SESSION ['fundsTransferPayee'] );
		}
		
		// Display the payee list.
		$payeelist = new Payeelist ();
		
		$payeelist->init ();
		
		include 'view/layout/payeelist.php';
	}
}
?>