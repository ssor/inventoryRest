<?php

class FProject
{	 
	public    $PID ;
	public    $Pname;
	public    $Pnum ;
	public    $PPlace ;
	public    $PP ;
	public    $Ptime ;
	public    $Pstate ;
	
	public    $state ;
	public function __construct($_PID="",$_Pname="",$_Pnum="",$_PPlace="",$_PP="",$_time="",$_Pstate="") 
	{
		$this->PID = $_PID;
		$this->Pname = $_Pname;
		$this->Pnum = $_Pnum;
		$this->PPlace = $_PPlace;
		$this->PP = $_PP;
		$this->Ptime = $_time;
		$this->Pstate = $_Pstate;
	}
	
}

?>