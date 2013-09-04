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
	// 'DB_DSN' => 'sqlite:'.dirname(__FILE__).'./db.db3', //相对于config目录的路径
	'DB_DSN' => 'sqlite:./Conf/db.db3', //相对于index.php的路径 
	'DB_NAME'=>'db.db3',
	//************************************************************
	// IntelligentMarket 智能超市
	// Inventory 仓储管理
	// RFIDReader组，将rfid读取标签的操作里面
	// IntelligentProduct 智能生产
	// Inventory_barcode 仓储管理 基于条码
	// LogiTechBrowser 管理系统
	// Standarder 标准中间服务，各种标准的指定，例如标签上标识商品种类
	'APP_GROUP_LIST'=>'Inventory,IntelligentMarket,RFIDReader,LogisTechBase,Web,LED,ResSync,Zigbee,IntelligentProduct,Inventory_barcode,LogiTechBrowser,Standarder',
	'DEFAULT_GROUP'=>'LogiTechBrowser', 
	
	// UDP para
	'udp_host' => '127.0.0.1',
	'udp_port' => 5000
);
?>