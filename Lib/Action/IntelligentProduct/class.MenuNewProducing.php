<?php

class MenuNewProducing
{
	public $Pro_code;
	public $Pro_Name;
	public $Pro_Leibie;
	public $Pro_Gui;
	public $Pro_state;
	public $Pro_Pici;
	public $Pro_Chej;
	public $Pro_Person;
	public $Contact;
	public $Remark;
	public $Pro_Tempre;
	public $Pro_Wet;
	public $finishTime;
	public $RukuTime;
	public $ChuKuTime;
	public $falg;
	public function __construct($strPro_code="",$strPro_Name="",$strPro_Leibie="",$strPro_Gui="",$strPro_state="",$strPro_Pici="",$strPro_Chej="",$strPro_Person="",$strContact="",$strRemark="",$strPro_tempre="",$strPro_Wet="",$strfinishTime="",$strRukuTime="",$strChuKuTime="",$strfalg="")
	{
		$this->Pro_code=$strPro_code;
		$this->Pro_Name=$strPro_Name;
		$this->Pro_Leibie=$strPro_Leibie;
		$this->Pro_Gui=$strPro_Gui;
		$this->Pro_state=$strPro_state;
		$this->Pro_Pici=$strPro_Pici;
		$this->Pro_Chej=$strPro_Chej;
		$this->Pro_Person=$strPro_Person;
		$this->Contact=$strContact;
		$this->Remark=$strRemark;
		$this->Pro_Tempre=$strPro_tempre;
		$this->Pro_Wet=$strPro_Wet;
		$this->finishTime=$strfinishTime;
		$this->RukuTime=$strRukuTime;
		$this->ChuKuTime=$strChuKuTime;
		$this->falg=$strfalg;
	}
}

?>