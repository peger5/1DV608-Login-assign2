<?php


class RegistrationView {
	private static $register = 'RegistrationView::Login';
	private static $name = 'RegistrationView::UserName';
	private static $password = 'RegistrationView::Password';
	private static $repeatPassword = 'RegistrationView::Password';

	private static $messageId = 'RegistrationView::Message';

	public function response($message){
		return $this->generateRegistrationFormHTML($message);
	}
	
	public function generateRegistrationFormHTML($message){
		
		return '
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<br>
					<label for="' . self::$repeatPassword . '">Repeat password :</label>
					<input type="password" id="' . self::$repeatPassword . '" name="' . self::$repeatPassword . '" />
					<br>
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH MESSAGES
	public function getErrorUsernameFewChar(){
		return "Username has too few characters, at least 3 characters.";
	}
	
	public function getErrorUsernameExists(){
		return "Username exists, pick another username.";
	}
	
	public function getErrorPasswordFewChar(){
		return "Password has too few characters, at least 6 characters.";
	}
	
	public function getErrorPasswordMatch(){
		return "Passwords do not match.";
	}
	
	public function getErrorUsernameInvalidChar(){
		return "Username contains invalid characters.";
	}
	
	public function getMessageRegSuccess(){
		return "Registered new user.";
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
	
	public function getRequestRePassword(){
		if(isset($_POST[self::$repeatPassword])){
			return $_POST[self::$repeatPassword];
		}
	}
	
	public function didUserPressRegister(){
		return isset($_POST[self::$register]);
	}
	
}