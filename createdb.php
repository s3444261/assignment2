<?php
include_once 'connect/config.php';
include_once 'connect/Database.php';

$db = Database::getInstance();

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

$user = new Users();
$user->user = 123456;
$user->email = 's3444261@student.rmit.edu.au';
$user->password = 'TestTest88';
$user->set();
/*
$query = "CREATE TABLE `Contacts` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) DEFAULT NULL,
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
  `status` varchar(45) NOT NULL,
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
  `status` varchar(45) NOT NULL,
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