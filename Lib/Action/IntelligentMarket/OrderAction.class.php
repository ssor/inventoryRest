<?php
// 本文档自动生成，仅供测试运行
class OrderAction extends Action
{
	public function updateOrder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$OrderId  =$decodedUser->OrderId;
		$ProviderName     =$decodedUser->ProviderName    ;
		$Pro_Name     =$decodedUser->Pro_Name    ;
		$DeliverAdr   =$decodedUser->DeliverAdr  ;
		$Buyer     =$decodedUser->Buyer    ;
		$Pro_Q	 =$decodedUser->Pro_Q	;
		$Time	 =$decodedUser->Time	;
		$Contact	 =$decodedUser->Contact	;
		$Pro_Gui	 =$decodedUser->Pro_Gui	;
		$DeadLine	 =$decodedUser->DeadLine	;
		$state		 =$decodedUser->state		;
		$Remark		 =$decodedUser->Remark		;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update OrderSheet set OrderId = '$OrderId',Pro_Name = '$Pro_Name',Pro_Q = '$Pro_Q'
					,Pro_Gui = '$Pro_Gui',Buyer = '$Buyer',Contact = '$Contact',DeliverAdr= '$DeliverAdr',DeadLine='$DeadLine',
				ProviderName = '$ProviderName',state = '$state',Time = '$Time',Remark = '$Remark'  where OrderId = '$OrderId';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Order.php');
		$order = new Order(
			$OrderId,
			$ProviderName,
			$Pro_Name,
			$DeliverAdr,
			$Buyer,
			$Pro_Q,
			$Time,
			$Contact,
			$Pro_Gui,
			$DeadLine,
			$state,
			$Remark
			);
		/*if ($r) {
			$user->state="ok";
		}
		else
		{
			$user->state="fail";
		}
		*/
		$foo_json = json_encode($order);
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
		$sqlExecute = "update users set 余额 = '$userYE' where 用户EPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.User.php');
		
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
	public function getAllOrder() {
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			/*$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,用户密码 as userPsw,真实姓名 as userRname,
					性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
					籍贯 as userJG,余额 as userYE,会员等级 as userLevel FROM users;";*/
					$sql = "SELECT * FROM OrderSheet where buyer='超市';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				/*$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,用户密码 as userPsw,真实姓名 as userRname,
						性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
						籍贯 as userJG,余额 as userYE,会员等级 as userLevel FROM users;";*/
						$sql = "SELECT * FROM OrderSheet where buyer='超市';";

			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Order.php');
			for($i=0;$i<count($list);$i++){
				$order = new Order(
					$list[$i]['OrderId'],
					$list[$i]['ProviderName'],
					$list[$i]['Pro_Name'],
					$list[$i]['DeliverAdr'],
					$list[$i]['Buyer'],
					$list[$i]['Pro_Q'],
					$list[$i]['Time'],
					$list[$i]['Contact'],
					$list[$i]['Pro_Gui'],
					$list[$i]['DeadLine'],
					$list[$i]['state'],
					$list[$i]['Remark']
					
					);
				//$user->state="ok";
				array_push($result,$order);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deleteorder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$OrderId=$decodedUser->OrderId;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from OrderSheet where OrderId = '$OrderId';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		if ($r) {
			echo "ok";
		}
		else
		{
			echo "fail";
		}
		/*require_once('class.Order.php');
		$order = new Order(
			$OrderId,
			$ProviderName,
			$Pro_Name,
			$DeliverAdr,
			$Buyer,
			$Pro_Q,
			$Time,
			$Contact,
			$Pro_Gui,
			$DeadLine,
			$state,
			$Remark
			);*/
		/*if ($r) {
			$user->state="ok";
		}
		else
		{
			$user->state="fail";
		}*/
		//$foo_json = json_encode($order);
		//echo $foo_json;
	}
	public function addOrrder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$OrderId =$decodedUser->OrderId;
		$ProviderName =$decodedUser->ProviderName    ;
		$Pro_Name =$decodedUser->Pro_Name    ;
		$DeliverAdr =$decodedUser->DeliverAdr  ;
		$Buyer  =$decodedUser->Buyer    ;
		$Pro_Q =$decodedUser->Pro_Q	;
		$Time  =$decodedUser->Time	;
		$Contact =$decodedUser->Contact	;
		$Pro_Gui =$decodedUser->Pro_Gui	;
		$DeadLine =$decodedUser->DeadLine	;
		$state	=$decodedUser->state		;
		$Remark	=$decodedUser->Remark		;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into OrderSheet
				values('$OrderId','$Pro_Name','$Pro_Q','$Pro_Gui','$Buyer','$Contact','$DeliverAdr','$DeadLine','$ProviderName','$state'
				,'$Time','$Remark');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Order.php');
		$order = new Order(
			$OrderId,
			$ProviderName,
			$Pro_Name,
			$DeliverAdr,
			$Buyer,
			$Pro_Q,
			$Time,
			$Contact,
			$Pro_Gui,
			$DeadLine,
			$state,
			$Remark
			
			);
		/*if ($r) {
			$user->state="ok";
		}
		else
		{
			$user->state="fail";
		}
		*/
		$foo_json = json_encode($order);
		echo $foo_json;
	}
	public function findOrder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$state=$decodedUser->state;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			$sql = "SELECT * FROM OrderSheet where state  = '$state';";
			}
			else if (C('DB_TYPE')== 'pdo') {
				$sql = "SELECT * FROM OrderSheet where state  = '$state';";
				}
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Order.php');
			for($i=0;$i<count($list);$i++){
				$order = new Order(
					$list[$i]['OrderId'],
					$list[$i]['ProviderName'],
					$list[$i]['Pro_Name'],
					$list[$i]['DeliverAdr'],
					$list[$i]['Buyer'],
					$list[$i]['Pro_Q'],
					$list[$i]['Time'],
					$list[$i]['Contact'],
					$list[$i]['Pro_Gui'],
					$list[$i]['DeadLine'],
					$list[$i]['state'],
					$list[$i]['Remark']
					
					);
				//$user->state="ok";
				array_push($result,$order);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}


	public function getorder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$OrderId = $decodedUser->OrderId;
		//$userEPC = $decodedUser->userEPC;
		//$userEPC = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			/*$sql = "SELECT OrderId as OrderId,用户EPC as userEPC,用户密码 as userPsw,真实姓名 as userRname,
						性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
						籍贯 as userJG,余额 as userYE,会员等级 as userLevel FROM users where 用户EPC = '$userEPC';";*/
						/*"SELECT OrderId as OrderId,Pro_Name as Pro_Name,DeliverAdr as DeliverAdr,
					Buyer as Buyer,Pro_Q as Pro_Q,Contact as Contact,Pro_Gui as Pro_Gui,state as state,Remark as Remark
					FROM OrderSheet where OrderId = '$OrderId';";*/
					$sql = "SELECT * FROM OrderSheet where OrderId = '$OrderId';";

			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				/*$sql = "SELECT 用户名称 as userName,用户EPC as userEPC,用户密码 as userPsw,真实姓名 as userRname,
						性别 as userSex,职业 as userJob,生日 as userBitrh,照片 as userPic,地址 as userAdd,电话 as userTel,
						籍贯 as userJG,余额 as userYE,会员等级 as userLevel FROM users where 用户EPC = '$userEPC';";*/
						/*"SELECT OrderId as OrderId,Pro_Name as Pro_Name,DeliverAdr as DeliverAdr,
					Buyer as Buyer,Pro_Q as Pro_Q,Contact as Contact,Pro_Gui as Pro_Gui,state as state,Remark as Remark
					FROM OrderSheet where OrderId = '$OrderId';";*/
					$sql = "SELECT * FROM OrderSheet where OrderId = '$OrderId';";

			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.Order.php');
			$order = new Order(
			$list[0]['OrderId'],
					$list[0]['ProviderName'],
					$list[0]['Pro_Name'],
					$list[0]['DeliverAdr'],
					$list[0]['Buyer'],
					$list[0]['Pro_Q'],
					$list[0]['Time'],
					$list[0]['Contact'],
					$list[0]['Pro_Gui'],
					$list[0]['DeadLine'],
					$list[0]['state'],
					$list[0]['Remark']
				//$list[0]['userTel'],
				//$list[0]['userJG'],
				//$list[0]['userYE'],
				//$list[0]['userLevel']
				);
			//$user->state="ok";
		}
		$foo_json = json_encode($order);
		
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
		echo "111";
		// $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
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