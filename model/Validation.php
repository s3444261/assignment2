<?php

Class Validation {
	
	public function userName($content)
	{
		$errorMessage = null;
		
		try{
			$this->emptyField($content);
			$this->notNumber($content);
			$this->atLeastSix($content);
			$this->moreThanEight($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'FAB ID Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		} 
		
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
		
	}
	
	public function password($content)
	{
		$errorMessage = null;
	
		try{
			$this->oneUpperOneLowerOneDigitGreaterEight($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Password Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function searchDetails($content)
	{
		$errorMessage = null;
	
		try{
			$this->alphaNumeric($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Search Details Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function amount($content)
	{
		$errorMessage = null;
	
		try{
			$this->notNumber($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Amount Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function confirmDate($content)
	{
		$errorMessage = null;
	
		try{
			$this->isDate($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Date Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function payAmount($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->notNumber($content);
			$this->sufficientFunds($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Amount Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function payDate($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->isDate($content);
			$this->notPastDate($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Date Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function custref($content)
	{
		$errorMessage = null;
	
		try{
			$this->notNumber($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Customer Reference Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function billerCode($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->notNumber($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Biller Code Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function billerName($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alpha($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Biller Name Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function billerNickname($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alpha($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Biller Nickname Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function billerCustomerRef($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->notNumber($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Customer Reference Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function accountName($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alphaNumeric($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Account Name Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function accountNickname($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alphaNumeric($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Account Nickname Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function accountBSB($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->numberHyphen($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Account BSB Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function accountNumber($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->numberHyphen($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Account Number Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function transferAmount($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->notNumber($content);
			$this->sufficientTransferFunds($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Amount Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function transferDescription($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alphaNumeric($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Description Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function transferRemitter($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->alphaNumeric($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Remitter Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function transferDate($content)
	{
		$errorMessage = null;
	
		try{
			$this->emptyField($content);
			$this->isDate($content);
			$this->notPastDate($content);
		} catch (ValidationException $e){
			if($errorMessage == null){
				$errorMessage = 'Date Error: ' . $e->getError();
			} else {
				$errorMessage = $errorMessage . '<br />' . $e->getError();
			}
		}
	
		if($errorMessage != null){
			throw new ValidationException($errorMessage);
		}
	
	}
	
	public function emptyField($content)
	{
		if(strlen($content) == 0){
			throw new ValidationException('Input is required!');
		}
	}
	
	public function atLeastSix($content)
	{
		if(strlen($content) < 6){
			throw new ValidationException('Input is too short!');
		}
	}
	
	public function moreThanEight($content)
	{
		if(strlen($content) > 8){
			throw new ValidationException('Input is too long!');
		}
	}
	
	public function notNumber($content)
	{
		if(!is_numeric($content)  && strlen($content) > 0){
			throw new ValidationException('Input must be a number!');
		}
	}
	
	public function oneUpperOneLowerOneDigitGreaterEight($content)
	{
		if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}+$/', $content)) {
			throw new ValidationException('Atleast one uppercase letter, one lowercase letter, one digit and a minimum of eight characters!');
		}
	}
	
	public function alphaNumeric($content)
	{
		$content = preg_replace('/\s+/', '', $content);
		
		if(!ctype_alnum($content) && strlen($content) > 0){
			throw new ValidationException('Input must be a alphanumeric!');
		}
	}
	
	public function alpha($content)
	{
		$content = preg_replace('/\s+/', '', $content);
		
		if(!ctype_alpha($content) && strlen($content) > 0){
			throw new ValidationException('Input must consist of letters only!');
		}
	}
	
	public function numberHyphen($content)
	{
		if(!preg_match('/^[0-9-]+$/', $content)) {
			throw new ValidationException('Must only consist of numbers and/or hyphens!');
		}
	}
	
	public function isDate($content)
	{
		if(!$this->validateDate($content, 'Y-m-d') && strlen($content) > 0){
			throw new ValidationException('Input must be valid date!');
		}
	}
	
	public function notPastDate($content)
	{
		$date = date_create ( $content );
		$paymentDate = date_format ( $date, 'zY' );
		$paymentDate = intval ( $paymentDate );
		$currentDate = date_create ( date ( 'm/d/Y h:i:s a', time () ) );
		$currentDate = date_format ( $currentDate, 'zY' );
		$currentDate = intval ( $currentDate );
			
		if ($paymentDate < $currentDate) {
			throw new ValidationException('Date must be todays date or a future date!');
		}
	}
	
	// From PHP Manual
	public function validateDate($date, $format)
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	public function sufficientFunds($content)
	{
		$account = new Account();
		if(isset($_SESSION ['payAccountID'])){
			$account->accountID = $_SESSION ['payAccountID'];
		}
		
		if(!$account->sufficientFunds($content)){
			throw new ValidationException('There are insufficient funds in the account!');
		}
	}
	
	public function sufficientTransferFunds($content)
	{
		$account = new Account();
		if(isset($_SESSION ['transferAccountID'])){
			$account->accountID = $_SESSION ['transferAccountID'];
		}
	
		if(!$account->sufficientFunds($content)){
			throw new ValidationException('There are insufficient funds in the account!');
		}
	}
}
?>