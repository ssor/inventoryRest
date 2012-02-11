<?php

// 本类主要用来操作与socket相关的动作
class UdpInvokeAction extends Action
{
	//发送给udp相关命令
	// 入库扫描  inventory_input
	public function sendUDPCommand()
	{
		$cmd = $_GET['cmd'];
		if (empty($cmd)) {
			echo 'failed';
			return;
		}
		$strcmd='';
		switch($cmd) {
			case 'inventory_input':
				$strcmd = 'inventory_input';
				break;
		}
		//$host = '127.0.0.1';
		$host = C('udp_host');
		$port = C('udp_port');
		//$port = 5000;
		$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		socket_sendto($socket, $strcmd, strlen($strcmd), 0, $host, $port);
		socket_close($socket);
		echo 'ok';
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