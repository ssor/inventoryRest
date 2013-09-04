<?php
// 本文档自动生成，仅供测试运行
class FProductcategoryAction extends Action
{

	public function addFProductcategory()
	{

		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFProductcategory=json_decode($jsonInput);
		
	 	$FPname  =$decodedFProductcategory->FPname;
		$FPid   =$decodedFProductcategory->FPid    ;
		$FPfactory   =$decodedFProductcategory->FPfactory    ;
		$FPcatrgory   =$decodedFProductcategory->FPcatrgory  ;
		$safeinventory   =$decodedFProductcategory->safeinventory  ;
		$BZ   =$decodedFProductcategory->BZ  ;
		$state=$decodedFProductcategory->state;

		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into FProductcategory values('$FPname','$FPid','$FPfactory','$FPcatrgory','$safeinventory',$BZ );";
				
			
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProductcategory.php');
		$FProductcategory = new FProductcategory(
			$FPname,
			$FPid,
			$FPfactory,
			$FPcatrgory,
            $state
			);
		if ($r) {
			$FProductcategory->state="ok";
		}
		else
		{
			$FProductcategory->state="fail";
		}
		$foo_json = json_encode($FProductcategory);
		echo $foo_json; 
	}
	public function updateFProductcategory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFProductcategory=json_decode($jsonInput);
		$FPname  =$decodedFProductcategory->FPname;
		$FPid     =$decodedFProductcategory->FPid    ;
		$FPfactory     =$decodedFProductcategory->FPfactory    ;
		$FPcatrgory   =$decodedFProductcategory->FPcatrgory  ;
		$state=$decodedFProductcategory->state  ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FProductcategory set FPid = '$FPid',FPfactory = '$FPfactory',FPcatrgory = '$FPcatrgory' where FPname = '$FPname';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProductcategory.php');
		$FProductcategory = new FProductcategory(
			$FPname,
			$FPid,
			$FPfactory,
			$FPcatrgory,
			$state
			);
		if ($r) {
			$FProductcategory->state="ok";
		}
		else
		{
			$FProductcategory->state="fail";
		}
		$foo_json = json_encode($FProductcategory);
		echo $foo_json;
	}
	public function getFProductcategory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFProductcategory=json_decode($jsonInput);
		$FPid = $decodedFProductcategory->FPid;
		//$FPid = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT 用户名称 as FPname,用户EPC as FPid,用户密码 as FPfactory,真实姓名 as FPcatrgory,
					性别 as FPnameex,职业 as FProductcategoryJob,生日 as FProductcategoryBitrh,照片 as FProductcategoryPic,地址 as FProductcategoryAdd,电话 as FProductcategoryTel,
					籍贯 as FProductcategoryJG,余额 as FProductcategoryYE,会员等级 as FProductcategoryLevel FROM FPname where 用户EPC = '$FPid';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT 用户名称 as FPname,用户EPC as FPid,用户密码 as FPfactory,真实姓名 as FPcatrgory,
						性别 as FPnameex,职业 as FProductcategoryJob,生日 as FProductcategoryBitrh,照片 as FProductcategoryPic,地址 as FProductcategoryAdd,电话 as FProductcategoryTel,
						籍贯 as FProductcategoryJG,余额 as FProductcategoryYE,会员等级 as FProductcategoryLevel FROM FPname where 用户EPC = '$FPid';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.FProductcategory.php');
			$FProductcategory = new FProductcategory(
				$list[0]['FPname'],
				$list[0]['FPid'],
				$list[0]['FPfactory'],
				$list[0]['FPcatrgory'],
				$list[0]['FPnameex'],
				$list[0]['FProductcategoryJob'],
				$list[0]['FProductcategoryBitrh'],
				$list[0]['FProductcategoryPic'],
				$list[0]['FProductcategoryAdd'],
				$list[0]['FProductcategoryTel'],
				$list[0]['FProductcategoryJG'],
				$list[0]['FProductcategoryYE'],
				$list[0]['FProductcategoryLevel']
				);
			$FProductcategory->state="ok";
		}
		$foo_json = json_encode($FProductcategory);
		
		echo $foo_json;
		return;		
	}
	public function deleteFProductcategory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFProductcategory=json_decode($jsonInput);
		$FPname  =$decodedFProductcategory->FPname;
		$FPid     =$decodedFProductcategory->FPid    ;
		$FPfactory     =$decodedFProductcategory->FPfactory    ;
		$FPcatrgory   =$decodedFProductcategory->FPcatrgory  ;
		$FPnameex     =$decodedFProductcategory->FPnameex    ;
		$FProductcategoryJob	 =$decodedFProductcategory->FProductcategoryJob	;
		$FProductcategoryBitrh	 =$decodedFProductcategory->FProductcategoryBitrh	;
		$FProductcategoryPic	 =$decodedFProductcategory->FProductcategoryPic	;
		$FProductcategoryAdd	 =$decodedFProductcategory->FProductcategoryAdd	;
		$FProductcategoryTel	 =$decodedFProductcategory->FProductcategoryTel	;
		$FProductcategoryJG		 =$decodedFProductcategory->FProductcategoryJG		;
		$FProductcategoryYE		 =$decodedFProductcategory->FProductcategoryYE		;
		$FProductcategoryLevel   =$decodedFProductcategory->FProductcategoryLevel  ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from FPname where 用户EPC = '$FPid';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProductcategory.php');
		$FProductcategory = new FProductcategory(
			$FPname,
			$FPid,
			$FPfactory,
			$FPcatrgory,
			$FPnameex,
			$FProductcategoryJob,
			$FProductcategoryBitrh,
			$FProductcategoryPic,
			$FProductcategoryAdd,
			$FProductcategoryTel,
			$FProductcategoryJG,
			$FProductcategoryYE,
			$FProductcategoryLevel
			);
		if ($r) {
			$FProductcategory->state="ok";
		}
		else
		{
			$FProductcategory->state="fail";
		}
		$foo_json = json_encode($FProductcategory);
		echo $foo_json;
	}
	public function getAllFProductcategory() {
		$M = new Model();					
	
			// sqlserver
			$sql = "SELECT  FPname, FPid, FPfactory, FPcatrgory, state FROM FProductcategory;";
		
		$list = $M->query($sql);
	
		 $result = array();
		if (count($list)>0) {
			require_once('class.FProductcategory.php');
			for($i=0;$i<count($list);$i++){
				$FProductcategory = new FProductcategory(
					$list[$i]['FPname'],
					$list[$i]['FPid'],
					$list[$i]['FPfactory'],
					$list[$i]['FPcatrgory'],
					$list[$i]['state']
					);
				$FProductcategory->state="ok";
				array_push($result,$FProductcategory);
			}
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