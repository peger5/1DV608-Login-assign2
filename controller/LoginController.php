<?php

class LoginController {
	
		private $loginView;
		private $user;

		
		public function __construct(User $u,LoginView $lv){
			$this->user = $u;
			$this->loginView = $lv;
		}
		
		/**
		* Handle use cases and execute view methods
		* @return  void
		*/
		public function doLogin(){
			//check if there is a newly registered user
			if($this->user->isJustRegistered()){
				$this->loginView->setMessageRegSuccess();
				$this->loginView->setUsernameField($this->user->getSessionUsername());
				$this->user->toggleJustRegistered();
				$this->user->clearSessionUsername();
			} else $this->loginView->clearMessage();
	
			$requestUser = $this->loginView->getRequestUserName();
			$requestPassword = $this->loginView->getRequestPassword();
			
			if($this->loginView->didUserPressLogin() ){
					
				if(empty($requestUser)){
					$this->loginView->setErrorUsername();
				} else if(empty($requestPassword)){
					$this->loginView->setErrorPassword();
					$this->loginView->setUsernameField($requestUser);
				} else if($requestUser == $this->user->getName() &&
						$requestPassword == $this->user->getPassword()){
					if($this->user->isLoggedIn() == false){
						$this->loginView->setWelcomeMessage();
						$this->user->toggleLogged();
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
				if($this->user->isLoggedIn() == true){
					$this->loginView->setByeMessage();
					$this->user->toggleLogged();
					
				//if the session is finished, remove the message
				}else {
					$this->loginView->clearMessage();
				}
				
			}
			
			//initiate rendering
			//$this->layoutView->renderLogin($_SESSION['Logged'],$this->loginView,$this->dateView,$msg,$this->nv);
		
		}
}