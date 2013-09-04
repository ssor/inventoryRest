<?php

class FProductcategory
{
	
	public $FPname;
	public $FPid;
	public  $FPfactory ;
	public $FPcatrgory;

	public $state;
	
	
	public function __construct($_FPname = "",$_FPid ="",$_FPfactory = "",$_FPcatrgory ="",$_state="") 
	{
		$this->FPname=$_FPname;
		$this->FPid=$_FPid;
		$this->FPfactory=$_FPfactory;
		$this->FPcatrgory=$_FPcatrgory;
	
		$this->state=$_state;
	}
}

?>