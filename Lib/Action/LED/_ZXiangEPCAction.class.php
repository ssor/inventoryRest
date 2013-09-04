<?php
// 本文档自动生成，仅供测试运行
class ZXiangEPCAction extends Action
{


public function addxiang()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		
		$decodedUser=json_decode($jsonInput);
		$xiangEPC  =$decodedUser->xiangEPC;
		$productEPC     =$decodedUser->productEPC    ;
		$productName     =$decodedUser->productName    ;
		$time     =$decodedUser->time    ;

		// 下面将数据添加到数据库中
		$sqlExecute = "insert into ZXiangEPC values('$xiangEPC','$productEPC','$productName','$time');";
		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ZXiangEPC.php');
		$ZXiangEPC = new ZXiangEPC(
			$xiangEPC,
			$productEPC,
			$productName,
			$time
			);
		if ($r) {
			$ZXiangEPC->state="ok";
		}
		else
		{
			$ZXiangEPC->state="fail";
		}
		$foo_json = json_encode($ZXiangEPC);
		echo $foo_json;
	}
	public function updateZXiangEPC()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$ZEPC  =$decodedUser->ZEPC;
		$PEPC     =$decodedUser->PEPC    ;
		$Ztime     =$decodedUser->Ztime    ;
		
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update ZXiangEPC set ZEPC = '$ZEPC',Ztime = '$Ztime' where PEPC = '$PEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ZXiangEPC.php');
		$ZXiangEPC = new ZXiangEPC(
			$ZEPC,
			$PEPC,
			$Ztime
		
			);
		if ($r) {
			$ZXiangEPC->state="ok";
		}
		else
		{
			$ZXiangEPC->state="fail";
		}
		$foo_json = json_encode($ZXiangEPC);
		echo $foo_json;
	}
	public function updateUserYE()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);

		$PEPC     =$decodedUser->PEPC    ;
		
		$userYE		 =$decodedUser->userYE		;

		
		// 下面将数据添加到数据库中
		$sqlExecute = "update ZXiangEPC set 余额 = '$userYE' where PEPC = '$PEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ZXiangEPC.php');
		
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
	public function getAllUsers() {
		$M = new Model();					
		

			
			$sql = "SELECT ZEPC ,PEPC ,Ztime  FROM ZXiangEPC;";
			
		
			
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.ZXiangEPC.php');
			for($i=0;$i<count($list);$i++){
				$ZXiangEPC = new ZXiangEPC(
					$list[$i]['ZEPC'],
					$list[$i]['PEPC'],
					$list[$i]['Ztime']
					
					);
				$ZXiangEPC->state="ok";
				array_push($result,$ZXiangEPC);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deleteUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$ZEPC  =$decodedUser->ZEPC;
		$PEPC     =$decodedUser->PEPC    ;
		$Ztime     =$decodedUser->Ztime    ;
		$userRname   =$decodedUser->userRname  ;
		$userSex     =$decodedUser->userSex    ;
		$userJob	 =$decodedUser->userJob	;
		$userBitrh	 =$decodedUser->userBitrh	;
		$userPic	 =$decodedUser->userPic	;
		$userAdd	 =$decodedUser->userAdd	;
		$userTel	 =$decodedUser->userTel	;
		$userJG		 =$decodedUser->userJG		;
		$userYE		 =$decodedUser->userYE		;
		$carType   =$decodedUser->carType  ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from ZXiangEPC where PEPC = '$PEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ZXiangEPC.php');
		$ZXiangEPC = new ZXiangEPC(
			$ZEPC,
			$PEPC,
			$Ztime,
			$userRname,
			$userSex,
			$userJob,
			$userBitrh,
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
	
	public function getUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$PEPC = $decodedUser->PEPC;
		//$PEPC = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT ZEPC , PEPC, Ztime FROM ZXiangEPC where PEPC = '$PEPC';";
			
	
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.ZXiangEPC.php');
			$ZXiangEPC = new ZXiangEPC(
				$list[0]['ZEPC'],
				$list[0]['PEPC'],
				$list[0]['Ztime']
			
				);
			$ZXiangEPC->state="ok";
		}
		$foo_json = json_encode($ZXiangEPC);
		
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