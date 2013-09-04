<?php

class ledInfo
{
	public $info;
	public $startTime;
	public $state;
	public $ledIP;
	public function __construct($_ledIP="",$_strTime="",$_info="")
	{
		$this->info=$_info;
		$this->ledIP=$_ledIP;
		$this->startTime=$_strTime;
		$this->state = '';
	}
}

?>