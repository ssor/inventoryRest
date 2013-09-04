<?php
// 本文档自动生成，仅供测试运行
class SMproductAction extends Action
{
	public function getProductInfoShow()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$epc = $decodedProduct->productEPC;
		$sqlSelect = "select Product.productEPC ,商品类别表.单价 as price , Product.productName, 
				商品类别表.位置 as location ,商品类别表.图片 as pic ,  折扣表.折扣 as discount ,  商品类别表.备注 as productBj,  商品类别表.所属类别 as productKind from 
				Product,折扣表,商品类别表
				where Product.productName=折扣表.商品名称
				and Product.productName= 商品类别表.商品名称 and Product.productEPC='$epc';";
		$M = new Model();
		$list = $M->query($sqlSelect);
		require_once('class.productInfoshow.php');
		$p = new productInfoshow();
		$p->state = "fail";
		if (count($list)>0) {
			$temp = $list[0];
			$p = new productInfoshow($temp['productEPC'],$temp['productName'],$temp['price'],
				$temp['location'],$temp['pic'],
				$temp['discount'],$temp['productBj'],
				$temp['productKind']);
			$p->state="ok";
			
		}
		$foo_json = json_encode($p);
		echo $foo_json;
	}
	public function updateSMproduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$name =	$decodedProduct->productName;
		$price = $decodedProduct->productprice;
		$bj = $decodedProduct->productBj;
		$location = $decodedProduct->productLocation;
		$pic = $decodedProduct->productPic;
		$kind = $decodedProduct->productKind;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update 商品类别表 set 单价 = $price ,备注 = '$bj' ,
				位置 = '$location' ,图片 = '$pic' ,所属类别 = '$kind' where 商品名称 = '$name';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.SMproduct.php');
		$product = new SMproduct($name,$price,$bj,$location,$pic,$kind);
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
	public function getAllSMproducts() {
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select 商品名称 as productName,单价 as productprice,备注 as productBj,
					位置 as productLocation,图片 as productPic,所属类别 as productKind from 商品类别表;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select 商品名称 as productName ,单价 as productprice,备注 as productBj,
						位置 as productLocation,图片 as productPic,所属类别 as productKind from 商品类别表;";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.SMproduct.php');
			for($i=0;$i<count($list);$i++){
				$product = new SMproduct(
					$list[$i]['productName'],
					$list[$i]['productprice'],
					$list[$i]['productBj'],
					$list[$i]['productLocation'],
					$list[$i]['productPic'],
					$list[$i]['productKind']
					);
				$product->state="ok";
				array_push($result,$product);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deleteSMproduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct = json_decode($jsonInput);
		
		$name =	$decodedProduct->productName;
		$price = $decodedProduct->productprice;
		$bj = $decodedProduct->productBj;
		$location = $decodedProduct->productLocation;
		$pic = $decodedProduct->productPic;
		$kind = $decodedProduct->productKind;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from 商品类别表 where 商品名称 = '$name';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.SMproduct.php');
		$product = new SMproduct($name,$price,$bj,$location,$pic,$kind);
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
	public function addSMproduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		
		$name =	$decodedProduct->productName;
		$price = $decodedProduct->productprice;
		$bj = $decodedProduct->productBj;
		$location = $decodedProduct->productLocation;
		$pic = $decodedProduct->productPic;
		$kind = $decodedProduct->productKind;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "	insert into 商品类别表(商品名称 ,单价 ,备注 ,
				位置 ,图片 ,所属类别) values('$name',$price,'$bj','$location','$pic','$kind');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.SMproduct.php');
		$product = new SMproduct($name,$price,$bj,$location,$pic,$kind);
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
	public function getSMproduct()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedProduct=json_decode($jsonInput);
		$name =	$decodedProduct->productName;
		
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select 商品名称 as productName,单价 as productprice,备注 as productBj,
					位置 as productLocation,图片 as productPic,所属类别 as productKind from 商品类别表 
					where 商品名称 = '$name';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select 商品名称 as productName ,单价 as productprice ,备注 as productBj ,
						位置 as productLocation ,图片 as productPic ,所属类别 as productKind from 商品类别表 
						where 商品名称 = '$name';";
			}
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.SMproduct.php');
			$product = new SMproduct(
				$name,
				$list[0]['productprice'],
				$list[0]['productBj'],
				$list[0]['productLocation'],
				$list[0]['productPic'],
				$list[0]['productKind']
				);			
			$product->state="ok";
		}
		$foo_json = json_encode($product);
		
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