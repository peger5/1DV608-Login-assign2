<?php

class UserList{
	
	/*
	* @var Array to hold users
	*/
	private $users = array();
	
	public function add(User $toBeAdded){
		$this->users[] = $toBeAdded;
	}
	
	public function getUsers(){
		return $this->users;
	}
	
	/*
	* Goes through the array looking for user with given name
	* @param $username, String 
	* @return $user, User variable if item in array
	* @return null, if item not in array
	*/
	public function getUserByName($username){
		foreach($this->users as $user){
			if($user->getName() == $username)
				return $user;
		}
		return null;
	}
	
	/*
	* Looks for a match in the array according to password and name
	* @param $username, String 
	* @param $password, String
	* @return boolean, true if user was found, false otherwise
	*/
	public function isCredentialsCorrect($username,$password){
		foreach($this->users as $user){
			if($user->getName() == $username && $user->getPassword() == $password)
				return true;
		}
		return false;
	}
		
}