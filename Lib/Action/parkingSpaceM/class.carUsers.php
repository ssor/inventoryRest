<?php

class carUsers
{
	public    $userName ;
	public    $userEPC;
	public    $userCid ;
	public    $userRname ;
	public    $userSex ;
	public    $userJob ;
	public    $userBitrh ;
	public    $userPic ;
	public    $userAdd ;
	public    $userTel ;
	public    $userJG ;
	public    $userYE ;
	public    $carType ;
	public    $state ;
	
	public function __construct($_userName="",$_userEPC="",$_userCid="",$_userRname="",$_userSex="",$_userJob="",
		$_userBitrh="",$_userPic="",$_userAdd="",$_userTel="",$_userJG="",$_userYE="",$_carType="") 
	{
		$this->userName = $_userName;
		$this->userEPC = $_userEPC;
		$this->userCid = $_userCid;
		$this->userRname = $_userRname;
		$this->userSex = $_userSex;
		$this->userJob = $_userJob;
		$this->userBitrh = $_userBitrh;
		$this->userPic = $_userPic;
		$this->userAdd = $_userAdd;
		$this->userTel = $_userTel;
		$this->userJG = $_userJG;
		$this->userYE = $_userYE;
		$this->carType = $_carType;
		
	}
	
}

?>