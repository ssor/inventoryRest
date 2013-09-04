<?php

class userShoppingCarInfo
{
	public  $state ;
	public $productEPC;
	public $productName;
	public  $productPrice ;
	public $discount;
	public  $userEPC ;
	public  $productMoney ;
	
	public function __construct($_productEPC = "",$_productName ="",$_productprice = "",
		$_productMoney = "",$_discount="",$_userEPC = "") 
	{
		$this->productEPC=$_productEPC;
		$this->productName=$_productName;
		$this->productPrice = $_productprice;
		$this->productMoney = $_productMoney;
		$this->discount = $_discount;
		$this->userEPC = $_userEPC;
	}
}

?>