<?php

class LoginController {
	
		private $loginView;
		private $model;
		private $userList;

		
		public function __construct(UserList $l,SessionModel $m,LoginView $lv){
			$this->userList = $l;
			$this->model = $m;
			$this->loginView = $lv;
		}
		
		/**
		* Handle use cases and make changes to the model
		* @return  void
		*/
		public function doLogin(){
			//check if there is a newly registered user
			if($this->model->isJustRegistered()){
				$this->loginView->setMessageRegSuccess();
				$this->loginView->setUsernameField($this->model->getSessionUsername());
				$this->model->toggleJustRegistered();
				$this->model->clearSessionUsername();
			} else $this->loginView->clearMessage();
	
			$requestUser = $this->loginView->getRequestUserName();
			$requestPassword = $this->loginView->getRequestPassword();
			
			if($this->loginView->didUserPressLogin() ){
					
				if(empty($requestUser)){
					$this->loginView->setErrorUsername();
				} else if(empty($requestPassword)){
					$this->loginView->setErrorPassword();
					$this->loginView->setUsernameField($requestUser);
				} else if($this->userList->isCredentialsCorrect($requestUser,$requestPassword)){
					if($this->model->isLoggedIn() == false){
						$this->loginView->setWelcomeMessage();
						$this->model->toggleLogged();
					//if there is a session in place, remove the message
					}else {
						$this->loginView->clearMessage();
					}
				} else{ 
					$this->loginView->setErrorElse();
					$this->loginView->setUsernameField($requestUser);
				}
			}
			
			else if($this->loginView->didUserPressLogout() ){
				if($this->model->isLoggedIn() == true){
					$this->loginView->setByeMessage();
					$this->model->toggleLogged();
					
				//if the session is finished, remove the message
				}else {
					$this->loginView->clearMessage();
				}
				
			}
			
		}
}