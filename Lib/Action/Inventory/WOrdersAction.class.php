<?php
// 本文档自动生成，仅供测试运行
class WOrdersAction extends Action
{

//http://localhost:9002/index.php/IntelligentMarket/WOrders/getAllSOrders
 
	public function getAllWOrders() {
		$M = new Model();					

		if (C('DB_TYPE')== 'Sqlsrv') {
			// sqlserver
			$sql = "select * from WOrders;";
			
		}
		else if (C('DB_TYPE')== 'pdo') {
				//sqlite
				$sql = "select * from WOrders;";
			}

		$list = $M->query($sql);
		$result = array();
		if (count($list)>0) {
			require_once('class.WOrders.php');
			for($i=0;$i<count($list);$i++){
				$p = new WOrders(
					$list[$i]['orderID'],
					$list[$i]['Theorders'],
					$list[$i]['prductName'],
					$list[$i]['Number'],
					$list[$i]['productCategory'],
				    $list[$i]['time'],
					$list[$i]['orderState'],
					$list[$i]['address'],
					$list[$i]['beiZhu'],
					$list[$i]['state']
					);
					
					
				$p->state="ok";
				array_push($result,$p);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;		
	}
public function addWOrders()
	{
		$jsonInput = file_get_contents("php://input"); 
	
		$decodedUser=json_decode($jsonInput);
		$orderID  =$decodedUser->orderID;
		$Theorders     =$decodedUser->Theorders    ;
		$prductName     =$decodedUser->prductName    ;
		$Number   =$decodedUser->Number  ;
		$productCategory     =$decodedUser->productCategory    ;
		$time	 =$decodedUser->time	;
		$orderState	 =$decodedUser->orderState	;
		$address	 =$decodedUser->address	;
		$beiZhu	 =$decodedUser->beiZhu	;
		$state	 =$decodedUser->state	;
		
		
		
		
		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into WOrders
				values('$orderID','$Theorders','$prductName','$Number','$productCategory','$time','$orderState','$address','$beiZhu','$state');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.WOrders.php');
		
		$WOrders = new WOrders(
			$orderID,
			$Theorders,
			$prductName,
		
			$Number,
			$time,
			$orderState,
			$orderState,
			$address,
			$beiZhu,
			$state
			
			);
		if ($r) {
			$WOrders->state="ok";
		}
		else
		{
			$WOrders->state="fail";
		}
		$foo_json = json_encode($WOrders);
		echo $foo_json;
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