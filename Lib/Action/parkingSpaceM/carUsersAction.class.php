<?php
// 本文档自动生成，仅供测试运行
class carUsersAction extends Action
{
	public function updateUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$userName  =$decodedUser->userName;
		$userEPC     =$decodedUser->userEPC    ;
		$userCid     =$decodedUser->userCid    ;
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
		$sqlExecute = "update carUsers set 用户名称 = '$userName',车牌号码 = '$userCid',真实姓名 = '$userRname'
					,性别 = '$userSex',职业 = '$userJob',生日 = '$userBitrh',照片= '$userPic',地址='$userAdd',
				电话 = '$userTel',籍贯 = '$userJG',余额 = '$userYE',车辆类型 = '$carType'  where 用户EPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.carUsers.php');
		$carUsers = new carUsers(
			$userName,
			$userEPC,
			$userCid,
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
	public function updateUserYE()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);

		$userEPC     =$decodedUser->userEPC    ;
		
		$userYE		 =$decodedUser->userYE		;

		
		// 下面将数据添加到数据库中
		$sqlExecute = "update carUsers set 余额 = '$userYE' where 用户EPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.carUsers.php');
		
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
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,车牌号码 as userCid,真实姓名 as userRname,
					性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
					籍贯 as userJG,余额 as userYE,车辆类型 as carType FROM carUsers;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,车牌号码 as userCid,真实姓名 as userRname,
						性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
						籍贯 as userJG,余额 as userYE,车辆类型 as carType FROM carUsers;";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.carUsers.php');
			for($i=0;$i<count($list);$i++){
				$carUsers = new carUsers(
					$list[$i]['userName'],
					$list[$i]['userEPC'],
					$list[$i]['userCid'],
					$list[$i]['userRname'],
					$list[$i]['userSex'],
					$list[$i]['userJob'],
					$list[$i]['userBitrh'],
					$list[$i]['userPic'],
					$list[$i]['userAdd'],
					$list[$i]['userTel'],
					$list[$i]['userJG'],
					$list[$i]['userYE'],
					$list[$i]['carType']
					);
				$user->state="ok";
				array_push($result,$user);
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
		$userName  =$decodedUser->userName;
		$userEPC     =$decodedUser->userEPC    ;
		$userCid     =$decodedUser->userCid    ;
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
		$sqlExecute = "delete from carUsers where 用户EPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.carUsers.php');
		$carUsers = new carUsers(
			$userName,
			$userEPC,
			$userCid,
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
	public function addUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$userName  =$decodedUser->userName;
		$userEPC     =$decodedUser->userEPC    ;
		$userCid     =$decodedUser->userCid    ;
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
		$sqlExecute = "insert into carUsers
				values('$userName','$userEPC','$userCid','$userRname','$userSex','$userJob','$userBitrh','$userPic','$userAdd','$userTel'
				,'$userJG','$userYE','$carType');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.carUsers.php');
		$carUsers = new carUsers(
			$userName,
			$userEPC,
			$userCid,
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
		$foo_json = json_encode($user);s
		echo $foo_json;
	}
	public function getUser()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$userEPC = $decodedUser->userEPC;
		//$userEPC = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,车牌号码 as userCid,真实姓名 as userRname,
					性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
					籍贯 as userJG,余额 as userYE,车辆类型 as carType FROM carUsers where 用户EPC = '$userEPC';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,车牌号码 as userCid,真实姓名 as userRname,
						性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
						籍贯 as userJG,余额 as userYE,车辆类型 as userLevel FROM carUsers where 用户EPC = '$userEPC';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.carUsers.php');
			$carUsers = new carUsers(
				$list[0]['userName'],
				$list[0]['userEPC'],
				$list[0]['userCid'],
				$list[0]['userRname'],
				$list[0]['userSex'],
				$list[0]['userJob'],
				$list[0]['userBitrh'],
				$list[0]['userPic'],
				$list[0]['userAdd'],
				$list[0]['userTel'],
				$list[0]['userJG'],
				$list[0]['userYE'],
				$list[0]['userLevel']
				);
			$user->state="ok";
		}
		$foo_json = json_encode($user);
		
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