<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Paymentack {
	
	public function init(){
		$_SESSION['payCreated'] = date("Y-m-d H:i:s"); 
		if(isset($_SESSION['payDate'])){
			$date = date_create ( $_SESSION['payDate'] );
			$_SESSION['payDate'] = date_format ( $date, 'j F Y' );
		}
	}
}
?>