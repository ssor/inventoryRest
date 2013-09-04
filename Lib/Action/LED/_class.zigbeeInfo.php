<?php

class zigbeeInfo
{
	public $node_id;
	public $startTime;
	public $temp;
	public $humi;
	public $state;
	public $light;
	public function __construct($_node_id="",$_strTime="",$_temp="",$_humi="",$_light="")
	{
		$this->node_id=$_node_id;
		$this->temp=$_temp;
		$this->humi = $_humi;
		$this->light=$_light;
		$this->startTime=$_strTime;
		$this->state = '';
	}
}

?>