<?php

class SMproduct
{
	public  $productName ;
	public  $productprice ;
	public  $productBj ;
	public  $productLocation ;
	public  $productPic ;
	public  $productKind ;
	public  $state ;
	
	public function __construct($_productName="",$_productprice="",$_productBj="",$_productLocation="",$_productPic="",$_productKind="") 
	{
		$this->productName=$_productName;
		$this->productprice=$_productprice;
		$this->productBj=$_productBj;
		$this->productLocation=$_productLocation;
		$this->productPic=$_productPic;
		$this->productKind=$_productKind;
	}
	
}

?>