<?php

class ShoppingCar
{
	
	public  $state ;
	public $productEPC ;
	public $userEPC ; 
	public $time ; 
	public $money ;
	
	public function __construct($_productEPC = "",$_userEPC="",$_time="",$_money="") 
	{
		$this->productEPC=$_productEPC;
		$this->userEPC=$_userEPC;
		$this->money=$_money;
		$this->time=$_time;
	}
}

?>