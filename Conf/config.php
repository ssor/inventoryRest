<?php
return array(
	//'配置项'=>'配置值'
		/***********************************************************
	// ms sqlserver config
	'DB_TYPE'=>'Sqlsrv',//OK
	// 连接本地
	//'DB_HOST'=>'192.168.1.102',//OK
	'DB_HOST'=>'(local)',//OK
	'DB_NAME'=>'IMS',
	'DB_USER'=>'sa',
	'DB_PWD'=>'078515',	
	//************************************************************/
	
	
	
	//***********************************************************
	// Sqlite config
	'DB_TYPE'=>'pdo',	
	'DB_DSN' => 'sqlite:'.dirname(__FILE__).'./db.db3', //相对于config目录的路径
	'DB_NAME'=>'db.db3',
	//************************************************************
	
	'APP_GROUP_LIST'=>'Inventory,IntelligentMarket',
	'DEFAULT_GROUP'=>'Inventory', 
	
	// UDP para
	'udp_host' => '127.0.0.1',
	'udp_port' => 5000
);
?>