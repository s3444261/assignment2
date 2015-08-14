<?php

Class ValidationException extends Exception
{
	protected $message;
	
	function __construct($message) {
	
		$this->message = $message;
	
	}
	
	public function getError()
	{
		return $this->message;
	}
}
?>