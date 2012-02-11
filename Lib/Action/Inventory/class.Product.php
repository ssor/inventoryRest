<?php

class Product
{
	public $productID;
	public $productName;
	public $produceDate;
	public $productCategory;
	public $descript;
	public $state;
	public function __construct($pID="",$pName="",$pDate="",$pCategory="",$pDescript="",$pState="")
	{
		$this->productID = $pID;
		$this->productName =$pName ;
		$this->produceDate = $pDate;
		$this->productCategory = $pCategory;
		$this->descript = $pDescript;
		$this->state=$pState;
	}
}

?>