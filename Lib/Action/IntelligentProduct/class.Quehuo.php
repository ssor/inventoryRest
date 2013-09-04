<?php

class Quehuo
{
	public $Pro_Name;
	public $Pro_Que_Q;
	public $time;
	
	public function __construct($strPro_Name="",$strPro_Que_Q="",$strtime="")
	{
		$this->Pro_Name = $strPro_Name;
		$this->Pro_Que_Q =$strPro_Que_Q ;
		$this->time = $strtime;
		
	}
}

?>