<?php

class Login {
	
		private $loginView;
		private $layoutView;
		private $dateView;
		private $user;

		public function __construct(User $u){
			$this->user = $u;
			$this->loginView = new LoginView();
			$this->layoutView = new LayoutView();
			$this->dateView = new DateTimeView();
		}
		
		public function doLogin(){
			$msg = '';
			
			if($this->loginView->didUserPressLogin()){
					
				if(empty($this->loginView->getRequestUserName())){
					$msg = $this->loginView->getErrorUsername();
				} else if(empty($this->loginView->getRequestPassword())){
					$msg = $this->loginView->getErrorPassword();
				} else if($this->loginView->getRequestUserName() === $this->user->getName() &&
						$this->loginView->getRequestPassword() === $this->user->getPassword()){
					$msg = $this->loginView->getWelcomeMessage();
				} else 
					$msg = $this->loginView->getErrorElse();
				
			}
			
			$this->layoutView->render(false,$this->loginView,$this->dateView,$msg);
		
		}
}