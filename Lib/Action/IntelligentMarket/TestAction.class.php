<?php
// 本文档自动生成，仅供测试运行
class TestAction extends Action
{
	public function test1()
	{
		$jsonInput = file_get_contents("php://input"); 
		$decodedProduct=json_decode($jsonInput);
		$epc =	$decodedProduct->productEPC;
		
		$productName = $decodedProduct->productName;
		
		require_once("class.Product.php");
		
		$p = new Product($epc,$productName);
		$p->state = "ok";
		$foo_json = json_encode($p);
		echo $foo_json;
		return;
//		
//		
//		
//		$result = array();
//		
//		$p1 = new Product("epc1","name1");
//		$p2 = new Product("epc2","name2");
//		
//		array_push($result,$p1);
//		array_push($result,$p2);
//		
//		$foo_json = json_encode($result);
//		echo $foo_json;
		
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