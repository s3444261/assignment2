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
	public function display() {
		if (isset ( $_POST ['updateBiller'] )) {
			unset ( $_POST ['updateBiller'] );
			$biller = new Billers ();
			$biller->billerID = $_SESSION ['billerModifyID'];
			$biller->billerNickname = $_POST ['updateBillerNickname'];
			unset ( $_POST ['updateBillerNickname'] );
			$biller->customerReference = $_POST ['updateBillerCustomerRef'];
			unset ( $_POST ['updateBillerCustomerRef'] );
			$biller->update ();
			unset ( $_SESSION ['billerModifyID'] );
			unset ( $_SESSION ['billerCode'] );
			unset ( $_SESSION ['billerName'] );
			unset ( $_SESSION ['billerNickname'] );
			unset ( $_SESSION ['customerReference'] );
		}
		
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
		
		if (isset ( $_POST ['updatePayee'] )) {
			unset ( $_POST ['updatePayee'] );
			$payee = new Payees ();
			$payee->payeeID = $_SESSION['payeeModifyID'];
			$payee->accountName = $_POST ['updatePayeeAccountName'];
			unset ( $_POST ['updatePayeeAccountName'] );
			$payee->accountNickname = $_POST ['updatePayeeAccountNickname'];
			unset ( $_POST ['updatePayeeAccountNickname'] );
			$payee->bsb = $_POST ['updatePayeeBSB'];
			unset ( $_POST ['updatePayeeBSB'] );
			$payee->accountNumber = $_POST ['updatePayeeAccountNumber'];
			unset ( $_POST ['updatePayeeAccountNumber'] );
			$payee->update ();
			unset ( $_SESSION ['payeeModifyID'] ); 
		}
		
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
		
		$payeelist = new Payeelist ();
		
		$payeelist->init ();
		
		include 'view/layout/payeelist.php';
	}
}
?>