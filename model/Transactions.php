<?php
if (! class_exists ( 'Database' )) {
	require_once ('connect/Database.php');
}
class Transactions {
	private $_transactionID = '';
	private $_accountID = '';
	private $_transactionDate = '';
	private $_transactionDescription = '';
	private $_transactee = '';
	private $_accountNickname = '';
	private $_transactionStatus = '';
	private $_transactionType = '';
	private $_debits = '';
	private $_credits = '';
	private $_created_at;
	private $_updated_at;
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	public function getTransaction() {
		$query = "SELECT *
    				FROM Transactions
    				WHERE transactionID = :transactionID";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':transactionID', $this->_transactionID );
		$stmt->execute ();
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		$this->_accountID = $row ['accountID'];
		$this->_transactionDate = $row ['transactionDate'];
		$this->_transactionDescription = $row ['transactionDescription'];
		$this->_transactee = $row ['transactee'];
		$this->_transactionStatus = $row ['transactionStatus'];
		$this->_transactionType = $row ['transactionType'];
		$this->_debits = $row ['debits'];
		$this->_credits = $row ['credits'];
	}
	public function getTransactions($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$transactions = array ();
		$query = "SELECT transactionID AS tid, accountID, transactionDate, transactionDescription, transactee, 
					transactionStatus, transactionType,debits, credits, 
					(SELECT SUM(credits) - SUM(debits) + :openBalance
					FROM Transactions
					WHERE accountID = :accountID
					AND transactionID <= tid) AS transactionBalance
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . " ORDER BY transactionDate DESC";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->bindParam ( ':openBalance', $arr ['openBalance'] );
		$stmt->execute ();
		
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$transaction = array ();
			$transaction ['accountID'] = $row ['accountID'];
			$transaction ['transactionDate'] = $row ['transactionDate'];
			$transaction ['transactionDescription'] = $row ['transactionDescription'];
			$transaction ['transactee'] = $row ['transactee'];
			$transaction ['transactionStatus'] = $row ['transactionStatus'];
			$transaction ['transactionType'] = $row ['transactionType'];
			$transaction ['debits'] = $row ['debits'];
			$transaction ['credits'] = $row ['credits'];
			$transaction ['transactionBalance'] = $row ['transactionBalance'];
			$transactions [] = $transaction;
		}
		
		return $transactions;
	}
	public function getDebits($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$query = "SELECT FORMAT(SUM(debits), 2) AS totalDebits
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate;
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
		
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		return $row ['totalDebits'];
	}
	public function getCredits($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$query = "SELECT FORMAT(SUM(credits), 2) AS totalCredits
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate;
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
		
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		return $row ['totalCredits'];
	}
	public function getFees($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$query = "SELECT FORMAT(SUM(debits), 2) AS fees
					FROM Transactions
					WHERE accountID = :accountID
					AND transactionDescription = 'BANK FEES' " . $searchDetails . $amount . $fromDate . $toDate;
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
		
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if (! $row ['fees']) {
			$row ['fees'] = '0.00';
		}
		
		return $row ['fees'];
	}
	public function getNet($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$query = "SELECT FORMAT((SELECT SUM(credits)
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . ") - 
				(SELECT SUM(debits)
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . ") -
				(SELECT SUM(debits)
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . " AND transactionDescription = 'BANK FEES'), 2) AS net";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
		
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if (! $row ['net']) {
			$query = "SELECT FORMAT((SELECT SUM(credits)
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . ") -
				(SELECT SUM(debits)
					FROM Transactions
					WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . "), 2) AS net";
			
			$db = Database::getInstance ();
			$stmt = $db->prepare ( $query );
			$stmt->bindParam ( ':accountID', $this->_accountID );
			$stmt->execute ();
			
			$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		}
		
		return $row ['net'];
	}
	public function countTransactions($arr) {
		$fromDate = $this->queryFromDate ();
		$toDate = $this->queryToDate ();
		$amount = $this->queryAmount ();
		$searchDetails = $this->querySearch ();
		
		$transactions = array ();
		$query = "SELECT COUNT(*) AS numTransactions
    				FROM Transactions
    				WHERE accountID = :accountID " . $searchDetails . $amount . $fromDate . $toDate . " ORDER BY transactionDate DESC;";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
		
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		return $row ['numTransactions'];
	}
	public function set() {
		$query = "INSERT INTO Transactions
					SET accountID = :accountID,
    					transactionDate = :transactionDate,
    					transactionDescription = :transactionDescription,
		    			transactee = :transactee,
		    			transactionStatus = :transactionStatus,
						transactionType = :transactionType,
		    			debits = :debits,
		    			credits = :credits,
						created_at = NULL";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->bindParam ( ':transactionDate', $this->_transactionDate );
		$stmt->bindParam ( ':transactionDescription', $this->_transactionDescription );
		$stmt->bindParam ( ':transactee', $this->_transactee );
		$stmt->bindParam ( ':transactionStatus', $this->_transactionStatus );
		$stmt->bindParam ( ':transactionType', $this->_transactionType );
		$stmt->bindParam ( ':debits', $this->_debits );
		$stmt->bindParam ( ':credits', $this->_credits );
		$stmt->execute ();
		$this->_transactionID = $db->lastInsertId ();
		if ($this->_transactionID > 0) {
			return $this->_transactionID;
		} else {
			return 0;
		}
	}
	private function querySearch() {
		$search = null;
		if (isset ( $_SESSION ['searchDetails'] )) {
			if (strlen ( $_SESSION ['searchDetails'] ) > 0) {
				$search = " AND ((LOWER(transactionDescription) LIKE LOWER('%" . $_SESSION ['searchDetails'] . "%'))
    				OR (LOWER(transactee) LIKE LOWER('%" . $_SESSION ['searchDetails'] . "%')))";
			} else {
				$search = null;
			}
		}
		return $search;
	}
	private function queryFromDate() {
		if (isset ( $_SESSION ['fromDate'] )) {
			$from = " AND transactionDate >= '" . $_SESSION ['fromDate'] . "'";
		} else {
			$from = null;
		}
		return $from;
	}
	private function queryToDate() {
		if (isset ( $_SESSION ['toDate'] )) {
			$to = " AND transactionDate <= '" . $_SESSION ['toDate'] . "'";
		} else {
			$to = null;
		}
		return $to;
	}
	private function queryAmount() {
		$amount = null;
		if (isset ( $_SESSION ['fromAmount'] ) && isset ( $_SESSION ['toAmount'] )) {
			if (strlen ( $_SESSION ['fromAmount'] ) > 0 && strlen ( $_SESSION ['toAmount'] ) > 0) {
				$amount = " AND ((debits >= " . $_SESSION ['fromAmount'] . " AND debits <= " . $_SESSION ['toAmount'] . " )
						OR (credits >= " . $_SESSION ['fromAmount'] . " AND credits <= " . $_SESSION ['toAmount'] . ")) ";
			} elseif (strlen ( $_SESSION ['fromAmount'] ) > 0 && strlen ( $_SESSION ['toAmount'] ) == 0) {
				$amount = " AND ((debits >= " . $_SESSION ['fromAmount'] . " )
						OR (credits >= " . $_SESSION ['fromAmount'] . ")) ";
			} elseif (strlen ( $_SESSION ['fromAmount'] ) == 0 && strlen ( $_SESSION ['toAmount'] ) > 0) {
				$amount = " AND debits <= " . $_SESSION ['toAmount'] . " AND credits <= " . $_SESSION ['toAmount'] . " ";
			}
		}
		
		return $amount;
	}
	
	public function getPayments() {
		
		$transactionType = null;
		$payee = null;
		$status = null;
		$amount = null;
		$date = null;
		
		if($this->_transactionType == 'Biller'){
			$transactionType = "AND transactionType = 'Biller'";
		} elseif($this->_transactionType == 'Payee'){
			$transactionType = "AND transactionType = 'Payee'";
		} elseif($this->_transactionType == 'Both'){
			$transactionType = "AND (transactionType = 'Biller' OR transactionType = 'Payee')";
		}
		
		if(isset($_SESSION ['payListName'])){
			$payee = " AND transactee = '" . $_SESSION ['payListName'] . "'";
		}
		
		if(isset($_SESSION ['payListStatus'])){
			$status = " AND transactionStatus = '" . $_SESSION ['payListStatus'] . "'";
		}
		
		if(isset($_SESSION ['payListFromAmount']) && isset($_SESSION ['payListToAmount'])){
			if($_SESSION ['payListFromAmount'] > 0 && $_SESSION ['payListToAmount'] > 0){
				$amount = " AND debits >= '" . $_SESSION ['payListFromAmount'] .
							"' AND debits <= '" . $_SESSION ['payListToAmount'] . "'";
			} elseif($_SESSION ['payListFromAmount'] > 0 && $_SESSION ['payListToAmount'] == 0){
				$amount = " AND debits >= '" . $_SESSION ['payListFromAmount'] . "'";
			} elseif($_SESSION ['payListFromAmount'] == 0 && $_SESSION ['payListToAmount'] > 0){
				$amount = " AND debits <= '" . $_SESSION ['payListToAmount'] . "'";
			}
		} 
		
		if(isset($_SESSION ['payListFromDate']) && isset($_SESSION ['payListToDate'])){
			if(strlen($_SESSION ['payListFromDate']) > 0 && strlen($_SESSION ['payListToDate']) > 0){
				$date = " AND transactionDate >= '" . $_SESSION ['payListFromDate'] .
							"' AND transactionDate <= '" . $_SESSION ['payListToDate'] . "'";
			} elseif(strlen($_SESSION ['payListFromDate']) > 0 && strlen($_SESSION ['payListToDate']) == 0){
				$date = " AND transactionDate >= '" . $_SESSION ['payListFromDate'] . "'";
			} elseif(strlen($_SESSION ['payListFromDate']) == 0 && strlen($_SESSION ['payListToDate']) > 0){
				$date = " AND transactionDate <= '" . $_SESSION ['payListToDate'] . "'";
			}
		}
		
		$payments = array ();
		$query = "SELECT transactionDate, transactionType, accountID,
					(SELECT CONCAT(accountName, '/', bsb, ' ', accountNumber) 
						FROM Accounts WHERE Accounts.accountID = Transactions.accountID) AS payFrom, transactee,
					transactionStatus, debits
					FROM Transactions
					WHERE accountID = :accountID 
					" . $transactionType . 
					$payee .
					$status .
					$amount .
					$date . "
					ORDER BY transactionDate DESC"; 
	
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
	
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$payment = array ();
			$payment ['payeeDate'] = $row ['transactionDate'];
			$payment ['payeeType'] = $row ['transactionType'];
			if($payment ['payeeType'] == 'Biller'){
				$payment ['payeeType'] = 'Bill Payment';
			} elseif($payment ['payeeType'] == 'Payee'){
				$payment ['payeeType'] = 'Funds Transfer';
			}
			$payment ['accountID'] = $row ['accountID'];
			$payment ['payeePayFrom'] = $row ['payFrom'];
			$payment ['payeePayTo'] = $row ['transactee'];
			$payment ['payeeStatus'] = $row ['transactionStatus'];
			$payment ['payeeAmount'] = $row ['debits'];
			$payments [] = $payment; 
		}
		return $payments;
	}
	
	public function countPayments() {
	
		$transactionType = null;
		$payee = null;
		$status = null;
		$amount = null;
		$date = null;
	
		if($this->_transactionType == 'Biller'){
			$transactionType = "AND transactionType = 'Biller'";
		} elseif($this->_transactionType == 'Payee'){
			$transactionType = "AND transactionType = 'Payee'";
		} elseif($this->_transactionType == 'Both'){
			$transactionType = "AND (transactionType = 'Biller' OR transactionType = 'Payee')";
		}
	
		if(isset($_SESSION ['payListName'])){
			$payee = " AND transactee = '" . $_SESSION ['payListName'] . "'";
		}
	
		if(isset($_SESSION ['payListStatus'])){
			$status = " AND transactionStatus = '" . $_SESSION ['payListStatus'] . "'";
		}
	
		if(isset($_SESSION ['payListFromAmount']) && isset($_SESSION ['payListToAmount'])){
			if($_SESSION ['payListFromAmount'] > 0 && $_SESSION ['payListToAmount'] > 0){
				$amount = " AND debits >= '" . $_SESSION ['payListFromAmount'] .
				"' AND debits <= '" . $_SESSION ['payListToAmount'] . "'";
			} elseif($_SESSION ['payListFromAmount'] > 0 && $_SESSION ['payListToAmount'] == 0){
				$amount = " AND debits >= '" . $_SESSION ['payListFromAmount'] . "'";
			} elseif($_SESSION ['payListFromAmount'] == 0 && $_SESSION ['payListToAmount'] > 0){
				$amount = " AND debits <= '" . $_SESSION ['payListToAmount'] . "'";
			}
		}
	
		if(isset($_SESSION ['payListFromDate']) && isset($_SESSION ['payListToDate'])){
			if(strlen($_SESSION ['payListFromDate']) > 0 && strlen($_SESSION ['payListToDate']) > 0){
				$date = " AND transactionDate >= '" . $_SESSION ['payListFromDate'] .
				"' AND transactionDate <= '" . $_SESSION ['payListToDate'] . "'";
			} elseif(strlen($_SESSION ['payListFromDate']) > 0 && strlen($_SESSION ['payListToDate']) == 0){
				$date = " AND transactionDate >= '" . $_SESSION ['payListFromDate'] . "'";
			} elseif(strlen($_SESSION ['payListFromDate']) == 0 && strlen($_SESSION ['payListToDate']) > 0){
				$date = " AND transactionDate <= '" . $_SESSION ['payListToDate'] . "'";
			}
		}
	
		$query = "SELECT count(*) AS numPayments
					FROM Transactions
					WHERE accountID = :accountID
					" . $transactionType .
						$payee .
						$status .
						$amount .
						$date . "
					ORDER BY transactionDate DESC";
	
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->bindParam ( ':accountID', $this->_accountID );
		$stmt->execute ();
	
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		return $row['numPayments'];
	}
	
	// Display Object Contents
	public function printf() {
		echo '<br /><strong>Transaction Object:</strong><br />';
		if ($this->_transactionID) {
			echo 'transactionID => ' . $this->_transactionID . '<br/>';
		}
		if ($this->_accountID) {
			echo 'accountID => ' . $this->_accountID . '<br/>';
		}
		if ($this->_transactionDate) {
			echo 'transactionDate => ' . $this->_transactionDate . '<br/>';
		}
		if ($this->_transactionDescription) {
			echo 'transactionDescription => ' . $this->_transactionDescription . '<br/>';
		}
		if ($this->_transactee) {
			echo 'transactee => ' . $this->_transactee . '<br/>';
		}
		if ($this->_transactionStatus) {
			echo 'transactionStatus => ' . $this->_transactionStatus . '<br/>';
		}
		if ($this->_debits) {
			echo 'debits => ' . $this->_debits . '<br/>';
		}
		if ($this->_credits) {
			echo 'credits => ' . $this->_credits . '<br/>';
		}
		if ($this->_created_at) {
			echo '<br/>created_at => ' . $this->_created_at . '<br/>';
		}
		if ($this->_updated_at) {
			echo 'updated_at => ' . $this->_updated_at . '<br/>';
		}
	}
}
?>