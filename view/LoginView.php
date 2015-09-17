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

	private $user;
	private $persistantUserName = '';
	
	//public function __construct(User $u){
		//$this->user = $u;
	//}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($message) {
	//	$message = '';
		
	//	if($this->didUserPressLogin()){
	
	//		if(empty($_POST[self::$name])) {
	//			$message = 'Username is missing';
	//		} else if($_POST[self::$name] == $this->user->getName() && empty($_POST[self::$password])){
	//			$message = 'Password is missing';
	//			$this->persistantUserName = $_POST[self::$name];
	//		} else if(empty($_POST[self::$name]) && $_POST[self::$password] == $this->user->getPassword()){
	//			$message = 'Username is missing';
	//		} else if($_POST[self::$name] == $this->user->getName() && $_POST[self::$password] != $this->user->getPassword()){
	//			$message = 'Wrong name or password';
	//			$this->persistantUserName = $_POST[self::$name];
	//		} else if($_POST[self::$name] != $this->user->getName() && $_POST[self::$password] == $this->user->getPassword()){
	//			$message = 'Wrong name or password';
	//			$this->persistantUserName = $_POST[self::$name];
	//		} else if($_POST[self::$name] != $this->user->getName() && empty($_POST[self::$password])){
	//			$message = 'Password is missing';
//				$this->persistantUserName = $_POST[self::$name];
//			} else if($_POST[self::$name] != $this->user->getName() && $_POST[self::$password] != $this->user->getPassword()){
//				$message = 'Wrong name or password';
	//			$this->persistantUserName = $_POST[self::$name];
	//		} else if($_POST[self::$name] == $this->user->getName() && $_POST[self::$password] == $this->user->getPassword()){
	//			$message = 'Welcome';
	//			return $this->generateLogoutButtonHTML($message);
	//		}
			return $this->generateLoginFormHTML($message);
	//	}
	//	else{
	//	return $this->generateLoginFormHTML($message);
	//	}
	
		//return $response;
	}
	
	public function didUserPressLogin(){
		return isset($_POST[self::$login]);
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->persistantUserName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function getErrorUsername(){
		return "Username is missing";
	}
	
	public function getErrorPassword(){
		return "Password is missing";
	}
	
	public function getErrorElse(){
		return "Wrong name or password";
	}
	
	public function getWelcomeMessage(){
		return "Welcome";
	}
	
	public function getByeMessage(){
		return "Bye, bye";
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