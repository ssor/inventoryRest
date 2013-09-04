<?php

class FProduct
{
	
	public $EPC;
	public $Pname;
	public  $productPici ;
	public $temputer;
	public $mature;
	public  $startTime ;
	public $endTime;
	public $beiZhu;
	public $productState;
	public $state;
	
	
	public function __construct($_EPC = "",$_Pname ="",$_productPici = "",$_temputer ="",
	$_mature = "",$_startTime ="",$_endTime = "",$_beiZhu ="",$_productState ="",$_state ="") 
	{
		$this->EPC=$_EPC;
		$this->Pname=$_Pname;
		$this->productPici=$_productPici;
		$this->temputer=$_temputer;
		$this->mature=$_mature;
		$this->startTime=$_startTime;
		$this->endTime=$_endTime;
		$this->beiZhu=$_beiZhu;
		$this->productState=$_productState;
		$this->state=$_state;
	}
}

?>