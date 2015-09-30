<?php

class RegisterController {
		
		private $registerView;
		private $layoutView;
		private $dateView;
		private $user;


		public function __construct(User $u){
			$this->user = $u;
			$this->registerView = new RegistrationView();
			$this->layoutView = new LayoutView();
			$this->dateView = new DateTimeView();
			$this->nv = new NavigationView();
		}
		
		/**
		* Handle use cases and execute view methods
		* @return  void
		*/
		public function doRegister(){
			$msg = null;
			$requestUser = $this->registerView->getRequestUserName();
			$requestPassword = $this->registerView->getRequestPassword();
			$requestRePassword = $this->registerView->getRequestRePassword();
			
			if($this->registerView->didUserPressRegister() ){
					
				if(empty($requestUser)){
					$msg = $this->loginView->getErrorUsername();
				} else if(empty($requestPassword)){
					$msg = $this->loginView->getErrorPassword();
					$this->loginView->setUsernameField($requestUser);
				} else if($requestUser == $this->user->getName() &&
						$requestPassword == $this->user->getPassword()){
					if($_SESSION['Logged'] == false){
						$msg = $this->loginView->getWelcomeMessage();
						$_SESSION['Logged'] = true;
						
					//if there is a session in place, remove the message
					}else {
						$msg = null;
					}
				} else{ 
					$msg = $this->loginView->getErrorElse();
					$this->loginView->setUsernameField($requestUser);
				}
			}
			
			else if(false ){
				if($_SESSION['Logged'] == true){
					$msg = $this->loginView->getByeMessage();
					$_SESSION['Logged'] = false;
					
				//if the session is finished, remove the message
				}else {
					$msg = null;
				}
				
			}
			
			//initiate rendering
			$this->layoutView->renderRegister($_SESSION['Logged'],$this->registerView,$this->dateView,$msg,$this->nv);
		
		}
}