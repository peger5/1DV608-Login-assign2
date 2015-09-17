<?php

class User {
	
	private $username;
	private $password;
	
	public function __construct($name,$pw){
		$this->username = $name;
		$this->password = $pw;
	}
	
	public function getName(){
		return $this->username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
}
