<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	
	private static $userField = '';
	private static $messageField = '';
	
	private $session;
	
	public function __construct(SessionModel $model){
		$this->session = $model;
	}
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * 
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		if($this->session->isLoggedIn() == false)
			return $this->generateLoginFormHTML(self::$messageField);
		else {
			
			return $this->generateLogoutButtonHTML(self::$messageField);
		}
	}
	
	/**
	* Check if the login button is pressed from the form
	* 
	* @return  boolean
	*/
	public function didUserPressLogin(){
		return isset($_POST[self::$login]);
	}
	
	/**
	* Check if the logout button is pressed from the form
	* 
	* @return  boolean
	*/
	public function didUserPressLogout(){
		return isset($_POST[self::$logout]);
	}
	

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. self::$userField .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	/**
	* @param $name, String placed in the username field in the form
	* @return  String
	*/
	public function setUsernameField($name){
		self::$userField = $name;
	}
	
	//set methods to change the message in the form
	public function setErrorUsername(){
		self::$messageField = "Username is missing";
	}
	
	public function setErrorPassword(){
		self::$messageField = "Password is missing";
	}
	
	public function setErrorElse(){
		self::$messageField = "Wrong name or password";
	}
	
	public function setWelcomeMessage(){
		self::$messageField = "Welcome";
	}
	
	public function setMessageRegSuccess(){
		self::$messageField = "Registered new user.";
	}
	
	public function setByeMessage(){
		self::$messageField = "Bye bye!";
	}
	
	public function clearMessage(){
		self::$messageField = '';
	}
	
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if(isset($_POST[self::$name])){
			return trim($_POST[self::$name]);
		} 
	}
	
	public function getRequestPassword(){
		if(isset($_POST[self::$password])){
			return trim($_POST[self::$password]);
		}
	}
}