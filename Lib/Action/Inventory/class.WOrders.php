<?php

class WOrders
{
	
	public $orderID ;
	public $Theorders ;
	public $prductName ; 
	public $Number ; 
	public $productCategory ;
	public $time ;
	public $orderState ; 
	public $address ; 
	public $beiZhu ;
	public $state ;
	
	public function __construct($_orderID = "",$_Theorders="",$_prductName="",$_Number="",$_productCategory = "",$_time="",$_orderState="",$_address="",$_beiZhu="",$_state="") 
	{
		$this->orderID=$_orderID;
		$this->Theorders=$_Theorders;
		$this->prductName=$_prductName;
		$this->Number=$_Number;
		$this->productCategory=$_productCategory;
		$this->time=$_time;
		$this->orderState=$_orderState;
		$this->address=$_address;
		$this->beiZhu=$_beiZhu;
		$this->state=$_state;
	}
}

?>
