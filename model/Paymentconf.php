<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Paymentconf {
	
	public function init(){
		
	switch($_SESSION['payAccountID']){
				case 1 : 
					$_SESSION['payAccount'] = 'Kinkead Family Trust/083-006 45-333-3232 ($45,988.98)';
					break;
				case 2 :
					$_SESSION['payAccount'] = 'Kinkead Murphy Unit Trust/083-006 45-214-8745 ($5,988.98)';
					break;
				case 3 :
					$_SESSION['payAccount'] = 'Kinkead Superannuation Fund/083-006 45-546-3298 ($2,438.98)';
					break;
			}
	}
}
?>