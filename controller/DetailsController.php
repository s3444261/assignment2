<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class DetailsController {
	
	public function display()
	{
		$details = new Details();
		
		if(isset($_POST['account'])){
			$details->unsetLast();
				
			$accountID = $_POST['account'];
			unset($_POST['account']);
				
			$details->getDetails($accountID);
				
		} else {
			$details->init();
		}
		
		include 'view/layout/details.php';
	}
}
?>