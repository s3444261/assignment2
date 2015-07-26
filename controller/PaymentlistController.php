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
		if(isset($_POST['payPaymentList'])){
			$_SESSION['billPaymentList'] = 'selected="selected"';
			unset($_POST['payPaymentList']);
		}
		
		$paymentlist = new Paymentlist();
		
		if(isset($_POST['clearFilter'])){
			$paymentlist->clearFilter();
		}
		
		if(isset($_POST['account'])){
			$paymentlist->unsetLast();
				
			$accountID = $_POST['account'];
			unset($_POST['account']);
				
			if(isset($_POST['paymentType'])){
				$paymentType = $_POST['paymentType'];
				unset($_POST['paymentType']);
			} else {
				$paymentType = null;
			}
			
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