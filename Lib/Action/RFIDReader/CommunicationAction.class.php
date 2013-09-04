<?php
class CommandProtocol
{
	public  $command ;
	public  $timeStamp ;
	public  $flag;
	public  $state ;
	
	public function __construct($_command = "",$_timeStamp="",$_falg="") 
	{
		$this->command=$_command;
		$this->timeStamp=$_timeStamp;
		$this->flag=$_falg;
	}
}

class CommunicationAction extends Action
{
	public function addCommand()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedCommand=json_decode($jsonInput);
		$cmd = $decodedCommand->command;
		$time = $decodedCommand->timeStamp;
		$flag = $decodedCommand->flag;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "insert into communictionTemp(command , timeStamp , flag) values('$cmd','$time','$flag');";
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "insert into communictionTemp(command , timeStamp , flag) values('$cmd','$time','$flag');";
			}
		$r = $M->execute($sql);
		$command = new CommandProtocol(
			$cmd,
			$time,
			$flag
			);
		if ($r) {
			
			$command->state="ok";
		}
		else
		{
			$command->state="fail";
		}
		
		$foo_json = json_encode($command);
		
		echo $foo_json;
	}
	public function getCommand()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedCommand=json_decode($jsonInput);
		$cmd = $decodedCommand->command;
		$time = $decodedCommand->timeStamp;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select command , timeStamp , flag from communictionTemp where timeStamp > '$time';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select command , timeStamp , flag from communictionTemp where timeStamp > '$time';";
			}
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			for($i = 0;$i < count($list);$i++)
			{				
				$command = new CommandProtocol(
					$list[$i]['command'],
					$list[$i]['timeStamp'],
					$list[$i]['flag']
					);
				$command->state="ok";
				array_push($result,$command);
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