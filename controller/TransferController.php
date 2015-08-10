<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class TransferController {
	
	public function display()
	{
		if(isset($_POST['addPayee'])){
			
			$payee = new Payees();
			$payee->userID = $_SESSION['userID'];
			
			if(isset($_POST['addPayeeAccountName'])){
				$payee->accountName = $_POST['addPayeeAccountName'];
				unset($_POST['addPayeeAccountName']);
			}
			
			if(isset($_POST['addPayeeAccountNickname'])){
				$payee->accountNickname = $_POST['addPayeeAccountNickname'];
				unset($_POST['addPayeeAccountNickname']);
			}
			
			if(isset($_POST['addPayeeBSB'])){
				$payee->bsb = $_POST['addPayeeBSB'];
				unset($_POST['addPayeeBSB']);
			}
			
			if(isset($_POST['addPayeeAccountNumber'])){
				$payee->accountNumber = $_POST['addPayeeAccountNumber'];
				unset($_POST['addPayeeAccountNumber']);
			}
			
			$payee->set();
		}
		
		$transfer= new Transfer();
		$transfer->init();
		
		include 'view/layout/transfer.php';
	}
}
?>