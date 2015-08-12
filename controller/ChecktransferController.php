<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class ChecktransferController {
	
	public function display()
	{
		if(isset($_POST['cancel'])){
			$transfer = new Transfer();
			$transfer->cancelSessions();
			unset($_POST['cancel']);
			$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
			$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
			header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "New-Funds-Transfer");
		} elseif(isset($_POST['next'])){
		
			$checktransfer = new CheckTransfer();
			
			if(isset($_POST['account']) && isset($_POST['accountPayee'])){
				$checktransfer->unsetLast();
			
				$_SESSION['transferAccountID'] = $_POST['account'];
				unset($_POST['account']);
							
				$_SESSION['transferAccountPayeeID'] = $_POST['accountPayee'];
				unset($_POST['accountPayee']);
			}
			
			if(isset($_POST['transferAmount'])){
				$_SESSION['transferAmount'] = $_POST['transferAmount'];
				unset($_POST['transferAmount']);
			}
			
			if(isset($_POST['transferDescription'])){
				$_SESSION['transferDescription'] = $_POST['transferDescription'];
				unset($_POST['transferDescription']);
			}
			
			if(isset($_POST['transferRemitter'])){
				$_SESSION['transferRemitter'] = $_POST['transferRemitter'];
				unset($_POST['transferRemitter']);
			}
			
			if(isset($_POST['transferDate'])){
				$_SESSION['transferDate'] = $_POST['transferDate'];
				unset($_POST['transferDate']);
			}
			
			$checktransfer->init();
			
			include 'view/layout/checktransfer.php';
		}
	}
}
?>