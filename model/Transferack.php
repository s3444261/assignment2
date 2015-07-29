<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Transferack {
	
	public function init(){
		$_SESSION['transferStatus'] = 'Paid';
		$_SESSION['transferConf'] = 'G34340000';
		$_SESSION['transferCreated'] = date("Y-m-d H:i:s");
	}
}
?>