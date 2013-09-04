<?php

class Order
{   
    public $orderID;
    public $Theorders; 
    public $prductName ;
    public $Number;
    public $productCategory;
    public $OTime;
    public $orderState;
    public $address;
    public $beiZhu;
    public $state;
	
	public function __construct($orderID="",$Theorders="",$prductName="",$Number=0,$productCategory="",$OTime="",$orderState="",$address="",$beiZhu=0)
	{
		$this->orderID=$orderID;
		$this->Theorders=$Theorders;
		$this->prductName=$prductName;
		$this->Number=$Number;
		$this->productCategory=$productCategory;
		$this->OTime=$OTime;
		$this->orderState=$orderState;
		$this->address=$address;
		$this->beiZhu=$beiZhu;
	
	}
}

?>