<?php

class JYhistory
{
	public  $state ;
	public $productEPC;
	public $productName;
	public  $productPrice ;
	public $discount;
	public  $userEPC ;
	
	public function __construct($_productEPC = "",$_productName ="",$_productprice = "",
		$_userEPC = "",$_discount="") 
	{
		$this->productEPC=$_productEPC;
		$this->productName=$_productName;
		$this->productPrice = $_productprice;
		$this->userEPC = $_userEPC;
		$this->discount = $_discount;
	}
}

?>