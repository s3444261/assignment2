<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */

class HistoryController {
	
	public function display()
	{
		$history = new History();
		
		if(isset($_POST['account'])){
			$history->unsetLast();
			
			$accountID = $_POST['account'];
			unset($_POST['account']);
			
			if(isset($_POST['searchDetails'])){
				$searchDetails = $_POST['searchDetails'];
				unset($_POST['searchDetails']);
			} else {
				$searchDetails = null;
			}
			
			if(isset($_POST['fromAmount'])){
				$fromAmount = $_POST['fromAmount'];
				unset($_POST['fromAmount']);
			} else {
				$fromAmount = null;
			}
			
			if(isset($_POST['toAmount'])){
				$toAmount = $_POST['toAmount'];
				unset($_POST['toAmount']);
			} else {
				$toAmount = null;
			}
			
			if(isset($_POST['fromDate'])){
				$fromDate = $_POST['fromDate'];
				unset($_POST['fromDate']);
			} else {
				$fromDate = null;
			}
			
			if(isset($_POST['toDate'])){
				$toDate = $_POST['toDate'];
				unset($_POST['toDate']);
			} else {
				$toDate = null;
			}
			
			$search = array('accountID' => $accountID,
					'searchDetails' => $searchDetails,
					'fromAmount' => $fromAmount,
					'toAmount' => $toAmount,
					'fromDate' => $fromDate,
					'toDate' => $toDate
			);
			
			$history->searchResults($search);
			
		} else {
			$history->init();
		}
		
		include 'view/layout/history.php';
	}
}
?>