<?php

class ReaderAction extends Action
{
	public function addScanTags()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTags=json_decode($jsonInput);

		$result = array();
		for	($i=0;$i<count($decodedTags);$i++)
		{
			$decodedTag = $decodedTags[$i];
			$cmd = $decodedTag->cmd;
			// $time = $decodedTag->startTime;
			$tag = $decodedTag->tag;
			date_default_timezone_set("Asia/Shanghai");
			$time = date("Y-m-d H:i:s");
			$sqlExecute = "insert into tbRfidScanTemp(tagID,flag,timeTamp) values('$tag','$cmd','$time');";
			$M = new Model();
			$r = $M->execute($sqlExecute);
			require_once('class.tagID.php');
			$otag = new tagID($tag,$time,$cmd);
			if ($r) {
				$otag->state="ok";
			}
			else
			{
				$otag->state="fail";
			}		
			array_push($result,$otag);
		}

		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;	
		
	}
	//将扫描到的标签添加到数据库中
	//添加标签时有三个属性
	//1 标签ID
	//2 添加时间
	//3 添加标签的目的，例如出库入库或者盘点等等
	public function addScanTag()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTag=json_decode($jsonInput);
		$cmd = $decodedTag->cmd;
		// $time = $decodedTag->startTime;
		$tag = $decodedTag->tag;
		date_default_timezone_set("Asia/Shanghai");
		$time = date("Y-m-d H:i:s");		
		$sqlExecute = "insert into tbRfidScanTemp(tagID,flag,timeTamp) values('$tag','$cmd','$time');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.tagID.php');
		$otag = new tagID($tag,$time,$cmd);
		if ($r) {
			$otag->state="ok";
		}
		else
		{
			$otag->state="fail";
		}
		$foo_json = json_encode($otag);
		
		echo $foo_json;
		return;	
		
	}
	// 获取扫描到的标签
	// 可以根据时间和添加标签时附带的目的属性筛选
	public function getScanTags()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$cmd = $decodedProduct->cmd;
		$time = $decodedProduct->startTime;
		if(empty($time))
		{
			date_default_timezone_set("Asia/Shanghai");
			$time = date("Y-m-d H:i:s");				
		}
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select tagID,flag,timeTamp from tbRfidScanTemp where flag = '$cmd' and timeTamp > '$time' order by timeTamp asc;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select tagID,flag,timeTamp from tbRfidScanTemp where flag = '$cmd' and timeTamp > '$time' order by timeTamp asc;";
				
			}
		$list = $M->query($sql);
		$result = array();
		require_once('class.tagID.php');
		if (count($list)>0) {
			for($i = 0;$i < count($list);$i++)
			{				
				$tag = new tagID(
					$list[$i]['tagID'],
					$list[$i]['timeTamp'],
					$cmd
					);
				array_push($result,$tag);
			}				
		}
		else
		{
			$tag = new tagID(
					"0",
					$time,
					$cmd
					);
			array_push($result,$tag);
		}
		
		$foo_json = json_encode($result);
		
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