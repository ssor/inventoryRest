<?php

class Product
{
	public  $state ;
	public $productEPC;
	public $productName;
	
	public function __construct($_productEPC = "",$_productName ="") 
	{
		$this->productEPC=$_productEPC;
		$this->productName=$_productName;
	}
}

?>