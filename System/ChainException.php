<?php

namespace System;

class ChainException extends \Exception{
	public function __construct($msg, int $code = 0){
		parent::__construct($msg, $code);
	}

	public function __toString() {
		return __CLASS__.": [{$this->code}]: {$this->msg}\n";
	}

	public function getErrorMessage(){
		$errorMsg = '<div style="background:#E11B1B;height:40px;width:50%;vertical-align:middle">Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage().'</b></div>';
		return $errorMsg;
	}

	public function getJsonErrorMessage() {
	}
}