<?php

class MasterController {
	
	private $loginView;
	private $registerView;
	private $navigationView;
	private $model;
	private $mysqli;
		
	public function __construct(SessionModel $m,LoginView $lv,RegisterView $rv,NavigationView $nv){
		$this->navigationView = $nv;
		$this->model = $m;
		$this->loginView = $lv;
		$this->registerView = $rv;
		
		//create the connection to the database
		$this->mysqli = new mysqli("mysql6.000webhost.com","a7600781_peger","1234qwer","a7600781_reg");
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		
		$this->userDAL = new UserDAL($this->mysqli);
	}
	
	public function generate(){
		if($this->navigationView->inRegistrationForm()){
		$register = new RegisterController($this->userDAL,$this->model,$this->registerView,$this->navigationView);
		
		$register->doRegister();
		}
		else {
		$login = new LoginController($this->userDAL->getUsers(),$this->model,$this->loginView);
		
		$login->doLogin();
		}
		
		$this->mysqli->close();
	}
}