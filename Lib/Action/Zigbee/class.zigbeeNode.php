<?php

class zigbeeNode
{
	public $node_id;
	// public $startTime;
	// public $temp;
	public $max_temp;
	public $min_temp;

	// public $humi;
	public $max_humi;
	public $min_humi;

	public $location;
	
	public $state;
	// public $light;
	public function __construct($_node_id="", $_max_temp = "" , $_min_temp = "" 
									, $_max_humi = "", $_min_humi = "", $_location="")
	{
		$this->node_id=$_node_id;
		$this->max_temp = $_max_temp;
		$this->min_temp = $_min_temp;

		$this->max_humi = $_max_humi;
		$this->min_humi = $_min_humi;
		// $this->temp=$_temp;
		// $this->humi = $_humi;
		// $this->light=$_light;
		$this->location = $_location;
		// $this->startTime=$_strTime;
		$this->state = '';
	}
}

?>