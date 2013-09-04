<?php

class CarSpace
{
	public    $userName ;
	public    $userEPC;
	public    $userCid ;
	public    $Intime ;
	public    $Outtime ;
	public    $state ;
	
	public function __construct($_userName="",$_userEPC="",$_userCid="",$_Intime="",$_Outtime="") 
	{
		$this->userName = $_userName;
		$this->userEPC = $_userEPC;
		$this->userCid = $_userCid;
		$this->Intime = $_Intime;
		$this->Outtime = $_Outtime;
	}
	
}

?>