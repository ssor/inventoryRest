<?php

class rkProductAction extends Action
{
	public function addrkProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$pDescript = $decodedProduct->ckID;
				$pID = $decodedProduct->productID;
				$pName = $decodedProduct->productName;
				$pDate = $decodedProduct->produceDate;
				$pCategory = $decodedProduct->productCategory;
				$pDescript = $decodedProduct->descript;
		//下面将数据添加到数据库中
		// $sqlExecute = "insert into rkProduct(ckID,productID,productName,produceDate,productCategory,descript)
				// values('".$decodedProduct->productID."','".$decodedProduct->productName."','".
			// $decodedProduct->produceDate."','".$decodedProduct->productCategory."','".$decodedProduct->descript."');";
				$sqlExecute = "insert into rkProduct(ckID,productID,productName,produceDate,productCategory,descript)
						values('$pID','$pName','$pDate','$pCategory','$pDescript');";
		echo $sqlExecute;
		//return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.rkProduct.php');
		$rkProduct = new rkProduct(
		    $decodedProduct->ckID,
			$decodedProduct->productID,
			$decodedProduct->productName,
			$decodedProduct->produceDate,
			$decodedProduct->productCategory,
			$decodedProduct->descript,
			$decodedProduct->state
			);		
		if ($r) {
			$rkProduct->state="ok";
		}
		else
		{
			$rkProduct->state="fail";
		}
		$foo_json = json_encode($rkProduct);
		echo $foo_json;
	}
	//删除产品信息
	public function deleterkProduct() {
		
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
		require_once('class.rkProduct.php');
		$rkProduct = new rkProduct(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from rkProduct where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$rkProduct->state="记录不存在";
			$foo_json = json_encode($rkProduct);
			echo $foo_json;
			return;
		}
		$sqlDelete = "delete from rkProduct where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlDelete);
		if ($r) {
			$rkProduct->state="ok";
		}
		else
		{
			$rkProduct->state="fail";
		}
		$foo_json = json_encode($rkProduct);
		echo $foo_json;
	}
	//更新产品信息
	public function updaterkProduct() {
		
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$pID = $decodedProduct->productID;
		$pID = $decodedProduct->productID;
		
		$pID = $decodedProduct->productID;
		$pName = $decodedProduct->productName;
		$pDate = $decodedProduct->produceDate;
		$pCategory = $decodedProduct->productCategory;
		$pDescript = $decodedProduct->descript;
		// 下面将数据添加到数据库中
		require_once('class.rkProduct.php');
		$rkProduct = new rkProduct(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from rkProduct where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$rkProduct->state="记录不存在";
			$foo_json = json_encode($rkProduct);
			echo $foo_json;
			return;
		}
		$sqlUpdate = "update rkProduct set productName='$pName',produceDate = '$pDate'
				,productCategory = '$pCategory',descript = '$pDescript'
				where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlUpdate);
		if ($r) {
			$rkProduct->state="ok";
		}
		else
		{
			$rkProduct->state="fail";
		}
		$foo_json = json_encode($rkProduct);
		echo $foo_json;
	}
	//获取所有产品信息
	
	public function allckProductsbyId()
	{
		$jsonInput = file_get_contents("php://input"); 
	//	$jsonInput=$this->checkUTF8($jsonInput);
		
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select ckID,productID,productName,produceDate
					,productCategory,descript from rkProduct where 
					productStatus = '11' and ckID='$jsonInput';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select ckID,productID,productName,produceDate
						,productCategory,descript from rkProduct where 
						productStatus = '11' and ckID='$jsonInput';";
			}
		
		$M = new Model();					
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.rkProduct.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$rkProduct = new rkProduct(
				    $list[$i]['ckID'],
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				//var_dump($product);
				//return;
				array_push($result,$rkProduct);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
	}
	public function getAllrkProducts()
	{
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select ckID,productID,productName,produceDate
					,productCategory,descript from rkProduct where 
					productStatus = '0';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select ckID,productID,productName,produceDate
						,productCategory,descript from rkProduct where 
						productStatus = '0';";
			}
		$M = new Model();					
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.rkProduct.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$rkProduct = new rkProduct(
				    $list[$i]['ckID'],
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				//var_dump($product);
				//return;
				array_push($result,$rkProduct);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
	}
	// 获取具体的产品信息
	public function getrkProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$productID = $decodedProduct->productID;
		$sqlSelect = "select ckID,productID,productName,produceDate
				,productCategory,descript from rkProduct where 
				 productID = '$productID';";
		//echo $sqlSelect;
		//return;
		$M = new Model();					
		$list = $M->query($sqlSelect);
		require_once('class.rkProduct.php');
		//$rkProduct = '';
		if (count($list)>0) {
			$rkProduct = new rkProduct(
			$list[0]['ckID'],
				$list[0]['productID'],
				$list[0]['productName'],
				$list[0]['produceDate'],
				$list[0]['productCategory'],
				$list[0]['descript']
				);
			$rkProduct->state='ok';
		}
		else
		{
			$rkProduct = new rkProduct(
			    '',
				$productID,
				'',
				'',
				'',
				''
				);
			$product->state='failed';
		}
		$foo_json = json_encode($rkProduct);
		
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
	//获取盘点物资列表
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