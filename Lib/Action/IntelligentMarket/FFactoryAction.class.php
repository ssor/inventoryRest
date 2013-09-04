<?php
// 本文档自动生成，仅供测试运行
class FFactoryAction extends Action
{

	public function addFFactory()
	{
  
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFFactory=json_decode($jsonInput);
		
	 	$FFname  =$decodedFFactory->FFname;
		$FFid   =$decodedFFactory->FFid    ;
		$FLrepresentative   =$decodedFFactory->FLrepresentative    ;
		$FFcatrgory   =$decodedFFactory->FFcatrgory  ;
		$FFphone   =$decodedFFactory->FFphone  ;
		$FFaddress   =$decodedFFactory->FFaddress  ;
		$state=$decodedFFactory->state;

		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into FFactory values('$FFname','$FFid','$FLrepresentative','$FFcatrgory','$FFphone','$FFaddress','$state');";
			
			
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FFactory.php');
		$FFactory = new FFactory(
			$FFname,
			$FFid,
			$FLrepresentative,
			$FFcatrgory,
			$FFphone,
			$FFaddress,
            $state
			);
		if ($r) {
			$FFactory->state="ok";
		}
		else
		{
			$FFactory->state="fail";
		}
		$foo_json = json_encode($FFactory);
		echo $foo_json; 
	}
	public function updateFFactory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFFactory=json_decode($jsonInput);
		$FFname  =$decodedFFactory->FFname;
		$FFid     =$decodedFFactory->FFid    ;
		$FLrepresentative     =$decodedFFactory->FLrepresentative    ;
		$FFcatrgory   =$decodedFFactory->FFcatrgory  ;
		$state=$decodedFFactory->state  ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FFactory set FFid = '$FFid',FLrepresentative = '$FLrepresentative',FFcatrgory = '$FFcatrgory' where FFname = '$FFname';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FFactory.php');
		$FFactory = new FFactory(
			$FFname,
			$FFid,
			$FLrepresentative,
			$FFcatrgory,
			$state
			);
		if ($r) {
			$FFactory->state="ok";
		}
		else
		{
			$FFactory->state="fail";
		}
		$foo_json = json_encode($FFactory);
		echo $foo_json;
	}
	public function getFFactory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFFactory=json_decode($jsonInput);
		$FFid = $decodedFFactory->FFid;
		//$FFid = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "SELECT 用户名称 as FFname,用户EPC as FFid,用户密码 as FLrepresentative,真实姓名 as FFcatrgory,
					性别 as FFnameex,职业 as FFactoryJob,生日 as FFactoryBitrh,照片 as FFactoryPic,地址 as FFactoryAdd,电话 as FFactoryTel,
					籍贯 as FFactoryJG,余额 as FFactoryYE,会员等级 as FFactoryLevel FROM FFname where 用户EPC = '$FFid';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "SELECT 用户名称 as FFname,用户EPC as FFid,用户密码 as FLrepresentative,真实姓名 as FFcatrgory,
						性别 as FFnameex,职业 as FFactoryJob,生日 as FFactoryBitrh,照片 as FFactoryPic,地址 as FFactoryAdd,电话 as FFactoryTel,
						籍贯 as FFactoryJG,余额 as FFactoryYE,会员等级 as FFactoryLevel FROM FFname where 用户EPC = '$FFid';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.FFactory.php');
			$FFactory = new FFactory(
				$list[0]['FFname'],
				$list[0]['FFid'],
				$list[0]['FLrepresentative'],
				$list[0]['FFcatrgory'],
				$list[0]['FFnameex'],
				$list[0]['FFactoryJob'],
				$list[0]['FFactoryBitrh'],
				$list[0]['FFactoryPic'],
				$list[0]['FFactoryAdd'],
				$list[0]['FFactoryTel'],
				$list[0]['FFactoryJG'],
				$list[0]['FFactoryYE'],
				$list[0]['FFactoryLevel']
				);
			$FFactory->state="ok";
		}
		$foo_json = json_encode($FFactory);
		
		echo $foo_json;
		return;		
	}
	public function deleteFFactory()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedFFactory=json_decode($jsonInput);
		$FFname  =$decodedFFactory->FFname;
		$FFid     =$decodedFFactory->FFid    ;
		$FLrepresentative     =$decodedFFactory->FLrepresentative    ;
		$FFcatrgory   =$decodedFFactory->FFcatrgory  ;
		$FFnameex     =$decodedFFactory->FFnameex    ;
		$FFactoryJob	 =$decodedFFactory->FFactoryJob	;
		$FFactoryBitrh	 =$decodedFFactory->FFactoryBitrh	;
		$FFactoryPic	 =$decodedFFactory->FFactoryPic	;
		$FFactoryAdd	 =$decodedFFactory->FFactoryAdd	;
		$FFactoryTel	 =$decodedFFactory->FFactoryTel	;
		$FFactoryJG		 =$decodedFFactory->FFactoryJG		;
		$FFactoryYE		 =$decodedFFactory->FFactoryYE		;
		$FFactoryLevel   =$decodedFFactory->FFactoryLevel  ;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from FFname where 用户EPC = '$FFid';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FFactory.php');
		$FFactory = new FFactory(
			$FFname,
			$FFid,
			$FLrepresentative,
			$FFcatrgory,
			$FFnameex,
			$FFactoryJob,
			$FFactoryBitrh,
			$FFactoryPic,
			$FFactoryAdd,
			$FFactoryTel,
			$FFactoryJG,
			$FFactoryYE,
			$FFactoryLevel
			);
		if ($r) {
			$FFactory->state="ok";
		}
		else
		{
			$FFactory->state="fail";
		}
		$foo_json = json_encode($FFactory);
		echo $foo_json;
	}
	public function getAllFFactory() {
		$M = new Model();					
	
			// sqlserver
			$sql = "SELECT  FFname, FFid, FLrepresentative, FFcatrgory, FFphone,FFaddress,state FROM FFactory;";
		
		$list = $M->query($sql);
	
		 $result = array();
		if (count($list)>0) {
			require_once('class.FFactory.php');
			for($i=0;$i<count($list);$i++){
				$FFactory = new FFactory(
					$list[$i]['FFname'],
					$list[$i]['FFid'],
					$list[$i]['FLrepresentative'],
					$list[$i]['FFcatrgory'],
					$list[$i]['FFphone'],
					$list[$i]['FFaddress'],
					$list[$i]['state']	
			
					);
				$FFactory->state="ok";
				array_push($result,$FFactory);
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