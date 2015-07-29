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
	
	public function display()
	{
		if(isset($_POST['payeeType'])){
			if($_POST['payeeType'] == 'All Payment Types'){
				$_SESSION['allPayeeList'] = 'selected = "selected"';
				unset($_SESSION['billPayeeList']);
				unset($_SESSION['fundsTransferPayeeList']);
				unset($_SESSION['billPayee']);
				unset($_SESSION['fundsTransferPayee']);
				unset($_POST['payeeType']);
			} elseif($_POST['payeeType'] == 'Bill Payment'){
				unset($_SESSION['allPayeeList']);
				$_SESSION['billPayeeList'] = 'selected = "selected"';
				unset($_SESSION['fundsTransferPayeeList']);
				unset($_POST['payeeType']);
				unset($_SESSION['billPayee']);
				unset($_SESSION['fundsTransferPayee']);
			} elseif($_POST['payeeType'] == 'Funds Transfer'){
				unset($_SESSION['allPayeeList']);
				unset($_SESSION['billPayeeList']);
				$_SESSION['fundsTransferPayeeList'] = 'selected = "selected"';
				unset($_POST['payeeType']);
				unset($_SESSION['billPayee']);
				unset($_SESSION['fundsTransferPayee']);
			} 
		} elseif(isset($_SESSION['billPayee'])){
			unset($_SESSION['allPayeeList']);
			$_SESSION['billPayeeList'] = 'selected = "selected"';
			unset($_SESSION['fundsTransferPayeeList']);
			unset($_SESSION['fundsTransferPayee']);
		} elseif(isset($_SESSION['fundsTransferPayee'])){
			unset($_SESSION['allPayeeList']);
			unset($_SESSION['billPayeeList']);
			$_SESSION['fundsTransferPayeeList'] = 'selected = "selected"';
			unset($_SESSION['billPayee']);
		} else {
			$_SESSION['allPayeeList'] = 'selected = "selected"';
			unset($_SESSION['billPayeeList']);
			unset($_SESSION['fundsTransferPayeeList']);
			unset($_SESSION['billPayee']);
			unset($_SESSION['fundsTransferPayee']);
		}
		
		$payeelist = new Payeelist();
		
		$payeelist->init();
		
		include 'view/layout/payeelist.php';
	}
}
?>