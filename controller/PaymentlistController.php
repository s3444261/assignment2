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
	
	public function display()
	{
		if(isset($_POST['paymentType'])){
			$paymentType = $_POST['paymentType'];
			if($_POST['paymentType'] == 'All Payment Types'){
				$_SESSION['allPaymentList'] = 'selected = "selected"';
				unset($_SESSION['billPaymentList']);
				unset($_SESSION['fundsTransferPaymentList']);
				unset($_SESSION['billPayment']);
				unset($_SESSION['fundsTransferPayment']);
				unset($_POST['paymentType']);
			} elseif($_POST['paymentType'] == 'Bill Payment'){
				unset($_SESSION['allPaymentList']);
				$_SESSION['billPaymentList'] = 'selected = "selected"';
				unset($_SESSION['fundsTransferPaymentList']);
				unset($_POST['paymentType']);
				unset($_SESSION['billPayment']);
				unset($_SESSION['fundsTransferPayment']);
			} elseif($_POST['paymentType'] == 'Funds Transfer'){
				unset($_SESSION['allPaymentList']);
				unset($_SESSION['billPaymentList']);
				$_SESSION['fundsTransferPaymentList'] = 'selected = "selected"';
				unset($_POST['paymentType']);
				unset($_SESSION['billPayment']);
				unset($_SESSION['fundsTransferPayment']);
			}
		} elseif(isset($_SESSION['billPayment'])){
			unset($_SESSION['allPaymentList']);
			$_SESSION['billPaymentList'] = 'selected = "selected"';
			unset($_SESSION['fundsTransferPaymentList']);
			unset($_SESSION['fundsTransferPayment']);
		} elseif(isset($_SESSION['fundsTransferPayment'])){
			unset($_SESSION['allPaymentList']);
			unset($_SESSION['billPaymentList']);
			$_SESSION['fundsTransferPaymentList'] = 'selected = "selected"';
			unset($_SESSION['billPayment']);
		} else {
			$_SESSION['allPaymentList'] = 'selected = "selected"';
			unset($_SESSION['billPaymentList']);
			unset($_SESSION['fundsTransferPaymentList']);
			unset($_SESSION['billPayment']);
			unset($_SESSION['fundsTransferPayment']);
		}
		
		$paymentlist = new Paymentlist();
		
		if(isset($_POST['clearFilter'])){
			$paymentlist->clearFilter();
		}
		
		if(isset($_POST['account'])){
			$paymentlist->unsetLast();
				
			$accountID = $_POST['account'];
			unset($_POST['account']);
			
			if(isset($_POST['payees'])){
				$payeeID = $_POST['payees'];
				unset($_POST['payees']);
			} else {
				$payees = null;
			}
			
			if(isset($_POST['status'])){
				$status = $_POST['status'];
				unset($_POST['status']);
			} else {
				$status = null;
			}
				
			if(isset($_POST['fromAmount'])){
				$fromAmount = $_POST['fromAmount'];
				unset($_POST['fromAmount']);
			} else {
				$fromAmount = null;
			}
				
			if(isset($_POST['toAmount'])){
				$toAmount = $_POST['toAmount'];
				unset($_POST['toAmount']);
			} else {
				$toAmount = null;
			}
				
			if(isset($_POST['fromDate'])){
				$fromDate = $_POST['fromDate'];
				unset($_POST['fromDate']);
			} else {
				$fromDate = null;
			}
				
			if(isset($_POST['toDate'])){
				$toDate = $_POST['toDate'];
				unset($_POST['toDate']);
			} else {
				$toDate = null;
			}
				
			$search = array('accountID' => $accountID,
					'paymentType' => $paymentType,
					'payeeID' => $payeeID,
					'status' => $status,
					'payListFromAmount' => $fromAmount,
					'payListToAmount' => $toAmount,
					'payListFromDate' => $fromDate,
					'payListToDate' => $toDate
			);
				
			$paymentlist->searchResults($search);
				
		} else {
			$paymentlist->init();
		}
		
		include 'view/layout/paymentlist.php';
	}
}
?>