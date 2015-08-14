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
				
				$validate = new Validation ();
				
				try {
					$validate->password ( $_POST ['password'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
				
				if (isset($_SESSION['error'])) {
					unset ( $_POST ['password'] );
					header ( 'Location: New-Funds-Transfer' );
				} else {
					$user = new Users ();
					$user->userID = $_SESSION ['userID'];
					$user->password = $_POST ['password'];
					unset ( $_POST ['password'] );
						
					try {
						$user->confirmPassword ();
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
						
					if (isset($_SESSION['error'])) {
						header ( 'Location: New-Funds-Transfer' );
					} else {
						$account = new Account();
						$account->accountID = $_SESSION['transferAccountID'];					
						if($account->processTransfer()){
							$transferack = new Transferack ();
							$transferack->init ();
							include 'view/layout/transferack.php';
						} else {
							$checkTransfer = new CheckTransfer();
							$checkTransfer->init ();
							include 'view/layout/checktransfer.php';
						}
					}
				}
			}
		}
	}
}
?>