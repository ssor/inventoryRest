<?php

class zigbeeAction extends Action
{
	public function addZigbeeInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedLedInfo=json_decode($jsonInput);
		
		$info = $decodedLedInfo->info;
		$time = $decodedLedInfo->startTime;
		$ledIP = $decodedLedInfo->ledIP;
		$M = new Model();					
		
		//if (C('DB_TYPE')== 'pdo') {
		//sqlite
		$sql = "insert into ledInfo ( ledip , ledText , ledTime ) values('$ledIP','$info','$time');";
		//	}
		$r = $M->execute($sql);
		require_once("class.ledInfo.php");
		$ledInfo = new ledInfo(
			$ledIP,$time,$info
			);
		if ($r) {
			
			$ledInfo->state="ok";
		}
		else
		{
			$ledInfo->state="fail";
		}
		
		$foo_json = json_encode($ledInfo);
		
		echo $foo_json;
	}
	public function getLedInfos()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedLedInfo=json_decode($jsonInput);
		$time = $decodedLedInfo->startTime;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT ledip , ledText , ledTime FROM ledInfo where ledTime > '$time';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT ledip , ledText , ledTime FROM ledInfo where ledTime > '$time';";
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
					$list[$i]['ledip'],
					$list[$i]['ledTime'],
					$list[$i]['ledText']
					);	
				$ledInfo->state="ok";
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