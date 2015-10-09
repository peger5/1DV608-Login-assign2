<?php


class UserDAL {
	
	private static $table = "users";
	private $userList;
	private $database;
		
	public function __construct(mysqli $db) {
		$this->database = $db;
	}
	
	/*
	* Fetches the items from the table in MySQL 
	* @return $userList, A UserList filled with the items from the db
	*/
	public function getUsers() {
		$this->userList = new UserList();
		$stmt = $this->database->prepare("SELECT * FROM " . self::$table);
		if ($stmt === FALSE) {
			throw new Exception($this->database->error);
		}
		$stmt->execute();
	 	
	    $stmt->bind_result($username, $password);
	    while ($stmt->fetch()) {
	    	$user = new User($username,$password);
	    	$this->userList->add($user);
		}
		return  $this->userList;
	}
	
	/*
	* Adds entries to the db
	* @return void
	*/
	public function add(User $toBeAdded) {
		$stmt = $this->database->prepare("INSERT INTO `a7600781_reg`.`users` (
			`username` , `password` )
				VALUES (?, ?)");
		if ($stmt === FALSE) {
			throw new Exception($this->database->error);
		}
		$userName = $toBeAdded->getName();
		$userPassword = $toBeAdded->getPassword();
		$stmt->bind_param('ss', $userName, $userPassword);
		$stmt->execute();
	}
}
