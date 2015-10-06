<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');



//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');

require_once('controller/LoginController.php');
require_once('controller/MasterController.php');
require_once('controller/RegisterController.php');

require_once('model/User.php');

//set the life ot the cookie to be 0 sec
session_set_cookie_params(0);
session_start();

$admin = new User("Admin","Password");
$logView = new LoginView();
$regView = new RegisterView();
$navigationView = new NavigationView();

$mc = new MasterController($admin,$logView,$regView,$navigationView);
$mc->generate();

$layoutView = new LayoutView();
$dateView = new DateTimeView();

if($navigationView->inRegistrationForm())
	$layoutView->renderRegister($admin->isLoggedIn(),$regView,$dateView,$navigationView);
else $layoutView->renderLogin($admin->isLoggedIn(),$logView,$dateView,$navigationView);