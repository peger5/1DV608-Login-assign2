<?php

class MasterController {
	
	private $loginView;
	private $registerView;
	private $navigationView;
	private $model;
		
	public function __construct(User $u,LoginView $lv,RegisterView $rv,NavigationView $nv){
		$this->navigationView = $nv;
		$this->model = $u;
		$this->loginView = $lv;
		$this->registerView = $rv;
	}
	
	public function generate(){
		
		
		if($this->navigationView->inRegistrationForm()){
		$register = new RegisterController($this->model);
		
		$register->doRegister();
		}
		else {
		$login = new LoginController($this->model,$this->loginView);
		
		$login->doLogin();
		}
	}
}