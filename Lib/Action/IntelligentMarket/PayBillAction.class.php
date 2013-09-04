<?php
// 本文档自动生成，仅供测试运行
class PayBillAction extends Action
{
	public function updatePayBill()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPayBill=json_decode($jsonInput);
		
		$productEPC = $decodedPayBill->productEPC;
		$userEPC = $decodedPayBill->userEPC;
		$time = $decodedPayBill->time;
		$productName = $decodedPayBill->productName;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "update payBill set time = '$time', productName = '$productName' where  productEPC = '$productEPC' and userEPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.Promotion.php');
		$p = new PayBill($productEPC,$userEPC,$time,$productName);
		
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
	public function getAllPayBills() {
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productEPC , userEPC , time , productName from payBill;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productEPC , userEPC , time , productName from payBill;";
			}
		
		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.PayBill.php');
			for($i=0;$i<count($list);$i++){
				$p = new PayBill(
					$list[$i]['productEPC'],
					$list[$i]['userEPC'],
					$list[$i]['time'],
					$list[$i]['productName']
					);
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
	public function deletePayBill()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPayBill=json_decode($jsonInput);
		
		$productEPC = $decodedPayBill->productEPC;
		$userEPC = $decodedPayBill->userEPC;
		$time = $decodedPayBill->time;
		$productName = $decodedPayBill->productName;
		// 下面将数据添加到数据库中
		$sqlExecute = "delete from payBill where productEPC = '$productEPC' and userEPC = '$userEPC';";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.PayBill.php');
		$p = new PayBill($productEPC,$userEPC,$time,$productName);
		
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
	public function addPayBill()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPayBill=json_decode($jsonInput);
		
		$productEPC = $decodedPayBill->productEPC;
		$userEPC = $decodedPayBill->userEPC;
		$time = $decodedPayBill->time;
		$productName = $decodedPayBill->productName;
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into payBill(productEPC , userEPC , time , productName) values('$productEPC','$userEPC','$time','$productName');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.PayBill.php');
		$p = new PayBill($productEPC,$userEPC,$time,$productName);
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
	public function getPayBill()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedPayBill=json_decode($jsonInput);
		
		$productEPC = $decodedPayBill->productEPC;
		$userEPC = $decodedPayBill->userEPC;
		$time = $decodedPayBill->time;
		$productName = $decodedPayBill->productName;
		
		$M = new Model();					
		
		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select productEPC , userEPC , time , productName from payBill where  productEPC = '$productEPC' and userEPC = '$userEPC';";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select productEPC , userEPC , time , productName from payBill where  productEPC = '$productEPC' and userEPC = '$userEPC';";
			}
		
		$list = $M->query($sql);
		if (count($list)>0) {
			require_once('class.PayBill.php');
			$p = new PayBill(
				$productEPC,
				$userEPC,
				$list[0]['time'],
				$list[0]['productName']
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