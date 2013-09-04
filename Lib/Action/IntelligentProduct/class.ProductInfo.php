<?php

class ProductInfo
{
	public $Pro_Code;
	public $Pro_Name;
	public $Pro_Leibie;
	public $Pro_Gui;
	public $Pro_Xinghao;
	public $Pro_Gongyi;
	public $Pro_Use;
	public $Time;
	public $Remark;
	public function __construct($strPro_Code="",$strPro_Name="",$strPro_Leibie="",$strPro_Gui="",$strPro_Xinghao="",$strPro_Gongyi=""
		,$strPro_Use="",$strTime="",$strRemark="")
	{
		$this->Pro_Code = $strPro_Code;
		$this->Pro_Name =$strPro_Name;
		$this->Pro_Leibie = $strPro_Leibie;
		$this->Pro_Gui = $strPro_Gui;
		$this->Pro_Xinghao = $strPro_Xinghao;
		$this->Pro_Gongyi=$strPro_Gongyi;
		$this->Pro_Use=$strPro_Use;
		$this->Time=$strTime;
		$this->Remark=$strRemark;
	}
}

?>