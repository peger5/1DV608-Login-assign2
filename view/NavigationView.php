<?php

class NavigationView {
	/**
	 * Used to build URLs to a certain product
	 * @var string
	 */ 
	private static $registerURL = "reg";
	
	public function getLinks(){
		if($this->inRegistrationForm())
			return $this->getLinkToLogin();
		else if(!$this->inRegistrationForm() && $_SESSION['Logged'] == false) 
			return $this->getLinkToRegister();
		else return "";
	}
	
	/**
	 * @return String HTML <a href...
	 */
	public function getLinkToRegister() {
		return "<a href='?" . self::$registerURL ."'>Register a new user</a>";
	}
	
	public function getLinkToLogin(){
		return "<a href='?'>Back to login</a>";
	}
	
	/**
	 * @return boolean
	 */
	public function inRegistrationForm() {
		return isset($_GET[self::$registerURL]);
	}
}