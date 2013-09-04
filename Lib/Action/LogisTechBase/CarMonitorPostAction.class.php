<?php

class CarMonitorPostAction extends Action
{
	
	// 增加车辆的点信息
	//Post
	// http://localhost/phpRest/index.php/CarMonitorPost/postCarPoint
	// {"strCarID":"001","strTime":"2011-11-26 11:19:54","strLatitude":"12345","strLongitude":"54321"}
	public function postCarPoint()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedCarPoint = json_decode($jsonInput);
		$carid = $decodedCarPoint->strCarID;
		$carid=$this->checkUTF8($carid);
		
		//date_default_timezone_set("Asia/Shanghai");//
		//$time= date("Y-m-d H:i:s");
		$time= $decodedCarPoint->strTime;
		$latitude = $decodedCarPoint->strLatitude;
		$longitude = $decodedCarPoint->strLongitude;
		$sqlExecute = "insert into T_CARPOINTS(CAR_ID ,CREATE_TIME ,LATITUDE ,LONGITUDE )
						 values( '$carid' ,'$time' ,'$latitude' ,'$longitude' );";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.CarPoint.php');
		$carPoint = new CarPoint($carid,$time,$latitude,$longitude);
		
		if ($r) {
			$carPoint->state="ok";
		}
		else
		{
			$carPoint->state="failed";
		}
		$foo_json = json_encode($carPoint);
		
		echo $foo_json;
		return;
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