<?php

class CommandInfo
{
	public $info;
	public $startTime;
	public $state;
	public $ledIP;
	public $commandName; 
	public function __construct($_commandName="",$_ledIP="",$_strTime="",$_info="")
	{
		$this->commandName=$_commandName;
		$this->info=$_info;
		$this->ledIP=$_ledIP;
		$this->startTime=$_strTime;
		$this->state = '';
	}
}

?>