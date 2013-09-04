<?php

class ZXiangEPC
{
	public    $xiangEPC ;
	public    $productEPC;
	public    $productName ;
    public    $time ;
	public    $state ;
	
	public function __construct($_ZEPC="",$_PEPC="",$_time="",$_productName="") 
	{
		$this->xiangEPC = $_ZEPC;
		$this->productEPC = $_PEPC;
		$this->productName = $_productName;
		$this->time = $_time;
		
		
	}
	
}

?>