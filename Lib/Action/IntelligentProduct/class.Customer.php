<?php

class Customer
{
	public $Cus_Code;
	public $Cus_Name;
	public $Cus_Sex;
	public $Cus_Birth;
	public $Family_Num;
	public $Cus_phone;
	public $Home_Adress;
	public $Cus_Level;
	public $falg;
	public $Remark;
	public function __construct($strCus_Code="",$strCus_Name="",$strCus_Sex="",$strCus_Birth="",$strFamily_Num="",
		$strCus_phone="",$strHome_Adress="",$strCus_Level="",$strfalg="",$strRemark="")
	{
		$this->Cus_Code=$strCus_Code;
		$this->Cus_Name = $strCus_Name;
		$this->Cus_Sex =$strCus_Sex ;
		$this->Cus_Birth = $strCus_Birth;
		$this->Family_Num = $strFamily_Num;
		$this->Cus_phone = $strCus_phone;
		$this->Home_Adress=$strHome_Adress;
		$this->Cus_Level=$strCus_Level;
		$this->falg=$strfalg;
		$this->Remark=$strRemark;
	}
}

?>