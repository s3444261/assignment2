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
			$_SESSION['paymentTypeBillSelected'] = 'selected="selected"';
			unset($_POST['payPaymentList']);
		}
		
		$paymentlist = new Paymentlist();
		
		$paymentlist->init();
		
		include 'view/layout/paymentlist.php';
	}
}
?>