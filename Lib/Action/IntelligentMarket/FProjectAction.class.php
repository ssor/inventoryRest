<?php
// 本文档自动生成，仅供测试运行
class FProjectAction extends Action
{
public function getAllUsers() {
		
	    $jsonInput = file_get_contents("php://input");
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PJstate=$decodedUser->Pstate;
	
		$M = new Model();						
		$sql = "SELECT * FROM FProject where Pstate = '$Pstate';";
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.FProject.php');
			for($i=0;$i<count($list);$i++){
				$FProject = new FProject(
					$list[$i]['PID'],
					$list[$i]['Pname'],
					$list[$i]['Pnum'],
					$list[$i]['PPlace'],
					$list[$i]['PP'],
					$list[$i]['time'],
					$list[$i]['Pstate']
				
					);
				$FProject->state="ok";
				array_push($result,$FProject);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}


		public function updateFProjectInfo()
	{	
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$Pname     =$decodedUser->Pname    ;
		$Pnum     =$decodedUser->Pnum    ;
		$PPlace   =$decodedUser->PPlace  ;
		$PP     =$decodedUser->PP    ;
		$time	 =$decodedUser->time	;
		$Pstate	 =$decodedUser->Pstate	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FProject set PID = '$PID',Pnum = '$Pnum',PPlace = '$PPlace',PP = '$PP',
		time = '$time',Pstate = '$Pstate'  where Pname = '$Pname';";
		echo 	$sqlExecute;
         return;		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProject.php');
		$FProject = new FProject(
			$PID,
			$Pname,
			$Pnum,
			$PPlace,
			$PP,
			$time,
			$Pstate
		
			);
		if ($r) {
			$FProject->state="ok";
		}
		else
		{
			$FProject->state="fail";
		}
		$foo_json = json_encode($FProject);
		echo $foo_json;
	}
	
	public function deleteUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$Pname     =$decodedUser->Pname    ;
		$Pnum     =$decodedUser->Pnum    ;
		$PPlace   =$decodedUser->PPlace  ;
		$PP     =$decodedUser->PP    ;
		$time	 =$decodedUser->time	;
		$Pstate	 =$decodedUser->Pstate	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from FProject where 用户EPC = '$Pname';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProject.php');
		$FProject = new FProject(
			$PID,
			$Pname,
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
	public function addFProject()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PID  =$decodedUser->PID;
		$Pname     =$decodedUser->Pname    ;
		$Pnum     =$decodedUser->Pnum    ;
		$PPlace   =$decodedUser->PPlace  ;
		$PP     =$decodedUser->PP    ;
		$time	 =$decodedUser->Ptime	;
		$Pstate	 =$decodedUser->Pstate	;		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into FProject values('$PID','$Pname','$Pnum','$PPlace','$PP','$time','$Pstate');";
			echo 	$sqlExecute;
			return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProject.php');
		$FProject = new FProject(
			$PID,
			$Pname,
			$Pnum,
			$PPlace,
			$PP,
			$time,
			$Pstate
			);
		if ($r) {
			$FProject->state="ok";
		}
		else
		{
			$FProject->state="fail";
		}
		$foo_json = json_encode($FProject);
		echo $foo_json;
	}
	public function getFProject()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$Pnum = $decodedUser->Pnum;
		//$Pname = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  PID, Pname, Pnum, PPlace,PP, time, Pstate FROM FProject where Pnum = '$Pnum';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.FProject.php');
			$FProject = new FProject(
				$list[0]['PID'],
				$list[0]['Pname'],
				$list[0]['Pnum'],
				$list[0]['PPlace'],
				$list[0]['PP'],
				$list[0]['time'],
				$list[0]['Pstate']
				);
		
		}
			$FProject->state="ok";
		$foo_json = json_encode($FProject);
		
		echo $foo_json;
		return;		
	}
	public function getFProjectState()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$Pnum = $decodedUser->Pnum;
		$temp = $decodedUser->PID;
		$humi = $decodedUser->Pname;
		//$Pname = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  PID, Pname, Pnum, PPlace,PP, time, Pstate FROM FProject where Pnum = '$Pnum';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.FProject.php');
			$FProject = new FProject(
				$list[0]['PID'],
				$list[0]['Pname'],
				$list[0]['Pnum'],
				$list[0]['PPlace'],
				$list[0]['PP'],
				$list[0]['time'],
				$list[0]['Pstate']
				);
		
		}
			$FProject->state="ok";
			$FProject->Pname=$temp;
			$FProject->PID=$humi;
		$foo_json = json_encode($FProject);
		
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