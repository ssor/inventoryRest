<?php

class wareHouse
{
	public    $wareHoseID ;
	public    $shelvesID;
	public    $zigBeeID ;
	public    $uptemp ;
	public    $dowmtemp ;
	public    $uphumi ;
	public    $downhumi ;
	
	public    $state ;
	public function __construct($_wareHoseID="",$_shelvesID="",$_zigBeeID="",$_uptemp="",$_dowmtemp="",$_uphumi="",$_downhumi="") 
	{
		$this->wareHoseID = $_wareHoseID;
		$this->shelvesID = $_shelvesID;
		$this->zigBeeID = $_zigBeeID;
		$this->uptemp = $_uptemp;
		$this->dowmtemp = $_dowmtemp;
		$this->uphumi = $_uphumi;
		$this->downhumi = $_downhumi;
	}
	
}

?>