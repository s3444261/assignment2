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
			// Create Payee Object
			$_POST['addPayeeAccountName'];
			$_POST['addPayeeAccountNickname'];
			$_POST['addPayeeAccountBSB'];
			$_POST['addPayeeAccountNumber'];
			// Insert into database
		}
		
		$transfer= new Transfer();
		$transfer->init();
		
		include 'view/layout/transfer.php';
	}
}
?>