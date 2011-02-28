<?php

class Error extends Exception {
	protected $details;
	
	public function __construct($message, $details = NULL) {
		$this->message = $message;
		$this->details = $details;
	}
	
	public function getDetails() {
		return $this->details;
	}
}