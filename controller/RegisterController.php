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
		private $userList;
		private $navView;
		private $model;

		public function __construct(UserDAL $l,SessionModel $m,RegisterView $rv, NavigationView $nv){
			$this->model = $m;
			$this->userList = $l;
			$this->registerView = $rv;
			$this->navView = $nv;
		}
		
		/**
		* Handle use cases and execute view methods
		* @return  void
		*/
		public function doRegister(){
			$requestUser = $this->registerView->getRequestUserName();
			$requestPassword = $this->registerView->getRequestPassword();
			$requestRePassword = $this->registerView->getRequestRePassword();
			
			if($this->registerView->didUserPressRegister() ){
				try{
				if($this->checkUsername($requestUser) && $this->checkPassword($requestPassword,$requestRePassword)){
					//create and add new user
					$newUser = new User($requestUser,$requestPassword);
					$this->userList->add($newUser);
					
					$this->model->toggleJustRegistered();
					$this->model->setSessionUsername($requestUser);
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
		}
		
		//Private methods to check validity of fields
		private function checkUsername($name){
			if(strlen($name) < 3)
				throw new UserFewCharException();
			if($this->userList->getUsers()->getUserByName($name) != null)
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