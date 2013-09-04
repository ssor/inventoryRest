<?php

class ckProductAction extends Action
{
	//新增产品信息
	public function addProduct()
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
		// $sqlExecute = "insert into ckProduct(ckID,productID,productName,produceDate,productCategory,descript)
				// values('".$decodedProduct->productID."','".$decodedProduct->productName."','".
			// $decodedProduct->produceDate."','".$decodedProduct->productCategory."','".$decodedProduct->descript."');";
				$sqlExecute = "insert into ckProduct(ckID,productID,productName,produceDate,productCategory,descript)
						values('$pID','$pName','$pDate','$pCategory','$pDescript');";
	//	echo $sqlExecute;
		//return;
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ckProduct.php');
		$ckProduct = new ckProduct(
		    $decodedProduct->ckID,
			$decodedProduct->productID,
			$decodedProduct->productName,
			$decodedProduct->produceDate,
			$decodedProduct->productCategory,
			$decodedProduct->descript,
			$decodedProduct->state
			);		
		if ($r) {
			$ckProduct->state="ok";
		}
		else
		{
			$ckProduct->state="fail";
		}
		$foo_json = json_encode($ckProduct);
		echo $foo_json;
	}
	//删除产品信息
	public function deleteckProduct() {
		
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
		require_once('class.ckProduct.php');
		$ckProduct = new ckProduct(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from ckProduct where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$ckProduct->state="记录不存在";
			$foo_json = json_encode($ckProduct);
			echo $foo_json;
			return;
		}
		$sqlDelete = "delete from ckProduct where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlDelete);
		if ($r) {
			$ckProduct->state="ok";
		}
		else
		{
			$ckProduct->state="fail";
		}
		$foo_json = json_encode($ckProduct);
		echo $foo_json;
	}
	//更新产品信息
	public function updateckProduct() {
		
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
		require_once('class.ckProduct.php');
		$ckProduct = new ckProduct(
			$pID,$pName,$pDate,$pCategory,$pDescript,"");
		
		$sqlSelect = "select productID from ckProduct where productID = '$pID'";
		$MSelect = new Model();
		$list = $MSelect->query($sqlSelect);
		
		if (count($list)<=0) {
			$ckProduct->state="记录不存在";
			$foo_json = json_encode($ckProduct);
			echo $foo_json;
			return;
		}
		$sqlUpdate = "update ckProduct set productName='$pName',produceDate = '$pDate'
				,productCategory = '$pCategory',descript = '$pDescript'
				where productID = '$pID'; ";
		$M = new Model();
		$r = $M->execute($sqlUpdate);
		if ($r) {
			$ckProduct->state="ok";
		}
		else
		{
			$ckProduct->state="fail";
		}
		$foo_json = json_encode($ckProduct);
		echo $foo_json;
	}
	//获取所有产品信息
	public function getAllckProducts()
	{
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select ckID,productID,productName,produceDate
					,productCategory,descript from ckProduct where 
					productStatus = '0';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select ckID,productID,productName,produceDate
						,productCategory,descript from ckProduct where 
						productStatus = '0';";
			}
		$M = new Model();					
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			//var_dump($list);
			//return;
			require_once('class.ckProduct.php');
			for($i = 0;$i < count($list);$i++)
			{				
				$ckProduct = new ckProduct(
				    $list[$i]['ckID'],
					$list[$i]['productID'],
					$list[$i]['productName'],
					$list[$i]['produceDate'],
					$list[$i]['productCategory'],
					$list[$i]['descript']
					);
				//var_dump($product);
				//return;
				array_push($result,$ckProduct);
			}				
		}
		
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;				
	}
	// 获取具体的产品信息
	public function getckProduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$productID = $decodedProduct->productID;
		$sqlSelect = "select ckID,productID,productName,produceDate
				,productCategory,descript from ckProduct where 
				 productID = '$productID';";
		//echo $sqlSelect;
		//return;
		$M = new Model();					
		$list = $M->query($sqlSelect);
		require_once('class.ckProduct.php');
		//$ckProduct = '';
		if (count($list)>0) {
			$ckProduct = new ckProduct(
			$list[0]['ckID'],
				$list[0]['productID'],
				$list[0]['productName'],
				$list[0]['produceDate'],
				$list[0]['productCategory'],
				$list[0]['descript']
				);
			$ckProduct->state='ok';
		}
		else
		{
			$ckProduct = new ckProduct(
			    '',
				$productID,
				'',
				'',
				'',
				''
				);
			$product->state='failed';
		}
		$foo_json = json_encode($ckProduct);
		
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