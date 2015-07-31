<?php
include_once 'connect/config.php';
if(!class_exists('Database')){
	require_once('connect/Database.php');
}

$db = Database::getInstance();

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
		'recordedLimit' => '0.00'
);
$args[] = array('userID' => $userID,
		'bsb' => '083-445',
		'accountNumber' => '47-885-1478',
		'accountName' => 'G.Kinkead & M.Kinkead Overdraft Account',
		'accountNickname' => 'Loan Acct',
		'productName' => 'Overdraft Account',
		'recordedLimit' => '-5000'
);
$args[] = array('userID' => $userID,
		'bsb' => '083-445',
		'accountNumber' => '46-551-6693',
		'accountName' => 'Kinkead Family Trust Account',
		'accountNickname' => 'Family Trust',
		'productName' => 'Investment Account',
		'recordedLimit' => '0.00'
);
foreach($args as $arg){
	$account = new Accounts($arg);
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

foreach($args as $arg){
	$biller = new Billers($arg);
	$biller->set();
}

$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Home");

/*
$query = "CREATE TABLE `Contacts` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `billerStatus` varchar(10) DEFAULT NULL,
  `company` varchar(90) DEFAULT NULL,
  `contactName` varchar(45) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `altPhone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `altEmail` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `billerStatus` varchar(45) NOT NULL,
  `rating` int(11),
  `autoQuote` varchar(3) NOT NULL,
  `contactID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerID`),
  KEY `FK_Customers_Contacts_idx` (`contactID`),
  CONSTRAINT `FK_Customers_Contacts` FOREIGN KEY (`contactID`) REFERENCES `Contacts` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `balance` decimal(10,2) unsigned NOT NULL,
  `billerStatus` varchar(45) NOT NULL,
  `startDate` date NOT NULL,
  `contactID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountID`),
  KEY `FK_Accounts_Contacts_idx` (`contactID`),
  CONSTRAINT `FK_Accounts_Contacts` FOREIGN KEY (`contactID`) REFERENCES `Contacts` (`contactID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "CREATE TABLE `Accountcustomers` (
  `accountID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountID`,`customerID`),
  KEY `FK_Accountcustomers_Account_idx` (`accountID`),
  KEY `FK_Accountcustomers_Customers_idx` (`customerID`),
  CONSTRAINT `FK_Accountcustomers_Accounts` FOREIGN KEY (`accountID`) REFERENCES `Accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Accountcustomers_Customers` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$stmt = $db->prepare($query);
$stmt->execute();
*/

?>