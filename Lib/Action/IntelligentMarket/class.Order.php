<?php

class Order
{
	public    $OrderId ;
	public    $ProviderName;
	public    $Pro_Name ;
	public    $DeliverAdr ;
	public    $Buyer ;
	public    $Pro_Q ;
	public    $Time ;
	public    $Contact ;
	public    $Pro_Gui ;
	public    $DeadLine ;
	public    $state ;
	public    $Remark ;
	
	
	public function __construct($_OrderId="",$_ProviderName="",$_Pro_Name="",$_DeliverAdr="",$_Buyer="",$_Pro_Q="",
		$_Time="",$_Contact="",$_Pro_Gui="",$_DeadLine="",$_state="",$_Remark="") 
	{
		$this->OrderId = $_OrderId;
		$this->ProviderName = $_ProviderName;
		$this->Pro_Name = $_Pro_Name;
		$this->DeliverAdr = $_DeliverAdr;
		$this->Buyer = $_Buyer;
		$this->Pro_Q = $_Pro_Q;
		$this->Time = $_Time;
		$this->Contact = $_Contact;
		$this->Pro_Gui = $_Pro_Gui;
		$this->DeadLine = $_DeadLine;
		$this->state = $_state;
		$this->Remark = $_Remark;
		
		
	}
	
}

?>