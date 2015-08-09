<?php
include_once 'connect/config.php';
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

$db = Database::getInstance();

$query = "DROP TABLE IF EXISTS `Transactions`";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "DROP TABLE IF EXISTS `Payees`";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "DROP TABLE IF EXISTS `Billers`";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "DROP TABLE IF EXISTS `Accounts`";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "DROP TABLE IF EXISTS `Users`";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `email` varchar(90) NOT NULL,
  `password` varchar(45) NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `bsb` varchar(10) NOT NULL,
  `accountNumber` varchar(20) NOT NULL,
  `accountName` varchar(90) NOT NULL,
  `accountNickname` varchar(45) NOT NULL,
  `productName` varchar(45) NOT NULL,
  `recordedLimit` decimal(10,2) signed NOT NULL,
  `openDate` datetime NOT NULL,
  `openBalance` decimal(10,2) signed NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountID`),
  KEY `FK_Accounts_Users_idx` (`userID`),
  CONSTRAINT `FK_Accounts_Users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Billers` (
  `billerID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `billerCode` varchar(10) NOT NULL,
  `billerName` varchar(90) NOT NULL,
  `billerNickname` varchar(45) NOT NULL,
  `customerReference` varchar(45) NULL,
  `billerStatus` varchar(10) NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`billerID`),
  KEY `FK_Billers_Users_idx` (`userID`),
  CONSTRAINT `FK_Billers_Users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Payees` (
  `payeeID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `bsb` varchar(10) NOT NULL,
  `accountNumber` varchar(20) NOT NULL,
  `accountName` varchar(90) NOT NULL,
  `accountNickname` varchar(45) NOT NULL,
  `payeeStatus` varchar(10) NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payeeID`),
  KEY `FK_Payees_Users_idx` (`userID`),
  CONSTRAINT `FK_Payees_Users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Transactions` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `transactionDate` datetime NOT NULL,
  `transactionDescription` varchar(90) NULL,
  `transactee` varchar(90) NULL,
  `transactionStatus` varchar(20) NULL,
  `transactionType` varchar(20) NULL,
  `debits` decimal(10,2) unsigned NULL,
  `credits` decimal(10,2) unsigned NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transactionID`),
  KEY `FK_Transactions_Accounts_idx` (`accountID`),
  CONSTRAINT `FK_Transactions_Accounts` FOREIGN KEY (`accountID`) REFERENCES `Accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();


$user = new Users();
$user->user = 123456;
$user->email = 's3444261@student.rmit.edu.au';
$user->password = 'TestTest88';
$userID = $user->set();

$args = array();
$args[] = array('userID' => $userID,
		'bsb' => '083-445',
		'accountNumber' => '45-789-2588',
		'accountName' => 'G.Kinkead Savings Account',
		'accountNickname' => 'Savings Acct',
		'productName' => 'Savings Account',
		'recordedLimit' => '0.00',
		'openDate' => '2011-07-01',
		'openBalance' => '1242.23'
);
$args[] = array('userID' => $userID,
		'bsb' => '083-445',
		'accountNumber' => '47-885-1478',
		'accountName' => 'G.Kinkead & M.Kinkead Overdraft Account',
		'accountNickname' => 'Loan Acct',
		'productName' => 'Overdraft Account',
		'recordedLimit' => '-5000',
		'openDate' => '2011-07-01',
		'openBalance' => '2021.24'
);
$args[] = array('userID' => $userID,
		'bsb' => '083-445',
		'accountNumber' => '46-551-6693',
		'accountName' => 'Kinkead Family Trust Account',
		'accountNickname' => 'Family Trust',
		'productName' => 'Investment Account',
		'recordedLimit' => '0.00',
		'openDate' => '2011-07-01',
		'openBalance' => '4487.14'
);
foreach($args as $arg){
	$account = new Account($arg);
	$account->set();
}

$args = array();
$args[] = array('userID' => $userID,
		'billerCode' => '130112',
		'billerName' => 'ORIGIN ENERGY',
		'billerNickname' => 'ORIGIN ENERGY',
		'customerReference' => '5485236485',
		'billerStatus' => ''
); 
$args[] = array('userID' => $userID,
		'billerCode' => '8789',
		'billerName' => 'CITY WEST WATER',
		'billerNickname' => 'CITY WEST WATER',
		'customerReference' => '4571245974',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '5249',
		'billerName' => 'SROVIC LAND TAX',
		'billerNickname' => 'SROVIC LAND TAX',
		'customerReference' => '8854177569',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '6247',
		'billerName' => 'RACV',
		'billerNickname' => 'RACV',
		'customerReference' => '3321542896',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '90134',
		'billerName' => 'RACV INSURANCE',
		'billerNickname' => 'RACV INSURANCE',
		'customerReference' => '2225488179',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '93880',
		'billerName' => 'IINET LIMITED',
		'billerNickname' => 'IINET',
		'customerReference' => '5454289321',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '216291',
		'billerName' => 'VICROADS REGO',
		'billerNickname' => 'VICROADS HILUX',
		'customerReference' => '5654289374',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '216291',
		'billerName' => 'VICROADS REGO',
		'billerNickname' => 'VICROADS PRIUS',
		'customerReference' => '8854289491',
		'billerStatus' => ''
);
$args[] = array('userID' => $userID,
		'billerCode' => '254865',
		'billerName' => 'NELSON ALEXANDER',
		'billerNickname' => 'RENT PAYMENT',
		'customerReference' => '8547289491',
		'billerStatus' => ''
);

foreach($args as $arg){
	$biller = new Billers($arg);
	$biller->set();
}

$args = array();
$args[] = array('userID' => $userID,
		'bsb' => '261-452',
		'accountNumber' => '32-455-2133',
		'accountName' => 'M.Peterson',
		'accountNickname' => 'Michael Petersons Acct',
		'payeeStatus' => ''
);
$args[] = array('userID' => $userID,
		'bsb' => '334-544',
		'accountNumber' => '98-332-3454',
		'accountName' => 'L.Johnson',
		'accountNickname' => 'Lynda Johnsons Acct',
		'payeeStatus' => ''
);
$args[] = array('userID' => $userID,
		'bsb' => '243-987',
		'accountNumber' => '31-354-9987',
		'accountName' => 'B.Murphy',
		'accountNickname' => 'Brett Murphys Acct',
		'payeeStatus' => ''
);
$args[] = array('userID' => $userID,
		'bsb' => '276-873',
		'accountNumber' => '89-987-2765',
		'accountName' => 'D.A. Ingles',
		'accountNickname' => 'Darrn Ingles Acct',
		'payeeStatus' => ''
);
$args[] = array('userID' => $userID,
		'bsb' => '365-986',
		'accountNumber' => '23-354-8954',
		'accountName' => 'P.Jones',
		'accountNickname' => 'Paul Jones Acct',
		'payeeStatus' => ''
);

foreach($args as $arg){
	$payee = new Payees($arg);
	$payee->set();
}

date_default_timezone_set('Australia/Melbourne');
$startDate = '2011-07-01';
$currentDate = $startDate;
$oneDay = new DateInterval('P1D');

while(strtotime($currentDate) < time()){
	$currentDate = new DateTime($currentDate);
	$currentDate->add($oneDay);
	$currentDate = $currentDate->format('Y-m-d');
	$d = explode('-', $currentDate);
	
	if($d[2] == '1'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'BANK FEES',
				'transactee' => 'Federal Australia Bank',
				'transactionType' => 'Bank',
				'debits' => '10.00'
		);
		
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[2] == '5' && $d[1]%2 == 0){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Ref: 5485236485',
				'transactee' => 'ORIGIN ENERGY',
				'transactionType' => 'Biller',
				'transactionStatus' => 'Paid',
				'debits' => '624.26'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[2] == '5' && $d[1]%2 == 1){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Ref: 5485236485',
				'transactee' => 'CITY WEST WATER',
				'transactionType' => 'Biller',
				'transactionStatus' => 'Paid',
				'debits' => '132.57'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[2] == '15'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Salary',
				'transactee' => 'BigShot Software Pty Ltd',
				'credits' => '6575.19'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[2] == '17'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'ATM: Johnston Street, Collingwood',
				'transactee' => 'FAB',
				'transactionType' => 'Bank',
				'debits' => '200.00'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[2] == '23'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Rent: 53 Johnston Street, Collingwood',
				'transactee' => 'NELSON ALEXANDER',
				'transactionType' => 'Biller',
				'transactionStatus' => 'Paid',
				'debits' => '1857.24'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[0] == '3' && $d[2] == '24'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Cust Ref: 5654289374',
				'transactee' => 'VIC ROADS',
				'transactionType' => 'Biller',
				'transactionStatus' => 'Paid',
				'debits' => '542.35'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
	
	if($d[1] == '9' && $d[2] == '24'){
		$args = array('transactionDate' => $currentDate,
				'transactionDescription' => 'Cust Ref: 8854289491',
				'transactee' => 'VIC ROADS',
				'transactionType' => 'Biller',
				'transactionStatus' => 'Paid',
				'debits' => '496.24'
		);
	
		$transaction = new Account();
		$transaction->accountID = '1';
		$transaction->accountTransaction($args);
	}
}


$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Home");



?>