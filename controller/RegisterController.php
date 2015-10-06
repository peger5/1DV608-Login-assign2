<?php

class UserFewCharException extends Exception {};
class UserBadCharException extends Exception {};
class PasswordLenException extends Exception {};
class PasswordMissmatchException extends Exception {};
class UserExistsException extends Exception {};

class RegisterController {
		
		private $registerView;
		private $layoutView;
		private $dateView;
		private $user;
		private $navView;


		public function __construct(User $u){
			$this->user = $u;
			$this->registerView = new RegisterView();
			$this->layoutView = new LayoutView();
			$this->dateView = new DateTimeView();
			$this->navView = new NavigationView();
		}
		
		/**
		* Handle use cases and execute view methods
		* @return  void
		*/
		public function doRegister(){
			//$msg = null;
			$requestUser = $this->registerView->getRequestUserName();
			$requestPassword = $this->registerView->getRequestPassword();
			$requestRePassword = $this->registerView->getRequestRePassword();
			
			if($this->registerView->didUserPressRegister() ){
				try{
				if($this->checkUsername($requestUser) && $this->checkPassword($requestPassword,$requestRePassword)){
					$this->user->toggleJustRegistered();
					$this->user->setSessionUsername($requestUser);
					$this->navView->clearURL();
					}
				} 
				catch (UserFewCharException $ufce){
					$this->registerView->setErrorUsernameFewChar();
					$this->registerView->setUsernameField($requestUser);
				} 
				catch (UserBadCharException $udce){
					$this->registerView->setErrorUsernameInvalidChar();
					$this->registerView->setUsernameField(strip_tags($requestUser));
				} 
				catch (UserExistsException $uee){
					$this->registerView->setErrorUsernameExists();
					$this->registerView->setUsernameField($requestUser);
				} 
				catch (PasswordLenException $ple){
					$this->registerView->setErrorPasswordFewChar();
					$this->registerView->setUsernameField($requestUser);
				} 
				catch (PasswordMissmatchException $pme){
					$this->registerView->setErrorPasswordMatch();
					$this->registerView->setUsernameField($requestUser);
				}
				if(empty($requestUser) && empty($requestPassword) && empty($requestRePassword))
					$this->registerView->setErrorMissingFields();		
			}
			
			//initiate rendering
		//	$this->layoutView->renderRegister($_SESSION['Logged'],$this->registerView,$this->dateView,$msg,$this->navView);
		
		}
		
		//Private methods to check validity of fields
		private function checkUsername($name){
			if(strlen($name) < 3)
				throw new UserFewCharException();
			if($name == $this->user->getName())
				throw new UserExistsException();
			if($name != strip_tags($name))
				throw new UserBadCharException();
			return true;
		}
		
		private function checkPassword($password,$passwordRepeat){
			if(strlen($password) < 6)
				throw new PasswordLenException();
			if($password != $passwordRepeat)
				throw new PasswordMissmatchException();
			return true;
		}
}