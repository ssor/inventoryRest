<?php

class Chukudan
{
	public $Chukudan_code;
	public $Order_Code;
	public $Pro_Name;
	public $Pro_Gui;
	public $Pro_Q;
	public $Person;
	public $PerContact;
	public $adress;
	public $time;
	public $Remark;
	public $falg;
	public function __construct($strChukudan_code="",$strOrder_Code="",$strPro_Name="",$strPro_Gui="",$strPro_Q="",
		$strPerson="",$strPerContact="",$stradress="",$strtime="",$strRemark="",$strfalg="")
	{
		$this->Chukudan_code=$strChukudan_code;
		$this->Order_Code = $strOrder_Code;
		$this->Pro_Name =$strPro_Name ;
		$this->Pro_Gui = $strPro_Gui;
		$this->Pro_Q = $strPro_Q;
		$this->Person = $strPerson;
		$this->PerContact=$strPerContact;
		$this->adress=$stradress;
		$this->time=$strtime;
		$this->Remark=$strRemark;
		$this->falg=$strfalg;

		
	}
}

?>