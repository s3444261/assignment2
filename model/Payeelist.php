<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */


class Payeelist {
	
	public function init(){
		$payment = new Payment();
		$payment->cancelSessions();
		
		if(isset($_SESSION['billPayee']) || isset($_SESSION['billPayeeList'])){
			$_SESSION ['payeeList'] = array();
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'ASIC',
					'payeeName' => 'AUSTRALIAN SECURITIES & INVESTMENTS COMMISSION',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'ATO',
					'payeeName' => 'AUSTRALIAN TAXATION OFFICE',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/2">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/2">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'GIO',
					'payeeName' => 'AAI LIMITED T/AS GIO HOME & MOTOR INSURANCE',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/3">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/3">Delete</a>'
			);
		} elseif(isset($_SESSION['fundsTransferPayee']) || isset($_SESSION['fundsTransferPayeeList'])){
			$_SESSION ['payeeList'] = array();
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Trust Fund',
					'payeeName' => 'Kinkead Family Trust/BSB 083-334 Acct 87-345-4455',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Super Fund',
					'payeeName' => 'Kinkead Superannuation Fund/BSB 083-334 Acct 86-345-9998',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Cheque Account',
					'payeeName' => 'G. Kinkead Cheque Account/BSB 083-334 Acct 87-331-8877',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
		} elseif(isset($_SESSION['allPayeeList'])){
			$_SESSION ['payeeList'] = array();
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Trust Fund',
					'payeeName' => 'Kinkead Family Trust/BSB 083-334 Acct 87-345-4455',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'ASIC',
					'payeeName' => 'AUSTRALIAN SECURITIES & INVESTMENTS COMMISSION',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'ATO',
					'payeeName' => 'AUSTRALIAN TAXATION OFFICE',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/2">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/2">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Super Fund',
					'payeeName' => 'Kinkead Superannuation Fund/BSB 083-334 Acct 86-345-9998',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'Cheque Account',
					'payeeName' => 'G. Kinkead Cheque Account/BSB 083-334 Acct 87-331-8877',
					'payeeType' => 'Payee',
					'payeeModify' => '<a href="Modify-Payee/1">Modify</a>',
					'payeeDelete' => '<a href="Delete-Payee/1">Delete</a>'
			);
			$_SESSION ['payeeList'][] = array('payeeNickname' => 'GIO',
					'payeeName' => 'AAI LIMITED T/AS GIO HOME & MOTOR INSURANCE',
					'payeeType' => 'Biller',
					'payeeModify' => '<a href="Modify-Biller/3">Modify</a>',
					'payeeDelete' => '<a href="Delete-Biller/3">Delete</a>'
			);
		}
	}
}
?>