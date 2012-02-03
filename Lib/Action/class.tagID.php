<?php

class tagID
{
	public $tag;
	public $startTime;
	public $state;
	public $cmd;
	public function __construct($strTag="",$strTime="",$strCmd="")
	{
		$this->tag = $strTag;
		$this->startTime = $strTime;
		$this->cmd = $strCmd;
		$this->state = '';
	}
}

?>