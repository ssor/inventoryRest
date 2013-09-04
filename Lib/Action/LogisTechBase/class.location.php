<?php

class location
{
	public $timeStamp;
	public $name;
	public $lat;
	public $lng;
	public $state;
	public function __construct($_timeStamp="",$_name="",$_lat="",$_lng="")
	{
		$this->timeStamp=$_timeStamp;
		$this->name=$_name;
		$this->lat=$_lat;
		$this->lng=$_lng;
		$this->state = '';
	}
}

?>