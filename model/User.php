<?php

class User {
	
	private $username;
	private $password;
	
	public function __construct($name,$pw){
		$this->username = $name;
		$this->password = $pw;
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
	
}
