<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
class Validation {
	
	// Validates a username.
	public function userName($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->notNumber ( $content );
			$this->atLeastSix ( $content );
			$this->moreThanEight ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'FAB ID Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a password.
	public function password($content) {
		$errorMessage = null;
		
		try {
			$this->oneUpperOneLowerOneDigitGreaterEight ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Password Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates search details.
	public function searchDetails($content) {
		$errorMessage = null;
		
		try {
			$this->alphaNumeric ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Search Details Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates an amount.
	public function amount($content) {
		$errorMessage = null;
		
		try {
			$this->notNumber ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Amount Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a date.
	public function confirmDate($content) {
		$errorMessage = null;
		
		try {
			$this->isDate ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Date Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a payment amount.
	public function payAmount($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->notNumber ( $content );
			$this->sufficientFunds ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Amount Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a payment date.
	public function payDate($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->isDate ( $content );
			$this->notPastDate ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Date Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a customer reference.
	public function custref($content) {
		$errorMessage = null;
		
		try {
			$this->notNumber ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Customer Reference Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a biller code.
	public function billerCode($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->notNumber ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Biller Code Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a biller name.
	public function billerName($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alpha ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Biller Name Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a biller nickname.
	public function billerNickname($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alpha ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Biller Nickname Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a biller customer reference.
	public function billerCustomerRef($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->notNumber ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Customer Reference Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates an account name.
	public function accountName($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alphaNumeric ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Account Name Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates an account nickname.
	public function accountNickname($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alphaNumeric ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Account Nickname Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates an account BSB.
	public function accountBSB($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->numberHyphen ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Account BSB Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates an account number.
	public function accountNumber($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->numberHyphen ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Account Number Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a transfer amount.
	public function transferAmount($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->notNumber ( $content );
			$this->sufficientTransferFunds ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Amount Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a transfer Description.
	public function transferDescription($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alphaNumeric ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Description Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a transfer remitter.
	public function transferRemitter($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->alphaNumeric ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Remitter Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	// Validates a transfer date.
	public function transferDate($content) {
		$errorMessage = null;
		
		try {
			$this->emptyField ( $content );
			$this->isDate ( $content );
			$this->notPastDate ( $content );
		} catch ( ValidationException $e ) {
			if ($errorMessage == null) {
				$errorMessage = 'Date Error: ' . $e->getError ();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError ();
			}
		}
		
		if ($errorMessage != null) {
			throw new ValidationException ( $errorMessage );
		}
	}
	
	/*
	 * The following functions provide the building blocks for the
	 * above taylored validation functions.
	 */
	
	// Tests for an empty field.
	public function emptyField($content) {
		if (strlen ( $content ) == 0) {
			throw new ValidationException ( 'Input is required!' );
		}
	}
	
	// Tests for at least six characters.
	public function atLeastSix($content) {
		if (strlen ( $content ) < 6) {
			throw new ValidationException ( 'Input is too short!' );
		}
	}
	
	// Tests for more than eight characters.
	public function moreThanEight($content) {
		if (strlen ( $content ) > 8) {
			throw new ValidationException ( 'Input is too long!' );
		}
	}
	
	// Tests for a number.
	public function notNumber($content) {
		if (! is_numeric ( $content ) && strlen ( $content ) > 0) {
			throw new ValidationException ( 'Input must be a number!' );
		}
	}
	
	// Tests for at least one upper case character.
	// At least one lower case character.
	// At least one digit.
	// At least eight characters long.
	public function oneUpperOneLowerOneDigitGreaterEight($content) {
		if (! preg_match ( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}+$/', $content )) {
			throw new ValidationException ( 'Atleast one uppercase letter, one lowercase letter, one digit and a minimum of eight characters!' );
		}
	}
	
	// Tests that input is alphanumeric.
	public function alphaNumeric($content) {
		$content = preg_replace ( '/\s+/', '', $content );
		
		if (! ctype_alnum ( $content ) && strlen ( $content ) > 0) {
			throw new ValidationException ( 'Input must be a alphanumeric!' );
		}
	}
	
	// Tests that input contains letters only.
	public function alpha($content) {
		$content = preg_replace ( '/\s+/', '', $content );
		
		if (! ctype_alpha ( $content ) && strlen ( $content ) > 0) {
			throw new ValidationException ( 'Input must consist of letters only!' );
		}
	}
	
	// Tests that the input only contains numbers or hyphens.
	public function numberHyphen($content) {
		if (! preg_match ( '/^[0-9-]+$/', $content )) {
			throw new ValidationException ( 'Must only consist of numbers and/or hyphens!' );
		}
	}
	
	// Tests that input is a date.
	public function isDate($content) {
		if (! $this->validateDate ( $content, 'Y-m-d' ) && strlen ( $content ) > 0) {
			throw new ValidationException ( 'Input must be valid date!' );
		}
	}
	
	// Tests that the date is either today or a future date.
	public function notPastDate($content) {
		$date = date_create ( $content );
		$paymentDate = date_format ( $date, 'zY' );
		$paymentDate = intval ( $paymentDate );
		$currentDate = date_create ( date ( 'm/d/Y h:i:s a', time () ) );
		$currentDate = date_format ( $currentDate, 'zY' );
		$currentDate = intval ( $currentDate );
		
		if ($paymentDate < $currentDate) {
			throw new ValidationException ( 'Date must be todays date or a future date!' );
		}
	}
	
	// From PHP Manual
	public function validateDate($date, $format) {
		$d = DateTime::createFromFormat ( $format, $date );
		return $d && $d->format ( $format ) == $date;
	}
	
	// Tests that there are sufficient funds in the account for a payment.
	public function sufficientFunds($content) {
		$account = new Account ();
		if (isset ( $_SESSION ['payAccountID'] )) {
			$account->accountID = $_SESSION ['payAccountID'];
		}
		
		if (! $account->sufficientFunds ( $content )) {
			throw new ValidationException ( 'There are insufficient funds in the account!' );
		}
	}
	
	// Tests that there are sufficient funds in the account for a transfer.
	public function sufficientTransferFunds($content) {
		$account = new Account ();
		if (isset ( $_SESSION ['transferAccountID'] )) {
			$account->accountID = $_SESSION ['transferAccountID'];
		}
		
		if (! $account->sufficientFunds ( $content )) {
			throw new ValidationException ( 'There are insufficient funds in the account!' );
		}
	}
}
?>