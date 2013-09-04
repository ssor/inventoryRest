<?php

class zigbeeAction extends Action
{
	// 获取最新的节点的环境信息
	// 如果参数中时间为空，则返回最新的信息及相应时间
	// {"node_id":"00158D0000002893","startTime":"","temp":"26","humi":"88","light":"","state":""}
	// {"node_id":"00158D0000002893","startTime":"2012-10-10 09:20:47","temp":"26","humi":"88","state":"ok","light":""}
	public function getZigbeeInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$zigbeeInfo=json_decode($jsonInput);

		$node_id = $zigbeeInfo->node_id;

		// 未提供时间参数的情况
		if (empty($zigbeeInfo->startTime)) {
			$sql_select = "select node_id, info_time, info_temp, info_humi from zigbee_info
							 where node_id = '$node_id'  order by info_time desc limit(1)";
		}
		else
		{
			$time_para = $zigbeeInfo->startTime;
			$sql_select = "select node_id, info_time, info_temp, info_humi from zigbee_info
				 where node_id = '$node_id' and info_time > '$time_para' order by info_time desc limit(1)";
		}
		$M = new Model();					
		$list = $M->query($sql_select);
		if (count($list)>0) {
			require_once("class.zigbeeInfo.php");
			$i = 0;
			$zigbeeInfoR = new zigbeeInfo(
					$list[$i]['node_id'],
					$list[$i]['info_time'],
					$list[$i]['info_temp'],
					$list[$i]['info_humi']
					);	
			$zigbeeInfoR->state="ok";
		}
		else
		{
			$zigbeeInfo->state="failed";
			$zigbeeInfoR = $zigbeeInfo;
		}
		
		$foo_json = json_encode($zigbeeInfoR);
		
		echo $foo_json;	
	}
	// 更新zigbee节点当前的温度和湿度信息
	public function addZigbeeInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$zigbeeInfo=json_decode($jsonInput);

		$node_id = $zigbeeInfo->node_id;
		date_default_timezone_set("Asia/Shanghai");
		$time = date("Y-m-d H:i:s");
		$temp = $zigbeeInfo->temp;
		$humi = $zigbeeInfo->humi;
		$sql_insert = 
			"insert into zigbee_info( node_id, info_time, info_temp, info_humi) 
			    values('$node_id', '$time', '$temp', '$humi');";
		$M = new Model();					
		$r = $M->execute($sql_insert);
		require_once("class.zigbeeInfo.php");
		$zigbeeInfo = new zigbeeInfo(
			$node_id
			);
		if ($r) {
			$zigbeeInfo->state="ok";
		}
		else
		{
			$zigbeeInfo->state="fail";
		}
		$foo_json = json_encode($zigbeeInfo);
		
		echo $foo_json;	
	}
	//GET http://localhost:9002/index.php/Zigbee/zigbee/getAllZigbeeNodes
	public function getAllZigbeeNodes()
	{
		$M = new Model();
		$sql_select_all_nodes = 
		    "select node_id, max_temp, min_temp, max_humi, min_humi, location from tbZigbeeNode";

		$list = $M->query($sql_select_all_nodes);
		$result = array();
		if (count($list)>0) {
			require_once("class.zigbeeNode.php");
			for($i = 0;$i < count($list);$i++)
			{			
				$zigbeeNode = new zigbeeNode(
					$list[$i]['node_id'],
					$list[$i]['max_temp'],
					$list[$i]['min_temp'],
					$list[$i]['max_humi'],
					$list[$i]['min_humi'],
					$list[$i]['location']
					);	
				$zigbeeNode->state="ok";
				array_push($result,$zigbeeNode);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;		 					

	}
	public function getZigbeeNode()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$zigbeeNode=json_decode($jsonInput);
		
		$node_id = $zigbeeNode->node_id;
		$sql_select_node = 
		    "select node_id, max_temp, min_temp, max_humi, min_humi, location from tbZigbeeNode where node_id = '$node_id'";

		$M = new Model();
		$list = $M->query($sql_select_node);
		if (count($list)>0) {
			require_once("class.zigbeeNode.php");
			$i = 0;
			$zigbeeNode = new zigbeeNode(
					$list[$i]['node_id'],
					$list[$i]['max_temp'],
					$list[$i]['min_temp'],
					$list[$i]['max_humi'],
					$list[$i]['min_humi'],
					$list[$i]['location']
					);	
				$zigbeeNode->state="ok";
		}
		else
		{
			$zigbeeNode = new zigbeeNode();
			$zigbeeNode->state="failed";
		}
		
		$foo_json = json_encode($zigbeeNode);
		
		echo $foo_json;		 					

	}
	public function deleteZigbeeNode()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$zigbeeNode=json_decode($jsonInput);
		
		$node_id = $zigbeeNode->node_id;
		// $max_temp = $zigbeeNode->max_temp;
		// $min_temp = $zigbeeNode->min_temp;
		// $max_humi = $zigbeeNode->max_humi;
		// $min_humi = $zigbeeNode->min_humi;
		// $location = $zigbeeNode->location;

		$M = new Model();					
		
		//if (C('DB_TYPE')== 'pdo') {
		//sqlite
		$sql = "delete from tbZigbeeNode where node_id = '$node_id';";
		//	}
		$r = $M->execute($sql);
		require_once("class.zigbeeNode.php");
		$zigbeeNode = new zigbeeNode(
			$node_id
			);
		if ($r) {
			
			$zigbeeNode->state="ok";
		}
		else
		{
			$zigbeeNode->state="fail";
		}
		
		$foo_json = json_encode($zigbeeNode);
		
		echo $foo_json;		
	}
	public function addZigbeeNode()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$zigbeeNode=json_decode($jsonInput);
		
		$node_id = $zigbeeNode->node_id;
		$max_temp = $zigbeeNode->max_temp;
		$min_temp = $zigbeeNode->min_temp;
		$max_humi = $zigbeeNode->max_humi;
		$min_humi = $zigbeeNode->min_humi;
		$location = $zigbeeNode->location;

		$M = new Model();					
		
		//if (C('DB_TYPE')== 'pdo') {
		//sqlite
		$sql = "insert into tbZigbeeNode ( node_id, max_temp, min_temp, max_humi, min_humi, location ) 
					values('$node_id','$max_temp','$min_temp', '$max_humi', '$min_humi', '$location');";
		//	}
		$r = $M->execute($sql);
		require_once("class.zigbeeNode.php");
		$zigbeeNode = new zigbeeNode(
			$node_id,$max_temp,$min_temp, $max_humi, $min_humi, $location
			);
		if ($r) {
			
			$zigbeeNode->state="ok";
		}
		else
		{
			$zigbeeNode->state="fail";
		}
		
		$foo_json = json_encode($zigbeeNode);
		
		echo $foo_json;
	}

	
	public function checkUTF8($str) {
		$cod = mb_check_encoding($str,"UTF-8");
		if("UTF-8" != $cod ||  empty($cod))
		{
			$str = mb_convert_encoding( $str,'utf-8','gb2312'); 
		}
		return $str;
	}
	/**
	+----------------------------------------------------------
	* 探针模式
	+----------------------------------------------------------
	*/
	public function checkEnv()
	{
		load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
		$env_table = check_env();//根据当前函数获取当前环境
		echo $env_table;
	}
	
}
?>