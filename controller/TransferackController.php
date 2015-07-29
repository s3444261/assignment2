<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class TransferackController {
	
	public function display()
	{
		if(isset($_POST['cancel'])){
			$transfer = new Transfer();
			$transfer->cancelSessions();
			unset($_POST['cancel']);
			$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
			$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
			header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "New-Funds-Transfer");
		} elseif(isset($_POST['submit'])){
			unset ( $_POST ['submit'] );
				
			if (isset ( $_POST ['password'] )) {
			
				if ($_POST ['password'] == 'blah') {
					unset ( $_POST ['password'] );
					$transferack = new Transferack ();
					$transferack->init ();
					include 'view/layout/transferack.php';
				} else {
					unset ( $_POST ['password'] );
					$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
					$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
					header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Check-Transfer");
				}
			}
		}
	}
}
?>