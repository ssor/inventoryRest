<?php
// 本文档自动生成，仅供测试运行
class OrderAction extends Action
{
	public function deleteOrder() {
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedOrder=json_decode($jsonInput);
		$productName = $decodedOrder->productName;
		$productQuantity = $decodedOrder->quantity;
		$sqlExecute = "delete from tbOrder where productName = '$productName';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Order.php');
		$order = new Order(
			$decodedOrder->productName,
			$decodedOrder->quantity
			);
		if ($r) {
			$order->state="ok";
		}
		else
		{
			$order->state="fail";
		}
		$foo_json = json_encode($order);
		echo $foo_json;
	}
	public function addOrder()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedOrder=json_decode($jsonInput);
		$productName = $decodedOrder->productName;
		$productQuantity = $decodedOrder->quantity;
		$sqlExecute = "insert into tbOrder(productName,productQuantity) values('$productName',$productQuantity);";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Order.php');
		$order = new Order(
			$decodedOrder->productName,
			$decodedOrder->quantity
			);
		if ($r) {
			$order->state="ok";
		}
		else
		{
			$order->state="fail";
		}
		$foo_json = json_encode($order);
		echo $foo_json;
	}
	public function getAllOrders()
	{
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productName ,productQuantity from tbOrder;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productName ,productQuantity from tbOrder;";
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