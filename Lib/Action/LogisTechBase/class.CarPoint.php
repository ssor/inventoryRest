<?php

class CarPoint {
	
	
	public $strCarID;
	public $strTime;
	public $strLatitude;
	public $strLongitude;
	public $state;
	
	/**
	 * Constructor, sets the initial values
	 * @access public
	 * @return POP3
	 */
	public function __construct($strCarID="",$strTime="",$strLatitude="",$strLongitude="") {
		$this->strCarID=$strCarID;
		$this->strTime=$strTime;
		$this->strLatitude=$strLatitude;
		$this->strLongitude=$strLongitude;	
	}
	
	private function catchWarning ($errno, $errstr, $errfile, $errline) {
		
	}
	
	//  End of class
}
?>