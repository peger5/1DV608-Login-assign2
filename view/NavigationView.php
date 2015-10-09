<?php

class NavigationView {
	/**
	 * Used to build URL for registration
	 * @var string
	 */ 
	private static $registerURL = "register";
	private $session;
	
	public function __construct(SessionModel $m){
		$this->session = $m;
	}
	
	/**
	* Used to build links to direct the user to login or register.
	* @return String HTML <a href...
	*/
	public function getLinks(){
		if($this->inRegistrationForm())
			return $this->getLinkToLogin();
		else if(!$this->inRegistrationForm() && $this->session->isLoggedIn() == false) 
			return $this->getLinkToRegister();
		else return "";
	}
	
	/**
	 * @return boolean
	 */
	public function inRegistrationForm() {
		return isset($_GET[self::$registerURL]);
	}
	
	/**
	* @void Change the URL to default page
	*/
	public function clearURL(){
		header('Location:/');
	}
	
	//Private 'get link' methods
	private function getLinkToRegister() {
		return "<a href='?" . self::$registerURL ."'>Register a new user</a>";
	}
	
	private function getLinkToLogin(){
		return "<a href='?'>Back to login</a>";
	}
	
	
	
	
	
}