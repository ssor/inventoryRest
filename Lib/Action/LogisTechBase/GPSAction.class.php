<?php
// 本文档自动生成，仅供测试运行

/**
create table tbGPSLocation(mobileIndex varchar(32),timeStamp varchar(32),lat varchar(32),lng varchar(32));
select mobileIndex as ,timeStamp as ,lat as ,lng as  from tbGPSLocation
select mobileIndex,timeStamp,lat,lng from tbGPSLocation
insert into tbGPSLocation(mobileIndex,timeStamp,lat,lng) values();
delete from tbGPSLocation
update tbGPSLocation set mobileIndex = ,timeStamp = ,lat = ,lng = 
 */
class PayBillAction extends Action
{
	public function getLocationByName() {
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedLocation=json_decode($jsonInput);
		$name = $decodedLocation->name;
		$time = $decodedLocation->timeStamp;
		$M = new Model();					
		$sqlSelect = "select mobileIndex, timeStamp ,lat , lng from tbGPSLocation where mobileIndex = '$name' and timeStamp > '$time';";
		$list = $M->query($sqlSelect);
		$result = array();
		if (count($list)>0) {
			require_once('class.location.php');
			for($i=0;$i<count($list);$i++){
				$l = new location(
					$list[$i]['timeStamp'],
					$list[$i]['mobileIndex'],
					$list[$i]['lat'],
					$list[$i]['lng']
					);
				$l->state="ok";
				array_push($result,$l);
			}
		}
		$foo_json = json_encode($result);
		
		echo $foo_json;
		return;	
	}
	public function addLocation()
	{
		$jsonInput = file_get_contents("php://input"); 
		$jsonInput=$this->checkUTF8($jsonInput);
		$decodedLocation=json_decode($jsonInput);
		$name = $decodedLocation->name;
		$time = $decodedLocation->timeStamp;
		$lat = $decodedLocation->lat;
		$lng = $decodedLocation->lng;
		
		// 下面将数据添加到数据库中
		$sqlExecute = "insert into tbGPSLocation(mobileIndex,timeStamp,lat,lng) values('$name','$time','$lat','$lng');";
		$M = new Model();
		$r = $M->execute($sqlExecute);
		require_once('class.location.php');
		$l = new location($time,$name,$lat,$lng);
		if ($r) {
			$l->state="ok";
		}
		else
		{
			$l->state="fail";
		}
		$foo_json = json_encode($l);
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