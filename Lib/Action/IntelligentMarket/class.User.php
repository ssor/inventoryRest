<?php

class User
{
	public    $userName ;
	public    $userEPC;
	public    $userPsw ;
	public    $userRname ;
	public    $userSex ;
	public    $userJob ;
	public    $userBitrh ;
	public    $userPic ;
	public    $userAdd ;
	public    $userTel ;
	public    $userJG ;
	public    $userYE ;
	public    $userLevel ;
	public    $state ;
	
	public function __construct($_userName="",$_userEPC="",$_userPsw="",$_userRname="",$_userSex="",$_userJob="",
		$_userBitrh="",$_userPic="",$_userAdd="",$_userTel="",$_userJG="",$_userYE="",$_userLevel="") 
	{
		$this->userName = $_userName;
		$this->userEPC = $_userEPC;
		$this->userPsw = $_userPsw;
		$this->userRname = $_userRname;
		$this->userSex = $_userSex;
		$this->userJob = $_userJob;
		$this->userBitrh = $_userBitrh;
		$this->userPic = $_userPic;
		$this->userAdd = $_userAdd;
		$this->userTel = $_userTel;
		$this->userJG = $_userJG;
		$this->userYE = $_userYE;
		$this->userLevel = $_userLevel;
		
	}
	
}

?>