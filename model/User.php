<?php

class User {
	
	private $username;
	private $password;
	
	public function __construct($name,$pw){
		$this->username = $name;
		$this->password = $pw;
		
		//set the initial value for $_SESSION variables
		if(!isset($_SESSION['Logged']))
			$_SESSION['Logged'] = false;
		if(!isset($_SESSION['JustReg']))
			$_SESSION['JustReg'] = false;
	}
	
	/**
	* @return  String
	*/
	public function getName(){
		return $this->username;
	}
	
	/**
	* @return  String
	*/
	public function getPassword(){
		return $this->password;
	}
	
	public function setSessionUsername($name){
		$_SESSION['Username'] = $name;
	}
	
	public function getSessionUsername(){
		return $_SESSION['Username'];
	}
	
	public function clearSessionUsername(){
		unset($_SESSION['Username']);
	}
	
	public function isJustRegistered(){
		return $_SESSION['JustReg'];
	}
	
	public function isLoggedIn(){
		return $_SESSION['Logged'];
	}
	
	public function toggleLogged(){
		if($_SESSION['Logged'] == false)
			$_SESSION['Logged'] = true;
		else $_SESSION['Logged'] = false;
	}
	
	public function toggleJustRegistered(){
		if($_SESSION['JustReg'] == false)
			$_SESSION['JustReg'] = true;
		else $_SESSION['JustReg'] = false;
	}
	
}
