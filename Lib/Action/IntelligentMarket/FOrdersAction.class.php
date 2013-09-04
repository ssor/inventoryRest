<?php
// 本文档自动生成，仅供测试运行
class FOrdersAction extends Action
{

//http://localhost:9002/index.php/IntelligentMarket/FOrders/getAllFOrders
 
	public function getAllFOrders() {
		$M = new Model();					

		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select * from FOrders;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select * from FOrders;";
			}

		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.FOrders.php');
			for($i=0;$i<count($list);$i++){
				$p = new FOrders(
					$list[$i]['orderID'],
					$list[$i]['Theorders'],
					$list[$i]['prductName'],
					$list[$i]['Number'],
					$list[$i]['productCategory'],
				    $list[$i]['time'],
					$list[$i]['orderState'],
					$list[$i]['address'],
					$list[$i]['beiZhu'],
					$list[$i]['state']
					);
					
					
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	
	
	public function getFOrdersbyState()
	{
		$jsonInput = file_get_contents("php://input"); 
		//$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$orderState = $decodedUser->orderState;
		//$userEPC = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			
			$sql = "select * from FOrders where orderState = '$orderState';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
			$sql = "select * from FOrders where orderState = '$orderState';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.FOrders.php');
			for($i=0;$i<count($list);$i++){
				$p = new FOrders(
					$list[$i]['orderID'],
					$list[$i]['Theorders'],
					$list[$i]['prductName'],
					$list[$i]['Number'],
					$list[$i]['productCategory'],
				    $list[$i]['time'],
					$list[$i]['orderState'],
					$list[$i]['address'],
					$list[$i]['beiZhu'],
					$list[$i]['state']
					);
				$p->state="ok";
				array_push($result,$p);
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
	
	
	
public function addFOrders()
	{
		$jsonInput = file_get_contents("php://input"); 
	
		$decodedUser=json_decode($jsonInput);
		$orderID  =$decodedUser->orderID;
		$Theorders     =$decodedUser->Theorders    ;
		$prductName     =$decodedUser->prductName    ;
		$Number   =$decodedUser->Number  ;
		$productCategory     =$decodedUser->productCategory    ;
		$time	 =$decodedUser->time	;
		$orderState	 =$decodedUser->orderState	;
		$address	 =$decodedUser->address	;
		$beiZhu	 =$decodedUser->beiZhu	;
		$state	 =$decodedUser->state	;
		
		
		
		
		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into FOrders
				values('$orderID','$Theorders','$prductName','$Number','$productCategory','$time','$orderState','$address','$beiZhu','$state');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FOrders.php');
		
		$FOrders = new FOrders(
			$orderID,
			$Theorders,
			$prductName,
		
			$Number,
			$productCategory,
			$time,
		
			$orderState,
			$address,
			$beiZhu,
			$state
			
			);
		if ($r) {
			$FOrders->state="ok";
		}
		else
		{
			$FOrders->state="fail";
		}
		$foo_json = json_encode($FOrders);
		echo $foo_json;
	}
	public function updateFOrders()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$orderID  =$decodedUser->orderID;
		$Theorders     =$decodedUser->Theorders    ;
		$prductName     =$decodedUser->prductName    ;

		$Number   =$decodedUser->Number  ;
		$productCategory =$decodedUser->productCategory  ;
		$time     =$decodedUser->time    ;
		$orderState	 =$decodedUser->orderState	;
		$address	 =$decodedUser->address	;
		$beiZhu	 =$decodedUser->beiZhu	;
		$state	 =$decodedUser->state	;
		
		
		
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FOrders set orderID = '$orderID',Theorders = '$Theorders',prductName = '$prductName'
					,Number = '$Number',productCategory = '$productCategory',time = '$time',orderState= '$orderState',address='$address',
				beiZhu = '$beiZhu',state = '$state' where orderID = '$orderID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FOrders.php');
		$FOrders = new FOrders(
			$orderID,
			$Theorders,
			$prductName,
		
			$Number,
			$productCategory,
			$time,
		
			$orderState,
			$address,
			$beiZhu,
			$state
			);
		if ($r) {
			$FOrders->state="ok";
		}
		else
		{
			$FOrders->state="fail";
		}
		$foo_json = json_encode($FOrders);
		echo $foo_json;
	}
	public function updateFOrderState()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$orderID  =$decodedUser->orderID;
		
		$orderState	 =$decodedUser->orderState	;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FOrders set orderID = '$orderID',Theorders = '$Theorders',prductName = '$prductName'
					,Number = '$Number',productCategory = '$productCategory',time = '$time',orderState= '$orderState',address='$address',
				beiZhu = '$beiZhu',state = '$state' where orderID = '$orderID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FOrders.php');
		$FOrders = new FOrders(
			$orderID,
			$Theorders,
			$prductName,
		
			$Number,
			$productCategory,
			$time,
		
			$orderState,
			$address,
			$beiZhu,
			$state
			);
		if ($r) {
			$FOrders->state="ok";
		}
		else
		{
			$FOrders->state="fail";
		}
		$foo_json = json_encode($FOrders);
		echo $foo_json;
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