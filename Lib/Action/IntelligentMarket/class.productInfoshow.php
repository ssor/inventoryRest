<?php

class productInfoshow
{
	public  $state ;
	public $productEPC;
	public $productName;
	public  $productprice ;
	public  $productLocation ;
	public  $productPic ;
	public  $Discount ;
		public  $productBj ;
	public  $productKind ;
	
	public function __construct($_productEPC = "",$_productName ="",$_productprice = "",
		$_productLocation = "",$_productPic = "",$_Discount = "",$_productBj = "",$_productKind = "") 
	{
		$this->productEPC=$_productEPC;
		$this->productName=$_productName;
		$this->productprice = $_productprice;
		$this->productLocation = $_productLocation;
		$this->productPic = $_productPic;
		$this->Discount = $_Discount;
		$this->productBj = $_productBj;
		$this->productKind = $_productKind;
	}
}

?>