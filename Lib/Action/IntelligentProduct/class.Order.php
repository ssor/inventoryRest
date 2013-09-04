<?php

class Order
{
	public $OrderId;
	public $Pro_Name;
	public $Pro_Q;
	public $Pro_Gui;
	public $Buyer;
	public $Contact;
	public $DeliverAdr;
	public $DeadLine;
	public $ProviderName;
	public $state;
	public $Time;
	public $Remark;
	public function __construct($strorderId="",$strProname="",$strPro_Q="",$strPro_gui="",$strbuyer="",$strcontact=""
		,$strdeliver="",$strdeadline="",$strProvider="",$str_state="",$strTime="",$strRemark="")
	{
		$this->OrderId = $strorderId;
		$this->Pro_Name =$strProname ;
		$this->Pro_Q = $strPro_Q;
		$this->Pro_Gui = $strPro_gui;
		$this->Buyer = $strbuyer;
		$this->Contact=$strcontact;
		$this->DeliverAdr=$strdeliver;
		$this->DeadLine=$strdeadline;
		$this->ProviderName=$strProvider;
		$this->state=$str_state;
		$this->Time=$strTime;
		$this->Remark=$strRemark;
	}
}

?>