<?php

class Plan
{
	public $PlanCode;
	public $Pro_Pici;
	public $Pro_Name;
	public $Pro_Leibie;
	public $Pro_Gui;
	public $Pro_Q;
	public $Pro_Chej;
	public $Pro_Person;
	public $Contact;
	public $state;
	public $Time;
	public $Remark;
	public function __construct($strPlanCode="",$strPro_Pici="",$strPro_Name="",$strPro_Leibie="",
		$strPro_Gui="",$strPro_Q="",$strPro_Chej="",$strPro_Person="",$strContact="",$str_state="",
		$strTime="",$strRemark="")
	{
		$this->PlanCode = $strPlanCode;
		$this->Pro_Pici =$strPro_Pici ;
		$this->Pro_Name = $strPro_Name;
		$this->Pro_Leibie = $strPro_Leibie;
		$this->Pro_Gui = $strPro_Gui;
		$this->Pro_Q=$strPro_Q;
		$this->Pro_Chej=$strPro_Chej;
		$this->Pro_Person=$strPro_Person;
		$this->Contact=$strContact;
		$this->state=$str_state;
		$this->Time=$strTime;
		$this->Remark=$strRemark;
	}
}

?>