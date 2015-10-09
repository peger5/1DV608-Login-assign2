<?php


class RegisterView {
	private static $register = 'RegisterView::Register';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $repeatPassword = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
	private static $userField = '';
	
	private static $messageField = '';


	public function generateRegistrationFormHTML(){
		
		return '
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . self::$messageField . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" size="20" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$userField . '" />
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="20" id="' . self::$password . '" name="' . self::$password . '" />
					<br>
					<label for="' . self::$repeatPassword . '">Repeat password :</label>
					<input type="password" size="20" id="' . self::$repeatPassword . '" name="' . self::$repeatPassword . '" />
					<br>
					<input type="submit" name="' . self::$register . '" value="Register" />
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
	
	//SET-FUNCTIONS TO CHANGE THE MESSAGE
	public function setErrorUsernameFewChar(){
		self::$messageField = "Username has too few characters, at least 3 characters.";
	}
	
	public function setErrorUsernameExists(){
		self::$messageField = "User exists, pick another username.";
	}
	
	public function setErrorPasswordFewChar(){
		self::$messageField = "Password has too few characters, at least 6 characters.";
	}
	
	public function setErrorPasswordMatch(){
		self::$messageField = "Passwords do not match.";
	}
	
	public function setErrorUsernameInvalidChar(){
		self::$messageField = "Username contains invalid characters.";
	}
	
	public function setErrorMissingFields(){
		self::$messageField = "Username has too few characters, at least 3 characters.<br>Password has too few characters, at least 6 characters.";
	}
	
	//GET-FUNCTIONS TO FETCH REQUEST VARIABLES
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
	
	public function getRequestRePassword(){
		if(isset($_POST[self::$repeatPassword])){
			return trim($_POST[self::$repeatPassword]);
		}
	}
	
	public function didUserPressRegister(){
		return isset($_POST[self::$register]);
	}
	
}