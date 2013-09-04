<?php

class Promotion
{
	public  $PromotionType ;
	public  $Discount ;
	public  $productName ;
	public  $Bj ;
	public  $state ;
	
	public function __construct($_productName = "",$_PromotionType="",$_Discount="",$_Bj="") 
	{
		$this->productName=$_productName;
		$this->PromotionType=$_PromotionType;
		$this->Discount=$_Discount;
		$this->Bj=$_Bj;
	}
}

?>