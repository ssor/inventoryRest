<?php
// 本文档自动生成，仅供测试运行
class ShoppingCarAction extends Action
{
	public function updateShoppingCarRecord()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedShoppingCar=json_decode($jsonInput);
		
		$productEPC = $decodedShoppingCar->productEPC;
		$userEPC= $decodedShoppingCar->userEPC;
		$time= $decodedShoppingCar->time;
		$money = $decodedShoppingCar->money;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update ShoppingCar set money = $money  ,time = '$time'  where  productEPC = '$productEPC' and userEPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ShoppingCar.php');
		$car = new ShoppingCar(
			$productEPC,
			$userEPC,
			$time,
			$money
			);
		if ($r) {
			$car->state="ok";
		}
		else
		{
			$car->state="fail";
		}
		$foo_json = json_encode($car);
		echo $foo_json;
	}
	public function getAllShoppingCarRecords() {
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productEPC,userEPC,time,money from ShoppingCar;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productEPC,userEPC,time,money from ShoppingCar;";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.ShoppingCar.php');
			for($i=0;$i<count($list);$i++){
				$car = new ShoppingCar(
					$list[$i]['productEPC'],
					$list[$i]['userEPC'],
					$list[$i]['time'],
					$list[$i]['money']
					);
				$car->state="ok";
				array_push($result,$car);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deleteShoppingCarRecord()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedShoppingCar=json_decode($jsonInput);
		
		$productEPC = $decodedShoppingCar->productEPC;
		$userEPC= $decodedShoppingCar->userEPC;
		$time= $decodedShoppingCar->time;
		$money = $decodedShoppingCar->money;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from ShoppingCar where  productEPC = '$productEPC' and userEPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ShoppingCar.php');
		$car = new ShoppingCar(
			$productEPC,
			$userEPC,
			$time,
			$money
			);
		if ($r) {
			$car->state="ok";
		}
		else
		{
			$car->state="fail";
		}
		$foo_json = json_encode($car);
		echo $foo_json;
	}
	public function addShoppingCarRecord()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedShoppingCar=json_decode($jsonInput);
		
		$productEPC = $decodedShoppingCar->productEPC;
		$userEPC= $decodedShoppingCar->userEPC;
		$time= $decodedShoppingCar->time;
		$money = $decodedShoppingCar->money;
		// 下面将数据添加到数据库中
		$sqlExecute = "	insert into ShoppingCar(productEPC,userEPC,time,money) values('$productEPC','$userEPC','$time',$money);";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.ShoppingCar.php');
		$car = new ShoppingCar(
			$productEPC,
			$userEPC,
			$time,
			$money
			);
		if ($r) {
			$car->state="ok";
		}
		else
		{
			$car->state="fail";
		}
		$foo_json = json_encode($car);
		echo $foo_json;
	}
	public function getShoppingCarRecord()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedShoppingCar=json_decode($jsonInput);
		
		$productEPC = $decodedShoppingCar->productEPC;
		$userEPC= $decodedShoppingCar->userEPC;
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productEPC,userEPC,time,money from ShoppingCar where  userEPC = '$userEPC';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productEPC , userEPC ,time ,money from ShoppingCar where productEPC = '$productEPC' and userEPC = '$userEPC';";
			}
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.ShoppingCar.php');
			$car = new ShoppingCar(
				$list[0]['productEPC'],
				$list[0]['userEPC'],
				$list[0]['time'],
				$list[0]['money']
				);

			$car->state="ok";
		}
		$foo_json = json_encode($car);
		
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