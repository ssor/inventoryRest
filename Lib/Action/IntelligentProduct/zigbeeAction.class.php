<?php

class zigbeeAction extends Action
{
	public function addZigbeeInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedLedInfo=json_decode($jsonInput);
		
		$Tem=$decodedLedInfo->temp;
		$Wet=$decodedLedInfo->humi;
		$time = $decodedLedInfo->startTime;
		
		$M = new Model();					
		
		//if (C('DB_TYPE')== 'pdo') {
		//sqlite
		$sql = "insert into EnviromentInfo ( Tem , Wet , Time ) values('$Tem','$Wet','$time');";
		//	}
		$r = $M->execute($sql);
		
		if ($r) {
			
			echo "ok";
		}
		else
		{
			echo "fail";
		}
		
		
	}
	public function getEnviromentInfos()
	{
		//$jsonInput = file_get_contents("php://input"); 
		//$jsonInput=$this->checkUTF8($jsonInput);
		//$decodedLedInfo=json_decode($jsonInput);
		//$time = $decodedLedInfo->startTime;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT Tem,Wet FROM EnviromentInfo where Time=(select max(Time)from EnviromentInfo);";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT Tem,Wet FROM EnviromentInfo where Time=(select max(Time)from EnviromentInfo);";
			}
		//echo $sql;//
		//return;
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once("class.ledInfo.php");
			for($i = 0;$i < count($list);$i++)
			{			
				$ledInfo = new ledInfo(
					$list[$i]['Tem'],
					$list[$i]['Wet']
					
					);	
				
				array_push($result,$ledInfo);
			}				
		}
		
		$foo_json = json_encode($result);
		
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