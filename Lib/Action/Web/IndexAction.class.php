<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
	/**
	+----------------------------------------------------------
	* 默认操作
	+----------------------------------------------------------
	*/
	public function index()
	{
		//$this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
		$this->display();
	}
	public function showNoResult()
	{
		$this->display();
		
		}
	public function productQuery()
	{
		$productID = $_POST['productID'];
		if (empty($productID)) {
			//返回没有结果的页面
			$this->display("showNoResult");
		}
		else
		{
			$this->assign('productID',$productID);
			
			$sql = "SELECT productID,actionTime,action FROM productState where productID = '$productID'";
			$M = new Model();
			$list = $M->query($sql);
			if (count($list)<=0) {
				$this->display("showNoResult");
				return;
			}
			$this->assign('stateList',$list);
			$this->assign('productName','实验说明书');
			$this->assign('productCategory','书籍');
			$this->assign('company','新华书店');
			
			$this->display("showResult");
			
		}
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