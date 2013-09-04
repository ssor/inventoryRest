<?php

class Product
{
    public $ckID;
	public $productID;
	public $productName;
	public $produceDate;
	public $productCategory;
	public $descript;
	public $state;
	public function __construct($_ckID="",$pID="",$pName="",$pDate="",$pCategory="",$pDescript="",$pState="")
	{
	    $this->ckID = $_ckID;
		$this->productID = $pID;
		$this->productName =$pName ;
		$this->produceDate = $pDate;
		$this->productCategory = $pCategory;
		$this->descript = $pDescript;
		$this->state=$pState;
	}
}

?>