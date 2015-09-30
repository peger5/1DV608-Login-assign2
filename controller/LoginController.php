<?php

class LoginController {
	
		private $loginView;
		private $layoutView;
		private $dateView;
		private $user;

		
		public function __construct(User $u){
			$this->user = $u;
			$this->loginView = new LoginView();
			$this->layoutView = new LayoutView();
			$this->dateView = new DateTimeView();
			$this->nv = new NavigationView();
		}
		
		/**
		* Handle use cases and execute view methods
		* @return  void
		*/
		public function doLogin(){
			$msg = null;
			$requestUser = $this->loginView->getRequestUserName();
			$requestPassword = $this->loginView->getRequestPassword();
			
			if($this->loginView->didUserPressLogin() ){
					
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
			
			else if($this->loginView->didUserPressLogout() ){
				if($_SESSION['Logged'] == true){
					$msg = $this->loginView->getByeMessage();
					$_SESSION['Logged'] = false;
					
				//if the session is finished, remove the message
				}else {
					$msg = null;
				}
				
			}
			
			//initiate rendering
			$this->layoutView->renderLogin($_SESSION['Logged'],$this->loginView,$this->dateView,$msg,$this->nv);
		
		}
}