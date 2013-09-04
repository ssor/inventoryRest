<?php
// 本文档自动生成，仅供测试运行
class FProductAction extends Action
{

//http://localhost:9002/index.php/IntelligentMarket/FProduct/getAllFProduct
 
	public function getAllFProduct() {
		$M = new Model();					

		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select * from FProduct;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select * from FProduct;";
			}

		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.FProduct.php');
			for($i=0;$i<count($list);$i++){
				$p = new FProduct(
				$list[$i]['EPC'],
					$list[$i]['Pname'],
					$list[$i]['productPici'],
					$list[$i]['temputer'],
					$list[$i]['mature'],
					$list[$i]['startTime'],
				    $list[$i]['endTime'],
					$list[$i]['beiZhu'],
					$list[$i]['productState'],
					
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
	
	
	public function getFProductbyState()
	{
		$jsonInput = file_get_contents("php://input"); 
		//$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$orderState = $decodedUser->orderState;
		//$userEPC = "123";
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			
			$sql = "select * from FProduct where orderState = '$orderState';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
			$sql = "select * from FProduct where orderState = '$orderState';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.FProduct.php');
			for($i=0;$i<count($list);$i++){
				$p = new FProduct(
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
	
	
	
public function addFProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
	
		$decodedUser=json_decode($jsonInput);
		$EPC  =$decodedUser->EPC;
		$Pname     =$decodedUser->Pname    ;
		$productPici     =$decodedUser->productPici    ;
		$temputer   =$decodedUser->temputer  ;
		$mature     =$decodedUser->mature    ;
		$startTime	 =$decodedUser->startTime	;
		$endTime	 =$decodedUser->endTime	;
		$beiZhu	 =$decodedUser->beiZhu	;
		$productState	 =$decodedUser->productState	;
		$state	 =$decodedUser->state	;

		// 下面将数据添加到数据库中
		$sqlExecute = "insert into FProduct values('$EPC','$Pname','$productPici','$temputer','$mature','$startTime','$endTime','$beiZhu','$productState','$state');";
			 	/* echo $sqlExecute;
				return; */
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProduct.php');
		
		$FProduct = new FProduct(
			$EPC,
			$Pname,
			$productPici,
		
			$temputer,
			$mature,
			$startTime,
		
			$endTime,
			$beiZhu,
			$productState,
			$state
			
			);
			
			
		if ($r) {
			$FProduct->state="ok";
		}
		else
		{
			$FProduct->state="fail";
		}
		$foo_json = json_encode($FProduct);
		echo $foo_json;
	}
	public function updateFProduct()
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
		$sqlExecute = "update FProduct set orderID = '$orderID',Theorders = '$Theorders',prductName = '$prductName'
					,Number = '$Number',productCategory = '$productCategory',time = '$time',orderState= '$orderState',address='$address',
				beiZhu = '$beiZhu',state = '$state' where orderID = '$orderID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProduct.php');
		$FProduct = new FProduct(
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
			$FProduct->state="ok";
		}
		else
		{
			$FProduct->state="fail";
		}
		$foo_json = json_encode($FProduct);
		echo $foo_json;
	}
	public function updateFProducttate()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedUser=json_decode($jsonInput);
		$orderID  =$decodedUser->orderID;
		
		$orderState	 =$decodedUser->orderState	;
		
		
		
		
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update FProduct set orderID = '$orderID',Theorders = '$Theorders',prductName = '$prductName'
					,Number = '$Number',productCategory = '$productCategory',time = '$time',orderState= '$orderState',address='$address',
				beiZhu = '$beiZhu',state = '$state' where orderID = '$orderID';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.FProduct.php');
		$FProduct = new FProduct(
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
			$FProduct->state="ok";
		}
		else
		{
			$FProduct->state="fail";
		}
		$foo_json = json_encode($FProduct);
		echo $foo_json;
	}
	public function getFProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$EPC =	$decodedProduct->EPC;
				
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select* from FProduct 
					where EPC = '$EPC';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select* from FProduct 
					where EPC = '$EPC';";
			}
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.FProduct.php');
			$product = new FProduct(
				$EPC,
				$list[0]['Pname'],
				$list[0]['productPici'],
				$list[0]['temputer'],
				$list[0]['mature'],
				$list[0]['startTime'],
				$list[0]['endTime'],
				$list[0]['beiZhu'],
				$list[0]['productState'],
				$list[0]['state']
				);			
			$product->state="ok";
		}
		$foo_json = json_encode($product);
		
		echo $foo_json;
		return;				
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