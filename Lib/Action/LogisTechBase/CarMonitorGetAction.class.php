<?php

class CarMonitorGetAction extends Action
{
	// 根据车辆ID获取其最新位置
	// GET 
	// http://localhost/phpRest/index.php/CarMonitorGet/getLatestCarPoint
	// {"strCarID":"001","strTime":"2011-11-26 11:19:54","strLatitude":"12345","strLongitude":"54321"}
	public function getLatestCarPoints()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedCarPoint = json_decode($jsonInput);
		$carid = $decodedCarPoint->strCarID;
		$carid=$this->checkUTF8($carid);
		$time= $decodedCarPoint->strTime;
		
		//date_default_timezone_set("Asia/Shanghai");
		//$time= date("Y-m-d H:i:s");
		$M = new Model();
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select   CAR_ID ,CREATE_TIME ,LATITUDE,LONGITUDE from T_CARPOINTS where CAR_ID = '$carid' and CREATE_TIME > '$time' order by CREATE_TIME asc";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select  CAR_ID ,CREATE_TIME ,LATITUDE,LONGITUDE from T_CARPOINTS where CAR_ID = '$carid' and CREATE_TIME > '$time'   order by CREATE_TIME asc";
			}
		//echo $sql;
		//return;
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.CarPoint.php');
			for($i=0;$i<count($list);$i++){
				$carPoint = new CarPoint($list[$i]['CAR_ID'],$list[$i]['CREATE_TIME'],$list[$i]['LATITUDE'],$list[$i]['LONGITUDE']);
				$carPoint->state="ok";
				array_push($result,$carPoint);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;		
		return;
	}

	private function checkUTF8($str) {
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