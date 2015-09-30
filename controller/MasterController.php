<?php

class MasterController {
	
	private $navigationView;
	private $user;
		
	public function __construct(User $u){
		$this->navigationView = new NavigationView();
		$this->user = $u;
	}
	
	public function generate(){
		if($this->navigationView->inRegistrationForm()){
		$register = new RegisterController($this->user);
		
		$register->doRegister();
		
		}
		else {
		$login = new LoginController($this->user);
		
		$login->doLogin();
		}
	}
}