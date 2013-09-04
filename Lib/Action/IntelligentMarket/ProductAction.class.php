<?php
// 本文档自动生成，仅供测试运行
class ProductAction extends Action
{
	public function updateProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$productEPC = $decodedProduct->productEPC;
		$productName = $decodedProduct->productName;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update Product set productName = '$productName' where productEPC = '$productEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Product.php');
		$p = new Product($productEPC,$productName);
		if ($r) {
			$p->state="ok";
		}
		else
		{
			$p->state="fail";
		}
		$foo_json = json_encode($p);
		echo $foo_json;
	}
	public function getAllProducts() {
		$M = new Model();					
		
	
			$sql = "select productEPC , productName from Product";
			
	
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Product.php');
			for($i=0;$i<count($list);$i++){
				$p = new Product(
					$list[$i]['productEPC'],
					$list[$i]['productName']
					);
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function getAllProductsbyName() {
		
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		
		$M = new Model();					
		
	
			$sql = "select productEPC , productName from Product where productName='$jsonInput'";
			
	
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Product.php');
			for($i=0;$i<count($list);$i++){
				$p = new Product(
					$list[$i]['productEPC'],
					$list[$i]['productName']
					);
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function getProductsNumber() {
	    
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		
		$productName = $decodedProduct->productName;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select * from Product where productName = '$productName'"; 

			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select * from Product where productName = '$productName'"; 
			}
		
	  
	   $list = $M->query($sql);
		
		
	   
	   echo count($list);
		
	}
	public function getSoldProductsNumber() {
	    
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		
		$productName = $decodedProduct->productName;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select * from payBill where productName = '$productName'"; 
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select * from payBill where productName = '$productName'"; 
			}
		
	  
	   $list = $M->query($sql);
		
		
	   
	   echo count($list);
		
	}
	public function deleteProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		//var_dump($decodedProduct);
		//return;
		
		$productEPC = $decodedProduct->productEPC;
		$productName = $decodedProduct->productName;
		// echo $productEPC;
		// return;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from Product where  productEPC = '$productEPC';";
		// echo $sqlExecute;
		// return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Product.php');
		$p = new Product($productEPC,$productName);
		if ($r) {
			$p->state="ok";
		}
		else
		{
			$p->state="fail";
		}
		$foo_json = json_encode($p);
		echo $foo_json;
	}
	public function addProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$productEPC = $decodedProduct->productEPC;
		$productName = $decodedProduct->productName;
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into Product(productEPC,productName) values('$productEPC','$productName');";
		//echo $sqlExecute;
		//return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Product.php');
		$p = new Product($productEPC,$productName);
		if ($r) {
			$p->state="ok";
		}
		else
		{
			$p->state="fail";
		}
		$foo_json = json_encode($p);
		echo $foo_json;
	}
	public function getProductEPCByName()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$productName = $decodedProduct;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productEPC from Product where  productName = '$productName';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productEPC from Product where  productName = '$productName';";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Product.php');
			for	($i=0;$i<count($list);$i++)
			{
				$p = new Product(
					$list[$i]['productEPC'],
					$productName
					);
				$p->state="ok";	
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}	
	public function getProductNameByEPC()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$productEPC = $decodedProduct->productEPC;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productName from Product where productEPC = '$productEPC';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productName from Product where productEPC = '$productEPC';";
			}
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.Product.php');
			$p = new Product(
				$productEPC,
				$list[0]['productName']
				);
			$p->state="ok";
		}
		$foo_json = json_encode($p);
		
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