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
		if(isset($_POST['addPayee'])){
			
			$payee = new Payees();
			$payee->userID = $_SESSION['userID'];
			$validate = new Validation();
			
			try {
				$validate->accountName( $_POST ['addPayeeAccountName'] );
			} catch ( ValidationException $e ) {
				$_SESSION ['error'] = $e->getError ();
			}
			
			if (isset ( $_SESSION ['error'] )) {
				unset ( $_POST ['addPayeeAccountName'] );
				header ( 'Location: Payee-Add' );
			} else {
				$payee->accountName = $_POST ['addPayeeAccountName'];
				unset ( $_POST ['addPayeeAccountName'] );
					
				try {
					$validate->accountNickname( $_POST ['addPayeeAccountNickname'] );
				} catch ( ValidationException $e ) {
					$_SESSION ['error'] = $e->getError ();
				}
					
				if (isset ( $_SESSION ['error'] )) {
					unset ( $_POST ['addPayeeAccountNickname'] );
					header ( 'Location: Payee-Add' );
				} else {
					$payee->accountNickname = $_POST ['addPayeeAccountNickname'];
					unset ( $_POST ['addPayeeAccountNickname'] );
						
					try {
						$validate->accountBSB( $_POST ['addPayeeBSB'] );
					} catch ( ValidationException $e ) {
						$_SESSION ['error'] = $e->getError ();
					}
						
					if (isset ( $_SESSION ['error'] )) {
						unset ( $_POST ['addPayeeBSB'] );
						header ( 'Location: Payee-Add' );
					} else {
						$payee->bsb = $_POST ['addPayeeBSB'];
						unset ( $_POST ['addPayeeBSB'] );
					
						try {
							$validate->accountNumber( $_POST ['addPayeeAccountNumber'] );
						} catch ( ValidationException $e ) {
							$_SESSION ['error'] = $e->getError ();
						}
						
						if (isset ( $_SESSION ['error'] )) {
							unset ( $_POST ['addPayeeAccountNumber'] );
							header ( 'Location: Payee-Add' );
						} else {
							$payee->accountNumber = $_POST ['addPayeeAccountNumber'];
							unset ( $_POST ['addPayeeAccountNumber'] );
								
							$payee->set();
						}
					}
				}
			}
		}
		$transfer= new Transfer();
		$transfer->init();
			
		include 'view/layout/transfer.php';
	}
}
?>