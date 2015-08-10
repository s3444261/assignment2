<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class BillerdeleteController {
	
	public function display()
	{
		$biller = new Billers();
		$biller->billerID = $_SESSION['billerDeleteID'];
		$biller->getBiller();
		$_SESSION['billerCode'] = $biller->billerCode;
		$_SESSION['billerName'] = $biller->billerName;
		$_SESSION['billerNickname'] = $biller->billerNickname;
		$_SESSION['customerReference'] = $biller->customerReference;
		
		include 'view/layout/billerdelete.php';
	}
}
?>