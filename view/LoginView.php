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
	

	
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @param $message, String output message
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($message) {
	//$rv = new RegistrationView();
		if($_SESSION['Logged'] == false)
			
		//	return $rv->generateRegistrationFormHTML();
			return $this->generateLoginFormHTML($message);
		else 
			return $this->generateLogoutButtonHTML($message);
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
	* @return  String
	*/
	public function getErrorUsername(){
		return "Username is missing";
	}
	
	/**
	* @return  String
	*/
	public function getErrorPassword(){
		return "Password is missing";
	}
	
	/**
	* @return  String
	*/
	public function getErrorElse(){
		return "Wrong name or password";
	}
	
	/**
	* @return  String
	*/
	public function getWelcomeMessage(){
		return "Welcome";
	}
	
	/**
	* @return  String
	*/
	public function getByeMessage(){
		return "Bye bye!";
	}
	
	/**
	* @param $name, String placed in the username field in the form
	* @return  String
	*/
	public function setUsernameField($name){
		self::$userField = $name;
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if(isset($_POST[self::$name])){
			return $_POST[self::$name];
		}
	}
	
	public function getRequestPassword(){
		if(isset($_POST[self::$password])){
			return $_POST[self::$password];
		}
	}
}