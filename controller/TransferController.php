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
		$transfer= new Transfer();
		$transfer->init();
		
		include 'view/layout/transfer.php';
	}
}
?>