<?php

class CommandInfoAction extends Action
{
	public function addCommandInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedCommandInfo=json_decode($jsonInput);
        date_default_timezone_set("Asia/Shanghai");
        $vTime = date("Y-m-d H:i:s");
		$info = $decodedCommandInfo->info;
		$time = $vTime;
		$ledIP = $decodedCommandInfo->ledIP;
		$name = $decodedCommandInfo->commandName;
		
		$M = new Model();					
		
		//if (C('DB_TYPE')== 'pdo') {
		//sqlite
		$sql = "insert into commandInfo ( commandName , ledip , ledText , ledTime ) values ('$name','$ledIP','$info','$time');";
		//	}
		$r = $M->execute($sql);
		require_once("class.CommandInfo.php");
		$commandInfo = new CommandInfo($name,$ledIP,$time,$info);
		if ($r) {
			
			$commandInfo->state="ok";
		}
		else
		{
			$commandInfo->state="fail";
		}
		
		$foo_json = json_encode($commandInfo);
		
		echo $foo_json;
	}

	public function getCommandInfos()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedCommandInfo=json_decode($jsonInput);
		$time = $decodedCommandInfo->startTime;
		
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT commandName , ledip , ledText , ledTime FROM commandInfo where ledTime > '$time';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT commandName , ledip , ledText , ledTime FROM commandInfo where ledTime > '$time';";
				//$sql = "SELECT ledip , ledText , ledTime FROM ledInfo where ledTime > '$time';";
			}
		//echo $sql;//
		//return;
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once("class.CommandInfo.php");
			for($i = 0;$i < count($list);$i++)
			{			
				$cmdInfo = new CommandInfo(
					$list[$i]['commandName'],
					$list[$i]['ledip'],
					$list[$i]['ledTime'],
					$list[$i]['ledText']
					);	
				$cmdInfo->state="ok";
				array_push($result,$cmdInfo);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
	}
	public function get_command_info_comet()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedCommandInfo=json_decode($jsonInput);
		$time = $decodedCommandInfo->startTime;
		
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT commandName , ledip , ledText , ledTime FROM commandInfo where ledTime > '$time';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT commandName , ledip , ledText , ledTime FROM commandInfo where ledTime > '$time';";
				//$sql = "SELECT ledip , ledText , ledTime FROM ledInfo where ledTime > '$time';";
			}
		
		$result = array();
		$count = 0;
		$btime_out = true;

		while ($count<10) {
			$list = $M->query($sql);
			if (count($list)>0) {
				require_once("class.CommandInfo.php");
				for($i = 0;$i < count($list);$i++)
				{			
					$cmdInfo = new CommandInfo(
						$list[$i]['commandName'],
						$list[$i]['ledip'],
						$list[$i]['ledTime'],
						$list[$i]['ledText']
						);	
					$cmdInfo->state="ok";
					array_push($result,$cmdInfo);
				}
				$btime_out = false;
				break;				
			}
			$count++;
			// sleep(1);
			time_nanosleep(0,500000000);
		}
		if ($btime_out == true) {
			echo "timeout";
		}
		else
		{
			$foo_json = json_encode($result);
			echo $foo_json;
		}
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