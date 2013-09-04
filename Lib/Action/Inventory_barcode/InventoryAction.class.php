<?php

class InventoryAction extends Action
{
	//盘亏
	public function getInventoryResult_less()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTags=json_decode($jsonInput);
		$tags="";
		for($i=0;$i<count($decodedTags);$i++)
		{
			$tagID = $decodedTags[$i];
			$tags.=	$tagID->tag;
			if ($i < count($decodedTags)-1) {
				$tags.=	",";
			}
		}
		$sqlSelect = "select productID,productName,produceDate
				,productCategory,descript from tbProduct_barcode where 
				productID in($tags);";
		
		$M = new Model();					
		$list = $M->query($sqlSelect);
		$result = array();
		require_once('class.Product.php');
		for($i = 0;$i < count($list);$i++)
		{				
			$product = new Product(
				$list[$i]['productID'],
				$list[$i]['productName'],
				$list[$i]['produceDate'],
				$list[$i]['productCategory'],
				$list[$i]['descript']
				);
			array_push($result,$product);
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	//盘盈
	public function getInventoryResult_more()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTags=json_decode($jsonInput);
		$tags="";
		for($i=0;$i<count($decodedTags);$i++)
		{
			$tagID = $decodedTags[$i];
			$tags.=	$tagID->tag;
			if ($i < count($decodedTags)-1) {
				$tags.=	",";
			}
		}
		$sqlSelect = "select productID,productName,produceDate
				,productCategory,descript from tbProduct_barcode where 
				productID in($tags);";
		$M = new Model();					
		
		$list = $M->query($sqlSelect);
		$result = array();
		require_once('class.Product.php');
		for($i = 0;$i < count($list);$i++)
		{				
			$product = new Product(
				$list[$i]['productID'],
				$list[$i]['productName'],
				$list[$i]['produceDate'],
				$list[$i]['productCategory'],
				$list[$i]['descript']
				);
			array_push($result,$product);
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	//物账相符
	public function getInventoryResult_equal()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTags=json_decode($jsonInput);
		$tags="";
		for($i=0;$i<count($decodedTags);$i++)
		{
			$tagID = $decodedTags[$i];
			$tags.=	$tagID->tag;
			if ($i < count($decodedTags)-1) {
				$tags.=	",";
			}
		}
		$sqlSelect = "select productID,productName,produceDate
				,productCategory,descript from tbProduct_barcode where 
				productID in($tags);";
		$M = new Model();					
		
		$list = $M->query($sqlSelect);
		$result = array();
		require_once('class.Product.php');
		for($i = 0;$i < count($list);$i++)
		{				
			$product = new Product(
				$list[$i]['productID'],
				$list[$i]['productName'],
				$list[$i]['produceDate'],
				$list[$i]['productCategory'],
				$list[$i]['descript']
				);
			array_push($result,$product);
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
		
	}
	//获取待出库单产品信息，暂时定义为获取订单信息
	public function getProductList4deleteProductFromStorage()
	{
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productName ,productQuantity from tbOrder_barcode;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productName ,productQuantity from tbOrder_barcode;";
			}
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Order.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$order = new Order(
					$list[$i]['productName'],
					$list[$i]['productQuantity']
					);
				$order->state="ok";
				array_push($result,$order);
			}				
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	//获取准备入库的产品信息
	public function getPreProListToStorage()
	{
//		$para = $_GET['para'];
//		if (empty($para)) {
//			echo 'false';
//			return;
//		}
		$sqlSelect = "select productID ,productName ,produceDate 
				,productCategory,descript  from tbProduct_barcode where 
				productStatus = '0';";
		$M = new Model();					
		$list = $M->query($sqlSelect);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.Product.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$product = new Product(
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				//var_dump($product);
				//return;
				array_push($result,$product);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
		
	}
	//出库
	public function deleteProductFromStorage()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProducts=json_decode($jsonInput);
		$result = array();
		if (count($decodedProducts)>0) {
			require_once('class.Product.php');
			$M1 = new Model();
			$M2 = new Model();
			for($i=0;$i<count($decodedProducts);$i++)
			{
				$product = $decodedProducts[$i];
				$productID = $product->productID;
				$datetime = $product->produceDate;
				$sqlUpdate = "update tbProduct_barcode set productStatus = '2' where productID = '$productID';";
				$sqlInsert = "insert into tbProductOutInventory_barcode(productID,productName,produceDate,productCategory,descript,OutDate)
                 select productID,productName,produceDate,productCategory,descript, '$datetime' from tbProduct_barcode  where productID = '$productID'";
				$product = new Product(
					$product->productID,
					$product->productName,
					$product->produceDate,
					$product->productCategory,
					$product->descript
					);
				$r1 = $M1->execute($sqlUpdate);
				$r2 = $M2->execute($sqlInsert);
				if ($r1 && $r2) {
					$product->state="ok";
				}
				else
				{
					$product->state="fail";
				}
				array_push($result,$product);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;	
	}
	//入库
	public function addProductToStorage()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProducts=json_decode($jsonInput);
		$result = array();
		if (count($decodedProducts)>0) {
			require_once('class.Product.php');
			$M = new Model();
			for($i=0;$i<count($decodedProducts);$i++)
			{
				$product = $decodedProducts[$i];
				$productID = $product->productID;
				$sqlUpdate = "update tbProduct_barcode set productStatus = '1' where productID = '$productID';";
				$product = new Product(
					$product->productID,
					$product->productName,
					$product->produceDate,
					$product->productCategory,
					$product->descript
					);
				$r = $M->execute($sqlUpdate);
				if ($r) {
					$product->state="ok";
				}
				else
				{
					$product->state="fail";
				}
				array_push($result,$product);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;	
	}
	//将扫描到的标签添加到数据库中
	//添加标签时有三个属性
	//1 标签ID
	//2 添加时间
	//3 添加标签的目的，例如出库入库或者盘点等等
	public function addScanTag()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedTag=json_decode($jsonInput);
		$cmd = $decodedTag->cmd;
		$time = $decodedTag->startTime;
		$tag = $decodedTag->tag;
		
		$sqlExecute = "insert into tbRfidScanTemp(tagID,flag,timeTamp) values('$tag','$cmd','$time');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		if ($r) {
			echo "ok";
		}
		else
		{
			echo "fail";
		}
	}
	// 获取扫描到的标签
	// 可以根据时间和添加标签时附带的目的属性筛选
	public function getScanTags()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$cmd = $decodedProduct->cmd;
		$time = $decodedProduct->startTime;
		
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select tagID,flag,timeTamp from tbRfidScanTemp where flag = '$cmd' and timeTamp > '$time' order by timeTamp asc;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select tagID,flag,timeTamp from tbRfidScanTemp where flag = '$cmd' and timeTamp > '$time' order by timeTamp asc;";
				
			}
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.tagID.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$tag = new tagID(
					$list[$i]['tagID'],
					$list[$i]['timeTamp'],
					$cmd
					);
				array_push($result,$tag);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;	
	}
	
	//新增产品信息
	public function addProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		//		$pID = $decodedProduct->productID;
		//		$pName = $decodedProduct->productName;
		//		$pDate = $decodedProduct->produceDate;
		//		$pCategory = $decodedProduct->productCategory;
		//		$pDescript = $decodedProduct->descript;
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into tbProduct_barcode(productID,productName,produceDate,productCategory,descript)
				values('".$decodedProduct->productID."','".$decodedProduct->productName."','".
			$decodedProduct->produceDate."','".$decodedProduct->productCategory."','".$decodedProduct->descript."');";
		//		$sqlExecute = "insert into tbProduct_barcode(productID,productName,produceDate,productCategory,descript)
		//				values('$pID','$pName','$pDate','$pCategory','$pDescript');";
		//echo $sqlExecute;
		//return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Product.php');
		$product = new Product(
			$decodedProduct->productID,
			$decodedProduct->productName,
			$decodedProduct->produceDate,
			$decodedProduct->productCategory,
			$decodedProduct->descript,
			$decodedProduct->state
			);		
		if ($r) {
			$product->state="ok";
		}
		else
		{
			$product->state="fail";
		}
		$foo_json = json_encode($product);
		echo $foo_json;
	}
	//删除产品信息
	public function deleteProduct() {
		
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$pID = $decodedProduct->productID;
		
		$pID = $decodedProduct->productID;
		$pName = $decodedProduct->productName;
		$pDate = $decodedProduct->produceDate;
		$pCategory = $decodedProduct->productCategory;
		$pDescript = $decodedProduct->descript;
		// 下面将数据添加到数据库中
		require_once('class.Product.php');
		$product = new Product(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from tbProduct_barcode where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$product->state="记录不存在";
			$foo_json = json_encode($product);
			echo $foo_json;
			return;
		}
		$sqlDelete = "delete from tbProduct_barcode where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlDelete);
		if ($r) {
			$product->state="ok";
		}
		else
		{
			$product->state="fail";
		}
		$foo_json = json_encode($product);
		echo $foo_json;
	}
	//更新产品信息
	public function updateProduct() {
		
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$pID = $decodedProduct->productID;
		
		$pID = $decodedProduct->productID;
		$pName = $decodedProduct->productName;
		$pDate = $decodedProduct->produceDate;
		$pCategory = $decodedProduct->productCategory;
		$pDescript = $decodedProduct->descript;
		// 下面将数据添加到数据库中
		require_once('class.Product.php');
		$product = new Product(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from tbProduct_barcode where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$product->state="记录不存在";
			$foo_json = json_encode($product);
			echo $foo_json;
			return;
		}
		$sqlUpdate = "update tbProduct_barcode set productName='$pName',produceDate = '$pDate'
				,productCategory = '$pCategory',descript = '$pDescript'
				where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlUpdate);
		if ($r) {
			$product->state="ok";
		}
		else
		{
			$product->state="fail";
		}
		$foo_json = json_encode($product);
		echo $foo_json;
	}
	//获取所有产品信息
	public function getAllProducts()
	{
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productID,productName,produceDate
					,productCategory,descript from tbProduct_barcode where 
					productStatus = '0';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productID,productName,produceDate
						,productCategory,descript from tbProduct_barcode where 
						productStatus = '0';";
			}
		$M = new Model();					
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.Product.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$product = new Product(
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				//var_dump($product);
				//return;
				array_push($result,$product);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
	}
	// 获取具体的产品信息
	public function getProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$productID = $decodedProduct->productID;
		$sqlSelect = "select productID,productName,produceDate
				,productCategory,descript from tbProduct_barcode where 
				 productID = '$productID';";
		//echo $sqlSelect;
		//return;
		$M = new Model();					
		$list = $M->query($sqlSelect);
		require_once('class.Product.php');
		//$product = '';
		if (count($list)>0) {
			$product = new Product(
				$list[0]['productID'],
				$list[0]['productName'],
				$list[0]['produceDate'],
				$list[0]['productCategory'],
				$list[0]['descript']
				);
			$product->state='ok';
		}
		else
		{
			$product = new Product(
				$productID,
				'',
				'',
				'',
				''
				);
			$product->state='failed';
		}
		$foo_json = json_encode($product);
		
		echo $foo_json;
	}
	//获取盘点物资列表
	public function getProductInfoForInventoryList()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedPara = json_decode($jsonInput);

		$sqlSelect = "select  productID,productName,produceDate
				,productCategory,descript from tbProduct_barcode where 
				productStatus = '1' ;";
		$M = new Model();
		$result = array();
		$list = $M->query($sqlSelect);
		if (count($list)>0) {
			require_once('class.Product.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$product = new Product(
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				array_push($result,$product);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
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
	//测试用函数
	public function functionTest()
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