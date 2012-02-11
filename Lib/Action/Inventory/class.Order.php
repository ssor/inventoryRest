<?php

class Order
{
	public $productName;
	public $quantity;
	public $state;
	public function __construct($strProductName="",$iQuantity=0)
	{
		$this->productName=$strProductName;
		$this->quantity=$iQuantity;
	}
}

?>