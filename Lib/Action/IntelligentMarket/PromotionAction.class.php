<?php
// 本文档自动生成，仅供测试运行
class PromotionAction extends Action
{
	public function updatePromotion()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPromotion=json_decode($jsonInput);
		
		$name = $decodedPromotion->productName;
		$PromotionType = $decodedPromotion->PromotionType;
		$Discount = $decodedPromotion->Discount;
		$Bj = $decodedPromotion->Bj;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update 折扣表 set 促销类型 = '$PromotionType' , 折扣 = $Discount , 备注 = '$Bj' where 商品名称 = '$name';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Promotion.php');
		$p = new Promotion(
			$name,
			$PromotionType,
			$Discount,
			$Bj
			);
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
	public function getAllPromotions() {
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select 商品名称 as productName , 促销类型 as PromotionType , 折扣 as Discount , 备注 as Bj from 折扣表;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select 商品名称 as productName , 促销类型 as PromotionType , 折扣 as Discount , 备注 as Bj from 折扣表;";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.Promotion.php');
			for($i=0;$i<count($list);$i++){
				$p = new Promotion(
					$list[$i]['productName'],
					$list[$i]['PromotionType'],
					$list[$i]['Discount'],
					$list[$i]['Bj']
					);
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deletePromotion()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPromotion=json_decode($jsonInput);
		
		$name = $decodedPromotion->productName;
		$PromotionType = $decodedPromotion->PromotionType;
		$Discount = $decodedPromotion->Discount;
		$Bj = $decodedPromotion->Bj;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from 折扣表 where 商品名称 = '$name';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Promotion.php');
		$p = new Promotion(
			$name,
			$PromotionType,
			$Discount,
			$Bj
			);
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
	public function addPromotion()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPromotion=json_decode($jsonInput);
		
		$name = $decodedPromotion->productName;
		$PromotionType = $decodedPromotion->PromotionType;
		$Discount = $decodedPromotion->Discount;
		$Bj = $decodedPromotion->Bj;
		// 下面将数据添加到数据库中
		$sqlExecute = "	insert into 折扣表(商品名称 , 促销类型 , 折扣 , 备注) 
				values('$name','$PromotionType',$Discount,'$Bj');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Promotion.php');
		$p = new Promotion(
			$name,
			$PromotionType,
			$Discount,
			$Bj
			);
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
	public function getPromotion()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPromotion=json_decode($jsonInput);
		
		$name = $decodedPromotion->productName;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select 商品名称 as productName , 促销类型 as PromotionType , 折扣 as Discount , 备注 as Bj from 折扣表 where 商品名称 = '$name';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select 商品名称 as productName , 促销类型 as PromotionType , 折扣 as Discount , 备注 as Bj from 折扣表 where 商品名称 = '$name';";
			}
		//echo $sql;
		//return;
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.Promotion.php');
			$p = new Promotion(
				$list[0]['productName'],
				$list[0]['PromotionType'],
				$list[0]['Discount'],
				$list[0]['Bj']
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