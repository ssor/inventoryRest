<?php

class TBlist
{	 
	public    $PID;
	public    $EPC;
	public    $state;
	public function __construct($_PID="",$_EPC="") 
	{
		$this->PID= $_PID;
		$this->EPC= $_EPC;
		
	}
	
}

?>