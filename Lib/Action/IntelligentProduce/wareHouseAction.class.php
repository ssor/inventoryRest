<?php
// 本文档自动生成，仅供测试运行
class wareHouseAction extends Action
{
	public function updatewareHouseInfo()
	{	
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$wareHoseID  =$decodedUser->wareHoseID;
		$shelvesID     =$decodedUser->shelvesID    ;
		$zigBeeID     =$decodedUser->zigBeeID    ;
		$uptemp   =$decodedUser->uptemp  ;
		$dowmtemp     =$decodedUser->dowmtemp    ;
		$uphumi	 =$decodedUser->uphumi	;
		$downhumi	 =$decodedUser->downhumi	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update wareHouse set wareHoseID = '$wareHoseID',zigBeeID = '$zigBeeID',uptemp = '$uptemp',dowmtemp = '$dowmtemp',
		uphumi = '$uphumi',downhumi = '$downhumi'  where shelvesID = '$shelvesID';";
		echo 	$sqlExecute;
         return;		
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.wareHouse.php');
		$wareHouse = new wareHouse(
			$wareHoseID,
			$shelvesID,
			$zigBeeID,
			$uptemp,
			$dowmtemp,
			$uphumi,
			$downhumi
		
			);
		if ($r) {
			$wareHouse->state="ok";
		}
		else
		{
			$wareHouse->state="fail";
		}
		$foo_json = json_encode($wareHouse);
		echo $foo_json;
	}
	public function updateUserYE()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);

		$shelvesID     =$decodedUser->shelvesID    ;
		
		$userYE		 =$decodedUser->userYE		;

		
		// 下面将数据添加到数据库中
		$sqlExecute = "update wareHouse set 余额 = '$userYE' where 用户EPC = '$shelvesID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.wareHouse.php');
		
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
		

			
			$sql = "SELECT * FROM wareHouse;";
			
		
			
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.wareHouse.php');
			for($i=0;$i<count($list);$i++){
				$wareHouse = new wareHouse(
					$list[$i]['wareHoseID'],
					$list[$i]['shelvesID'],
					$list[$i]['zigBeeID'],
					$list[$i]['uptemp'],
					$list[$i]['dowmtemp'],
					$list[$i]['uphumi'],
					$list[$i]['downhumi']
				
					);
				$wareHouse->state="ok";
				array_push($result,$wareHouse);
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
		$wareHoseID  =$decodedUser->wareHoseID;
		$shelvesID     =$decodedUser->shelvesID    ;
		$zigBeeID     =$decodedUser->zigBeeID    ;
		$uptemp   =$decodedUser->uptemp  ;
		$dowmtemp     =$decodedUser->dowmtemp    ;
		$uphumi	 =$decodedUser->uphumi	;
		$downhumi	 =$decodedUser->downhumi	;
	
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from wareHouse where 用户EPC = '$shelvesID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.wareHouse.php');
		$wareHouse = new wareHouse(
			$wareHoseID,
			$shelvesID,
			$zigBeeID,
			$uptemp,
			$dowmtemp,
			$uphumi,
			$downhumi,
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
	public function addwareHouse()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$wareHoseID  =$decodedUser->wareHoseID;
		$shelvesID     =$decodedUser->shelvesID    ;
		$zigBeeID     =$decodedUser->zigBeeID    ;
		$uptemp   =$decodedUser->uptemp  ;
		$dowmtemp     =$decodedUser->dowmtemp    ;
		$uphumi	 =$decodedUser->uphumi	;
		$downhumi	 =$decodedUser->downhumi	;		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into wareHouse values('$wareHoseID','$shelvesID','$zigBeeID','$uptemp','$dowmtemp','$uphumi','$downhumi');";
				
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.wareHouse.php');
		$wareHouse = new wareHouse(
			$wareHoseID,
			$shelvesID,
			$zigBeeID,
			$uptemp,
			$dowmtemp,
			$uphumi,
			$downhumi
			);
		if ($r) {
			$wareHouse->state="ok";
		}
		else
		{
			$wareHouse->state="fail";
		}
		$foo_json = json_encode($wareHouse);
		echo $foo_json;
	}
	public function getwareHouse()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$zigBeeID = $decodedUser->zigBeeID;
		//$shelvesID = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  wareHoseID, shelvesID, zigBeeID, uptemp,dowmtemp, uphumi, downhumi FROM wareHouse where zigBeeID = '$zigBeeID';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.wareHouse.php');
			$wareHouse = new wareHouse(
				$list[0]['wareHoseID'],
				$list[0]['shelvesID'],
				$list[0]['zigBeeID'],
				$list[0]['uptemp'],
				$list[0]['dowmtemp'],
				$list[0]['uphumi'],
				$list[0]['downhumi']
				);
		
		}
			$wareHouse->state="ok";
		$foo_json = json_encode($wareHouse);
		
		echo $foo_json;
		return;		
	}
	public function getwareHouseState()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$zigBeeID = $decodedUser->zigBeeID;
		$temp = $decodedUser->wareHoseID;
		$humi = $decodedUser->shelvesID;
		//$shelvesID = "123";
		$M = new Model();					
		
		
			// sqlserver
			$sql = "SELECT  wareHoseID, shelvesID, zigBeeID, uptemp,dowmtemp, uphumi, downhumi FROM wareHouse where zigBeeID = '$zigBeeID';";
			
		$list = $M->query($sql);
			
		
		if (count($list)>0) {
			require_once('class.wareHouse.php');
			$wareHouse = new wareHouse(
				$list[0]['wareHoseID'],
				$list[0]['shelvesID'],
				$list[0]['zigBeeID'],
				$list[0]['uptemp'],
				$list[0]['dowmtemp'],
				$list[0]['uphumi'],
				$list[0]['downhumi']
				);
		
		}
			$wareHouse->state="ok";
			$wareHouse->shelvesID=$temp;
			$wareHouse->wareHoseID=$humi;
		$foo_json = json_encode($wareHouse);
		
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