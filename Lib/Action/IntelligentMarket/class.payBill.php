<?php

class PayBill
{
	public  $state ;
	public $productEPC;
	public $userEPC;
	public $time;
	public $productName;
	
	public function __construct($_productEPC = "",$_userEPC ="",$_time ="",$_productName ="") 
	{
		$this->productEPC=$_productEPC;
		$this->userEPC=$_userEPC;
		$this->time=$_time;
		$this->productName=$_productName;
	}
}

?>