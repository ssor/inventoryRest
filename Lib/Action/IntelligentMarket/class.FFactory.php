<?php

class FFactory
{
	
	public  $FFname ;
	public $FFid ;
	public $FLrepresentative ; 
	public $FFcatrgory ; 
	public $FFphone ;
	public $FFaddress ;

	public $state ;
	
	public function __construct($_orderID = "",$_Theorders="",$_prductName="",$_Number="",$_productCategory = "",$_time="",$_state="") 
	{
		$this->FFname=$_orderID;
		$this->FFid=$_Theorders;
		$this->FLrepresentative=$_prductName;
		$this->FFcatrgory=$_Number;
		$this->FFphone=$_productCategory;
		$this->FFaddress=$_time;
		
		$this->state=$_state;
	}
}

?>
