<?php

class FProductcategory
{
	
	public $FPname;
	public $FPid;
	public $FPfactory ;
	public $FPcatrgory;
    public $safeinventory;
	public $BZ;
	public $state;
	
	
	public function __construct($_FPname = "",$_FPid ="",$_FPfactory = "",$_FPcatrgory ="",$_safeinventory,$_BZ) 
	{
		$this->FPname=$_FPname;
		$this->FPid=$_FPid;
		$this->FPfactory=$_FPfactory;
		$this->FPcatrgory=$_FPcatrgory;
	    $this->safeinventory=$_safeinventory;
	    $this->BZ=$_BZ;
		
	}
}

?>