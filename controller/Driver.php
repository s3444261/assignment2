<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * Driver Class
 * The Driver Class is the controller of the application. It determines what is
 * being requested and displays the appropriate views with content that has been
 * manufactured by the model.
 *
 * Please Note: The constructor, getter and setter are not my code. I have been
 * using them for many years and don't know where I originally got them from. I
 * would love to be able to give the original author credit as they are a very
 * cool piece of kit!!
 *
 * I can't lay claim to the singleton pattern either.
 */
class Driver {
	
	// Attributes.
	private static $_instance;
	private $_basepath;
	private $_routes;
	
	// Constructor.
	function __construct($args = array()) {
		foreach ( $args as $key => $val ) {
			$name = '_' . $key;
			if (isset ( $this->{$name} )) {
				$this->{$name} = $val;
			}
		}
	}
	
	// Getter.
	public function &__get($name) {
		$name = '_' . $name;
		return $this->$name;
	}
	
	// Setter.
	public function __set($name, $value) {
		$name = '_' . $name;
		$this->$name = $value;
	}
	
	// Singleton Pattern.
	public static function getInstance() {
		if (! isset ( self::$_instance )) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	
	// Displays either the search form or the results.
	// Dependant on the request.
	public function display() {
		include 'view/header/header.php';
		include 'view/nav/nav.php';
		include 'view/header/containerstart.php';
		echo $this->getRoute ();
		include 'view/footer/containerend.php';
		include 'view/footer/footer.php';
	}
	
	// Convert URI to array
	public function getRoute() {
		// Retrieve the URI
		if (strlen ( $this->_basepath ) > 0) {
			$uri = str_replace ( $this->_basepath, "", $_SERVER ['REQUEST_URI'] );
		} else {
			$uri = ltrim ( $_SERVER ['REQUEST_URI'], '/' );
		}
		
		switch ($uri) {
			case 'Home' :
				$home = new Home ();
				$home->display ();
				break;
			case 'Account-Summary' :
				$summary = new Summary ();
				$summary->display ();
				break;
			case 'Transaction-History' :
				$history = new History ();
				$history->display ();
				break;
			case 'Account-Details' :
				$details = new Details ();
				$details->display ();
				break;
			case 'New-Bill-Payment' :
				$payment = new Payment ();
				$payment->display ();
				break;
			case 'Bill-Payment-Amount' :
				$paymentamt = new Paymentamt ();
				$paymentamt->display ();
				break;
			case 'Bill-Payment-Confirmation' :
				$paymentconf = new Paymentconf ();
				$paymentconf->display ();
				break;
			case 'Bill-Payment-Acknowledgement' :
				$paymentack = new Paymentack ();
				$paymentack->display ();
				break;
			case 'Payment-List' :
				$paymentlist = new Paymentlist ();
				$paymentlist->display ();
				break;
			case 'Payee-List' :
				$payeelist = new Payeelist ();
				$payeelist->display ();
				break;
			case 'Biller-Add' :
				$billeradd = new Billeradd ();
				$billeradd->display ();
				break;
			case 'Biller-Modify' :
				$billermodify = new Billermodify ();
				$billermodify->display ();
				break;
			case 'New-Funds-Transfer' :
				$transfer = new Transfer ();
				$transfer->display ();
				break;
			case 'Check-Transfer' :
				$checktransfer = new Checktransfer ();
				$checktransfer->display ();
				break;
			case 'Funds-Transfer-Acknowledgement' :
				$transferack = new Transferack ();
				$transferack->display ();
				break;
			default :
				$home = new Home ();
				$home->display ();
				break;
		}
	}
}
?>