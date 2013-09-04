<?php
// 本文档自动生成，仅供测试运行
class TBlistAction extends Action
{
public function addTBlist()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$EPC     =$decodedUser->EPC    ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into TBlist values('$PID','$EPC');";
		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.TBlist.php');
		$TBlist = new TBlist(
			$PID,
			$EPC
			);
		if ($r) {
			$TBlist->state="ok";
		}
		else
		{
			$TBlist->state="fail";
		}
		$foo_json = json_encode($TBlist);
		echo $foo_json;
	}
public function getAllTBlist() {
		
	    $jsonInput = file_get_contents("php://input");
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID=$decodedUser->PID;
	
		$M = new Model();						
		$sql = "SELECT * FROM TBlist where PID = '$PID';";
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.TBlist.php');
			for($i=0;$i<count($list);$i++){
				$TBlist = new TBlist(
					$list[$i]['PID'],
					$list[$i]['EPC']
					);
				$TBlist->state="ok";
				array_push($result,$TBlist);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}


		public function updateTBlistInfo()
	{	
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$EPC     =$decodedUser->EPC    ;
		$Pnum     =$decodedUser->Pnum    ;
		$PPlace   =$decodedUser->PPlace  ;
		$PP     =$decodedUser->PP    ;
		$time	 =$decodedUser->time	;
		$Pstate	 =$decodedUser->Pstate	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update TBlist set PID = '$PID',Pnum = '$Pnum',PPlace = '$PPlace',PP = '$PP',
		time = '$time',Pstate = '$Pstate'  where EPC = '$EPC';";
		echo 	$sqlExecute;
         return;		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.TBlist.php');
		$TBlist = new TBlist(
			$PID,
			$EPC,
			$Pnum,
			$PPlace,
			$PP,
			$time,
			$Pstate
		
			);
		if ($r) {
			$TBlist->state="ok";
		}
		else
		{
			$TBlist->state="fail";
		}
		$foo_json = json_encode($TBlist);
		echo $foo_json;
	}
	public function updateTBlistState()
	{	
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		
		$Pstate	 =$decodedUser->Pstate	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update TBlist set Pstate = '$Pstate'  where PID = '$PID';";
		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.TBlist.php');
		$TBlist = new TBlist(
			$PID,
			$EPC,
			$Pnum,
			$PPlace,
			$PP,
			$time,
			$Pstate
		
			);
		if ($r) {
			$TBlist->state="ok";
		}
		else
		{
			$TBlist->state="fail";
		}
		$foo_json = json_encode($TBlist);
		echo $foo_json;
	}
	public function deleteUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$EPC     =$decodedUser->EPC    ;
		$Pnum     =$decodedUser->Pnum    ;
		$PPlace   =$decodedUser->PPlace  ;
		$PP     =$decodedUser->PP    ;
		$time	 =$decodedUser->time	;
		$Pstate	 =$decodedUser->Pstate	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from TBlist where 用户EPC = '$EPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.TBlist.php');
		$TBlist = new TBlist(
			$PID,
			$EPC,
			$Pnum,
			$PPlace,
			$PP,
			$time,
			$Pstate,
			$userPic,
			$userAdd,
			$userTel,
			$userJG,
			$userYE,
			$carType
			);
		if ($r) {
			$user->state="ok";
		}
		else
		{
			$user->state="fail";
		}
		$foo_json = json_encode($user);
		echo $foo_json;
	}
	
	public function getTBlist()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$Pnum = $decodedUser->Pnum;
		//$EPC = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  PID, EPC, Pnum, PPlace,PP, time, Pstate FROM TBlist where Pnum = '$Pnum';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.TBlist.php');
			$TBlist = new TBlist(
				$list[0]['PID'],
				$list[0]['EPC'],
				$list[0]['Pnum'],
				$list[0]['PPlace'],
				$list[0]['PP'],
				$list[0]['time'],
				$list[0]['Pstate']
				);
		
		}
			$TBlist->state="ok";
		$foo_json = json_encode($TBlist);
		
		echo $foo_json;
		return;		
	}
	public function getTBlistCount()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$Pnum = $decodedUser->Pnum;
		//$EPC = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  * FROM TBlist ;";
			
		$list = $M->query($sql);
		
			echo count($list);
		return;		
	}
	public function getTBlistState()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$Pnum = $decodedUser->Pnum;
		$temp = $decodedUser->PID;
		$humi = $decodedUser->EPC;
		//$EPC = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  PID, EPC, Pnum, PPlace,PP, time, Pstate FROM TBlist where Pnum = '$Pnum';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.TBlist.php');
			$TBlist = new TBlist(
				$list[0]['PID'],
				$list[0]['EPC'],
				$list[0]['Pnum'],
				$list[0]['PPlace'],
				$list[0]['PP'],
				$list[0]['time'],
				$list[0]['Pstate']
				);
		
		}
			$TBlist->state="ok";
			$TBlist->EPC=$temp;
			$TBlist->PID=$humi;
		$foo_json = json_encode($TBlist);
		
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
	* 默认操作
	+----------------------------------------------------------
	*/
	public function index()
	{
		$this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
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