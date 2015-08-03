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
		
		// If the user is not logged in, go back to Home.
		if ($uri != 'Login') {
			if (! isset ( $_SESSION ['loggedin'] )) {
				$uri = 'Home';
			}
		}
		
		if (strpos($uri,'/') !== false) {
			$uri = explode('/', $uri);
			$id = $uri[1];
			$uri = $uri[0] . '-';
		}
		
		switch ($uri) {
			case 'Home' :
				$home = new HomeController ();
				$home->display ();
				break;
			case 'Account-Summary' :
				$summary = new SummaryController ();
				$summary->display ();
				break;
			case 'Transaction-History-' :
				$_SESSION ['selectedAccount' . $id] = 'selected="selected"';
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Transaction-History");
				break;
			case 'Transaction-History' :
				$history = new HistoryController ();
				$history->display ();
				break;
			case 'Account-Details-' :
				$_SESSION ['detSelectedAccount' . $id] = 'selected="selected"';
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Account-Details");
				break;
			case 'Account-Details' :
				$details = new DetailsController ();
				$details->display ();
				break;
			case 'New-Bill-Payment-' :
				$payment = new Paymentamt();
				$payment->setAccountSelected($id);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "New-Bill-Payment");
				break;
			case 'New-Bill-Payment' :
				$payment = new PaymentController ();
				$payment->display ();
				break;
			case 'Bill-Payment-Amount' :
				$paymentamt = new PaymentamtController ();
				$paymentamt->display ();
				break;
			case 'Bill-Payment-Confirmation' :
				$paymentconf = new PaymentconfController ();
				$paymentconf->display ();
				break;
			case 'Bill-Payment-Acknowledgement' :
				$paymentack = new PaymentackController ();
				$paymentack->display ();
				break;
			case 'Payment-List' :
				$paymentlist = new PaymentlistController ();
				$paymentlist->display ();
				break;
			case 'Bill-Payment-List' :
				$_SESSION['billPayment'] = true;
				unset($_SESSION['fundsTransferPayment']);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payment-List");
				break;
			case 'Funds-Transfer-Payment-List' :
				$_SESSION['fundsTransferPayment'] = true;
				unset($_SESSION['billPayment']);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payment-List");
				break;
			case 'Payee-List' :
				$payeelist = new PayeelistController ();
				$payeelist->display ();
				break;
			case 'Bill-Payee-List' :
				$_SESSION['billPayee'] = true;
				unset($_SESSION['fundsTransferPayee']);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payee-List");
				break;
			case 'Funds-Transfer-Payee-List' :
				$_SESSION['fundsTransferPayee'] = true;
				unset($_SESSION['billPayee']);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payee-List");
				break;
			case 'Biller-Add' :
				$billeradd = new BilleraddController ();
				$billeradd->display ();
				break;
			case 'Biller-Modify-' :
				$_SESSION['billerModifyID'] = $id;
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Biller-Modify");
				break;
			case 'Biller-Modify' :
				$billermodify = new BillermodifyController ();
				$billermodify->display ();
				break;
			case 'Biller-Delete-' :
				$_SESSION['billerDeleteID'] = $id;
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Biller-Delete");
				break;
			case 'Biller-Delete' :
				$billerdelete = new BillerdeleteController ();
				$billerdelete->display ();
				break;
			case 'New-Funds-Transfer-' :
				$transfer = new CheckTransfer();
				$transfer->setAccountSelected($id);
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "New-Funds-Transfer");
				break;
			case 'New-Funds-Transfer' :
				$transfer = new TransferController ();
				$transfer->display ();
				break;
			case 'Check-Transfer' :
				$checktransfer = new ChecktransferController ();
				$checktransfer->display ();
				break;
			case 'Funds-Transfer-Acknowledgement' :
				$transferack = new TransferackController ();
				$transferack->display ();
				break;
			case 'Payee-Add' :
				$payeeadd = new PayeeaddController ();
				$payeeadd->display ();
				break;
			case 'Payee-Modify-' :
				$_SESSION['payeeModifyID'] = $id;
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payee-Modify");
				break;
			case 'Payee-Modify' :
				$payeemodify = new PayeemodifyController ();
				$payeemodify->display ();
				break;
			case 'Payee-Delete-' :
				$_SESSION['payeeDeleteID'] = $id;
				$pos = strrpos($_SERVER ['HTTP_REFERER'], '/');
				$pos = strlen($_SERVER ['HTTP_REFERER']) - $pos;
				header("Location: " . substr($_SERVER ['HTTP_REFERER'], 0, -$pos + 1) . "Payee-Delete");
				break;
			case 'Payee-Delete' :
				$payeedelete = new PayeedeleteController ();
				$payeedelete->display ();
				break;
			case 'Login' :
				$login = new LoginController ();
				$login->login ();
				break;
			case 'Logout' :
				$logout = new LoginController ();
				$logout->logout ();
				break;
			default :
				$home = new HomeController ();
				$home->display ();
				break;
		}
	}
	
	public function summary(){
		$summary = new SummaryController();
		return $summary->summary();
	}
	
	public function summaryCredit(){
		$summary = new SummaryController();
		return $summary->getCreditBalance();
	}
	
	public function summaryDebit(){
		$summary = new SummaryController();
		return $summary->getDebitBalance();
	}
	
	public function summaryNet(){
		$summary = new SummaryController();
		return $summary->getNetBalance();
	}
}
?>