<?php

class ProductNameAction extends Action
{
	public function addProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedProduct=json_decode($jsonInput);
		// 下面将数据添加到数据库中
		
		$decodedProduct->state="ok";
		
		require_once('class.Product.php');
		$product = new Product(
			$decodedProduct->productID,
			$decodedProduct->productName,
			$decodedProduct->produceDate,
			$decodedProduct->productCategory,
			$decodedProduct->descript,
			$decodedProduct->state
			);
		$foo_json = json_encode($product);
		echo $foo_json;
	}
	public function getAllProductName()
	{
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productName from tbProductName_barcode;";
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productName from tbProductName_barcode;";
			}
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.ProductName.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$productName = new ProductName(
					$list[$i]['productName']
					);
				array_push($result,$productName);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
	}
	//移动终端依据终端编号通过web服务获取盘点物资列表
	public function getProductInfoList()
	{
		$id = $_GET['id'];
		if (empty($id)) {
			echo 'false';
			return;
		}
		
		$jsonInput = file_get_contents("php://input"); 
		$decodedCarPoint = json_decode($jsonInput);
		$carid = $decodedCarPoint->strCarID;
		$carid=$this->checkUTF8($carid);
		
		date_default_timezone_set("Asia/Shanghai");
		$time= date("Y-m-d H:i:s");
		$latitude = $decodedCarPoint->strLatitude;
		$longitude = $decodedCarPoint->strLongitude;
		$sqlExecute = "insert into T_CARPOINTS(CAR_ID ,CREATE_TIME ,LATITUDE ,LONGITUDE )
				values( '$carid' ,'$time' ,'$latitude' ,'$longitude' );";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		if ($r) {
			echo 'true';
		}
		else
		{
			echo 'false';
		}
		
		return;
	}
	//电脑终端依据时间通过web服务获取物资标签
	public function getInventoryInfoList()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedCarPoint = json_decode($jsonInput);
		$carid = $decodedCarPoint->strCarID;
		$carid=$this->checkUTF8($carid);
		
		date_default_timezone_set("Asia/Shanghai");
		$time= date("Y-m-d H:i:s");
		$latitude = $decodedCarPoint->strLatitude;
		$longitude = $decodedCarPoint->strLongitude;
		$sqlExecute = "insert into T_CARPOINTS(CAR_ID ,CREATE_TIME ,LATITUDE ,LONGITUDE )
				values( '$carid' ,'$time' ,'$latitude' ,'$longitude' );";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		if ($r) {
			echo 'true';
		}
		else
		{
			echo 'false';
		}
		
		return;
	}
	//移动终端通过web服务将盘点信息发送到服务器，信息中包含时间
	// [{"a":1,"b":2},{"a":3,"b":4}]
	public function postInventoryInfoList()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedList = json_decode($jsonInput);
		var_dump($decodedList);
		// $carid = $decodedCarPoint->strCarID;
		// $carid=$this->checkUTF8($carid);
		
		// date_default_timezone_set("Asia/Shanghai");
		// $time= date("Y-m-d H:i:s");
		// $latitude = $decodedCarPoint->strLatitude;
		// $longitude = $decodedCarPoint->strLongitude;
		// $sqlExecute = "insert into T_CARPOINTS(CAR_ID ,CREATE_TIME ,LATITUDE ,LONGITUDE )
		// values( '$carid' ,'$time' ,'$latitude' ,'$longitude' );";
		// $M = new Model();
		// $r = $M->execute($sqlExecute);
		// if ($r) {
		// echo 'true';
		// }
		// else
		// {
		// echo 'false';
		// }
		
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