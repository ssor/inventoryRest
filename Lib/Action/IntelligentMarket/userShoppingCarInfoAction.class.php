<?php
// 本文档自动生成，仅供测试运行
class userShoppingCarInfoAction extends Action
{
	public function getUserShoppingCarInfo()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedHistory = json_decode($jsonInput);
		
		$epc = $decodedHistory->userEPC;
		$sqlSelect = "select Product.productEPC,商品类别表.单价 as price , Product.productName,折扣表.折扣 as discount ,ShoppingCar.money as money 
				from Product ,折扣表, 商品类别表,ShoppingCar
				where Product.productEPC = ShoppingCar.productEPC and Product.productName=折扣表.商品名称
				and Product.productName = 商品类别表.商品名称 and ShoppingCar.userEPC='$epc';";	
		$M = new Model();
		$list = $M->query($sqlSelect);
		$result = array();
		if (count($list)>0) {
			require_once('class.userShoppingCarInfo.php');
			for($i = 0;$i<count($list);$i++){
				$temp = $list[$i];
				$h = new userShoppingCarInfo(
					$temp['productEPC'],
					$temp['productName'],
					$temp['price'],
					$temp['money'],
					$temp['discount'],
					$epc);
				$h->state="ok";
				array_push($result,$h);
			}
		}
		$foo_json = json_encode($result);
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